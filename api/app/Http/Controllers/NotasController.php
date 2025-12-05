<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Nota;
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

    public function find()
    {
        $notas = Nota::where('trimestre_id')->get();
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
}
