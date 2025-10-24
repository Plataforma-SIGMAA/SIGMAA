<?php

namespace Database\Factories;

use App\Models\Disciplina;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Avaliacao>
 */
class AvaliacaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'desc' => fake()->randomElement(['Prova Bimestral', 'Trabalho em Grupo', 'Seminário', 'Prova Prática']),
            'data' => fake()->dateTimeBetween('now', '+2 months')->format('Y-m-d'),
            'horario' => fake()->randomElement(['08:00', '10:00', '14:00', '16:00', '19:00']),
            'disciplina_id' => Disciplina::inRandomOrder()->value('id'),
        ];
    }
}
