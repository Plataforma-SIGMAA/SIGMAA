<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarefa>
 */
class TarefaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => 'Tarefa '.$this->faker->word(),
            'desc' => $this->faker->sentence(),
            'data_prazo' => $this->faker->dateTimeBetween('now', '+1 month'),
            'tipo' => $this->faker->randomElement(['PDF', 'texto', 'questionário']),
            'disciplina_id' => Disciplina::factory(),
        ];
    }
}
