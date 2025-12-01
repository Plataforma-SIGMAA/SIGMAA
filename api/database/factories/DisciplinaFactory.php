<?php

namespace Database\Factories;

use App\Models\Curso;
use App\Models\Usuario as User;
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
            'nome' => fake()->randomElement([
                'Biologia',
                'Química',
                'Geografia',
                'Matemática',
                'Português',
                'Física',
                'História',
                'Educação Física'
            ]),
            'ano' => fake()->numberBetween(2020, 2025),
            'is_oculto' => false,
            'icone' => null,
            'curso_id' => Curso::inRandomOrder()->value('id'),
            'professor_id' => User::where('tipo', 'Professor')->inRandomOrder()->value('id'),
        ];
    }
}
