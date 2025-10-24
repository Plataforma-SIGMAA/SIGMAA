<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarefaEnviada extends Model
{
    use HasFactory;

    protected $fillable = ['data_entrega', 'aluno_id', 'tarefa_id'];

    public function aluno(){
        return $this->belongsTo(User::class, 'aluno_id');
    }

    public function tarefa(){
        return $this->belongsTo(Tarefa::class, 'tarefa_id');
    }
}
