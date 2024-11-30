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
        User::updateOrCreate(
            ['email' => 'lucasmellovieira99@gmail.com'], // Garante que o admin não será duplicado
            [
                'name' => 'Lucas de Mello',
                'email' => 'lucasmellovieira99@gmail.com',
                'password' => bcrypt('lucasbr98')
            ]
        );
    }
}
