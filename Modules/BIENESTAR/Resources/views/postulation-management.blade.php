@extends('bienestar::layouts.master')

@section('content')
    <div class="container">
        <h1>{{ trans('bienestar::menu.Application Management') }} <i class="far fa-smile" style="color: #000000;"></i></h1>
        <div class="container">
            <div class="quota-box">
                <div class="quota-info">
                    <h1>
                        <td>{{ $convocation->name }} - {{ $convocation->description }}</td>
                    </h1>
                    <p>
                        {{ trans('bienestar::menu.Food Quotas') }}:
                        <span
                            class="quota-number @if ($convocation->food_quotas > 20) green @elseif($convocation->food_quotas > 0) orange @else red @endif">{{ $convocation->food_quotas }}</span>

                        {{ trans('bienestar::menu.Transportation Quotas') }}:
                        <span
                            class="quota-number @if ($convocation->transport_quotas > 20) green @elseif($convocation->transport_quotas > 0) orange @else red @endif">{{ $convocation->transport_quotas }}</span>
                    </p>
                </div>
            </div>

            <div class="row justify-content-md-center pt-4">
                <div class="card shadow col-md-12">
                    <div class="card-body">
                        <table id="benefitsTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>{{ trans('bienestar::menu.Apprentice Name') }}</th>
                                    <th>{{ trans('bienestar::menu.Benefit to which you are applying') }}</th>
                                    <th>{{ trans('bienestar::menu.Select') }}</th>
                                    <th>{{ trans('bienestar::menu.Application Score') }}</th>
                                    <th>{{ trans('bienestar::menu.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($postulations as $postulation)
                                    @php
                                        $benefitState = '';
                                        $transportationBenefit = $postulation->transportation_benefit;
                                        $feedBenefit = $postulation->feed_benefit;
                                    @endphp
                                    @if ($benefitState !== 'Beneficiario')
                                        <tr data-id="{{ $postulation->id }}">



                                            <td>{{ $postulation->apprentice->person->full_name }}</td>
                                            <td style="width: 250px;">
                                                @if (($transportationBenefit == 1 || $feedBenefit == 1) && count($postulation->postulationBenefits) > 0)
                                                    @php $benefitsText = ''; @endphp
                                                    @foreach ($postulation->postulationBenefits as $postulationBenefit)
                                                        @if (
                                                            ($postulationBenefit->benefit->name == 'Transporte' && $transportationBenefit == 1) ||
                                                                ($postulationBenefit->benefit->name == 'Alimentacion' && $feedBenefit == 1))
                                                            @php $benefitsText .= $postulationBenefit->benefit->name . ' - ' . $postulationBenefit->state . '<br>'; @endphp
                                                        @endif
                                                    @endforeach
                                                    <span>{!! rtrim($benefitsText, '<br>') !!}</span>
                                                @elseif ($transportationBenefit == 0 && $feedBenefit == 0)
                                                    {{ trans('bienestar::menu.Not available') }}
                                                @endif
                                            </td>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <form id="update-benefit-status-form{{ $postulation->id }}"
                                                            class="update-benefit-form"
                                                            action="{{ route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.update-state-benefit.postulation-management', ['id' => $postulation->id]) }}"
                                                            method="POST"> @csrf
                                                            @csrf
                                                            <div class="form-group">
                                                                @if ($postulation->transportation_benefit == 1)
                                                                    <label
                                                                        for="transport_benefit_{{ $postulation->id }}">{{ trans('bienestar::menu.Transportation Benefit') }}:</label>
                                                                    <select class="form-control" name="transport_benefit"
                                                                        id="transport_benefit_{{ $postulation->id }}"
                                                                        onchange="this.form.submit()">
                                                                        <option value=""
                                                                            {{ $postulation->postulationBenefits->isEmpty() ? 'selected' : '' }}>
                                                                            {{ trans('bienestar::menu.Select Benefit') }}
                                                                        </option>
                                                                        @foreach ($benefits as $benefit)
                                                                            @if ($benefit->name == 'Transporte')
                                                                                <option value="{{ $benefit->id }}"
                                                                                    {{ $postulation->postulationBenefits->where('benefit_id', $benefit->id)->isNotEmpty() ? 'selected' : '' }}>
                                                                                    {{ $benefit->name }} -
                                                                                    {{ $benefit->porcentege }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                @endif
                                                            </div>

                                                            <div class="form-group">
                                                                @if ($postulation->feed_benefit == 1)
                                                                    <label
                                                                        for="food_benefit_{{ $postulation->id }}">{{ trans('bienestar::menu.Food Benefit') }}:</label>
                                                                    <select class="form-control" name="food_benefit"
                                                                        id="food_benefit_{{ $postulation->id }}"
                                                                        onchange="this.form.submit()">
                                                                        <option value=""
                                                                            {{ $postulation->postulationBenefits->isEmpty() ? 'selected' : '' }}>
                                                                            {{ trans('bienestar::menu.Select Benefit') }}
                                                                        </option>
                                                                        @foreach ($benefits as $benefit)
                                                                            @if ($benefit->name == 'Alimentacion')
                                                                                <option value="{{ $benefit->id }}"
                                                                                    {{ $postulation->postulationBenefits->where('benefit_id', $benefit->id)->isNotEmpty() ? 'selected' : '' }}>
                                                                                    {{ $benefit->name }} -
                                                                                    {{ $benefit->porcentege }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                @endif
                                                            </div>
                                                        </form>

                                                    </li>
                                                </ul>
                                            </td>





                                            <td>{{ $postulation->total_score }}</td>
                                            <td>
                                                <button type="button" class="btn btn-info" data-toggle="modal"
                                                    data-target="#modal_{{ $postulation->id }}">
                                                    {{ trans('bienestar::menu.View Details') }}
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($postulations as $postulation)
        <!-- Modal de detalles de postulación -->
        @if (Auth::user()->havePermission(
                'bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.show.postulation-management'))
            <div class="modal fade" id="modal_{{ $postulation->id }}" tabindex="-1" role="dialog"
                aria-labelledby="modalLabel_{{ $postulation->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel_{{ $postulation->id }}">
                                {{ trans('bienestar::menu.Application Details') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p><strong>{{ trans('bienestar::menu.Apprentice Name') }}:</strong>
                                {{ $postulation->apprentice->person->full_name }}</p>
                            <p><strong>{{ trans('bienestar::menu.Convocation') }}:</strong>
                                {{ $postulation->convocation->name }} - {{ $postulation->convocation->description }}</p>

                            <p><strong>{{ trans('bienestar::menu.Form Responded') }}:</strong></p>
                            <ul>
                                @foreach ($questions as $question)
                                    <li>
                                        <strong>{{ trans('bienestar::menu.Question') }}:</strong>
                                        {{ $question->question }}<br>
                                        <div class="answer-container">
                                            @php
                                                $answer = $postulation->answers->where('questions_id', $question->id)->first();
                                            @endphp
                                            <div class="answer">
                                                @if ($answer)
                                                    {{ $answer->answer }}
                                                @else
                                                    {{ trans('bienestar::menu.Not Answered') }}
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <!-- Agregar sección para mostrar archivos socioeconómicos -->
                            @if ($postulation->socioeconomicsupportfiles->isNotEmpty())
                                <h4>Archivos Socioeconómicos:</h4>
                                <div class="card-deck">
                                    @foreach ($postulation->socioeconomicsupportfiles as $file)
                                        <li class="card mb-3" style="max-width: 18rem;">
                                            <div class="card-body">
                                                @php
                                                    $extension = pathinfo($file->file_path, PATHINFO_EXTENSION);
                                                    $imageName = pathinfo($file->file_path, PATHINFO_FILENAME);
                                                    $filePath = asset('modules/bienestar/icons/' . $extension . '.svg');
                                                    $truncatedName = strlen($imageName) > 20 ? substr($imageName, 0, 20) . '...' : $imageName;
                                                @endphp

                                                <p>
                                                    <img src="{{ $filePath }}" alt="{{ $extension }} icon"
                                                        style="width: 40px; height: 40px;">
                                                    <strong class="card-title">{{ $truncatedName }}
                                                        ({{ $extension }})</strong>
                                                </p>

                                                <!-- Agregar el botón de descarga -->
                                                <a href="{{ asset($file->file_path) }}" download
                                                    class="btn btn-primary btn-sm">
                                                    Descargar
                                                </a>
                                            </div>
                                        </li>
                                    @endforeach
                                </div>
                            @else
                                <p>No hay archivos socioeconómicos asociados a esta postulación.</p>
                            @endif

                            <p><strong>{{ trans('bienestar::menu.Total Score') }}:</strong> <span
                                    id="total-score_{{ $postulation->id }}">{{ $postulation->total_score }}</span></p>

                            <div class="form-group">
                                @if (Auth::user()->havePermission(
                                        'bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.update-score.postulation-management'))
                                    <form id="update-benefit-status-form"
                                        action="{{ route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.update-score.postulation-management', ['id' => $postulation->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT') <!-- Agrega esta línea para enviar una solicitud PUT -->
                                        <div class="form-group">
                                            <label for="new-score">{{ trans('bienestar::menu.New Score') }}:</label>
                                            <input type="number" class="form-control" name="new-score" id="new-score"
                                                required>
                                        </div>
                                        <button type="submit"
                                            class="btn btn-primary">{{ trans('bienestar::menu.Save Score') }}</button>
                                    </form>
                                @endif
                            </div>
                            <!-- Nueva sección para detalles del beneficio No Beneficiario -->
                            @if ($noBeneficiaryBenefit = $postulation->postulationBenefits->where('state', 'No Beneficiario')->first())
                                <h4>Detalles del Beneficio No Beneficiario</h4>
                                @if (Auth::user()->havePermission(
                                        'bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.edit-benefit-detail.postulation-management'))
                                    <form id="update-benefit-status-form"
                                        {{ $postulationBenefit->id }}action="{{ route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.edit-benefit-detail.postulation-management', ['id' => $postulation->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label for="benefit_name">{{ trans('bienestar::menu.Benefit') }}</label>
                                            <input type="text" class="form-control" id="benefit_name"
                                                value="{{ $noBeneficiaryBenefit->benefit->name }}" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="message_edit">{{ trans('bienestar::menu.Message') }}</label>
                                            <textarea class="form-control" id="message_edit" name="edited_message">{{ $noBeneficiaryBenefit->message }}</textarea>
                                        </div>

                                        <button type="submit"
                                            class="btn btn-primary">{{ trans('bienestar::menu.Save Changes') }}</button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            </div>
        @endif
    @endforeach
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const filas = document.querySelectorAll('tr');

            filas.forEach(function(fila) {
                const estados = fila.querySelectorAll(
                '.estado-columna'); // Ajusta el selector según tu estructura HTML
                let ocultar = true;

                estados.forEach(function(estado) {
                    if (estado.textContent !== 'Beneficiario') {
                        ocultar = false;
                    }
                });

                if (ocultar) {
                    fila.classList.add('ocultar');
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('.form-control').on('change', function() {
                var form = $(this).closest('form');
                var url = form.attr('action');

                // Obtén el nombre del select cambiado
                var selectName = $(this).attr('name');

                // Define el estado y mensaje según el nombre del select
                var state, message;
                if (selectName === 'transport_benefit' || selectName === 'food_benefit') {
                    state = 'Beneficiario';
                    message = 'Felicidades, has sido aceptado para recibir el beneficio solicitado';
                }

                // Obtén los datos del formulario y agrega estado y mensaje
                var formData = form.serialize() + '&state=' + state + '&message=' + message;
                console.log(formData)
                // Envía la solicitud AJAX como POST
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    success: function(data) {
                        console.log('Beneficio actualizado con éxito');
                        // Puedes agregar más lógica aquí según tus necesidades
                    },
                    error: function(error) {
                        console.error('Error al actualizar el beneficio:', error.responseText);
                        // Puedes agregar más lógica aquí según tus necesidades
                    }
                });
            });
        });
    </script>



    <!-- Fuera del cuerpo del modal, al final del archivo o en una sección de scripts -->
    <!-- Fuera del cuerpo del modal, al final del archivo o en una sección de scripts -->
@endsection
