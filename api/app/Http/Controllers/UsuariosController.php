<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Models\User;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();

        if ($usuarios->isEmpty()) {
            return response()->json(['message' => 'Nenhum Usuario encontrado'], 404);
        }

        return response()->json($usuarios, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'matricula' => 'required|string|max:255',
            'cpf' => 'required|numeric:strict|max:14',
            'rg' => 'nullable|numeric:strict|max:10',
            'telefone' => 'nullable',
            'email' => 'required|string|max:255|unique',
            'data_nasc' => 'required|date',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'pai' => 'required|string|max:255',
            'mae' => 'required|string|max:255',
            'sexo' => 'required|in:masculino,feminino,intersexo',
            'etnia' => 'required|in:Branca,Preta,Parda,Amarela,Indígena',
            'nacionalidade' => 'required|string|max:255',
            'naturalidade' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
            'uf' => 'required|string|max:255',
            'cep' => 'required|string|max:8',
            'bairro' => 'required|string|max:255',
            'rua' => 'required|string|max:255',
            'numero_casa' => 'nullable|string|max:10',
            'nivel' => 'required|string|max:255',
            'curso_id' => 'required'
            'password' => 'required'
        ]);
    
        $usuario = usuario::create($validated);

        if (!$usuario) {
            return response()->json(['message' => 'Erro ao criar usuario'], 401);
        }

    
        return response()->json(['message' => 'Usuario criado com sucesso!'])
    }

    public function show(string $id)
    {
        if (!is_numeric($id)) {
            return response()->json(['message' => 'ID inválido'], 400);
        }

        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuario não encontrado'], 404);
        }

        return response()->json($usuario, 200);
    }

    public function update(Request $request, string $id)
    {
        $usuario = Usuario::findOrFail($id);
    
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'matricula' => 'required|string|max:255',
            'cpf' => 'required|numeric:strict|max:14',
            'rg' => 'nullable|numeric:strict|max:10',
            'telefone' => 'nullable',
            'email' => 'required|string|max:255|unique',
            'data_nasc' => 'required|date',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'pai' => 'required|string|max:255',
            'mae' => 'required|string|max:255',
            'sexo' => 'required|in:masculino,feminino,intersexo',
            'etnia' => 'required|in:Branca,Preta,Parda,Amarela,Indígena',
            'nacionalidade' => 'required|string|max:255',
            'naturalidade' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
            'uf' => 'required|string|max:255',
            'cep' => 'required|string|max:8',
            'bairro' => 'required|string|max:255',
            'rua' => 'required|string|max:255',
            'numero_casa' => 'nullable|string|max:10',
            'nivel' => 'required|string|max:255',
            'curso_id' => 'required'
            'password' => 'required'
        ]); 

        if (!$usuario) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        if (!$usuario->save()) {
            return response()->json(['message' => 'Erro ao atualizar usuário.'], 500);
        }

        $usuario->update($validated);
        return response()->json(['message' => 'Usuário atualizado com sucesso!'], 200);
    }

    public function destroy(string $id)
    {
        $usuario = usuario::findOrFail($id);
        
        return redirect()->route('usuarios.index')->with('success', 'Usuário excluído com sucesso!');

        if (!$usuario) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }
        
        $usuario->delete();

        return response()->json(['message' => 'Usuário excluído com sucesso!'], 200);
    }
}
