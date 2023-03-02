<?php

namespace App\Http\Controllers;

use App\Services\FuncionarioInfo;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GestaoDeMidiaController extends Controller
{
    public function receitas_e_consumos_view(FuncionarioInfo $funcionarioInfo) {
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);

            return view('layouts.gestao.receitas-e-consumos', compact('infos_func'));
    }
}
