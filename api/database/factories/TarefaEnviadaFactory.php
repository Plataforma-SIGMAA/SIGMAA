<?php

namespace Database\Factories;

use App\Models\Tarefa;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TarefaEnviada>
 */
class TarefaEnviadaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'data_entrega' => $this->faker->dateTimeBetween('-1 week', 'now'),
            'aluno_id' => User::factory(),
            'tarefa_id' => Tarefa::factory(),
        ];
    }
}
