<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>77sol</title>
</head>

<body>
    <h2>Projeto</h2>
    <br>
    <div>
        <div>
            <br>
            <form name="form_projetos" id="form_projetos">

                @csrf
                <input type="hidden" name="id" id="id" value="{{ $dados['projeto']->id ?? null}}">

                <div>
                    <label for="nome">Cliente:</label>
                    <select name="cliente_id" id="nome">
                        @foreach ($dados['clientes'] as $cliente)
                            @if ($cliente->id == $dados['projeto']->cliente_id)
                                <option value="{{ $cliente->id }}" selected>{{ $cliente->nome }}</option>
                            @else
                                <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="local">Localização:</label>
                    <select name="local_id" id="local">
                        @foreach ($dados['locais'] as $local)
                            @if ($local->id == $dados['projeto']->local_id)
                                <<option value="{{ $local->id }}" selected>{{ $local->sigla }}</option>
                            @else
                                <option value="{{ $local->id }}">{{ $local->sigla }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="tipo_instalacao">Tipo de instalação:</label>
                    <select name="tipo_instalacao_id" id="tipo_instalacao">
                        @foreach ($dados['tipo_instalacao'] as $tipo_instalacao)
                            @if ($tipo_instalacao->id == $dados['projeto']->tipo_instalacao_id)
                                <option value="{{ $tipo_instalacao->id }}" selected>{{ $tipo_instalacao->tipo }}</option>
                            @else
                                <option value="{{ $tipo_instalacao->id }}">{{ $tipo_instalacao->tipo }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <br>
                <div>
                    <table border="1">
                        <tr>
                            <td>Equipamento</td>
                            <td>Quantidade</td>
                        </tr>

                        @foreach ($dados['equipamento'] as $equipamento)

                            <tr>
                                <td>{{ $equipamento->nome_equipamento }}</td>
                                <td><input type="number" class="input_qtde" min="0" name="equipamento[{{ $equipamento->id }}]" value="{{ $equipamento->quantidade }}"></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </form>
            <button type="button" id="btnSalvar">Salvar</button>
            &nbsp;
            <button type="button" onclick="history.go(-1)">Voltar</button>
        </div>
    </div>
    <script src="{{ asset('js/jquery.js') }}"></script>

    <script src="{{ asset('js/projeto/projetos.js') }}"></script>
</body>

</html>
