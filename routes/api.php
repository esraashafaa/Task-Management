<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post("register", [AuthController::class, 'register']);

Route::post("login", [AuthController::class, 'login']);
Route::get("me", [AuthController::class, 'me'])->middleware('auth:sanctum');

Route::post('update-project/{id}', [ProjectController::class, 'update']);


