<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tarefa extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'data', 'disciplina_id'];

    public function disciplina():BelongsTo{
        return $this->belongsTo(Disciplina::class);
    }

    public function tarefasEnviadas():HasMany{
        return $this->hasMany(TarefaEnviada::class);
    }
}
