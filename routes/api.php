<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/signUp', [AuthController::class, 'signUp']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/my-profile', [AuthController::class, 'getMe'])->middleware('auth:sanctum');
Route::get('/logout', [AuthController::class, 'logOut'])->middleware('auth:sanctum');