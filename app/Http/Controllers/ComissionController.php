<?php

namespace App\Http\Controllers;

use App\Models\Comission;
use Illuminate\Http\Request;

class ComissionController extends Controller
{
    public function index()
    {
        try {
            $comissions = Comission::all();
            if ($comissions->isEmpty()) {
                return response()->json('Aún no hay comisiones.');
            } else {
                return response()->json($comissions, 200);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Comission).',
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
            $comission = Comission::create($request->all());

            if (!$comission) {
                return response()->json([
                    'error' => 'El recurso solicitado no existe (Comission).'
                ], 404);
            } else {
                return response()->json($comission, 201);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Comission).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(comission $comission)
    {
        //
    }

    public function edit(comission $comission)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try {
            $comission = Comission::find($id);

            if (!is_numeric($id)) {
                return response()->json([
                    'error' => 'La solicitud contiene errores (Comission).',
                ], 400);
            } else if (!$comission) {
                return response()->json('El recurso solicitado no existe (Comission).', 404);
            } else {
                $comission->update($request->all());
                $comission->save();
                return response()->json($comission, 200);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Comission).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $comission = Comission::destroy($id);

            if (!is_numeric($id)) {
                return response()->json([
                    'error' => 'La solicitud contiene errores (Comission).'
                ], 400);
            } else if (!$comission) {
                return response()->json([
                    'error' => 'El recurso solicitado no existe (Comission).'
                ], 404);
            } else {
                return response()->json($comission, 204);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Comission).',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
