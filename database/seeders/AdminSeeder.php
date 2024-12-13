<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'name' => 'Lucas de Mello Vieira',
                'email' => 'lucasmellovieira99@gmail.com',
                'password' => bcrypt('lucasbr98')
            ],
            [
                'name' => 'Lisandra Watanabe Ono',
                'email' => 'lisandra@vidaativa.com',
                'password' => bcrypt('secret')
            ],
            [
                'name' => 'Ferrugem',
                'email' => 'ferrugem@vidaativa.com',
                'password' => bcrypt('secret')
            ],
            [
                'name' => 'Milena',
                'email' => 'milena@vidaativa.com',
                'password' => bcrypt('secret')
            ],
            [
                'name' => 'Camila',
                'email' => 'camila@vidaativa.com',
                'password' => bcrypt('secret')
            ],
            [
                'name' => 'Kaique',
                'email' => 'kaique@vidaativa.com',
                'password' => bcrypt('secret')
            ],
            [
                'name' => 'Felipe Gallo',
                'email' => 'galllo@vidaativa.com',
                'password' => bcrypt('secret')
            ],
            [
                'name' => 'Tamara',
                'email' => 'tamara@vidaativa.com',
                'password' => bcrypt('secret')
            ],
        ];

        foreach ($admins as $admin) {
            User::updateOrCreate(
                ['email' => $admin['email']], // Garante que não seja duplicado
                $admin
            );
        }
    }
}
