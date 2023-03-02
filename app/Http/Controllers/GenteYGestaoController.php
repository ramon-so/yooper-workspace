<?php

namespace App\Http\Controllers;

use App\Services\FuncionarioInfo;
use App\ProcessoSeletivo;
use App\Services\ListarCargos;
use App\Services\ListarDepartamentos;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenteYGestaoController extends Controller
{

    public function metas_view(FuncionarioInfo $funcionarioInfo) {
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        return view('layouts.genteygestao.metas-quarter', compact('infos_func'));
    }
}
