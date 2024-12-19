<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\WorkoutController;

Route::get('/workouts/{id}/imprimir', [WorkoutController::class, 'imprimirTreino'])->name('workouts.imprimir');


