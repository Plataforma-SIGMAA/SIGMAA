<?php

namespace Database\Seeders;

use App\Models\Curso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Curso::Create([
            'nome'=>'Técnico em Informática para Internet',
            'objetivo'=>'Desenvolver habilidades de informática',
            'carga_horaria_estagio'=>'200',
            'horas_complementares'=>'0',
        ]);

        Curso::Create([
            'nome'=>'Técnico em Agropecuária',
            'objetivo'=>'Desenvolver habilidades de agropecuária',
            'carga_horaria_estagio'=>'200',
            'horas_complementares'=>'40',
        ]);

        Curso::Create([
            'nome'=>'Técnico em Enologia e Viticultura',
            'objetivo'=>'Desenvolver habilidades de enologia',
            'carga_horaria_estagio'=>'140',
            'horas_complementares'=>'0',
        ]);

        Curso::Create([
            'nome'=>'Técnico em Meio Ambiente',
            'objetivo'=>'Desenvolver habilidades de conservação ambiental',
            'carga_horaria_estagio'=>'0',
            'horas_complementares'=>'40',
        ]);

        Curso::Create([
            'nome'=>'Técnico em Administração',
            'objetivo'=>'Desenvolver habilidades de administração',
            'carga_horaria_estagio'=>'0',
            'horas_complementares'=>'0',
        ]);
    }
}
