<?php

namespace App\Filament\Resources\AttendanceResource\Pages;

use App\Filament\Resources\AttendanceResource;
use App\Filament\Widgets\AttendanceSearchWidget;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAttendances extends ManageRecords
{
    protected static string $resource = AttendanceResource::class;

    protected $listeners = ['attendanceTableUpdated' => 'refreshTable'];

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            AttendanceSearchWidget::class,
        ];
    }

    public function refreshTable(): void
    {
        $this->fillTable();
    }
}
