<?php

namespace Database\Factories;

use App\Models\Curso;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DisciplinaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->words(3, true),
            'ano' => fake()->numberBetween(2020, 2025),
            'is_hidden' => false,
            'curso_id' => Curso::inRandomOrder()->value('id'),
            'professor_id' => User::where('nivel', 'Professor')->inRandomOrder()->value('id'),
        ];
    }
}
