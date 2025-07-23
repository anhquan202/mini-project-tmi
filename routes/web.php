<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('login', [AuthController::class, 'index']);
Route::middleware('auth:sanctum')->prefix('home')->controller(HomeController::class)->group(function () {
    Route::get('', 'index');
});