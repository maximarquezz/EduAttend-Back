<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EnrollmentController extends Controller
{
    public function index()
    {
        try {
            $enrollments = Enrollment::with(['user', 'subject'])->get();
            if ($enrollments->isEmpty()) {
                return response()->json('Aún no hay inscripciones.');
            }
            return response()->json($enrollments, 200);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Enrollment).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|integer|exists:users,id',
                'subject_id' => 'required|integer|exists:subjects,id',
                'enrollment_year' => 'required|integer'
            ]);

            $existingEnrollment = Enrollment::where('user_id', $validated['user_id'])
                ->where('subject_id', $validated['subject_id'])
                ->first();

            if ($existingEnrollment) {
                return response()->json([
                    'error' => 'La inscripción no puede repetirse en una misma materia.'
                ], 422);
            }

            $enrollment = Enrollment::create($validated);
            return response()->json($enrollment, 201);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Datos inválidos.',
                'details' => $e->errors()
            ], 422);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Enrollment).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            if (!is_numeric($id)) {
                return response()->json([
                    'error' => 'La solicitud contiene errores (Enrollment).'
                ], 400);
            }

            $enrollment = Enrollment::find($id);

            if (!$enrollment) {
                return response()->json([
                    'error' => 'El recurso solicitado no existe (Enrollment).'
                ], 404);
            }

            $validated = $request->validate([
                'user_id' => 'sometimes|integer|exists:users,id',
                'subject_id' => 'sometimes|integer|exists:subjects,id',
                'enrollment_year' => 'sometimes|integer'
            ]);

            if (isset($validated['user_id']) || isset($validated['subject_id'])) {
                $userId = $validated['user_id'] ?? $enrollment->user_id;
                $subjectId = $validated['subject_id'] ?? $enrollment->subject_id;

                $existingEnrollment = Enrollment::where('user_id', $userId)
                    ->where('subject_id', $subjectId)
                    ->where('id', '!=', $id)
                    ->first();

                if ($existingEnrollment) {
                    return response()->json([
                        'error' => 'La inscripción no puede repetirse en una misma materia.'
                    ], 422);
                }
            }

            $enrollment->update($validated);
            return response()->json($enrollment, 200);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Datos inválidos.',
                'details' => $e->errors()
            ], 422);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Enrollment).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            if (!is_numeric($id)) {
                return response()->json([
                    'error' => 'La solicitud contiene errores (Enrollment).'
                ], 400);
            }

            $enrollment = Enrollment::find($id);

            if (!$enrollment) {
                return response()->json([
                    'error' => 'El recurso solicitado no existe (Enrollment).'
                ], 404);
            }

            $enrollment->delete();
            return response()->json(null, 204);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Enrollment).',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
