<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>77sol</title>
</head>

<body>
    <div>
        <h2>Tipos de instalação</h2>
        <br>
        <ul>
        @foreach ($tipo_instalacao as $tipo)
            <li>
                {{$tipo->tipo}}
            </li>
        @endforeach
        </ul>
        <button type="button" onclick="location.href = '/';">Voltar</button>
    </div>
</body>

</html>
