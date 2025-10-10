<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\TeachingPlan;
use App\Model\User;


class TeachingPlansController extends Controller
{
    public function index() 
    {
        $plans = TeachingPlan::all();
        return response()->json($plans);
    }

    public function store(Request $request) 
    {

    }

    public function create() 
    {
        // $plans TeachingPlan::create([
        //     'titulo' => 'required|string|max:255',
        //     'descricao' => 'required|string',
        //     'data_criacao' => 'required|date',
        //     'disciplina_id' => 'required|integer|exists:disciplinas,id',
        // ]);

        // $user = User::find(auth()->user()->id);
        // return response()->json($plan, );

    }

    public function show($id) 
    {

    }

    public function edit($id) 
    {

    }

    public function update(Request $request, $id) 
    {

    }

    public function destroy($id)
    {
        
    }
}
