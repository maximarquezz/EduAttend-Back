<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\MidComissionSubject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EnrollmentController extends Controller
{
    // ================================================================
    // MÉTODOS PARA ESTUDIANTES
    // ================================================================

    /**
     * Ver mis inscripciones (ESTUDIANTE)
     */
    public function myEnrollments(Request $request)
    {
        try {
            $userId = $request->user()->id;

            $enrollments = Enrollment::with([
                'midComissionSubject.subject.degree',
                'midComissionSubject.comission'
            ])
                ->where('user_id', $userId)
                ->get();

            if ($enrollments->isEmpty()) {
                return response()->json('No tienes inscripciones.');
            }

            return response()->json($enrollments, 200);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Enrollment).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Inscribirse a una comisión-materia (ESTUDIANTE)
     */
    public function enrollStudent(Request $request)
    {
        try {
            $validated = $request->validate([
                'mid_comission_subject_id' => 'required|integer|exists:mid_comissions_subjects,id',
                'enrollment_year' => 'required|integer|min:2000|max:2100'
            ]);

            $userId = $request->user()->id;

            // Verificar que el usuario sea estudiante
            if (!$request->user()->hasRole('estudiante')) {
                return response()->json([
                    'error' => 'Solo los estudiantes pueden inscribirse.'
                ], 403);
            }

            // Verificar si el usuario está aceptado
            if (!$request->user()->is_acepted) {
                return response()->json([
                    'error' => 'Tu cuenta debe estar aceptada para inscribirte.'
                ], 403);
            }

            // Verificar duplicados
            $existingEnrollment = Enrollment::where('user_id', $userId)
                ->where('mid_comission_subject_id', $validated['mid_comission_subject_id'])
                ->first();

            if ($existingEnrollment) {
                return response()->json([
                    'error' => 'Ya estás inscrito en esta comisión-materia.'
                ], 422);
            }

            $enrollment = Enrollment::create([
                'user_id' => $userId,
                'mid_comission_subject_id' => $validated['mid_comission_subject_id'],
                'enrollment_year' => $validated['enrollment_year']
            ]);
            
            // Cargar relaciones para la respuesta
            $enrollment->load([
                'midComissionSubject.subject.degree',
                'midComissionSubject.comission'
            ]);
            
            return response()->json([
                'message' => 'Inscripción realizada exitosamente',
                'enrollment' => $enrollment
            ], 201);
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

    /**
     * Inscripción masiva (ESTUDIANTE)
     */
    public function storeBulk(Request $request)
    {
        try {
            $validated = $request->validate([
                'mid_comission_subject_ids' => 'required|array|min:1',
                'mid_comission_subject_ids.*' => 'required|integer|exists:mid_comissions_subjects,id',
                'enrollment_year' => 'required|integer|min:2000|max:2100'
            ]);

            $userId = $request->user()->id;

            // Verificar que el usuario esté aceptado
            if (!$request->user()->is_acepted) {
                return response()->json([
                    'error' => 'Tu cuenta debe estar aceptada para inscribirte.'
                ], 403);
            }

            $enrollments = [];
            $errors = [];

            foreach ($validated['mid_comission_subject_ids'] as $midComissionSubjectId) {
                // Verificar si ya existe
                $existing = Enrollment::where('user_id', $userId)
                    ->where('mid_comission_subject_id', $midComissionSubjectId)
                    ->first();

                if ($existing) {
                    $midComissionSubject = MidComissionSubject::with(['subject', 'comission'])
                        ->find($midComissionSubjectId);
                    $errors[] = "Ya inscrito en: {$midComissionSubject->subject->subject_name} - Comisión {$midComissionSubject->comission->comission_name}";
                    continue;
                }

                $enrollment = Enrollment::create([
                    'user_id' => $userId,
                    'mid_comission_subject_id' => $midComissionSubjectId,
                    'enrollment_year' => $validated['enrollment_year']
                ]);

                $enrollment->load([
                    'midComissionSubject.subject',
                    'midComissionSubject.comission'
                ]);
                $enrollments[] = $enrollment;
            }

            if (empty($enrollments) && !empty($errors)) {
                return response()->json([
                    'error' => 'No se pudo inscribir a ninguna comisión-materia.',
                    'details' => $errors
                ], 422);
            }

            return response()->json([
                'message' => 'Inscripción completada',
                'enrollments' => $enrollments,
                'errors' => $errors
            ], 201);

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

    /**
     * Cancelar mi inscripción (ESTUDIANTE)
     */
    public function cancelMyEnrollment(Request $request, $id)
    {
        try {
            if (!is_numeric($id)) {
                return response()->json([
                    'error' => 'ID inválido.'
                ], 400);
            }

            $enrollment = Enrollment::find($id);

            if (!$enrollment) {
                return response()->json([
                    'error' => 'Inscripción no encontrada.'
                ], 404);
            }

            // Verificar que la inscripción pertenezca al usuario autenticado
            if ($enrollment->user_id !== $request->user()->id) {
                return response()->json([
                    'error' => 'No tienes permiso para cancelar esta inscripción.'
                ], 403);
            }

            // Solo se puede cancelar si está activa
            if ($enrollment->enrollment_status !== 'ACTIVO') {
                return response()->json([
                    'error' => 'Solo puedes cancelar inscripciones activas.'
                ], 422);
            }

            $enrollment->update(['enrollment_status' => 'CANCELADO']);
            $enrollment->load([
                'midComissionSubject.subject',
                'midComissionSubject.comission'
            ]);

            return response()->json([
                'message' => 'Inscripción cancelada exitosamente',
                'enrollment' => $enrollment
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Enrollment).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // ================================================================
    // MÉTODOS PARA ADMINISTRADORES
    // ================================================================

    /**
     * Listar todas las inscripciones (ADMIN)
     */
    public function index()
    {
        try {
            $enrollments = Enrollment::with([
                'user',
                'midComissionSubject.subject.degree',
                'midComissionSubject.comission'
            ])->get();

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

    /**
     * Crear inscripción manualmente (ADMIN)
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'user_id' => 'required|integer|exists:users,id',
                'mid_comission_subject_id' => 'required|integer|exists:mid_comissions_subjects,id',
                'enrollment_year' => 'required|integer|min:2000|max:2100',
                'enrollment_status' => 'sometimes|in:ACTIVO,FINALIZADO,CANCELADO'
            ]);

            // Verificar duplicados
            $existingEnrollment = Enrollment::where('user_id', $validated['user_id'])
                ->where('mid_comission_subject_id', $validated['mid_comission_subject_id'])
                ->first();

            if ($existingEnrollment) {
                return response()->json([
                    'error' => 'El estudiante ya está inscrito en esta comisión-materia.'
                ], 422);
            }

            $enrollment = Enrollment::create($validated);
            
            // Cargar relaciones para la respuesta
            $enrollment->load([
                'user',
                'midComissionSubject.subject.degree',
                'midComissionSubject.comission'
            ]);
            
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

    /**
     * Ver inscripciones de un estudiante (ADMIN/PROFESOR)
     */
    public function getByStudent($userId)
    {
        try {
            if (!is_numeric($userId)) {
                return response()->json([
                    'error' => 'ID de usuario inválido.'
                ], 400);
            }

            $user = User::find($userId);
            if (!$user) {
                return response()->json([
                    'error' => 'Usuario no encontrado.'
                ], 404);
            }

            $enrollments = Enrollment::with([
                'midComissionSubject.subject.degree',
                'midComissionSubject.comission'
            ])
                ->where('user_id', $userId)
                ->get();

            if ($enrollments->isEmpty()) {
                return response()->json('Este estudiante no tiene inscripciones.');
            }

            return response()->json($enrollments, 200);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Enrollment).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Ver inscripciones de una comisión-materia (ADMIN/PROFESOR)
     */
    public function getByMidComissionSubject($midComissionSubjectId)
    {
        try {
            if (!is_numeric($midComissionSubjectId)) {
                return response()->json([
                    'error' => 'ID inválido.'
                ], 400);
            }

            $midComissionSubject = MidComissionSubject::find($midComissionSubjectId);
            if (!$midComissionSubject) {
                return response()->json([
                    'error' => 'Comisión-materia no encontrada.'
                ], 404);
            }

            $enrollments = Enrollment::with('user')
                ->where('mid_comission_subject_id', $midComissionSubjectId)
                ->get();

            if ($enrollments->isEmpty()) {
                return response()->json('No hay estudiantes inscritos en esta comisión-materia.');
            }

            return response()->json($enrollments, 200);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Enrollment).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Actualizar inscripción (ADMIN)
     */
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
                'mid_comission_subject_id' => 'sometimes|integer|exists:mid_comissions_subjects,id',
                'enrollment_year' => 'sometimes|integer|min:2000|max:2100',
                'enrollment_status' => 'sometimes|in:ACTIVO,FINALIZADO,CANCELADO'
            ]);

            // Verificar duplicados si se cambia user_id o mid_comission_subject_id
            if (isset($validated['user_id']) || isset($validated['mid_comission_subject_id'])) {
                $userId = $validated['user_id'] ?? $enrollment->user_id;
                $midComissionSubjectId = $validated['mid_comission_subject_id'] ?? $enrollment->mid_comission_subject_id;

                $existingEnrollment = Enrollment::where('user_id', $userId)
                    ->where('mid_comission_subject_id', $midComissionSubjectId)
                    ->where('id', '!=', $id)
                    ->first();

                if ($existingEnrollment) {
                    return response()->json([
                        'error' => 'La inscripción no puede repetirse en la misma comisión-materia.'
                    ], 422);
                }
            }

            $enrollment->update($validated);
            $enrollment->load([
                'user',
                'midComissionSubject.subject',
                'midComissionSubject.comission'
            ]);
            
            return response()->json([
                'message' => 'Inscripción actualizada exitosamente',
                'enrollment' => $enrollment
            ], 200);
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

    /**
     * Eliminar inscripción (ADMIN)
     */
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
            return response()->json([
                'message' => 'Inscripción eliminada exitosamente'
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Enrollment).',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}