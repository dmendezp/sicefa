@extends('bienestar::layouts.master')

@section('content')
<div class="container">
    <h1>{{ trans('bienestar::menu.Application Management')}} <i class="far fa-smile" style="color: #000000;"></i></h1>
    <div class="container" >
        <div class="quota-box">
            <div class="quota-info">
                <p>
                    {{ trans('bienestar::menu.Food Quotas') }}:
                    <span class="quota-number @if($convocation->food_quotas > 20) green @elseif($convocation->food_quotas > 0) orange @else red @endif">{{ $convocation->food_quotas }}</span>
        
                    {{ trans('bienestar::menu.Transportation Quotas') }}:
                    <span class="quota-number @if($convocation->transport_quotas > 20) green @elseif($convocation->transport_quotas > 0) orange @else red @endif">{{ $convocation->transport_quotas }}</span>
                </p>
            </div>
        </div>
        
        <div class="row justify-content-md-center pt-4">
            <div class="card shadow col-md-12">
                <div class="card-body">
                    @if(Auth::user()->havePermission('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.update-benefits.postulation-management'))
                    <form id="update-benefit-status-form" action="{{ route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.update-benefits.postulation-management') }}" method="POST">
                        @csrf
                        <table id="benefitsTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ trans('bienestar::menu.Select')}}</th> 
                                    <th>{{ trans('bienestar::menu.Apprentice Name')}}</th>
                                    <th>{{ trans('bienestar::menu.Convocation')}}</th>
                                    <th>{{ trans('bienestar::menu.Benefit to which you are applying')}}</th>
                                    <th>{{ trans('bienestar::menu.Application Status')}}</th>
                                    <th>{{ trans('bienestar::menu.Application Score')}}</th>
                                    <th>{{ trans('bienestar::menu.Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($postulations as $postulation)
                                @php
                                    $benefitState = '';
                                    foreach($postulation->postulationBenefits as $postulationBenefit) {
                                        if ($postulationBenefit->state === 'Beneficiario') {
                                            $benefitState = 'Beneficiario';
                                            break;
                                        }
                                    }
                                @endphp
                                @if ($benefitState !== 'Beneficiario')
                                <tr data-id="{{ $postulation->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <label class="container_management">
                                            <input type="checkbox" class="benefit-checkbox_management" name="selected_postulations[]" value="{{ $postulation->id }}" onchange="guardarSeleccion(this)">
                                            <div class="checkmark_management"></div>
                                        </label>
                                    </td>
                                    
                                    <td>{{ $postulation->apprentice->person->full_name }}</td>
                                    <td>{{ $postulation->convocation->name }} - {{ $postulation->convocation->description }}</td>
                                    <td>
                                        @php
                                            $transportationBenefit = $postulation->transportation_benefit;
                                            $feedBenefit = $postulation->feed_benefit;
                                        @endphp
                                    
                                        @if ($transportationBenefit == 1)
                                            <span>Transporte</span>
                                        @endif
                                    
                                        @if ($feedBenefit == 1)
                                            <span>Alimentación</span>
                                        @endif
                                    
                                        @if ($transportationBenefit == 0 && $feedBenefit == 0)
                                            {{ trans('bienestar::menu.Not available') }}
                                        @endif
                                    </td>
                                    
                                    
                                    <td>
                                        @foreach($postulation->postulationBenefits as $postulationBenefit)
                                            <span>{{ $postulationBenefit->state }}</span><br>
                                        @endforeach
                                    </td>
                                    
                                    <td>{{ $postulation->total_score }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal_{{ $postulation->id }}">
                                            {{ trans('bienestar::menu.View Details')}}
                                        </button>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" id="guardarBtn" class="btn btn-success btn-block">{{ trans('bienestar::menu.Save Records')}}</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@foreach($postulations as $postulation)
<!-- Modal de detalles de postulación -->
@if(Auth::user()->havePermission('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.show.postulation-management'))
<div class="modal fade" id="modal_{{ $postulation->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel_{{ $postulation->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel_{{ $postulation->id }}">{{ trans('bienestar::menu.Application Details')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>{{ trans('bienestar::menu.Apprentice Name')}}:</strong> {{ $postulation->apprentice->person->full_name }}</p>
                <p><strong>{{ trans('bienestar::menu.Convocation')}}:</strong> {{ $postulation->convocation->name }} - {{ $postulation->convocation->description }}</p>

                <p><strong>{{ trans('bienestar::menu.Form Responded')}}:</strong></p>
                <ul>
                    @foreach($questions as $question)
                    <li>
                        <strong>{{ trans('bienestar::menu.Question')}}:</strong> {{ $question->question }}<br>
                        <div class="answer-container">
                            @php
                            $answer = $postulation->answers->where('questions_id', $question->id)->first();
                            @endphp
                            <div class="answer">
                                @if ($answer)
                                {{ $answer->answer }}
                                @else
                                {{ trans('bienestar::menu.Not Answered')}}
                                @endif
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>


                <p><strong>{{ trans('bienestar::menu.Total Score')}}:</strong> <span id="total-score_{{ $postulation->id }}">{{ $postulation->total_score }}</span></p>

                <div class="form-group">
                    @if(Auth::user()->havePermission('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.update-score.postulation-management'))
                    <form id="update-benefit-status-form" action="{{ route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.update-score.postulation-management', ['id' => $postulation->id]) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Agrega esta línea para enviar una solicitud PUT -->
                        <div class="form-group">
                            <label for="new-score">{{ trans('bienestar::menu.New Score')}}:</label>
                            <input type="number" class="form-control" name="new-score" id="new-score" required>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ trans('bienestar::menu.Save Score')}}</button>
                    </form>
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
    // Define las cuotas iniciales
    const initialFoodQuotas = {{ $convocation->food_quotas }};
    const initialTransportQuotas = {{ $convocation->transport_quotas }};

    document.addEventListener("DOMContentLoaded", function () {
        const selectAllButton = document.getElementById('select-all-button');
        const selectAllCheckbox = document.getElementById('select-all-checkbox');
        const checkboxes = document.querySelectorAll('.benefit-checkbox');
        const foodQuotasDisplay = document.getElementById('food-quotas');
        const transportQuotasDisplay = document.getElementById('transport-quotas');
        const guardarBtn = document.getElementById('guardarBtn');
        const foodQuotasLimit = initialFoodQuotas;
        const transportQuotasLimit = initialTransportQuotas;

        // Inicializa las cuotas disponibles y límites
        let foodQuotas = initialFoodQuotas;
        let transportQuotas = initialTransportQuotas;
        let foodQuotasSelected = 0;
        let transportQuotasSelected = 0;

        function updateQuotasDisplay() {
            foodQuotasDisplay.textContent = foodQuotas;
            transportQuotasDisplay.textContent = transportQuotas;
        }

        function isQuotaAvailable(checkbox) {
            const benefitType = checkbox.getAttribute('data-benefit-type');
            if (benefitType === 'food') {
                return foodQuotas > 0;
            } else if (benefitType === 'transport') {
                return transportQuotas > 0;
            }
            return false;
        }

        function updateCheckboxState(checkbox) {
            const available = isQuotaAvailable(checkbox);
            checkbox.disabled = !available;

            if (!available) {
                checkbox.checked = false;
            }
        }

        function calculateSelectedQuotas() {
            let foodSelected = 0;
            let transportSelected = 0;

            checkboxes.forEach(function (checkbox) {
                if (checkbox.checked) {
                    const benefitType = checkbox.getAttribute('data-benefit-type');
                    if (benefitType === 'food') {
                        foodSelected++;
                    } else if (benefitType === 'transport') {
                        transportSelected++;
                    }
                }
            });

            return { foodSelected, transportSelected };
        }

        function updateQuotasBasedOnSelection() {
            const selectedQuotas = calculateSelectedQuotas();

            // Actualiza las cuotas disponibles en base a la selección actual
            foodQuotas = initialFoodQuotas - selectedQuotas.foodSelected;
            transportQuotas = initialTransportQuotas - selectedQuotas.transportSelected;

            // Actualiza el contador de cuotas seleccionadas
            foodQuotasSelected = selectedQuotas.foodSelected;
            transportQuotasSelected = selectedQuotas.transportSelected;

            // Si las cuotas se agotan, deshabilita los checkboxes restantes
            checkboxes.forEach(function (checkbox) {
                if (!isQuotaAvailable(checkbox)) {
                    checkbox.disabled = true;
                }
            });
        }

        function showWarningMessage(message) {
            const warningMessageDiv = document.getElementById('warning-message');
            warningMessageDiv.innerHTML = message;
        }

        updateQuotasDisplay();

        selectAllButton.addEventListener('click', function () {
            checkboxes.forEach(function (checkbox) {
                if (!isQuotaAvailable(checkbox)) {
                    return;
                }

                checkbox.checked = true;
                updateCheckboxState(checkbox);
            });

            updateQuotasBasedOnSelection();
            updateQuotasDisplay();
        });

        selectAllCheckbox.addEventListener('change', function () {
            checkboxes.forEach(function (checkbox) {
                if (isQuotaAvailable(checkbox)) {
                    checkbox.checked = selectAllCheckbox.checked;
                    updateCheckboxState(checkbox);
                }
            });

            updateQuotasBasedOnSelection();
            updateQuotasDisplay();
        });

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                if (!isQuotaAvailable(checkbox)) {
                    checkbox.checked = false;
                    showWarningMessage("Se ha superado el límite de cuotas seleccionadas");
                    return;
                }

                updateCheckboxState(checkbox);
                showWarningMessage(""); // Borra el mensaje de advertencia

                selectAllCheckbox.checked = [...checkboxes].every(cb => cb.checked);

                updateQuotasBasedOnSelection();
                updateQuotasDisplay();
            });
        });

        function showWarningMessage(message) {
    const warningMessageDiv = document.getElementById('warning-message');
    warningMessageDiv.innerHTML = message;
}

// ...

guardarBtn.addEventListener('click', function () {
    if (foodQuotasSelected > foodQuotasLimit || transportQuotasSelected > transportQuotasLimit) {
        showWarningMessage("Se ha superado el límite de cuotas seleccionadas");

        // Prepara los datos para enviar como JSON
        const warningData = {
            message: "Se ha superado el límite de cuotas seleccionadas",
            type: "warning"
        };

        // Realiza una solicitud AJAX para enviar los datos al controlador

        axios.post('{{ route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.update-benefits.postulation-management') }}', warningData)
            .then(function (response) {
                // Verifica la respuesta del controlador y realiza acciones adicionales si es necesario
                if (response.data.warning) {
                    // Manejar la advertencia
                } else if (response.data.success) {
                    // Manejar el éxito
                }
            })
            .catch(function (error) {
                // Manejar errores en la solicitud AJAX
            });

        return;
    }


    // Realiza la llamada AJAX al controlador para guardar los registros
    // Aquí puedes implementar tu lógica para enviar los datos al servidor
    // Por ejemplo, utilizando fetch o axios.

    // Una vez se hayan guardado los registros con éxito, puedes redirigir o mostrar un mensaje.
});
    });
</script>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const filas = document.querySelectorAll('tr');

            filas.forEach(function (fila) {
                const estados = fila.querySelectorAll('.estado-columna'); // Ajusta el selector según tu estructura HTML
                let ocultar = true;

                estados.forEach(function (estado) {
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
@endsection
