<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plano_ensino', function (Blueprint $table) {
            $table->id();
            $table->string('modalidade');
            $table->string('horarios');
            $table->string('ementa');
            $table->string('ano');
            $table->string('carga_horaria');
            $table->string('turno');
            $table->string('objetivo');
            $table->string('metodologia');
            $table->string('metodos_avaliativos');
            $table->string('criterios_avaliativos');
            $table->string('horario_atendimento');
            $table->foreignId('disciplina_id')->constrained('disciplinas');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plano_ensino');
    }
};
