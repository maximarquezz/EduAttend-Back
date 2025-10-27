<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DegreeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ComissionController;
use App\Http\Controllers\MidComissionSubjectController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\RoleController;

// ! RUTAS PÚBLICAS
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// ! RUTAS PROTEGIDAS
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    // ! CARRERAS
    Route::middleware('role:administrador')->group(function () {
        Route::post('/degree', [DegreeController::class, 'store']);
        Route::put('/degree/{id}', [DegreeController::class, 'update']);
        Route::delete('/degree/{id}', [DegreeController::class, 'destroy']);
    });

    Route::middleware('role:administrador|profesor|estudiante')->group(function () {
        Route::get('/degree', [DegreeController::class, 'index']);
        Route::get('/degree-with-subjects', [DegreeController::class, 'degreeWithSubjects']);
    });

    // ! MATERIAS
    Route::middleware('role:administrador')->group(function () {
        Route::post('/subject', [SubjectController::class, 'store']);
        Route::put('/subject/{id}', [SubjectController::class, 'update']);
        Route::delete('/subject/{id}', [SubjectController::class, 'destroy']);
    });

    Route::middleware('role:administrador|profesor|estudiante')->group(function () {
        Route::get('/subject', [SubjectController::class, 'index']);
    });

    // ! COMISIONES Y ASIGNACIONES
    Route::get('/comission', [ComissionController::class, 'index']);
    Route::get('/comission-subject', [MidComissionSubjectController::class, 'index']);
    Route::get('/assignment', [AssignmentController::class, 'index']);

    // ! PERSONAS / ROLES / UBICACIÓN
    Route::get('/person', [PersonController::class, 'index']);
    Route::get('/role', [RoleController::class, 'index']);
    Route::get('/city', [CityController::class, 'index']);
    Route::get('/province', [ProvinceController::class, 'index']);
});
