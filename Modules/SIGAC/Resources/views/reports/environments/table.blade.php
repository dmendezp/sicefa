<div class="card">
    <div class="card-header">
        Reporte de ambientes
    </div>
    <div class="card-body">
        <div>
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
                                    @foreach ($programs->environment_instructor_programs as $p)
                                        {{ $p->environment->name }} <br>
                                    @endforeach
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
                                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#reschedule{{$programs->id}}"><i class="fas fa-edit"></i></button>
                                </td>
                                @include('sigac::reports.environments.reschedule')
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('script')
@endpush