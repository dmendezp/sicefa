<div class="available">
    <div class="card">
        <div class="card-header">
            Reporte de ambientes disponibles
        </div>
        <div class="card-body">
            <div>
                <div class="table-responsive">
                    <table id="table" class="table">
                        <thead>
                            <tr>
                                <th class="text-center">Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($available_environments as $environment)
                                    <tr>
                                        <td class="text-center">{{ $environment->name }}</td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="notAvailable">
    <div class="card">
        <div class="card-header">
            Reporte de ambientes no disponibles
        </div>
        <div class="card-body">
            <div>
                <div class="table-responsive">
                    <table id="tableNotAvailable" class="table">
                        <thead>
                            <tr>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($instructor_program as $i)
                                @foreach ($i->environment_instructor_programs as $e)                          
                                    <tr>
                                        <td class="text-center">{{ $e->environment->name }}</td>
                                        <td class="text-center">{{ $i->start_time }} - {{ $i->end_time }}</td>

                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>