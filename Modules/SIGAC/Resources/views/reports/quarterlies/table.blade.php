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
                        @php
                            $totalHoursByQuarter = array_fill(1, $courseNumber, 0);
                            $totalExecutedHoursByQuarter = array_fill(1, $courseNumber, 0);
                        @endphp

                        @foreach($quarterlies as $competency => $learningOutcomes)
                            @php
                                $firstRowCompetency = true;
                                $totalHoursCompetency = 0;
                                $totalExecutedHoursCompetency = 0;
                            @endphp

                            @foreach($learningOutcomes as $learningOutcome => $trimestres)
                                @foreach($trimestres as $trimestre)
                                    @php
                                        // Calcular horas planeadas por competencia
                                        $totalHoursCompetency += $trimestre->hour;

                                        // Calcular horas ejecutadas por competencia
                                        if (isset($trimestre->learning_outcome->instructor_program_outcomes)) {
                                            foreach ($trimestre->learning_outcome->instructor_program_outcomes as $instructor_program_outcome) {
                                                $instructor_program = $instructor_program_outcome->instructor_program;
                                                $start = \Carbon\Carbon::parse($instructor_program->start_time);
                                                $end = \Carbon\Carbon::parse($instructor_program->end_time);
                                                $totalExecutedHoursCompetency += $end->diffInHours($start);
                                            }
                                        }
                                    @endphp
                                @endforeach
                            @endforeach

                            @foreach($learningOutcomes as $learningOutcome => $trimestres)
                                <tr>
                                    @if($firstRowCompetency)
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
                                            $trimestreHours = 0;
                                            $trimestreExecutedHours = 0;
                                            $person = '';
                                        @endphp
                                        @if($trimestre)
                                            @php
                                                $trimestreHours = $trimestre->hour;
                                                $totalHoursByQuarter[$i] += $trimestreHours;
                                            @endphp
                                            <td>{{ $trimestreHours }}</td>
                                            <td class="celdae"></td>
                                        @else
                                            <td></td>
                                            @if (isset($trimestres->first()->learning_outcome->instructor_program_outcomes))
                                                @foreach ($trimestres->first()->learning_outcome->instructor_program_outcomes as $instructor_program_outcome)
                                                    @php
                                                        $instructor_program = $instructor_program_outcome->instructor_program;
                                                        if ($i == $instructor_program->quarter_number) {
                                                            $start = \Carbon\Carbon::parse($instructor_program->start_time);
                                                            $end = \Carbon\Carbon::parse($instructor_program->end_time);
                                                            $trimestreExecutedHours += $end->diffInHours($start);
                                                        }
                                                    @endphp
                                                @endforeach
                                                @php
                                                    $totalExecutedHoursByQuarter[$i] += $trimestreExecutedHours;
                                                @endphp
                                            @endif
                                            <td class="celdae" title="{{ $person }}">{{ $trimestreExecutedHours > 0 ? $trimestreExecutedHours : '' }}</td>
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
                    <tfoot>
                        <tr>
                            <th class="text-center" colspan="2">Total por Trimestre</th>
                            @for($i = 1; $i <= $courseNumber; $i++)
                                <th class="text-center" colspan="1">
                                    <div>{{ $totalHoursByQuarter[$i] }}</div>
                                </th>
                                <th class="text-center celdae" colspan="1">
                                    <div>{{ $totalExecutedHoursByQuarter[$i] }}</div>
                                </th>
                            @endfor
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
