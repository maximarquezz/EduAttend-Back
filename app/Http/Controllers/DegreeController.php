<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use function PHPUnit\Framework\isInt;

class DegreeController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $degrees = Degree::all();
            if ($degrees->isEmpty()) {
                return response()->json('Aún no hay carreras.');
            }
            return response()->json($degrees, 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Degree).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'degree_name' => 'required|string|max:255'
            ]);

            $degree = Degree::create($validated);

            return response()->json($degree, 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                    'error' => 'Datos de validación incorrectos.',
                    'details' => $e->errors()
                ], 422);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Degree).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Degree $degree)
    {
        //
    }

    public function edit(Degree $degree)
    {
        //
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            if (!is_numeric($id)) {
                return response()->json([
                    'error' => 'La solicitud contiene errores (Degree).',
                ], 400);
            }

            $validated = $request->validate([
                'degree_name' => 'required|string|max:255'
            ]);

            $degree = Degree::find($id);

            if (!$degree) {
                return response()->json([
                    'error' => 'El recurso solicitado no existe (Degree).'
                ], 404);
            }

            $degree->update($validated);

            return response()->json($degree, 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Datos de validación incorrectos.',
                'details' => $e->errors()
            ], 422);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Degree).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            if (!is_numeric($id)) {
                return response()->json([
                    'error' => 'La solicitud contiene errores (Degree).'
                ], 400);
            }

            $degree = Degree::find($id);

            if (!$degree) {
                return response()->json([
                    'error' => 'El recurso solicitado no existe (Degree).'
                ], 404);
            }

            $degree->delete();

            return response()->json(null, 204);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Degree).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function degreeWithSubjects()
    {
        try {
            return Degree::with('subject')->get();
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Degree).',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
