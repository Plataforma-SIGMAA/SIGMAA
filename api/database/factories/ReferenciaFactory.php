<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Referencia>
 */
class ReferenciaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->sentence(3),
            'tipo' => $this->faker->randomElement(['livro', 'artigo', 'site']),
            'url' => $this->faker->url(),
            'detalhes' => $this->faker->sentence(),
            'disciplina_id' => Disciplina::factory(),
        ];
    }
}
