<?php

namespace Database\Seeders;

use App\Models\WorkoutDivision;
use Illuminate\Database\Seeder;

class WorkoutDivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workoutsDivisions = [

            [
                'workout_id' => 1,
                'title' => 'Treino A',
                'order' => 1,
            ],
            [
                'workout_id' => 1,
                'title' => 'Treino B',
                'order' => 2,
            ],
            [
                'workout_id' => 1,
                'title' => 'Treino C',
                'order' => 3,
            ],

            [
                'workout_id' => 2,
                'title' => 'Treino A',
                'order' => 1,
            ],
            [
                'workout_id' => 2,
                'title' => 'Treino B',
                'order' => 2,
            ],

            [
                'workout_id' => 3,
                'title' => 'Treino A',
                'order' => 1,
            ],
            [
                'workout_id' => 3,
                'title' => 'Treino B',
                'order' => 2,
            ],
            [
                'workout_id' => 3,
                'title' => 'Treino C',
                'order' => 3,
            ],
        ];

        foreach ($workoutsDivisions as $workoutsDivision) {
            WorkoutDivision::create($workoutsDivision);
        }
    }
}
