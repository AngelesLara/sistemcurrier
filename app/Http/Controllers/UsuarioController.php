<?php

namespace App\Http\Controllers;

use App\Http\Responses\ApiResponse;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::all();
            return ApiResponse::success('Lista de Usuarios', 200, $users);
        } catch (Exception $e) {
            return ApiResponse::error('Error, Algo salio mal: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|min:9',
                'role' => 'required|exists:roles,name'
            ]);

            // Encriptar contraseña
            $passwordHash = Hash::make($request->password);

            // Crear usuario
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $passwordHash,
            ]);

            // Asignar su rol
            $user->assignRole($request->role);

            DB::commit();
            return ApiResponse::success('Usuario registrado correctamente', 201, $user);
        } catch (ValidationException $e) {
            DB::rollBack();
            return ApiResponse::error('Error de validación', 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponse::error('Error interno del servidor: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        try {
            $user = User::findOrFail($id);
            return ApiResponse::success('Usuario Obtenido Existosamente', 200, $user);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Usuario no encontrado', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {
            DB::beginTransaction();

            /*Comprobar el password y aplicar el Hash*/
            if (empty($request->password)) {
                $request = Arr::except($request, array('password'));
            } else {
                $fieldHash = Hash::make($request->password);
                $request->merge(['password' => $fieldHash]);
            }

            $user->update($request->all());

            /**Actualizar rol */
            $user->syncRoles([$request->role]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('users.index')->with('success', 'Usuario editado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        //Eliminar rol
        $rolUser = $user->getRoleNames()->first();
        $user->removeRole($rolUser);

        //Eliminar usuario
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado');
    }
}
