<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanetaController;
use App\Http\Controllers\EspecieController;
use App\Http\Controllers\PersonajeController;
use App\Http\Controllers\UsuarioController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('admin.welcome');
});



Route::resource('personaje', PersonajeController::class);
Route::delete('personaje/flush/all', [PersonajeController::class, 'flush'])->name('personaje.flush');

Route::resource('especie', EspecieController::class);
Route::delete('especie/flush/all', [EspecieController::class, 'flush'])->name('especie.flush');

Route::resource('planeta', PlanetaController::class);
Route::delete('planeta/flush/all', [PlanetaController::class, 'flush'])->name('planeta.flush');



// para verificar el correo
Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('usuario', UsuarioController::class); 

// nueva ruta, para cambiar el edit para el usuario  utilizamos el put ( no tiene que ser root, dentro de root)
Route::put('usuario', [App\Http\Controllers\UsuarioController::class, 'userupdate'])->name('user.userupdate');

Route::get('usuarioEdit', [App\Http\Controllers\UsuarioController::class, 'useredit'])->name('user.useredit');

Route::delete('usuario/flush/all', [UsuarioController::class, 'flush'])->name('usuario.flush');