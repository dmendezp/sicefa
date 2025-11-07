
@extends('evs::layouts.master')

@section('title','Electeds')

@section('breadcrumb')
<li class="breadcrumb-item active">
  <a href="{{ route('evs.admin.dashboard') }}"><i class="fas fa-calendar-alt"></i> {{ __('Electeds') }}</a>
</li>
@endsection

@section('content')
    <!-- Main content -->
    <div class="content">

      <div class="container-fluid">

			<div class="card card-purple card-outline shadow">
              <div class="card-header">
                <h3 class="card-title">{{ __('Electeds') }}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              	<div class="btns">
				<a href="{{ route('evs.admin.electeds.add') }}" class="btn btn-primary"><i class="fas fa-calendar-plus"></i> {{ __('Elected Add') }}</a>
				</div>
				<div class="mtop16">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Eleccción</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Num Votos</th>
                    <th>Rol</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                   @foreach($electeds as $e)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $e->election->name }}</td>
                    <td>{{ $e->candidate->person->first_name }} {{ $e->candidate->person->first_last_name }} {{ $e->candidate->person->second_last_name }}</td>
                    <td>{{ $e->status }}</td>
                    <th>{{ $e->votes }}</th>
                    <td>{{ $e->job }}</td>
                    <th>{{ $e->telephone }}</th>
                    <th>{{ $e->email }}</th>
                    <td>
                    	<div class="opts">
                        
		                  <a href="{{ url('evs/admin/elected/edit/'.$e->id) }}" data-toggle='tooltip' data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>

                      <a class="btn-delete" href="#" data-action="delete" data-toggle='tooltip' data-placement="top" data-object="{{ $e->id }}" data-path="evs/admin/elected" title="Eliminar"><i class="fas fa-trash-alt"></i></a>

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