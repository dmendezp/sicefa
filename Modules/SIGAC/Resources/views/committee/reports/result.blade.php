<div class="card">
    <div class="card-header">
        Resultado
    </div>
    <div class="card-body">
        <div>
            <div class="table-responsive">
                <table id="table" class="table">
                    <thead>
                        <tr>
                            <th>Fecha Novedad</th>
                            <th>Tipo</th>
                            <th>Observación</th>
                            <th>Estado</th>
                            <th>Resultados Asociados</th>
                            <th>Fecha Comite</th>
                            <th>Hora de Inicio</th>
                            <th>Estado</th>
                            <th>Respuesta</th>
                            <th>Plan de Mejoramiento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($apprentice_novelties as $apprentice_novelty)
                        <tr>
                            <td>{{ $apprentice_novelty->created_at}}</td>
                            <td>{{ $apprentice_novelty->type}}</td>
                            <td>{{ $apprentice_novelty->observation}}</td>
                            <td>{{ $apprentice_novelty->state}}</td>
                            @if ($apprentice_novelty->learningoutcomecommittees()->exists())
                                <td>
                                @foreach($apprentice_novelty->learningoutcomecommittees as $learningoutcomecommittee)
                                    <p>
                                        - {{ $learningoutcomecommittee->learning_outcome->name }}
                                    </p>
                                @endforeach
                                </td>
                            @else 
                            <td>
                            No Contiene
                            </td>
                            @endif
                            @foreach ($apprentice_novelty->evaluation_committees as $evaluation_committee)
                                <td>{{ $evaluation_committee->date }}</td>
                                <td>{{ $evaluation_committee->start_time }}</td>
                                <td>{{ $evaluation_committee->state }}</td>
                                <td>{{ $evaluation_committee->answer }}</td>
                            @endforeach
                            @if ($apprentice_novelty->state == 'Plan Mejoramiento')
                            <td>
                                @foreach($apprentice_novelty->evaluation_committees as $evaluation_committee)
                                    @foreach($evaluation_committee->committee_staffs as $committee_staff)
                                        @if ($committee_staff->role == 'Plan Mejoramiento')
                                        <p>
                                            {{ $committee_staff->person->first_name }} {{ $committee_staff->person->first_last_name }} {{ $committee_staff->person->second_last_name }}
                                        </p>
                                        @endif
                                    @endforeach
                                @endforeach
                            </td>
                            @else
                            <td>
                                No Contiene
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
