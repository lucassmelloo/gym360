<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class WorkoutController extends Controller
{
    public function imprimirTreino($id)
    {
        $workout = Workout::with(['student', 'workout_divisions.workout_division_exercises.method','workout_type', 'user'])->findOrFail($id);

        $pdf = PDF::loadView('pdfs.workout', compact('workout'));

        // Exibe o PDF no navegador
        return $pdf->stream('workout.pdf');
    }
}
