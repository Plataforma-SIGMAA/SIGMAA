<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\DisciplinaEstudante;
use App\Models\Nota;
use App\Models\Plano_Ensino;
use App\Models\Tarefa;
use App\Models\Trimestre;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Models\Disciplina;


class DisciplinasController extends Controller
{
    public function index()
    {
        $disciplinas = Disciplina::all();

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
            'is_hidden' => 'required|in:true,false',
            'curso_id' => 'required',
            'professor_id' => 'required',
        ]);
    
        $disciplina = Disciplina::create($validated);

        if (!$disciplina) {
            return response()->json(['message' => 'Erro ao criar Disciplina'], 401);
        }

    
        return response()->json(['message' => 'Disciplina criada com sucesso!']);
    }

    public function show(string $disciplinaId, string $userId)
    {
        if (!is_numeric($disciplinaId)) {
            return response()->json(['message' => 'ID inválido'], 400);
        }
        // return $id;
        $disciplina = Disciplina::find($disciplinaId);

        if (!$disciplina) {
            return response()->json(['message' => 'Disciplina não encontrada'], 404);
        }

        $avaliacoes = Avaliacao::where('disciplina_id', $disciplinaId)->get();
        $estudantesIds = DisciplinaEstudante::where('disciplina_id', $disciplinaId)->get();
        
        $notasTrimestres = [];
        $estudantes = [];
        foreach ($estudantesIds as $estudante) {
            $estudantes[] = Usuario::find($estudante->estudante->id);
            if ($estudante->id == $userId) {
                $trimestres = Trimestre::where('disciplina_estudante_id', $estudante->id)->get();
                foreach ($trimestres as $trimestre) {
                    $notas = Nota::find($trimestre->trimestre->id)->get();
                    $notasTrimestres[] = [$trimestre, $notas];
                }
            }
        }

        $plano = Plano_Ensino::where('disciplina_id', $disciplinaId)->get();
        $tarefas = Tarefa::where('disciplina_id', $disciplinaId)->get();

        return response()->json([
            'disciplina' => $disciplina,
            'plano' => $plano,
            'avaliacoes' => $avaliacoes,
            'estudantes' => $estudantes,
            'tarefas' => $tarefas,
            'notas' => $notasTrimestres
        ], 200);

    }

    public function update(Request $request, string $id)
    {
        $disciplina = Disciplina::findOrFail($id);
    
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'ano' => 'required|integer',
            'is_hidden' => 'required|in:true,false',
            'curso_id' => 'required',
            'professor_id' => 'required',
        ]); 

        if (!$disciplina) {
            return response()->json(['message' => 'Disciplina não encontrada'], 404);
        }

        if (!$disciplina->save()) {
            return response()->json(['message' => 'Erro ao atualizar disciplina.'], 500);
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
