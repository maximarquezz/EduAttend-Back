<?php
namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        try {
            $assignments = Assignment::with([
                'MidComissionSubject.Subject',
                'MidComissionSubject.Comission'
            ])->get();
            
            if ($assignments->isEmpty()) {
                return response()->json([], 200);
            } else {
                return response()->json($assignments, 200);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Assignment).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function myAssignments(Request $request)
    {
        try {
            $userId = $request->user()->id;
            
            $assignments = Assignment::where('user_id', $userId)
                ->with([
                    'MidComissionSubject.Subject',
                    'MidComissionSubject.Comission'
                ])
                ->get();
            
            return response()->json($assignments, 200);
            
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Assignment).',
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
            $validated = $request->validate([
                'mid_comissions_subjects_id' => 'required|exists:mid_comissions_subjects,id',
                'assign_type' => 'required|in:CURSA,DICTA,PRECEPTOR'
            ]);

            // Si no se especifica user_id, usa el usuario autenticado
            $data = $validated;
            if (!isset($data['user_id'])) {
                $data['user_id'] = $request->user()->id;
            }

            // Verificar si ya existe esta asignación
            $exists = Assignment::where('user_id', $data['user_id'])
                ->where('mid_comissions_subjects_id', $data['mid_comissions_subjects_id'])
                ->where('assign_type', $data['assign_type'])
                ->exists();

            if ($exists) {
                return response()->json([
                    'error' => 'Ya existe esta asignación para el usuario.'
                ], 409);
            }

            $assignment = Assignment::create($data);
            
            // Cargar relaciones para la respuesta
            $assignment->load([
                'MidComissionSubject.Subject',
                'MidComissionSubject.Comission'
            ]);

            return response()->json($assignment, 201);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Datos de validación incorrectos.',
                'details' => $e->errors()
            ], 422);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Assignment).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Assignment $assignment)
    {
        //
    }

    public function edit(Assignment $assignment)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try {
            $assignment = Assignment::find($id);
            
            if (!is_numeric($id)) {
                return response()->json([
                    'error' => 'La solicitud contiene errores (Assignment).',
                ], 400);
            } else if (!$assignment) {
                return response()->json('El recurso solicitado no existe (Assignment).', 404);
            } else {
                $assignment->update($request->all());
                
                // Cargar relaciones para la respuesta
                $assignment->load([
                    'MidComissionSubject.Subject',
                    'MidComissionSubject.Comission'
                ]);
                
                return response()->json($assignment, 200);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Assignment).',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $assignment = Assignment::destroy($id);
            
            if (!is_numeric($id)) {
                return response()->json([
                    'error' => 'La solicitud contiene errores (Assignment).'
                ], 400);
            } else if (!$assignment) {
                return response()->json([
                    'error' => 'El recurso solicitado no existe (Assignment).'
                ], 404);
            } else {
                return response()->json($assignment, 204);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Error interno del servidor (Assignment).',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}