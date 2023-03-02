<?php

namespace App\Http\Controllers;
use App\Contas;
use App\Services\FuncionarioInfo;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function dashboard_view(Request $request, FuncionarioInfo $funcionarioInfo){
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);

        $usuarios = Usuario::select('usuarios.nome', 'usuarios.ativo', 'departamentos.departamento', 'foto_usuario')
            ->join('departamentos', 'departamentos.id', '=', 'usuarios.departamento_id')
            ->orderBy('usuarios.created_at', 'desc')
            ->limit(5)
            ->get();

        $contas = Contas::select('dash_clientes.id' , 'dash_clientes.conta', 'dash_clientes.cliente', 'dash_clientes.plano_integrado_id' , 'dash_clientes.dashboard_id', 'dash_clientes.status')
        ->orderBy('dash_clientes.id', 'desc')
        ->limit(6)
        ->get();
    
        $mensagem = $request->session()->get('mensagem');

        return view('layouts.dashboard.dashboard', compact('usuarios', 'contas', 'mensagem', 'infos_func'));
    }
}
