<?php

namespace App\Http\Controllers;

use App\Departamento;
use App\Funcionario;
use App\Services\FuncionarioInfo;
use App\Services\ListarDepartamentos;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CadastrarFuncionarioController extends Controller
{
    public function cadastrar_funcionario_view(ListarDepartamentos $listarDepartamentos, Request $request, FuncionarioInfo $funcionarioInfo)
    {
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);

        $listaDp = $listarDepartamentos->listarDepartamentos();

        $mensagem = $request->session()->get('mensagem');

        $funcionarios = Departamento::select('funcionarios.id', 'funcionarios.nome', 'departamentos.departamento', 'funcionarios.ativo')
            ->where('funcionarios.ativo', 'Sim')
            ->join('funcionarios', 'departamentos.id', '=', 'funcionarios.departamento_id')
            ->orderBy('funcionarios.created_at', 'desc')
            ->get();

        return view('layouts.usuarios.cadastro-funcionarios', compact('listaDp', 'funcionarios', 'mensagem', 'infos_func'));
    }

    public function cadastrar_funcionario(Request $request)
    {
        $funcionario = Funcionario::create($request->all());

        $request->session()->flash(
            'mensagem',
            "Funcionario '$funcionario->nome' cadastrado com sucesso!"
        );
        return redirect('/cadastrar-funcionario');
    }
}
