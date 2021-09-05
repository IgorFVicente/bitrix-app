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
    <form action="{{ route('update_company', ['ID' => $company[0]->COMPANY_ID])}}" method="POST"-->
        @csrf
        <label for="">Nome da empresa:</label> <br>
        <input type="text" name="title" value="<?php echo($company[0]->TITLE)?>"> <br>
        <label for="">Receita Anual:</label> <br>
        <input type="text" name="revenue" value="<?php echo($company[0]->REVENUE)?>"> <br>
        <?php

        $phoneCount = 0;
        if($company[0]->PHONE != null)
        {    
            foreach (unserialize($company[0]->PHONE) as $phone){
                $phoneFormCount = $phoneCount + 1;
                echo('<label for="">Telefone ' . $phoneFormCount . ':</label> <br>');
                echo('<input type="text" name="phone[' . $phoneCount . ']" value="' . $phone . '"> <br>');
                $phoneCount ++;
            }
        } else {
            $phoneFormCount = $phoneCount + 1;
            echo('<label for="">Telefone ' . $phoneFormCount . ':</label> <br>');
            echo('<input type="text" name="phone[' . $phoneCount . ']" value=""> <br>');
            $phoneCount ++;
        }

        $emailCount = 0;
        if($company[0]->EMAIL != null)
        {
            foreach (unserialize($company[0]->EMAIL) as $email){
                $emailFormCount = $emailCount + 1;
                echo('<label for="">Email ' . $emailFormCount . ':</label> <br>');
                echo('<input type="text" name="email[' . $emailCount . ']" value="' . $email . '"> <br>');
                $emailCount ++;
            }
        } else {
            $emailFormCount = $emailCount + 1;
            echo('<label for="">Email ' . $emailFormCount . ':</label> <br>');
            echo('<input type="text" name="email[' . $emailCount . ']" value=""> <br>');
            $emailCount ++;
        }

        $contactCount = 0;
        foreach ($company as $companyItem){
            if ($companyItem->ID != null) {
                $contactFormCount = $contactCount + 1;
                echo('<input type="text" name= "contact_id[' . $contactCount .']" value ="' 
                    . $companyItem->ID . '" style="display:none;">' );
                echo('<label for="">Nome do Contato ' . $contactFormCount . ':</label> <br>');
                echo('<input type="text" name="contact_name[' . $contactCount 
                    . ']" value="' . $companyItem->NAME . '"> <br>');
                echo('<label for="">Sobrenome do Contato ' . $contactFormCount . ':</label> <br>');
                echo('<input type="text" name="contact_lastname[' . $contactCount 
                    . ']" value="' . $companyItem->LAST_NAME . '"> <br>');
                $contactCount ++;
            } else {
                $contactFormCount = $contactCount + 1;
                echo('<input type="text" name= "contact_id[' . $contactCount .']" value ="0" style="display:none;">' );
                echo('<label for="">Nome do Contato ' . $contactFormCount . ':</label> <br>');
                echo('<input type="text" name="contact_name[' . $contactCount 
                    . ']" value=""> <br>');
                echo('<label for="">Sobrenome do Contato ' . $contactFormCount . ':</label> <br>');
                echo('<input type="text" name="contact_lastname[' . $contactCount 
                    . ']" value=""> <br>');
                $contactCount ++;
            }
        }
        ?>
        <button type="submit">Salvar</button>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>