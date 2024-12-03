<?php

namespace App\Filament\Widgets;

use App\Models\Attendance;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Widgets\Widget;

class AttendanceSearchWidget extends Widget implements HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public ?array $data = [
        'student_id'=> null,
        'user_id'=> null
    ];

    protected static string $view = 'filament.widgets.attendance-search-widget';

    protected function form(Form $form) : Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->label('Marcar Presença')
                    ->searchable()
                    ->preload()
                    ->options(fn() => Student::all()->pluck('name','id'))
                    ->required(),

                Forms\Components\Hidden::make('user_id')
                    ->default(auth()->user()->id)
            ])
            ->statePath('data');
    } 

    public function mount(): void
    {        
        $this->form->fill();
    }

}
