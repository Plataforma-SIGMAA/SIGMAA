<?php

namespace App\Http\Controllers;

use App\Models\Usuario as User;
use Hash;
use Validator;
use Illuminate\Http\Request;

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

        if (!$user OR !\Hash::check($credentials['password'], $user->password)) {
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

        return response()->json([
            'status' => true,
            'data' => $user,
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