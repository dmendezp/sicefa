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
                            if ($a->person->attendance_apprentices->isNotEmpty()) {
                                // Filtrar las asistencias para la fecha actual
                                $attendances = $a->person->attendance_apprentices->where('date', $currentDate);
                                if ($attendances->isNotEmpty()) {
                        
                                    // Obtener el estado de la asistencia más reciente
                                    $latestAttendance = $attendances->sortByDesc('created_at')->first();
                                    $attendanceState = $latestAttendance->state;
                                }
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