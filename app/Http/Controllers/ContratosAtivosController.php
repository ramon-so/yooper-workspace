<?php

namespace App\Http\Controllers;

use App\Services\FuncionarioInfo;
use App\Services\ListarServicos;
use App\Services\ListarClientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Clientes;
use App\Contratos;
use App\Contratos_alocados;
use App\Usuario;
use App\Repositories\ClientesRepository;
use App\Services\ContratosService;

class ContratosAtivosController extends Controller
{

    public function contratos_ativos_view(FuncionarioInfo $funcionarioInfo, ListarServicos $servicos)
    {
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);

        return view('layouts.gestao.contratos-ativos', compact('infos_func'));
    }
}