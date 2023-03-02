<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Carteiras extends Authenticatable{

    use Notifiable;
    protected $fillable = [
        'funcionario_id',
        'contrato_id',
        'created_at',
        'updated_at'
    ];

    protected $primaryKey = 'id';
    protected $table = "carteiras";
}


?>
