<?php

namespace App\Helpers\Contratos;

use App\Helpers\Contratos\Contrato AS Contrato;
class ContratoInfluenciadores extends Contrato
{
    protected String $tipo_contrato_influenciadores;
    protected String $escopo_influenciadores;

    /**
     * @param String $tipo_contrato_influenciadores
     * @param String $escopo_influenciadores
     */
    public function __construct($data)
    {
        parent::__construct($data);
        $this->tipo_contrato_influenciadores = $data['tipo_contrato_influenciadores'];
        $this->escopo_influenciadores = $data['escopo_influenciadores'];
    }

    /**
     * @return String
     */
    public function getTipoContratoInfluenciadores(): string
    {
        return $this->tipo_contrato_influenciadores;
    }

    /**
     * @param String $tipo_contrato_influenciadores
     */
    public function setTipoContratoInfluenciadores(string $tipo_contrato_influenciadores): void
    {
        $this->tipo_contrato_influenciadores = $tipo_contrato_influenciadores;
    }

    /**
     * @return String
     */
    public function getEscopoInfluenciadores(): string
    {
        return $this->escopo_influenciadores;
    }

    /**
     * @param String $escopo_influenciadores
     */
    public function setEscopoInfluenciadores(string $escopo_influenciadores): void
    {
        $this->escopo_influenciadores = $escopo_influenciadores;
    }




}
