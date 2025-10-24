<?php

namespace Database\Seeders;

use App\Models\Plano_Ensino;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Plano_EnsinoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plano_Ensino::factory(10)->create();
    }
}
