<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;

Auth::routes();

Route::get('/',[DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

Route::get('/task/create',[TaskController::class, 'create'])->name('task.create');
Route::get('/task/edit',[TaskController::class, 'edit'])->name('task.edit');