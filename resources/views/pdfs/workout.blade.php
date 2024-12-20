<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treino - {{ data_get($workout, 'title', 'Sem título') }}</title>
    <style>
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
            padding: 20px; /* Padding geral da caixa */
        }

        h1, h2 {
            text-align: center;
            color: #007BFF;
            margin-top: 5px; /* Ajuste para reduzir o espaço superior */
            margin-bottom: 15px; /* Ajuste de margem para h1 e h2 */
        }

        .section {
            margin-bottom: 10px;
        }

        .section h3 {
            color: #444;
            border-bottom: 2px solid #007BFF;
        }

        /* Estilização simples para o nome da divisão */
        h4 {
            color: #007BFF;
            font-size: 14px; /* Fonte menor para o nome da divisão */
            margin-bottom: 5px; /* Menor espaçamento abaixo do título */
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

        /* Ajustando a largura das colunas */
        th, td {
            word-wrap: break-word; /* Quebrar palavras longas */
            overflow: hidden;
            text-overflow: ellipsis; /* Corta o texto que ultrapassar */
        }

        th:nth-child(1), td:nth-child(1) {
            width: 40%; /* Exercício */
        }

        th:nth-child(2), td:nth-child(2) {
            width: 20%; /* Método */
        }

        th:nth-child(3), td:nth-child(3) {
            width: 15%; /* Séries */
        }

        th:nth-child(4), td:nth-child(4) {
            width: 25%; /* Repetições */
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

        /* Ajuste para colocar as datas na mesma linha */
        .workout-details p {
            
            display: inline-block;
            margin-right: 20px;
            margin-bottom: 8px; /* Ajusta o espaçamento entre as informações */
        }

        /* Adicionando mais controle nas margens */
        .section p {
            margin: 5px 0; /* Margem reduzida entre as seções */
        }

    </style>
</head>
<body class="bg-white text-gray-900">
    <div class="container mx-auto p-6 bg-white shadow-lg">
        <h2 class="text-2xl text-blue-500 text-center mb-6">Aluno: {{ data_get($workout, 'student.name', 'Sem aluno associado') }}</h2>

        <div class="space-y-4">
            <div class="workout-details flex justify-between">
                <p><span>Data de Início:</span> 
                    {{ \Carbon\Carbon::parse(data_get($workout, 'start_date'))->format('d/m/Y') }}
                </p>
                <p><span>Data de Validade:</span> 
                    {{ \Carbon\Carbon::parse(data_get($workout, 'due_date'))->format('d/m/Y') }}
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (data_get($division, 'workout_division_exercises', []) as $exercise)
                            <tr class="border-t">
                                <td class="p-2">{{ data_get($exercise, 'exercise.name', 'Sem exercício') }}</td>
                                <td class="p-2">{{ data_get($exercise, 'method.name', 'Simples') }}</td>
                                <td class="p-2">{{ data_get($exercise, 'series') }}</td>
                                <td class="p-2">{{ data_get($exercise, 'repetitions', '') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
        </div>
    </div>
</body>

</html>
