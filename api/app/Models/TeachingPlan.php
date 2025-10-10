<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeachingPlan extends Model
{
    protected $fillable = [
        'id',
        'modalidade',
        'horarios',
        'ementa',
        'ano',
        'carga_horaria',
        'turno',
        'objetivo',
        'metodologia',
        'metodos_avaliacao',
        'criterio_avaliacao',
        'horario_atendimento',
        'disciplina_id',
    ];
}
