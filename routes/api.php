<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserInternalController;

Route::get('/me', [UserController::class, 'me'])->middleware('auth:sanctum');
Route::post('/new-user', [UserController::class, 'newUser']);
Route::put('/update-user', [UserController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/logout-user', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/login-user', [UserController::class, 'login']);
Route::put('set-role-user', [UserController::class, 'setRole'])->middleware('auth:sanctum');


Route::prefix('/internal/users')
    ->middleware('service.auth')
    ->controller(UserInternalController::class)
    ->group(function () {
        Route::get('{id}', 'show');
        Route::post('bulk', 'bulkShow');
    });