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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('matricula')->unique();
            $table->enum('tipo', ['Aluno', 'Professor', 'Administrador']);
            $table->string('cpf', '14')->unique();
            $table->string('rg', '10')->unique()->nullable();
            $table->string('telefone')->nullable();
            $table->string('email')->unique();
            $table->date('data_nasc');
            $table->string('foto')->nullable();
            $table->string('pai');
            $table->string('mae');
            $table->enum('sexo', ['Macho', 'Fêmea', 'Intersexo']);
            $table->enum('etnia', ['Branca', 'Preta', 'Parda', 'Amarela', 'Indígena']);
            $table->string('nacionalidade');
            $table->string('naturalidade');
            $table->string('pais');
            $table->string('uf');
            $table->string('cep');
            $table->string('bairro');
            $table->string('rua');
            $table->string('numero_casa')->nullable();
            $table->foreignId('curso_id')->nullable()->constrained('cursos');

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
