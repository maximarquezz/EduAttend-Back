<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use App\Mail\PasswordResetCodeMail;

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

        public function update(Request $request, $id)
    {
        try {
            if (!is_numeric($id)) {
                return response()->json([
                    'error' => 'La solicitud contiene errores (User).'
                ], 400);
            }

            $user = User::find($id);

            if (!$user) {
                return response()->json([
                    'error' => 'El recurso solicitado no existe (User).'
                ], 404);
            }

            $validated = $request->validate([
                'is_acepted' => 'sometimes|boolean',
                'name' => 'sometimes|string|max:255',
                'email' => 'sometimes|email|unique:users,email,' . $id,
                'phone' => 'sometimes|string',
                'address' => 'sometimes|string',
            ]);

            $user->update($validated);
            return response()->json($user, 200);

        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Datos inválidos.',
                'details' => $e->errors()
            ], 422);
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

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['error' => 'Email no encontrado'], 404);
        }
        
        $code = rand(100000, 999999); // 6 dígitos
        
        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['code' => $code, 'created_at' => now()]
        );
        
        Mail::to($request->email)->send(new PasswordResetCodeMail($code));
        
        return response()->json(['message' => 'Código enviado al email']);
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|size:6'
        ]);
        
        $reset = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('code', $request->code)
            ->first();
        
        if (!$reset || now()->diffInMinutes($reset->created_at) > 10) {
            return response()->json(['error' => 'Código inválido o expirado'], 400);
        }
        
        return response()->json(['message' => 'Código válido']);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|size:6',
            'password' => 'required|min:6|confirmed'
        ]);
        
        $reset = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('code', $request->code)
            ->first();
        
        if (!$reset || now()->diffInMinutes($reset->created_at) > 10) {
            return response()->json(['error' => 'Código inválido o expirado'], 400);
        }
        
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        
        DB::table('password_resets')->where('email', $request->email)->delete();
        
        return response()->json(['message' => 'Contraseña actualizada']);
    }

    public function getUserByDni($dni)
    {
        $user = User::where('dni', $dni)->first();
        
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        
        return response()->json([
            'email' => $user->email,
            'name' => $user->name
        ]);
    }
}