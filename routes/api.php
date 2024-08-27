<?php

use App\Http\Controllers; // определяем общее имя для контролеров, дабы избежать лишних импортов
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('users', Controllers\UserController::class);
Route::apiResource('posts', Controllers\PostController::class);
Route::apiResource('comments', Controllers\CommentController::class);

// доп запросы
Route::get('users/{user}/posts', [Controllers\UserController::class, 'posts']);
Route::get('users/{user}/comments', [Controllers\UserController::class, 'comments']);
Route::get('posts/{post}/comments', [Controllers\PostController::class, 'comments']);
