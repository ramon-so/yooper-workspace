<?php

namespace App\Helpers\Contratos;

use App\Helpers\Contratos\Contrato AS Contrato;
class ContratoBlog extends Contrato
{
    protected String $link_conteudos_blog;
    protected String $conteudos_mes_blog;
    protected String $pautas_blog;

    /**
     * @param String $link_conteudos_blog
     * @param String $conteudos_mes_blog
     * @param String $pautas_blog
     */
    public function __construct($data)
    {
        parent::__construct($data);
        $this->link_conteudos_blog = $data['link_conteudos_blog'] != null ? $data['link_conteudos_blog'] : "";
        $this->conteudos_mes_blog = $data['conteudos_mes_blog'] != null ? $data['conteudos_mes_blog'] : "";
        $this->pautas_blog = $data['pautas_blog'] != null ? $data['pautas_blog'] : "";
    }

    /**
     * @return String
     */
    public function getLinkConteudosBlog(): string
    {
        return $this->link_conteudos_blog;
    }

    /**
     * @param String $link_conteudos_blog
     */
    public function setLinkConteudosBlog(string $link_conteudos_blog): void
    {
        $this->link_conteudos_blog = $link_conteudos_blog;
    }

    /**
     * @return String
     */
    public function getConteudosMesBlog(): string
    {
        return $this->conteudos_mes_blog;
    }

    /**
     * @param String $conteudos_mes_blog
     */
    public function setConteudosMesBlog(string $conteudos_mes_blog): void
    {
        $this->conteudos_mes_blog = $conteudos_mes_blog;
    }

    /**
     * @return String
     */
    public function getPautasBlog(): string
    {
        return $this->pautas_blog;
    }

    /**
     * @param String $pautas_blog
     */
    public function setPautasBlog(string $pautas_blog): void
    {
        $this->pautas_blog = $pautas_blog;
    }




}
