<div class="card">
    <div class="card-header">
        <strong>Reporte de ambientes</strong>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="table" class="table">
                <thead>
                    <tr>
                        <th class="text-center">Ambiente</th>
                        <th class="text-center">Instructor</th>
                        <th class="text-center">Ficha</th>
                        <th class="text-center">Hora</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($instructor_program as $programs)
                        <tr>
                            <td class="text-center">
                                @if($programs->modality == 'Presencial')
                                    @foreach ($programs->environment_instructor_programs as $p)
                                        {{ $p->environment->name }} <br>
                                    @endforeach
                                @else
                                    Medios Tecnológicos
                                @endif
                            </td>
                            <td class="text-center">
                                @foreach ($programs->instructor_program_people as $p)
                                    {{ $p->person->full_name }}    
                                @endforeach
                            </td>
                            <td class="text-center" title="{{ $programs->course->program->name }}">{{ $programs->course->code }}</td>
                            <td class="text-center">{{ $programs->start_time }} - {{ $programs->end_time }}</td>
                            <td class="text-center">{{ $programs->state }}</td>
                            <td class="text-center">
                                <button class="btn btn-info openModal" data-program-id="{{ $programs->id }}" data-bs-toggle="modal" data-bs-target="#rescheduleModal"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    @include('sigac::reports.environments.reschedule')
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <strong>Reporte de ambientes disponibles</strong>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="table_available" class="table">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Ambiente</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($environments as $e)                        
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $e->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        // Al hacer clic en el botón "openModal"
        $('.openModal').on('click', function() {
            var programId = $(this).data('program-id'); // Obtén el ID del programa desde el botón

            // Actualiza el valor del campo oculto del formulario con el ID del programa
            $('#rescheduleModal').find('#programId').val(programId);

            // Puedes agregar más código aquí para actualizar otros campos si es necesario
        });
    });
</script>
