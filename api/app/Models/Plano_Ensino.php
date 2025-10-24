<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plano_Ensino extends Model
{
    use HasFactory;

    protected $table = 'plano_ensino';

    protected $fillable = ['modalidade', 'horarios', 'ementa', 'ano', 'carga_horaria', 'turno', 'objetivo', 'metodologia', 'metodos_avaliativos', 'criterios_avaliativos', 'horario_atendimento', 'disciplina_id'];

    public function disciplina():BelongsTo{
        return $this->belongsTo(Disciplina::class);
    }

}
