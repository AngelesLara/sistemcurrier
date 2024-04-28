<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //captura todos los datos obtenidos en el la tabla permisos
        $permisos = Permission::all();

        //muestra la pagina con todos los datos obtenidos pasando el datos permisos...
        return response()->json($permisos);

        /*
        //captura todos los datos obtenidos en el la tabla permisos
        $permisos = Permission::all();

        //muestra la pagina con todos los datos obtenidos pasando el datos permisos...
        return view('users.permisos', compact('permisos'));
        
        */
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //para crear rapido un registro en store...
        $permisos = Permission::create(['name' => $request->input('name')]);

        //retorna a la vista....
        return response()->json($permisos);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
