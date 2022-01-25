
@extends('bolmeteor::layouts.admin')

@section('title','Elections')

@section('breadcrumb')
<li class="breadcrumb-item active">
  <a href="{{ route('bolmeteor.admin.dashboard') }}"><i class="fas fa-calendar-alt"></i> {{ __('Elections') }}</a>
</li>
@endsection

@section('content')
    <!-- Main content -->
    <div class="content">

      <div class="container-fluid">

			<div class="card card-purple card-outline shadow">
              <div class="card-header">
                <h3 class="card-title">Elecciones</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              	<div class="btns">
				<a href="{{ route('bolmeteor.admin.elections.add') }}" class="btn btn-primary"><i class="fas fa-calendar-plus"></i> Agregar Eleccion</a>
				</div>
				<div class="mtop16">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Inicia</th>
                    <th>Termina</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                   @foreach($elections as $e)	
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $e->name }}</td>
                    <td>{{ $e->start_date }}</td>
                    <td>{{ $e->end_date }}</td>
                    <td>{{ $e->status }}</td>
                    <td>
                    	<div class="opts">
                        
		                  <a href="{{ url('bolmeteor/admin/election/edit/'.$e->id) }}" data-toggle='tooltip' data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>

                      <a class="btn-delete" href="#" data-action="delete" data-toggle='tooltip' data-placement="top" data-object="{{ $e->id }}" data-path="bolmeteor/admin/election" title="Eliminar"><i class="fas fa-trash-alt"></i></a>

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
            <!-- /.card -->
          </div>

      </div><!-- /.container-fluid -->
    <!-- /.content -->
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
@stop