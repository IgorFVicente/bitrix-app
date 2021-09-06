<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    <div id="app">
        <?php
            /* Preparar os dados para passar para o Vue */
            $fixedCompanies = array();
            $lastCompanyID = null;
            for ($i = 0; $i < count($companies); $i++) {
                /* Caso haja mais de um contato, a query traz a empresa repetidas vezes para cada um
                *  o if / else verifica se a iteração é na mesma empresa que a anterior
                *  se for, apenas adiciona o novo contato a uma array de contatos, ao invés
                *  de adicionar todos os dados da empresa novamente.
                */
                if ($companies[$i] -> COMPANY_ID != $lastCompanyID){
                    $contactsArray = array();
                    $company['COMPANY_ID'] = $companies[$i]->COMPANY_ID;
                    $company['TITLE'] = $companies[$i]->TITLE;
                    $company['PHONE'] = unserialize($companies[$i]->PHONE);
                    $company['EMAIL'] = unserialize($companies[$i]->EMAIL);
                    $company['REVENUE'] = $companies[$i]->REVENUE;
                    $contact['NAME'] = $companies[$i]->NAME;
                    $contact['LAST_NAME'] = $companies[$i]->LAST_NAME;
                    array_push($contactsArray, $contact);
                    $company['CONTACTS'] = $contactsArray;
                    $lastCompanyID = $companies[$i]->COMPANY_ID;
                    array_push($fixedCompanies, $company);
                } else {
                    $contact['NAME'] = $companies[$i]->NAME;
                    $contact['LAST_NAME'] = $companies[$i]->LAST_NAME;
                    array_push($fixedCompanies[count($fixedCompanies)-1]['CONTACTS'], $contact);   
                }
            }
        ?>
        <list-companies :companies="{{ json_encode($fixedCompanies) }}"></list-companies>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>