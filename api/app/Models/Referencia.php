<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Referencia extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'tipo', 'url', 'detalhes', 'disciplina_id'];

    public function disciplina():BelongsTo{
        return $this->belongsTo(Disciplina::class, 'disciplina_id');
    }
}
