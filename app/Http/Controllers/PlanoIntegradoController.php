<?php

namespace App\Http\Controllers;

use App\Services\FuncionarioInfo;
use App\Services\PlanosIntegrados;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlanoIntegradoController extends Controller

{
    // VIEWS

    public function cadastrar_plano_integrado_view(Request $request, FuncionarioInfo $funcionarioInfo)
    {

        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);

        return view('layouts.plano-integrado.cadastrar-plano-integrado', compact('infos_func'));
    }

    public function cadastrar_demanda_view(Request $request, FuncionarioInfo $funcionarioInfo, PlanosIntegrados $planosIntegrados)
    {

        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);

        $clientes_nomes = $planosIntegrados->NomesBoards();

        sort($clientes_nomes);

        $demandas = $planosIntegrados->DemandasNaoObrigatorias();

        return view('layouts.plano-integrado.cadastrar-demanda', compact('infos_func', 'clientes_nomes', 'demandas'));
    }

    public function boards_integrado_view(Request $request, PlanosIntegrados $planosIntegrados, FuncionarioInfo $funcionarioInfo){

        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);

        $total_demandas = $planosIntegrados->QuantidadeDemandas();

        $status_consolidado = $planosIntegrados->QuantidadeDemandasPorStatus();

        $boards_ids = $planosIntegrados->BoardsIds();

        $termometro = $planosIntegrados->TermometroResumo($boards_ids, $total_demandas, $status_consolidado);

        return view('layouts.plano-integrado.boards-integrados', compact('total_demandas', 'status_consolidado', 'termometro', 'infos_func'));
    }

    // STORE

    public function cadastrar_plano_integrado_store(Request $request, FuncionarioInfo $funcionarioInfo)
    {
        $servicos_arr = $request->servicos;
        $servicos_array = $request->servicos;
        $cliente_name = mb_strtoupper($request->cliente, "UTF-8");
        $email = $request->email;

        $servicos = implode(",", $request->servicos);

        // Duplicar plano integrado. 

        $api_monday_url = 'https://api.monday.com/v2';
        $token_monday = 'eyJhbGciOiJIUzI1NiJ9.eyJ0aWQiOjk2OTEyNjIzLCJ1aWQiOjEwODM0NDUyLCJpYWQiOiIyMDIxLTAxLTIyVDE2OjQ1OjAwLjAwMFoiLCJwZXIiOiJtZTp3cml0ZSIsImFjdGlkIjo0NzE2MTU3LCJyZ24iOiJ1c2UxIn0.60yaZcyCzfr6Al4D0rZKyHzSsNWiSM78a0JywzU3M2E';
        $headers = ['Content-Type: application/json', 'Authorization: ' . $token_monday];
        $query = 'mutation ($cliente_name: String!) { duplicate_board(board_id:1676009215, board_name:$cliente_name, keep_subscribers:true, duplicate_type: duplicate_board_with_structure) { board {id} } }';

        $vars = [
            'cliente_name' => '['.$cliente_name.'] <> PLANO DE AÇÃO INTEGRADO YOOPER',
        ];

        $data = @file_get_contents($api_monday_url, false, stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => $headers,
                'content' => json_encode(['query' => $query, 'variables' => $vars]),
            ]
        ]));


        $data_encode = json_decode($data);

        $id_novo = $data_encode->data->duplicate_board->board->id;
        $plataforma = $servicos_arr = $request->plataforma;
        $facebook_id = $servicos_arr = $request->facebook_id;



        // Cadastrar no board de boards
        $query_boards = 'mutation ($board_id: Int!, $myItemName: String!, $columnVals: JSON!) { create_item (board_id:$board_id, item_name:$myItemName, column_values:$columnVals, create_labels_if_missing: true) { id } }';

        $vars_boards = [
            'board_id' => 1474958015,
            'myItemName' =>$cliente_name." | PLANO INTEGRADO",
            'columnVals' => json_encode([
                'status'=> "Inativo",
                'texto' => $id_novo,
                'lista_suspensa0' => $plataforma,
                'texto8' => $facebook_id,
                'texto50' => $email,
                'lista_suspensa' => $servicos         
            ])
        ];

        $data_boards = @file_get_contents($api_monday_url, false, stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => $headers,
                'content' => json_encode(['query' => $query_boards, 'variables' => $vars_boards]),
            ]
        ]));



        for ($i = 0; $i < count($servicos_array); $i++) {

            $demandas = DB::select("SELECT * FROM onb_demandas WHERE obrigatoria = 'Sim' AND servico = '$servicos_array[$i]'");

            for ($j=0; $j < count($demandas) ; $j++) { 
                $query_criar_obrigatorias = 'mutation ($board_id: Int!, $myItemName: String!, $columnVals: JSON!) { create_item (board_id:$board_id, item_name:$myItemName, column_values:$columnVals, create_labels_if_missing: true) { id } }';
                $vars_criar_obrigatorias = [
                    'board_id' => intval($id_novo),
                    'myItemName' => $demandas[$j]->nome,
                    'columnVals' => json_encode([
                        'lista_suspensa4' => $demandas[$j]->tipo_acao,
                        'status_1' => $demandas[$j]->servico,
                        'status_18'=> "Obrigatória"
                    ])
                ];    
                
                @file_get_contents($api_monday_url, false, stream_context_create([
                    'http' => [
                        'method' => 'POST',
                        'header' => $headers,
                        'content' => json_encode(['query' => $query_criar_obrigatorias, 'variables' => $vars_criar_obrigatorias]),
                    ]
                ]));

            }


        };

        return redirect('/cadastrar-plano-integrado');
    }

    public function cadastrar_demanda_store(Request $request, FuncionarioInfo $funcionarioInfo, PlanosIntegrados $planosIntegrados)
    {
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        $quantidade = $request->quantidade;
        $clientes_nomes = $planosIntegrados->NomesBoards();
        sort($clientes_nomes);
        $demandas = $planosIntegrados->DemandasNaoObrigatorias();
        $api_monday_url = 'https://api.monday.com/v2';
        $token_monday = 'eyJhbGciOiJIUzI1NiJ9.eyJ0aWQiOjk2OTEyNjIzLCJ1aWQiOjEwODM0NDUyLCJpYWQiOiIyMDIxLTAxLTIyVDE2OjQ1OjAwLjAwMFoiLCJwZXIiOiJtZTp3cml0ZSIsImFjdGlkIjo0NzE2MTU3LCJyZ24iOiJ1c2UxIn0.60yaZcyCzfr6Al4D0rZKyHzSsNWiSM78a0JywzU3M2E';
        $headers = ['Content-Type: application/json', 'Authorization: ' . $token_monday];

        $id_board = intval($request->cliente_lista);

        $query_groups = 'query {
            boards (ids: '.$id_board.') {
                groups () {
                    title
                    id
                }
            }
        }';

        $data = @file_get_contents($api_monday_url, false, stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => $headers,
                'content' => json_encode(['query' => $query_groups]),
                ]
        ]));
        $groups = json_decode($data);
        $groups = $groups->data->boards[0]->groups;
        $a = 0;
       
        
        $explode_ref = explode('/', $request->referencia_lista);
        if (count($explode_ref) > 1) {
            $referencia = $explode_ref[0];
            $ano = $explode_ref[1];
        }

        if ($referencia == "JAN") {
            $referencia = "JANEIRO/$ano";
        } elseif ($referencia == "FEV") {
            $referencia = "FEVEREIRO/$ano";
        } elseif ($referencia == "MAR") {
            $referencia = "MARÇO/$ano";
        } elseif ($referencia == "ABR") {
            $referencia = "ABRIL/$ano";
        } elseif ($referencia == "MAI") {
            $referencia = "MAIO/$ano";
        } elseif ($referencia == "JUN") {
            $referencia = "JUNHO/$ano";
        } elseif ($referencia == "JUL") {
            $referencia = "JULHO/$ano";
        } elseif ($referencia == "AGO") {
            $referencia = "AGOSTO/$ano";
        } elseif ($referencia == "SET") {
            $referencia = "SETEMBRO/$ano";
        } elseif ($referencia == "OUT") {
            $referencia = "OUTUBRO/$ano";
        } elseif ($referencia == "NOV") {
            $referencia = "NOVEMBRO/$ano";
        } elseif ($referencia == "DEZ") {
            $referencia = "DEZEMBRO/$ano";
        } else {
            $referencia = "sem-referencia";
        }

        $group_id = "";
        $a = 0;
        while ($group_id == "") { 

            if ($groups[$a]->title == $referencia) {
                $group_id = $groups[$a]->id;
            }
            $a++;
        }       
        if($group_id){
            for ($i=0; $i < $quantidade; $i++) { 
                $query = 'mutation ($id_board: Int!, $myItemName: String!, $columnVals: JSON!, $group_id: String!) { create_item (board_id:$id_board, item_name:$myItemName, group_id:$group_id ,column_values:$columnVals,  create_labels_if_missing: true) { id } }';
    
                $vars = [
                    'group_id' => $group_id,
                    'id_board' => intval($request->cliente_lista),
                    'myItemName' => $request->demanda[$i],
                    'columnVals' => json_encode([
                        'lista_suspensa4' => $request->tipo_demanda,
                        'status_1' => $request->servico_demanda,
                        'dup__of_ref' => $request->referencia_lista,
                        'status_18'=> "Desejável"
                    ])
                ];
        
                $data = @file_get_contents($api_monday_url, false, stream_context_create([
                    'http' => [
                        'method' => 'POST',
                        'header' => $headers,
                        'content' => json_encode(['query' => $query, 'variables' => $vars]),
                    ]
                ]));
            }
        }    
        
        return redirect('/plano-integrado/cadastrar-demanda');
    }

    // CLIENTES

    public function clientes(Request $request, PlanosIntegrados $planosIntegrados, FuncionarioInfo $funcionarioInfo){

        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);

        // $total_demandas = $planosIntegrados->QuantidadeDemandas();

        // $status_consolidado = $planosIntegrados->QuantidadeDemandasPorStatus();

        // $boards_ids = $planosIntegrados->BoardsIds();

        // $termometro = $planosIntegrados->TermometroResumo($boards_ids, $total_demandas, $status_consolidado);

        return view('layouts.plano-integrado.boards-clientes', compact('infos_func'));
    }
}
