<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use App\Filament\Resources\StudentResource\Widgets\AttendanceLineChartWidget;
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
                ->url(fn () => $this->record->workout_id ? route('workouts.imprimir', $this->record->workout_id) : '#') 
                ->openUrlInNewTab()
                ->visible(fn () => !empty($this->record->workout_id)),

            Actions\Action::make('editarTreino')
                ->label('Editar Treino')
                ->color('primary')
                ->icon('heroicon-o-rectangle-stack')
                ->url(fn () => $this->record->workout_id ? route('filament.admin.resources.workouts.edit', $this->record->workout_id) : '#')
                ->visible(fn () => !empty($this->record->workout_id)),
                
            Actions\Action::make('criarTreino')
                ->label('Criar Treino')
                ->color('primary')
                ->icon('heroicon-o-rectangle-stack')
                ->url(fn () => route('filament.admin.resources.workouts.create'))
                ->visible(fn () => empty($this->record->workout_id)),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if ($this->record->principal_workout) {
            $principalWorkout = $this->record->principal_workout->load('workout_divisions.workout_division_exercises');
            $data['principal_workout'] = $principalWorkout->toArray();
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (isset($data['principal_workout'])) {
            $workoutData = $data['principal_workout'];

            $principalWorkout = $this->record->principal_workout()->updateOrCreate(
                ['id' => $this->record->principal_workout->id ?? null],
                Arr::except($workoutData, ['workout_divisions'])
            );

            if (isset($workoutData['workout_divisions'])) {
                foreach ($workoutData['workout_divisions'] as $divisionData) {
                    $division = $principalWorkout->workout_divisions()->updateOrCreate(
                        ['id' => $divisionData['id'] ?? null],
                        Arr::except($divisionData, ['workout_division_exercises'])
                    );

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

    protected function getHeaderWidgets(): array
    {
        return [
            AttendanceLineChartWidget::make([
                'studentId' => $this->record->id,
            ]),
        ];
    }
}
