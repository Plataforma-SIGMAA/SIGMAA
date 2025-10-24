<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TopicosController extends Controller
{
    public function index()
    {
        $topicos = Topico::all();

        if ($topicos->isEmpty()) {
            return response()->json(['message' => 'Nenhum tópico encontrado'], 404);
        }

        return response()->json($topicos, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'data' => 'required|date',
            'disciplina_id' => 'required',
        ]);
    
        $topico = Topico::create($validated);

        if (!$topico) {
            return response()->json(['message' => 'Erro ao criar tópico'], 401);
        }

    
        return response()->json(['message' => 'Topico criado com sucesso!'])
    }

    public function show(string $id)
    {
        if (!is_numeric($id)) {
            return response()->json(['message' => 'ID inválido'], 400);
        }

        $topico = Topico::find($id);

        if (!$topico) {
            return response()->json(['message' => 'tópico não encontrado'], 404);
        }

        return response()->json($topico, 200);
    }

    public function update(Request $request, string $id)
    {
        $topico = Topico::findOrFail($id);
    
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'data' => 'required|date',
            'disciplina_id' => 'required',
        ]); 

        if (!$topico) {
            return response()->json(['message' => 'Tópico não encontrado'], 404);
        }

        if (!$topico->save()) {
            return response()->json(['message' => 'Erro ao atualizar Tópico.'], 500);
        }

        $topico->update($validated);
        return response()->json(['message' => 'Tópico atualizado com sucesso!'], 200);
    }

    public function destroy(string $id)
    {
        $topico = Topico::findOrFail($id);
        
        return redirect()->route('topicos.index')->with('success', 'Tópico excluído com sucesso!');

        if (!$topico) {
            return response()->json(['message' => 'Tópico não encontrado'], 404);
        }
        
        $topico->delete();

        return response()->json(['message' => 'Tópico excluído com sucesso!'], 200);
    }
}
