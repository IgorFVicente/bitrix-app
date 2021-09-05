<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <a href="/companies/new"><button>Novo Registro</button></a>
    <table>
        <tr>
            <th>ID</th>
            <th>Empresa</th>
            <th>Receita Anual</th>
            <th>Telefones</th>
            <th>E-mails</th>
            <th>Contatos</th>
        </tr>
    <?php
        $i = 0;
        while ($i < count($companies)) {
            $id         = $companies[$i]->COMPANY_ID;
            $title      = $companies[$i]->TITLE;
            $revenue    = $companies[$i]->REVENUE;
            $phones     = unserialize($companies[$i]->PHONE);
            $emails     = unserialize($companies[$i]->EMAIL);
        ?>
        <tr>
            <td><?php echo $id ?></td>
            <td><?php echo $title ?></td>
            <td><?php echo $revenue ?></td>
            <td><?php
                if ($phones != null) {
                    foreach ($phones as $phone) {
                            echo($phone . "<br>");
                    }
                }?>
            </td>
            <td><?php
                if ($emails != null) {
                    foreach ($emails as $email) {
                        echo($email . "<br>");
                    }
                }
                ?>
            </td>
            <td><?php

                /** verifica se a próxima empresa da lista é a mesma que a atual,
                * se for a mesma, passa para a tela apenas o novo contato e pula
                * a próxima empresa da lista
                */
                
                for ($j = $i; $j < count($companies); $j++){
                    if ($companies[$j]->COMPANY_ID == $id){
                        echo $companies[$j]->NAME . ' ' . $companies[$j]->LAST_NAME;
                        ?> <br>
                        <?php
                        $i++;
                    }
                }
            ?>
            <td><a href="/companies/edit/<?php echo $id?>"><button>Editar</button></td>
            <td><a href="/companies/delete/<?php echo $id?>"><button>Excluir</button></td>
        </tr>
        <?php }?>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>