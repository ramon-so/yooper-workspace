<?php

namespace App\Helpers\Contratos;

use App\Helpers\Contratos\Contrato AS Contrato;
class ContratoSeo extends Contrato
{

    Protected String $desenvolvimento_seo;
    Protected Int $conteudos_mes_seo;
    Protected Int $conteudos_blog_seo;
    Protected Int $total_conteudos_seo;

    /**
     * @param String $desenvolvimento_seo
     * @param Int $conteudos_mes_seo
     * @param Int $conteudos_blog_seo
     * @param Int $total_conteudos_seo
     */
    public function __construct($data)
    {
        parent::__construct($data);
        $this->desenvolvimento_seo = $data['desenvolvimento_seo'];
        $this->conteudos_mes_seo = $data['conteudos_mes_seo'];
        $this->conteudos_blog_seo = $data['conteudos_blog_seo'];
        $this->total_conteudos_seo = $data['total_conteudos_seo'];
    }

    /**
     * @return String
     */
    public function getDesenvolvimentoSeo(): string
    {
        return $this->desenvolvimento_seo;
    }

    /**
     * @param String $desenvolvimento_seo
     */
    public function setDesenvolvimentoSeo(string $desenvolvimento_seo): void
    {
        $this->desenvolvimento_seo = $desenvolvimento_seo;
    }

    /**
     * @return Int
     */
    public function getConteudosMesSeo(): int
    {
        return $this->conteudos_mes_seo;
    }

    /**
     * @param Int $conteudos_mes_seo
     */
    public function setConteudosMesSeo(int $conteudos_mes_seo): void
    {
        $this->conteudos_mes_seo = $conteudos_mes_seo;
    }

    /**
     * @return Int
     */
    public function getConteudosBlogSeo(): int
    {
        return $this->conteudos_blog_seo;
    }

    /**
     * @param Int $conteudos_blog_seo
     */
    public function setConteudosBlogSeo(int $conteudos_blog_seo): void
    {
        $this->conteudos_blog_seo = $conteudos_blog_seo;
    }

    /**
     * @return Int
     */
    public function getTotalConteudosSeo(): int
    {
        return $this->total_conteudos_seo;
    }

    /**
     * @param Int $total_conteudos_seo
     */
    public function setTotalConteudosSeo(int $total_conteudos_seo): void
    {
        $this->total_conteudos_seo = $total_conteudos_seo;
    }



}
