@extends('agrocefa::layouts.master')

@section('content')
    <title>Agregar Cultivo</title>
    <link rel="stylesheet" type="text/css" href="{{asset('agrocefa/css/crop.css')}}">
</head>
<body>
    <h1>Agregar Cultivo</h1>

    <form method="POST" action="">
        @csrf
        <label for="name">Nombre:</label>
        <input type="text" name="name" required>
        <!-- Agrega los demás campos aquí -->

        <button type="submit" class="button">Guardar</button>
    </form>
</body>
@endsection
