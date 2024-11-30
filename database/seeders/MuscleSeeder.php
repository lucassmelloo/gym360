<?php

namespace Database\Seeders;

use App\Models\Muscle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MuscleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $muscles = [
            ['name'=>'Trapézio'],
            ['name'=>'Ombro'],
            ['name'=>'Bíceps'],
            ['name'=>'Tríceps'],
            ['name'=>'Antebraço'],
            ['name'=>'Peito'],
            ['name'=>'Costas'],
            ['name'=>'Abdômen'],
            ['name'=>'Quadríceps'],
            ['name'=>'Posterior da Coxa'],
            ['name'=>'Glúteos'],
            ['name'=>'Panturrilha'],
            ['name'=>'Cardiovascular'],
            ['name'=>'Perna']
        ];



        foreach($muscles as $muscle)
            Muscle::create($muscle);
    }
}
