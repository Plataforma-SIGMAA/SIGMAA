<?php

namespace Database\Factories;

use App\Models\Disciplina;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Plano_EnsinoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'modalidade' => fake()->randomElement(['Presencial', 'EAD', 'Híbrido']),
            'horarios' => fake()->randomElement([
                '2M12', '2M34', '2M5', '2T1', '2T23', '2T45',
                '3M12', '3M34', '3M5', '3T1', '3T23', '3T45',
                '4M12', '4M34', '4M5', '4T1', '4T23', '4T45',
                '5M12', '5M34', '5M5', '5T1', '5T23', '5T45',
                '6M12', '6M34', '6M5', '6T1', '6T23', '6T45',
            ]),
            'ementa' => fake()->paragraph(2),
            'ano' => fake()->numberBetween(2023, 2025),
            'carga_horaria' => fake()->randomElement(['60h', '80h', '120h']),
            'turno' => fake()->randomElement(['Manhã', 'Tarde', 'Noturno']),
            'objetivo' => fake()->paragraph(2),
            'metodologia' => fake()->paragraph(2),
            'metodos_avaliativos' => fake()->paragraph(2),
            'criterios_avaliativos' => fake()->randomElement(['Comprometimento e entrega', 'Qualidade de solução', 'Criatividade']),
            'horario_atendimento' => fake()->randomElement(['Segunda 16:00-18:00', 'Quarta 10:00-12:00']),
            'disciplina_id' => Disciplina::inRandomOrder()->value('id'),
        ];
    }
}
