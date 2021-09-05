<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="/"><button>Voltar</button></a>
    <form action="{{ route('update_company', ['ID' => $company->ID])}}" method="POST"-->
        @csrf
        <label for="">Nome da empresa:</label> <br>
        <input type="text" name="title" value="<?php echo($company->TITLE)?>"> <br>
        <label for="">Receita Anual:</label> <br>
        <input type="text" name="revenue" value="<?php echo($company->REVENUE)?>"> <br>
        <?php
        $phoneCount = 1;
        foreach (unserialize($company->PHONE) as $phone){
            echo('<label for="">Telefone ' . $phoneCount . ':</label> <br>');
            echo('<input type="text" name="phone' . $phoneCount . '" value="' . $phone . '"> <br>');
            $phoneCount ++;
        }
        
        $emailCount = 1;
        foreach (unserialize($company->EMAIL) as $email){
            echo('<label for="">Email ' . $emailCount . ':</label> <br>');
            echo('<input type="text" name="email' . $emailCount . '" value="' . $email . '"> <br>');
            $emailCount ++;
        }
        ?>
        <button type="submit">Salvar</button>
</body>
</html>