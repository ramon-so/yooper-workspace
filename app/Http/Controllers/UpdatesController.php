<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function receitas_e_consumos_view(FuncionarioInfo $funcionarioInfo) {
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);

        

        return view('layouts.updates.updates', compact('infos_func'));
    }
}