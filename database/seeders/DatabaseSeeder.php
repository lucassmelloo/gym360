<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            StudentSeeder::class,
            AdminSeeder::class,
            ExerciseSeeder::class,
            MuscleSeeder::class,
            ExerciseMuscleSeeder::class,
            WorkoutTypeSeeder::class,
            WorkoutSeeder::class,
            MethodsSeeder::class,
            WorkoutDivisionSeeder::class,
            WorkoutDivisionExerciseSeeder::class,
        ]);
    }
}
