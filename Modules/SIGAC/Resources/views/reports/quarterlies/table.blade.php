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
                        @foreach($quarterlies as $competency => $trimestres)
                            @foreach($trimestres as $trimestre)
                                <tr>
                                    @if($loop->first)
                                        <td rowspan="{{ $trimestres->count() }}" class="text-center">{{ $competency }}</td>
                                        <td rowspan="{{ $trimestres->count() }}">{{ $trimestre->learning_outcome->name }}</td>
                                    @endif
                                    @for($i = 1; $i <= $courseNumber; $i++)
                                        @if($i == $trimestre->quarter_number)
                                            <td>{{ $trimestre->learning_outcome->hour }}</td>
                                            <td class="celdae"></td>
                                        @else
                                            <td></td>
                                            @if (isset($trimestre->learning_outcome->instructor_program_outcomes) && $trimestre->learning_outcome->instructor_program_outcomes->count() > 0)
                                            @php
                                                $totalHours = 0;
                                                foreach ($trimestre->learning_outcome->instructor_program_outcomes as $instructor_program_outcome) {
                                                    $instructor_program = $instructor_program_outcome->instructor_program;
                                                    if ($i == $instructor_program->quarter_number) {
                                                        $start = \Carbon\Carbon::parse($instructor_program->start_time);
                                                        $end = \Carbon\Carbon::parse($instructor_program->end_time);
                                                        $totalHours += $end->diffInHours($start);
                                                    }
                                                }
                                            @endphp
                                            <td class="celdae">{{ $totalHours > 0 ? $totalHours . '' : '' }}</td>
                                        @else
                                            <td class="celdae"></td>
                                        @endif
                                        @endif
                                    @endfor
                                    <td class="text-center">
                                        @if (count($trimestre->learning_outcome->people) > 0)
                                            @foreach($trimestre->learning_outcome->competencie->professions as $profession)
                                                {{ $profession->name }} <br>
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
