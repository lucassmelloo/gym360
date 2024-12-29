<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treino - {{ data_get($workout, 'title', 'Sem título') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <style>
        @page{
            margin: 0px 25px;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #ffffff;
        }

        .container {
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 10px;
        }

        h1, h2 {
            text-align: center;
            color: #007BFF;
        }


        .section h3 {
            color: #444;
            border-bottom: 2px solid #007BFF;
        }

        h4 {
            color: #007BFF;
            font-size: 14px;
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 4px;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: #fff;
        }

        th, td {
            word-wrap: break-word;
            overflow: hidden;
            text-overflow: ellipse;
        }

        th:nth-child(1), td:nth-child(1) {
            width: 40;
        }

        th:nth-child(2), td:nth-child(2) {
            width: 20;
        }

        th:nth-child(3), td:nth-child(3) {
            width: 15
        }

        th:nth-child(4), td:nth-child(4) {
            width: 20
        }

        th:nth-child(5), td:nth-child(5) {
            width: 5
        }

        tr {
            font-size: 12px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .workout-details {
            font-size: 14px;
        }

        .workout-details span {
            font-weight: bold;
        }

        .workout-details p {
            
            display: inline-block;
            margin-right: 20px;
        }

        

    </style>
</head>
<body class="bg-white text-gray-900">
    <div class="container mx-auto p-6 bg-white shadow-lg">
        <h2 class="text-2xl text-blue-500 text-center mb-6">Aluno: {{ data_get($workout, 'student.name', 'Sem aluno associado') }}</h2>

        <div class="">
            <div class="workout-details flex justify-between">
                <p><span>Data de Início:</span> 
                    {{ \Carbon\Carbon::parse(data_get($workout, 'start_date'))->format('d/m/Y') }}
                </p>
                <p><span>Data de Validade:</span> 
                    {{ \Carbon\Carbon::parse(data_get($workout, 'due_date'))->format('d/m/Y') }}
                </p>
                <p><span>Idade:</span> 
                    {{ data_get($workout, 'student.date_of_birth.age') }}
                </p>
            </div>
            <div class="workout-details flex justify-between">
                <p><span class="font-bold">Tipo de Treino: </span>{{ data_get($workout, 'workout_type.name', 'Sem tipo de treino') }}</p>
                <p><span class="font-bold">Professor: </span>{{ data_get($workout, 'user.name') }}</p>
            </div>
            <div class="workout-details">
                <p><span class="font-bold">Observações do Aluno: </span></p>
                <p class="break-words">
                    {!! data_get($workout, 'student.observation', 'Sem observação') !!}
                </p>
            </div>        
        </div>

        <div class="space-y-4">
            @foreach (data_get($workout, 'workout_divisions') as $division)
                <h4 class="text-blue-500 text-lg">{{ data_get($division, 'title', 'Sem título') }}</h4>
                <table class="w-full border-collapse">
                    <thead>
                        <tr>
                            <th class="border p-2 bg-blue-500 text-white">Exercício</th>
                            <th class="border p-2 bg-blue-500 text-white">Método</th>
                            <th class="border p-2 bg-blue-500 text-white">Séries</th>
                            <th class="border p-2 bg-blue-500 text-white">Repetições</th>
                            <th class="border p-2 bg-blue-500 text-white">Carga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (data_get($division, 'workout_division_exercises', []) as $exercise)
                            <tr class="border-t">
                                <td class="p-2">{{ data_get($exercise, 'exercise.name', 'Sem exercício') }}</td>
                                <td class="p-2">{{ data_get($exercise, 'method.name', 'Simples') }}</td>
                                <td class="p-2">{{ data_get($exercise, 'series') }}</td>
                                <td class="p-2">{{ data_get($exercise, 'repetitions', '') }}</td>
                                <td class="p-2">    </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
        </div>
    </div>
</body>

</html>
