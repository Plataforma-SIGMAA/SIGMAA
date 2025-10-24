<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    $fillable = ['nome', 'objetivo', 'carga_horaria_estagio', 'horas_complementares'];
}
