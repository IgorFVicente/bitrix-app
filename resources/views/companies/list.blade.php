<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>
<body>
    
    <a href="/companies/new"><button>Novo Registro</button></a>
    <table>
        <tr>
            <th>ID</th>
            <th>Empresa</th>
            <th>Receita Anual</th>
            <th>Contatos</th>
            <th>Telefones</th>
            <th>E-mails</th>
        </tr>
    <?php 
        foreach ($companies as $company) {
            $id         = $company->ID;
            $title      = $company->TITLE;
            $revenue    = $company->REVENUE;
            $phones     = unserialize($company->PHONE);
            $emails     = unserialize($company->EMAIL);
        ?>  
        
        <tr>
            <td><?php echo $id ?></td>
            <td><?php echo $title ?></td>
            <td><?php echo $revenue ?></td>
            <td>Contato</td>
            <td><?php
                foreach ($phones as $phone) {
                //retirar o if quando o número de telefones passados para a tabela for dinâmico
                    if ($phone != ''){
                        echo($phone . "<br>");
                    }
                }?>
            </td>
            <td><?php
                foreach ($emails as $email) {
                //retirar o if quando o número de telefones passados para a tabela for dinâmico
                    if ($email != ''){
                        echo($email . "<br>");
                    }
                }?>
            </td>
            <td><a href="/companies/edit/<?php echo $id?>"><button>Editar</button></td>
            <td><a href="/companies/delete/<?php echo $id?>"><button>Excluir</button></td>
        </tr>
        
    <?php } ?>
    </table>

</body>
</html>