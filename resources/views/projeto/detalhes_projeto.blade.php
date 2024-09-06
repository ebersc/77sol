<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>77sol</title>
</head>

<body>
    <h3>Detalhes do projeto</h3>
    <br>
    <table>
        <tr>
            <td>Cliente:</td>
            <td>{{ $dados['projeto']->nome }}</td>
        </tr>
        <tr>
            <td>Local de instalação:</td>
            <td>{{ $dados['projeto']->sigla }}</td>
        </tr>
        <tr>
            <td>Tipo de instalação:</td>
            <td>{{ $dados['projeto']->tipo }}</td>
        </tr>
        <tr>
            <td>Equipamentos:</td>
            <td>
                @forelse($dados['equipamento'] as $equipamento)
                    @if($equipamento->quantidade > 0)
                        <ul>
                            <li>{{ $equipamento->quantidade }}x {{ $equipamento->nome_equipamento }}</li>
                        </ul>
                    @endif
                @empty
                    Não foi encontrado equipamento cadastrado para esse projeto.
                @endforelse
            </td>
        </tr>
    </table>
    <button onclick="editarProjeto({{ $dados['projeto']->id }})" type="button">Editar projeto</button>
    <script src="{{ asset('js/jquery.js') }}"></script>

    <script src="{{ asset('js/projeto/projetos.js') }}"></script>
</body>

</html>
