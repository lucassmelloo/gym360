<?php

namespace App\Filament\Resources\WorkoutModelResource\Pages;

use App\Filament\Resources\WorkoutModelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWorkoutModel extends EditRecord
{
    protected static string $resource = WorkoutModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
