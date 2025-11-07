<div id="list">
    @if(isset($instructor_programs))
        @foreach ($instructor_programs as $i)
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne_{{ $i->id }}" aria-expanded="true" aria-controls="collapseOne">
                {{ $i->course->program->name }} - {{ $i->course->code }} : de {{ $i->start_time }} hasta {{ $i->end_time }}
                </button>
            </h2>
            <div id="collapseOne_{{ $i->id }}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="table-responsive">
                        <table id="" class="display table table-bordered table-striped table-sm instructor_program">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">{{trans('sigac::profession.Name')}}</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
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
                                                    @if($attendanceState)
                                                        @switch($attendanceState)
                                                            @case($attendanceState == 'P')
                                                                <button class="floating-button b1" data-student-id="{{ $a->person->id }}" data-instructor-program-id="{{ $i->id }}">
                                                                    {{ $attendanceState }}
                                                                @break
                                                            @case($attendanceState == 'FI')
                                                                <button class="floating-button b2" data-student-id="{{ $a->person->id }}" data-instructor-program-id="{{ $i->id }}">
                                                                    {{ $attendanceState }}
                                                                @break
                                                            @case($attendanceState == 'FJ')
                                                                <button class="floating-button b3" data-student-id="{{ $a->person->id }}" data-instructor-program-id="{{ $i->id }}">
                                                                    {{ $attendanceState }}
                                                                @break
                                                            @case($attendanceState == 'MF')
                                                                <button class="floating-button b4" data-student-id="{{ $a->person->id }}" data-instructor-program-id="{{ $i->id }}">
                                                                    {{ $attendanceState }}
                                                                @break
                                                            $@default
                                                                <button class="floating-button" data-student-id="{{ $a->person->id }}" data-instructor-program-id="{{ $i->id }}">
                                                                <i class="fas fa-plus"></i>
                                                        @endswitch
                                                        
                                                    @else
                                                        <button class="floating-button" data-student-id="{{ $a->person->id }}" data-instructor-program-id="{{ $i->id }}">
                                                        <i class="fas fa-plus"></i>
                                                    @endif
                                                </button>
                                                <div class="floating-button-menu">
                                                    <button class="sub-button b1" data-action="P">P</button>
                                                    <button class="sub-button b2" data-action="FI">FI</button>
                                                    <button class="sub-button b3" data-action="FJ">FJ</button>
                                                    <button class="sub-button b4" data-action="MF">MF</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <br>
        @endforeach
    @endif
</div>
<script>
    $(document).ready(function() {
        $('.instructor_program').DataTable( {
            paging: false
        } );
    });
</script>