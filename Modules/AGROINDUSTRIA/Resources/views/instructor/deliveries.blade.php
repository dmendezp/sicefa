@extends('agroindustria::layouts.master')
@section('content')

<header>
    <h1 class="titulo">Formulario de Salida de Bodega</h1>
  </header>
  <main>
  <div class="bodega-form-container">
    <form class="bodega-form">
      <label for="fecha">Fecha:</label>
      <input type="date" id="fecha" name="fecha" required>

      <label for="responsable">Responsable de la Entrega:</label>
      <input type="text" id="responsable" name="responsable" required>

      <label for="receptor">Quién Recibe:</label>
      <input type="text" id="receptor" name="receptor" required>

      <label for="producto">Producto:</label>
      <textarea id="producto" name="producto" rows="4" required></textarea>

      <button class="button_salida" type="submit">Registrar Salida</button>
    </form>
</div>
  </main>



@endsection
    
