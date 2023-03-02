<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Contratos extends Authenticatable{

    use Notifiable;
    protected $fillable = [
        'cliente_id', 
        'servico_id', 
        'data_kickoff', 
        'data_solicitacao_cancelamento', 
        'data_ultimo_dia', 
        'escopo', 
        'complemento', 
        'fee',

        'canais_ativos_midia', 
        'faixa_investimento_midia', 
        'forma_pagamento_midia', 
        'ferramentas_crm', 
        'disparos_semana_crm', 
        'desenvolvimento_seo', 
        'conteudos_mes_seo', 

        'conteudos_blog_seo', 
        'implementacao_seo', 
        'total_conteudos_seo', 
        'posts_semana_social', 
        'budget_impulsionamento_social', 
        'gerenciamento_redes_sociais_social', 
        'conteudos_mes_blog', 

        'pautas_blog', 
        'tipo_contrato_influenciadores', 
        'escopo_influeniadores', 
        'xml_midia',

        'origem',

    ];

    protected $primaryKey = 'id';
    protected $table = "contratos";
}


?>
