<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    \Log::info('test');
    return view('welcome');
});
