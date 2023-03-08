<?php

namespace App\Http\Controllers;

use App\Funcionario;
use App\Services\EnviarArquivos;
use App\Services\FuncionarioInfo;
use App\Services\ListarDepartamentos;
use App\Services\ListarFuncionarios;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
{
    public function index(ListarFuncionarios $listarFuncionarios, ListarDepartamentos $listarDepartamentos, Request $request, FuncionarioInfo $funcionarioInfo){
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        $usuarios = Usuario::select(
            'usuarios.nome as nome_usuario',
            'departamentos.departamento', 
            'usuarios.foto_usuario as foto_usuario',
            )
            ->join('departamentos', 'departamentos.id', '=', 'usuarios.departamento_id')
            ->orderBy('usuarios.created_at', 'desc')
            ->limit(10)
            ->get();

        $listaDp = $listarDepartamentos->listarDepartamentos();
        $funcionarios = $listarFuncionarios->listarFuncionariosUsuarios();

        $mensagem = $request->session()->get('mensagem');

        return view('layouts.usuarios.cadastro-usuario', compact('listaDp' , 'funcionarios', 'usuarios', 'mensagem', 'infos_func'));
    }

    public function listarUsuarios(ListarDepartamentos $listarDepartamentos, Request $request, FuncionarioInfo $funcionarioInfo){
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        $usuarios = Usuario::select(
            'usuarios.nome AS nome_user',
            'usuarios.id AS id_user',
            'usuarios.foto_usuario',
            'usuarios.senha',
            'usuarios.funcionario_id as func_id',
            'usuarios.acesso', 
            'departamentos.departamento', 
            'funcionarios.nome AS nome_funcionario',
            'funcionarios.email AS email_funcionario',
            'usuarios.ativo AS ativo_user'
        )
        ->join('departamentos', 'departamentos.id', '=', 'usuarios.departamento_id')
        ->join('funcionarios', 'funcionarios.id', '=', 'usuarios.funcionario_id')
        ->orderBy('funcionarios.nome', 'asc')
        ->get();

        $listaDp = $listarDepartamentos->listarDepartamentos();

        $users = Usuario::where('nome', 'LIKE', "%{$request->filtroNome}%")->get();

        return view('layouts.usuarios.usuarios', compact('usuarios', 'listaDp', 'infos_func'));
    }

        public function store(EnviarArquivos $enviarArquivos, Request $request){

                $usuario = Usuario::create(
                    [
                    'nome' => $request->nome,
                    'senha' => $request->senha,
                    'ativo' => $request->ativo,
                    'acesso' => $request->acesso,
                    'departamento_id' => $request->departamento_id,
                    'funcionario_id' => $request->funcionario_id
                    ]
                );
                $usuario_search= Usuario::find($usuario->id);
                $usuario_search->foto_usuario = "usuario$usuario->id.jpeg";
                $usuario_search->save();
                $path = $request->foto_usuario->storeAs('usuarios', "usuario" . $usuario->id . ".jpeg", ['disk' => 'public']);
                $usuario->update([
                'foto_usuario' => "usuario".$usuario->id.".jpeg",
        ]);

            return redirect('/cadastrar-usuarios')->with('msg', 'Usuário cadastrado com sucesso!');;
        }

        public function ativar_inativar(int $id, Request $request){
            $usuario = Usuario::find($id);
            $usuario->ativo = $request->ativo;
            $usuario->save();

            $funcionario = Funcionario::find($id);
            $funcionario->ativo = $request->ativo;
            $funcionario->save();

        }

        public function editar_usuario(int $id, int $func_id, Request $request){
            $usuario = Usuario::find($id);
            $usuario->nome = $request->user_name;
            $usuario->senha = $request->senha;
            $usuario->departamento_id = $request->departamento;
            $usuario->save();

            $funcionario = Funcionario::find($func_id);
            $funcionario->nome = $request->nome;
            $funcionario->email = $request->email;
            $funcionario->departamento_id = $request->departamento;
            $funcionario->save();
        }

        public function perfil(FuncionarioInfo $funcionarioInfo) {
            $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);

            $usuarios = Usuario::select(
                'usuarios.nome AS nome_user',
                'usuarios.id AS id_user',
                'usuarios.foto_usuario',
                'usuarios.senha as senha_funcionario',
                'usuarios.funcionario_id as func_id',
                'usuarios.acesso', 
                'departamentos.departamento as departamento_funcionario', 
                'funcionarios.nome AS nome_funcionario',
                'funcionarios.email AS email_funcionario',
                'usuarios.ativo AS ativo_user'
            )
            ->join('departamentos', 'departamentos.id', '=', 'usuarios.departamento_id')
            ->join('funcionarios', 'funcionarios.id', '=', 'usuarios.funcionario_id')->where('usuarios.id', '=', Auth::user()->id)->get();

            return view('layouts.usuarios.perfil', compact('infos_func', 'usuarios'));
        }

        public function editar_perfil(Request $request) {

            $usuarios = Usuario::find(Auth::user()->id);
            if (empty($_FILES['foto_usuario']['name'])) { 
                $usuarios->update([
                    'senha' => $request->senha,
                ]);

            } else {
                $usuarios->update([
                    'senha' => $request->senha,
                    'foto_usuario' => "usuario$usuarios->id.jpeg",
                ]);
                $request->foto_usuario->storeAs('usuarios', "usuario" . $usuarios->id . ".jpeg", ['disk' => 'public']);
            }
            return redirect('/sair')->with('msg', 'Dados alterados com sucesso!');
        }

}
