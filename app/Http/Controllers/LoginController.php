<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Responses\ApiResponse;
use Exception;

class LoginController extends Controller
{
    public function index()
    {
        try {
            if (Auth::check()) {
                return redirect()->route('panel');
            }
        } catch (Exception $e) {
            return ApiResponse::error('Error: ' . $e->getMessage(), 401);
        }
    }

    public function login(Request $request)
    {
        try {
            // Validar los datos de entrada
            $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            // Intentar autenticar al usuario
            if (!Auth::attempt($request->only('email', 'password'))) {
                return ApiResponse::error('Credenciales incorrectas', 401);
            }

            // Autenticación exitosa
            $user = Auth::user();

            return ApiResponse::success('Bienvenido: ' . $user->name, 200, $user);
        } catch (Exception $e) {
            return ApiResponse::error('Error: ' . $e->getMessage(), 422);
        }
    }
}
