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
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->string('avaliacao');
            $table->float('peso', '4', '2');
            $table->float('nota_obtida', '4', '2')->nullable()->default(null);
            $table->boolean('is_recuperacao')->default(false);
            $table->foreignId('trimestre_id')->constrained('trimestres');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
