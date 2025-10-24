<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DisciplinaEstudante extends Model
{
     use HasFactory;

    protected $table = 'disciplinas_estudantes';

    protected $fillable = ['estudante_id', 'disciplina_id'];

    public function estudante():BelongsTo{
        return $this->belongsTo(User::class, 'estudante_id');
    }

    public function disciplina():BelongsTo{
        return $this->belongsTo(Disciplina::class, 'disciplina_id');
    }

    public function trimestres():HasMany{
        return $this->hasMany(Trimestre::class);
    }
}
