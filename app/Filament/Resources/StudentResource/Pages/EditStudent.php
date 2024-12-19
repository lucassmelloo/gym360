<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Arr;

class EditStudent extends EditRecord
{
    protected static string $resource = StudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('imprimirTreino')
                ->label('Imprimir treino')
                ->color('info')
                ->icon('phosphor-printer-light')
                ->url(fn () => route('workouts.imprimir', $this->record->workout_id)) // Chama a rota
                ->openUrlInNewTab(),
            Actions\Action::make('editarTreino')
                ->label('Editar Treino')
                ->color('primary') // Botão azul
                ->icon('heroicon-o-rectangle-stack') // Ícone de edição
                ->url(fn () => route('filament.admin.resources.workouts.edit', $this->record->workout_id)) // Ajuste para a rota correta
                
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Verifica se o Student tem um principal_workout
        if ($this->record->principal_workout) {
            // Carrega o workout com seus relacionamentos
            $principalWorkout = $this->record->principal_workout->load('workout_divisions.workout_division_exercises');

            // Adiciona os dados ao formulário
            $data['principal_workout'] = $principalWorkout->toArray();
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (isset($data['principal_workout'])) {
            $workoutData = $data['principal_workout'];

            // Atualiza ou cria o workout
            $principalWorkout = $this->record->principal_workout()->updateOrCreate(
                ['id' => $this->record->principal_workout->id ?? null],
                Arr::except($workoutData, ['workout_divisions'])
            );

            // Atualiza as divisões do workout
            if (isset($workoutData['workout_divisions'])) {
                foreach ($workoutData['workout_divisions'] as $divisionData) {
                    $division = $principalWorkout->workout_divisions()->updateOrCreate(
                        ['id' => $divisionData['id'] ?? null],
                        Arr::except($divisionData, ['workout_division_exercises'])
                    );

                    // Atualiza os exercícios dentro da divisão
                    if (isset($divisionData['workout_division_exercises'])) {
                        foreach ($divisionData['workout_division_exercises'] as $exerciseData) {
                            $division->workout_division_exercises()->updateOrCreate(
                                ['id' => $exerciseData['id'] ?? null],
                                $exerciseData
                            );
                        }
                    }
                }
            }

            unset($data['principal_workout']);
        }

        return $data;
    }
}
