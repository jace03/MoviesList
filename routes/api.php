<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Controllers\Api\MovieController;
use Illuminate\Support\Facades\Route;


Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movies/{id}', [MovieController::class, 'show']);
Route::post('/movies', [MovieController::class, 'store']);
Route::put('/movies/{id}', [MovieController::class, 'update']);
Route::delete('/movies/{id}', [MovieController::class, 'destroy']);
Route::get('/movies/rank/{rank}', [MovieController::class, 'orderByRank']);

Route::get('/example', function () {
    return response()->json(['message' => 'Hello from the API!']);
});
Route::post('/user', [App\Http\Controllers\Api\UserController::class, 'store']);

//return Application::configure(basePath: dirname(__DIR__))
//    ->withRouting(
//        web: __DIR__.'/../routes/web.php',
//        api: __DIR__.'/../routes/api.php',  // Add this line
//        commands: __DIR__.'/../routes/console.php',
//        health: '/up',
//    )
//    ->withMiddleware(function (Middleware $middleware) {
//        //
//    })
//    ->withExceptions(function (Exceptions $exceptions) {
//        //
//    })->create();
