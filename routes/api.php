<?php

use App\Http\Controllers\UserAccountController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [UserAccountController::class, 'login']);
Route::get('test', [UserAccountController::class, 'test'])->middleware('auth:sanctum');
