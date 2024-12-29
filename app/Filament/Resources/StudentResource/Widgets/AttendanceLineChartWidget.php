<?php

namespace App\Filament\Resources\StudentResource\Widgets;

use App\Models\Attendance;
use Carbon\Carbon;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class AttendanceLineChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Presenças por Mês';

    protected static ?string $maxHeight = '200px';

    protected static ?array $options = [
        'scales' => [
                    'y' => [
                        'suggestedMax' => 31,
                        'suggestedMin' => 0,
                    ],
                ],
    ];
    // Parâmetro opcional para filtrar por aluno
    public ?int $studentId = null;

    protected function getData(): array
    {
        Carbon::setLocale('pt_BR');

        // Query para presenças
        $query = Attendance::query();

        // Se $studentId estiver definido, filtra pelo aluno
        if ($this->studentId) {
            $query->where('student_id', $this->studentId);
        }
        $data = Trend::query($query)
            ->dateColumn('attendance_date')
            ->between(
                start: now()->subDays(365),
                end: now(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => $this->studentId
                        ? 'Presenças do Aluno durante o mês'
                        : 'Presenças de Todos os Alunos durante o mês',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate)->toArray(),
                    'backgroundColor' => '#FFFFFF',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => ucfirst(Carbon::parse($value->date)->translatedFormat('M y')))->toArray(),
        ];
    }

    public function getColumnSpan(): int|string|array
    {
        return [
            'sm' => 12,
            'md' => 12,
            'lg' => 12,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array|RawJs|null
    {
        if ($this->studentId) {
            return
            [
                'scales' => [
                    'y' => [
                        'suggestedMax' => 31,
                        'suggestedMin' => 0,
                    ],
                ],
            ];
        }

        return null;
    }   
}
