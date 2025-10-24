<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    $fillable = ['nome', 'descricao', 'data_final', 'tipo', 'disciplina_id'];
}
