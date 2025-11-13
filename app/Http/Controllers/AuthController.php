<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'dni' => 'required|string|unique:users',
            'phone' => 'required|string',
            'address' => 'required|string',
            'province_name' => 'required|string',
            'city_name' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'dni' => $request->dni,
            'phone' => $request->phone,
            'address' => $request->address,
            'province_name' => $request->province_name,
            'city_name' => $request->city_name,
        ]);

        // Asignar rol por defecto (e.g., estudiante)
        $user->assignRole('estudiante');

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User registered successfully!',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales proporcionadas son incorrectas.'],
            ]);
        }

        $user->tokens()->delete();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
            'roles' => $user->getRoleNames(), // Get roles
        ]);
    }

    public function logout(Request $request)
    {
        /** @var \Laravel\Sanctum\PersonalAccessToken|null $token */
        $token = $request->user()->currentAccessToken();

        if ($token) {
            $token->delete();
        }

        return response()->json(['message' => 'Logged out successfully!']);
    }

    public function index()
    {
        try {
            $users = User::all();
            if ($users->isEmpty()) {
                return response()->json('Aún no hay usuarios.');
            }
            return response()->json($users, 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (User).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function pendingUsers(){
        try {
            $users = User::where('is_acepted', 0)->get();
            if($users->isEmpty()){
                return response()->json('No hay usuarios pendientes.');
            }
            return response()->json($users, 200);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (User).',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}