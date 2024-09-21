<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;

Auth::routes();

Route::get('/',[DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

Route::resource('task', TaskController::class)
    ->except(['index', 'show'])
    ->middleware('auth');

Route::patch('/task/{task}/status', [TaskController::class, 'updateStatus'])
    ->name('task.updateStatus')
    ->middleware('auth');