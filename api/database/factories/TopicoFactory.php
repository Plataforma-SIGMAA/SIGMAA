<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Topico>
 */
class TopicoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => 'Tópico '.$this->faker->word(),
            'data' => $this->faker->date(),
            'disciplina_id' => Disciplina::factory(),
        ];
    }
}
