@extends('hdc::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hdc::calculatefootprint.Indicator_Calculate_Your_Footprint') }} </li>
@endpush

@section('content')
    <div class="col-md-12">
        <div class="card card-success card-outline shadow mt-2">
            <div class="card-header">
                <h2 class="card-title">
                    <strong>{{ $person->full_name }}
                        {{ trans('hdc::calculatefootprint.Title_Card_Registration_Personal_Aspect') }}
                    </strong>
                </h2>
            </div>
            <br>
            <div class="container">
                <div class="table-responsive">
                    <form method="post" action="{{ route('Carbonfootprint.save_consumption') }}">

                        @csrf
                        <input type="hidden" name="person_id" value="{{ $person->id }}">

                        <table class="table table-bordered table-hover" id="myTableform">
                            <thead class="table-dark">
                                <tr>
                                    <th>{{ trans('hdc::ConsumptionRegistry.Title_Heading_Table_Column1') }}</th>
                                    <th>{{ trans('hdc::ConsumptionRegistry.Title_Heading_Table_Column2') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($environmentalAspects as $aspectId => $aspectName)
                                    <tr>
                                        <td>
                                            <input type="hidden" name="aspecto[{{ $aspectId }}][id_aspecto]"
                                                value="{{ $aspectId }}">
                                            {{ $aspectName }}
                                        </td>
                                        <td>
                                            <input name="aspecto[{{ $aspectId }}][valor_consumo]" class="form-control"
                                                type="number" placeholder="Ingrese el valor de consumo" required>
                                            @if ($errors->has("aspecto.$aspectId.valor_consumo"))
                                                <span
                                                    class="text-danger">{{ $errors->first("aspecto.$aspectId.valor_consumo") }}required></span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-around">
                            <button type="submit" class="btn btn-success"
                                id="submitBtn">{{ trans('hdc::ConsumptionRegistry.Btn_Save') }}</button>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).on("click", "#submitBtn", function(event) {

                var valid = true;

                // Iterar sobre los campos de valor_consumo
                $('[name^="aspecto["][name$="[valor_consumo]"]').each(function() {
                    var valorConsumo = $(this).val();

                    // Validar que el valor sea numérico y positivo
                    if (!$.isNumeric(valorConsumo) || parseFloat(valorConsumo) < 0) {
                        valid = false;
                        // Utiliza SweetAlert para mostrar el mensaje de error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Ingrese un valor numérico y positivo para todos los aspectos.'
                        });
                        return false; // Detener la iteración
                    }
                });

                // Verificar que todos los campos estén completos
                $('[name^="aspecto["][name$="[valor_consumo]"]').each(function() {
                    if ($(this).val() === '') {
                        valid = false;
                        // Utiliza SweetAlert para mostrar el mensaje de error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Complete todos los campos de valor de consumo antes de enviar el formulario.'
                        });
                        return false; // Detener la iteración
                    }
                });

                // Si la validación no es exitosa, detener el envío del formulario y mostrar la alerta correspondiente
                if (!valid) {
                    event.preventDefault();
                } else {
                    // validación es exitosa
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: 'Formulario enviado exitosamente.'
                    });
                }
            });

            // Agregar validación específica para campo numérico
            $('[name^="aspecto["][name$="[valor_consumo]"]').on('input', function() {
                var valorConsumo = $(this).val();

                // Validar que el valor sea numérico y positivo
                if (!$.isNumeric(valorConsumo) || parseFloat(valorConsumo) < 0) {
                    // Utiliza SweetAlert para mostrar el mensaje de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ingrese un valor numérico y positivo para este aspecto.'
                    });
                }
            });
        </script>
    @endpush
@endsection