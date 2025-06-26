<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        // 1. Valida as credenciais recebidas
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Tenta encontrar o usuário pelo e-mail
        $user = User::where('email', $credentials['email'])->first();

        // 3. Verifica se o usuário existe e se a senha está correta
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'E-mail ou senha inválidos'], 401);
        }

        // 4. Se autenticado, cria um novo token para o usuário
        // É uma boa prática revogar tokens antigos se você não quiser múltiplos tokens ativos para o mesmo login.
        // Opcional: $user->tokens()->delete(); // Revoga todos os tokens anteriores do usuário
        $token = $user->createToken('api_token')->plainTextToken;

        // 5. Retorna o usuário (com campos específicos) e o token em JSON
        return response()->json([
            // Use only() para selecionar quais campos do usuário você quer enviar para o frontend.
            // Evita enviar dados sensíveis ou desnecessários como 'password', 'two_factor_secret', etc.
            'user' => $user->only('id', 'name', 'email'), 
            'token' => $token,
            'message' => 'Login bem-sucedido!', // Mensagem de sucesso opcional
        ]);
    }
}