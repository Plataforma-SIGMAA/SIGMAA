<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Curso extends Model
{
    protected $fillable = ['nome', 'objetivo', 'carga_horaria_estagio', 'horas_complementares'];

    public function coordenador():HasOne{
        return $this->hasOne(User::class);
    }

}
