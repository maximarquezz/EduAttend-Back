<?php

namespace App\Http\Controllers;

use App\Models\Subject;
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
                'error' => 'Error interno del servidor (Subject).',
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
                    'error' => 'El recurso solicitado no existe (Subject).'
                ], 404);
            } else {
                return response()->json($subject, 201);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Subject).',
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

            if (!is_numeric($id)) {
                return response()->json([
                    'error' => 'La solicitud contiene errores (Subject).',
                ], 400);
            } else if (!$subject) {
                return response()->json([
                    'error' => 'El recurso solicitado no existe (Subject).'
                ], 404);
            } else {
                $subject->update($request->all());
                $subject->save();
                return response()->json($subject, 200);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Subject).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $subject = Subject::destroy($id);

            if (!is_numeric($id)) {
                return response()->json([
                    'error' => 'La solicitud contiene errores (Subject).'
                ], 400);
            } else if (!$subject) {
                return response()->json([
                    'error' => 'El recurso solicitado no existe (Subject).'
                ], 404);
            } else {
                return response()->json($subject, 204);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Subject).',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
