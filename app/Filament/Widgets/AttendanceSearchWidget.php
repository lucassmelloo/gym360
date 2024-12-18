<?php

namespace App\Filament\Widgets;

use App\Models\Attendance;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Panel\Concerns\HasNotifications;
use Filament\Widgets\Widget;
use Illuminate\Database\QueryException;

class AttendanceSearchWidget extends Widget implements HasForms
{
    use Forms\Concerns\InteractsWithForms;
    use HasNotifications;

    public ?array $data = ['student_id' => null, 'user_id' => null, 'attendance_date' => null];

    protected static string $view = 'filament.widgets.attendance-search-widget';

    protected function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('attendance_date')
                    ->default(now()->toDateString()),
                Forms\Components\Hidden::make('user_id')
                    ->default(auth()->user()->id),

                Forms\Components\Select::make('student_id')
                    ->label('Marcar Presença')
                    ->searchable()
                    ->preload()
                    ->options(fn () => Student::missingOnDate()->pluck('name', 'id'))
                    ->exists(table: Student::class)
                    ->suffixAction(
                        Forms\Components\Actions\Action::make('submit')
                            ->icon('heroicon-o-check')
                            ->action('saveAttendance')
                            ->dispatch('attendanceCreated')
                    ),
            ])
            ->statePath('data')
            ->model(Attendance::class);
    }

    public function saveAttendance(): null
    {

        try {

            $data = $this->data;

            $attendance = Attendance::create([
                'user_id' => $data['user_id'],
                'student_id' => $data['student_id'],
                'attendance_date' => $data['attendance_date'],
            ]);

            $birthdayMessage = $attendance->student->daysUntilBirthday();

            Notification::make()
                ->title('Presença marcada com Sucesso')
                ->success()
                ->seconds(5)
                ->send();

            if ($birthdayMessage) {
                Notification::make()
                    ->title($birthdayMessage)
                    ->info()
                    ->seconds(5)
                    ->send();
            }

            $this->form->fill();

        } catch (QueryException $err) {
            if ($err->getCode() === '23000' && $data['student_id'] === null) {
                Notification::make()
                    ->title('Aluno não encontrado.')
                    ->danger()
                    ->seconds(5)
                    ->send();
            }

            if ($err->getCode() === '23000' && $data['student_id'] == ! null) {
                Notification::make()
                    ->title('Presença já registrada hoje.')
                    ->danger()
                    ->seconds(5)
                    ->send();
            }

        }

        return null;

    }

    public function mount(): void
    {
        $this->form->fill();
    }

    public function getColumnSpan(): int|string|array
    {
        return [
            'sm' => 12,
            'md' => 12,
            'lg' => 12,
        ];
    }
}
