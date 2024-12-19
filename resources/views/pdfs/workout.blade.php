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
<body>

    <div class="container">
        <h2>Aluno: {{ data_get($workout, 'student.name', 'Sem aluno associado') }}</h2>

        <div class="section workout-details">
            <p><span>Data de Início:</span> 
                {{ \Carbon\Carbon::parse(data_get($workout, 'start_date'))->format('d/m/Y') }}
            </p>
            <p><span>Data de Validade:</span> 
                {{ \Carbon\Carbon::parse(data_get($workout, 'due_date'))->format('d/m/Y') }}
            </p>
            
        </div>
        <div class="section workout-details">
            <p><span>Tipo de Treino: </span>{{ data_get($workout, 'workout_type.name', 'Sem tipo de treino') }}</p>
            <p><span>Professor: </span>{{ data_get($workout, 'user.name') }}</p>
        </div>
        <p><span>Observação do Aluno:</span></p>
        <p>
            {!! $workout->student->observation !!}
        </p>
        
        <div class="section">
            @foreach (data_get($workout, 'workout_divisions') as $division)
            <h4>Divisão: {{ data_get($division, 'title', 'Sem título') }}</h4>
            <table>
                <tr>
                    <th>Exercício</th>
                    <th>Método</th>
                    <th>Séries</th>
                    <th>Repetições</th>
                </tr>
                <thead>
                </thead>
                <tbody>
                    @foreach (data_get($division, 'workout_division_exercises', []) as $exercise)
                    <tr>
                        <td>
                            <strong>{{ data_get($exercise, 'exercise.name', 'Sem exercício') }}</strong><br>
                        </td>
                        <td>
                            <strong>{{ data_get($exercise, 'method.name', 'Simples') }}</strong><br>
                        </td>
                        <td>
                            <strong>{{ data_get($exercise, 'series') }}</strong><br>
                        </td>
                        <td>
                            <strong>{{ data_get($exercise, 'repetitions', '') }}</strong><br>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endforeach
        </div>
    </div>

</body>
</html>
