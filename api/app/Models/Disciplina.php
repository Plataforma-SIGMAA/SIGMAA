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
    
    protected $fillable = ['nome', 'ano', 'is_oculto', 'icone', 'curso_id', 'professor_id'];

    public function curso():BelongsTo{
        return $this->belongsTo(Curso::class);
    }

    public function plano_ensino():HasOne{
        return $this->hasOne(Plano_Ensino::class);
    }

    public function avaliacoes():HasMany{
        return $this->hasMany(Avaliacao::class);
    }

    public function materiais():HasMany{
        return $this->hasMany(Material::class);
    }

    public function tarefa():HasMany{
        return $this->hasMany(Tarefa::class);
    }

    public function referencias():HasMany{
        return $this->hasMany(Referencia::class);
    }

    public function disciplinasEstudantes():HasMany{
        return $this->hasMany(DisciplinaEstudante::class);
    }

    public function professor(){
        return $this->belongsTo(Usuario::class, 'professor_id');
    }

}
