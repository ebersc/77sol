<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <title>77sol - Cadastro</title>
</head>

<body>
    <div>
        <div>
            <h2>Cadastro de Clientes</h2>
            <br>
            <form name="form_clientes" id="form_clientes">

                @csrf

                <div>
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" autocomplete="off"/>
                </div>
                <div>
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" id="email" autocomplete="off"/>
                </div>
                <div>
                    <label for="telefone">Telefone:</label>
                    <input type="text" name="telefone" id="telefone" autocomplete="off"/>
                </div>
                <div>
                    <label for="cpf_cnpj">CPF/CNPJ:</label>
                    <input type="text" name="cpf_cnpj" id="cpf_cnpj" maxlength="17" autocomplete="off"/>
                </div>
            </form>
            <button type="button" id="btnSalvar">Cadastrar Cliente</button>
        </div>
    </div>
</body>

<script src="{{ asset('js/clientes/validacao_documentos.js')}}"></script>
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/jquery.mask.js') }}"></script>
<script src="{{ asset('js/clientes/clientes.js')}}"></script>
</html>
