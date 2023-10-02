@extends('sica::layouts.master')

@section('stylesheet')
@endsection

@section('content')
    <div class="content">
      <div class="container-fluid">
        <div class="d-flex justify-content-center">
      <div class="card card-orange card-outline shadow col-md-12">
        <div class="card-header">
          <h3 class="card-title">Paises</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="">
            <table id="example1" class="table table-bordered table-striped yajra-datatable">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Pais</th>
                  <th>Departamento</th>
                  <th>Municipio</th>
                  <th>Acciones <a href="" class="text-success" class="text-success" data-toggle='tooltip' data-placement="top" title="Agregar"><i class="fas fa-plus-circle"></i></a></th>
                </tr>
              </thead>


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
    $("#example3").DataTable({
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

        var table = $('.yajra-datatable').DataTable({
            "processing": true,
            "serverSide": false,
            "ajax": "{{ route('sica.admin.location.countries.getcountries') }}",
            "columns": [
                {"data": 'DT_RowIndex', "name": 'DT_RowIndex'},
                {"data": 'department.country.name', "name": 'country'},
                {"data": 'department.name', "name": 'department'},
                {"data": 'name', "name": 'name'},
                {
                    "data": 'action', 
                    "name": 'action', 
                    "orderable": true, 
                    "searchable": true,
                    "fixedHeader": true 
                }
            ],
            "dom": 'Bfrtip',
           "buttons": [
               'pdf'
           ]
        });

</script>
@endsection
    