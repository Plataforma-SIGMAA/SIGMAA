<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tarefas_enviadas', function (Blueprint $table) {
            $table->id();
            $table->date('data_entrega');
            $table->foreignId('tarefa_id')->constrained('tarefas');
            $table->foreignId('estudante_id')->constrained('usuarios');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarefas_enviadas');
    }
};
