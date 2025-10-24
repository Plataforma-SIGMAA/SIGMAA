<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = [
        'avaliacao', 
        'nota_total', 
        'nota_obtida',
        'trimestre_id', 
        'is_recuperacao'
    ];

    public function trimestre(){
        return $this->belongsTo(Trimestre::class, 'trimestre_id');
    }
}
