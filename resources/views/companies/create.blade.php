<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <div id="app">
        <create-company-form form-route={{ route('register_company')}}></create-company-form>
    </div>
    
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>