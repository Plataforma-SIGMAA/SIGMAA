<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvaliacaoController;

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware('auth:api')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::post('/profile', [AuthController::class, 'profile']);
    }); 
});

Route::get('/avaliacoes/{id}', [AvaliacaoController::class, 'index']);
Route::post('/avaliacoes/inserir', [AvaliacaoController::class, 'store']);
Route::delete('/avaliacoes/{id}', [AvaliacaoController::class, 'destroy']);
Route::put('/avaliacoes', [AvaliacaoController::class, 'update']);
