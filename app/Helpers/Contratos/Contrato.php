<?php

namespace App\Helpers\Contratos;

use App\Repositories\ContratosRepository;
use App\Helpers\Clientes\Cliente;

class Contrato {

    protected String $escopo;
    protected String $origem;

    protected String $briefing;

    protected String $fee;

    protected $data_kickoff;
    protected $data_solicitacao_cancelamento;
    protected $data_ultimo_dia;

    protected $created_at;
    protected $updated_at;

    protected Cliente $cliente;

    /**
     * @param $data[]
     */
    public function __construct($data)
    {
        $this->escopo = $data['escopo'] != null ? $data['escopo'] : "";
        $this->origem = $data['origem'] != null ? $data['origem'] : "";
        $this->briefing = $data['briefing'] != null ? $data['briefing'] : "";
        $this->fee = $data['fee'] != null ? $data['fee'] : "";
        $this->data_kickoff = $data['data_kickoff'] != null ? $data['data_kickoff'] : "";
        $this->data_solicitacao_cancelamento = $data['data_solicitacao_cancelamento'] != null ? $data['data_solicitacao_cancelamento'] : "";
        $this->data_ultimo_dia = $data['data_ultimo_dia'] != null ? $data['data_ultimo_dia'] : "";
        $this->created_at = $data['created_at'] != null ? $data['created_at'] : "";
        $this->updated_at = $data['updated_at'] != null ? $data['updated_at'] : "";
    }

    /**
     * @return String
     */
    public function getEscopo(): string
    {
        return $this->escopo;
    }

    /**
     * @param String $escopo
     */
    public function setEscopo(string $escopo): void
    {
        $this->escopo = $escopo;
    }

    /**
     * @return String
     */
    public function getOrigem(): string
    {
        return $this->origem;
    }

    /**
     * @param String $origem
     */
    public function setOrigem(string $origem): void
    {
        $this->origem = $origem;
    }

    /**
     * @return String
     */
    public function getBriefing(): string
    {
        return $this->briefing;
    }

    /**
     * @param String $briefing
     */
    public function setBriefing(string $briefing): void
    {
        $this->briefing = $briefing;
    }

    /**
     * @return String
     */
    public function getClienteId(): string
    {
        return $this->cliente_id;
    }

    /**
     * @param String $cliente_id
     */
    public function setClienteId(string $cliente_id): void
    {
        $this->cliente_id = $cliente_id;
    }

    /**
     * @return String
     */
    public function getServicoId(): string
    {
        return $this->servico_id;
    }

    /**
     * @param String $servico_id
     */
    public function setServicoId(string $servico_id): void
    {
        $this->servico_id = $servico_id;
    }

    /**
     * @return Float
     */
    public function getFee(): float
    {
        return $this->fee;
    }

    /**
     * @param Float $fee
     */
    public function setFee(float $fee): void
    {
        $this->fee = $fee;
    }

    /**
     * @return mixed
     */
    public function getDataKickoff()
    {
        return $this->data_kickoff;
    }

    /**
     * @param mixed $data_kickoff
     */
    public function setDataKickoff($data_kickoff): void
    {
        $this->data_kickoff = $data_kickoff;
    }

    /**
     * @return mixed
     */
    public function getDataSolicitacaoCancelamento()
    {
        return $this->data_solicitacao_cancelamento;
    }

    /**
     * @param mixed $data_solicitacao_cancelamento
     */
    public function setDataSolicitacaoCancelamento($data_solicitacao_cancelamento): void
    {
        $this->data_solicitacao_cancelamento = $data_solicitacao_cancelamento;
    }

    /**
     * @return mixed
     */
    public function getDataUltimoDia()
    {
        return $this->data_ultimo_dia;
    }

    /**
     * @param mixed $data_ultimo_dia
     */
    public function setDataUltimoDia($data_ultimo_dia): void
    {
        $this->data_ultimo_dia = $data_ultimo_dia;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at): void
    {
        $this->updated_at = $updated_at;
    }





}
