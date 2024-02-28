<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('index');



Route::middleware(['auth'])->group(function () 
{
    Route::get('logout', [UsuariController::class, 'logout']);
  
    Route::middleware(['tipo_usuario:Alumne'])->group(function () {
        Route::get('alumnes/autoavaluacio', function () {
            return view('usuaris.alumnes.autoavaluacio');
        })->name('autoavaluacio');   
    });

    Route::middleware(['tipo_usuario:Administrador'])->group(function () {
        Route::resource("usuaris", UsuariController::class);
        Route::get('usuaris/{usuari}/edit', [UsuariController::class, 'edit'])->name('usuaris.edit');
        Route::get('usuaris/{usuari}/editPassword}', [UsuariController::class, 'editPassword'])->name('usuaris.editPassword');
        Route::put('usuaris/{usuari}', [UsuariController::class, 'update'])->name('usuaris.update');
        Route::put('usuaris/{usuari}/updatePassword', [UsuariController::class, 'updatePassword'])->name('usuaris.updatePassword');
    });

    Route::middleware(['tipo_usuario:Professor'])->group(function () {
        Route::get('professors/avaluacio', function () {
            return view('usuaris.profesors.autoavaluacioAlumnes');
        })->name('avaluacio');
    });

});


Route::get('login', [UsuariController::class, 'showLoginForm'])->name('login');
Route::post('login', [UsuariController::class, 'login']);

