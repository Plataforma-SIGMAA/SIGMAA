<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciplina;
use App\Models\Usuario;

class DisciplinasController extends Controller
{
    public function index(){
        
    $disciplinas = Disciplina::with('professor')->get();

    if ($disciplinas->isEmpty()) {
        return response()->json(['message' => 'Nenhuma disciplina encontrada'], 404);
    }

    return response()->json($disciplinas, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'ano' => 'required|integer',
            'is_oculto' => 'required|boolean',
            'icone' => 'nullable|string|max:255',
            'curso_id' => 'required',
            'professor_id' => 'required',
        ]);
    
        $disciplina = Disciplina::create($validated);

        if (!$disciplina) {
            return response()->json(['message' => 'Erro ao criar Disciplina'], 401);
        }

    
        return response()->json(['message' => 'Disciplina criada com sucesso!']);
    }

    public function show(string $id)
    {
        if (!is_numeric($id)) {
            return response()->json(['message' => 'ID inválido'], 400);
        }

        $disciplina = Disciplina::find($id);

        if (!$disciplina) {
            return response()->json(['message' => 'Disciplina não encontrada'], 404);
        }

        return response()->json($disciplina, 200);
    }

    public function update(Request $request, string $id)
    {
        $disciplina = Disciplina::findOrFail($id);
    
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'ano' => 'required|integer',
            'is_oculto' => 'required|boolean',
            'icone' => 'nullable|string|max:255',
            'curso_id' => 'required',
            'professor_id' => 'required',
        ]); 

        if (!$disciplina) {
            return response()->json(['message' => 'Disciplina não encontrada'], 404);
        }

        $disciplina->update($validated);

        return response()->json(['message' => 'Disciplina atualizada com sucesso!'], 200);
            
    }

    public function destroy(string $id)
    {
        $disciplina = Disciplina::findOrFail($id);
        

        return redirect()->route('disciplinas.index')->with('success', 'Disciplina excluída com sucesso!');


        if (!$disciplina) {
            return response()->json(['message' => 'Disciplina não encontrada'], 404);
        }
        
        $disciplina->delete();

        return response()->json(['message' => 'Disciplina excluída com sucesso!'], 200);
    }
}
