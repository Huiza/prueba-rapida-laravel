<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PruebaControllerController;

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

Route::middleware('auth')->group(function () {
    Route::get('/prueba', [PruebaControllerController::class, 'index']);
    Route::post('/prueba', [PruebaControllerController::class, 'store']);
    Route::get('/prueba/{id}', [PruebaControllerController::class, 'show']);
    Route::put('/prueba/{id}', [PruebaControllerController::class, 'update']);
    Route::delete('/prueba/{id}', [PruebaControllerController::class, 'destroy']);
});

Route::resource('prueba', PruebaControllerController::class)->middleware('auth');

Route::resource('prueba', PruebaControllerController::class)->only(['index', 'store']); // Solo index y store->middleware('auth');  // Middleware aplicado solo a estas dos rutas

Route::resource('prueba', PruebaControllerController::class)->except(['create', 'edit'])->middleware('auth');  // Middleware aplicado a todas las rutas excepto create y edit

