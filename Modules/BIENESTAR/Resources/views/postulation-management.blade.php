@php
$role_name = getRoleRouteName(Route::currentRouteName());
@endphp

@extends('bienestar::layouts.master')

@section('content')
<div class="container">
    <h1>{{ trans('bienestar::menu.Application Management') }} <i class="far fa-smile" style="color: #000000;"></i></h1>
    <div class="container">
        <div class="quota-box">
            <div class="quota-info">
                <h1>
                    @foreach ($convocations as $convocation)
                    <td>{{ $convocation->name }} - {{ $convocation->description }}</td>
                    <p>
                        {{ trans('bienestar::menu.Food Quotas') }}:
                        <span class="quota-number @if ($convocation->food_quotas > 20) green @elseif($convocation->food_quotas > 0) orange @else red @endif">{{ $convocation->food_quotas }}</span>

                        {{ trans('bienestar::menu.Transportation Quotas') }}:
                        <span class="quota-number @if ($convocation->transport_quotas > 20) green @elseif($convocation->transport_quotas > 0) orange @else red @endif">{{ $convocation->transport_quotas }}</span>
                    </p>
                    @endforeach
                </h1>
            </div>
        </div>

        <div class="row justify-content-md-center pt-4">
            <div class="card shadow col-md-12">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="benefitsTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>{{ trans('bienestar::menu.Apprentice Name') }}</th>
                                    <th>{{ trans('bienestar::menu.Benefit to which you are applying') }}</th>
                                    <th>{{ trans('bienestar::menu.Select') }}</th>
                                    <th>{{ trans('bienestar::menu.State and profit') }}</th>
                                    <th>{{ trans('bienestar::menu.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($postulation as $postulation)
                                <tr>
                                    <form action="{{ route('bienestar.admin.update-benefits.postulation-management')}}" method="post" class="formGuardar">
                                        @csrf
                                        <td>{{ $postulation->first_name }} {{ $postulation->first_last_name }} {{ $postulation->second_last_name }}
                                            <input type="hidden" class="postulation_id" name="postulation_id" value="{{ $postulation->id}}">
                                        </td>
                                        <td>
                                            @if ($postulation->transportation_benefit == 1)
                                            Transporte
                                            @endif <br>
                                            @if ($postulation->feed_benefit == 1)
                                            Alimentación
                                            @endif
                                        </td>
                                        <td>
                                            @if ($postulation->transportation_benefit == 1)
                                            <select class="form-control" name="benefit_id_transport" id="benefit_id_transport_{{ $postulation->id }}" required>
                                                <option value="">Seleccione el beneficio</option>
                                                @foreach ($benefits as $benefit)
                                                @if ($benefit->name == 'Transporte')
                                                <option value="{{ $benefit->id }}">{{ $benefit->name }} {{ $benefit->porcentege }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @endif
                                            <br>
                                            @if ($postulation->feed_benefit == 1)
                                            <select class="form-control" name="benefit_id_food" id="benefit_id_food_{{ $postulation->id }}" required>
                                                <option value="">Seleccione el beneficio</option>
                                                @foreach ($benefits as $benefit)
                                                @if ($benefit->name == 'Alimentacion')
                                                <option value="{{ $benefit->id }}">{{ $benefit->name }} {{ $benefit->porcentege }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                @foreach ($postulationsbentfits as $pb)
                                                @if ($postulation->id == $pb->postulation_id)
                                                <input type="hidden" name="postulationsbentfits_id" value="{{ $pb->id}}">
                                                <div>
                                                    {{ $pb->state }}
                                                    @foreach ($benefits as $benefit)
                                                    @if ($benefit->id == $pb->benefit_id)
                                                    {{ $benefit->name }} {{ $benefit->porcentege}}%
                                                    @endif
                                                    @endforeach
                                                </div>
                                                @endif
                                                @endforeach
                                            </div>
                                        </td>

                                        <!-- Agrega esto donde estás mostrando tus filas de datos -->
                                        <td style="align-items: center">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <button type="button" class="btn btn-primary mx-2" data-toggle="modal" data-target="#myModal{{ $postulation->id }}">
                                                    Detalles
                                                </button>

                                                <button type="submit" class="btn btn-success mx-2">{{ trans('bienestar::menu.Save')}}</button>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="myModal{{ $postulation->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel">Detalles de la
                                                                Postulación</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>
                                                            <h5>Nombre:</h5> {{ $postulation->first_name }}
                                                            {{ $postulation->first_last_name }}
                                                            {{ $postulation->second_last_name }}
                                                            </p>

                                                            <!-- Preguntas y respuestas relacionadas -->
                                                            <h5>Preguntas de la Postulación</h5>
                                                            @foreach ($answers as $answer)
                                                            @if ($answer->postulation_id == $postulation->id)
                                                            <div class="form-group">
                                                                <label for="question">{{ $answer->question->question }}</label>
                                                                <input type="text" class="form-control col-md-4" name="answers[{{ $answer->question }}]" value="{{ $answer->answer }}" readonly>
                                                            </div>
                                                            @endif
                                                            @endforeach
                                                            <div class="form-group">
                                                                <label for="message">Mensaje</label>
                                                                <textarea class="form-control" id="exampleFormControlTextarea1" name="message" id="message" rows="3" required>
                                                                            @foreach ($postulationsbentfits as $pb)                                                                            
                                                                                @if ( $pb->postulation_id == $postulation->id )
                                                                                    {{ $pb->message }}
                                                                            @endif
                                                                            @endforeach
                                                                        </textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="message">Puntaje</label>
                                                                <input type="number" class="form-control" name="score" id="score" value="{{ $postulation->total_score }}" required>
                                                            </div>
                                                            @foreach ($postulationsbentfits as $pb)
                                                            <div class="form-group">
                                                                @if ($postulation->id == $pb->postulation_id)
                                                                <input type="hidden" name="postulationsbentfits_id" value="{{ $pb->id }}">
                                                                <a href="{{ route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.remove-benefit.postulation-management', ['postulationId' => $pb->postulation_id]) }}" class="btn btn-danger formEliminar">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </a>
                                                                @endif
                                                            </div>
                                                            @endforeach

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection