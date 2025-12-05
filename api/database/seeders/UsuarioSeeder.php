<?php

namespace Database\Seeders;

use App\Models\Usuario as User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nome' => 'Admin',
            'email' => 'admin@escola.com',
            'password' => Hash::make('admin01'),
            'email_verified_at' => now(),
            'tipo' => 'Administrador',
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
            'curso_id' => null,
        ]);
        User::create([
            'nome' => 'Professor',
            'email' => 'professor@escola.com',
            'password' => Hash::make('professor01'),
            'email_verified_at' => now(),
            'tipo' => 'Professor',
            'matricula' => '0000000002',
            'cpf' => '111.111.111-11',
            'rg' => '111111111',
            'telefone' => '(11) 11111-1111',
            'data_nasc' => '1985-05-15',
            'pai' => 'Pai Professor',
            'mae' => 'Mãe Professor',
            'sexo' => 'Macho',
            'etnia' => 'Branca',
            'nacionalidade' => 'Brasileira',
            'naturalidade' => 'Rio de Janeiro',
            'pais' => 'Brasil',
            'uf' => 'RJ',
            'cep' => '11111-111',
            'bairro' => 'Botafogo',
            'rua' => 'Avenida Secundária',
            'numero_casa' => '456',
            'curso_id' => null,
        ]);
        User::create([
            'nome' => 'Aluno',
            'email' => 'aluno@escola.com',
            'password' => Hash::make('aluno01'),
            'email_verified_at' => now(),
            'tipo' => 'Aluno',
            'matricula' => '0000000003',
            'cpf' => '222.222.222-22',
            'rg' => '222222222',
            'telefone' => '(22) 22222-2222',
            'data_nasc' => '2005-08-20',
            'pai' => 'Pai Aluno',
            'mae' => 'Mãe Aluno',
            'sexo' => 'Fêmea',
            'etnia' => 'Parda',
            'nacionalidade' => 'Brasileira',
            'naturalidade' => 'Belo Horizonte',
            'pais' => 'Brasil',
            'uf' => 'MG',
            'cep' => '22222-222',
            'bairro' => 'Funcionários',
            'rua' => 'Rua Terciária',
            'numero_casa' => '789',
            'curso_id' => 1,
        ]);
        User::factory(10)->create();
    }
}
