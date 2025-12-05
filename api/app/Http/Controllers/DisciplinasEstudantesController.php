<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DisciplinaEstudante;
use Illuminate\Http\Request;
use User;

class DisciplinasEstudantesController extends Controller
{
    public function find($id)
    {
        $disciplinas_estudantes = DisciplinaEstudante::where('disciplina_id', $id)->get();

        return response()->json($disciplinas_estudantes, 200);
    }
}
