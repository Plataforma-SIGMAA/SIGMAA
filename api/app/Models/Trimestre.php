<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trimestre extends Model
{
    use HasFactory;

    protected $fillable = ['numero', 'disciplina_estudante_id'];

    public function disciplinaAluno():BelongsTo{
        return $this->belongsTo(DisciplinaEstudante::class, 'disciplina_estudante_id');
    }

    public function notas():HasMany{
        return $this->hasMany(Nota::class);
    }
}
