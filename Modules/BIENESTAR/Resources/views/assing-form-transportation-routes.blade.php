@extends('bienestar::layouts.master')

@section('content')
<div class="container-fluid">
    <h1>{{ trans('bienestar::menu.Management and Assignment of Transportation Routes')}} <i class="fas fa-bus" style="color: #000000;"></i></h1>

    <div class="row justify-content-md-center pt-4">
        <!-- Aquí comienza la tabla de rutas -->
        <div class="row justify-content-md-center pt-4">
                

                <div class="card shadow col-md-12">
                    
                    <div class="card-body">
                <table id="routesTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ trans('bienestar::menu.Routing Number')}}</th>
                            <th>{{ trans('bienestar::menu.Quotas')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($routesTransportations as $route)
                            <tr id="route_row_{{ $route->id }}">
                                <td>{{ $route->route_number }} - {{ $route->name_route }}</td>
                                <td class="quota-cell">{{ $route->quota }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        </div>

        <!-- Aquí termina la tabla de rutas -->
        <div class="row justify-content-md-center pt-4">
           
                <div class="card shadow col-md-12">
                    <div class="card-body">

                    @if(Auth::user()->havePermission('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.updateInline.assing_form_transportation_routes'))
                    <form id="update-benefit-status-form" action="{{ route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.updateInline.assing_form_transportation_routes') }}" method="POST">
                        @csrf
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ trans('bienestar::menu.Benefits')}}</th>
                                    <th>{{ trans('bienestar::menu.Convocation')}}</th>
                                    <th>{{ trans('bienestar::menu.Apprentice')}}</th>
                                    <th>{{ trans('bienestar::menu.Number Document')}}</th>
                                    <th>{{ trans('bienestar::menu.Municipality of Residence')}}</th>
                                    <th>{{ trans('bienestar::menu.Transportation Route')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($postulationsBenefits as $postulationBenefit)
                                    @if ($postulationBenefit->state == 'Beneficiario')
                                        <tr class="benefit-row">
                                            <td>{{ $loop->iteration}}</td>
                                            <td>{{ $postulationBenefit->benefit->name }}</td>
                                            <td>
                                                @if ($postulationBenefit->postulation && $postulationBenefit->postulation->convocation)
                                                    {{ $postulationBenefit->postulation->convocation->name }}
                                                @else
                                                    Sin Convocatoria
                                                @endif
                                            </td>
                                            
                                            <td>
                                                @if ($postulationBenefit->postulation && $postulationBenefit->postulation->apprentice && $postulationBenefit->postulation->apprentice->person)
                                                    {{ $postulationBenefit->postulation->apprentice->person->first_name }}
                                                    {{ $postulationBenefit->postulation->apprentice->person->first_last_name }}
                                                    {{ $postulationBenefit->postulation->apprentice->person->second_last_name }}
                                                @else
                                                    Aprendiz no encontrado
                                                @endif
                                            </td>
                                            <td>
                                                @if ($postulationBenefit->postulation && $postulationBenefit->postulation->apprentice && $postulationBenefit->postulation->apprentice->person)
                                                    {{ $postulationBenefit->postulation->apprentice->person->document_number }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $lugarEncuentro = null;
                                                    $pregunta = $postulationBenefit->postulation->answers
                                                        ->where('question.questions', 'Municipio o Ciudad en la que vive')
                                                        ->first();
                                                
                                                    if ($pregunta) {
                                                        $lugarEncuentro = $pregunta->answer;
                                                    }
                                                @endphp
                                            
                                                @if ($lugarEncuentro)
                                                    {{ $lugarEncuentro }}
                                                @else
                                                    Sin respuesta
                                                @endif
                                            </td>
                                            <td>
                                                <ul>
                                                    @foreach ($routesTransportations as $route)
                                                    <li>
                                                        <label class="radio-container">
                                                            <input
                                                                id="radio_route_{{ $postulationBenefit->id }}_{{ $route->id }}"
                                                                class="radio-route"
                                                                type="radio"
                                                                name="routes[{{ $postulationBenefit->id }}]"
                                                                value="{{ $route->id }}"
                                                                data-apprentice-id="{{ $postulationBenefit->postulation->apprentice_id }}"
                                                                data-postulation-benefit-id="{{ $postulationBenefit->id }}"
                                                                data-route-id="{{ $route->id }}"
                                                                {{ $assignments->where('apprentice_id', $postulationBenefit->postulation->apprentice_id)->where('postulation_benefit_id', $postulationBenefit->id)->where('route_transportation_id', $route->id)->isNotEmpty() ? 'checked' : '' }}
                                                            >
                                                            <span class="radio" for="radio_route_{{ $postulationBenefit->id }}_{{ $route->id }}"></span>
                                                            {{ $route->route_number }} - {{ $route->name_route }}
                                                        </label>
                                                    </li>
                                                @endforeach
                                                </ul>
                                            </td>
                                                                                                  
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                    @endif
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
    $(document).ready(function() {
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        $('.radio-route').on('change', function() {
            const $radio = $(this);
            const isChecked = $radio.is(':checked');
            const apprenticeId = $radio.data('apprentice-id');
            const routeTransportationId = $radio.data('route-id');
            const postulationBenefitId = $radio.data('postulation-benefit-id');

            // Realizar la solicitud AJAX para actualizar o crear el registro
            $.ajax({
                url: '{{ route('bienestar.' . getRoleRouteName(Route::currentRouteName()) . '.updateInline.assing_form_transportation_routes') }}',
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    apprentice_id: apprenticeId,
                    route_transportation_id: routeTransportationId,
                    postulation_benefit_id: postulationBenefitId,
                    checked: isChecked,
                },
                success: function(response) {
                    // Mostrar SweetAlert en función de la respuesta del servidor
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: "{{ trans('bienestar::menu.Success!') }}",
                            text: response.success,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            // Después de realizar la asignación o desasignación, actualizar la tabla
                            $('#routesTable').load(window.location.href + ' #routesTable');
                        });
                    } else if (response.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.error,
                            showConfirmButton: true
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: "{{ trans('bienestar::menu.An error occurred while trying to save records.') }}",
                            showConfirmButton: true
                        });
                    }
                },
                error: function(error) {
                    console.error(error);
                    // Mostrar SweetAlert de error en caso de problemas
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: "{{ trans('bienestar::menu.An error occurred while trying to save records.') }}",
                        showConfirmButton: true
                    });
                }
            });
        });
    });
</script>

@endsection