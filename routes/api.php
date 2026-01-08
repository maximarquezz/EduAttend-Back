<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\DegreeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ComissionController;
use App\Http\Controllers\MidComissionSubjectController;
use App\Http\Controllers\AttendanceController;

// ! RUTAS PÚBLICAS
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// ! RUTAS DE RECUPERACIÓN
Route::get('/user-by-dni/{dni}', [AuthController::class, 'getUserByDni']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/verify-code', [AuthController::class, 'verifyCode']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// ! RUTAS PROTEGIDAS
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    // ! ============================================
    // ! CARRERAS (DEGREES)
    // ! ============================================
    
    // Solo Administradores
    Route::middleware('role:administrador')->group(function () {
        Route::post('/degree', [DegreeController::class, 'store']);
        Route::put('/degree/{id}', [DegreeController::class, 'update']);
        Route::delete('/degree/{id}', [DegreeController::class, 'destroy']);
    });

    // Todos los usuarios autenticados
    Route::middleware('role:administrador|profesor|estudiante')->group(function () {
        Route::get('/degree', [DegreeController::class, 'index']);
        Route::get('/degree-with-subjects', [DegreeController::class, 'degreeWithSubjects']);
    });

    // ! ============================================
    // ! MATERIAS (SUBJECTS)
    // ! ============================================
    
    // Solo Administradores
    Route::middleware('role:administrador')->group(function () {
        Route::post('/subject', [SubjectController::class, 'store']);
        Route::put('/subject/{id}', [SubjectController::class, 'update']);
        Route::delete('/subject/{id}', [SubjectController::class, 'destroy']);
    });

    // Todos los usuarios autenticados
    Route::middleware('role:administrador|profesor|estudiante')->group(function () {
        Route::get('/subject', [SubjectController::class, 'index']);
    });

    // ! ============================================
    // ! COMISIONES
    // ! ============================================
    
    // Solo Administradores
    Route::middleware('role:administrador')->group(function () {
        Route::post('/comission', [ComissionController::class, 'store']);
        Route::put('/comission/{id}', [ComissionController::class, 'update']);
        Route::delete('/comission/{id}', [ComissionController::class, 'destroy']);
    });

    // Todos los usuarios autenticados
    Route::middleware('role:administrador|profesor|estudiante')->group(function () {
        Route::get('/comission', [ComissionController::class, 'index']);
        Route::get('/comission-subject', [MidComissionSubjectController::class, 'index']);
    });

    // ! ============================================
    // ! INSCRIPCIONES (ENROLLMENTS)
    // ! ============================================
    
    // ESTUDIANTES: Inscribirse a materias
    Route::middleware('role:estudiante')->group(function () {
        Route::get('/my-enrollments', [EnrollmentController::class, 'myEnrollments']);
        Route::post('/enroll', [EnrollmentController::class, 'enrollStudent']);
        Route::post('/enroll/bulk', [EnrollmentController::class, 'storeBulk']);
        Route::patch('/my-enrollments/{id}/cancel', [EnrollmentController::class, 'cancelMyEnrollment']);
    });

    // ADMINISTRADORES: Gestión completa de inscripciones
    Route::middleware('role:administrador')->group(function () {
        Route::get('/enrollments', [EnrollmentController::class, 'index']);
        Route::post('/enrollments', [EnrollmentController::class, 'store']);
        Route::get('/enrollments/student/{userId}', [EnrollmentController::class, 'getByStudent']);
        Route::get('/enrollments/mid-comission-subject/{midComissionSubjectId}', [EnrollmentController::class, 'getByMidComissionSubject']);
        Route::put('/enrollments/{id}', [EnrollmentController::class, 'update']);
        Route::delete('/enrollments/{id}', [EnrollmentController::class, 'destroy']);
    });

    // PROFESORES: Ver inscripciones de sus comisiones
    Route::middleware('role:profesor|administrador')->group(function () {
        Route::get('/my-comission-subject/{midComissionSubjectId}/enrollments', [EnrollmentController::class, 'getByMidComissionSubject']);
    });

    // ! ============================================
    // ! ASIGNACIONES (ASSIGNMENTS)
    // ! ============================================

    // PROFESORES: Ver sus propias asignaciones
    Route::middleware('role:profesor')->group(function () {
        Route::get('/my-assignments', [AssignmentController::class, 'myAssignments']);
    });

    // PROFESORES Y ADMINISTRADORES: Crear, editar, eliminar asignaciones
    Route::middleware('role:administrador|profesor')->group(function () {
        Route::post('/assignment', [AssignmentController::class, 'store']);
        Route::put('/assignment/{id}', [AssignmentController::class, 'update']);
        Route::delete('/assignment/{id}', [AssignmentController::class, 'destroy']);
    });

    // Todos pueden ver asignaciones (para consultar quién dicta qué)
    Route::middleware('role:administrador|profesor|estudiante')->group(function () {
        Route::get('/assignment', [AssignmentController::class, 'index']);
    });

    // ! ============================================
    // ! ASISTENCIAS (ATTENDANCES)
    // ! ============================================

    // PROFESORES: Registrar y gestionar asistencias de sus comisiones
    Route::middleware('role:profesor')->group(function () {
        Route::post('/attendances', [AttendanceController::class, 'store']);
        Route::get('/attendances/my-classes', [AttendanceController::class, 'getClassesByProfessor']);
        Route::get('/attendances/teacher/my-courses', [AttendanceController::class, 'getTeacherAttendances']);
        Route::get('/my-comission-subject/{midComissionSubjectId}/enrollments', [AttendanceController::class, 'getEnrollmentsByComissionSubject']);
        Route::post('/attendances/bulk', [AttendanceController::class, 'storeBulk']);
    });

    // ADMINISTRADORES: Gestión completa de asistencias
    Route::middleware('role:administrador')->group(function () {
        Route::get('/attendances', [AttendanceController::class, 'index']);
        Route::post('/attendances', [AttendanceController::class, 'store']);
    });

    // PROFESORES Y ADMINISTRADORES: Eliminar asistencias
    Route::middleware('role:profesor|administrador')->group(function () {
        Route::put('/attendances/{id}', [AttendanceController::class, 'update']);
        Route::delete('/attendances/{id}', [AttendanceController::class, 'destroy']);
    });

    // TODOS LOS ROLES
    Route::middleware('role:estudiante|profesor|administrador')->group(function () {
        Route::get('/attendances/enrollment/{enrollmentId}', [AttendanceController::class, 'getByEnrollment']);
        Route::get('/attendances/recent', [AttendanceController::class, 'recent']);
        Route::get('/attendances/resume-per-subject/enrollment/{enrollmentId}', [AttendanceController::class, 'resumePerSubject']);
        Route::get('/attendances/resume-per-subject/student/{studentId}', [AttendanceController::class, 'resumePerSubjectByStudent']);
        Route::get('/attendances/subjects-at-risk/{studentId}', [AttendanceController::class, 'subjectsAtRisk']);
    });

    // ! ============================================
    // ! USUARIOS
    // ! ============================================
    Route::middleware('role:administrador')->group(function () {
        Route::get('/pending-users', [AuthController::class, 'pendingUsers']);
        Route::put('/users/{id}', [AuthController::class, 'update']);
    });
});