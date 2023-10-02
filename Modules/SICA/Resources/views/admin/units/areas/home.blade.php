@extends('sica::layouts.master')

@section('stylesheet')
@endsection

@section('content')
    <div class="content">
      <div class="container-fluid">
        <div class="d-flex justify-content-center">
      <div class="card card-orange card-outline shadow col-md-12">
        <div class="card-header">
          <h3 class="card-title">Unidades</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="btns">
            <a href="" class="btn btn-primary"><i class="fas fa-calendar-plus"></i> {{ __('Warehouse Add') }}</a>
          </div>
          <div class="mtop16">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Area</th>
                  <th>Unidad</th>
                  <th>Descripción</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach($areas as $a)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $a->area_id }}</td>
                  <td>{{ $a->name }}</td>
                  <td>{{ $a->description }}</td>
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
</script>
@endsection
    