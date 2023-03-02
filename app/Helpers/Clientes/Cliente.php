<?php

namespace App\Helpers\Clientes;

use App\Repositories\ClientesRepository;

class Cliente {
    protected String $cnpj;
    protected String $razaosocial;

    protected String $empresa;
    protected String $cep;
    protected String $logradouro;
    protected String $numero;
    protected String $bairro;
    protected String $cidade;
    protected String $estado;
    protected String $site;
    protected String $created_at;
    protected String $updated_at;
    protected String $yoodash_id;
    protected String $link_telegram;
    protected String $link_plano_integrado;
    protected String $plataforma_id;
    protected String $projetos;
    protected String $raio_x;
    protected String $modelo_negocio;
    protected String $analise_inicial;
    protected String $briefing;
    protected String $plataforma;
    protected String $data_faturamento;
    protected String $total_de_funcionarios;
    protected String $tempo_operacao_online;
    protected String $bandeira_animal;
    protected String $id_monday;
    protected String $nome_responsavel;
    protected String $email_responsavel;
    protected String $telefone_responsavel;
    protected String $nome_responsavel_financeiro;
    protected String $email_responsavel_financeiro;
    protected String $telefone_responsavel_financeiro;

    /**
     * @param String $cnpj
     * @param String $razaosocial
     * @param String $empresa
     * @param String $cep
     * @param String $logradouro
     * @param String $numero
     * @param String $bairro
     * @param String $cidade
     * @param String $estado
     * @param String $site
     * @param String $created_at
     * @param String $updated_at
     * @param String $yoodash_id
     * @param String $link_telegram
     * @param String $link_plano_integrado
     * @param String $plataforma_id
     * @param String $projetos
     * @param String $raio_x
     * @param String $modelo_negocio
     * @param String $analise_inicial
     * @param String $briefing
     * @param String $plataforma
     * @param String $data_faturamento
     * @param String $total_de_funcionarios
     * @param String $tempo_operacao_online
     * @param String $bandeira_animal
     * @param String $id_monday
     * @param String $nome_responsavel
     * @param String $email_responsavel
     * @param String $telefone_responsavel
     * @param String $nome_responsavel_financeiro
     * @param String $email_responsavel_financeiro
     * @param String $telefone_responsavel_financeiro
     */
    public function __construct($data)
    {
        $this->cnpj = $data['cnpj'];
        $this->razaosocial = $data['razaosocial'];
        $this->empresa = $data['empresa'];
        $this->cep = $data['cep'];
        $this->logradouro = $data['logradouro'];
        $this->numero = $data['numero'];
        $this->bairro = $data['bairro'];
        $this->cidade = $data['cidade'];
        $this->estado = $data['estado'];
        $this->site = $data['site'];
        $this->created_at = $data['created_at'];
        $this->updated_at = $data['updated_at'];
        $this->yoodash_id = $data['yoodash_id'];
        $this->link_telegram = $data['link_telegram'];
        $this->link_plano_integrado = $data['link_plano_integrado'];
        $this->plataforma_id = $data['plataforma_id'];
        $this->projetos = $data['projetos'];
        $this->raio_x = $data['raio_x'];
        $this->modelo_negocio = $data['modelo_negocio'];
        $this->analise_inicial = $data['analise_inicial'];
        $this->briefing = $data['briefing'];
        $this->plataforma = $data['plataforma'];
        $this->data_faturamento = $data['data_faturamento'];
        $this->total_de_funcionarios = $data['total_de_funcionarios'];
        $this->tempo_operacao_online = $data['tempo_operacao_online'];
        $this->bandeira_animal = $data['bandeira_animal'];
        $this->id_monday = $data['id_monday'];
        $this->nome_responsavel = $data['nome_responsavel'];
        $this->email_responsavel = $data['email_responsavel'];
        $this->telefone_responsavel = $data['telefone_responsavel'];
        $this->nome_responsavel_financeiro = $data['nome_responsavel_financeiro'];
        $this->email_responsavel_financeiro = $data['email_responsavel_financeiro'];
        $this->telefone_responsavel_financeiro = $data['telefone_responsavel_financeiro'];
    }

    /**
     * @return String
     */
    public function getCnpj(): string
    {
        return $this->cnpj;
    }

    /**
     * @param String $cnpj
     */
    public function setCnpj(string $cnpj): void
    {
        $this->cnpj = $cnpj;
    }

    /**
     * @return String
     */
    public function getRazaosocial(): string
    {
        return $this->razaosocial;
    }

    /**
     * @param String $razaosocial
     */
    public function setRazaosocial(string $razaosocial): void
    {
        $this->razaosocial = $razaosocial;
    }

    /**
     * @return String
     */
    public function getEmpresa(): string
    {
        return $this->empresa;
    }

    /**
     * @param String $empresa
     */
    public function setEmpresa(string $empresa): void
    {
        $this->empresa = $empresa;
    }

    /**
     * @return String
     */
    public function getCep(): string
    {
        return $this->cep;
    }

    /**
     * @param String $cep
     */
    public function setCep(string $cep): void
    {
        $this->cep = $cep;
    }

    /**
     * @return String
     */
    public function getLogradouro(): string
    {
        return $this->logradouro;
    }

    /**
     * @param String $logradouro
     */
    public function setLogradouro(string $logradouro): void
    {
        $this->logradouro = $logradouro;
    }

    /**
     * @return String
     */
    public function getNumero(): string
    {
        return $this->numero;
    }

    /**
     * @param String $numero
     */
    public function setNumero(string $numero): void
    {
        $this->numero = $numero;
    }

    /**
     * @return String
     */
    public function getBairro(): string
    {
        return $this->bairro;
    }

    /**
     * @param String $bairro
     */
    public function setBairro(string $bairro): void
    {
        $this->bairro = $bairro;
    }

    /**
     * @return String
     */
    public function getCidade(): string
    {
        return $this->cidade;
    }

    /**
     * @param String $cidade
     */
    public function setCidade(string $cidade): void
    {
        $this->cidade = $cidade;
    }

    /**
     * @return String
     */
    public function getEstado(): string
    {
        return $this->estado;
    }

    /**
     * @param String $estado
     */
    public function setEstado(string $estado): void
    {
        $this->estado = $estado;
    }

    /**
     * @return String
     */
    public function getSite(): string
    {
        return $this->site;
    }

    /**
     * @param String $site
     */
    public function setSite(string $site): void
    {
        $this->site = $site;
    }

    /**
     * @return String
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @param String $created_at
     */
    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return String
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    /**
     * @param String $updated_at
     */
    public function setUpdatedAt(string $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return String
     */
    public function getYoodashId(): string
    {
        return $this->yoodash_id;
    }

    /**
     * @param String $yoodash_id
     */
    public function setYoodashId(string $yoodash_id): void
    {
        $this->yoodash_id = $yoodash_id;
    }

    /**
     * @return String
     */
    public function getLinkTelegram(): string
    {
        return $this->link_telegram;
    }

    /**
     * @param String $link_telegram
     */
    public function setLinkTelegram(string $link_telegram): void
    {
        $this->link_telegram = $link_telegram;
    }

    /**
     * @return String
     */
    public function getLinkPlanoIntegrado(): string
    {
        return $this->link_plano_integrado;
    }

    /**
     * @param String $link_plano_integrado
     */
    public function setLinkPlanoIntegrado(string $link_plano_integrado): void
    {
        $this->link_plano_integrado = $link_plano_integrado;
    }

    /**
     * @return String
     */
    public function getPlataformaId(): string
    {
        return $this->plataforma_id;
    }

    /**
     * @param String $plataforma_id
     */
    public function setPlataformaId(string $plataforma_id): void
    {
        $this->plataforma_id = $plataforma_id;
    }

    /**
     * @return String
     */
    public function getProjetos(): string
    {
        return $this->projetos;
    }

    /**
     * @param String $projetos
     */
    public function setProjetos(string $projetos): void
    {
        $this->projetos = $projetos;
    }

    /**
     * @return String
     */
    public function getRaioX(): string
    {
        return $this->raio_x;
    }

    /**
     * @param String $raio_x
     */
    public function setRaioX(string $raio_x): void
    {
        $this->raio_x = $raio_x;
    }

    /**
     * @return String
     */
    public function getModeloNegocio(): string
    {
        return $this->modelo_negocio;
    }

    /**
     * @param String $modelo_negocio
     */
    public function setModeloNegocio(string $modelo_negocio): void
    {
        $this->modelo_negocio = $modelo_negocio;
    }

    /**
     * @return String
     */
    public function getAnaliseInicial(): string
    {
        return $this->analise_inicial;
    }

    /**
     * @param String $analise_inicial
     */
    public function setAnaliseInicial(string $analise_inicial): void
    {
        $this->analise_inicial = $analise_inicial;
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
    public function getPlataforma(): string
    {
        return $this->plataforma;
    }

    /**
     * @param String $plataforma
     */
    public function setPlataforma(string $plataforma): void
    {
        $this->plataforma = $plataforma;
    }

    /**
     * @return String
     */
    public function getDataFaturamento(): string
    {
        return $this->data_faturamento;
    }

    /**
     * @param String $data_faturamento
     */
    public function setDataFaturamento(string $data_faturamento): void
    {
        $this->data_faturamento = $data_faturamento;
    }

    /**
     * @return String
     */
    public function getTotalDeFuncionarios(): string
    {
        return $this->total_de_funcionarios;
    }

    /**
     * @param String $total_de_funcionarios
     */
    public function setTotalDeFuncionarios(string $total_de_funcionarios): void
    {
        $this->total_de_funcionarios = $total_de_funcionarios;
    }

    /**
     * @return String
     */
    public function getTempoOperacaoOnline(): string
    {
        return $this->tempo_operacao_online;
    }

    /**
     * @param String $tempo_operacao_online
     */
    public function setTempoOperacaoOnline(string $tempo_operacao_online): void
    {
        $this->tempo_operacao_online = $tempo_operacao_online;
    }

    /**
     * @return String
     */
    public function getBandeiraAnimal(): string
    {
        return $this->bandeira_animal;
    }

    /**
     * @param String $bandeira_animal
     */
    public function setBandeiraAnimal(string $bandeira_animal): void
    {
        $this->bandeira_animal = $bandeira_animal;
    }

    /**
     * @return String
     */
    public function getIdMonday(): string
    {
        return $this->id_monday;
    }

    /**
     * @param String $id_monday
     */
    public function setIdMonday(string $id_monday): void
    {
        $this->id_monday = $id_monday;
    }

    /**
     * @return String
     */
    public function getNomeResponsavel(): string
    {
        return $this->nome_responsavel;
    }

    /**
     * @param String $nome_responsavel
     */
    public function setNomeResponsavel(string $nome_responsavel): void
    {
        $this->nome_responsavel = $nome_responsavel;
    }

    /**
     * @return String
     */
    public function getEmailResponsavel(): string
    {
        return $this->email_responsavel;
    }

    /**
     * @param String $email_responsavel
     */
    public function setEmailResponsavel(string $email_responsavel): void
    {
        $this->email_responsavel = $email_responsavel;
    }

    /**
     * @return String
     */
    public function getTelefoneResponsavel(): string
    {
        return $this->telefone_responsavel;
    }

    /**
     * @param String $telefone_responsavel
     */
    public function setTelefoneResponsavel(string $telefone_responsavel): void
    {
        $this->telefone_responsavel = $telefone_responsavel;
    }

    /**
     * @return String
     */
    public function getNomeResponsavelFinanceiro(): string
    {
        return $this->nome_responsavel_financeiro;
    }

    /**
     * @param String $nome_responsavel_financeiro
     */
    public function setNomeResponsavelFinanceiro(string $nome_responsavel_financeiro): void
    {
        $this->nome_responsavel_financeiro = $nome_responsavel_financeiro;
    }

    /**
     * @return String
     */
    public function getEmailResponsavelFinanceiro(): string
    {
        return $this->email_responsavel_financeiro;
    }

    /**
     * @param String $email_responsavel_financeiro
     */
    public function setEmailResponsavelFinanceiro(string $email_responsavel_financeiro): void
    {
        $this->email_responsavel_financeiro = $email_responsavel_financeiro;
    }

    /**
     * @return String
     */
    public function getTelefoneResponsavelFinanceiro(): string
    {
        return $this->telefone_responsavel_financeiro;
    }

    /**
     * @param String $telefone_responsavel_financeiro
     */
    public function setTelefoneResponsavelFinanceiro(string $telefone_responsavel_financeiro): void
    {
        $this->telefone_responsavel_financeiro = $telefone_responsavel_financeiro;
    }



}
