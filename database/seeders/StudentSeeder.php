<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            [
                'name'=>'Lucas de Mello Vieira',
                'email'=> 'lucasmellovieira99@gmail.com',
                'telephone'=>'71 994090421',
                'observation'=> 'Fisiculturista',
                'date_of_birth'=> '1999-04-21'
            ],
        ];

        foreach($students as $student)
            Student::create($student);
    }
}
