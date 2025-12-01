<?php

namespace Database\Seeders;
use App\Models\Usuario as User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([

            CursoSeeder::class,
            UsuarioSeeder::class,
            DisciplinaSeeder::class,
            Plano_EnsinoSeeder::class,
            AvaliacaoSeeder::class,

            DisciplinaEstudanteSeeder::class,
            TrimestreSeeder::class,
            NotaSeeder::class,
            ReferenciaSeeder::class,
            TarefaSeeder::class,
            TarefaEnviadaSeeder::class,
            TopicoSeeder::class,
        ]);
    }
}



