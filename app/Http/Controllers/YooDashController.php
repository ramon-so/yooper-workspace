<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Contas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\FuncionarioInfo;
use App\Services\listarContas;
use App\Usuario;
use App\UsuariosDash;
use Illuminate\Support\Facades\DB;

class YooDashController extends Controller
{

    public function dashboards(Request $request, FuncionarioInfo $funcionarioInfo){

        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);

        $emails = DB::select('SELECT conta_id, group_concat(email SEPARATOR ", ") AS usuarios FROM dash_usuarios GROUP BY conta_id');

        $contas = DB::select('SELECT
        dash_clientes.id,
        dash_clientes.status as status,
        dash_clientes.conta as conta,
        dash_clientes.plano_integrado_id as plano_integrado_id,
        dash_clientes.cliente, 
        dash_clientes.empresa, 
        dash_clientes.qtd_usuarios, 
        dash_clientes.dashboard_id, 
        dash_clientes.monday_embed, 
        dash_clientes.integracoes,
        GROUP_CONCAT(dash_usuarios.email SEPARATOR ", ") AS email
        FROM dash_clientes
        LEFT JOIN dash_usuarios ON dash_usuarios.conta_id = dash_clientes.id
        GROUP BY dash_clientes.id, dash_clientes.cliente, status, conta, plano_integrado_id');

        $ordem_contas =  Contas::select(
            'dash_clientes.id',
            'dash_clientes.status as status',
            'dash_clientes.cliente as cliente',
        )->where('status' ,'=','Ativo')
        ->orderBy('cliente', 'asc')
        ->get();

        return view('layouts.yoodash.yoodash', compact('infos_func', 'contas', 'emails', 'ordem_contas'));
    }
    
    public function conta_id(Request $request, FuncionarioInfo $funcionarioInfo){
        $conta = $request->conta;
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        
        $conta_dash_id = Contas::query()->select('*')->where('conta', $conta)->limit(1)->get();


        $dash_id = $conta_dash_id[0]->dashboard_id;


        return view('layouts.yoodash.conta', compact('infos_func', 'dash_id', 'conta'));
    }

    public function inativar_dashboard(int $id, Request $request){
        $conta = Contas::find($id);
        $conta->update([
            'status' => $request->status,
        ]);

        return redirect('/yoodash')->with('msg', 'Cliente inativado com sucesso!');
    }

    public function ativar_dashboard(int $id, Request $request){
        $conta = Contas::find($id);
        $conta->update([
            'status' => $request->status,
        ]);

        return redirect('/yoodash')->with('msg', 'Cliente ativado com sucesso!');
    }

    public function cadastrar_dashboard(Request $request){

        $integracoes = implode(",", $request->integracoes);

        $dashboard = Contas::create(
            [
            'conta' => $request->conta,
            'cliente' => $request->cliente,
            'empresa' => $request->empresa,
            'qtd_usuarios' => $request->qtd_usuarios,
            'logo' => $request->logo,
            'dashboard_id' => $request->dashboard_id,
            'integracoes' => $integracoes,
            'monday_embed' => $request->monday_embed,
            'plano_integrado_id' => $request->plano_integrado_id,
            'status' => $request->status,  
            ]);

        return redirect('/yoodash')->with('msg', 'Cliente cadastrado com sucesso!');
    }

    public function cadastrar_usuarios(Request $request){
       $cliente = UsuariosDash::select('*')->where('email', '=', $request->email)->where('conta_id', '=', $request->conta_id)->get();

       if (count($cliente) > 0) {
            return redirect('/yoodash')->with('msgf', 'Usuário já está cadastrado na base de dados!');
       } else {
            $cadastrar_cliente =  UsuariosDash::create($request->all());
            return redirect('/yoodash')->with('msg', 'Usuário cadastrado com sucesso!');
       }
    }

    public function editar_dashboard(Request $request, $id) {
        $cliente = Contas::find($id);
        $integracoes = implode(",", $request->integracoes_edit);
        $cliente->update([
            'conta' => $request->conta,
            'cliente' => $request->cliente,
            'empresa' => $request->empresa,
            'qtd_usuarios' => $request->qtd_usuarios,
            'logo' => $request->logo,
            'dashboard_id' => $request->dashboard_id,
            'integracoes' => $integracoes,
            'monday_embed' => $request->monday_embed,
            'plano_integrado_id' => $request->plano_integrado_id,
            'status' => $request->status,  
        ]);
        return redirect('/yoodash')->with('msg', 'Yoo.Dash atualizado com sucesso!');
    }

}