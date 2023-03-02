<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Contratos_alocados extends Authenticatable
{

	use Notifiable;
	protected $fillable = [
		'status',
		'contrato_id',
		'subcontrato_id',
	];

	protected $primaryKey = 'id';
	protected $table = "contratos_alocados";
}
