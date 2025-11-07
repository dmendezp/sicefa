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
        <th>Acciones</th>
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
@section('scripts')
<script>
$(function () {


        function llenarModal(data) {
          $('#id').val(data.id);
          $('#date').val(data.date);
          $('#quantity').val(data.quantity);
          $('#theme').val(data.theme);
          $('#state').val(data.state);
          $('#apprentice_id').val(data.apprentice_id);
          $('#program_id').val(data.program_id);
        }

        function limpiarModal() {
          // ... (same as before)
        }

        var table = $('.table').DataTable({
          // ... (same options as before, except for "columns")
          "columns": [
            {"data": 'DT_RowIndex', "name": 'DT_RowIndex'},
            {"data": 'date', "name": 'date'},
            {"data": 'quantity', "name": 'quantity'},
            {"data": 'theme', "name": 'theme'},
            {"data": 'state', "name": 'state'},
            {"data": 'apprentice.full_name', "name": 'apprentice.full_name'},
            {"data": 'program.name', "name": 'program.name'},
            {"data": 'action', "name": 'action', "orderable": true, "searchable": true, "fixedHeader": true}
          ]
        });

        // ... (same event handlers as before, but using the new field names)

      });


</script>
@endsection
