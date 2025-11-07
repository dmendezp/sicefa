    <div class="card">
        <div class="card-header">
            Trimestralización
        </div>
        <div class="card-body">
            <div>
                <div class="table-responsive" style="overflow-y: auto; max-height: 400px;">
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
                                    <th class="text-center" title="Horas Planeadas">P</th>
                                    <th class="text-center" title="Horas Ejecutadas">E</th>
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
                                    $sumControl = [];
                                @endphp

                                @foreach($learningOutcomes as $learningOutcome => $trimestres)
                                    @foreach($trimestres as $trimestre)
                                        @php
                                            // Acumular horas planeadas por competencia
                                            $totalHoursCompetency += $trimestre->hour;

                                            $competency = $trimestre->learning_outcome->competencie->name;
                                            $learning_outcome_id = $trimestre->learning_outcome_id;

                                            
                                            foreach ($instructor_programs as $ins) {
                                                foreach ($ins->instructor_program_outcomes as $outcome) {
                                                    // Verificar el trimestre ejecutado y asegurarse que sea del resultado de aprendizaje actual
                                                    $executedQuarter = $ins->quarter_number; // Trimestre de ejecución
                                                    $outcomeLearningId = $outcome->learning_outcome_id;
                                                    $competencyName = $outcome->learning_outcome->competencie->name;

                                                    // Verificar si estamos en el resultado de aprendizaje correcto y en el trimestre correcto
                                                    if ($outcomeLearningId == $learning_outcome_id) {
                                                        // Crear una clave única para controlar las sumas de cada trimestre para cada resultado de aprendizaje
                                                        $controlKey = $executedQuarter . '-' . $learning_outcome_id . '-' . $competency;

                                                        // Inicializar el control si no existe
                                                        if (!isset($sumControl[$controlKey])) {
                                                            $sumControl[$controlKey] = false; // Inicializar el control
                                                        }

                                                        // Sumar horas ejecutadas solo si el trimestre coincide o es diferente, y aún no se ha sumado
                                                        if (!$sumControl[$controlKey]) {
                                                            // Si el trimestre ejecutado es el mismo que el planeado
                                                            if ($trimestre->quarter_number == $executedQuarter) {
                                                                // Sumar horas solo para el trimestre y resultado de aprendizaje específico
                                                                $totalExecutedHoursCompetency += $executedHoursCompetency[$executedQuarter][$learning_outcome_id][$competency];
                                                            } elseif ($trimestre->quarter_number != $executedQuarter) {
                                                                // Si el trimestre ejecutado es diferente, sumar las horas correctamente
                                                                $totalExecutedHoursCompetency += $executedHoursCompetency[$executedQuarter][$learning_outcome_id][$competency];
                                                            }
                                                            // Marcar que la suma ya fue realizada para este resultado y trimestre específico
                                                            $sumControl[$controlKey] = true;
                                                        }
                                                    }
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
                                            @endphp
                                            @if($trimestre && $trimestre->training_project->courses->contains('id', $course_id))
                                                @php
                                                    $trimestreHours = $trimestre->hour;
                                                    $totalHoursByQuarter[$i] += $trimestreHours;
                                                    $personList = []; // Array para almacenar los nombres de las personas
                                                    foreach ($trimestre->learning_outcome->instructor_program_outcomes as $outcome) {
                                                        if ($outcome->instructor_program->course_id == $course_id) {
                                                            foreach ($outcome->instructor_program->instructor_program_people as $p) {
                                                                // Añadir la persona a la lista si no está ya en ella
                                                                if (!in_array($p->person->full_name, $personList)) {
                                                                    $personList[] = $p->person->full_name;
                                                                }
                                                            }
                                                        }
                                                    }

                                                    // Verificamos si hay más de una persona para el resultado correspondiente
                                                    if (count($personList) > 1) {
                                                        // Convertimos el array de personas en una cadena separada por comas
                                                        $person = implode(', ', $personList);
                                                    } else {
                                                        // Si solo hay una persona, mostramos solo esa
                                                        $person = count($personList) == 1 ? $personList[0] : 'No hay personas asignadas';
                                                    }
                                                    debug($person);
                                                    // Horas ejecutadas, si existen, independientemente del trimestre
                                                    $trimestreExecutedHours = isset($executedHours[$i][$learningOutcome]) ? $executedHours[$i][$learningOutcome] : 0;
                                                    $totalExecutedHoursByQuarter[$i] += $trimestreExecutedHours;
                                                @endphp
                                                <td>{{ $trimestreHours }}</td>
                                                <td class="celdae" title="{{ $person }}">{{ $trimestreExecutedHours > 0 ? $trimestreExecutedHours : '' }}</td>
                                            @else
                                                <td></td>
                                                @php
                                                    $personList = []; // Array para almacenar los nombres de las personas
                                                    foreach ($instructor_programs as $program) {
                                                        foreach ($program->instructor_program_outcomes as $outcome) {
                                                            if ($program->course_id == $course_id && $outcome->learning_outcome->name == $learningOutcome) {
                                                                foreach ($program->instructor_program_people as $p) {
                                                                    // Añadir la persona a la lista si no está ya en ella
                                                                    if (!in_array($p->person->full_name, $personList)) {
                                                                        $personList[] = $p->person->full_name;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }

                                                    // Verificamos si hay más de una persona para el resultado correspondiente
                                                    if (count($personList) > 1) {
                                                        // Convertimos el array de personas en una cadena separada por comas
                                                        $person = implode(', ', $personList);
                                                    } else {
                                                        // Si solo hay una persona, mostramos solo esa
                                                        $person = count($personList) == 1 ? $personList[0] : 'No hay personas asignadas';
                                                    }
                                                    $trimestreExecutedHours = isset($executedHours[$i][$learningOutcome]) ? $executedHours[$i][$learningOutcome] : 0;
                                                    $totalExecutedHoursByQuarter[$i] += $trimestreExecutedHours;
                                                @endphp
                                                
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