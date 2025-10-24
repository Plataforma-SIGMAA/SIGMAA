<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Models\TeachingPlan;

class TeachingPlansController extends Controller
{
    public function index() 
    {
        $plans = TeachingPlan::all();

        if ($plans->isEmpty()) {
            return response()->json(['message' => 'Nenhum plano encontrado!'], 404);
        }
        return response()->json($plans);
    }

    public function store(Request $request) 
    {
        $request->validate([
            'id' => 'required|integer',
            'titulo' => 'required|string|max:255',
            'modalidade' => 'required|string|max:255',
            'horarios' => 'required|string|max:255',
            'ementa' => 'required|string',
            'ano' => 'required|integer',
            'carga_horaria' => 'required|integer',
            'turno' => 'required|string|max:255',
            'objetivo' => 'required|string',
            'metodologia' => 'required|string',
            'metodos_avaliacao' => 'required|string',
            'criterio_avaliacao' => 'required|string',
            'horario_atendimento' => 'required|string|max:255',
            'disciplina_id' => 'required|integer|exists:disciplinas,id',
        ]);

        $plan = TeachingPlan::create($request->all());
        return response()->json(['message' => 'Plano de ensino criado com sucesso'] ,200);
    }

    public function create() 
    {
        $plans = TeachingPlan::create([
            'id'=> $request->id,
            'titulo'=> $request->titulo,
            'modalidade'=> $request->modalidade,
            'horarios'=> $request->horarios,
            'ementa'=> $request->ementa,
            'ano'=> $request->ano,
            'carga_horaria'=> $request->carga_horaria,
            'turno'=> $request->turno,
            'objetivo'=> $request->objetivo,
            'metodologia'=> $request->metodologia,
            'metodos_avaliacao'=> $request->metodos_avaliacao,
            'criterio_avaliacao'=> $request->criterio_avaliacao,
            'horario_atendimento'=> $request->horario_atendimento,
            'disciplina_id'=> $request->disciplina_id,
        ]);
        
        return response()->json($plans, );

    }

    public function show($id) 
    {
        $plan = TeachingPlan::find($id);
        return response()->json("plan",$plan , 200);
    }

    public function edit($id) 
    {

    }

    public function update(Request $request, $id) 
    {
        $plan = TeachingPlan::find($id);
        $plan->update($request->all());
        return response()->json(['message' => 'Plano de ensino atualizado com sucesso!'], 200);
    }

    public function destroy($id)
    {
        $plan = TeachingPlan::find($id);
        $plan->delete();
        return response()->json(['message' => 'Plano de ensino deletado com sucesso!'], 200);
    }
}
