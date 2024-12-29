<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipientEmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recipient_emails = [
            'all_students' => 'Todos os Estudantes',
            'active_students' => 'Todos os Estudantes Inativos',
            'inactive_students' => 'Todos os Estudantes Ativos',

            'all_users' => 'Todos os Usuários',
            'active_users' => 'Todos os Usuários Ativos',
            'inactive_users' => 'Todos os Usuários Inativos',

            'all_students_and_users' => 'Todos os Usuários e Estudantes',
            'active_students_and_users' => 'Todos os Usuários e Estudantes Inativos',
            'inactive_students_and_users' => 'Todos os Usuários e Estudantes Inativos',

            'none' => 'Nenhum',
        ];

        foreach ($recipient_emails as $name => $description) {
            \App\Models\RecipientEmail::create([
                'name' => $name,
                'description' => $description,
            ]);
        }
    }
}
