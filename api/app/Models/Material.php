<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'id',
        'nome_arquivo',
        'url',
        'caminho',
        'data_upload',
        'disciplina_id',
    ];
}
