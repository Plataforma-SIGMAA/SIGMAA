<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Hash;
use Carbon\Carbon;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();

        if ($usuarios->isEmpty()) {
            return response()->json(['message' => 'Nenhum usuário encontrado'], 404);
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
            'curso_id' => 'required',
            'password' => 'required'
        ]);

        $usuario = usuario::create($validated);

        if (!$usuario) {
            return response()->json(['message' => 'Erro ao criar usuário'], 401);
        }


        return response()->json(['message' => 'Usuário criado com sucesso!']);
    }

    public function show(string $id)
    {
        if (!is_numeric($id)) {
            return response()->json(['message' => 'ID inválido'], 400);
        }

        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        return response()->json($usuario, 200);
    }

    public function update(Request $request, string $id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuário não encontrado.'], 404);
        }
        $validated = $request->validate([
            'telefone' => 'nullable|string|max:20',
            'email' => 'required|email|max:255|unique:usuarios,email,' . $usuario->id,
            'sexo' => 'required|in:Macho,Fêmea,Intersexo',
            'etnia' => 'required|in:Branca,Preta,Parda,Amarela,Indígena',
            'pais' => 'required|string|max:255',
            'uf' => 'required|string|max:2',
            'cep' => 'required|string|max:8',
            'bairro' => 'required|string|max:255',
            'rua' => 'required|string|max:255',
            'numero_casa' => 'nullable|string|max:10',
            'nacionalidade' => 'required|string|max:255',
            'naturalidade' => 'required|string|max:255',

            'password' => 'nullable|string',
            'newPassword' => 'nullable|string|min:8',
            'confirmPassword' => 'nullable|string|min:8',
        ]);

        if ($validated['email'] !== $usuario->email) {
            $validated['email_verified_at'] = Carbon::now();
        }

        $querTrocarSenha =
            $request->filled('password') ||
            $request->filled('newPassword') ||
            $request->filled('confirmPassword');

        if ($querTrocarSenha) {

            if (
                !$request->filled('password') ||
                !$request->filled('newPassword') ||
                !$request->filled('confirmPassword')
            ) {
                return response()->json([
                    'message' => 'Para alterar a senha, preencha todos os campos de senha.'
                ], 422);
            }

            if (!Hash::check($request->password, $usuario->password)) {
                return response()->json([
                    'message' => 'Senha atual incorreta.'
                ], 401);
            }

            if ($request->newPassword !== $request->confirmPassword) {
                return response()->json([
                    'message' => 'A confirmação da nova senha não confere.'
                ], 422);
            }

            if (strlen($request->newPassword) < 8) {
                return response()->json([
                    'message' => 'A nova senha deve ter no mínimo 8 caracteres.'
                ], 422);
            }

            $usuario->password = Hash::make($request->newPassword);
        }

        if (!$usuario->update($validated)) {
            return response()->json([
                'message' => 'Erro ao atualizar os dados do usuário.'
            ], 500);
        }

        return response()->json([
            'message' => 'Dados atualizados com sucesso.',
            'user' => $usuario
        ], 200);
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
