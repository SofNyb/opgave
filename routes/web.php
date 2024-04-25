<?php

/*use Illuminate\Support\Facades\Route;*/
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;

use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth:sanctum')->get('/user',
    function (Request $request) {
        return $request->user();
    });

//add the following lines
Route::get('tasks', [TaskController::class, 'index']);
Route::post('task', [TaskController::class, 'store']);
Route::post('task/delete', [TaskController::class, 'delete']);
Route::post('task/complete', [TaskController::class, 'complete']);
