<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    // -------------- Rutas publicas ---------------
    Route::post('/signUp', [AuthController::class, 'signUp']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('posts', [PostController::class, 'index']);
    Route::get('/post/{id}', [PostController::class, 'show']);

    // ------------- Rutas con autenticacion ---------------------
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/my-profile', [AuthController::class, 'getMe']);
        Route::get('/logout', [AuthController::class, 'logOut']);
        Route::put('/update-me', [UserController::class, 'update']);
        Route::delete('/delete-me', [UserController::class, 'delete']);
        Route::post('/post', [PostController::class, 'store']);
        Route::post('/comment/{post_id}', [CommentController::class, 'store']);
    });
    Route::middleware('auth:sanctum')->group(function (){
        Route::put('/post', [PostController::class, 'update']); //Lo necesita
        Route::delete('/post/{id}', [PostController::class, 'destroy']); //Lo necesita
        Route::put('/comment/{id}', [CommentController::class, 'store']); //Lo necesita
        Route::delete('/comment/{id}', [CommentController::class, 'store']); //No lo
    });
});