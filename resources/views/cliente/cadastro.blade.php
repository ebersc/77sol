<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <title>77sol</title>
</head>

<body>

<div>
    <div>
        <h2>Cadastro de Clientes</h2>
        <br>
        <form name="form_clientes" id="form_clientes">

            @csrf

            <input type="hidden" name="id" id="id" value="{{ $cliente->id ?? null}}">

            <div>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" autocomplete="off" value="{{ $cliente->nome ?? null }}"/>
            </div>
            <div>
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" autocomplete="off" value="{{ $cliente->email ?? null }}"/>
            </div>
            <div>
                <label for="telefone">Telefone:</label>
                <input type="text" name="telefone" id="telefone" autocomplete="off" value="{{ $cliente->telefone ?? null }}"/>
            </div>
            <div>
                <label for="cpf_cnpj">CPF/CNPJ:</label>
                <input type="text" name="cpf_cnpj" id="cpf_cnpj" maxlength="17" autocomplete="off" value="{{ $cliente->cpf_cnpj ?? null }}"/>
            </div>
        </form>
        <button type="button" id="btnSalvar">Salvar</button>
        &nbsp;
        <button type="button" onclick="history.go(-1)">Voltar</button>
    </div>
</div>

<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/jquery.mask.js') }}"></script>
<script src="{{ asset('js/clientes/clientes.js')}}"></script>
</body>
</html>
