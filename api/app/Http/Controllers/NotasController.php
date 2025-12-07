<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Disciplina;
use App\Models\DisciplinaEstudante;
use App\Models\Nota;
use App\Models\Trimestre;
use App\Models\Usuario;
use Illuminate\Http\Request;

class NotasController extends Controller
{
    public function index()
    {
        $notas = Nota::all();

        if ($notas->isEmpty()) {
            return response()->json(['message' => 'Nenhuma nota encontrada'], 404);
        }

        return response()->json($notas, 200);
    }

    public function find($id)
    {
        $disciplina = Disciplina::find($id);
        $disciplinas_estudantes = DisciplinaEstudante::with("trimestres.notas")->where('disciplina_id', $id)->get();

        $estudantes_ids = [];

        foreach ($disciplinas_estudantes as $disciplina_estudante) {
            $estudantes_ids[] = $disciplina_estudante->estudante_id;
        }

        $estudantes = Usuario::whereIn('id', $estudantes_ids)->orderBy('nome','asc')->get();
        $estudantes_dados=[];

        foreach ($estudantes as $estudante) {
            $estudantes_dados[] = [$estudante->nome, $estudante->id, $estudante->matricula];
        }

        return response()->json([$disciplinas_estudantes, $estudantes_dados, $disciplina], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'avaliacao' => 'required|string|max:255',
            'peso' => 'required|float',
            'nota_obtida' => 'required|float',
            'trimestre_id' => 'required',
            'is_recuperacao' => 'required|boolean',
        ]);
    
        $nota = Nota::create($validated);

        if (!$nota) {
            return response()->json(['message' => 'Erro ao criar nota'], 401);
        }

    
        return response()->json(['message' => 'nota criada com sucesso!']);
    }

    public function salvarNotas(Request $request)
{
    foreach ($request->notas as $dado) {
        $disciplina_estudante = DisciplinaEstudante::where('disciplina_id', $dado['disciplina_id'])
            ->where('estudante_id', $dado['estudante_id'])
            ->first();
        
        if (!$disciplina_estudante) continue;
        
        $trimestre = Trimestre::where('disciplina_estudante_id', $disciplina_estudante->id)
            ->where('numero', $dado['trimestre'])
            ->first();
        
        if (!$trimestre) continue;
        
        $nota = Nota::where('trimestre_id', $trimestre->id)
            ->where('avaliacao', $dado['nome_avaliacao'])
            ->first();
        
        if ($nota) {
            $nota->nota_obtida = $dado['nota'];
            $nota->save();
        } else {
            $peso_exemplo = Nota::where('avaliacao', $dado['nome_avaliacao'])
                ->whereHas('trimestre', function($q) use ($trimestre) {
                    $q->where('numero', $trimestre->numero);
                })
                ->value('peso');
            
            Nota::create([
                'trimestre_id' => $trimestre->id,
                'avaliacao' => $dado['nome_avaliacao'],
                'nota_obtida' => $dado['nota'],
                'peso' => $peso_exemplo ?? 1.0,
                'is_recuperacao' => false
            ]);
        }
    }
    
    return response()->json(['success' => true, 'message' => 'Notas salvas com sucesso!']);
}
}
