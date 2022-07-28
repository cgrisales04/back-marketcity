<?php

use App\Http\Controllers\GeneroController;
use App\Http\Controllers\TipoIdentificacionController;
use App\Http\Controllers\TipoUsuarioController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix'     => 'usuario'
], function ($router) {
    Route::post('insertarUsuario', [UsuarioController::class, 'insertarUsuario'])->name('insertarUsuario');
    Route::post('editarUsuario', [UsuarioController::class, 'editarUsuario'])->name('editarUsuario');
    Route::post('eliminarUsuario', [UsuarioController::class, 'eliminarUsuario'])->name('eliminarUsuario');
    Route::get('mostrarUsuarios', [UsuarioController::class, 'mostrarUsuarios'])->name('mostrarUsuarios');
    Route::post('obtenerUsuario', [UsuarioController::class, 'obtenerUsuario'])->name('obtenerUsuario');
});

Route::group([
    'middlewre' => 'api',
    'prefix' => 'tipos'
], function ($router) {
    Route::get('getGeneros', [GeneroController::class, 'getGeneros'])->name('getGeneros');
    Route::get('getIdentificaciones', [TipoIdentificacionController::class, 'getIdentificaciones'])->name('getIdentificaciones');
    Route::get('getTipoUsuarios', [TipoUsuarioController::class, 'getTipoUsuarios'])->name('getTipoUsuarios');
});
