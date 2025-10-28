<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index()
    {
        try {
            $provinces = Province::all();
            if ($provinces->isEmpty()) {
                return response()->json('Aún no hay provincias.');
            } else {
                return response()->json($provinces, 200);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Province).',
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
            $province = Province::create($request->all());

            if (!$province) {
                return response()->json([
                    'error' => 'El recurso solicitado no existe (Province).'
                ], 404);
            } else {
                return response()->json($province, 201);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Province).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Province $province)
    {
        //
    }

    public function edit(Province $province)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try {
            $province = Province::find($id);

            if (!is_numeric($id)) {
                return response()->json([
                    'error' => 'La solicitud contiene errores (Province).',
                ], 400);
            } else if (!$province) {
                return response()->json('El recurso solicitado no existe (Province).', 404);
            } else {
                $province->update($request->all());
                return response()->json($province, 200);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Province).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $province = Province::destroy($id);

            if (!is_numeric($id)) {
                return response()->json([
                    'error' => 'La solicitud contiene errores (Province).'
                ], 400);
            } else if (!$province) {
                return response()->json([
                    'error' => 'El recurso solicitado no existe (Province).'
                ], 404);
            } else {
                return response()->json($province, 204);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Province).',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
