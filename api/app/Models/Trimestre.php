<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trimestre extends Model
{
    use HasFactory;

    protected $fillable = ['numero', 'disciplina_aluno_id']; //?????????

    public function disciplinaAluno(){
        return $this->belongsTo(DisciplinaEstudante::class, 'disciplina_aluno_id');
    }

    public function notas(){
        return $this->hasMany(Nota::class);
    }
}
