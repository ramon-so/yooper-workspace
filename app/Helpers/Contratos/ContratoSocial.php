<?php

namespace App\Helpers\Contratos;

use App\Helpers\Contratos\Contrato AS Contrato;
class ContratoSocial extends Contrato
{

    protected Array $geranciamento_redes_sociais;
    protected Int $posts_semana_social;
    protected Float $budget_impulsionamento_social;

    /**
     * @param Array $geranciamento_redes_sociais
     * @param Int $posts_semana_social
     * @param Float $budget_impulsionamento_social
     */
    public function __construct($data)
    {
        parent::__construct($data);
        $this->geranciamento_redes_sociais = $data['geranciamento_redes_sociais'];
        $this->posts_semana_social = $data['posts_semana_social'];
        $this->budget_impulsionamento_social = $data['budget_impulsionamento_social'];
    }

    /**
     * @return Array
     */
    public function getGeranciamentoRedesSociais(): array
    {
        return $this->geranciamento_redes_sociais;
    }

    /**
     * @param Array $geranciamento_redes_sociais
     */
    public function setGeranciamentoRedesSociais(array $geranciamento_redes_sociais): void
    {
        $this->geranciamento_redes_sociais = $geranciamento_redes_sociais;
    }

    /**
     * @return Int
     */
    public function getPostsSemanaSocial(): int
    {
        return $this->posts_semana_social;
    }

    /**
     * @param Int $posts_semana_social
     */
    public function setPostsSemanaSocial(int $posts_semana_social): void
    {
        $this->posts_semana_social = $posts_semana_social;
    }

    /**
     * @return Float
     */
    public function getBudgetImpulsionamentoSocial(): float
    {
        return $this->budget_impulsionamento_social;
    }

    /**
     * @param Float $budget_impulsionamento_social
     */
    public function setBudgetImpulsionamentoSocial(float $budget_impulsionamento_social): void
    {
        $this->budget_impulsionamento_social = $budget_impulsionamento_social;
    }



}
