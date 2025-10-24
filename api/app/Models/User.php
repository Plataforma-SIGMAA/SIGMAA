<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
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
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array
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

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
 
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
