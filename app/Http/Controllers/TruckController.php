<?php

namespace App\Http\Controllers;

use App\Http\Responses\ApiResponse;
use App\Models\Truck;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TruckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $trucks = Truck::all();
            return ApiResponse::success('Lista de Camiones', 200, $trucks);
        } catch (Exception $e) {
            return ApiResponse::error('Error, Algo salio mal: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Almacena un nuevo truck.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'truPlaca' => 'required|unique:trucks',
                'truSOAT' => 'required',
                'truMarca' => 'required',
                'truCapacidadPeso' => 'required'
            ]);
            $truck = Truck::create($request->all());
            return ApiResponse::success('Camión registrado Correctamente!', 201, $truck);
        } catch (ValidationException $e) {
            return ApiResponse::error('Error de Validación...', 422);
        }
    }

    /**
     * Muestra el detalle de un truck específico.
     */
    public function show($id)
    {
        try {
            $truck = Truck::findOrFail($id);
            return ApiResponse::success('Camión Obtenido Existosamente', 200, $truck);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Camión no encontrado', 404);
        }
    }

    /**
     * Actualiza un truck existente.
     */
    public function update(Request $request, $id)
    {
        try {
            $truck = Truck::findOrFail($id);
            $request->validate([
                'truPlaca' => ['required', Rule::unique('trucks')->ignore($truck)],
                'truSOAT' => 'required',
                'truMarca' => 'required',
                'truCapacidadPeso' => 'required',
            ]);

            $truck->update($request->all());
            return ApiResponse::success('Camión Actualizado Existosamente', 200, $truck);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Camión no encontrado', 404);
        } catch (Exception $e) {
            return ApiResponse::error('Error: ' . $e->getMessage(), 422);
        }
    }

    /**
     * Elimina un truck.
     */
    public function destroy($id)
    {
        try {
            $truck = Truck::findOrFail($id);
            $truck->delete();
            return ApiResponse::success('Camión Eliminado Existosamente', 200);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Camión no encontrado para Eliminar...', 404);
        }
    }
}
