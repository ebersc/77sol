<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>77sol</title>
</head>

<body>
    <div>
        <div>
            <h2>Projetos</h2>
            <br>
            @csrf
            <table border="1">
                <tr>
                    <td>Código do Projeto</td>
                    <td>Cliente</td>
                    <td>Local</td>
                    <td>Tipo de instalação</td>
                    <td>Ações</td>
                </tr>
                @forelse ($projetos as $projeto)
                    <tr>
                        <td>
                            {{ $projeto->id }}
                        </td>
                        <td>
                            {{ $projeto->nome }}
                        </td>
                        <td>
                            {{ $projeto->sigla }}
                        </td>
                        <td>
                            {{ $projeto->tipo }}
                        </td>
                        <td>
                            <a href="#" onclick="verProjeto({-{ $projeto->id }})">Ver detalhes</a>
                            <br>
                            <a href="#" onclick="editarProjeto({-{ $projeto->id }})">Editar</a>
                            <br>
                            <a href="#" onclick="excluirProjeto({-{ $projeto->id }})">Excluir</a>
                        </td>
                    </tr>
                @empty
                    <p>Não existem projetos cadastrados</p>
                @endforelse
            </table>
        </div>
        <br>
        <button id="btnNovoProjeto">Cadastrar novo projeto</button>
    </div>
    <script src="{{ asset('js/jquery.js') }}"></script>

    <script src="{{ asset('js/projeto/listagem_projetos.js') }}"></script>
</body>

</html>
