@extends('sica::layouts.master')

@section('stylesheet')
@endsection

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="d-flex justify-content-center">
      <div class="card card-orange card-outline shadow col-md-12">
        <div class="card-header">
          <h3 class="card-title">Inventario</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <!-- Timelime example  -->
          <label for="warehouse">Bodega</label>
          <div class="input-select">
              <select class="form-select" name="warehouse_id" id="warehouse_id">
                  <option value="">Seleccione la bodega</option>
                  @foreach ($warehouses as $warehouse)
                      <option value="{{ $warehouse->id }}">
                          {{ $warehouse->name }}
                      </option>
                  @endforeach
              </select>
          </div>
          <br>
          <div id="filteredResults">
            @include('sica::admin.inventory.inventory.table')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
<link href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.bootstrap4.min.css" rel="stylesheet">

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>
    <script>
        // Cuando cambia la selección de categoría
        $('#warehouse_id').change(function() {
            var warehouse_id = $(this).val();

            // Realizar una solicitud AJAX para obtener los resultados filtrados
            $.ajax({
                type: 'POST',
                url: "{{ route('sica.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.inventories.filter') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    warehouse_id: warehouse_id
                },
                success: function(data) {
                    // Actualizar el contenedor con los resultados filtrados
                    $('#filteredResults').html(data);

                    // Inicializar DataTable después de que se cargue la tabla en el DOM
                    $("#table_inventory").DataTable({
                      responsive: true,
                      
                      dom: '<"row"<"col-sm-8"B><"col-sm-4"f>>' + 
                            '<"row"<"col-sm-12"rt>>' + 
                            '<"row"<"col-sm-6"l><"col-sm-6"p>>',
                      buttons: [
                          {
                            extend: 'excelHtml5',
                            text: '<i class="fas fa-file-excel"></i>',
                            titleAttr: 'Exportar a Excel',
                            className: 'btn btn-success'
                          },
                          {
                            extend: 'pdfHtml5',
                            text: '<i class="fas fa-file-pdf"></i>',
                            titleAttr: 'Exportar a PDF',
                            className: 'btn btn-danger'
                          },
                          {
                            extend: 'print',
                            text: '<i class="fas fa-print"></i>',
                            titleAttr: 'Imprimir',
                            className: 'btn btn-info'
                          }
                      ]
                  });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    </script>
@endsection