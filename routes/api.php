<?php

use App\Http\Controllers\Api\CriteriAvaluacioController;
use App\Http\Controllers\Api\ModulesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ResultatAprenentageController;
use App\Http\Controllers\Api\UsuariController;
use App\Http\Controllers\Api\AuthController;

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

Route::get('usuaris/getalumnes', [UsuariController::class, 'getAllAlumnes']);
Route::put('usuaris/updateCriteriNota/{usuari}/{criteri}', [UsuariController::class, 'updateCriteriNota']);

Route::post('usuaris/matricular/{usuari}',[UsuariController::class, 'matricular']);
Route::delete('usuaris/desmatricular/{usuari}',[UsuariController::class, 'desmatricular']);

Route::get('moduls/modulesByCicle/{cicle}', [ModulesController::class, 'modulesByCicle']);

Route::get('moduls/modulsMatriculats/{usuari}', [ModulesController::class, 'modulsMatriculats']);

Route::get('resultatsAprenentage/resultatsByModul/{modul}/{user}', [ResultatAprenentageController::class, 'getResultatsByModul']);

Route::get('usuaris/getAllAlumnesByModul/{modul}', [UsuariController::class, 'getAllAlumnesByModul']);

Route::apiResource('resultatAprenentage', ResultatAprenentageController::class);
Route::apiResource('criteriAvaluacio', CriteriAvaluacioController::class);
Route::apiResource('usuaris', UsuariController::class);
Route::apiResource('moduls', ModulesController::class);






Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signUp']);
    

    
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
    });
});

