@extends('sica::layouts.master')

@section('stylesheet')
@endsection

@section('content')
    <div class="content">
      <div class="container-fluid">
        <div class="d-flex justify-content-center">
      <div class="card card-orange card-outline shadow col-md-12">
        <div class="card-header">
          <h3 class="card-title">Ambientes</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="btns">
            <a href="" class="btn btn-primary"><i class="fas fa-calendar-plus"></i> {{ __('Environments Add') }}</a>
          </div>
          <div class="mtop16">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Unidad</th>
                  <th>Nombre</th>
                  <th>Tipo</th>
                  <th>Coordenadas</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach($environments as $e)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $e->productive_units_id }}</td>
                  <td>{{ $e->type_environments }}</td>
                  <td>{{ $e->lengh }} {{ $e->latitude }}</td>
                  <td>
                    <div class="opts">

                      <a href="" data-toggle='tooltip' data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>

                      <a class="btn-delete" href="#" data-action="delete" data-toggle='tooltip' data-placement="top" data-object="" data-path="sica/admin/people/apprentice" title="Eliminar"><i class="fas fa-trash-alt"></i></a>

                    </div>
                  </td>
                </tr>
               @endforeach
              </tbody>

            </table>
          </div>
        </div>
        <!-- Timelime example  -->
      </div>
        </div>
<div class="input-group">
    <input type="text" id="image_label" class="form-control" name="image"
           aria-label="Image" aria-describedby="button-image">
    <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="button" id="button-image">Select</button>
    </div>
</div>
    </div>
</div>

@endsection

@section('script')

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  document.addEventListener("DOMContentLoaded", function() {

  document.getElementById('button-image').addEventListener('click', (event) => {
    event.preventDefault();

    window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
  });
});

// set file link
function fmSetLink($url) {
  document.getElementById('image_label').value = $url;
}
</script>
@endsection
    