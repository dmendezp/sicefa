<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SICEFA</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swaphttps://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    
    @include('layouts/partials/head')


</head>
<body class="antialiased">

    {{-- @include('layouts/partials/PntCarg') --}}
        
    @include('layouts/partials/header')

    @include('layouts/partials/hero')

<main id="main">

    @include('layouts/partials/clients')


    @include('layouts/partials/ptoventa')
    
    @include('layouts/partials/modules')

    

    <!--include('layouts/partials/skins')--->
    
    @include('layouts/partials/cefa')

    @include('layouts/partials/senaempresa')

    @include('layouts/partials/About-Us')

    

    {{-- @include('layouts/partials/team') --}}

    {{-- @include('layouts/partials/pricing') --}}

   {{-- @include('layouts/partials/Frequently-Asked-Questions') --}}

    @include('layouts/partials/contact')

</main>

    @include('layouts/partials/footer')

    @include('layouts/partials/scripts')


    </body>
</html>