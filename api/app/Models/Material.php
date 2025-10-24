<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Material extends Model
{
    protected $fillable = ['pasta', 'url', 'caminho', 'data_upload', 'disciplina_id'];

    public function disciplina():BelongsTo{
        return $this->belongsTo(Disciplina::class);
    }
}
