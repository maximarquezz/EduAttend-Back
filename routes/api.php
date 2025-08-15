<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DegreeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ComissionController;
use App\Http\Controllers\MidComissionSubjectController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

// Carreras
Route::get('degree', [DegreeController::class, 'index']);

// Materias
Route::get('subject', [SubjectController::class, 'index']);

// Comisiones
Route::get('comission', [ComissionController::class, 'index']);

// Comisiones-Materias
Route::get('comission-subject', [MidComissionSubjectController::class, 'index']);

// Personas
Route::get('person', [PersonController::class, 'index']);

// Roles
Route::get('role', [RoleController::class, 'index']);

// Asignaciones
Route::get('assignment', [AssignmentController::class, 'index']);

// Ciudades
Route::get('city', [CityController::class, 'index']);

// Provincias
Route::get('province', [ProvinceController::class, 'index']);
