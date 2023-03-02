<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnbBoardsIntegrado extends Model{
    protected $fillable = ['id_monday', 'id_board', 'cliente', 'nome', 'responsavel', 'servico',  'tipo_acao', 'referencia', 'status_demanda', 'obrigatoria']; 
}

?>
