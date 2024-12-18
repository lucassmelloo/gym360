<?php

namespace App\Filament\Resources\WorkoutResource\Pages;

use App\Filament\Resources\WorkoutResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditWorkout extends EditRecord
{
    protected static string $resource = WorkoutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('tornarPrincipal')
                ->label('Tornar esse treino principal')
                ->color('success') // Botão verde
                ->icon('heroicon-o-check-circle') // Ícone de sucesso
                ->requiresConfirmation('Tem certeza que deseja tornar esse treino o principal?')
                ->action(function () {
                    $record = $this->record; // Pega o registro atual (Workout)

                    // Verifica se o treino tem um estudante associado
                    if ($record->student) {
                        $record->student->update([
                            'workout_id' => $record->id, // Define o workout atual como principal
                        ]);

                        // Notificação de sucesso
                        Notification::make()
                            ->title('Treino atualizado com sucesso!')
                            ->body("O treino '{$record->title}' agora é o principal para o estudante {$record->student->name}.")
                            ->success()
                            ->send();
                    } else {
                        // Notificação de erro se não houver estudante associado
                        Notification::make()
                            ->title('Erro!')
                            ->body('Não é possível tornar este treino principal, pois ele não está associado a nenhum estudante.')
                            ->danger()
                            ->send();
                    }
                }),
        ];
    }
}
