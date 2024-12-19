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
                'name' => 'Lucas de Mello Vieira',
                'email' => 'lucasmellovieira99@gmail.com',
                'telephone' => '71 994090421',
                'observation' => '<strong>Fisiculturista</strong><br>Treinando para competições profissionais.',
                'date_of_birth' => '1999-04-21',
            ],
            [
                'name' => 'Jonatas Braz',
                'email' => 'jonatasbsmcarvalho@hotmail.com',
                'telephone' => '75 983082626',
                'observation' => '<em>Aspirante a Iron Man</em><br>Admirador de super-heróis e atleta de resistência.',
                'date_of_birth' => '2002-05-20',
            ],
            [
                'name' => 'Lisandra Watanabe Ono',
                'email' => 'lisandra@vidaativa.com',
                'telephone' => '71 991631122',
                'observation' => '<u>Come bolo todo dia</u><br>Adora doces e se considera uma especialista em bolos.',
                'date_of_birth' => '2002-12-20',
            ],
        ];
        

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}
