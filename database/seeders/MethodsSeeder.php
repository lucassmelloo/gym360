<?php

namespace Database\Seeders;

use App\Models\Method;
use Illuminate\Database\Seeder;

class MethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = [
            [
                'name' => 'Simples',
                'description' => 'Executa um único exercício, com séries e repetições definidas, ideal para iniciantes ou foco em técnica.',
            ],
            [
                'name' => 'Bi-set',
                'description' => 'Dois exercícios intercalados, com ou sem descanso, que trabalham o mesmo grupo muscular ou músculos opostos.',
            ],
            [
                'name' => 'Tri-set',
                'description' => 'Três exercícios realizados consecutivamente, sem descanso, para aumentar a intensidade e estímulo muscular.',
            ],
            [
                'name' => 'Circuito',
                'description' => 'Uma sequência de vários exercícios realizados com pouco ou nenhum descanso, focado em condicionamento físico geral.',
            ],
            [
                'name' => 'Rest-pause',
                'description' => 'Método onde se trabalha até a falha muscular, seguido por uma pausa curta e repetição do esforço.',
            ],
        ];

        foreach ($methods as $method) {
            Method::create($method);
        }
    }
}
