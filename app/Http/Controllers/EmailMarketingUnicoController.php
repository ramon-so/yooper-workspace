<?php

namespace App\Http\Controllers;
use App\Services\FuncionarioInfo;
use App\Cliente;
use App\CrmEmktUnico;
use App\Services\EnviarArquivos;
use App\Services\ListarClientes;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailMarketingUnicoController extends Controller
{
    public function index(Request $request, ListarClientes $listarClientes, FuncionarioInfo $funcionarioInfo){
        
        $emails = CrmEmktUnico::select('crm_emkt_unicos.*', 'clientes.nome', 'usuarios.foto_usuario',
        'clientes.config_nome_pasta_emkt')
            ->join('clientes', 'clientes.id', '=', 'crm_emkt_unicos.cliente_id')
            ->join('usuarios', 'usuarios.id', '=', 'crm_emkt_unicos.usuario_id')
            ->orderBy('crm_emkt_unicos.id', 'desc')
            ->limit(20)
            ->get();
        
        $clientes = $listarClientes->listarClientes();
        
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);

        return view('layouts.crm.email-marketing-unico', compact('clientes', 'emails', 'infos_func'));
    }

    static function editarClienteConfig(int $id, $pasta_numero){
        $cliente = Cliente::find($id);
        $cliente->config_numero_pasta_emkt = $pasta_numero + 1;
        $cliente->save();
    }

    public function store(EnviarArquivos $enviarArquivos, Request $request, ListarClientes $listarClientes){
        if ($_FILES['imagem_email']['name']) {

            $usuario_id = Auth::user()->id;
            $cliente_infos = Cliente::query()->select('id', 'config_numero_pasta_emkt', 'config_nome_pasta_emkt')
                ->where('id', $request->cliente_id)
                ->get();

            foreach ($cliente_infos as $cliente_info) {
                $pasta_numero = $cliente_info->config_numero_pasta_emkt;
                $pasta_nome = $cliente_info->config_nome_pasta_emkt;
            }

        $email = CrmEmktUnico::create(
            [
            'cliente_id' => $request->cliente_id,
            'numero_pasta' => $pasta_numero,
            'link' => $request->link,
            'nome_campanha' => $request->nome_campanha,
            'previa' => $request->previa,
            'usuario_id' => $usuario_id,
            'imagem_email' => strtolower($_FILES['imagem_email']['name'])
            ]
        );
            $enviarArquivos->enviarArquivoEmktUnico($_FILES,$pasta_nome, $pasta_numero);
            EmailMarketingUnicoController::editarClienteConfig($request->cliente_id, $pasta_numero);
        }else{
            var_dump('erro');
        }



        $request->session()->flash(
        'mensagem',
            "E-mail cadastrado com sucesso!"
        );

        return redirect('/email-marketing-unico');
    }

    public function view_html(int $id, FuncionarioInfo $funcionarioInfo){

        $emails = CrmEmktUnico::select('crm_emkt_unicos.*', 'clientes.nome', 'clientes.config_nome_pasta_emkt','usuarios.foto_usuario')
            ->join('clientes', 'clientes.id', '=', 'crm_emkt_unicos.cliente_id')
            ->join('usuarios', 'usuarios.id', '=', 'crm_emkt_unicos.usuario_id')
            ->orderBy('crm_emkt_unicos.created_at', 'desc')
            ->limit(20)
            ->get();
        $email = [];

        foreach ($emails as $e) {
            if($e->id == $id)
            array_push($email, $e);
        }
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        return view('layouts.crm.email-marketing-unico-html', compact('email', 'infos_func'));
    }

}
