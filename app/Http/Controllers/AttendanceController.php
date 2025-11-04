<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
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

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'enrollment_id' => 'required|integer|exists:enrollments,id',
                'attendance_date' => 'required|date',
                'attendance_status' => 'required|in:PRESENTE,AUSENTE,TARDE,JUSTIFICADO',
                'notes' => 'nullable|string'
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
                'notes' => 'nullable|string'
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
}
