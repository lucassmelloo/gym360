<x-filament-widgets::widget>
    <x-filament::section>
        <div class="w-full p-6 bg-white shadow rounded-lg">
            <h2 class="text-lg font-semibold text-gray-800">Marcar Presença</h2>
            <p class="mt-1 text-sm text-gray-500">Pesquise o nome do aluno para registrar sua presença com a data atual.</p>
        
            <form wire:submit.prevent="markPresence" class="mt-4">
                <!-- Dropdown de Pesquisa com Autocomplete -->
                <div class="relative">
                    <input 
                        type="text" 
                        wire:model="search"
                        class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Digite o nome do aluno"
                        autocomplete="off"
                    >
        
                    @if (!empty($search) && $students->isNotEmpty())
                        <ul class="absolute z-10 w-full bg-white border border-gray-300 rounded-lg shadow mt-1 max-h-48 overflow-y-auto">
                            @foreach ($students as $student)
                                <li wire:click="selectStudent({{ $student->id }})" class="px-4 py-2 cursor-pointer hover:bg-gray-100 text-sm text-gray-700">
                                    {{ $student->name }}
                                </li>
                            @endforeach
                        </ul>
                    @elseif (!empty($search))
                        <p class="mt-2 text-sm text-red-500">Nenhum aluno encontrado.</p>
                    @endif
                </div>
        
                @if ($selectedStudent)
                    <div class="mt-4 p-4 bg-green-100 text-green-800 rounded-lg">
                        <p>Aluno Selecionado: <strong>{{ $selectedStudent->name }}</strong></p>
                        <button type="submit" class="mt-2 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                            Confirmar Presença
                        </button>
                    </div>
                @endif
            </form>
        </div>        
    </x-filament::section>
</x-filament-widgets::widget>
