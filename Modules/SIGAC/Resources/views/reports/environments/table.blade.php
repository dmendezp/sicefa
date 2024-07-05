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
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Hora</th>
                            <th class="text-center">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($instructor_program as $programs)
                            <tr>
                                <td class="text-center">
                                    @foreach ($programs->environment_instructor_programs as $p)
                                        {{ $p->environment->name }}
                                    @endforeach
                                </td>
                                <td class="text-center">{{ $programs->start_time }} - {{ $programs->end_time }}</td>
                                <td class="text-center">{{ $programs->state }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>