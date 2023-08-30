@extends('agroindustria::layouts.master')

@section('content')
    <h1>Registrar Nueva Formulación</h1>

    <form method="POST" action="">
        @csrf
        <label for="name">Nombre de la Formulación</label>
        <input type="text" name="name" required>

        <label for="ingredients">Ingredientes</label>
        <textarea name="ingredients" required></textarea>

        <button type="submit">Registrar Formulación</button>
    </form>
@endsection
