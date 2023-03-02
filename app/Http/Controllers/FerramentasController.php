<?php

namespace App\Http\Controllers;

use App\Services\FuncionarioInfo;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FerramentasController extends Controller
{
    public function gerarEmail(Request $request, FuncionarioInfo $funcionarioInfo){
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        return view('layouts.ferramentas.emails-automatizados', compact('infos_func'));
    }

    public function emailRhModelo1(Request $request, FuncionarioInfo $funcionarioInfo){
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        return view('layouts.ferramentas.email-modelos.modelo-1.modelo-1', compact('infos_func'));
    }

    public function emailRhModelo2(Request $request, FuncionarioInfo $funcionarioInfo){
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        return view('layouts.ferramentas.email-modelos.modelo-2.modelo-2', compact('infos_func'));
    }

    public function emailRhModelo3(Request $request, FuncionarioInfo $funcionarioInfo){
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        return view('layouts.ferramentas.email-modelos.modelo-3.modelo-3', compact('infos_func'));
    }

    public function emailRhModelo4(Request $request, FuncionarioInfo $funcionarioInfo){
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        return view('layouts.ferramentas.email-modelos.modelo-4.modelo-4', compact('infos_func'));
    }

    public function emailRhModelo5(Request $request, FuncionarioInfo $funcionarioInfo){
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        return view('layouts.ferramentas.email-modelos.modelo-5.modelo-5', compact('infos_func'));
    }

    public function emailRhModelo6(Request $request, FuncionarioInfo $funcionarioInfo){
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        return view('layouts.ferramentas.email-modelos.modelo-6.modelo-6', compact('infos_func'));
    }

    public function emailRhModelo7(Request $request, FuncionarioInfo $funcionarioInfo){
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        return view('layouts.ferramentas.email-modelos.modelo-7.modelo-7', compact('infos_func'));
    }
    public function emailRhModelo8(Request $request, FuncionarioInfo $funcionarioInfo){
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        return view('layouts.ferramentas.email-modelos.modelo-8.modelo-8', compact('infos_func'));
    }

    public function emailRhModelo9(Request $request, FuncionarioInfo $funcionarioInfo){
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        $comunicado = nl2br($request->comunicado);
        return view('layouts.ferramentas.email-modelos.modelo-9.modelo-9', compact('infos_func', 'comunicado'));
    }

    public function emailRhModelo10(Request $request, FuncionarioInfo $funcionarioInfo){
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        return view('layouts.ferramentas.email-modelos.modelo-10.modelo-10', compact('infos_func'));
    }

    public function emailRhModelo11(Request $request, FuncionarioInfo $funcionarioInfo){
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        return view('layouts.ferramentas.email-modelos.modelo-11.modelo-11', compact('infos_func'));
    }

    public function emailRhModelo12(Request $request, FuncionarioInfo $funcionarioInfo){
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        return view('layouts.ferramentas.email-modelos.modelo-12.modelo-12', compact('infos_func'));
    }
}
