<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Models\Curso;

class CursosController extends Controller
{

    public function index()
    {
        $cursos = Curso::all();

        if ($cursos->isEmpty()) {
            return response()->json(['message' => 'Nenhum curso encontrado'], 404);
        }

        return response()->json($cursos, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'objetivo' => 'required|text',
            'carga_horaria_estagio' => 'nullable',
            'horas_complementares' => 'nullable',
        ]);
    
        $curso = Curso::create($validated);

        if (!$curso) {
            return response()->json(['message' => 'Erro ao criar curso'], 401);
        }

    
        return response()->json(['message' => 'Curso criado com sucesso!']);
    }

    public function show(string $id)
    {
        if (!is_numeric($id)) {
            return response()->json(['message' => 'ID inválido'], 400);
        }

        $curso = Curso::find($id);

        if (!$curso) {
            return response()->json(['message' => 'Curso não encontrado'], 404);
        }

        return response()->json($curso, 200);
    }

    public function update(Request $request, string $id)
    {
        $curso = Curso::findOrFail($id);
    
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'objetivo' => 'required|text',
            'carga_horaria_estagio' => 'nullable',
            'horas_complementares' => 'nullable',
        ]); 

        if (!$curso) {
            return response()->json(['message' => 'Curso não encontrado'], 404);
        }

        if (!$curso->save()) {
            return response()->json(['message' => 'Erro ao atualizar curso.'], 500);
        }

        $curso->update($validated);
        return response()->json(['message' => 'Curso atualizado com sucesso!'], 200);
    }

    public function destroy(string $id)
    {
        $curso = Curso::findOrFail($id);
        
        return redirect()->route('cursos.index')->with('success', 'curso excluído com sucesso!');

        if (!$curso) {
            return response()->json(['message' => 'Curso não encontrado'], 404);
        }
        
        $curso->delete();

        return response()->json(['message' => 'Curso excluído com sucesso!'], 200);
    }
}
