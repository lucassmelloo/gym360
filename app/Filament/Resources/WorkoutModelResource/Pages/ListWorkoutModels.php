<?php

namespace App\Filament\Resources\WorkoutModelResource\Pages;

use App\Filament\Resources\WorkoutModelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWorkoutModels extends ListRecords
{
    protected static string $resource = WorkoutModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
