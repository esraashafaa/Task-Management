<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post("register", [AuthController::class, 'register']);

Route::post("login", [AuthController::class, 'login']);
Route::get("me", [AuthController::class, 'me'])->middleware('auth:sanctum');

Route::post('update-project/{id}', [ProjectController::class, 'update']);

Route::post('/tasks', [TaskController::class, 'store'])->middleware('auth:sanctum');
