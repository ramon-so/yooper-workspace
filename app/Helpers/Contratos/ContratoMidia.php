<?php

namespace App\Helpers\Contratos;

use App\Helpers\Contratos\Contrato AS Contrato;
class ContratoMidia extends Contrato
{

    protected String $xml_midia;
    protected Array $canais_ativos_midia;
    protected String $faixa_investimento_midia;
    protected String $forma_pagamento_midia;

    /**
     * @param String $xml_midia
     * @param Array $canais_ativos_midia
     * @param String $faixa_investimento_midia
     * @param String $forma_pagamento_midia
     */
    public function __construct($data)
    {
        parent::__construct($data);
        $this->xml_midia = $data['xml_midia'];
        $this->canais_ativos_midia = $data['canais_ativos_midia'];
        $this->faixa_investimento_midia = $data['faixa_investimento_midia'];
        $this->forma_pagamento_midia = $data['forma_pagamento_midia'];
    }


    /**
     * @return String
     */
    public function getXmlMidia(): string
    {
        return $this->xml_midia;
    }

    /**
     * @param String $xml_midia
     */
    public function setXmlMidia(string $xml_midia): void
    {
        $this->xml_midia = $xml_midia;
    }

    /**
     * @return Array
     */
    public function getCanaisAtivosMidia(): array
    {
        return $this->canais_ativos_midia;
    }

    /**
     * @param Array $canais_ativos_midia
     */
    public function setCanaisAtivosMidia(array $canais_ativos_midia): void
    {
        $this->canais_ativos_midia = $canais_ativos_midia;
    }

    /**
     * @return String
     */
    public function getFaixaInvestimentoMidia(): string
    {
        return $this->faixa_investimento_midia;
    }

    /**
     * @param String $faixa_investimento_midia
     */
    public function setFaixaInvestimentoMidia(string $faixa_investimento_midia): void
    {
        $this->faixa_investimento_midia = $faixa_investimento_midia;
    }

    /**
     * @return String
     */
    public function getFormaPagamentoMidia(): string
    {
        return $this->forma_pagamento_midia;
    }

    /**
     * @param String $forma_pagamento_midia
     */
    public function setFormaPagamentoMidia(string $forma_pagamento_midia): void
    {
        $this->forma_pagamento_midia = $forma_pagamento_midia;
    }




}
