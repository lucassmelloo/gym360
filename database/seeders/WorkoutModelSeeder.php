<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkoutModel;
use App\Models\User;
use App\Models\WorkoutType;
use Carbon\Carbon;

class WorkoutModelSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('email', 'lucasmellovieira99@gmail.com')->first();

        $workoutTypes = WorkoutType::all();

        $workouts = [
            [
                'name' => 'Treino de Hipertrofia Avançado',
                'user_id' => $user->id,
                'workout_type_id' => $workoutTypes->where('name', 'Hipertrofia')->first()->id,
            ],
            [
                'name' => 'Treino de Força e Resistência',
                'user_id' => $user->id,
                'workout_type_id' => $workoutTypes->where('name', 'Força')->first()->id,
            ],
            [
                'name' => 'Plano de Perda de Peso',
                'user_id' => $user->id,
                'workout_type_id' => $workoutTypes->where('name', 'Perda de peso')->first()->id,
            ],
        ];

        foreach ($workouts as $workout) {
            WorkoutModel::create($workout);
        }
    }
}
