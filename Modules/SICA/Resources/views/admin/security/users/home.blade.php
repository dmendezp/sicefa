@extends('sica::layouts.master')

@section('stylesheet')
@endsection

@section('content')
    <div class="content">
      <div class="container-fluid">
    <div class="d-flex justify-content-center">
      <div class="card card-orange card-outline shadow col-md-12">
        <div class="card-header">
              <h3 class="card-title">Usuarios</h3>
        </div>
              <!-- /.card-header -->
        <div class="card-body">
            <div class="btns">
            <a href="{{ route('sica.admin.security.users.add') }}" class="btn btn-primary "><i class="fas fa-user-plus"></i> Agregar Usuario</a>

        </div>
        <div class="mtop16">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Nickname</th>
                    <th>{{ trans('sica::forms.Name') }}</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($users as $u)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $u->nickname }}</td>
                    <td>{{ $u->person->first_name }} {{ $u->person->first_last_name }} {{ $u->person->second_last_name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>
                    <div class="opts">
                      <a href="{{ url('admin/re/edit/'.$u->id) }}" data-toggle='tooltip' data-placement="top" title="Ver"><i class="fas fa-eye"></i></a>
                      <a href="{{ url('admin/re/edit/'.$u->id) }}" data-toggle='tooltip' data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                      <a class="btn-delete" href="#" data-action="delete" data-toggle='tooltip' data-placement="top" data-object="{{ $u->id }}" data-path="admin/role" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                    </div>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>

                </table>
            </div>
              </div>
              <!-- /.card-body -->
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
    