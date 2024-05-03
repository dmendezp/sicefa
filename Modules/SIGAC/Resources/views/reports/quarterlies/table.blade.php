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
                                <th class="text-center">{{ $trimestreNumber }}</th>
                            @endfor
                            <th class="text-center">Perfil</th>
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
                                            <td class="text-center">{{ $trimestre->learning_outcome->hour }}</td>
                                        @else
                                            <td></td>
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
