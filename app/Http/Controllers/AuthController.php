<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function signUp(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|string'
        ]);
        $user = User::create($validated);
        $token = $user->createToken('api_token')->plainTextToken;
        return response()->json([
            'message' => 'Usuario registrado correctamente',
            'user' => $user,
        ], 201);
    }

    function login(Request $request) {
        $validated = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        $user = User::where('email', $validated['email'])->first();
        if (!$user || Hash::check($validated['password'], $user->password)) {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        } else {
            $token = $user->createToken('api_token')->plainTextToken;
            return response()->json([
                'user' => $user,
                'token' => $token,
            ]);
        }
    }

    function logOut(Request $request) {
        
    }

    function getMe(Request $request) {
        return response()->json($request->user());
    }
}
