<?php

namespace App\Http\Controllers;

use App\Http\Responses\ApiResponse;
use App\Models\Empleado;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $empleados = Empleado::all();
            return ApiResponse::success('Lista de Empleados', 200, $empleados);
        } catch (Exception $e) {
            return ApiResponse::error('Error, Algo salio mal: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Almacena un nuevo Empleado.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'empCodigo' => 'required|unique:empleados',
                'empNombre' => 'required',
                'empTelefono' => 'required',
                'empEmail' => 'required',
                'empDireccion' => 'required',
                'empCargo' => 'required',
                'empSueldo' => 'required'
            ]);
            $empleado = Empleado::create($request->all());
            return ApiResponse::success('Empleado registrado Correctamente!', 201, $empleado);
        } catch (ValidationException $e) {
            return ApiResponse::error('Error de Validación...', 422);
        }
    }

    /**
     * Muestra el detalle de un Empleado específico.
     */
    public function show($id)
    {
        try {
            $empleado = Empleado::findOrFail($id);
            return ApiResponse::success('Empleado Obtenido Existosamente', 200, $empleado);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Empleado no encontrado', 404);
        }
    }

    /**
     * Actualiza un Empleado existente.
     */
    public function update(Request $request, $id)
    {
        try {
            $empleado = Empleado::findOrFail($id);
            $request->validate([
                'empCodigo' => ['required', Rule::unique('empleados')->ignore($empleado)],
                'empNombre' => 'required',
                'empTelefono' => 'required',
                'empEmail' => 'required',
                'empDireccion' => 'required',
                'empCargo' => 'required',
                'empSueldo' => 'required'
            ]);

            $empleado->update($request->all());
            return ApiResponse::success('Empleado Actualizado Existosamente', 200, $empleado);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Empleado no encontrado', 404);
        } catch (Exception $e) {
            return ApiResponse::error('Error: ' . $e->getMessage(), 422);
        }
    }

    /**
     * Elimina un Empleado.
     */
    public function destroy($id)
    {
        try {
            $empleado = Empleado::findOrFail($id);
            $empleado->delete();
            return ApiResponse::success('Empleado Eliminado Existosamente', 200);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Empleado no encontrado para Eliminar...', 404);
        }
    }
}
