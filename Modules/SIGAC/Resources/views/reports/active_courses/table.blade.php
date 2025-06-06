<div class="card">
    <div class="card-header">
        <strong>Reporte de fichas activas</strong>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="table" class="table">
                <thead>
                    <tr>
                        <th class="text-center">Curso</th>
                        <th class="text-center"># Fichas</th>
                        <th class="text-center">Instructor Líder</th>
                        <th class="text-center">Trimestres</th>
                        <th class="text-center">Trimrestre actual</th>
                        <th class="text-center">Inicio Lectiva</th>
                        <th class="text-center">Fin Lectiva</th>
                        <th class="text-center">Inicio Práctica</th>
                        <th class="text-center">Fin Práctica</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $c)
                        <tr>
                            <td class="text-center">{{ $c->program->name }}</td>
                            <td class="text-center">{{ $c->code }}</td>
                            <td class="text-center">
                                @if ($c->person)
                                    {{ $c->person->full_name }} 
                                @else
                                    Sin instructor asignado
                                @endif
                            </td>
                            <td class="text-center">{{ $c->program->quarter_number }}</td>
                            <td class="text-center">
                                @if($c->instructor_programs->max('quarter_number') > 0)
                                    {{ $c->instructor_programs->max('quarter_number') }}
                                @else
                                    Sin programación    
                                @endif
                            </td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($c->star_date)->format('d-m-y') }}</td>
                            <td class="text-center">
                                @if($c->school_end_date)
                                    {{ \Carbon\Carbon::parse($c->school_end_date)->format('d-m-y') }}
                                @endif
                            </td>
                            <td class="text-center">
                                @if($c->start_production_date)
                                    {{ \Carbon\Carbon::parse($c->start_production_date)->format('d-m-y') }}
                                @endif
                            </td>
                            <td class="text-center">{{ Carbon\Carbon::parse($c->end_date)->format('d-m-y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div> 