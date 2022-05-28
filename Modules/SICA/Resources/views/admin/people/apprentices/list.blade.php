<div class="card card-orange card-outline shadow col-md-12">
	<div class="card-header">
		<h3 class="card-title">{{ $course->code }} {{ $course->program->name }}</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="btns">
			<a href="{{ route('evs.admin.elections.add') }}" class="btn btn-primary"><i class="fas fa-calendar-plus"></i> {{ __('Apprentices Add') }}</a>
		</div>
		<div class="mtop16">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Id</th>
						<th>Documento</th>
						<th>Nombre</th>
						<th>Correo</th>
						<th>Estado</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach($apprentices as $a)	
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $a->person->document_number }}</td>
						<td>{{ $a->person->full_name }}</td>
						<td>{{ $a->person->personal_email }}</td>
						<td>{{ $a->apprentice_status }}</td>
						<td>
							<div class="opts">

								<a href="{{ url('sica/admin/people/apprentice/edit/'.$a->id) }}" data-toggle='tooltip' data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>

								<a class="btn-delete" href="#" data-action="delete" data-toggle='tooltip' data-placement="top" data-object="{{ $a->id }}" data-path="sica/admin/people/apprentice" title="Eliminar"><i class="fas fa-trash-alt"></i></a>

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

