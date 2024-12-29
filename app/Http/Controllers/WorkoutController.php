<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class WorkoutController extends Controller
{
    public function printWorkoutPdf($id)
    {
        $workout = Workout::with(['student', 'workout_divisions.workout_division_exercises.method', 'workout_type', 'user'])->findOrFail($id);

        $pdf = PDF::loadView('pdfs.workout', compact('workout'));

        // Exibe o PDF no navegador
        return $pdf->stream('workout.pdf');
    }

    public function printWorkoutHtml($id)
    {
        // Busca o treino com as relações necessárias
        $workout = Workout::with(['student', 'workout_divisions.workout_division_exercises.method', 'workout_type', 'user'])->findOrFail($id);

        // Retorna a view 'pdfs.workout' com os dados do treino
        return view('pdfs.workout', compact('workout'));
    }
}
