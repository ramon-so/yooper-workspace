<?php

namespace App\Http\Controllers;

use App\Services\FuncionarioInfo;
use App\Usuario;
use Illuminate\Support\Facades\Auth;
use App\Mail\EnviarRecuperacaoSenha;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login_view(Request $request){
        if(Auth::user()){
            return redirect('/dashboard');
        }else{            
            $mensagem = $request->session()->get('mensagem');
            return view('layouts.login.login');
        }
    }

    public $usuarioInfo;

    public function entrar(Request $request){
        if(strstr($request->nome, '@')){
            $nome = explode("@", $request->nome);
            $usuario = Usuario::where('nome', $nome)
                ->first();
        }else{
            $usuario = Usuario::where('nome', $request->nome)
            ->first();

        }


        if($usuario){            
            if ($request->senha == $usuario->senha){
                Auth::loginUsingId($usuario->id);
                return redirect('/dashboard');
            }else{
                $request->session()->flash(
                    'mensagem',
                        "Senha inválida"
                );
                return redirect()
                    ->back()
                    ->withErrors('Senha Inválida');                   
            }
        }else{
            $request->session()->flash(
                'mensagem',
                "Usuário inválido"
            );
            return redirect()
                ->back()
                ->withErrors('Usuário inválido');
        }

    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

    public function acessoNegado(Request $request, FuncionarioInfo $funcionarioInfo) {
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        return view('layouts.pages.acesso-negado', compact('infos_func'));
    }

    public function recuperar_senha_view(){
        return view('layouts.login.recuperar-senha');
    }

    public function recuperar_senha_resposta_view(Request $request){
        $request = $request->all();
        return view('layouts.login.recuperacao-senha-resposta', ['resposta' => $request['resposta']]);
    }

    public function recuperar_senha(Request $request, FuncionarioInfo $funcionarioInfo){
        if(strstr($request->nome, '@')){
            $nome = explode("@", $request->nome);
            $usuario = Usuario::where('nome', $nome)
                ->first();
        }else{
            $usuario = Usuario::where('nome', $request->nome)
            ->first();
        }
        if($usuario){
            $infos_func = $funcionarioInfo->funcionario_informacoes($usuario->id);
            try {
                $email = new EnviarRecuperacaoSenha($infos_func[0]);
                Mail::to($infos_func[0]->email_funcionario)->send($email);
                return redirect()->route('recuperarSenhaResposta', ['resposta' => 'Sucesso! Verifique seu email para continuar']);
            } catch (\Throwable $th) {
                dd($th);
                return redirect()
                    ->back()
                    ->withErrors('O email não pode ser enviado');
            }
        }else{
            return redirect()
                ->back()
                ->withErrors('Usuario não encontrado');
        }
    }

    public function redefinir_senha(Request $request){
        $request = $request->all();
        try {
            $senha = $request['senha'];
            $id = $request['id'];
            $affected = DB::table('usuarios')
              ->where('funcionario_id', $id)
              ->update(['senha' => $senha]);
            return redirect()->route('login');
        } catch (\Throwable $th) {
            return redirect()
                    ->back()
                    ->withErrors('Não foi possivel alterar a senha, tente novamente');
        }
    }

}
