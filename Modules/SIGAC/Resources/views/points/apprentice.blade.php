@extends('sigac::layouts.master')

@section('content')


<div class="container">
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Fecha</th>
        <th>Cantidad</th>
        <th>Tema</th>
        <th>Estado</th>
        <th>Aprendiz</th>
        <th>Programa</th>

      </tr>
    </thead>
    <tbody>
      @foreach ($points as $point)
      <tr>
        <td>{{ $point->date }}</td>
        <td>{{ $point->quantity }}</td>
        <td>{{ $point->theme }}</td>
        <td>{{ $point->state }}</td>
        <td>{{ $point->apprentice->full_name }}</td>
        <td>{{ $point->program->name }}</td>
        <td>

        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection
