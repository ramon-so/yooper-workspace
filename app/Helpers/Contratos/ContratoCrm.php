<?php

namespace App\Helpers\Contratos;

use App\Helpers\Contratos\Contrato AS Contrato;

class ContratoCrm extends Contrato
{
    protected String $ferramentas_crm;
    protected String $disparos_crm;

    /**
     * @param String $ferramentas_crm
     * @param String $disparos_crm
     */
    public function __construct($data)
    {
        parent::__construct($data);
        $this->ferramentas_crm = $data['ferramentas_crm'];
        $this->disparos_crm = $data['disparos_crm'];
    }

    /**
     * @return String
     */
    public function getFerramentasCrm(): string
    {
        return $this->ferramentas_crm;
    }

    /**
     * @param String $ferramentas_crm
     */
    public function setFerramentasCrm(string $ferramentas_crm): void
    {
        $this->ferramentas_crm = $ferramentas_crm;
    }

    /**
     * @return String
     */
    public function getDisparosCrm(): string
    {
        return $this->disparos_crm;
    }

    /**
     * @param String $disparos_crm
     */
    public function setDisparosCrm(string $disparos_crm): void
    {
        $this->disparos_crm = $disparos_crm;
    }



}
