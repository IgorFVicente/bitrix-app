<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="/"><button>Voltar</button></a>
    <form action="{{ route('register_contact')}}" method="POST">
        @csrf
        <label for="">Nome:</label> <br>
        <input type="text" name="name"> <br>
        <label for="">Sobrenome:</label> <br>
        <input type="text" name="last_name"> <br>
        <label for="">Telefone:</label> <br>
        <input type="text" name="phone1"> <br>
        <label for="">Telefone:</label> <br>
        <input type="text" name="phone2"> <br>
        <label for="">Telefone:</label> <br>
        <input type="text" name="phone3"> <br>
        <button type="button">Adicionar telefone</button><br>
        <label for="">E-mail:</label> <br>
        <input type="email" name="email1"> <br>
        <label for="">E-mail:</label> <br>
        <input type="email" name="email2"> <br>
        <label for="">E-mail:</label> <br>
        <input type="email" name="email3"> <br>
        <button type="button">Adicionar e-mail</button><br>
        <button type="button">Criar nova Empresa</button><br>
        <button type="button">Atrelar Empresa existente</button><br>
        <button>Criar</button>
</body>
</html>