@extends('bienestar::layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-md-center pt-4">
        <div class="card card-green card-outline shadow col-md-16">
            <div class="card-header">
                <h3 class="card-title">Gestor de asignación de rutas</h3>
            </div>
            <div class="card-body">
                <div class="mtop16">
                    <form action="{{ route('cefa.bienestar.assing-form-transportation-routes.updateInline') }}" method="POST">
                        @csrf
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Beneficio</th>
                                    <th>Convocatoria</th>
                                    <th>Nombre del Postulado</th>
                                    <th>Número de Documento</th>
                                    <th>Lugar de Encuentro</th>
                                    <th>Rutas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($postulationsBenefits as $postulationBenefit)
                                    @if ($postulationBenefit->state == 'Beneficiado')
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
                                                        ->where('question.question', 'Municipio o Ciudad en la que vive')
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
                                                            <label class="checkbox-container">
                                                                <input
                                                                    id="checkbox_route_{{ $postulationBenefit->id }}_{{ $route->id }}"
                                                                    class="hidden checkbox-route"
                                                                    type="checkbox"
                                                                    name="routes[{{ $postulationBenefit->id }}][]"
                                                                    value="{{ $route->id }}"
                                                                    data-convocation-id="{{ $postulationBenefit->postulation->convocation_id }}"
                                                                    data-apprentice-id="{{ $postulationBenefit->postulation->apprentice->apprentice_id }}"
                                                                    data-postulation-benefit-id="{{ $postulationBenefit->id }}"
                                                                    data-route-id="{{ $route->id }}"
                                                                >
                                                                <span class="checkbox" for="checkbox_route_{{ $postulationBenefit->id }}_{{ $route->id }}"></span>
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
                        <button type="submit" class="btn btn-primary">Guardar Asignaciones</button>
                    </form>
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

        // Función para manejar el cambio en los checkboxes de filtro
        function handleBenefitFilterChange() {
            const selectedBenefits = [];
            $('input[name="benefit-filter"]:checked').each(function() {
                selectedBenefits.push($(this).val());
            });

            // Oculta todas las filas
            $('.benefit-row').hide();

            // Muestra solo las filas que coinciden con los beneficios seleccionados
            selectedBenefits.forEach(function(benefit) {
                $('.benefit-row').filter(function() {
                    return $(this).find('td:eq(3)').text() === benefit; // Ajusta el índice de la columna según tu estructura de tabla
                }).show();
            });
        }

        // Maneja el cambio en los checkboxes de filtro
        $('input[name="benefit-filter"]').change(function() {
            handleBenefitFilterChange();
        });

        // Añade el filtrado inicial al cargar la página
        handleBenefitFilterChange();

        // Resto de tu script existente
        $('.checkbox-route').on('change', function() {
            const $checkbox = $(this);
            const isChecked = $checkbox.is(':checked');
            const apprenticeId = $checkbox.data('apprentice-id');
            const routeTransportationId = $checkbox.data('route-transportation-id');
            const convocationId = $checkbox.data('convocation-id');

            // Crear o actualizar el registro en la tabla AssingTransportRoutes
            $.ajax({
                url: '{{ route('cefa.bienestar.assing-form-transportation-routes.updateInline') }}',
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    apprentice_id: apprenticeId,
                    route_transportation_id: routeTransportationId,
                    convocation_id: convocationId,
                    checked: isChecked,
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    });
</script>
@endsection