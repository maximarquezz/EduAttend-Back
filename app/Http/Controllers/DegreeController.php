<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isInt;

class DegreeController extends Controller
{
    public function index()
    {
        try {
            $degrees = Degree::all();
            if ($degrees->isEmpty()) {
                return response()->json('Aún no hay carreras.');
            } else {
                return response()->json($degrees, 200);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor.',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            $degree = Degree::create($request->all());

            if (!$degree) {
                return response()->json([
                    'error' => 'El recurso solicitado no existe.'
                ], 404);
            }

            return response()->json($degree, 201);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor.',
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

    public function update(Request $request, $id)
    {
        try {
            $degree = Degree::find($id);

            if (!is_int($id)) {
                return response()->json([
                    'error' => 'La solicitud contiene errores.',
                ], 400);
            } else if (!$degree) {
                return response()->json('El recurso solicitado no existe.', 404);
            }

            $degree->degree_name = $request->degree_name;
            $degree->save();
            return response()->json($degree);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor.',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $degree = Degree::destroy($id);

            if (!is_int($id)) {
                return response()->json([
                    'error' => 'La solicitud contiene errores.'
                ], 400);
            } else if (!$degree) {
                return response()->json([
                    'error' => 'El recurso solicitado no existe.'
                ], 404);
            }

            return response()->json($degree, 204);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor.',
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
                'error' => 'Error interno del servidor.',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
