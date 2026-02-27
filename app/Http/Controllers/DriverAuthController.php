<?php

namespace App\Http\Controllers;

use App\Models\Drivers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class DriverAuthController extends Controller
{
    /**
     * Login do motorista
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $driver = Drivers::where('email', $request->email)->first();

        if (!$driver || !Hash::check($request->password, $driver->password)) {
            throw ValidationException::withMessages([
                'email' => ['As credenciais fornecidas estão incorretas.'],
            ]);
        }

        // Criar token de acesso
        $token = $driver->createToken('driver-app')->plainTextToken;

        return response()->json([
            'message' => 'Login realizado com sucesso.',
            'driver' => $driver,
            'token' => $token,
        ], 200);
    }

    /**
     * Retorna os dados do motorista autenticado
     */
    public function me(Request $request): JsonResponse
    {
        return response()->json([
            'driver' => $request->user(),
        ], 200);
    }

    /**
     * Logout do motorista
     */
    public function logout(Request $request): JsonResponse
    {
        // Revoga o token atual
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout realizado com sucesso.',
        ], 200);
    }

    /**
     * Revoga todos os tokens do motorista
     */
    public function logoutAll(Request $request): JsonResponse
    {
        // Revoga todos os tokens
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout realizado em todos os dispositivos.',
        ], 200);
    }
}
