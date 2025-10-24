<?php

namespace Database\Seeders;

use App\Models\TarefaEnviada;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TarefaEnviadaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TarefaEnviada::factory(30)->create();
    }
}
