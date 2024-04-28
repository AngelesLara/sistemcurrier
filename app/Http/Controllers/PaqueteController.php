<?php

namespace App\Http\Controllers;

use App\Http\Responses\ApiResponse;
use App\Models\Paquete;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PaqueteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $paquetes = Paquete::all();
            return ApiResponse::success('Lista de Paquetes', 200, $paquetes);
        } catch (Exception $e) {
            return ApiResponse::error('Error, Algo salio mal: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Almacena un nuevo Paquete.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                '' => 'required|unique:empleados',
                '' => 'required',
                '' => 'required',
                '' => 'required',
                '' => 'required',
                '' => 'required',
                '' => 'required'
            ]);
            $paquete = Paquete::create($request->all());
            return ApiResponse::success('Paquete registrado Correctamente!', 201, $paquete);
        } catch (ValidationException $e) {
            return ApiResponse::error('Error de Validación...', 422);
        }
    }

    /**
     * Muestra el detalle de un Paquete específico.
     */
    public function show($id)
    {
        try {
            $paquete = Paquete::findOrFail($id);
            return ApiResponse::success('Paquete Obtenido Existosamente', 200, $paquete);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Paquete no encontrado', 404);
        }
    }

    /**
     * Actualiza un Paquete existente.
     */
    public function update(Request $request, $id)
    {
        try {
            $paquete = Paquete::findOrFail($id);
            $request->validate([
                'empCodigo' => ['required', Rule::unique('empleados')->ignore($paquete)],
                'empNombre' => 'required',
                'empTelefono' => 'required',
                'empEmail' => 'required',
                'empDireccion' => 'required',
                'empCargo' => 'required',
                'empSueldo' => 'required'
            ]);

            $paquete->update($request->all());
            return ApiResponse::success('Paquete Actualizado Existosamente', 200, $paquete);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Paquete no encontrado', 404);
        } catch (Exception $e) {
            return ApiResponse::error('Error: ' . $e->getMessage(), 422);
        }
    }

    /**
     * Elimina un Paquete.
     */
    public function destroy($id)
    {
        try {
            $paquete = Paquete::findOrFail($id);
            $paquete->delete();
            return ApiResponse::success('Paquete Eliminado Existosamente', 200);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Paquete no encontrado para Eliminar...', 404);
        }
    }
}
