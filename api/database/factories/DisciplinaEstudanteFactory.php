<?php

namespace Database\Factories;

use App\Models\Usuario as User;
use App\Models\Disciplina;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DisciplinaEstudante>
 */
class DisciplinaEstudanteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'estudante_id' => User::factory(),
            'disciplina_id' => Disciplina::factory(),
        ];
    }
}
