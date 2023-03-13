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
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\UrlGenerator;
use App\Models\ClientesClassificacoes;

class GestaoClientesController extends Controller
{

    public function gestao_clientes_view(FuncionarioInfo $funcionarioInfo, ListarServicos $servicos)
    {
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);

        $lista_servicos = $servicos->listarServicos();

        $cliente_lista = Clientes::select('id', 'empresa', 'razaosocial')->get();

        return view('layouts.gestao.clientes', compact('infos_func', 'lista_servicos', 'cliente_lista'));
    }

    public function relatorio_net_view(FuncionarioInfo $funcionarioInfo){
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        return view('layouts.gestao.relatorio-net', compact('infos_func'));
    }

    public function cliente_view(FuncionarioInfo $funcionarioInfo, int $id, Request $request, UrlGenerator $urlGenerator)
    {
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);

        $cliente = Clientes::find($id);

        $request->servico ? $servico = $request->servico : $servico = null;
        $contratos_ativos = Contratos_alocados::select(
            'contratos.id AS contrato_id',
            'contratos.briefing AS briefing',
            'contratos.fee AS fee',
            'contratos.ferramentas_crm AS ferramentas_crm',
            'contratos.disparos_semana_crm AS disparos_semana_crm',
            'contratos.posts_semana_social AS posts_semana_social',
            'contratos.budget_impulsionamento_social AS budget_impulsionamento_social',
            'contratos.link_conteudos_blog AS link_conteudos_blog',
            'contratos.desenvolvimento_seo AS desenvolvimento_seo',
            'contratos.conteudos_mes_seo AS conteudos_mes_seo',
            'contratos.conteudos_blog_seo AS conteudos_blog_seo',
            'contratos.total_conteudos_seo AS total_conteudos_seo',
            'contratos.implementacao_seo AS implementacao_seo',
            'contratos.tipo_contrato_influenciadores AS tipo_contrato_influenciadores',
            'contratos.escopo_influeniadores AS escopo_influeniadores',
            'contratos.xml_midia AS xml_midia',
            'contratos.canais_ativos_midia AS canais_ativos_midia',
            'contratos.faixa_investimento_midia AS faixa_investimento_midia',
            'contratos.forma_pagamento_midia AS forma_pagamento_midia',
            'contratos.gerenciamento_redes_sociais_social AS gerenciamento_redes_sociais_social',
            'servicos.nome AS servico_nome',
            'contratos.data_kickoff AS data_kickoff',
            'contratos.data_solicitacao_cancelamento AS data_solicitacao_cancelamento',
            'contratos.data_ultimo_dia AS data_ultimo_dia',
            'contratos.conteudos_mes_blog AS conteudos_mes_blog',
            'contratos.contratos AS contratos',
            DB::raw("(GROUP_CONCAT(sub_contratos.nome)) AS contrato_alocado")

        )
            ->where('clientes.id', "$id")
            ->rightJoin('contratos', 'contratos.id', '=', 'contratos_alocados.contrato_id')
            ->leftJoin('clientes', 'clientes.id', '=', 'contratos.cliente_id')
            ->rightJoin('servicos', 'servicos.id', '=', 'contratos.servico_id')
            ->leftJoin('sub_contratos', 'sub_contratos.id', '=', 'contratos_alocados.id')
            ->groupBy('contratos.id')
            ->get();

        $feeTotal = 0;

        for($i = 0; $i < count($contratos_ativos); $i++){
            $id = $contratos_ativos[$i]->contrato_id;
            $acessos = DB::select("SELECT * FROM clientes_acessos WHERE contrato_id = '$id'");
            $contratos_ativos[$i]['acessos'] = $acessos;
            $feeTotal += $contratos_ativos[$i]->fee;

            $data_referencia = Date('Y-m-d');

            if($contratos_ativos[$i]->data_solicitacao_cancelamento != null && $contratos_ativos[$i]->data_ultimo_dia < now()){
                $contratos_ativos[$i]['status'] = "Cancelado";
                $data_referencia = Date('Y-m-d', strtotime($contratos_ativos[$i]->data_ultimo_dia));
            }elseif($contratos_ativos[$i]->data_solicitacao_cancelamento == null){
                $contratos_ativos[$i]['status'] = "Ativo";
            }else{
                $contratos_ativos[$i]['status'] = "Aviso prévio";
            }



            $dias = date_diff(date_create($contratos_ativos[$i]->data_kickoff), date_create($data_referencia))->format("%a");
            $anos = floor($dias / 365);
            $dias = $dias % 365;
            $meses = floor($dias / 30);
            $dias = $dias % 30;
            $data = $anos . "A " . $meses . "M " . $dias . "D";
            $contratos_ativos[$i]['tempo_contrato'] = $data;

            $id = $contratos_ativos[$i]->contrato_id;

            $responsaveis = DB::select("SELECT f.nome, c.id FROM carteiras c
            LEFT JOIN funcionarios f ON f.id = c.funcionario_id
            LEFT JOIN contratos c3 ON c3.id = c.contrato_id
            WHERE c3.id  = '$id'
            GROUP BY c.id ");

            
            $contratos_ativos[$i]['responsaveis'] = $responsaveis;
        }

        $sub_contratos_ativos = Contratos_alocados::select(
            'contratos.id AS contrato_id',
            'servicos.nome AS contrato',
            'sub_contratos.nome AS contrato_alocado'
        )
            ->join('contratos', 'contratos.id', '=', 'contratos_alocados.contrato_id')
            ->join('clientes', 'clientes.id', '=', 'contratos.cliente_id')
            ->join('servicos', 'servicos.id', '=', 'contratos.servico_id')
            ->join('sub_contratos', 'sub_contratos.id', '=', 'contratos_alocados.id')
            ->where('clientes.id', "$id")
            ->get();

        $url = $urlGenerator->to('/');

        return view('layouts.gestao.cliente', compact('infos_func', 'cliente', 'contratos_ativos', 'sub_contratos_ativos', 'feeTotal', 'servico', 'url'));
    }

    public function contratos_view(FuncionarioInfo $funcionarioInfo, ListarClientes $clientes, ListarServicos $servicos, Request $request)
    {
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        $lista_servicos = $servicos->listarServicos();
        $clientes = $clientes->clientes();
        $data_hoje = date('Y/m/d');
        $anoRef = Date('Y');
        if(isset($request->anoRef)){
            $anoRef = $request->anoRef;
            $data_hoje = $anoRef == Date('Y') ? $data_hoje : date($anoRef . "/12/31");
        }
        $data_primeiro_dia_ano = date($anoRef . "/01/01");

/*
        $contratos_service = new ContratosService();
        $contratos_pendentes = $contratos_service->contratos_pendentes();

        dd($contratos_pendentes);
*/
        $data_inicial = $anoRef . '-1-1';
        $data_inicial = Date($anoRef);
        $data_final = $anoRef . '-12-31';
        $data_final = Date($data_final);

        if(!isset($request->data_kickoff_inicial) && !isset($request->data_kickoff_final) && !isset($request->data_cancelamento_inicial) && !isset($request->data_cancelamento_final)){
        $contratos_pendentes = Contratos::select(
            'contratos.id AS contrato_id',
            'servicos.nome AS contrato',
            'clientes.empresa AS empresa',
            'clientes.id AS cliente_id',
            'contratos.fee AS fee',
            'contratos.created_at AS created_at',
            'contratos.servico_id AS servico_id',
            'contratos.data_kickoff',
            'servicos.nome AS servico_nome',
            'contratos.data_ultimo_dia',
            'contratos.projetos'
        )
            ->where('data_kickoff', NULL)
            ->where('data_solicitacao_cancelamento', NULL)
            ->where('data_ultimo_dia', NULL)
            ->join('servicos', 'servicos.id', '=', 'contratos.servico_id')
            ->join('clientes', 'clientes.id', '=', 'contratos.cliente_id')
            ->orderBy('contratos.created_at', 'desc')
            ->get();

        

        $fee_pendentes = $contratos_pendentes->sum('fee');

        }else{
            $fee_pendentes = 0;
            $contratos_pendentes = [];
        }
        $contratos_alocados_pendentes = 0;
        foreach($contratos_pendentes as $contrato){

            $dias = date_diff(date_create($contrato->created_at), date_create(Date('Y-m-d')))->format("%a");
            $anos = floor($dias / 365);
            $dias = $dias % 365;
            $meses = floor($dias / 30);
            $dias = $dias % 30;
            $data = $anos . "A " . $meses . "M " . $dias . "D";
            $contrato['tempo_contrato'] = $data;
            $possiveis_alocacoes = DB::select("SELECT servicos.nome AS sub_servico, servicos.id AS servico_id FROM possiveis_alocacoes_contratos
            JOIN servicos ON servicos.id = possiveis_alocacoes_contratos.servico_alocado_id
            WHERE possiveis_alocacoes_contratos.servico_id  = '$contrato->servico_id'");
            $contrato['possiveis_alocacoes'] = $possiveis_alocacoes;

            $alocados = Contratos_alocados::select(
                'servicos.nome AS servico'
            )
            ->join('sub_contratos', 'sub_contratos.id', '=', 'contratos_alocados.subcontrato_id')
            ->join('servicos', 'servicos.id', '=', 'sub_contratos.servico_id')
            ->where('contrato_id', $contrato->contrato_id)
            ->get();
            $contratos_alocados_pendentes += count($alocados);
            count($alocados) > 0 ? $contrato['alocados'] = $alocados : $contrato['alocados'] = [];
        }

        isset($request->data_kickoff_inicial) ? $data_kickoff_inicial = $request->data_kickoff_inicial : $data_kickoff_inicial = $data_inicial;
        isset($request->data_kickoff_final) ? $data_kickoff_final = $request->data_kickoff_final : $data_kickoff_final = $data_final;
        $contratos_ativos = Contratos::select(
            'contratos.id AS contrato_id',
            'servicos.nome AS contrato',
            'clientes.empresa AS empresa',
            'clientes.id AS cliente_id',
            'contratos.fee AS fee',
            'contratos.created_at AS created_at',
            'contratos.servico_id AS servico_id',
            'contratos.data_kickoff',
            'servicos.nome AS servico_nome',
            'contratos.data_ultimo_dia',
            'contratos.projetos'
        )
            ->where('data_kickoff', '>=', $data_kickoff_inicial)
            ->where('data_kickoff', '<=', $data_kickoff_final)
            ->where('data_solicitacao_cancelamento', NULL)
            ->where('data_ultimo_dia', NULL)
            ->join('servicos', 'servicos.id', '=', 'contratos.servico_id')
            ->join('clientes', 'clientes.id', '=', 'contratos.cliente_id')
            ->orderBy('contratos.created_at', 'desc')
            ->get();

        

        $fee_ativos = $contratos_ativos->sum('fee');

        $contratos_cancelados = Contratos::select(
            'contratos.id AS contrato_id',
            'servicos.nome AS contrato',
            'clientes.empresa AS empresa',
            'clientes.id AS cliente_id',
            'contratos.fee AS fee',
            'contratos.data_kickoff AS data_kickoff',
            'contratos.data_solicitacao_cancelamento AS data_solicitacao_cancelamento',
            'contratos.data_ultimo_dia AS data_ultimo_dia',
            'contratos.created_at AS created_at',
            'contratos.servico_id AS servico_id',
            'contratos.projetos',
            'servicos.nome AS servico_nome'
        )->where('data_ultimo_dia', '<', $data_hoje)
         ->where('data_ultimo_dia', '>=', $data_primeiro_dia_ano)
            ->join('servicos', 'servicos.id', '=', 'contratos.servico_id')
            ->join('clientes', 'clientes.id', '=', 'contratos.cliente_id')
            ->orderBy('contratos.created_at', 'desc')
            ->get();
        
        

            $fee_cancelados = $contratos_cancelados->sum('fee');


        $contratos_aviso_previo = Contratos::select(
            'contratos.id AS contrato_id',
            'servicos.nome AS contrato',
            'clientes.empresa AS empresa',
            'clientes.id AS cliente_id',
            'contratos.fee AS fee',
            'contratos.data_ultimo_dia AS data_ultimo_dia',
            'contratos.data_kickoff AS data_kickoff',
            'contratos.data_solicitacao_cancelamento AS data_solicitacao_cancelamento',
            'contratos.created_at AS created_at',
            'contratos.servico_id AS servico_id',
            'servicos.nome AS servico_nome',
            'contratos.projetos'
        )
            ->whereNotNull('data_kickoff')
            ->whereNotNull('data_solicitacao_cancelamento')
            ->where('data_ultimo_dia', '>', $data_hoje)
            ->join('servicos', 'servicos.id', '=', 'contratos.servico_id')
            ->join('clientes', 'clientes.id', '=', 'contratos.cliente_id')
            ->orderBy('contratos.created_at', 'desc')
            ->get();
            $fee_aviso_previo = $contratos_aviso_previo->sum('fee');
        

        $contratos_alocados_aviso_previo = 0;
        $contratos_aviso_previo_nesta_data = 0;

        foreach($contratos_aviso_previo as $contrato){
            $alocados = Contratos_alocados::select(
                'servicos.nome AS servico'
            )
            ->join('sub_contratos', 'sub_contratos.id', '=', 'contratos_alocados.subcontrato_id')
            ->join('servicos', 'servicos.id', '=', 'sub_contratos.servico_id')
            ->where('contrato_id', $contrato->contrato_id)
            ->get();
            $contratos_alocados_aviso_previo += count($alocados);
            count($alocados) > 0 ? $contrato['alocados'] = $alocados : $contrato['alocados'] = [];

            $dias = date_diff(date_create($contrato->data_kickoff), date_create(Date('Y-m-d')))->format("%a");
            $anos = floor($dias / 365);
            $dias = $dias % 365;
            $meses = floor($dias / 30);
            $dias = $dias % 30;
            $data = $anos . "A " . $meses . "M " . $dias . "D";
            $contrato['tempo_contrato'] = $data;
            $possiveis_alocacoes = DB::select("SELECT servicos.nome AS sub_servico, servicos.id AS servico_id FROM possiveis_alocacoes_contratos
            JOIN servicos ON servicos.id = possiveis_alocacoes_contratos.servico_alocado_id
            WHERE possiveis_alocacoes_contratos.servico_id  = '$contrato->servico_id'");
            $contrato['possiveis_alocacoes'] = $possiveis_alocacoes;
        }
        $contratos_alocados =0;
        foreach($contratos_ativos as $contrato){
            $alocados = Contratos_alocados::select(
                'servicos.nome AS servico'
            )
            ->join('sub_contratos', 'sub_contratos.id', '=', 'contratos_alocados.subcontrato_id')
            ->join('servicos', 'servicos.id', '=', 'sub_contratos.servico_id')
            ->where('contrato_id', $contrato->contrato_id)
            ->get();

            $contratos_alocados += count($alocados);
            count($alocados) > 0 ? $contrato['alocados'] = $alocados : $contrato['alocados'] = [];

            $dias = date_diff(date_create($contrato->data_kickoff), date_create(Date('Y-m-d')))->format("%a");
            $anos = floor($dias / 365);
            $dias = $dias % 365;
            $meses = floor($dias / 30);
            $dias = $dias % 30;
            $data = $anos . "A " . $meses . "M " . $dias . "D";
            $contrato['tempo_contrato'] = $data;
            $possiveis_alocacoes = DB::select("SELECT servicos.nome AS sub_servico, servicos.id AS servico_id FROM possiveis_alocacoes_contratos
            JOIN servicos ON servicos.id = possiveis_alocacoes_contratos.servico_alocado_id
            WHERE possiveis_alocacoes_contratos.servico_id  = '$contrato->servico_id'");
            $contrato['possiveis_alocacoes'] = $possiveis_alocacoes;
        }

        $contratos_alocados_cancelados = 0;
        foreach($contratos_cancelados as $contrato){
            $alocados = Contratos_alocados::select(
                'servicos.nome AS servico'
            )
                ->join('sub_contratos', 'sub_contratos.id', '=', 'contratos_alocados.subcontrato_id')
                ->join('servicos', 'servicos.id', '=', 'sub_contratos.servico_id')
                ->where('contrato_id', $contrato->contrato_id)
                ->get();
            $contratos_alocados_cancelados += count($alocados);
            count($alocados) > 0 ? $contrato['alocados'] = $alocados : $contrato['alocados'] = [];

            $dias = date_diff(date_create($contrato->data_kickoff), date_create($contrato->data_ultimo_dia))->format("%a");
            $anos = floor($dias / 365);
            $dias = $dias % 365;
            $meses = floor($dias / 30);
            $dias = $dias % 30;
            $data = $anos . "A " . $meses . "M " . $dias . "D";
            $contrato['tempo_contrato'] = $data;
            $possiveis_alocacoes = DB::select("SELECT servicos.nome AS sub_servico, servicos.id AS servico_id FROM possiveis_alocacoes_contratos
            JOIN servicos ON servicos.id = possiveis_alocacoes_contratos.servico_alocado_id
            WHERE possiveis_alocacoes_contratos.servico_id  = '$contrato->servico_id'");
            $contrato['possiveis_alocacoes'] = $possiveis_alocacoes;
        }

        $alocados_aviso_previo_ativos = 0;
        $alocados_aviso_previo_cancelados = 0;
        $alocdos_pedentes = 0;
        $alocados_cancelados = 0;
        $alocados_ativos = 0;

        $contratos_widget_aviso_previo_ativos = DB::select("
            SELECT c.id AS contrato_id FROM contratos c 
            WHERE c.data_ultimo_dia IS NOT NULL 
            AND c.data_ultimo_dia > CURRENT_DATE()
            AND c.data_kickoff >= '$anoRef-01-01'
            AND c.data_kickoff <= '$anoRef-12-31'
        ");
        foreach($contratos_widget_aviso_previo_ativos AS $contrato){
            $alocados = Contratos_alocados::select(
                'servicos.nome AS servico'
            )
            ->join('sub_contratos', 'sub_contratos.id', '=', 'contratos_alocados.subcontrato_id')
            ->join('servicos', 'servicos.id', '=', 'sub_contratos.servico_id')
            ->where('contrato_id', $contrato->contrato_id)
            ->get();
            $alocados_aviso_previo_ativos += count($alocados); 
        }

        $fee_aviso_cancelados = 0;
        $contratos_widget_aviso_previo_cancelados = DB::select("
            SELECT c.id AS contrato_id, c.fee FROM contratos c 
            WHERE c.data_ultimo_dia IS NOT NULL 
            AND c.data_ultimo_dia > CURRENT_DATE()
            AND c.data_kickoff < '$anoRef-01-01'
        ");
        foreach($contratos_widget_aviso_previo_cancelados AS $contrato){
            $alocados = Contratos_alocados::select(
                'servicos.nome AS servico'
            )
            ->join('sub_contratos', 'sub_contratos.id', '=', 'contratos_alocados.subcontrato_id')
            ->join('servicos', 'servicos.id', '=', 'sub_contratos.servico_id')
            ->where('contrato_id', $contrato->contrato_id)
            ->get();
            $alocados_aviso_previo_cancelados += count($alocados); 
            $fee_aviso_cancelados += $contrato->fee;
        }

        $contratos_widget_cancelados = DB::select("
            SELECT c.id AS contrato_id FROM contratos c 
            WHERE c.data_kickoff IS NOT NULL
            AND c.data_solicitacao_cancelamento IS NOT NULL 
            AND c.data_ultimo_dia IS NOT NULL
            AND c.data_ultimo_dia >= '$anoRef-01-01'
            AND c.data_ultimo_dia < '$data_hoje'
        ");
        foreach($contratos_widget_cancelados AS $contrato){
            $alocados = Contratos_alocados::select(
                'servicos.nome AS servico'
            )
            ->join('sub_contratos', 'sub_contratos.id', '=', 'contratos_alocados.subcontrato_id')
            ->join('servicos', 'servicos.id', '=', 'sub_contratos.servico_id')
            ->where('contrato_id', $contrato->contrato_id)
            ->get();
            $alocados_cancelados += count($alocados); 
        }

        $contratos_widget_ativos = DB::select("
            SELECT c.id AS contrato_id FROM contratos c 
            WHERE c.data_kickoff IS NOT NULL
            AND c.data_kickoff >= '$anoRef-01-01'
        ");
        foreach($contratos_widget_ativos AS $contrato){
            $alocados = Contratos_alocados::select(
                'servicos.nome AS servico'
            )
            ->join('sub_contratos', 'sub_contratos.id', '=', 'contratos_alocados.subcontrato_id')
            ->join('servicos', 'servicos.id', '=', 'sub_contratos.servico_id')
            ->where('contrato_id', $contrato->contrato_id)
            ->get();
            $alocados_ativos += count($alocados); 
        }

        $contratos_widget_pendentes = DB::select("
            SELECT c.id AS contrato_id FROM contratos c 
            WHERE c.data_kickoff IS NULL
        ");
        foreach($contratos_widget_pendentes AS $contrato){
            $alocados = Contratos_alocados::select(
                'servicos.nome AS servico'
            )
            ->join('sub_contratos', 'sub_contratos.id', '=', 'contratos_alocados.subcontrato_id')
            ->join('servicos', 'servicos.id', '=', 'sub_contratos.servico_id')
            ->where('contrato_id', $contrato->contrato_id)
            ->get();
            $alocdos_pedentes += count($alocados); 
        }

        


        $total_contratos = count($contratos_widget_aviso_previo_ativos) + count($contratos_widget_cancelados) 
        + count($contratos_widget_ativos) + count($contratos_widget_pendentes) + $alocdos_pedentes
        + $alocados_ativos + $alocados_cancelados + $alocados_aviso_previo_ativos;
        
        $net = (count($contratos_widget_ativos) + $alocados_ativos) - (count($contratos_widget_cancelados) + $alocados_cancelados);
        

        $anos_com_kickoff = DB::select("SELECT DATE_FORMAT(contratos.data_kickoff, \"%Y\") AS ano_filtro from contratos WHERE contratos.data_kickoff IS NOT NULL GROUP BY ano_filtro");




        return view('layouts.gestao.contratos', compact('infos_func', 'clientes', 'lista_servicos', 'contratos_pendentes',
        'contratos_ativos', 'contratos_cancelados', 'contratos_aviso_previo', 'net', 'total_contratos',
        'contratos_alocados', 'contratos_alocados_cancelados', 'contratos_alocados_aviso_previo',
        'anoRef', 'anos_com_kickoff', 'fee_pendentes', 'fee_ativos',
        'fee_cancelados', 'fee_aviso_previo', 'contratos_alocados_pendentes',
        'contratos_widget_aviso_previo_ativos', 'contratos_widget_aviso_previo_cancelados', 'contratos_widget_cancelados', 
        'contratos_widget_ativos', 'contratos_widget_pendentes', 'alocados_aviso_previo_ativos', 'alocados_aviso_previo_cancelados', 
        'alocdos_pedentes', 'alocados_cancelados', 'alocados_ativos', 'fee_aviso_cancelados'
        ));
    }

    public function adicionarFerramenta(Request $request){
        DB::insert("INSERT INTO clientes_acessos(contrato_id, acesso_login, acesso_senha, plataforma, cliente_id) VALUES('$request->contrato_id','$request->login','$request->senha','$request->ferramenta','$request->cliente_id')");
        return redirect()->back();
    }

    public function cliente_store(Request $request)
    {

        $briefing = $request->file('briefing');
        $analiseInicial = $request->file('analise_inicial');
        $raiox = $request->file('raiox');

        $contrato_create = Clientes::create(
            [
                'cnpj' => $request->cnpj,
                'razaosocial' => $request->razaosocial,
                'empresa' => $request->cliente,
                'cep' => $request->cep,
                'logradouro' => $request->endereco,
                'numero' => $request->numero,
                'complemento' => $request->complemento,
                'bairro' => $request->bairro,
                'cidade' => $request->cidade,
                'estado' => $request->uf,
                'site' => $request->site,
                'modelo_negocio' => $request->modelo_negocio,
                // 'analise_inicial' => $analiseInicial->getClientOriginalExtension(),
                // 'raio_x' => $raiox->getClientOriginalExtension(),
                'modelo_negocio' => $request->modelo_negocio,
                'nome_responsavel' => $request->resp_emp_nome,
                'email_responsavel' => $request->resp_emp_email,
                'telefone_responsavel' => $request->telefone_emp,
                'nome_responsavel_financeiro' => $request->resp_fin_nome,
                'email_responsavel_financeiro' => $request->resp_fin_email,
                'telefone_responsavel_financeiro' => $request->telefone_fin

            ]



        );
        if($request->file('foto') != null){
            $path = $request->file('foto')->storeAs(
                'clientes', 'cliente' . $contrato_create->id . '.jpeg', ['disk' => 'public']
            );
        }
        if($request->file('raiox') != null){
            $path = $request->file('raiox')->storeAs(
                'clientes', 'clienteraiox' . $contrato_create->id . '.' . $request->file('raiox')->getClientOriginalExtension(), ['disk' => 'public']
            );
        }
        if($request->file('analise_inicial') != null){
            $path = $request->file('analise_inicial')->storeAs(
                'clientes', 'clienteanalise_inicial' . $contrato_create->id. '.' . $request->file('analise_inicial')->getClientOriginalExtension(), ['disk' => 'public']
            );
        }
        if($request->file('briefing') != null){
            $path = $request->file('briefing')->storeAs(
                'clientes', 'clientebriefing' . $contrato_create->id. '.' . $request->file('briefing')->getClientOriginalExtension(), ['disk' => 'public']
            );
        }

        return redirect('/clientes')->with('msg', "cliente '$request->cliente' cadastrado com sucesso!");
    }

    public function contrato_store(Request $request)
    {

        // verificar se o contrato já existe.
        $data_hoje = date('Y/m/d');

        $contratos_registrados = 0;
        $contratos_ativos = 0;

        for ($i = 0; $i < count($request->servicos); $i++) {
            $servico_id = intval($request->servicos[$i]);

            $contrato = [];

            $verificar_contrato_ativo = DB::select("SELECT * FROM contratos WHERE (servico_id = $servico_id and cliente_id = $request->cliente_id) and (data_ultimo_dia is null or data_ultimo_dia > '$data_hoje')");

            if (count($verificar_contrato_ativo) > 0) {
                $contratos_ativos++;
            } else {
                $contrato = [
                    'servico_id' => $request->servicos[$i],
                    'cliente_id' => $request->cliente_id,
                    'origem' => $request->origem
                ];

                /***
                 * servico_id legenda
                 * 1 = MIDIA
                 * 2 = CRM
                 * 3 = SEO
                 * 4 = SOCIAL
                 * 5 = BLOG
                 * 6 = INFLUENCERS
                 * 7 = DEV
                 * 8 = CRIACAO
                 */
                switch ($contrato['servico_id']) {
                    case '1':
                        $contrato['canais_ativos_midia'] = $request->canais_ativosMIDIA;
                        $contrato['faixa_investimento_midia'] = $request->faixa_investimentoMIDIA;
                        $contrato['forma_pagamento_midia'] = $request->forma_pagamentoMIDIA;
                        $contrato['xml_midia'] = $request->xmlMIDIA;
                        $contrato['fee'] = $request->feeMIDIA;
                        break;
                    case '2':
                        $contrato['ferramentas_crm'] = $request->FerramentasCRM;
                        $contrato['disparos_semana_crm'] = $request->DisparosCRM;
                        $contrato['fee'] = $request->feeCRM;
                        break;
                    case '3':
                        $contrato['desenvolvimento_seo'] = $request->DesenvolvimentoSEO;
                        $contrato['conteudos_mes_seo'] = $request->conteudos_mesSEO;
                        $contrato['conteudos_blog_seo'] = $request->conteudos_blogSEO;
                        $contrato['implementacao_seo'] = $request->implementacaoSEO;
                        $contrato['total_conteudos_seo'] = $request->conteudos_mesSEO + $request->conteudos_blogSEO;
                        $contrato['fee'] = $request->feeSEO;
                        break;
                    case '4':
                        $contrato['posts_semana_social'] = $request->posts_semanaSOCIAL;
                        $contrato['budget_impulsionamento_social'] = $request->budget_impulsionamentoSOCIAL;
                        $contrato['gerenciamento_redes_sociais_social'] = $request->gerenciamentoSOCIAL;
                        $contrato['fee'] = $request->feeSOCIAL;
                        break;
                    case '5':
                        $contrato['conteudos_mes_blog'] = $request->Conteudos_mesBLOG;
                        $contrato['pautas_blog'] = $request->pautasBLOG;
                        $contrato['fee'] = $request->feeBLOG;
                        break;
                    case '6':
                        $contrato['tipo_contrato_influenciadores'] = $request->tipo_contratoINFLUENCERS;
                        $contrato['escopo_influeniadores'] = $request->influencers_escopoINFLUENCERS;
                        $contrato['fee'] = $request->feeINFLUENCERS;
                        break;
                    case '8':
                            $contrato['fee'] = $request->feeCRIACAO;
                            break;
                    case '8':
                        $contrato['fee'] = $request->feeDEV;
                        break;

                    default:
                        break;
                }

                
                $contrato_create = Contratos::create($contrato);
                if($request->file('briefingBLOG') != null && $contrato['servico_id'] == '11'){
                    $path = $request->file('briefingBLOG')->storeAs(
                        'clientes/contratos', 'briefing_contrato' . $contrato_create->id . "_cliente.".$request->cliente_id."" .$request->file('briefingBLOG')->getClientOriginalExtension(), ['disk' => 'public']
                    );
                    $path = explode("/", $path);
                    $path = $path[count($path) - 1];
                    DB::update("update contratos set briefing = '$path' where id = '$contrato_create->id'");
                }
                if($request->file('briefingCRM') != null && $contrato['servico_id'] == '4'){
                    $path = $request->file('briefingCRM')->storeAs(
                        'clientes/contratos', 'briefing_contrato' . $contrato_create->id . "_cliente.".$request->cliente_id."" .$request->file('briefingCRM')->getClientOriginalExtension(), ['disk' => 'public']
                    );
                    $path = explode("/", $path);
                    $path = $path[count($path) - 1];
                    DB::update("update contratos set briefing = '$path' where id = '$contrato_create->id'");
                }
                if($request->file('briefingDEV') != null && $contrato['servico_id'] == '15'){
                    $path = $request->file('briefingDEV')->storeAs(
                        'clientes/contratos', 'briefing_contrato' . $contrato_create->id . "_cliente.".$request->cliente_id."" .$request->file('briefingDEV')->getClientOriginalExtension(), ['disk' => 'public']
                    );
                    $path = explode("/", $path);
                    $path = $path[count($path) - 1];
                    DB::update("update contratos set briefing = '$path' where id = '$contrato_create->id'");
                }
                if($request->file('briefingMIDIA') != null && $contrato['servico_id'] == '2'){
                    $path = $request->file('briefingMIDIA')->storeAs(
                        'clientes/contratos', 'briefing_contrato' . $contrato_create->id . "_cliente.".$request->cliente_id."" .$request->file('briefingMIDIA')->getClientOriginalExtension(), ['disk' => 'public']
                    );
                    $path = explode("/", $path);
                    $path = $path[count($path) - 1];
                    DB::update("update contratos set briefing = '$path' where id = '$contrato_create->id'");
                }
                if($request->file('briefingINFLUENCERS') != null && $contrato['servico_id'] == '12'){
                    $path = $request->file('briefingINFLUENCERS')->storeAs(
                        'clientes/contratos', 'briefing_contrato' . $contrato_create->id . "_cliente.".$request->cliente_id."" .$request->file('briefingINFLUENCERS')->getClientOriginalExtension(), ['disk' => 'public']
                    );
                    $path = explode("/", $path);
                    $path = $path[count($path) - 1];
                    DB::update("update contratos set briefing = '$path' where id = '$contrato_create->id'");
                }
                if($request->file('briefingSEO') != null && $contrato['servico_id'] == '7'){
                    $path = $request->file('briefingSEO')->storeAs(
                        'clientes/contratos', 'briefing_contrato' . $contrato_create->id . "_cliente.".$request->cliente_id."" .$request->file('briefingSEO')->getClientOriginalExtension(), ['disk' => 'public']
                    );
                    $path = explode("/", $path);
                    $path = $path[count($path) - 1];
                    DB::update("update contratos set briefing = '$path' where id = '$contrato_create->id'");
                }
                if($request->file('briefingSOCIAL') != null && $contrato['servico_id'] == '8'){
                    $path = $request->file('briefingSOCIAL')->storeAs(
                        'clientes/contratos', 'briefing_contrato' . $contrato_create->id . "_cliente".$request->cliente_id."." . $request->file('briefingSOCIAL')->getClientOriginalExtension(), ['disk' => 'public']
                    );
                    $path = explode("/", $path);
                    $path = $path[count($path) - 1];
                    DB::update("update contratos set briefing = '$path' where id = '$contrato_create->id'");
                }
                $contratos_registrados++;
            }
        }
        return redirect(route('contratos_view'))->with('msg', "$contratos_registrados contratos registrados com sucesso, $contratos_ativos contratos que ja estavam ativos");
    }

    public function ativar_contrato(int $id, Request $request)
    {
        $contrato = Contratos::find($id);
        if ($request->fee) {
            $contrato->data_kickoff = $request->data_kickoff;
            $contrato->fee = $request->fee;
            $contrato->save();
        } else {
            $contrato->data_kickoff = $request->data_kickoff;
            $contrato->save();
        }
    }

    public function cancelar_contrato(int $id, Request $request)
    {

        $status = Array('status' => true);

        $contrato = Contratos::find($id);
        if($request->data_cancelar > $contrato->data_kickoff && $request->data_ultimo_dia > $contrato->data_kickoff){
            $contrato->data_solicitacao_cancelamento = $request->data_cancelar;
            $contrato->data_ultimo_dia = $request->data_ultimo_dia;
            $contrato->save();
            return json_encode($status);
        }else{
            $status['status'] = false;
            return json_encode($status);
        }

    }

    public function atualizar_contrato(Request $request){
        $request = $request->all();
        $id = $request['id'];
        unset($request['id']);
        unset($request['_token']);
        $keys = array_keys($request);
        for($i = 0; $i < count($keys); $i++){
            if($request[$keys[$i]] != null){
                DB::update("UPDATE contratos SET ".$keys[$i]." = '".$request[$keys[$i]]."' WHERE id = ".$id."");
            }
        }
        return redirect(route('contratos_view'))->with('msg', "Contratos atualizados!");
    }

    public function alocar_servico(Request $request)
    {
        $contrato_id = $request->contrato_id;
        $alocados = $request->alocados;
        foreach($alocados as $alocado){
            $name = DB::select("SELECT servicos.nome FROM servicos WHERE servicos.id = '$alocado'");
            $name = $name[0]->nome;

            $id = DB::table('sub_contratos')->insertGetId(
                [ 'nome' => $name, 'servico_id' => $alocado ]
            );

            $id = DB::table('contratos_alocados')->insertGetId(
                [
                    'status' => 'ativo',
                    'contrato_id' => $contrato_id,
                    'subcontrato_id' => $id
                ]
            );
        }
        return redirect(route('contratos_view'))->with('msg', "Contratos alocados!");
    }


    public function excluir_contrato(Request $request){
        $alocados = DB::select("SELECT * FROM contratos_alocados WHERE contrato_id = '$request->contrato_id'");

        foreach($alocados AS $alocado){
            $deleted = DB::table('sub_contratos')->where('id', '=', $alocado->subcontrato_id)->delete();
        }

        $deleted = DB::table('contratos_alocados')->where('contrato_id', '=', $request->contrato_id)->delete();

        $deleted = DB::table('contratos')->where('id', '=', $request->contrato_id)->delete();

        return redirect(route('contratos_view'))->with('msg', "Contrato excluido!");
    }

    public function atualizar_cliente(Request $request){

        $clienteRepository = new ClientesRepository();

        $cliente = $clienteRepository->findOne($request->id);

        $briefing = null;
        $ext = "";

        if($request->file('foto') != null){
            $path = $request->file('foto')->storeAs(
                'clientes', 'cliente' . $request->id . '.jpeg', ['disk' => 'public']
            );
        }

        if($request->file('briefing') != null){
            $ext = $request->file('briefing')->getClientOriginalExtension();
            $path = $request->file('briefing')->storeAs(
                'clientes', 'clientebriefing' . $request->id. '.' . $ext, ['disk' => 'public']
            );
            $briefing = $path;
        }

        $clienteRepository->update($cliente, $request, $ext);

        return redirect()->back();
    }

    public function visao_ativos_view(FuncionarioInfo $funcionarioInfo, Request $request){
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);

        // $clientes = DB::select("SELECT c.empresa, c.id FROM clientes c ORDER BY c.empresa ASC");

        /**
         * Busca dos dados para tratamento
         */
        $dados = DB::select('
        SELECT 
        c.id AS cliente_id, c.empresa, c.projetos,
        c2.id AS contrato_id, c2.data_kickoff, c2.fee, c2.data_solicitacao_cancelamento, c2.data_ultimo_dia, 
        s.nome AS servico,
        sc.nome AS contrato_alocado
        FROM clientes c 
        LEFT JOIN contratos c2 ON c2.cliente_id = c.id 
        LEFT JOIN contratos_alocados ca ON ca.contrato_id = c2.id
        LEFT JOIN sub_contratos sc ON ca.subcontrato_id = sc.id
        LEFT JOIN servicos s ON c2.servico_id = s.id
        WHERE c2.id IS NOT NULL
        ORDER BY c.id
        ');

        $clientes = [];

        while(count($dados) > 0){

            $id = $dados[array_key_first($dados)]->cliente_id;

            $contratos_cliente = array_filter($dados, function($dados) use($id){
                return $dados->cliente_id == $id;
              });

            $cliente = [
                'cliente_id' => $contratos_cliente[array_key_first($contratos_cliente)]->cliente_id, 
                'empresa' => $contratos_cliente[array_key_first($contratos_cliente)]->empresa, 
                'projetos' => $contratos_cliente[array_key_first($contratos_cliente)]->projetos, 
                'contratos' => []
            ];

            while(count($contratos_cliente) > 0){
                $id_contrato = $contratos_cliente[array_key_first($contratos_cliente)]->contrato_id;
                $contratos = array_filter($contratos_cliente, function($contratos_cliente) use($id_contrato){
                    return $contratos_cliente->contrato_id == $id_contrato;
                  });
                
                $contratos_alocados = [];

                foreach($contratos AS $contrato){
                    if($contrato->contrato_alocado != null){
                        array_push($contratos_alocados, [
                            'servico' => $contrato->contrato_alocado
                        ]);
                    }
                }

                array_push($cliente['contratos'], [
                    'contrato_id' => $contratos_cliente[array_key_first($contratos_cliente)]->contrato_id,
                    'data_kickoff' => $contratos_cliente[array_key_first($contratos_cliente)]->data_kickoff,
                    'fee' => $contratos_cliente[array_key_first($contratos_cliente)]->fee,
                    'data_solicitacao_cancelamento' => $contratos_cliente[array_key_first($contratos_cliente)]->data_solicitacao_cancelamento,
                    'data_ultimo_dia' => $contratos_cliente[array_key_first($contratos_cliente)]->data_ultimo_dia,
                    'servico' => $contratos_cliente[array_key_first($contratos_cliente)]->servico,
                    'contrato_alocado' => $contratos_alocados
                ]);

                $contratos_cliente = array_filter($contratos_cliente, function($contratos_cliente) use($id_contrato){
                    return $contratos_cliente->contrato_id != $id_contrato;
                  });
                
            }

            $dados = array_filter($dados, function($dados) use($id){
                return $dados->cliente_id != $id;
              });

            array_push($clientes, $cliente);
        }

        $clientes = array_filter($clientes, function($clientes) {
            return count($clientes['contratos']) > 0;
          });

        return view("layouts.gestao.visaoAtivos", compact('infos_func', 'clientes'));
    }

    private function filtros_tabela_ativos_contratos_ativos(Request $request, $dados){
        /**
         * Filtro de cliente
         */
        if(isset($request->cliente_id)){
            $dados = array_filter($dados, function($dados) use($request){
                return $dados->cliente_id == $request->cliente_id;
              });
        }

        /**
         * Filtro data inicial fee
         */
        if(isset($request->fee_inicial)){
            $dados = array_filter($dados, function($dados) use($request){
                return $dados->fee >= $request->fee_inicial;
              });
        }

        /**
         * Filtro data final fee
         */
        if(isset($request->fee_final)){
            $dados = array_filter($dados, function($dados) use($request){
                return $dados->fee <= $request->fee_final;
              });
        }

        return $dados;

    }

    private function filtros_tabela_cancelados_contratos_ativos(Request $request, $dados){
        /**
         * Filtro de cliente
         */
        if(isset($request->cliente_id)){
            $dados = array_filter($dados, function($dados) use($request){
                return $dados->cliente_id == $request->cliente_id;
              });
        }

        /**
         * Filtro inicial fee
         */
        if(isset($request->fee_inicial)){
            $dados = array_filter($dados, function($dados) use($request){
                return $dados->fee >= $request->fee_inicial;
              });
        }

        /**
         * Filtro final fee
         */
        if(isset($request->fee_final)){
            $dados = array_filter($dados, function($dados) use($request){
                return $dados->fee <= $request->fee_final;
              });
        }


        return $dados;

    }

    private function filtros_gerais_contratos_ativos(Request $request, $dados){
        /**
         * Filtro de cliente
         */
        if(isset($request->cliente_id)){
            $dados = array_filter($dados, function($dados) use($request){
                return $dados->cliente_id == $request->cliente_id;
              });
        }

        /**
         * Filtro data inicial kickoff
         */
        if(isset($request->data_kickoff_inicial)){
            $dados = array_filter($dados, function($dados) use($request){
                return date(strtotime($dados->data_kickoff)) >= date(strtotime($request->data_kickoff_inicial));
              });
        }

        /**
         * Filtro data final kickoff
         */
        if(isset($request->data_kickoff_final)){
            $dados = array_filter($dados, function($dados) use($request){
                return date(strtotime($dados->data_kickoff)) <= date(strtotime($request->data_kickoff_final));
              });
        }

        /**
         * Filtro data inicial cancelamento
         */
        if(isset($request->data_cancelamento_inicial)){
            $dados = array_filter($dados, function($dados) use($request){
                return date(strtotime($dados->data_ultimo_dia)) >= date(strtotime($request->data_cancelamento_inicial));
              });
        }

        /**
         * Filtro data final cancelamento
         */
        if(isset($request->data_cancelamento_final)){
            $dados = array_filter($dados, function($dados) use($request){
                return date(strtotime($dados->data_ultimo_dia)) <= date(strtotime($request->data_cancelamento_final));
              });
        }

        /**
         * Filtro data inicial fee
         */
        if(isset($request->fee_inicial)){
            $dados = array_filter($dados, function($dados) use($request){
                return $dados->fee >= $request->fee_inicial;
              });
        }

        /**
         * Filtro data final fee
         */
        if(isset($request->fee_final)){
            $dados = array_filter($dados, function($dados) use($request){
                return $dados->fee <= $request->fee_final;
              });
        }

        /**
         * Filtro projetos
         */
        if(isset($request->projetos) && $request->projetos == 1){
            $dados = array_filter($dados, function($dados) use($request){
                return $dados->projetos == "Sim";
              });
        }

        return $dados;
    }

    public function upload_tabela_financeira(Request $request){
        if($request->file('tabela_financeira') != null){
            $path = $request->file('tabela_financeira')->storeAs(
                'tabelas_financeiras', 'tabela_cliente' . $request->id . '.jpeg', ['disk' => 'public']
            );
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }

    public function upload_briefing(Request $request){
        if($request->file('briefing') != null){
            $path = $request->file('briefing')->storeAs(
                'briefings', 'briefing_contrato' . $request->id . '.pdf', ['disk' => 'public']
            );
            DB::update("UPDATE contratos c SET briefing = '$path' WHERE c.id = '$request->id'");
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }

    public function upload_escopo(Request $request){
        if($request->file('escopo') != null){
            $path = $request->file('escopo')->storeAs(
                'escopos', 'escopo_contrato' . $request->id . '.pdf', ['disk' => 'public']
            );
            DB::update("UPDATE contratos c SET escopo = '$path' WHERE c.id = '$request->id'");
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }

    public function classificacoes_view(FuncionarioInfo $funcionarioInfo){
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);

        $lista_clientes = DB::SELECT("SELECT c.empresa AS cliente, 
        IFNULL(cc.volume, '0') AS volume, 
        IFNULL(cc.updated_at , 'Sem dados') AS updated_at, 
        ROUND(SUM(c2.fee), 2) AS fee  FROM clientes c 
        LEFT JOIN cliente_classificacoes cc ON c.id = cc.cliente_id 
        LEFT JOIN contratos c2 ON c2.cliente_id = c.id 
        WHERE (c2.data_ultimo_dia IS NULL OR c2.data_ultimo_dia > NOW()) AND c.empresa != '' AND fee IS NOT NULL AND fee > 0
        GROUP BY c.empresa, cc.volume, cc.updated_at");

        foreach ($lista_clientes AS $cliente){
            if(($cliente->volume >= 0 && $cliente->volume < 184000) || ($cliente->fee >= 1000 && $cliente->fee < 30000)){
                $cliente->classificacao = 'PME';
            }
            if(($cliente->volume >= 184000 && $cliente->volume < 368000) || ($cliente->fee >= 30000 && $cliente->fee < 146774)){
                $cliente->classificacao = 'Grande';
            }
            if($cliente->volume >= 368000 || $cliente->fee >= 146774 ){
                $cliente->classificacao = 'Enterprise';
            }
        }

        $lista_clientes = json_encode((array) $lista_clientes);

        return view('layouts.gestao.clientes-classificacoes', compact('infos_func', 'lista_clientes'));
    }

    public function atualizar_classificacoes(Request $request){

        $clienteClassificacoes = new ClientesClassificacoes();
        

        $lista_clientes = DB::SELECT("SELECT c.id AS cliente_id, 
        IFNULL(cc.volume, '0') AS volume, 
        IFNULL(cc.updated_at , 'Sem dados') AS updated_at, 
        ROUND(SUM(c2.fee), 2) AS fee  FROM clientes c 
        LEFT JOIN cliente_classificacoes cc ON c.id = cc.cliente_id 
        LEFT JOIN contratos c2 ON c2.cliente_id = c.id 
        WHERE (c2.data_ultimo_dia IS NULL OR c2.data_ultimo_dia > NOW()) AND c.empresa != '' AND fee IS NOT NULL AND fee > 0
        GROUP BY c.id, cc.volume, cc.updated_at ORDER BY c.empresa ASC");

        for($i = 0; $i < count($request->volumes); $i++){
            $volume = $request->volumes[$i];
            $id = $lista_clientes[$i]->cliente_id;
            $clienteClassificacoes = ClientesClassificacoes::updateOrCreate(
                ['cliente_id' => $id],
                ['volume' => $volume, 'cliente_id' => $id]
            );
            // DB::update("UPDATE cliente_classificacoes SET volume = '$volume' WHERE cliente_classificacoes.cliente_id = '$id'");
        }

        return redirect()->back();
    }

    public function contrato_assinados(Request $request){
        $result = DB::insert("INSERT INTO contrato_assinados (cliente_id, data_assinatura, observacao) VALUES ('$request->cliente_id', '$request->data_assinatura', '$request->observacao')");
        return redirect()->back();
    }
    

}
