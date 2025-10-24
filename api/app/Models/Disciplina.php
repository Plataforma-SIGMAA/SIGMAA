<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Disciplina extends Model
{
    use HasFactory;
    
    protected $fillable = ['nome', 'ano', 'is_hidden', 'curso_id', 'professor_id'];

    public function curso():BelongsTo{
        return $this->belongsTo(Curso::class);
    }

    public function professor():HasOne{
        return $this->hasOne(User::class);
    }

    public function plano_ensino():HasOne{
        return $this->hasOne(Plano_Ensino::class);
    }

    public function avaliacao():HasMany{
        return $this->hasMany(Avaliacao::class);
    }

    public function material():HasMany{
        return $this->hasMany(Material::class);
    }

}
