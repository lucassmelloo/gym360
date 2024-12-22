<?php

namespace Database\Seeders;

use App\Models\Attendance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $students = [
            1 => ['min' => 4, 'max' => 6], // Student 1: 4-6 presenças por semana
            2 => ['min' => 3, 'max' => 5], // Student 2: 3-5 presenças por semana
            3 => ['min' => 1, 'max' => 3], // Student 3: 1-3 presenças por semana
        ];

        $startDate = Carbon::now()->subYear(); // 1 ano atrás
        $endDate = Carbon::now(); // Data atual

        $data = [];

        foreach ($students as $studentId => $attendanceRange) {
            $currentDate = $startDate->copy();

            while ($currentDate <= $endDate) {
                // Determina aleatoriamente quantos dias na semana o aluno estará presente
                $attendanceDays = rand($attendanceRange['min'], $attendanceRange['max']);
                $usedDates = [];

                for ($i = 0; $i < $attendanceDays; $i++) {
                    do {
                        // Escolhe um dia aleatório dentro da semana atual
                        $randomDay = $currentDate->copy()->startOfWeek()->addDays(rand(0, 6));
                    } while (in_array($randomDay->toDateString(), $usedDates) || $randomDay->gt($endDate));

                    $usedDates[] = $randomDay->toDateString();

                    $data[] = [
                        'user_id' => rand(1, 3), // Simula o user_id
                        'student_id' => $studentId,
                        'attendance_date' => $randomDay->toDateString(),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                // Avança para a próxima semana
                $currentDate->addWeek();
            }
        }

        DB::table('attendances')->insert($data);
    }
}
