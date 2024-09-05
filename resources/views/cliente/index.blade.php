<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <title>77sol</title>
</head>

<body>

<div>
    <div>
        <h2>Lista de Clientes</h2>
        <br>
        @csrf
        <table border="1">
            <tr>
                <td>Nome</td>
                <td>Email</td>
                <td>Telefone</td>
                <td>CPF/CNPJ</td>
                <td>Ações</td>
            </tr>
            @forelse ($clientes as $cliente)
                <tr>
                    <td>
                        {{ $cliente->nome }}
                    </td>
                    <td>
                        {{ $cliente->email }}
                    </td>
                    <td>
                        {{ $cliente->telefone }}
                    </td>
                    <td>
                        {{ $cliente->cpf_cnpj }}
                    </td>
                    <td>
                        <a href="#" onclick="editarCliente({{ $cliente->id }})">Editar</a>
                        <br>
                        <a href="#" onclick="excluirCliente({{ $cliente->id }})">Excluir</a>
                    </td>
                </tr>
            @empty
                <p>Não existem clientes cadastrados</p>
            @endforelse
        </table>
    </div>
    <br>
    <button id="btnNovoCliente">Cadastrar Cliente</button>
</div>
<script src="{{ asset('js/jquery.js') }}"></script>

<script src="{{ asset('js/clientes/listagem_clientes.js') }}"></script>
</body>

</html>
