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
            [
                'name'=>'Jonatas Braz',
                'email'=> 'jonatasbsmcarvalho@hotmail.com',
                'telephone'=>'75 983082626',
                'observation'=> 'Aspirante a Iron Man',
                'date_of_birth'=> '2002-05-20'
            ],
            [
                'name'=>'Lisandra Watanabe Ono',
                'email'=> 'lisandra@vidaativa.com',
                'telephone'=>'71 991631122',
                'observation'=> 'Come bolo todo dia',
                'date_of_birth'=> '2002-12-20'
            ],
            [
                'name'=>'Ferrugem',
                'email'=> 'ferrugem@vidaativa.com',
                'telephone'=>'75 983082626',
                'observation'=> 'Cantor com rotina corrida, vem pouco, uma vez ou outra devido a rotina de Shows',
                'date_of_birth'=> '2002-12-15'
            ],
            [
                'name'=>'Milena',
                'email'=> 'milena@vidaativa.com',
                'telephone'=>'75 983082626',
                'observation'=> 'Coronel Alemã, barra pesada',
                'date_of_birth'=> '2002-12-25'
            ],
            [
                'name'=>'Camila',
                'email'=> 'camila@vidaativa.com',
                'telephone'=>'75 983082626',
                'observation'=> 'Abandonou o aluno Lucas para trabalhar de manhã',
                'date_of_birth'=> '2002-12-30'
            ],
            [
                'name'=>'Kaique',
                'email'=> 'kaique@vidaativa.com',
                'telephone'=>'75 983082626',
                'observation'=> 'Abandonou o aluno Lucas para trabalhar de manhã',
                'date_of_birth'=> '2002-01-05'
            ],
            [
                'name'=>'Felipe Gallo',
                'email'=> 'galllo@vidaativa.com',
                'telephone'=>'75 983082626',
                'observation'=> 'The boss',
                'date_of_birth'=> '2002-01-10'
            ],
            [
                'name'=>'Tamara',
                'email'=> 'tamara@vidaativa.com',
                'telephone'=>'75 983082626',
                'observation'=> 'Sumida desde 2000',
                'date_of_birth'=> '2002-01-15'
            ]
        ];

        foreach($students as $student)
            Student::create($student);
    }
}
