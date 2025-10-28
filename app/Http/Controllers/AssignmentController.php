<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        try {
            $assignments = Assignment::all();
            if ($assignments->isEmpty()) {
                return response()->json('Aún no hay asignaciones.');
            } else {
                return response()->json($assignments, 200);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Assignment).',
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
            $assignment = Assignment::create($request->all());

            if (!$assignment) {
                return response()->json([
                    'error' => 'El recurso solicitado no existe (Assignment).'
                ], 404);
            } else {
                return response()->json($assignment, 201);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Assignment).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Assignment $assignment)
    {
        //
    }

    public function edit(Assignment $assignment)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try {
            $assignment = Assignment::find($id);

            if (!is_numeric($id)) {
                return response()->json([
                    'error' => 'La solicitud contiene errores (Assignment).',
                ], 400);
            } else if (!$assignment) {
                return response()->json('El recurso solicitado no existe (Assignment).', 404);
            } else {
                $assignment->update($request->all());
                return response()->json($assignment, 200);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Assignment).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $assignment = Assignment::destroy($id);

            if (!is_numeric($id)) {
                return response()->json([
                    'error' => 'La solicitud contiene errores (Assignment).'
                ], 400);
            } else if (!$assignment) {
                return response()->json([
                    'error' => 'El recurso solicitado no existe (Assignment).'
                ], 404);
            } else {
                return response()->json($assignment, 204);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Assignment).',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
