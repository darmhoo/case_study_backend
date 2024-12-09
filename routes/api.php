<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController\LoginController;
use App\Http\Controllers\AuthController\RegisterController;
use App\Services\GetNewsDataServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/test-news', function (Request $request) {
    $po = new GetNewsDataServices();
    $po->bbcNews();

    return response()->json(['status' => 'success'], 200);
});

Route::resource('articles', ArticleController::class)->middleware('auth:sanctum');
