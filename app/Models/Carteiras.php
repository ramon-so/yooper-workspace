<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carteiras extends Model
{
    protected $table = 'carteiras';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
}
