<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Disciplina extends Model
{
    $fillable = ['nome', 'ano', 'is_hidden', 'curso_id', 'professor_id'];
}
