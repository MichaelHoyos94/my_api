<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/signUp', [AuthController::class, 'signUp']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/my-profile', [AuthController::class, 'getMe'])->middleware('auth:sanctum');
Route::get('/logout', [AuthController::class, 'logOut'])->middleware('auth:sanctum');

//Route::apiResources('/users', UserController::class);

//Users routes
Route::put('/update-me', [UserController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/delete-me', [UserController::class, 'delete'])->middleware('auth:sanctum'); // El middleware le pone a $request el user.

Route::prefix('v1')->group(function () {
    Route::get('posts', [PostController::class, 'index']);
    Route::get('/post/{id}', [PostController::class, 'show']);
    Route::middleware('auth:sanctum')->group(function (){
        Route::post('/post', [PostController::class, 'store']);
        Route::put('/post', [PostController::class, 'update']);
        Route::delete('/post/{id}', [PostController::class, 'destroy']);
        Route::post('/comment/{post_id}', [CommentController::class, 'store']);
        Route::put('/comment/{id}', [CommentController::class, 'store']);
        Route::delete('/comment/{id}', [CommentController::class, 'store']);
    });
});