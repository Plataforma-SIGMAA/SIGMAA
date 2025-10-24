<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Topico extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'data', 'disciplina_id'];

    public function disciplina():BelongsTo{
        return $this->belongsTo(Disciplina::class, 'disciplina_id');
    }
}
