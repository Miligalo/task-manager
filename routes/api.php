<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TaskManager\CommentController;
use App\Http\Controllers\TaskManager\TaskController;
use App\Http\Controllers\TaskManager\TeamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/', function () {
    return 122221;
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::resource('tasks', TaskController::class)->middleware('auth:sanctum');
Route::resource('teams', TeamController::class)->middleware('auth:sanctum');

Route::get('/teams', [TeamController::class, 'index'])->middleware('auth:sanctum');
Route::post('teams', [TeamController::class, 'store'])->middleware('auth:sanctum');
Route::post('teams/{team}/users', [TeamController::class, 'addUser'])->middleware('auth:sanctum');
Route::delete('teams/{team}/users/{user}', [TeamController::class, 'removeUser'])->middleware('auth:sanctum');

Route::get('/tasks', [TaskController::class, 'index'])->middleware('auth:sanctum');
Route::post('/tasks', [TaskController::class, 'store'])->middleware('auth:sanctum');
Route::put('tasks/{task}', [TaskController::class, 'update'])->middleware('auth:sanctum');
Route::delete('tasks/{task}', [TaskController::class, 'destroy'])->middleware('auth:sanctum');
Route::get('/tasks/{task}', [TaskController::class, 'show'])->middleware('auth:sanctum');
Route::post('/tasks/{task}/comments', [TaskController::class, 'addComment'])->middleware('auth:sanctum');
Route::get('/tasks/{task}/comments', [CommentController::class, 'getComments'])->middleware('auth:sanctum');
Route::delete('/comments/{comment}', [CommentController::class, 'deleteComment'])->middleware('auth:sanctum');
