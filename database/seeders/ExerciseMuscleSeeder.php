<?php

namespace Database\Seeders;

use App\Models\Exercise;
use App\Models\Muscle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExerciseMuscleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
        $relations = [
            // Peito
            'Supino Reto' => ['Peito', 'Tríceps', 'Ombro'],
            'Supino Inclinado' => ['Peito', 'Tríceps', 'Ombro'],
            'Supino Articulado' => ['Peito', 'Tríceps', 'Ombro'],
            'Cross-over' => ['Peito'],
            'Crucifixo' => ['Peito'],
            'Flexão' => ['Peito', 'Tríceps', 'Ombro'],

            // Tríceps
            'Triceps Barra' => ['Tríceps'],
            'Triceps Testa' => ['Tríceps'],
            'Triceps Corda' => ['Tríceps'],
            'Triceps Banco' => ['Tríceps'],
            'Triceps Francêsa' => ['Tríceps'],

            // Costas
            'Puxada Aberta' => ['Costas', 'Bíceps'],
            'Puxada Fechada' => ['Costas', 'Bíceps'],
            'Remada Curvada' => ['Costas', 'Bíceps'],
            'Remada Cavalinho' => ['Costas', 'Bíceps'],
            'Remada Unilateral' => ['Costas', 'Bíceps'],
            'Voador Invertido' => ['Costas', 'Ombro'],
            'Barra Fixa' => ['Costas', 'Bíceps'],
            'Remada Baixa' => ['Costas', 'Bíceps'],

            // Bíceps
            'Rosca Alternada' => ['Bíceps'],
            'Rosca 21' => ['Bíceps'],
            'Rosca Scott' => ['Bíceps'],
            'Rosca Martelo' => ['Bíceps', 'Antebraço'],
            'Rosca Concentrada' => ['Bíceps'],
            'Rosca Inclinada' => ['Bíceps'],
            'Rosca Barra' => ['Bíceps'],
            'Rosca Barra Invertida' => ['Bíceps', 'Antebraço'],

            // Pernas
            'Elevação Pelvica' => ['Glúteos','Perna'],
            'Agachamento Terra' => ['Perna','Quadríceps', 'Posterior da Coxa', 'Glúteos'],
            'Agachamento Bulgaro' => ['Perna','Quadríceps', 'Glúteos'],
            'Agachamento Sumo' => ['Perna','Quadríceps', 'Glúteos'],
            'Legpress Horizontal' => ['Perna','Quadríceps', 'Glúteos'],
            'Legpress 45' => ['Perna','Quadríceps', 'Glúteos'],
            'Avanço' => ['Perna','Quadríceps', 'Glúteos'],
            'Passada' => ['Perna','Quadríceps', 'Glúteos'],
            'Cadeira Extensora' => ['Perna','Quadríceps'],
            'Cadeira Flexora' => ['Perna','Posterior da Coxa'],
            'Mesa Flexora' => ['Perna','Posterior da Coxa'],
            'Caidera Adutora' => ['Perna','Glúteos'],
            'Caidera Abdutora' => ['Perna','Glúteos'],
            'Stiff' => ['Perna','Posterior da Coxa', 'Glúteos'],

            // Abdômen
            'Abdominal Infra' => ['Abdômen'],
            'Prancha' => ['Abdômen'],
            'Abdominal' => ['Abdômen'],
            'Abdominal Remador' => ['Abdômen'],
            'Abdominal Boxeador' => ['Abdômen'],
            'Abdominal Canivete' => ['Abdômen'],

            // Aeróbicos
            'Esteira' => ['Cardiovascular'],
            'Corda' => ['Cardiovascular'],
            'Step' => ['Cardiovascular'],
            'Escada' => ['Cardiovascular'],
            'Bike' => ['Cardiovascular'],
            'Elíptico' => ['Cardiovascular'],
        ];

        foreach ($relations as $exerciseName => $muscles) {
            $exercise = Exercise::where('name', $exerciseName)->first();

            if ($exercise) {
                $muscleIds = Muscle::whereIn('name', $muscles)->pluck('id');
                $exercise->muscles()->sync($muscleIds);
            }
        }
    
    }
}
