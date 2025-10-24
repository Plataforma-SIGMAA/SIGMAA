<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'data', 'disciplina_id'];

    public function disciplina(){
        return $this->belongsTo(Disciplina::class, 'disciplina_id');
    }
}
