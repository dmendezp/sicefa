@extends('agrocefa::layouts.master')

@section('content')
    <title>Editar Cultivo</title>
    <link rel="stylesheet" type="text/css" href="{{asset('agrocefa/css/crop.css')}}">
</head>
<body>
    <h1>Editar Cultivo</h1>

    <form method="POST" action="">
        @csrf
        @method('PUT')
        <label for="name">Nombre:</label>
        <input type="text" name="name" value="" required>
        <!-- Agrega los demás campos aquí -->

        <button type="submit" class="button">Actualizar</button>
    </form>
</body>
@endsection
