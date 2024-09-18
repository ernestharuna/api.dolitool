<?php

use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [RegisterController::class, 'register']);

Route::post('login', [LoginController::class, 'authenticate']);

Route::as('tasks:')->middleware(['auth:sanctum', 'verified'])->group(
    base_path('routes/api/tasks.php'),
);

Route::as('task_group:')->middleware(['auth:sanctum', 'verified'])->group(
    base_path('routes/api/task_groups.php'),
);
