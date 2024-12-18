<?php

namespace Database\Seeders;

use App\Models\WorkoutDivisionExercise;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkoutDivisionExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workourDivisionExercises = [
            //Treino Peito Jon
            [
                'user_id' => 1,
                'workout_division_id' => 1,
                'method_id' => 1,
                'exercise_id' => 1,
                'series' => 3,
                'repetitions' => '2x10 Drop',
                'order' => 1
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 1,
                'method_id' => 2,
                'exercise_id' => 5,
                'series' => 3,
                'repetitions' => '10',
                'order' => 2
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 1,
                'method_id' => 2,
                'exercise_id' => 6,
                'series' => 3,
                'repetitions' => 'Até a falha',
                'order' => 3
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 1,
                'method_id' => 3,
                'exercise_id' => 4,
                'series' => 3,
                'repetitions' => '10',
                'order' => 4
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 1,
                'method_id' => 3,
                'exercise_id' => 7,
                'series' => 3,
                'repetitions' => '10',
                'order' => 5
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 1,
                'method_id' => 3,
                'exercise_id' => 9,
                'series' => 3,
                'repetitions' => '10',
                'order' => 6
            ],

            //Treino Costas Jon
            [
                'user_id' => 1,
                'workout_division_id' => 2,
                'method_id' => 2,
                'exercise_id' => 15,
                'series' => 3,
                'repetitions' => '10',
                'order' => 1
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 2,
                'method_id' => 2,
                'exercise_id' => 19,
                'series' => 3,
                'repetitions' => '10',
                'order' => 2
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 2,
                'method_id' => 1,
                'exercise_id' => 18,
                'series' => 3,
                'repetitions' => 'Até a falha',
                'order' => 3
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 2,
                'method_id' => 3,
                'exercise_id' => 12,
                'series' => 3,
                'repetitions' => '10',
                'order' => 4
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 2,
                'method_id' => 3,
                'exercise_id' => 13,
                'series' => 3,
                'repetitions' => '10',
                'order' => 5
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 2,
                'method_id' => 3,
                'exercise_id' => 17,
                'series' => 3,
                'repetitions' => '10',
                'order' => 6
            ],

            //Treino Perna Jon
            [
                'user_id' => 1,
                'workout_division_id' => 3,
                'method_id' => 2,
                'exercise_id' => 33,
                'series' => 3,
                'repetitions' => '10',
                'order' => 1
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 3,
                'method_id' => 2,
                'exercise_id' => 34,
                'series' => 3,
                'repetitions' => '10',
                'order' => 2
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 3,
                'method_id' => 2,
                'exercise_id' => 36,
                'series' => 3,
                'repetitions' => 'Até a falha',
                'order' => 3
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 3,
                'method_id' => 2,
                'exercise_id' => 37,
                'series' => 3,
                'repetitions' => '10',
                'order' => 4
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 3,
                'method_id' => 2,
                'exercise_id' => 30,
                'series' => 3,
                'repetitions' => '10',
                'order' => 5
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 3,
                'method_id' => 2,
                'exercise_id' => 35,
                'series' => 3,
                'repetitions' => '10',
                'order' => 6
            ],

            //Treino Peito Lucas
            [
                'user_id' => 4,
                'workout_division_id' => 4,
                'method_id' => 1,
                'exercise_id' => 1,
                'series' => 3,
                'repetitions' => '2x10 Drop',
                'order' => 1
            ],
            [
                'user_id' => 4,
                'workout_division_id' => 4,
                'method_id' => 2,
                'exercise_id' => 5,
                'series' => 3,
                'repetitions' => '10',
                'order' => 2
            ],
            [
                'user_id' => 4,
                'workout_division_id' => 4,
                'method_id' => 2,
                'exercise_id' => 6,
                'series' => 3,
                'repetitions' => 'Até a falha',
                'order' => 3
            ],
            [
                'user_id' => 4,
                'workout_division_id' => 4,
                'method_id' => 3,
                'exercise_id' => 4,
                'series' => 3,
                'repetitions' => '10',
                'order' => 4
            ],
            [
                'user_id' => 4,
                'workout_division_id' => 4,
                'method_id' => 3,
                'exercise_id' => 7,
                'series' => 3,
                'repetitions' => '10',
                'order' => 5
            ],
            [
                'user_id' => 4,
                'workout_division_id' => 4,
                'method_id' => 3,
                'exercise_id' => 9,
                'series' => 3,
                'repetitions' => '10',
                'order' => 6
            ],

            //Treino Costas Lucas
            [
                'user_id' => 4,
                'workout_division_id' => 5,
                'method_id' => 2,
                'exercise_id' => 15,
                'series' => 3,
                'repetitions' => '10',
                'order' => 1
            ],
            [
                'user_id' => 4,
                'workout_division_id' => 5,
                'method_id' => 2,
                'exercise_id' => 19,
                'series' => 3,
                'repetitions' => '10',
                'order' => 2
            ],
            [
                'user_id' => 4,
                'workout_division_id' => 5,
                'method_id' => 1,
                'exercise_id' => 18,
                'series' => 3,
                'repetitions' => 'Até a falha',
                'order' => 3
            ],
            [
                'user_id' => 4,
                'workout_division_id' => 5,
                'method_id' => 3,
                'exercise_id' => 12,
                'series' => 3,
                'repetitions' => '10',
                'order' => 4
            ],
            [
                'user_id' => 4,
                'workout_division_id' => 5,
                'method_id' => 3,
                'exercise_id' => 13,
                'series' => 3,
                'repetitions' => '10',
                'order' => 5
            ],
            [
                'user_id' => 4,
                'workout_division_id' => 5,
                'method_id' => 3,
                'exercise_id' => 17,
                'series' => 3,
                'repetitions' => '10',
                'order' => 6
            ],

            //Treino Peito Lis
            [
                'user_id' => 1,
                'workout_division_id' => 6,
                'method_id' => 1,
                'exercise_id' => 1,
                'series' => 3,
                'repetitions' => '2x10 Drop',
                'order' => 1
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 6,
                'method_id' => 2,
                'exercise_id' => 5,
                'series' => 3,
                'repetitions' => '10',
                'order' => 2
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 6,
                'method_id' => 2,
                'exercise_id' => 6,
                'series' => 3,
                'repetitions' => 'Até a falha',
                'order' => 3
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 6,
                'method_id' => 3,
                'exercise_id' => 4,
                'series' => 3,
                'repetitions' => '10',
                'order' => 4
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 6,
                'method_id' => 3,
                'exercise_id' => 7,
                'series' => 3,
                'repetitions' => '10',
                'order' => 5
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 6,
                'method_id' => 3,
                'exercise_id' => 9,
                'series' => 3,
                'repetitions' => '10',
                'order' => 6
            ],

            //Treino Costas Lis
            [
                'user_id' => 1,
                'workout_division_id' => 7,
                'method_id' => 2,
                'exercise_id' => 15,
                'series' => 3,
                'repetitions' => '10',
                'order' => 1
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 7,
                'method_id' => 2,
                'exercise_id' => 19,
                'series' => 3,
                'repetitions' => '10',
                'order' => 2
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 7,
                'method_id' => 1,
                'exercise_id' => 18,
                'series' => 3,
                'repetitions' => 'Até a falha',
                'order' => 3
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 7,
                'method_id' => 3,
                'exercise_id' => 12,
                'series' => 3,
                'repetitions' => '10',
                'order' => 4
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 7,
                'method_id' => 3,
                'exercise_id' => 13,
                'series' => 3,
                'repetitions' => '10',
                'order' => 5
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 7,
                'method_id' => 3,
                'exercise_id' => 17,
                'series' => 3,
                'repetitions' => '10',
                'order' => 6
            ],

            //Treino Perna Lis
            [
                'user_id' => 1,
                'workout_division_id' => 8,
                'method_id' => 2,
                'exercise_id' => 33,
                'series' => 3,
                'repetitions' => '10',
                'order' => 1
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 8,
                'method_id' => 2,
                'exercise_id' => 34,
                'series' => 3,
                'repetitions' => '10',
                'order' => 2
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 8,
                'method_id' => 2,
                'exercise_id' => 36,
                'series' => 3,
                'repetitions' => 'Até a falha',
                'order' => 3
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 8,
                'method_id' => 2,
                'exercise_id' => 37,
                'series' => 3,
                'repetitions' => '10',
                'order' => 4
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 8,
                'method_id' => 2,
                'exercise_id' => 30,
                'series' => 3,
                'repetitions' => '10',
                'order' => 5
            ],
            [
                'user_id' => 1,
                'workout_division_id' => 8,
                'method_id' => 2,
                'exercise_id' => 35,
                'series' => 3,
                'repetitions' => '10',
                'order' => 6
            ],

        ];

        foreach ($workourDivisionExercises as $workourDivisionExercise)
            WorkoutDivisionExercise::create($workourDivisionExercise);
    
    }
}
