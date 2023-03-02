<?php

namespace App\Http\Controllers;

use App\Heads;
use App\Http\Requests\HeadsFormRequest;
use App\Services\FuncionarioInfo;
use App\Services\ListarDepartamentos;
use App\Services\listarFuncionarios;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HeadsController extends Controller
{

    //DEPARTAMENTO
    public function heads_view(Request $request, FuncionarioInfo $funcionarioInfo, ListarDepartamentos $listarDepartamentos, listarFuncionarios $listarFuncionarios){

        $mensagem = $request->session()->get('mensagem');

        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        
        $listaDp = $listarDepartamentos->listarDepartamentosAtivos();
        $funcionarios = $listarFuncionarios->listarFuncionarios();
        $usuarios = $listarFuncionarios->listarUsuariosAtivos();

        $vinculados = Heads::select(
            'departamentos.departamento AS departamento_nome', 
            'usuarios.foto_usuario AS usuario_foto',
            'funcionarios.nome AS funcionario_nome',
            'funcionarios.id AS funcionario_id',
            'heads.created_at',
            'heads.ativo',
            'heads.id',
            'departamentos.id AS departamento_id'
            
        )->join('departamentos', 'departamentos.id', '=', 'heads.departamento_id')
        ->join('usuarios', 'usuarios.funcionario_id', '=', 'heads.funcionario_id')
        ->join('funcionarios', 'funcionarios.id', '=', 'heads.funcionario_id')->get();

        return view('layouts.heads.heads', compact('listaDp', 'funcionarios', 'usuarios', 'vinculados', 'mensagem', 'infos_func'));
    }

    public function heads_criar(HeadsFormRequest $request){
        $head = Heads::create($request->all());

        $request->session()->
            flash(
                'mensagem', 
                "Funcionário vinculado com sucesso!"
            );
        return redirect('/heads');

    }

    public function heads_editar(int $id, HeadsFormRequest $request){
        $head = Heads::find($id);
        $funcionario = $request->funcionario_id;
        $departamento = $request->departamento_id;
        $head->funcionario_id = $funcionario;
        $head->departamento_id = $departamento;
        $head->save();

        return redirect('/heads')->with('msg', 'Funcionário editado com sucesso!');
    }

    public function ativar_inativar_heads(int $id, Request $request){
        $head = Heads::find($id);
        $ativo = $request->ativo;
        $head->ativo = $ativo;
        $head->save();

    }

}

?>
