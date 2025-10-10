<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Assessment;
use App\Model\User;


class AssessmentController extends Controller
{
    public function index() 
    {
        $assessment = Assessment::all();
        return response()->json($assessment); 
    }

    public function store(Request $request) 
    {
        $request->validate([
            'descricao' => 'required|string|max:255',
            'data' => 'required|date',
            'hora' => 'required',
            'disciplina_id' => 'required|integer|exists:disciplinas,id',
        ]);

        $user = auth()->user();

        return view('plans');
    }

    public function create() 
    {
        $assessment = Assessment::create([
            'descricao'=> $request->descricao,
            'data'=> $request->data,
            'hora'=> $request->hora,
            'disciplina_id'=> $request->disciplina_id,
        ]);
            
        return response()->json(['message' => 'Avaliação criada com sucesso!'], 201);
    }

    public function show($id) 
    {
        $assessment = Assessment::find($id);
        return response()->json("assessment",$assessment , 200);
    }

    public function edit($id) 
    {
        
    }

    public function update(Request $request, $id) 
    {
        $assessment = Assessment::find($id);
        $assessment->update($request->all());
        return response()->json(['message' => 'Avaliação atualizada com sucesso!'], 200);
    }

    public function destroy($id)
    {
        $assessment = Assessment::find($id);
        $assessment->delete();
        return redirect("plans")->with(['message' => 'Avaliação excluída com sucesso!'], 200);
    }
}
