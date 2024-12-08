<?php

use App\Http\Controllers\AuthController\LoginController;
use App\Http\Controllers\AuthController\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/register', [RegisterController::class, 'register']);
