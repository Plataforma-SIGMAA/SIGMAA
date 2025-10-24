<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisciplinaEstudante extends Model
{
     use HasFactory;

    protected $fillable = ['aluno_id', 'disciplina_id'];

    public function estudante(){
        return $this->belongsTo(User::class, 'aluno_id');
        // ?
    }

    public function disciplina(){
        return $this->belongsTo(Disciplina::class, 'disciplina_id');
    }

    public function trimestres(){
        return $this->hasMany(Trimestre::class);
    }
}
