<div class="card card-orange card-outline shadow col-md-12">
	<div class="card-header">
		<h3 class="card-title">{{ $course->code }} {{ $course->program->name }}</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="btns">
			<a href="#" class="btn btn-primary" disabled>
                <i class="fas fa-calendar-plus"></i>
                Registrar aprendiz
            </a>
		</div>
		<div class="mtop16">
			<table id="apprentices_table" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Documento</th>
						<th>Nombre</th>
						<th>Correo</th>
						<th class="text-center">Telefono</th>
						<th class="text-center">Estado</th>
						<th class="text-center">Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach($apprentices as $a)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $a->person->document_number }}</td>
                            <td>{{ $a->person->full_name }}</td>
                            <td>{{ $a->person->personal_email }}</td>
                            <td class="text-center">{{ $a->person->telephone1 }}</td>
                            <td class="text-center">{{ $a->apprentice_status }}</td>
                            <td class="text-center">
                                <div class="opts">
                                    <a href="#" class="text-success" data-toggle='tooltip' data-placement="top" title="Actualizar aprendiz" disabled>
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="text-danger" data-toggle='tooltip' data-placement="top" title="Eliminar apprendiz" disabled>
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<script>
    $(function () {
        $("#apprentices_table").DataTable({});
    });
</script>

