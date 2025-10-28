<?php

namespace App\Http\Controllers;

use App\Models\MidComissionSubject;
use Illuminate\Http\Request;

class MidComissionSubjectController extends Controller
{
    public function index()
    {
        try {
            $midsComissionsSubjects = MidComissionSubject::all();
            if ($midsComissionsSubjects->isEmpty()) {
                return response()->json('Aún no hay relaciones comisión-materia.');
            } else {
                return response()->json($midsComissionsSubjects, 200);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (MidComissionSubject).',
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
            $midComissionSubject = MidComissionSubject::create($request->all());

            if (!$midComissionSubject) {
                return response()->json([
                    'error' => 'El recurso solicitado no existe (MidComissionSubject).'
                ], 404);
            } else {
                return response()->json($midComissionSubject, 201);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (MidComissionSubject).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(MidComissionSubject $midComissionSubject)
    {
        //
    }

    public function edit(MidComissionSubject $midComissionSubject)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try {
            $midComissionSubject = MidComissionSubject::find($id);

            if (!is_numeric($id)) {
                return response()->json([
                    'error' => 'La solicitud contiene errores (MidComissionSubject).',
                ], 400);
            } else if (!$midComissionSubject) {
                return response()->json('El recurso solicitado no existe (MidComissionSubject).', 404);
            } else {
                $midComissionSubject->update($request->all());
                return response()->json($midComissionSubject, 200);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (MidComissionSubject).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $midComissionSubject = MidComissionSubject::destroy($id);

            if (!is_numeric($id)) {
                return response()->json([
                    'error' => 'La solicitud contiene errores (MidComissionSubject).'
                ], 400);
            } else if (!$midComissionSubject) {
                return response()->json([
                    'error' => 'El recurso solicitado no existe (MidComissionSubject).'
                ], 404);
            } else {
                return response()->json($midComissionSubject, 204);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (MidComissionSubject).',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
