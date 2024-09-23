<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\TaskApiController;
use App\Http\Controllers\Api\AuthApiController;

Route::post('/register', [AuthApiController::class, 'register'])->name('api.register');
Route::post('/login', [AuthApiController::class, 'login'])->name('api.login');

Route::apiResource('tasks', TaskApiController::class)
    ->middleware('auth:sanctum');

Route::post('/tasks/{task}/update-status', [TaskApiController::class, 'updateStatus'])
    ->name('tasks.updateStatus')
    ->middleware('auth:sanctum');