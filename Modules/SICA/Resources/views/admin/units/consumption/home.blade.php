@extends('sica::layouts.master')

@section('stylesheet')
@endsection

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="d-flex justify-content-center">
      <div class="card card-orange card-outline shadow col-md-12">
        <div class="card-header">
              <h3 class="card-title">Consumos</h3>
        </div>
              <!-- /.card-header -->

              <!-- /.card-body -->
        <div class="card-body">
          <label for="productive_unit">Unidad Productiva</label>
          <div class="input-select">
              <select class="form-select" name="productive_unit" id="productive_unit">
                  <option value="">Seleccione la unidad productiva</option>
                  @foreach ($productive_units as $productive_unit)
                      <option value="{{ $productive_unit->id }}">
                          {{ $productive_unit->name }}
                      </option>
                  @endforeach
              </select>
          </div>
          <br>
          <div id="filteredResults">
            @include('sica::admin.units.consumption.table')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
    <script>
        $(function() {-
            $("#table_environments").DataTable({});
        });
    </script>
    <script>
        // Cuando cambia la selección de categoría
        $('#productive_unit').change(function() {
            var productive_unit = $(this).val();

            // Realizar una solicitud AJAX para obtener los resultados filtrados
            $.ajax({
                type: 'POST',
                url: "{{ route('sica.' . getRoleRouteName(Route::currentRouteName()) . '.units.consumptions.filter') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    productive_unit: productive_unit
                },
                success: function(data) {
                    // Actualizar el contenedor con los resultados filtrados
                    $('#filteredResults').html(data);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    </script>
@endsection
    