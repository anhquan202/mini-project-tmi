<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserAccountController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [UserAccountController::class, 'login']);
Route::post('reset-password', [UserAccountController::class, 'resetPassword']);
Route::post('reset-password-code', [AuthController::class, 'createVerifyPasswowrdCodeMail']);
Route::get('users', [UserAccountController::class, 'showUsersHasAccount']);