@extends('agrocefa::layouts.master')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Página de Desarrolladores</title>
    <style>
        /* Estilos CSS en línea */
        body {
            font-family: Arial, sans-serif;
            background-color: #eff3ec;
            margin: 0;
            padding: 0;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            background-color: #f9fbfa;
            padding: 20px;
            border: 1px solid #fdfffe;
        }

        header {
            text-align: center;
            color: #18bd1b;
            padding: 20px 0;
        }
    </style>
</head>
<body>
    <header>
        <h2>Bienvenido a la sección de Desarrolladores</h2>
    </header>   
    
    <main>
        <h3>Contenido para Desarrolladores</h3>
        <p></p>
    </main>
</body>
</html>

@endsection
