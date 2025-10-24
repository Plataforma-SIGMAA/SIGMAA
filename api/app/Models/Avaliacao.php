<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Avaliacao extends Model
{
    use HasFactory;

    protected $table = 'avaliacoes';

    protected $fillable = ['desc', 'data', 'horarios', 'disciplina_id'];

    public function disciplina():BelongsTo{
        return $this->belongsTo(Disciplina::class);
    }
}
