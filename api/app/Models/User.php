<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nome',
        'matricula',
        'cpf',
        'rg',
        'telefone',
        'data_nasc',
        'pai',
        'mae',
        'sexo',
        'etnia',
        'nacionalidade',
        'naturalidade',
        'pais',
        'uf',
        'cep',
        'bairro',
        'rua',
        'numero_casa',
        'nivel',
        'curso_id,'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function curso():BelongsTo{
        return $this->belongsTo(Curso::class);
    }

    public function disciplinasEstudantes():HasMany{
        return $this->hasMany(DisciplinaEstudante::class);
    }

    public function tarefasEnviadas():HasMany{
        return $this->hasMany(DisciplinaEstudante::class);
    }

}
