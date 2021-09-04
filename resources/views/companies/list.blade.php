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
    <?php 
        foreach ($companies as $company) {
            $id         = $company->ID;
            $title      = $company->TITLE;
        ?>


        <li> <?php echo $id ?> | <?php echo $title; ?> <button>Editar</button><button>Excluir</button></li>
        
    <?php } ?>


</body>
</html>