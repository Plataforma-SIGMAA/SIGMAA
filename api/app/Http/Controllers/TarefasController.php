<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TarefasController extends Controller
{
    public function index()
    {
        $tarefas = Tarefa::all();

        if ($tarefas->isEmpty()) {
            return response()->json(['message' => 'Nenhuma tarefa encontrado'], 404);
        }

        return response()->json($tarefas, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|text',
            'data_final' => 'required',
            'tipo' => 'required|string|max:255',
            'disciplina_id' => 'required',
        ]);
    
        $tarefa = Tarefa::create($validated);

        if (!$tarefa) {
            return response()->json(['message' => 'Erro ao criar tarefa'], 401);
        }

    
        return response()->json(['message' => 'tarefa criada com sucesso!'])
    }

    public function show(string $id)
    {
        if (!is_numeric($id)) {
            return response()->json(['message' => 'ID inválido'], 400);
        }

        $tarefa = Tarefa::find($id);

        if (!$tarefa) {
            return response()->json(['message' => 'tarefa não encontrado'], 404);
        }

        return response()->json($tarefa, 200);
    }

    public function update(Request $request, string $id)
    {
        $tarefa = Tarefa::findOrFail($id);
    
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|text',
            'data_final' => 'required',
            'tipo' => 'required|string|max:255',
            'disciplina_id' => 'required',
        ]); 

        if (!$tarefa) {
            return response()->json(['message' => 'Tarefa não encontrado'], 404);
        }

        if (!$tarefa->save()) {
            return response()->json(['message' => 'Erro ao atualizar Tarefa.'], 500);
        }

        $tarefa->update($validated);
        return response()->json(['message' => 'Tarefa atualizado com sucesso!'], 200);
    }

    public function destroy(string $id)
    {
        $tarefa = Tarefa::findOrFail($id);
        
        return redirect()->route('tarefas.index')->with('success', 'Tarefa excluído com sucesso!');

        if (!$tarefa) {
            return response()->json(['message' => 'Tarefa não encontrado'], 404);
        }
        
        $tarefa->delete();

        return response()->json(['message' => 'Tarefa excluído com sucesso!'], 200);
    }
}
