<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <a href="/"><button>Voltar</button></a>
    <form action="{{ route('register_company')}}" method="POST">
        @csrf
        <label for="">Nome da empresa:</label> <br>
        <input type="text" name="title"> <br>
        <label for="">Receita Anual:</label> <br>
        <input type="text" name="revenue"> <br>
        <label for="">Telefone:</label> <br>
        <input type="text" name="phone[0]"> <br>
        <label for="">Telefone 2:</label> <br>
        <input type="text" name="phone[1]"> <br>
        <!--<label for="">Telefone:</label> <br>
        <input type="text" name="phone3"> <br>-->
        <button type="button">Adicionar telefone</button> <br>
        <label for="">E-mail:</label> <br>
        <input type="email" name="email[0]"> <br>
        <button type="button">Adicionar e-mail</button> <br>
        <label for="">Nome do Contato 1:</label> <br>
        <input type="text" name="contact_name[0]"> <br>
        <label for="">Sobrenome do Contato 1:</label> <br>
        <input type="text" name="contact_lastname[0]"> <br>
        <label for="">Nome do Contato 2:</label> <br>
        <input type="text" name="contact_name[1]"> <br>
        <label for="">Sobrenome do Contato 2:</label> <br>
        <input type="text" name="contact_lastname[1]"> <br>
        <!--<label for="">E-mail:</label> <br>
        <input type="email" name="email2"> <br>
        <label for="">E-mail:</label> <br>
        <input type="email" name="email3"> <br>-->
        <button type="button">Adicionar Contato</button><br> 
        <button type="submit">Criar</button>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>