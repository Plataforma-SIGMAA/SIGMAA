<?php

namespace Database\Factories;

use App\Models\Curso;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->name(),
            'matricula' => fake()->unique()->numerify('##########'),
            'cpf' => fake()->unique()->numerify('###.###.###-##'),
            'rg' => fake()->unique()->numerify('#########'),
            'telefone' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'data_nasc' => fake()->dateTimeBetween('-50 years', '-14 years')->format('Y-m-d'),
            'foto' => null,
            'pai' => fake()->name('male'),
            'mae' => fake()->name('female'),
            'sexo' => fake()->randomElement(['Macho', 'Fêmea', 'Intersexo']),
            'etnia' => fake()->randomElement(['Branca', 'Preta', 'Parda', 'Amarela', 'Indígena']),
            'nacionalidade' => 'Brasileira',
            'naturalidade' => fake()->city(),
            'pais' => 'Brasil',
            'uf' => fake()->stateAbbr(),
            'cep' => fake()->numerify('#####-###'),
            'bairro' => fake()->citySuffix(),
            'rua' => fake()->streetName(),
            'numero_casa' => fake()->buildingNumber(),
            'tipo' => fake()->randomElement(['Aluno', 'Professor', 'Administrador']),
            'curso_id' => function (array $attributes) {
                if ($attributes['tipo'] === 'Professor') {
                    return null;
                }
                return Curso::inRandomOrder()->value('id');
            },
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
