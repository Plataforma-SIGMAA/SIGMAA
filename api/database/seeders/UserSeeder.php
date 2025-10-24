<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();
        User::create([
            'nome' => 'Admin',
            'email' => 'admin@escola.com',
            'password' => Hash::make('admin01'),
            'email_verified_at' => now(),
            'nome' => 'Administrador',
            'matricula' => '0000000001',
            'cpf' => '000.000.000-00',
            'rg' => '000000000',
            'telefone' => '(00) 00000-0000',
            'data_nasc' => '1990-01-01',
            'pai' => 'Pai Admin',
            'mae' => 'Mãe Admin',
            'sexo' => 'Macho',
            'etnia' => 'Branca',
            'nacionalidade' => 'Brasileira',
            'naturalidade' => 'São Paulo',
            'pais' => 'Brasil',
            'uf' => 'SP',
            'cep' => '00000-000',
            'bairro' => 'Centro',
            'rua' => 'Rua Principal',
            'numero_casa' => '123',
            'nivel' => 'Professor',
            'curso_id' => null,
        ]);
    }
}
