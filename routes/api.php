<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DestinoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EncargadoTruckController;
use App\Http\Controllers\EnvioClienteController;
use App\Http\Controllers\EnvioController;
use App\Http\Controllers\PaqueteController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TipoClienteController;
use App\Http\Controllers\TruckController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::apiResource('/roles', RoleController::class);
Route::apiResource('/permisos', PermisoController::class);
Route::apiResource('/usuarios', UsuarioController::class);
Route::apiResource('/empleados', EmpleadoController::class);
Route::apiResource('/tipoclientes', TipoClienteController::class);
Route::apiResource('/clientes', ClienteController::class);
Route::apiResource('/paquetes', PaqueteController::class);
Route::apiResource('/destinos', DestinoController::class);
Route::apiResource('/envios', EnvioController::class);
Route::apiResource('/trucks', TruckController::class);
Route::apiResource('/envioclientes', EnvioClienteController::class);
Route::apiResource('/encargadotrucks', EncargadoTruckController::class);