<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;

Route::get('/',[DashboardController::class, 'index'])->name('dashboard');

Route::get('/login',[AuthController::class, 'login'])->name('auth.login');
Route::get('/register',[AuthController::class, 'register'])->name('auth.register');

Route::get('/task/create',[TaskController::class, 'create'])->name('task.create');
Route::get('/task/edit',[TaskController::class, 'edit'])->name('task.edit');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
