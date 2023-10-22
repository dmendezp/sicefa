
<form method="POST" id="form-result" action="{{ route('hdc.guardar.valores') }}">
    @csrf
    <input name="activity_id" class="form-control" type="hidden" value="{{ $activity_id }}">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>{{ trans('hdc::ConsumptionRegistry.Title_Heading_Table_Column1') }}</th>
                    <th>{{ trans('hdc::ConsumptionRegistry.Title_Heading_Table_Column2') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($aspects[0]['environmental_aspects'] as $aspecto)
                    <tr>
                        <td>{{ $aspecto['name'] }}</td>
                        <td>
                            <input name="aspecto[{{ $aspecto['id'] }}][id]" type="hidden" value="{{ $aspecto['id'] }}">
                            <input name="aspecto[{{ $aspecto['id'] }}][amount]" class="form-control" type="number"
                                placeholder="{{ $aspecto['measurement_unit']['name'] }}" required><span
                                class="badge text-danger errors-amount"></span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-around">
            <!-- Botón de guardar -->
            <button type="submit" id="btn-enviar" class="btn btn-success">{{ trans('hdc::ConsumptionRegistry.Btn_Save') }}</button>
        </div>
    </div>
</form>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function() {
        // ...

        $('#btn-enviar').click(function(event) {
            var valid = true;

            $('input[name^="aspecto[{{ $aspecto['id'] }}][amount]"]').each(function() {
                var amount = $(this).val();

                // ... Validación de aspectos ...

                if (!$.isNumeric(amount) || parseFloat(amount) <= 0) {
                    valid = false;
                    showAlert('Error', 'Ingrese un valor numérico y positivo para este aspecto.');
                    event.preventDefault();
                    return false;
                }

                // ... Verificación de campos completos ...
            });

            if (!valid) {
                showAlert('Error', 'Complete todos los campos de valor de consumo antes de enviar el formulario.');
                event.preventDefault();
            } else {
                // Lógica para enviar el formulario si la validación es exitosa
                showAlert('success', 'Formulario enviado exitosamente.');
            }
        });

        $('[name^="aspecto["][name$="[amount]"]').on('input', function() {
            var amount = $(this).val();

            if (!$.isNumeric(amount) || parseFloat(amount) <= 0) {
                showAlert('Error', 'Ingrese un valor numérico y positivo para este aspecto.');
            }
        });

        // Función para mostrar alertas SweetAlert
        function showAlert(icon, title, text) {
            Swal.fire({
                icon: icon,
                title: title,
                text: text
            });
        }
    });

</script>
@endpush
