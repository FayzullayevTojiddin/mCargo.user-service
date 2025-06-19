<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/me', [UserController::class, 'me'])->middleware('auth:sanctum');
Route::post('/new-user', [UserController::class, 'newUser']);
Route::put('/update-user', [UserController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/logout-user', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/login-user', [UserController::class, 'login']);
Route::put('set-role-user', [UserController::class, 'setRole'])->middleware('auth:sanctum');


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
