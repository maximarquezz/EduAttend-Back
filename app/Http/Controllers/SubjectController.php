<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Degree;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        try {
            $subjects = Subject::with('degree')->get();
            if ($subjects->isEmpty()) {
                return response()->json('Aún no hay materias.');
            } else {
                return response()->json($subjects, 200);
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
            $subject = Subject::create($request->all());

            if (!$subject) {
                return response()->json([
                    'error' => 'El recurso solicitado no existe.'
                ], 404);
            }

            return response()->json($subject, 201);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor.',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Subject $subject)
    {
        //
    }

    public function edit(Subject $subject)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try {
            $subject = Subject::find($id);

            if (!is_int($id)) {
                return response()->json([
                    'error' => 'La solicitud contiene errores.',
                ], 400);
            } else if (!$subject) {
                return response()->json('El recurso solicitado no existe', 404);
            }
            $subject->update($request->all());
            $subject->save();
            return response()->json($subject);
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
            $subject = Subject::destroy($id);

            if (!is_int($id)) {
                return response()->json([
                    'error' => 'La solicitud contiene errores.'
                ], 400);
            } else if (!$subject) {
                return response()->json([
                    'error' => 'El recurso solicitado no existe.'
                ], 404);
            }

            return response()->json($subject, 204);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error intern del servidor.',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
