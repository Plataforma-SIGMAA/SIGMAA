<?php

namespace Database\Seeders;

use App\Models\DisciplinaEstudante;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DisciplinaEstudanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DisciplinaEstudante::factory(12)->create();
    }
}
