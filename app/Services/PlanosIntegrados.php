<?php

namespace App\Services;


use Illuminate\Support\Facades\DB;

class PlanosIntegrados
{

    public function QuantidadeDemandas()
    {
        return DB::table('onb_boards_integrados')->count();
    }

    public function QuantidadeDemandasPorStatus()
    {
        $total_status = DB::select('SELECT status_demanda, COUNT(*) as quantidade FROM onb_boards_integrados GROUP BY status_demanda');

        $status_consolidado = [];
        $i = 0;
        while ($i < count($total_status)) {
            $status_consolidado[$total_status[$i]->status_demanda] = $total_status[$i]->quantidade;

            $i++;
        }

        return $status_consolidado;
    }


    public function NomesBoards()
    {

        $token = 'eyJhbGciOiJIUzI1NiJ9.eyJ0aWQiOjk2OTEyNjIzLCJ1aWQiOjEwODM0NDUyLCJpYWQiOiIyMDIxLTAxLTIyVDE2OjQ1OjAwLjAwMFoiLCJwZXIiOiJtZTp3cml0ZSIsImFjdGlkIjo0NzE2MTU3LCJyZ24iOiJ1c2UxIn0.60yaZcyCzfr6Al4D0rZKyHzSsNWiSM78a0JywzU3M2E';
        $apiUrl = 'https://api.monday.com/v2';
        $headers = ['Content-Type: application/json', 'Authorization: ' . $token];
        $query_boards_clientes = 'query { items_by_column_values(board_id: 1474958015, column_id: "status", column_value: "Ativo") { id name column_values { id text title value }}}';

        $data = @file_get_contents($apiUrl, false, stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => $headers,
                'content' => json_encode(['query' => $query_boards_clientes]),
            ]
        ]));

        $data = json_decode($data, true);

        $items = $data['data']['items_by_column_values'];
        $clientes_dados = [];
        $i = 0;
        while ($i < count($items)) {
            $nome = $items[$i]['name'];
            $nome = explode(" | ", $nome);
            $nome_cliente = $nome[0];

            $columns_items = $items[$i]["column_values"];

            $a = 0;
            while ($a < count($columns_items)) { //lista todas os items
                if ($columns_items[$a]["id"] == "texto") {
                    $id = json_decode($columns_items[$a]["text"]);
                }
                $a++;
            }
            $dados = [];
            $dados = [
                "nome" => $nome_cliente,
                "id_board" => $id
            ];

            array_push($clientes_dados, $dados);
            $i++;
        }

        return $clientes_dados;
    }

    public function BoardsIds()
    {

        $token = 'eyJhbGciOiJIUzI1NiJ9.eyJ0aWQiOjk2OTEyNjIzLCJ1aWQiOjEwODM0NDUyLCJpYWQiOiIyMDIxLTAxLTIyVDE2OjQ1OjAwLjAwMFoiLCJwZXIiOiJtZTp3cml0ZSIsImFjdGlkIjo0NzE2MTU3LCJyZ24iOiJ1c2UxIn0.60yaZcyCzfr6Al4D0rZKyHzSsNWiSM78a0JywzU3M2E';
        $apiUrl = 'https://api.monday.com/v2';
        $headers = ['Content-Type: application/json', 'Authorization: ' . $token];
        $query_boards_clientes = 'query { items_by_column_values(board_id: 1474958015, column_id: "status", column_value: "Ativo") { id name column_values { id text title value }}}';

        $data = @file_get_contents($apiUrl, false, stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => $headers,
                'content' => json_encode(['query' => $query_boards_clientes]),
            ]
        ]));

        $data = json_decode($data, true);

        $boards_ids = [];
        $items = $data['data']['items_by_column_values'];

        $i = 0;
        while ($i < count($items)) {
            $columns_items = $items[$i]["column_values"];

            $a = 0;
            while ($a < count($columns_items)) { //lista todas os items
                if ($columns_items[$a]["id"] == "texto") {
                    $id = json_decode($columns_items[$a]["text"]);
                }
                $a++;
            }
            array_push($boards_ids, $id);
            $i++;
        }

        return $boards_ids;
    }

    public function DemandasNaoObrigatorias(){
        return DB::select('SELECT * FROM onb_demandas WHERE obrigatoria = "Não"');
    }

    public function TermometroResumo($boardsIds)
    {
        $dados = [];
        $i = 0;
        while ($i < count($boardsIds)) {
            $sql_demandas_total = DB::select('SELECT COUNT(*) as quantidade FROM onb_boards_integrados WHERE id_board =' . $boardsIds[$i]);
            if ($sql_demandas_total > 0) {

                $informacao = DB::select('SELECT cliente FROM onb_boards_integrados WHERE id_board =' . $boardsIds[$i] . ' LIMIT 1');

                if ($informacao) {
                    $cliente = explode(" <> ", $informacao[0]->cliente)[0];
                    $cliente = str_replace(array('[', ']'), "", $cliente);
                } else {
                    $cliente = $boardsIds[$i];
                }

                $total_demandas = $sql_demandas_total[0]->quantidade;


                $total_status_cliente = DB::select('SELECT status_demanda, COUNT(*) as quantidade FROM onb_boards_integrados WHERE id_board =' . $boardsIds[$i] . ' GROUP BY status_demanda');

                $status_consolidado = [];
                $a = 0;
                while ($a < count($total_status_cliente)) {
                    $status_consolidado[$total_status_cliente[$a]->status_demanda] = $total_status_cliente[$a]->quantidade;

                    $a++;
                }

                if (array_key_exists("Feito", $status_consolidado)) {
                    $porcentagem = number_format(($status_consolidado["Feito"] / $total_demandas) * 100, 2);

                    if ($porcentagem >= 89) {
                        $situacao = "Bom";
                    } else if ($porcentagem >= 79 && $porcentagem < 89) {
                        $situacao = "Aceitável";
                    } else if ($porcentagem >= 50 && $porcentagem < 79) {
                        $situacao = "Ruim";
                    } else {
                        $situacao = "Crítico";
                    }
                } else {
                    $situacao = "Crítico";
                    $porcentagem = 0;
                }

                $dado = [];
                $dado = [
                    "Cliente" => $cliente,
                    "id_board" => $boardsIds[$i],
                    "Situação" => $situacao,
                    "Total demandas" => $total_demandas,
                    "Porcentagem" => $porcentagem,
                ];
                $i++;

                array_push($dados, $dado);
            }
        }

        return $dados;
    }

    public function TermometroSituacao($status_consolidado, $total_demandas)
    {

        $porcentagem = ($status_consolidado["Feito"] / $total_demandas) * 100;

        if ($porcentagem >= 89) {
            $situacao = "Bom";
        } else if ($porcentagem >= 79 && $porcentagem < 89) {
            $situacao = "Aceitável";
        } else if ($porcentagem >= 50 && $porcentagem < 79) {
            $situacao = "Ruim";
        } else {
            $situacao = "Crítico";
        }

        return $situacao;
    }

    public function QuantidadeDemandasIndividual(int $board_id)
    {
        return DB::table('onb_boards_integrados')->where('id_board', '=', $board_id)->count();
    }

    public function QuantidadeDemandasPorStatusIndividual(int $board_id)
    {
        $total_status = DB::select('SELECT status_demanda, COUNT(*) as quantidade FROM onb_boards_integrados WHERE id_board = ' . $board_id . ' GROUP BY status_demanda');

        $status_consolidado = [];
        $i = 0;
        while ($i < count($total_status)) {
            $status_consolidado[$total_status[$i]->status_demanda] = $total_status[$i]->quantidade;

            $i++;
        }

        return $status_consolidado;
    }

    public function ListarReferencias($board_id)
    {
        $sql_referencia = DB::select('SELECT referencia FROM onb_boards_integrados WHERE id_board =' . $board_id . ' GROUP BY referencia');

        $r = 0;
        while ($r < count($sql_referencia)) {
            $referencias[$r] = $sql_referencia[$r]->referencia;

            $r++;
        }

        return $referencias;
    }


    public function ListarStatus($board_id)
    {
        $sql_status_demanda = DB::select('SELECT status_demanda FROM onb_boards_integrados WHERE id_board =' . $board_id . ' GROUP BY status_demanda');

        $r = 0;
        while ($r < count($sql_status_demanda)) {
            $status_demanda[$r] = $sql_status_demanda[$r]->status_demanda;

            $r++;
        }
        return $status_demanda;
    }

    public function DemandasPorServico($board_id)
    {
        $sql_demandas_servico = DB::select('SELECT COUNT(servico) as quantidade, servico FROM onb_boards_integrados WHERE id_board =' . $board_id . ' GROUP BY servico');

        $r = 0;

        while ($r < count($sql_demandas_servico)) {
            $demandas_servico[$sql_demandas_servico[$r]->servico] = $sql_demandas_servico[$r]->quantidade;

            $r++;
        }

        return $demandas_servico;
    }




    public function Servicos($board_id)
    {
        $sql_servicos = DB::select('SELECT servico FROM onb_boards_integrados WHERE id_board =' . $board_id . ' GROUP BY servico');

        $r = 0;
        while ($r < count($sql_servicos)) {
            $servicos[$r] = $sql_servicos[$r]->servico;
            $r++;
        }

        return $servicos;
    }

    public function DemandasPorServico_Status_Total($board_id, $status_demandas, $servico)
    {

        $relatorio_total = [];
        $s = 0;
        while ($s < count($servico)) {
            $servico_atual = $servico[$s];
            $status = [];

            $sql_demandas_servico_status = DB::select("SELECT status_demanda, COUNT(status_demanda) as quantidade FROM onb_boards_integrados WHERE id_board = $board_id and servico = '$servico_atual' GROUP BY status_demanda ORDER BY servico");

            if ($sql_demandas_servico_status) {
                $si = 0;
                $total_servico = 0;
                while ($si < count($sql_demandas_servico_status)) {
                    $status[$sql_demandas_servico_status[$si]->status_demanda] =  $sql_demandas_servico_status[$si]->quantidade;
                    $total_servico = $total_servico + $sql_demandas_servico_status[$si]->quantidade;
                    $si++;
                }
            }

            if (array_key_exists("Feito", $status)) {
                $situacao = PlanosIntegrados::TermometroSituacao($status, $total_servico);
            } else {
                $status["Feito"] = 0;
                $situacao = PlanosIntegrados::TermometroSituacao($status, $total_servico);
            }

            $relatorio = [
                "servico" => $servico_atual,
                "status" => $status,
                "total_servico" => $total_servico,
                "Situação" => $situacao
            ];

            array_push($relatorio_total, $relatorio);

            $s++;
        }

        return $relatorio_total;
    }


    public function QuantidadeDemandasPorStatusIndividual_Mensal(int $board_id, $referencias, $servicos)
    {

        $i = 0;
        while ($i < count($referencias)) {
            $relatorio_total = [];
            $total_status = DB::select('SELECT status_demanda, COUNT(*) as quantidade FROM onb_boards_integrados WHERE referencia = "' . $referencias[$i] . '" AND id_board = ' . $board_id . ' GROUP BY status_demanda');


            if ($total_status) {
                $si = 0;
                $total_servico = 0;
                $status = [];
                while ($si < count($total_status)) {
                    $status[$total_status[$si]->status_demanda] =  $total_status[$si]->quantidade;
                    $total_servico = $total_servico + $total_status[$si]->quantidade;
                    $si++;
                }
            }

            if (array_key_exists("Feito", $status)) {
                $situacao = PlanosIntegrados::TermometroSituacao($status, $total_servico);
            } else {
                $status["Feito"] = 0;
                $situacao = PlanosIntegrados::TermometroSituacao($status, $total_servico);
            }

            // DemandasPorServico_Status_Total_Mensal

            // ########################################

            $s = 0;
            while ($s < count($servicos)) {
                $servico_atual = $servicos[$s];

                $sql_demandas_servico_status = DB::select("SELECT status_demanda, COUNT(status_demanda) as quantidade FROM onb_boards_integrados WHERE id_board = $board_id and referencia = '$referencias[$i]' and servico = '$servico_atual' GROUP BY status_demanda ORDER BY servico");

                if ($sql_demandas_servico_status) {
                    $si_m = 0;
                    $total_servico_mes = 0;
                    $status_mensal = [];
                    while ($si_m < count($sql_demandas_servico_status)) {
                        $status_mensal[$sql_demandas_servico_status[$si_m]->status_demanda] =  $sql_demandas_servico_status[$si_m]->quantidade;
                        $total_servico_mes = $total_servico_mes + $sql_demandas_servico_status[$si_m]->quantidade;
                        $si_m++;
                    }

                    if (array_key_exists("Feito", $status_mensal)) {
                        $situacao = PlanosIntegrados::TermometroSituacao($status_mensal, $total_servico_mes);
                    } else {
                        $status_mensal["Feito"] = 0;
                        $situacao = PlanosIntegrados::TermometroSituacao($status_mensal, $total_servico_mes);
                    }

                    $relatorio = [
                        "servico" => $servico_atual,
                        "status" => $status_mensal,
                        "total_servico" => $total_servico_mes,
                        "Situação" => $situacao
                    ];

                    array_push($relatorio_total, $relatorio);
                }





                $s++;
            }

            // ########################################


            $status_mes[$referencias[$i]] = ["status" => $status, "total" => $total_servico, "situacao" => $situacao, "servicos" => $relatorio_total];
            $i++;
        }
        // var_dump($status_mes["08/2021"]["servicos"][0]);
        // exit();

        return $status_mes;
    }

    public function TermometroResumoIndividual($board_id)
    {
        $status_demandas = PlanosIntegrados::ListarStatus($board_id);
        $total_demandas = PlanosIntegrados::QuantidadeDemandasIndividual($board_id);


        $sc = 0;

        while ($sc < count($status_demandas)) {

            $sc++;
        }

        // Lista de referencias
        $dados = [];
        $i = 0;

        $sql_demandas_total = DB::select('SELECT COUNT(*) as quantidade FROM onb_boards_integrados WHERE id_board =' . $board_id);
        if ($sql_demandas_total > 0) {

            $informacao = DB::select('SELECT cliente FROM onb_boards_integrados WHERE id_board =' . $board_id . ' LIMIT 1');

            if ($informacao) {
                $cliente = explode(" <> ", $informacao[0]->cliente)[0];
                $cliente = str_replace(array('[', ']'), "", $cliente);
            } else {
                $cliente = $board_id;
            }

            $total_demandas = $sql_demandas_total[0]->quantidade;


            $total_status_cliente = DB::select('SELECT status_demanda, COUNT(*) as quantidade FROM onb_boards_integrados WHERE id_board =' . $board_id . ' GROUP BY status_demanda');

            $status_consolidado = [];
            $a = 0;
            while ($a < count($total_status_cliente)) {
                $status_consolidado[$total_status_cliente[$a]->status_demanda] = $total_status_cliente[$a]->quantidade;

                $a++;
            }


            if (array_key_exists("Feito", $status_consolidado)) {
                $porcentagem = number_format(($status_consolidado["Feito"] / $total_demandas) * 100, 2);
                
                if ($porcentagem >= 89) {
                    $situacao = "Bom";
                } else if ($porcentagem >= 79 && $porcentagem < 89) {
                    $situacao = "Aceitável";
                } else if ($porcentagem >= 50 && $porcentagem < 79) {
                    $situacao = "Ruim";
                } else {
                    $situacao = "Crítico";
                }
            } else {
                $situacao = "Crítico";
                $porcentagem = 0;
            }

            $dado = [];
            $dado = [
                "Cliente" => $cliente,
                "id_board" => $board_id,
                "Situação" => $situacao,
                "Total demandas" => $total_demandas,
                "Porcentagem" => $porcentagem,
            ];
            $i++;

            array_push($dados, $dado);
        }

        return $dados;
    }


    // public function DemandasPorServico_Status_Total_Mensal($board_id, $servico, $referencias)
    // {

    //     $relatorio_total = [];
    //     $s = 0;
    //     while ($s < count($servico)) {
    //         $servico_atual = $servico[$s];
    //         $status = [];

    //         $r=0;
    //         while($r < count($referencias)){
    //             $sql_demandas_servico_status = DB::select("SELECT status_demanda, COUNT(status_demanda) as quantidade FROM onb_boards_integrados WHERE id_board = $board_id and servico = '$servico_atual' GROUP BY status_demanda ORDER BY servico");


    //             if ($sql_demandas_servico_status) {
    //                 $si = 0;
    //                 $total_servico = 0;
    //                 while ($si < count($sql_demandas_servico_status)) {
    //                     $status[$sql_demandas_servico_status[$si]->status_demanda] =  $sql_demandas_servico_status[$si]->quantidade;
    //                     $total_servico = $total_servico + $sql_demandas_servico_status[$si]->quantidade;
    //                     $si++;
    //                 }
    //             }
    //             $r++;
    //         }

    //         if (array_key_exists("Feito", $status)) {
    //             $situacao = PlanosIntegrados::TermometroSituacao($status, $total_servico);
    //         }else{
    //             $status["Feito"] = 0;
    //             $situacao = PlanosIntegrados::TermometroSituacao($status, $total_servico);
    //         }

    //         $status_mes[$referencias[$r]] = ["status" => $status, "total" => $total_servico, "situacao" => $situacao];

    //         array_push($relatorio_total, $status_mes);

    //         $s++;
    //     }

    //     var_dump($relatorio_total);
    //     exit();

    //     return $relatorio_total;
    // }

}
