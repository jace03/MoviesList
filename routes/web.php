<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;
// Create a test file in storage/logs/test.txt
file_put_contents(storage_path('logs/test.txt'), 'Write test: ' . now());
Route::get('/', function () {
    return view('welcome');
});
Route::get('/example', function () {
    return response()->json(['message' => 'Hello from the API!']);
});

Route::resource('movies', MovieController::class);

Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/movies/{id}/edit', [MovieController::class, 'edit'])->name('movies.edit');
Route::put('/movies/{id}', [MovieController::class, 'update'])->name('movies.update');
Route::delete('/movies/{id}', [MovieController::class, 'destroy'])->name('movies.destroy');
Route::post('/actors/bulk', [ActorController::class, 'bulkStore']);
Route::put('/movies/{id}', [MovieController::class, 'update'])->name('movies.update');
Route::get('movies/{id}/actors', [MovieController::class, 'editActors'])
    ->name('movies.editActors');

Route::put('movies/{id}/actors', [MovieController::class, 'updateActors'])
    ->name('movies.updateActors');
