<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use App\Models\WorkoutType;
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
            WorkoutSeeder::class
        ]);
    }
}
