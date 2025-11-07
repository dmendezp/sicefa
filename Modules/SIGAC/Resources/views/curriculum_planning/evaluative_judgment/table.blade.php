<div class="card card-blue card-outline shadow col-md-12">
	<div class="card-header">
		<h3 class="card-title">{{ $course->code }} {{ $course->program->name }}</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
        <div class="row">
            <div class="col-md-10">
                <div class="form-group">
                    <label for="">Aprendiz</label>
                    {!! Form::select('person_id', $apprentices, $resultsperson ?? null, [
                        'class' => 'form-control person_id',
                        'placeholder' => '-- Seleccione --',
                        'id' => 'person_id',
                        'height' => '38px',
                    ]) !!}
                </div>
                <div class="form-group">
                    <label for="">Estado</label>
                    {!! Form::select('state', ['' => trans('Seleccione el estado'), 'Aprobado' => 'Aprobado', 'Pendiente' => 'Pendiente' ], $state ?? null, [
                        'class' => 'form-control state',
                        'placeholder' => '-- Seleccione --',
                        'id' => 'state',
                        'height' => '38px',
                    ]) !!}
                    {!! Form::hidden('course_id', $course->id) !!}
                </div>
            </div>
        </div>
		<div class="mtop16">
			<table id="apprentices_table" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Documento</th>
						<th>Nombre</th>
						<th class="text-center">Competencia</th>
						<th class="text-center">Resultado</th>
						<th class="text-center">Estado</th>
						<th class="text-center">Juicio de Evaluacion</th>
					</tr>
				</thead>
				<tbody>
					@foreach($evaluative_judgments as $e)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $e->person->document_number }}</td>
                            <td>{{ $e->person->full_name }}</td>
                            <td>{{ $e->learning_outcome->name }}</td>
                            <td>{{ $e->learning_outcome->competencie->name }}</td>
                            @foreach ($e->person->apprentices as $a)
                                <td class="text-center">{{ $a->apprentice_status }}</td>
                            @endforeach
                            
                            <td>{{ $e->state }}</td>
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
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(function() {
        $('.person_id').select2();
    })
    $(document).ready(function() {

        $('.state').on('change', function () {
            var person_id = $('#person_id').val();
            var state = $('#state').val();
            var course_id = $('#course_id').val();
            $.ajax({
                    type: 'POST',
                    url: "{{ route('sigac.academic_coordination.curriculum_planning.evaluative_judgment.filter') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        person_id: person_id,
                        state: state,
                        course_id: course_id,
                    },
                    success: function(data) {
                        // Actualizar el contenedor con los resultados filtrados
                        $('#divApprentices').html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
        });
        $('.person_id').on('change', function () {
            var person_id = $('#person_id').val();
            var course_id = $('#course_id').val();
            $.ajax({
                    type: 'POST',
                    url: "{{ route('sigac.academic_coordination.curriculum_planning.evaluative_judgment.filter') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        person_id: person_id,
                        course_id: course_id,
                    },
                    success: function(data) {
                        // Actualizar el contenedor con los resultados filtrados
                        $('#divApprentices').html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
        });
    });
</script>

