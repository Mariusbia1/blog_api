<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

//  Routes PUBLIQUES (pas besoin d'être connecté)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);
Route::get('/blogs',     [BlogController::class, 'index']);

//  Routes PROTÉGÉES (token requis)
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    // CRUD Blog
    Route::post('/blogs',          [BlogController::class, 'store']);
    Route::get('/blogs/{blog}',    [BlogController::class, 'show']);
    Route::put('/blogs/{blog}',    [BlogController::class, 'update']);
    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy']);

});
