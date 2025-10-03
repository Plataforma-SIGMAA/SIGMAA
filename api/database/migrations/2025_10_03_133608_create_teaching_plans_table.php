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
        Schema::create('teaching_plans', function (Blueprint $table) {
            $table->id();
            $table->string('learning_modality');
            $table->string('schedules');
            $table->string('ementa');
            $table->string('year');
            $table->string('work_load');
            $table->string('shift');
            $table->string('goal');
            $table->string('methodology');
            $table->string('assessment_methods');
            $table->string('evaluation_criteria');
            $table->string('service_schedule');
            $table->string('subject_id')->constrained('subjects');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teaching_plans');
    }
};
