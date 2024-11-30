<?php

namespace App\Filament\Widgets;

use App\Models\AttendanceList;
use App\Models\Student;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class AttendanceSearchWidget extends Widget
{
    protected static string $view = 'filament.widgets.attendance-search-widget';

    public $search = ''; // Texto digitado no campo de busca
    public $students = []; // Lista de alunos encontrados
    public $selectedStudent = null; // Aluno selecionado

    // Este método é chamado toda vez que a busca é atualizada
    public function updatedSearch()
    {
        // Filtra os alunos conforme o nome que contém o texto digitado
        $this->students = Student::where('name', 'like', '%' . $this->search . '%')
            ->limit(10) // Limita a 10 resultados
            ->get();
        
    }

    public function selectStudent($studentId)
    {
        // Quando o aluno é selecionado
        $this->selectedStudent = Student::find($studentId);
        $this->search = $this->selectedStudent->name;
        $this->students = []; // Limpa os resultados da busca
    }

    public function markPresence()
    {
        if (!$this->selectedStudent) {
            $this->notify('danger', 'Por favor, selecione um aluno antes de marcar a presença.');
            return;
        }

        // Verifica se a presença já foi registrada para o aluno no dia de hoje
        $alreadyMarked = AttendanceList::where('student_id', $this->selectedStudent->id)
            ->whereDate('attendance_date', now()->toDateString())
            ->exists();

        if ($alreadyMarked) {
            $this->notify('warning', "A presença de {$this->selectedStudent->name} já foi registrada hoje.");
        } else {
            // Cria a entrada na lista de presença
            AttendanceList::create([
                'user_id' => Auth::id(),
                'student_id' => $this->selectedStudent->id,
                'attendance_date' => now()->toDateString(),
            ]);

            $this->notify('success', "Presença de {$this->selectedStudent->name} registrada com sucesso!");
        }

        $this->resetWidget();
    }

    private function resetWidget()
    {
        $this->search = '';
        $this->students = [];
        $this->selectedStudent = null;
    }
}
