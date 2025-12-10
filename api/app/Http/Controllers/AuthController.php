<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\Curso;
use App\Models\Disciplina;
use App\Models\DisciplinaEstudante;
use App\Models\Usuario as User;
use Hash;
use Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AuthController extends BaseController
{

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $success['user'] = $user;

        return $this->sendResponse($success, 'User register successfully.');
    }


    public function login()
    {
        $credentials = request(['email', 'password']);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user OR !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['erro' => 'Credenciais inválidas'], 404);
        }

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['erro' => 'JWT falhou no attempt()'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function profile()
    {
        $user = auth()->user();

        $tipo = strtolower($user->tipo ?? '');

        $userData = $user->toArray();

        $dataHoje = Carbon::now()->startOfDay();
        $dataFim = Carbon::now()->addDays(15)->endOfDay();

        if ($tipo === 'aluno') {
            $curso = Curso::find($user->curso_id)->pluck('nome')->first() ?? null;

            $userData['curso'] = $curso;

            $records = DisciplinaEstudante::where('estudante_id', $user->id)
                ->with([
                    'disciplina' => function ($q) {
                        $q->with('curso');
                    }
                ])
                ->get();

            $disciplinas = $records->map(function ($rec) {
                $d = $rec->disciplina;
                if (!$d)
                    return null;

                return [
                    'id' => $d->id,
                    'nome' => $d->nome,
                    'ano' => $d->ano ?? null,
                    'icone' => $d->icone ?? null,
                    'curso' => $d->curso ? [
                        'id' => $d->curso->id,
                        'nome' => $d->curso->nome,
                    ] : null,
                ];
            })->filter()->values();

            $userData['disciplinas'] = $disciplinas;

            $disciplinaIds = $records->pluck('disciplina_id')->toArray();
            $avaliacoes = Avaliacao::whereIn('disciplina_id', $disciplinaIds)
                ->whereBetween('data', [$dataHoje, $dataFim])
                ->with('disciplina')
                ->orderBy('data', 'asc')
                ->get();

            $avaliacoesMapeadas = $avaliacoes->map(function ($av) {
                return [
                    'id' => $av->id,
                    'descricao' => $av->desc,
                    'data' => $av->data,
                    'horarios' => $av->horarios,
                    'disciplina' => [
                        'id' => $av->disciplina->id,
                        'nome' => $av->disciplina->nome,
                    ],
                ];
            })->values();

            $userData['avaliacoes_proximas'] = $avaliacoesMapeadas;

        } elseif ($tipo === 'professor') {
            $records = Disciplina::where('professor_id', $user->id)
                ->with('curso')
                ->get();

            $disciplinas = $records->map(function ($d) {
                return [
                    'id' => $d->id,
                    'nome' => $d->nome,
                    'ano' => $d->ano ?? null,
                    'icone' => $d->icone ?? null,
                    'curso' => $d->curso ? [
                        'id' => $d->curso->id,
                        'nome' => $d->curso->nome,
                    ] : null,
                ];
            })->values();

            $userData['disciplinas'] = $disciplinas;

            $disciplinaIds = $records->pluck('id')->toArray();
            $avaliacoes = Avaliacao::whereIn('disciplina_id', $disciplinaIds)
                ->whereBetween('data', [$dataHoje, $dataFim])
                ->with('disciplina')
                ->orderBy('data', 'asc')
                ->get();

            $avaliacoesMapeadas = $avaliacoes->map(function ($av) {
                return [
                    'id' => $av->id,
                    'descricao' => $av->desc,
                    'data' => $av->data,
                    'horarios' => $av->horarios,
                    'disciplina' => [
                        'id' => $av->disciplina->id,
                        'nome' => $av->disciplina->nome,
                    ],
                ];
            })->values();

            $userData['avaliacoes_proximas'] = $avaliacoesMapeadas;
        } else {
            $userData['disciplinas'] = [];
            $userData['avaliacoes_proximas'] = [];
        }

        return response()->json([
            'status' => true,
            'data' => $userData,
            'message' => 'Perfil carregado com sucesso.'
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return $this->sendResponse([], 'Successfully logged out.');
    }


    public function refresh()
    {
        $success = $this->respondWithToken(auth()->refresh());

        return $this->sendResponse($success, 'Refresh token return successfully.');
    }

    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
}