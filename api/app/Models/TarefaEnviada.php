<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TarefaEnviada extends Model
{
    use HasFactory;
    
    protected $table = 'tarefas_enviadas';

    protected $fillable = ['data_entrega', 'estudante_id', 'tarefa_id'];

    public function estudante():BelongsTo{
        return $this->belongsTo(User::class, 'estudante_id');
    }

    public function tarefa():BelongsTo{
        return $this->belongsTo(Tarefa::class, 'tarefa_id');
    }
}
