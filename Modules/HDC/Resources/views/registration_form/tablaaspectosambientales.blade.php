<form method="POST" id="form-result" action="{{ route('hdc.guardar.valores') }}">
    @csrf
    <input name="activity_id" class="form-control" type="hidden" value="{{ $activity_id }}">

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>{{ trans('hdc::ConsumptionRegistry.Title_Heading_Table_Column1') }}</th>
                    <th>{{ trans('hdc::ConsumptionRegistry.Title_Heading_Table_Column2') }}</th>
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
            <button type="submit" id="btn-enviar"
                class="btn btn-success">{{ trans('hdc::ConsumptionRegistry.Btn_Save') }}</button>
        </div>
    </div>
</form>

@push('scripts')
    <script>
        const btn = document.querySelector("#btn-enviar");
        const form = document.querySelector("#form-result");

        btn.addEventListener("click", (e) => {
            e.preventDefault();
            const datos = new FormData(form);

            fetch('/guardar/valores', {
                    method: 'post',
                    body: datos
                })
                .then(response => response.json())
                .then(result => {
                    console.log(result);

                    if (result.alerta == "danger") {
                        let amount = document.querySelector(".errors-amount");
                        amount.textContent = result.amount[0];

                        // Mostrar el badge de error
                        let badge = document.querySelectorAll(".badge");
                        badge.forEach(span => {
                            span.style.display = "block";
                            span.style.textAlign = "left";
                        });

                        // Ocultar el badge después de 3 segundos
                        setTimeout(() => {
                            badge.forEach(span => {
                                span.style.display = "none";
                            });
                        }, 3000);
                    }

                    if (result.alerta == "success") {
                        const success = document.querySelector(".alert");
                        success.textContent = "El formulario se validó correctamente";
                        success.style.display = "block";
                    }
                })
                .catch(error => console.error('Error en la solicitud AJAX:', error));
        });
    </script>
@endpush
