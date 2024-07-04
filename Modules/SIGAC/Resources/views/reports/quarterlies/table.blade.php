<div class="card">
    <div class="card-header">
        Trimestralización
    </div>
    <div class="card-body">
        <div>
            <div class="table-responsive">
                <table id="table" class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Competencia</th>
                            <th class="text-center">Resultado de Aprendizaje</th>
                            @for($trimestreNumber = 1; $trimestreNumber <= $courseNumber; $trimestreNumber++)
                                <th class="text-center" colspan="2">{{ $trimestreNumber }}</th>
                            @endfor
                            <th class="text-center">Perfil</th>
                        </tr>
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center"></th>
                            @for($trimestreNumber = 1; $trimestreNumber <= $courseNumber; $trimestreNumber++)
                                <th class="text-center">P</th>
                                <th class="text-center">E</th>
                            @endfor
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quarterlies as $competency => $learningOutcomes)
                            @php
                                $firstRowCompetency = true;
                                $totalHoursCompetency = 0;
                                $totalExecutedHoursCompetency = 0;
                                
                                // Calcular horas planeadas y ejecutadas por competencia
                                foreach($learningOutcomes as $trimestres) {
                                    foreach($trimestres as $trimestre) {
                                        $totalHoursCompetency += $trimestre->hour;
                                        
                                        // Calcular horas ejecutadas
                                        if (isset($trimestre->learning_outcome->instructor_program_outcomes)) {
                                            foreach ($trimestre->learning_outcome->instructor_program_outcomes as $instructor_program_outcome) {
                                                $instructor_program = $instructor_program_outcome->instructor_program;
                                                $start = \Carbon\Carbon::parse($instructor_program->start_time);
                                                $end = \Carbon\Carbon::parse($instructor_program->end_time);
                                                $totalExecutedHoursCompetency += $end->diffInHours($start);
                                            }
                                        }
                                    }
                                }
                            @endphp
                            @foreach($learningOutcomes as $learningOutcome => $trimestres)
                                <tr>
                                    @if($firstRowCompet7ency)
                                        <td rowspan="{{ count($learningOutcomes) }}" class="text-center">
                                            {{ $competency }}<br>
                                            <strong>Planeadas: {{ $totalHoursCompetency }}</strong><br>
                                            <strong>Ejecutadas: {{ $totalExecutedHoursCompetency }}</strong>
                                        </td>
                                        @php $firstRowCompetency = false; @endphp
                                    @endif
                                    <td>{{ $learningOutcome }}</td>
                                    @for($i = 1; $i <= $courseNumber; $i++)
                                        @php
                                            $trimestre = $trimestres->firstWhere('quarter_number', $i);
                                        @endphp
                                        @if($trimestre)
                                            <td>{{ $trimestre->hour }}</td>
                                            <td class="celdae"></td>
                                        @else
                                            <td></td>
                                            @php
                                                $totalHours = 0;
                                                $person = ''; // Initialize $person variable
                                                if (isset($trimestres->first()->learning_outcome->instructor_program_outcomes) && $trimestres->first()->learning_outcome->instructor_program_outcomes->count() > 0) {
                                                    foreach ($trimestres->first()->learning_outcome->instructor_program_outcomes as $instructor_program_outcome) {
                                                        $instructor_program = $instructor_program_outcome->instructor_program;
                                                        if ($i == $instructor_program->quarter_number) {
                                                            $start = \Carbon\Carbon::parse($instructor_program->start_time);
                                                            $end = \Carbon\Carbon::parse($instructor_program->end_time);
                                                            $totalHours += $end->diffInHours($start);

                                                            // Assign the person's name
                                                            $person = $instructor_program->instructor_program_people->first()->person->fullname ?? '';
                                                        }
                                                    }
                                                }
                                            @endphp
                                            <td class="celdae" title="{{ $person }}">{{ $totalHours > 0 ? $totalHours : '' }}</td>
                                        @endif
                                    @endfor
                                    <td>
                                        @if(isset($trimestres->first()->learning_outcome->competencie->professions) && count($trimestres->first()->learning_outcome->competencie->professions) > 0)
                                            @foreach($trimestres->first()->learning_outcome->competencie->professions as $profession)
                                                {{ $profession->name }}<br>
                                            @endforeach
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
