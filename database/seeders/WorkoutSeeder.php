<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Workout;
use App\Models\WorkoutType;
use Carbon\Carbon;

class WorkoutSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('email', 'lucasmellovieira99@gmail.com')->first();

        $workoutTypes = WorkoutType::all();

        $workouts = [
            [
                'user_id' => 4,
                'student_id' => 2,
                'workout_type_id' => 1,
                'public' => 1,
                'start_date' => Carbon::now()->format('Y-m-d'), 
                'due_date' => Carbon::now()->addDays(60)->format('Y-m-d')
            ],
            [
                'user_id' => 6,
                'student_id' => 1,
                'workout_type_id' => 1,
                'public' => 1,
                'start_date' => Carbon::now()->format('Y-m-d'), 
                'due_date' => Carbon::now()->addDays(60)->format('Y-m-d')
            ],
            [
                'user_id' => 3,
                'student_id' => 3,
                'workout_type_id' => 1,
                'public' => 1,'start_date' => Carbon::now()->format('Y-m-d'), 
                'due_date' => Carbon::now()->addDays(60)->format('Y-m-d')
            ],
        
        ];
        
        

        foreach ($workouts as $workout) {
            Workout::create($workout);
        }
    }
}
