<?php

namespace Database\Seeders;

use App\Models\Exercise;
use Illuminate\Database\Seeder;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exercises = [
            ['name' => 'Supino Reto'],
            ['name' => 'Supino Inclinado'],
            ['name' => 'Supino Articulado'],
            ['name' => 'Cross-over'],
            ['name' => 'Crucifixo'],
            ['name' => 'Flexão'],

            ['name' => 'Triceps Barra'],
            ['name' => 'Triceps Testa'],
            ['name' => 'Triceps Corda'],
            ['name' => 'Triceps Banco'],
            ['name' => 'Triceps Francêsa'],

            ['name' => 'Puxada Aberta'],
            ['name' => 'Puxada Fechada'],
            ['name' => 'Remada Curvada'],
            ['name' => 'Remada Cavalinho'],
            ['name' => 'Remada Unilateral'],
            ['name' => 'Voador Invertido'],
            ['name' => 'Barra Fixa'],
            ['name' => 'Remada Baixa'],

            ['name' => 'Rosca Alternada'],
            ['name' => 'Rosca 21'],
            ['name' => 'Rosca Scott'],
            ['name' => 'Rosca Martelo'],
            ['name' => 'Rosca Concentrada'],
            ['name' => 'Rosca Inclinada'],
            ['name' => 'Rosca Barra'],
            ['name' => 'Rosca Barra Invertida'],

            ['name' => 'Elevação Pelvica'],
            ['name' => 'Agachamento Terra'],
            ['name' => 'Agachamento Bulgaro'],
            ['name' => 'Agachamento Sumo'],
            ['name' => 'Legpress Horizontal'],
            ['name' => 'Legpress 45'],
            ['name' => 'Avanço'],
            ['name' => 'Passada'],
            ['name' => 'Cadeira Extensora'],
            ['name' => 'Cadeira Flexora'],
            ['name' => 'Mesa Flexora'],
            ['name' => 'Caidera Adutora'],
            ['name' => 'Caidera Abdutora'],
            ['name' => 'Stiff'],

            ['name' => 'Abdominal Infra'],
            ['name' => 'Prancha'],
            ['name' => 'Abdominal'],
            ['name' => 'Abdominal Remador'],
            ['name' => 'Abdominal Boxeador'],
            ['name' => 'Abdominal Canivete'],

            ['name' => 'Esteira'],
            ['name' => 'Corda'],
            ['name' => 'Step'],
            ['name' => 'Escada'],
            ['name' => 'Bike'],
            ['name' => 'Elíptico'],

        ];

        foreach ($exercises as $exercise) {
            Exercise::create($exercise);
        }
    }
}
