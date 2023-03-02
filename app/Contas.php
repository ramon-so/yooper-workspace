<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Contas extends Authenticatable{

    use Notifiable;
    protected $fillable = ['conta', 'cliente', 'empresa', 'qtd_usuarios', 'logo', 'dashboard_id', 'integracoes', 'monday_embed', 'plano_integrado_id', 'status'];

    protected $hidden = ['senha', 'remember_token'];
    protected $primaryKey = 'id';
    protected $table = "dash_clientes";
}


?>
