@extends('sigac:layouts.master')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12"> {{-- Inicio Trimestralización --}}
                <div class="card card-blue card-outline shadow">
                    <div class="card-header">
                        <h3 class="card-title">Trimestralización</h3>
                    </div>
                    <div class="card-body">
                        <div>
                            <div class="table-responsive">
                                <table id="quarterlies" class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Competencia</th>
                                            <th class="text-center">Resultado de Aprendizaje</th>
                                            <th class="text-center">Horas</th>
                                            <th class="text-center">Perfil</th>
                                            <th class="text-center">Agregar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for($trimestreNumber = 1; $trimestreNumber <= $courseNumber; $trimestreNumber++)
                                            <tr class="quarter">
                                                <td colspan="4" class="text-center"><b>Trimestre {{ $trimestreNumber }}</b></td>
                                                <td colspan="1" class="text-center">
                                                    <a data-toggle="modal" data-target="#addTrimestralizacion" data-trimestre="{{ $trimestreNumber }}" onclick="">
                                                        <b class="text-success" data-toggle="tooltip" data-placement="top" title="">
                                                            <i class="fas fa-plus-circle"></i>
                                                        </b>
                                                    </a>
                                                </td>
                                            </tr>
                                            @foreach($quarterlies as $competency => $trimestres)
                                                @foreach($trimestres->where('quarter_number', $trimestreNumber) as $trimestre)
                                                    <tr>
                                                        @if($loop->first)
                                                            <td rowspan="{{ $trimestres->count() }}" class="text-center">{{ $competency }}</td>
                                                        @endif
                                                        <td class="">{{ $trimestre->learning_outcome->name }}</td>
                                                        <td class="text-center">{{ $trimestre->learning_outcome->hour }}</td>
                                                        @if (count($trimestre->learning_outcome->people) > 0)
                                                        <td class="text-center">
                                                            @foreach($trimestre->learning_outcome->competencie->professions as $profession)
                                                                {{ $profession->name }} <br>
                                                                <br>
                                                            @endforeach
                                                        </td>
                                                        @else
                                                            <td></td>
                                                        @endif
                                                        
                                                        <td class="text-center">
                                                            <div class="opts">
                                                                <a class="delete-quarterlie" data-quarterlie-id="{{ $trimestre->id }}">
                                                                    <b class="text-danger" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </b>
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <form id="delete-quarterlie-form-{{ $trimestre->id }}"
                                                            action="{{ route('sigac.academic_coordination.curriculum_planning.quarterlie.destroy', ['id' => $trimestre->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                        </form>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> {{-- Fin Trimestralización --}}
        </div>
    </div>
</div>
@endsection