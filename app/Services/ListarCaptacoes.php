<?php

namespace App\Services;

use App\Captacao;

class ListarCaptacoes
{

    public function listarCaptacoes(){
        $captacoes = Captacao::query()->select('rh_fonte_captacaos.id', 'rh_fonte_captacaos.nome')->where('ativo', 'Sim')->orderBy('nome')->get();
        $cp = [];

        foreach ($captacoes as $captacao) {
            array_push($cp, $captacao);
        }

        return $cp;
    }

    public function listarCaptacoesAtivas(){
        $captacoes = Captacao::select(
        'rh_fonte_captacaos.ativo',
        'rh_fonte_captacaos.nome AS nome',
        'rh_fonte_captacaos.id as captacao_id',
            
        )->orderBy('nome')->get();
        $cp = [];

        foreach ($captacoes as $captacao) {
            array_push($cp, $captacao);
        }

        return $cp;
    }

}
