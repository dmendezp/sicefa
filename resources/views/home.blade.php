<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SICEFA</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    
    @include('layouts/partials/head')


</head>
<body class="antialiased">
        
    @include('layouts/partials/HeaderDesing')

<main id="main">

<br>
    
    @include('layouts/partials/modules')

    
</main>

    @include('layouts/partials/footer')

    @include('layouts/partials/scripts')


    </body>
</html>