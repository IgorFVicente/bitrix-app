<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <input type="text" name="phone1"> <br>
        <label for="">Telefone 2:</label> <br>
        <input type="text" name="phone2"> <br>
        <!--<label for="">Telefone:</label> <br>
        <input type="text" name="phone3"> <br>
        <button type="button">Adicionar telefone</button><br>-->
        <label for="">E-mail:</label> <br>
        <input type="email" name="email1"> <br>
        <!--<label for="">E-mail:</label> <br>
        <input type="email" name="email2"> <br>
        <label for="">E-mail:</label> <br>
        <input type="email" name="email3"> <br>
        <button type="button">Adicionar e-mail</button><br>
        <button type="button">Criar novo Contato</button><br>
        <button type="button">Atrelar Contato existente</button><br> -->
        <button type="submit">Criar</button>
</body>
</html>