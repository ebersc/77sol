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
            <form action="" method="post">
                <fieldset>
                    @csrf
                    <legend>Filtros</legend>
                    <label for="name">Cliente: </label>
                    <select name="cliente_id" id="nome">
                        <option value=""></option>
                        @foreach ($dados['clientes'] as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                        @endforeach
                    </select>
                    <div>
                        <label for="local">Localização:</label>
                        <select name="local_id" id="local">
                            <option value=""></option>
                            @foreach ($dados['locais'] as $local)
                                <option value="{{ $local->id }}">{{ $local->sigla }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="tipo_instalacao">Tipo de instalação:</label>
                        <select name="tipo_instalacao_id" id="tipo_instalacao">
                            <option value=""></option>
                            @foreach ($dados['tipo_instalacao'] as $tipo_instalacao)
                                <option value="{{ $tipo_instalacao->id }}">{{ $tipo_instalacao->tipo }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit">Filtrar</button>
                </fieldset>
            </form>
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
        <button id="btnNovoProjeto" onclick="location.href = '/projeto/cadastrar'">Cadastrar novo projeto</button>
        &nbsp;
        <button type="button" onclick="location.href = '/';">Voltar</button>
    </div>
    <script src="{{ asset('js/jquery.js') }}"></script>

    <script src="{{ asset('js/projeto/listagem_projetos.js') }}"></script>
</body>

</html>
