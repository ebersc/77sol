<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>77sol</title>
</head>

<body>
    <div>
        <h2>Equipamentos</h2>
        <br>
        <ul>
        @foreach ($equipamentos as $equipamento)
            <li>
                {{$equipamento->nome_equipamento}}
            </li>
        @endforeach
        </ul>
        <button type="button" onclick="location.href = '/'">Voltar</button>
    </div>
</body>

</html>
