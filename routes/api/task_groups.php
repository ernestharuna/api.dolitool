<?php

use App\Http\Controllers\TaskGroupController;
use Illuminate\Support\Facades\Route;

Route::apiResource('task_groups', TaskGroupController::class);
