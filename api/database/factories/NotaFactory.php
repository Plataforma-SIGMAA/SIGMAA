<?php

namespace Database\Factories;

use App\Models\Trimestre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nota>
 */
class NotaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'avaliacao' => 'Prova '.$this->faker->word(),
            'peso' => $this->faker->randomFloat(1, 0, 10),
            'nota_obtida' => $this->faker->randomFloat(1, 0, 10),
            'trimestre_id' => Trimestre::factory(),
            'is_recuperacao' => false,
        ];
    }
}
