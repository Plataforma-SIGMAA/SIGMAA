<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
    public function index($id) 
    {
        $avaliacao = Avaliacao::where('disciplina_id', $id)->get();

        if ($avaliacao->isEmpty()) {
            return response()->json(['message' => 'Nenhuma avaliação encontrada'], 404);
        }

        return response()->json($avaliacao, 200); 
    }

    public function store(Request $request) 
    {
        $validated = $request->validate([
            'desc' => 'required|string|max:255',
            'data' => 'required|date',
            'horario' => 'required|string',
            'disciplina_id' => 'required|integer|exists:disciplinas,id',
        ]);

        $avaliacao = Avaliacao::create($validated);

        if (!$avaliacao) {
            return response()->json(['message' => 'Erro ao criar avaliação'], 401);
        }

        return response()->json(['message' => 'Avaliação criada com sucesso!'], 201);
    }

    public function show(string $id) 
    {
        if (!is_numeric($id)) {
            return response()->json(['message' => 'ID inválido'], 400);
        }

        $avaliacao = Avaliacao::find($id);

        if (!$avaliacao) {
            return response()->json(['message' => 'Avaliação não encontrada'], 404);
        }

        return response()->json(["avaliacao"=> $avaliacao] , 200);
    }

    public function update(Request $request) 
    {

        $validated = $request->validate([
            'id' => 'required|integer|exists:avaliacoes,id',
            'desc' => 'required|string|max:255',
            'data' => 'required|date',
            'horario' => 'required|string',
            'disciplina_id' => 'required|integer|exists:disciplinas,id',
        ]);

        $avaliacao = Avaliacao::findOrFail($validated['id']);
        unset($validated['id']);
        $avaliacao->update($validated);
        

        return response()->json(['message' => 'Avaliação atualizada com sucesso!'], 200);
    }

    public function destroy(string $id)
    {
        $avaliacao = Avaliacao::findOrFail($id);

        if (!$avaliacao) {
            return response()->json(['message' => 'Avaliação não encontrada'], 404);
        }

        $avaliacao->delete();

        return response()->json(['message' => 'Avaliação excluída com sucesso!'], 200);

    }
}
