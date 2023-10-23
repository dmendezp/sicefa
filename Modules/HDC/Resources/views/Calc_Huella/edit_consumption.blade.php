@extends('hdc::layouts.master')

@section('content')
    <div class="col-md-12">
        <div class="card card-success card-outline shadow mt-2">
            <div class="card-header">
                <h2 class="card-title"><strong> {{ trans('hdc::calculatefootprint.Title_Card_Carbon_Footprint_Table_Edit')}} {{ $fpf->person->full_name }} </strong></h2>
            </div>
            <br>
            <div class="container">
                <div class="table-responsive">
                    <form method="post" action="{{ route('carbonfootprint.update_consumption', ['id' => $fpf->id]) }}">
                        @csrf
                        @method('POST')

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
                            <button type="submit" class="btn btn-primary" id="updateBtn">{{ trans('hdc::calculatefootprint.Update_Fingerprint_Button')}}</button>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            $('#updateBtn').click(function(event) {
                var valid = true;

                // Iterar sobre los campos de valor_consumo
                $('input[name^="aspecto["][name$="[valor_consumo][]"]').each(function () {
                    console.log($('input[name^="aspecto["][name$="[valor_consumo][]"]'));


                    var valorConsumo = $(this).val();

                    // Validar que el valor sea numérico y positivo
                    if (!$.isNumeric(valorConsumo) || parseFloat(valorConsumo) <= 0) {
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
                $('input[name^="aspecto["][name$="[valor_consumo][]"]').each(function () {
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
        });

    </script>
    @endpush
@endsection
