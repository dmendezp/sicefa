@extends('sigac::layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card card-blue card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">Novedades de Aprendices</h3>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="table-responsive">
                                    <table id="novelty" class="display table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">{{trans('Aprendiz')}}</th>
                                                <th class="text-center">{{trans('Instructor')}}</th>
                                                <th class="text-center">{{trans('Falta')}}</th>
                                                <th class="text-center">{{trans('Tipo')}}</th>
                                                <th class="text-center">{{trans('Observacion')}}</th>
                                                <th class="text-center">{{trans('Acciones')}}</th>
                                            </tr>   
                                        </thead>
                                        <tbody>
                                            @foreach ($apprentice_novelties as $apprentice_noveltie)      
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td class="text-center">{{ $apprentice_noveltie->apprentice->person->fullname }}</td>
                                                    <td class="text-center">{{ $apprentice_noveltie->person->fullname }}</td>
                                                    <td class="text-center">{{ $apprentice_noveltie->missing_committee->name }} - {{ $apprentice_noveltie->missing_committee->type }}</td>
                                                    <td class="text-center">{{ $apprentice_noveltie->type }}</td>
                                                    <td class="text-center">
                                                        @if ($apprentice_noveltie->learningoutcomecommittees()->exists())
                                                            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#learning{{$apprentice_noveltie->id}}">
                                                                <i class="fa-solid fa-clipboard-list"></i>
                                                            </button>
                                                            @include('sigac::committee.apprentice_novelty.learning')
                                                        @endif
                                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#observation{{$apprentice_noveltie->id}}">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </td>
                                                    <td class="text-center">
                                                        @if($apprentice_noveltie->evaluation_committees->isNotEmpty() && $apprentice_noveltie->state != 'Resuelta' && $apprentice_noveltie->state != 'Plan Mejoramiento')
                                                            <a class="btn btn-success" href="{{ route('sigac.academic_coordination.committee.answer.create', ['id' => $apprentice_noveltie->id]) }}">Responder</a>
                                                        @else
                                                            @switch($apprentice_noveltie->state)
                                                                @case('Pendiente')
                                                                        <a class="btn btn-primary" href="{{ route('sigac.academic_coordination.committee.create', ['id' => $apprentice_noveltie->id]) }}">Realizar Seguimiento</a>
                                                                    @break
                                                                @case('Resuelta')
                                                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#answerd{{$apprentice_noveltie->id}}">Resuelta</button>
                                                                    @break
                                                                @default
                                                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#improvement{{$apprentice_noveltie->id}}">Plan Mejoramiento</button>
                                                            @endswitch
                                                        @endif
                                                    </td>
                                                </tr>
                                                @include('sigac::committee.apprentice_novelty.observation')
                                                @include('sigac::committee.apprentice_novelty.improvement')
                                                @include('sigac::committee.apprentice_novelty.answerd')
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#novelty').DataTable({}); 
    });

</script>   