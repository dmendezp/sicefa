@extends('sigac::layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card card-blue card-outline shadow">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Listado de Asistencia</h3>
                                
                                <div class="btn-group">
                                    <button class="btn btn-primary" id="prevDate">
                                        <i class="fas fa-arrow-left"></i>
                                    </button>
                                    <span class="btn btn-light" id="currentDate">{{ $currentDate }}</span>
                                    <button class="btn btn-primary" id="nextDate">
                                        <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="list">@if(isset($instructor_programs))
                                <div class="table-responsive">
                                    <table id="instructor_program" class="display table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">{{trans('sigac::profession.Name')}}</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($instructor_programs as $i)
                                                @foreach ($i->course->apprentices as $a)
                                                    @php
                                                        $attendanceState = ''; // Estado de asistencia predeterminado
                                                        // Verificar si hay asistencias para la fecha actual
                                                        $attendances = $a->person->attendance_apprentices->where('date', $currentDate);
                                                        if ($attendances->isNotEmpty()) {
                                                            // Obtener el estado de la asistencia más reciente
                                                            $latestAttendance = $attendances->sortByDesc('created_at')->first();
                                                            $attendanceState = $latestAttendance->state;
                                                           
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td class="text-center">{{ $a->person->fullname }}</td>
                                                        <td class="text-center">
                                                            <!-- Botón flotante -->
                                                            <div class="floating-button-container">
                                                                <button class="floating-button" data-student-id="{{ $a->person->id }}" data-instructor-program-id="{{ $i->id }}">
                                                                    @if($attendanceState)
                                                                        {{ $attendanceState }}
                                                                    @else
                                                                        <i class="fas fa-plus"></i>
                                                                    @endif
                                                                </button>
                                                                <div class="floating-button-menu">
                                                                    <button class="sub-button" data-action="P">P</button>
                                                                    <button class="sub-button" data-action="FI">FI</button>
                                                                    <button class="sub-button" data-action="FJ">FJ</button>
                                                                    <button class="sub-button" data-action="MF">MF</button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#instructor_program').DataTable();

        // Obtener la fecha actual
        var currentDate = "{{ $currentDate }}";

        // Manejar clics en las flechas de navegación
        $('#prevDate').on('click', function() {
            console.log('paso');
            var prevDate = new Date(currentDate);
            prevDate.setDate(prevDate.getDate() - 1);
            currentDate = prevDate.toISOString().slice(0, 10); // Actualizar la fecha actual
            $('#currentDate').text(currentDate); // Actualizar el texto de la fecha en la interfaz
            $.ajax({
                url: '{{ route('sigac.instructor.attendances.attendance.search') }}',
                method: 'GET',
                data: {
                    date: currentDate
                },
                success: function(response) {
                    // Actualizar el contenedor con los resultados filtrados
                    $('#list').html(response);
                    $('#instructor_program').DataTable();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        $('#nextDate').on('click', function() {
            var nextDate = new Date(currentDate);
            nextDate.setDate(nextDate.getDate() + 1);
            currentDate = nextDate.toISOString().slice(0, 10); // Actualizar la fecha actual
            $('#currentDate').text(currentDate); // Actualizar el texto de la fecha en la interfaz
            $.ajax({
                url: '{{ route('sigac.instructor.attendances.attendance.search') }}',
                method: 'GET',
                data: {
                    date: currentDate
                },
                success: function(response) {
                    // Actualizar el contenedor con los resultados filtrados
                    $('#list').html(response);
                    $('#instructor_program').DataTable();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

    });

    document.addEventListener('DOMContentLoaded', function() {
        // Manejar clic en el botón flotante
        $(document).on('click', '.floating-button', function() {
            $(this).siblings('.floating-button-menu').toggleClass('active');
        });

        // Manejar clic en cualquier lugar fuera del menú
        $(document).on('click', function(event) {
            if (!$(event.target).closest('.floating-button-container').length) {
                $('.floating-button-menu').removeClass('active');
            }
        });

        // Manejar clic en los botones de acción
        $(document).on('click', '.sub-button', function() {
            var studentId = $(this).closest('.floating-button-container').find('.floating-button').data('student-id');
            var action = $(this).data('action');
            var instructor_program_id = $(this).closest('.floating-button-container').find('.floating-button').data('instructor-program-id');
            // Aquí puedes hacer lo que necesites con el ID del estudiante y la acción seleccionada
            console.log('ID del estudiante:', studentId);
            console.log('Acción seleccionada:', action);
            console.log('Programacion seleccionada:', instructor_program_id);

            var buttonContainer = $(this).closest('.floating-button-container');
            var floatingButton = buttonContainer.find('.floating-button');
            var currentDate = $('#currentDate').text();

            $.ajax({
                url: '{{ route('sigac.instructor.attendances.attendance.store') }}',
                method: 'GET',
                data: {
                    person_id: studentId,
                    state: action,
                    date: currentDate,
                    instructor_program_id: instructor_program_id
                },
                success: function(response) {
                    // Cambiar el texto del botón flotante por el estado de la asistencia
                    var stateText = '';
                    switch (action) {
                        case 'P':
                            stateText = 'P';
                            break;
                        case 'FI':
                            stateText = 'FI';
                            break;
                        case 'FJ':
                            stateText = 'FJ';
                            break;
                        case 'MF':
                            stateText = 'MF';
                            break;
                        default:
                            stateText = 'Desconocido';
                    }
                    floatingButton.text(stateText);
                    // También puedes agregar una clase para cambiar el estilo del botón si es necesario
                    // floatingButton.addClass('btn-success');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

    });
</script>
