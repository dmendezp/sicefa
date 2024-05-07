@foreach ($employees as $employe)
    <div class="modal fade" id="editarModal_{{ $employe->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModolLabel">{{ trans('gth::menu.Edit Official') }} {{ $employe->id }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (isset($employe))
                        <!--Cambio a $employee-->
                        <form id="editForm" method="POST"
                            action="{{ route('cefa.gth.officials.update', ['id' => $employe->id]) }}">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="id"
                                value="{{ $employe->id }}"><!-- Cambiado a $contract -->

                            <!-- Número de documento -->
                            <div class="card-header">
                                <div class="row">
                            <div class="form-group">
                                <label for="document_number-{{$employe->id }}" class="form-label">{{ trans('gth::menu.ID number') }}</label>
                                <input type="number" class="form-control"  id="document_number-{{ $employe->id }}" name="document_number"
                                     value="{{old('document_number', $employe->person->document_number) }}" required>
                            </div>
                                </div>
                            </div>

                            <div class="card-header">
                                <div class="row">
                            <div class="form-group">
                                <label for="full_name-{{$employe->id }}" class="form-label">{{ trans('gth::menu.Name') }}</label>
                                <input type="text" class="form-control" id="full_name_edit-{{ $employe->id }}" name="full_name_edit"
                                    value="{{old('full_name_edit', $employe->person->full_name) }}" required>
                            </div>
                                </div>
                            </div>
                            <!-- Otros campos de entrada -->
                            <div class="card-header">
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="contract_number-{{ $employe->id }}"class="form-label">{{ trans('gth::menu.Contract Number:') }}</label>
                                        <input type="text" class="form-control" id="contract_number-{{ $employe->id }}"
                                            name="contract_number" value="{{ old('contract_number', $employe->contract_number) }}"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="contract_date-{{ $employe->id }}"class="form-label">{{ trans('gth::menu.Contract date:') }}</label>
                                        <input type="date" class="form-control" id="contract_date-{{ $employe->id }}"
                                            name="contract_date" value="{{ old('contract_date', $employe->contract_date) }}"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="professional_card_number-{{ $employe->id }}"class="form-label">{{ trans('gth::menu.Professional card number') }}</label>
                                        <input type="text" class="form-control" id="professional_card_number-{{ $employe->id }}"
                                            name="professional_card_number" value="{{ old('professional_card_number', $employe->professional_card_number) }}"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="professional_card_issue_date-{{$employe->id }}"class="form-label">{{ trans('gth::menu.Date of issue of professional card') }}</label>
                                        <input type="date" class="form-control" id="professional_card_issue_date-{{$employe->id }}"
                                            name="professional_card_issue_date" value="{{ old('professional_card_issue_date', $employe->contract_date) }}"
                                            required>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="employee_type_id-{{ $employe->id }}"class="form-label">{{ trans('gth::menu.Employee Type') }}</label>
                                            <select name="employee_type_id" id="employee_type_id"
                                            class="form-control @error('employee_type_id') is-invalid @enderror"
                                            required>
                                                <option value="">{{ trans('gth::menu.Select employee type') }}<</option>
                                                @foreach ($employeeTypes as $employeeType)
                                                    <option value="{{ $employeeType->id }}"
                                                        {{ $employeeType->id == $employe->employee_type_id ? 'selected' : '' }}>
                                                        {{ $employeeType->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="position_id-{{$employe->id }}"class="form-label">{{ trans('gth::menu.Position') }}</label>
                                            <select name="position_id" id="position_id" class="form-control @error('position_id') is-invalid @enderror"
                                            required>
                                                <option value="">{{ trans('gth::menu.Select position') }}</option>
                                                @foreach ($positions as $position)
                                                    <option value="{{ $position->id }}"
                                                        {{ $position->id == $employe->position_id ? 'selected' : '' }}>
                                                        {{ $position->id }}-{{ $position->professional_denomination }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="risk_type">{{ trans('gth::menu.Type of risk') }}</label>
                                            <select name="risk_type" id="risk_type" class="form-control @error('risk_type') is-invalid @enderror" required>
                                                <option value="">{{ trans('gth::menu.Select type of risk') }}</option>
                                                <option value="I"
                                                    {{ old('risk_type', $employe->risk_type) == 'I' ? 'selected' : '' }}>I
                                                </option>
                                                <option value="II"
                                                    {{ old('risk_type', $employe->risk_type) == 'II' ? 'selected' : '' }}>II
                                                </option>
                                                <option value="III"
                                                    {{ old('risk_type', $employe->risk_type) == 'III' ? 'selected' : '' }}>III
                                                </option>
                                                <option value="IV"
                                                    {{ old('risk_type', $employe->risk_type) == 'IV' ? 'selected' : '' }}>IV
                                                </option>
                                                <option value="V"
                                                    {{ old('risk_type', $employe->risk_type) == 'V' ? 'selected' : '' }}>V
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="state">{{ trans('gth::menu.State:') }}</label>
                                            <select name="state" id="state" class="form-control @error('state') is-invalid @enderror">
                                                <option value="activo"
                                                    {{ old('state', $employe->state) === 'activo' ? 'selected' : '' }}>
                                                    Activo
                                                </option>
                                                <option value="inactivo"
                                                    {{ old('state', $employe->state) === 'inactivo' ? 'selected' : '' }}>
                                                    Inactivo
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                        <button type="submit" class="btn btn-primary" onclick="return confirmarCambios()">{{ trans('gth::menu.Save Changes') }}</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">{{ trans('gth::menu.Close') }}</button>
                                    </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach
@section('js')

    <script>
        function confirmarCambios() {
            Swal.fire({
                title: 'Guardado exitoso',
                text: 'Los datos se han guardado correctamente.',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
        }
    </script>
    <script>
        'use strict';
        // Selecciona todos los formularios con la clase "formEliminar"
        var forms = document.querySelectorAll('.btnEliminar');

        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    event.preventDefault(); // Evita que el formulario se envíe de inmediato

                    console.log('Formulario enviado'); // Evita que el formulario se envíe de inmediato

                    Swal.fire({
                        title: "¿Estas seguro que deseas eliminar?",
                        text: "Este proceso es irrevesible.",
                        icon: 'Advertencia',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "Si, Elimínalo",
                        cancelButtonText: "Cancelar" // Cambiar el texto del botón "Cancelar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Your work has been saved',
                                showConfirmButton: false,
                                timer: 1000
                            })
                        }
                    });
                });
            });
    </script>

    <script>
        'use strict';
        var Guardar = document.getElementById('Guardar');

        Guardar.addEventListener('click', function() {
            // Simulamos una operación de guardado exitosa (puedes reemplazar esto con tu lógica real de guardado)
            // Supongamos que aquí tienes tu lógica para guardar datos en el servidor

            // Luego de que se haya completado la operación de guardado, muestra el SweetAlert
            Swal.fire({
                title: 'Guardado exitoso',
                text: 'Los datos se han guardado correctamente.',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
        });
    </script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Exito!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000 // Tiempo en milisegundos (2 segundos en este caso)
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 2000 // Tiempo en milisegundos (2 segundos en este caso)
            });
        </script>
    @endif
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
    $('.editar-btn').click(function() {
        var id = $(this).data('id');
        var nombre = $(this).data('nombre');

        // Assuming you have a common modal and form structure
        var modalId = '#editarModal_' + id;
        var formId = '#editForm_' + id;

        $('#editId').val(id);
                $('#editName').val(nombre);
);

        // Obtener la ruta de actualización del formulario de edición
        var updateRoute = '{{ route('cefa.gth.officials.update', ['id' => ':id']) }}'.replace(':id', id);

        // Asignar la ruta de actualización al formulario de edición
        $('#editForm').attr('action', updateRoute);
            });

        
    // Assuming you have a common form structure
    $('.editForm').submit(function(event) {
        event.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'), // Usar la ruta de acción del formulario
            method: 'PATCH',
            data: formData,
            success: function(response) {
                // Actualizar la página después de un breve retraso
                setTimeout(function() {
                    location.reload();
                }, 1000); // Espera 1 segundo (1000 milisegundos) antes de recargar

                // Cerrar el modal
                var modal = new bootstrap.Modal(document.getElementById('editarModal'));
                modal.hide();
            }
        });
    });

    </script>
@endpush
