<?php

namespace App\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\Clientes;
use Illuminate\Http\Request;


class ClientesRepository extends BaseRepository
{
    
    public function model()
    {
        return Clientes::class;
    }

    public function findOne($id){
        return Clientes::find($id);
    }

    public function update(Clientes $cliente, Request $request, $briefing){

        $cliente->cnpj = $request->cnpj;
        $cliente->razaosocial = $request->razao_social;
        $cliente->empresa = $request->empresa;
        $cliente->logradouro = $request->logradouro;
        $cliente->cidade = $request->cidade;
        $cliente->estado = $request->estado;
        $cliente->link_telegram = $request->link_telegram;
        $cliente->site = $request->site;
        $cliente->nome_responsavel = $request->responsavel;
        $cliente->telefone_responsavel = $request->telefone_responsavel;
        $cliente->nome_responsavel_financeiro = $request->responsavel_financeiro;
        $cliente->telefone_responsavel_financeiro = $request->telefone_responsavel_financeiro;

        $briefing != null ? $cliente->briefing = $briefing : $cliente->briefing = $cliente->briefing;

        $cliente->save();

        return true;
    }
}
