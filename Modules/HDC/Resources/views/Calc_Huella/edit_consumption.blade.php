@extends('hdc::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active"><a
            href="{{ route('cefa.hdc.carbonfootprint.persona' ) }}">{{ trans('hdc::calculatefootprint.Indicator_Calculate_Your_Footprint') }} </a>
        /{{ trans('hdc::ConsumptionRegistry.indicator_form_results_update') }}</li>
@endpush


@section('content')
    <div class="col-md-12">
        <div class="card card-success card-outline shadow mt-2">
            <div class="card-header">
                <h2 class="card-title"><strong>{{ trans('hdc::calculatefootprint.Title_Card_Carbon_Footprint_Table_Edit') }} {{ $fpf->person->full_name }}</strong></h2>
            </div>
            <br>
            <div class="container">


                <div class="table-responsive">
                    <form method="post" action="{{ route('cefa.hdc.carbonfootprint.update_consumption', ['id' => $fpf->id]) }}">
                        @csrf
                        @method('POST')
                        <div class="form-group row">
                            <label for="mes" class="col-md-2 col-form-label text-md-right">Mes</label>
                            <div class="col-md-3">
                                <select id="mes" name="mes" class="form-control">
                                    <option value="" disabled>--- Seleccione el mes ---</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}"
                                            @if(old('mes', $fpf->mes) == $i) selected @endif>
                                            {{ trans("hdc::ConsumptionRegistry.month{$i}") }}
                                        </option>
                                    @endfor
                                </select>

                            </div>

                            <label for="anio" class="col-md-2 col-form-label text-md-right">Año</label>
                            <div class="col-md-3">
                                <select id="anio" name="anio" class="form-control">
                                    <option value="" disabled>--- Seleccione el año ---</option>
                                    @for ($i = (date('Y') - 1); $i <= (date('Y') + 1); $i++)
                                        <option value="{{ $i }}" @if(old('anio', $fpf->anio) == $i) selected @endif>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <table class="table table-bordered table-hover" id="myTable">
                            <thead class="table-dark">
                                <tr>
                                    <th>{{ trans('hdc::ConsumptionRegistry.Title_Heading_Table_Column1') }}</th>
                                    <th>{{ trans('hdc::ConsumptionRegistry.Title_Heading_Table_Column2') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fpf->personenvironmentalaspects as $pea)
                                    <tr>
                                        <td>
                                            {{ $pea->environmental_aspect->name }}
                                        </td>
                                        <td>
                                            <input name="aspecto[{{ $pea->id }}][valor_consumo][]" class="form-control" type="number" value="{{ $pea->consumption_value }}" placeholder="Ingrese el valor de consumo" required>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-around">
                            <button type="submit" class="btn btn-primary" id="updateBtn">{{ trans('hdc::calculatefootprint.Update_Fingerprint_Button') }}</button>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).on("click", "#updateBtn", function(event) {
                var valid = true;

                // Iterar sobre los campos de valor_consumo
                $('input[name^="aspecto["][name$="[valor_consumo][]"]').each(function() {
                    var valorConsumo = $(this).val();

                    // Validar que el valor sea numérico y positivo
                    if (!$.isNumeric(valorConsumo) || parseFloat(valorConsumo) < 0) {
                        valid = false;
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Ingrese un valor numérico y positivo para este aspecto.'
                        });
                        event.preventDefault(); // Detener el envío del formulario
                        return false; // Detener la iteración
                    }
                });

                // Verificar que todos los campos estén completos
                $('input[name^="aspecto["][name$="[valor_consumo][]"]').each(function() {
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
                    // Aquí puedes agregar la lógica para enviar el formulario si la validación es exitosa
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: 'Formulario enviado exitosamente.'
                    });
                }
            });
        </script>
    @endpush
@endsection
