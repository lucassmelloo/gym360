<?php

namespace App\Filament\Resources\StudentResource\Widgets;

use App\Models\Attendance;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class AttendanceLineChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData($student_id = null): array
    {
        $data = Trend::model(Attendance::class)
            ->dateColumn('attendance_date')
            ->between(
                start: now()->subDays(365),
                end: now(),
            )
            ->perMonth('lucas')
            ->count();
    
        return [
            'datasets' => [
                [
                    'label' => 'Presença do Aluno durante o Ano',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate)->toArray(),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => Carbon::parse($value->date)->format('F Y'))->toArray(),
        ];
    }
    
    public function getColumnSpan(): int|string|array
    {
        return [
            'sm' => 10,
            'md' => 10,
            'lg' => 10,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
