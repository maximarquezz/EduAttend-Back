<?php
namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Assignment;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AttendanceController extends Controller
{
    public function index()
    {
        try {
            $attendances = Attendance::with(['enrollment.user', 'enrollment.subject'])->get();
            if ($attendances->isEmpty()) {
                return response()->json('Aún no hay asistencias.');
            }
            return response()->json($attendances, 200);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Attendance).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getByEnrollment($enrollmentId)
    {
        try {
            if (!is_numeric($enrollmentId)) {
                return response()->json([
                    'error' => 'El ID de inscripción debe ser un número válido.'
                ], 400);
            }

            // Verificar que el enrollment existe
            $enrollment = Enrollment::find($enrollmentId);
            if (!$enrollment) {
                return response()->json([
                    'error' => 'La inscripción no existe.'
                ], 404);
            }

            // Obtener las asistencias con relaciones
            $attendances = Attendance::with(['enrollment.user', 'enrollment.midComissionSubject.subject'])
                ->where('enrollment_id', $enrollmentId)
                ->orderBy('attendance_date', 'desc')
                ->get();

            if ($attendances->isEmpty()) {
                return response()->json([
                    'message' => 'No hay asistencias registradas para esta inscripción.',
                    'data' => []
                ], 200);
            }

            return response()->json($attendances, 200);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Attendance).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'enrollment_id' => 'required|integer|exists:enrollments,id',
                'attendance_date' => 'required|date',
                'attendance_status' => 'required|in:PRESENTE,AUSENTE,TARDE,JUSTIFICADO',
                'attendance_notes' => 'nullable|string' // Cambié 'notes' por 'attendance_notes' según tu esquema
            ]);

            $existingAttendance = Attendance::where('enrollment_id', $validated['enrollment_id'])
                ->where('attendance_date', $validated['attendance_date'])
                ->first();

            if ($existingAttendance) {
                return response()->json([
                    'error' => 'Ya existe una asistencia registrada para esta fecha.'
                ], 422);
            }

            $attendance = Attendance::create($validated);
            return response()->json($attendance, 201);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Datos inválidos.',
                'details' => $e->errors()
            ], 422);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Attendance).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            if (!is_numeric($id)) {
                return response()->json([
                    'error' => 'La solicitud contiene errores (Attendance).'
                ], 400);
            }

            $attendance = Attendance::find($id);
            if (!$attendance) {
                return response()->json([
                    'error' => 'El recurso solicitado no existe (Attendance).'
                ], 404);
            }

            $validated = $request->validate([
                'enrollment_id' => 'sometimes|integer|exists:enrollments,id',
                'attendance_date' => 'sometimes|date',
                'attendance_status' => 'sometimes|in:PRESENTE,AUSENTE,TARDE,JUSTIFICADO',
                'attendance_notes' => 'nullable|string'
            ]);

            if (isset($validated['enrollment_id']) || isset($validated['attendance_date'])) {
                $enrollmentId = $validated['enrollment_id'] ?? $attendance->enrollment_id;
                $attendanceDate = $validated['attendance_date'] ?? $attendance->attendance_date;

                $existingAttendance = Attendance::where('enrollment_id', $enrollmentId)
                    ->where('attendance_date', $attendanceDate)
                    ->where('id', '!=', $id)
                    ->first();

                if ($existingAttendance) {
                    return response()->json([
                        'error' => 'Ya existe una asistencia registrada para esta fecha.'
                    ], 422);
                }
            }

            $attendance->update($validated);
            return response()->json($attendance, 200);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Datos inválidos.',
                'details' => $e->errors()
            ], 422);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Attendance).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            if (!is_numeric($id)) {
                return response()->json([
                    'error' => 'La solicitud contiene errores (Attendance).'
                ], 400);
            }

            $attendance = Attendance::find($id);
            if (!$attendance) {
                return response()->json([
                    'error' => 'El recurso solicitado no existe (Attendance).'
                ], 404);
            }

            $attendance->delete();
            return response()->json(null, 204);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Attendance).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function recent(Request $request)
    {
        try {
            $limit = $request->query('limit', 10);
            
            if (!is_numeric($limit) || $limit < 1) {
                return response()->json([
                    'error' => 'El parámetro limit debe ser un número mayor a 0.'
                ], 400);
            }

            $attendances = Attendance::with(['enrollment.user', 'enrollment.midComissionSubject.subject'])
                ->orderBy('attendance_date', 'desc')
                ->orderBy('created_at', 'desc')
                ->limit($limit)
                ->get();

            if ($attendances->isEmpty()) {
                return response()->json([
                    'message' => 'No hay asistencias registradas.',
                    'data' => []
                ], 200);
            }

            return response()->json($attendances, 200);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Attendance).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function resumePerSubject($enrollmentId)
    {
        try {
            if (!is_numeric($enrollmentId)) {
                return response()->json([
                    'error' => 'El ID de inscripción debe ser numérico.'
                ], 400);
            }

            $enrollment = Enrollment::with('midComissionSubject.subject')->find($enrollmentId);

            if (!$enrollment) {
                return response()->json([
                    'error' => 'La inscripción no existe.'
                ], 404);
            }

            $attendances = Attendance::where('enrollment_id', $enrollmentId)->get();

            if ($attendances->isEmpty()) {
                return response()->json([
                    'message' => 'No hay asistencias registradas.',
                    'data' => []
                ], 200);
            }

            $total = $attendances->count();

            $presentes = $attendances->where('attendance_status', 'PRESENTE')->count();
            $tarde = $attendances->where('attendance_status', 'TARDE')->count();
            $ausentes = $attendances->where('attendance_status', 'AUSENTE')->count();
            $justificados = $attendances->where('attendance_status', 'JUSTIFICADO')->count();

            // Regla: TARDE cuenta como presente
            $asistenciasValidas = $presentes + $tarde;

            $porcentaje = round(($asistenciasValidas / $total) * 100, 2);

            return response()->json([
                [
                    'subject_id' => $enrollment->midComissionSubject->subject->id,
                    'subject_name' => $enrollment->midComissionSubject->subject->subject_name,
                    'total_classes' => $total,
                    'presentes' => $presentes,
                    'tarde' => $tarde,
                    'ausentes' => $ausentes,
                    'justificados' => $justificados,
                    'porcentaje' => $porcentaje
                ]
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Attendance resume).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function resumePerSubjectByStudent($studentId)
    {
        try {
            if (!is_numeric($studentId)) {
                return response()->json([
                    'error' => 'El ID del estudiante debe ser numérico.'
                ], 400);
            }

            // Traer todas las inscripciones del estudiante con la materia
            $enrollments = Enrollment::with('midComissionSubject.subject')
                ->where('user_id', $studentId)
                ->get();

            if ($enrollments->isEmpty()) {
                return response()->json([
                    'message' => 'El estudiante no tiene inscripciones.',
                    'data' => []
                ], 200);
            }

            $result = [];

            foreach ($enrollments as $enrollment) {

                $attendances = Attendance::where('enrollment_id', $enrollment->id)->get();

                if ($attendances->isEmpty()) {
                    continue;
                }

                $total = $attendances->count();

                $presentes = $attendances->where('attendance_status', 'PRESENTE')->count();
                $tarde = $attendances->where('attendance_status', 'TARDE')->count();
                $ausentes = $attendances->where('attendance_status', 'AUSENTE')->count();
                $justificados = $attendances->where('attendance_status', 'JUSTIFICADO')->count();

                // Regla: TARDE cuenta como presente
                $asistenciasValidas = $presentes + $tarde;
                $porcentaje = round(($asistenciasValidas / $total) * 100, 2);

                $subject = $enrollment->midComissionSubject->subject;

                $result[] = [
                    'subject_id' => $subject->id,
                    'subject_name' => $subject->subject_name,
                    'total_classes' => $total,
                    'presentes' => $presentes,
                    'tarde' => $tarde,
                    'ausentes' => $ausentes,
                    'justificados' => $justificados,
                    'porcentaje' => $porcentaje
                ];
            }

            return response()->json($result, 200);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Attendance resume by student).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getClassesByProfessor(Request $request)
    {
        try {
            $professorId = $request->user()->id;
            
            $assignments = Assignment::where('user_id', $professorId)
                ->where('assign_type', 'DICTA')
                ->pluck('mid_comissions_subjects_id');
            
            if ($assignments->isEmpty()) {
                return response()->json([
                    'message' => 'No tienes materias asignadas.',
                    'data' => []
                ], 200);
            }
            
            $classes = Attendance::with([
                'enrollment.midComissionSubject.subject',
                'enrollment.midComissionSubject.comission'
            ])
                ->whereHas('enrollment', function($q) use ($assignments) {
                    $q->whereIn('mid_comission_subject_id', $assignments);
                })
                ->selectRaw('DATE(attendance_date) as date, enrollment.mid_comission_subject_id')
                ->join('enrollments as enrollment', 'attendances.enrollment_id', '=', 'enrollment.id')
                ->groupBy('date', 'enrollment.mid_comission_subject_id')
                ->orderBy('date', 'desc')
                ->get()
                ->map(function($item) {
                    return [
                        'date' => $item->date,
                        'mid_comission_subject_id' => $item->mid_comission_subject_id,
                        'subject' => $item->enrollment->midComissionSubject->subject,
                        'comission' => $item->enrollment->midComissionSubject->comission
                    ];
                });
            
            return response()->json($classes, 200);
            
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Attendance).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getTeacherAttendances(Request $request)
    {
        try {
            $userId = $request->user()->id;
            
            $assignments = Assignment::where('user_id', $userId)
                ->where('assign_type', 'DICTA')
                ->with('MidComissionSubject.Subject', 'MidComissionSubject.Comission')
                ->get();
            
            if ($assignments->isEmpty()) {
                return response()->json([
                    'message' => 'No tienes materias asignadas.',
                    'data' => []
                ], 200);
            }
            
            $result = [];
            
            foreach ($assignments as $assignment) {
                $midComissionSubject = $assignment->MidComissionSubject;
                $subject = $midComissionSubject->Subject;
                $comission = $midComissionSubject->Comission;
                
                // Agrupar asistencias por fecha
                $attendancesByDate = Attendance::whereHas('Enrollment', function($query) use ($midComissionSubject) {
                        $query->where('mid_comission_subject_id', $midComissionSubject->id);
                    })
                    ->with(['Enrollment.User'])
                    ->orderBy('attendance_date', 'desc')
                    ->get()
                    ->groupBy(function($attendance) {
                        return $attendance->attendance_date->format('Y-m-d');
                    })
                    ->map(function($attendancesOnDate, $date) {
                        return [
                            'attendance_date' => $date,
                            'students' => $attendancesOnDate->map(function($attendance) {
                                return [
                                    'student_id' => $attendance->Enrollment->User->id,
                                    'student_name' => $attendance->Enrollment->User->name,
                                    'attendance_status' => $attendance->attendance_status,
                                    'attendance_notes' => $attendance->notes
                                ];
                            })->values()
                        ];
                    })
                    ->values();
                
                if ($attendancesByDate->isNotEmpty()) {
                    $result[] = [
                        'subject_id' => $subject->id,
                        'subject_name' => $subject->subject_name,
                        'comission_id' => $comission->id,
                        'comission_name' => $comission->comission_name,
                        'mid_comission_subject_id' => $midComissionSubject->id,
                        'attendances' => $attendancesByDate
                    ];
                }
            }
            
            if (empty($result)) {
                return response()->json([
                    'message' => 'No hay asistencias registradas en tus materias.',
                    'data' => []
                ], 200);
            }
            
            return response()->json($result, 200);
            
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Teacher Attendances).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function storeBulk(Request $request)
    {
        try {
            $validated = $request->validate([
                'attendances' => 'required|array|min:1',
                'attendances.*.enrollment_id' => 'required|integer|exists:enrollments,id',
                'attendances.*.attendance_date' => 'required|date',
                'attendances.*.attendance_status' => 'required|in:PRESENTE,AUSENTE,TARDE,JUSTIFICADO',
                'attendances.*.attendance_notes' => 'nullable|string'
            ]);

            $results = [];
            $errors = [];

            foreach ($validated['attendances'] as $attendanceData) {
                // Verificar duplicados
                $exists = Attendance::where('enrollment_id', $attendanceData['enrollment_id'])
                    ->where('attendance_date', $attendanceData['attendance_date'])
                    ->first();

                if ($exists) {
                    $errors[] = "Ya existe asistencia para enrollment_id {$attendanceData['enrollment_id']} en esta fecha";
                    continue;
                }

                $attendance = Attendance::create($attendanceData);
                $results[] = $attendance;
            }

            return response()->json([
                'message' => 'Asistencias registradas',
                'created' => $results,
                'errors' => $errors
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Datos inválidos.',
                'details' => $e->errors()
            ], 422);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor.',
                'message' => $e->getMessage()
            ], 500);
        }
    }

}