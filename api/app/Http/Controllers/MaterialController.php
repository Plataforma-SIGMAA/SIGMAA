<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Mateial;
use App\Model\User;

class MaterialController extends Controller
{
    public function index() 
    {
        $material = Material::orderBy("id","desc")->paginate(10);
        return response()->json($material , 200);
    }

    public function store(Request $request) 
    {
        $request->validate([
            'nome_arquivo' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'caminho' => 'required|string|max:255',
            'data_upload' => 'required|date',
            'disciplina_id' => 'required|integer|exists:disciplinas,id',
        ]);

        $material = Material::create($request->all());
        return response()->json(['message' => 'Material adicionado com sucesso'] ,200);
    }

    public function create() 
    {
        $material = Material::create([
            'nome_arquivo'=> $request->nome_arquivo,
            'url'=> $request->url,
            'caminho'=> $request->caminho,
            'data_upload'=> $request->data_upload,
            'disciplina_id'=> $request->disciplina_id,
        ]);


        return response()->json(['message'=> 'Material adicionado com sucesso!'] ,200);
    }

    public function show($id) 
    {
        $material = Material::findOrFail($id);
        return response()->json($material ,200);
    }

    public function edit($id) 
    {
        
    }

    public function update(Request $request, $id) 
    {
        $request->validate([
            'nome_arquivo' => 'sometimes|required|string|max:255',
            'url' => 'sometimes|required|string|max:255',
            'caminho' => 'sometimes|required|string|max:255',
            'data_upload' => 'sometimes|required|date',
            'disciplina_id' => 'sometimes|required|integer|exists:disciplinas,id',
        ]);

        $material = Material::find($id);

        return response()->json(['message' => 'Materiais atualizados com sucesso!'], 200);
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();
        return response()->json(['message'=> 'Material excluído com sucesso!'] ,200);
    }
}
