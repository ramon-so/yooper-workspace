<?php

namespace App\Services;

use App\Repositories\ContratosRepository;
use App\Helpers\Contratos\ContratoBlog;
use App\Helpers\Contratos\ContratoCrm;
use App\Helpers\Contratos\ContratoDev;
use App\Helpers\Contratos\ContratoInfluenciadores;
use App\Helpers\Contratos\ContratoMidia;
use App\Helpers\Contratos\ContratoSocial;
use App\Helpers\Contratos\Criacao;
use App\Services\ClientesService;


class ContratosService
{

    public $return_contratos = [];

    private function define_contracts($contrato){
        switch ($contrato->nome) {
            case 'BLOG':
                array_push($this->return_contratos, new ContratoBlog($contrato));
                break;
            case 'CRM':
                array_push($this->return_contratos,  new ContratoCrm($contrato));
                break;
            case 'SEO':
                array_push($this->return_contratos, new ContratoSeo($contrato));
                break;
            case 'DEV':
                array_push($this->return_contratos, new ContratoDev($contrato));
                break;
            case 'MÍDIA':
                array_push($this->return_contratos, new ContratoMidia($contrato));
                break;
            case 'INFLUENCERS':
                array_push($this->return_contratos, new ContratoInfluenciadores($contrato));
                break;
            case 'SOCIAL':
                array_push($this->return_contratos, new ContratoSocial($contrato));
                break;
            case 'CRIAÇÃO':
                array_push($this->return_contratos, new ContratoCriacao($contrato));
                break;

            default:
                # code...
                break;
        }
    }

    public function contratos_pendentes(){
        $contratos_repository = new ContratosRepository();
        foreach($contratos_repository->buscar_pendentes() AS $contrato){
            $this->define_contracts($contrato);
        }

        return $this->return_contratos;

    }

}
