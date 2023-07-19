@extends('agrocefa::layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('agrocefa/css/bodega.css') }}">
<form>
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>
    
    <label for="densidad">Densidad:</label>
    <input type="text" id="densidad" name="densidad">
    
    <label for="area">Area:</label>
    <input type="text" id="area" name="area">
    
    <label for="opciones">Lote:</label>
    <select id="opciones" name="opciones">
      <option value="opcion1">Lote 1</option>
      <option value="opcion2">Lote 2</option>
      <option value="opcion3">Lote 3</option>
    </select>
    
    <input type="submit" value="Enviar">
  </form>
  @endsection