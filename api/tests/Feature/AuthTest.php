<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

uses(TestCase::class, RefreshDatabase::class);

it('pretende criar um usuário!', function () {
    $data = [
        'nome' => 'Fulaninho da Silva',
        'email' => 'fulano@teste.com',
        'password' => '123456',
        'c_password' => '123456',
    ];

    $response = $this->postJson('api/auth/register', $data);

    dump($response->json());

    $response->assertStatus(200);
    $this->assertDatabaseHas('users', [
        'email' => 'fulano@teste.com',
    ]);
});

it('pretende logar', function () {
    $user = User::create([
        'nome' => 'Teste User',
        'email' => 'teste@teste.com',
        'password' => bcrypt('123456'),
    ]);

    $credentials = [
        'email' => 'teste@teste.com',
        'password' => '123456',
    ];

    $response = $this->postJson('api/auth/login', $credentials);

    $response->assertStatus(200);

});