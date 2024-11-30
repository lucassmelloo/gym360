<?php

namespace Database\Seeders;

use App\Models\WorkoutType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkoutTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workoutTypes = [
            ['name'=>'Hipertrofia'],
            ['name'=>'Resistência'],
            ['name'=>'Força'],
            ['name'=>'Perda de peso'],
        ];

        foreach($workoutTypes as $workoutType)
            WorkoutType::create($workoutType);
    }
}
