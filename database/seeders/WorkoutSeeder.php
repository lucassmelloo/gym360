<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Workout;
use App\Models\WorkoutType;

class WorkoutSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('email', 'lucasmellovieira99@gmail.com')->first();

        $workoutTypes = WorkoutType::all();

        $workouts = [
            // Treinos de Hipertrofia
            [
                'title' => 'Treino de Hipertrofia Avançado',
                'user_id' => 1,
                'workout_type_id' => 1,
                'public' => 1,
                'observation' => '<p><strong>Observação:</strong> Indicado para atletas avançados. Inclui exercícios compostos com alta intensidade.</p>
                                  <ul>
                                      <li><strong>Duração:</strong> 60-90 minutos</li>
                                      <li><strong>Frequência:</strong> 5 vezes por semana</li>
                                  </ul>'
            ],
            [
                'title' => 'Treino de Hipertrofia para Iniciantes',
                'user_id' => 2,
                'workout_type_id' => 1,
                'public' => 1,
                'observation' => '<p><strong>Observação:</strong> Ideal para iniciantes, com foco em exercícios básicos como agachamento e supino.</p>
                                  <ul>
                                      <li><strong>Duração:</strong> 45-60 minutos</li>
                                      <li><strong>Frequência:</strong> 3 vezes por semana</li>
                                  </ul>'
            ],
            [
                'title' => 'Treino de Hipertrofia com Foco em Pernas',
                'user_id' => 3,
                'workout_type_id' => 1,
                'public' => 1,
                'observation' => '<p><strong>Observação:</strong> Enfatiza exercícios como agachamento, leg press e avanço para fortalecer membros inferiores.</p>
                                  <ul>
                                      <li><strong>Duração:</strong> 60 minutos</li>
                                      <li><strong>Frequência:</strong> 4 vezes por semana</li>
                                  </ul>'
            ],
            [
                'title' => 'Treino de Hipertrofia Feminino',
                'user_id' => 4,
                'workout_type_id' => 1,
                'public' => 1,
                'observation' => '<p><strong>Observação:</strong> Focado em fortalecimento de glúteos e coxas, com exercícios como levantamento terra e glute bridge.</p>
                                  <ul>
                                      <li><strong>Duração:</strong> 50-60 minutos</li>
                                      <li><strong>Frequência:</strong> 4 vezes por semana</li>
                                  </ul>'
            ],
            [
                'title' => 'Treino de Hipertrofia com Peso Corporal',
                'user_id' => 5,
                'workout_type_id' => 1,
                'public' => 1,
                'observation' => '<p><strong>Observação:</strong> Não requer equipamentos, ideal para casa. Inclui flexões, barras e agachamentos.</p>
                                  <ul>
                                      <li><strong>Duração:</strong> 45 minutos</li>
                                      <li><strong>Frequência:</strong> 4 vezes por semana</li>
                                  </ul>'
            ],
        
            // Treinos de Resistência
            [
                'title' => 'Treino de Resistência Funcional',
                'user_id' => 6,
                'workout_type_id' => 2,
                'public' => 1,
                'observation' => '<p><strong>Observação:</strong> Trabalha movimentos funcionais e resistência muscular.</p>
                                  <ul>
                                      <li><strong>Duração:</strong> 40-60 minutos</li>
                                      <li><strong>Frequência:</strong> 3 vezes por semana</li>
                                  </ul>'
            ],
            [
                'title' => 'Treino de Resistência para Corredores',
                'user_id' => 7,
                'workout_type_id' => 2,
                'public' => 1,
                'observation' => '<p><strong>Observação:</strong> Indicado para corredores, inclui pliometria e exercícios de fortalecimento de pernas.</p>
                                  <ul>
                                      <li><strong>Duração:</strong> 50 minutos</li>
                                      <li><strong>Frequência:</strong> 3-4 vezes por semana</li>
                                  </ul>'
            ],
            [
                'title' => 'Resistência Cardiorrespiratória',
                'user_id' => 8,
                'workout_type_id' => 2,
                'public' => 1,
                'observation' => '<p><strong>Observação:</strong> Inclui circuitos aeróbicos e corrida moderada.</p>
                                  <ul>
                                      <li><strong>Duração:</strong> 30-40 minutos</li>
                                      <li><strong>Frequência:</strong> 4 vezes por semana</li>
                                  </ul>'
            ],
            [
                'title' => 'Resistência com Treinamento Intervalado',
                'user_id' => 1,
                'workout_type_id' => 2,
                'public' => 1,
                'observation' => '<p><strong>Observação:</strong> Intercala alta intensidade e descanso ativo.</p>
                                  <ul>
                                      <li><strong>Duração:</strong> 20-30 minutos</li>
                                      <li><strong>Frequência:</strong> 3 vezes por semana</li>
                                  </ul>'
            ],
        
            // Treinos de Força
            [
                'title' => 'Treino de Força com Levantamento Olímpico',
                'user_id' => 2,
                'workout_type_id' => 3,
                'public' => 1,
                'observation' => '<p><strong>Observação:</strong> Inclui clean and jerk, snatch e outros movimentos avançados.</p>
                                  <ul>
                                      <li><strong>Duração:</strong> 60 minutos</li>
                                      <li><strong>Frequência:</strong> 4 vezes por semana</li>
                                  </ul>'
            ],
            [
                'title' => 'Força para Iniciantes',
                'user_id' => 3,
                'workout_type_id' => 3,
                'public' => 1,
                'observation' => '<p><strong>Observação:</strong> Ideal para iniciantes, com exercícios básicos e baixa carga.</p>
                                  <ul>
                                      <li><strong>Duração:</strong> 45 minutos</li>
                                      <li><strong>Frequência:</strong> 3 vezes por semana</li>
                                  </ul>'
            ],
        
            // Treinos de Perda de Peso
            [
                'title' => 'Plano de Perda de Peso para Iniciantes',
                'user_id' => 4,
                'workout_type_id' => 4,
                'public' => 1,
                'observation' => '<p><strong>Observação:</strong> Inclui caminhadas e exercícios leves para estimular a queima de gordura.</p>
                                  <ul>
                                      <li><strong>Duração:</strong> 30 minutos</li>
                                      <li><strong>Frequência:</strong> 5 vezes por semana</li>
                                  </ul>'
            ],
            [
                'title' => 'Perda de Peso com HIIT',
                'user_id' => 5,
                'workout_type_id' => 4,
                'public' => 1,
                'observation' => '<p><strong>Observação:</strong> Treino intervalado de alta intensidade, ideal para acelerar o metabolismo.</p>
                                  <ul>
                                      <li><strong>Duração:</strong> 20-30 minutos</li>
                                      <li><strong>Frequência:</strong> 3 vezes por semana</li>
                                  </ul>'
            ],
        
        ];
        
        

        foreach ($workouts as $workout) {
            Workout::create($workout);
        }
    }
}
