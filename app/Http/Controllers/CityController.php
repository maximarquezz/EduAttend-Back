<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        try {
            $cities = City::all();
            if ($cities->isEmpty()) {
                return response()->json('Aún no hay ciudades.');
            } else {
                return response()->json($cities, 200);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (City).',
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
            $city = City::create($request->all());

            if (!$city) {
                return response()->json([
                    'error' => 'El recurso solicitado no existe (City).'
                ], 404);
            } else {
                return response()->json($city, 201);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (City).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(City $city)
    {
        //
    }

    public function edit(City $city)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try {
            $city = City::find($id);

            if (!is_numeric($id)) {
                return response()->json([
                    'error' => 'La solicitud contiene errores (City).',
                ], 400);
            } else if (!$city) {
                return response()->json('El recurso solicitado no existe (City).', 404);
            } else {
                $city->update($request->all());
                return response()->json($city, 200);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (City).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $city = City::destroy($id);

            if (!is_numeric($id)) {
                return response()->json([
                    'error' => 'La solicitud contiene errores (City).'
                ], 400);
            } else if (!$city) {
                return response()->json([
                    'error' => 'El recurso solicitado no existe (City).'
                ], 404);
            } else {
                return response()->json($city, 204);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (City).',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
