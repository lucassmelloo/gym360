<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\WorkoutController;

Route::get('/workouts/{id}/imprimir', [WorkoutController::class, 'printWorkoutPdf'])->name('workouts.imprimir');
Route::get('/workouts/{id}/imprimir/html', [WorkoutController::class, 'printWorkoutHtml'])->name('workouts.imprimirhtml');


