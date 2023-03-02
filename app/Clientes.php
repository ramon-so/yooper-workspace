<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Clientes extends Authenticatable{

    use Notifiable;
    protected $fillable = [
        'cnpj', 
        'razaosocial', 
        'empresa', 
        'cep', 
        'logradouro', 
        'numero', 
        'complemento', 
        'bairro', 
        'cidade', 
        'estado',
        'site',
        'briefing',
        'raio_x',
        'analise_inicial',
        'modelo_negocio',
        'nome_responsavel',
        'email_responsavel',
        'telefone_responsavel',
        'nome_responsavel_financeiro',
        'email_responsavel_financeiro',
        'telefone_responsavel_financeiro'
    ];

    protected $primaryKey = 'id';
    protected $table = "clientes";
}


?>
