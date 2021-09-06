<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    <?php
        for ($i = 0; $i < count($company); $i++) {
            if ($i == 0){
                $contactsArray = array();
                $fixedCompany['COMPANY_ID'] = $company[$i]->COMPANY_ID;
                $fixedCompany['TITLE'] = $company[$i]->TITLE;
                $fixedCompany['PHONE'] = unserialize($company[$i]->PHONE);
                $fixedCompany['EMAIL'] = unserialize($company[$i]->EMAIL);
                $fixedCompany['REVENUE'] = $company[$i]->REVENUE;
                $contact['ID'] = $company[$i]->ID;
                $contact['NAME'] = $company[$i]->NAME;
                $contact['LAST_NAME'] = $company[$i]->LAST_NAME;
                array_push($contactsArray, $contact);
                $fixedCompany['CONTACTS'] = $contactsArray;
            } else {
                $contact['ID'] = $company[$i]->ID;
                $contact['NAME'] = $company[$i]->NAME;
                $contact['LAST_NAME'] = $company[$i]->LAST_NAME;
                array_push($fixedCompany['CONTACTS'], $contact);   
            }
        }
    ?>
    <div id="app">
        <edit-company-form form-route={{ route('update_company', ['ID' => $company[0]->COMPANY_ID])}} :company="{{ json_encode($fixedCompany) }}"></edit-company-form>
    </div>
    
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>