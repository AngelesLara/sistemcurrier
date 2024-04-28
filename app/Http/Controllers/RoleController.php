<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $roles = Role::all();

        return response()->json($roles);

        /*
        $roles = Role::all();
        return view('users.roles', compact('roles'));
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
        // Valida los datos de la solicitud según sea necesario
        $permisos = Permission::create(['name' => $request->input('name')]);

        //retorna a la vista....
        return response()->json($permisos);
        /*
        $role = Role::create(['name' => $request->input('nombre')]);
        return back();
        */
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
    public function edit(Role $role)
    {
        //
        //$role = Role::find($id);
        $permisos = Permission::all();
        return response()->json(['role' => $role, 'permissions' => $permisos]);

        /*
        //
        //$role = Role::find($id);
        $permisos = Permission::all();  
        return view('users.rolesPermisos', compact('role', 'permisos'));
        */
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
        $role->permissions()->sync($request->permisos);

        return response()->json(['message' => 'Rol actualizado correctamente', 'role' => $role]);
        /*
        //
        $role->permissions()->sync($request->permisos);
        return redirect()->route('roles.index', $role);
        */
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
