<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\GitAgentController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\DevOpsAgentController;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Controllers\Api\MovieController;
use Illuminate\Support\Facades\Route;


Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movies/{id}', [MovieController::class, 'show']);
//Route::post('/movies', [MovieController::class, 'store']);
//Route::put('/movies/{id}', [MovieController::class, 'update']);
Route::delete('/movies/{id}', [MovieController::class, 'destroy']);
Route::get('/movies/rating/{rating}', [MovieController::class, 'orderByRating']);

Route::get('/example', function () {
    return response()->json(['message' => 'Hello from the API!']);
});

Route::post('/user', [App\Http\Controllers\Api\UserController::class, 'store']);
//Route::post('/actors', [ActorController::class, 'store']);

Route::post('/agent', [App\Http\Controllers\AgentController::class, 'handle']);
Route::post('/doc-agent', [App\Http\Controllers\DocumentationAgentController::class, 'handle']);
Route::post('/git-agent', [App\Http\Controllers\GitAgentController::class, 'handle']);
Route::post('/devops-agent', [App\Http\Controllers\DevOpsAgentController::class, 'handle']);