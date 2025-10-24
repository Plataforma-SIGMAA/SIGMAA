<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = [
        'avaliacao', 
        'peso', 
        'nota_obtida',
        'trimestre_id', 
        'is_recuperacao'
    ];

    public function trimestre():BelongsTo{
        return $this->belongsTo(Trimestre::class, 'trimestre_id');
    }
}
