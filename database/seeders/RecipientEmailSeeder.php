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
            'all_users' => 'Todos os Usuários',
            'all_students_and_users' => 'Todos os Usuários e Estudantes',
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
