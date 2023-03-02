<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcessoSeletivo extends Model{

    protected $table = "rh_processo_seletivos";
    protected $fillable = ['titulo', 'departamento_id', 'cargo_id', 'nivel_de', 'nivel_para', 'qtd_candidatos', 'prioridade', 'status_id', 'user_id', 'data_vencimento', 'avaliacao_tecnico_ids', 'recrutador_funcionario_id', 'subdepartamento_id', 'status_fechamento', 'data_fechamento', 'seguranca', 'motivo', 'salario_de', 'salario_ate'];
}
