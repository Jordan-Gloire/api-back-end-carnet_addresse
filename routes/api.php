<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('carnet', App\Http\Controllers\CarnetController::class);

Route::post('/inscription', [AuthController::class, 'inscription']);
Route::post('/connexion', [AuthController::class, 'connexion']);
Route::post('/deconnexion', [AuthController::class, 'deconnexion'])->middleware('auth:sanctum');
Route::post('/recherche', [AuthController::class, 'recherche']);