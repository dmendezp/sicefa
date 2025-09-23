@extends('gdmf::layouts.master')

@section('content')
    <div class="container">
        <h3>Registrar Solicitud de Materiales</h3>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card card-menta card-outline shadow">
                        <div class="card-body">
                            <form id="material-request-form" method="POST"
                                action="{{ route('gdmf.instructor.material_request.store') }}">
                                @csrf

                                {{-- Ficha (Course) --}}
                                <div class="form-group mt-3">
                                    <label for="course_id">Ficha</label>
                                    <select id="course_id" name="course_id" class="form-control select2" required>
                                        <option value="">Seleccione una ficha</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->code }} -
                                                {{ $course->program->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Proyecto formativo (automático) --}}
                                <div class="form-group mt-3">
                                    <label for="training_project">Proyecto formativo</label>
                                    <input type="text" id="training_project" class="form-control" readonly>
                                    <input type="hidden" name="training_project_id" id="training_project_id">
                                </div>

                                {{-- Presupuesto disponible --}}
                                <div class="form-group mt-3">
                                    <label for="budget_limit">Presupuesto disponible</label>
                                    <input type="text" id="budget_limit" class="form-control" readonly>
                                </div>

                                {{-- Tabla de materiales --}}
                                <div class="table-responsive mt-4">
                                    <table class="table table-bordered" id="materials-table">
                                        <thead>
                                            <tr>
                                                <th>Material</th>
                                                <th>Precio Unitario</th>
                                                <th>Cantidad</th>
                                                <th>Subtotal</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                    <button type="button" id="add-material" class="btn btn-success">Agregar
                                        material</button>
                                </div>

                                <div class="text-end mt-4">
                                    <strong>Total: $<span id="total-amount">0</span></strong>
                                    <br>
                                    <button type="submit" class="btn btn-menta mt-2">Enviar Solicitud</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <script>
        function updatePrice(select) {
            const price = parseFloat($(select).find(':selected').data('price')) || 0;
            const row = $(select).closest('tr');
            row.find('.price').val(price); // Precio sin formato para cálculos
            row.find('.price').attr('data-raw', price); // Guardamos valor limpio en atributo
            row.find('.price').next('.price-display').text('$' + price.toLocaleString()); // Muestra bonito
            calculateSubtotal(row.find('.quantity'));
        }

        function calculateSubtotal(input) {
            const row = $(input).closest('tr');
            const price = parseFloat(row.find('.price').val()) || 0;
            const quantity = parseInt(row.find('.quantity').val()) || 0;
            const subtotal = price * quantity;
            row.find('.subtotal').val(subtotal); // Valor limpio
            row.find('.subtotal').next('.subtotal-display').text('$' + subtotal.toLocaleString()); // Mostrar bonito
            updateTotal();
        }

        function updateTotal() {
            let total = 0;
            $('.subtotal').each(function() {
                total += parseFloat($(this).val()) || 0;
            });
            $('#total-amount').text(total.toLocaleString());

            // Corregido: eliminar todo lo que no sea número
            const limit = parseFloat($('#budget_limit').val().replace(/[^\d]/g, '')) || 0;

            if (total > limit) {
                alert('El total supera el presupuesto disponible.');
            }
        }



        $(document).ready(function() {
            $('.select2').select2();
            let materials = [];

            $('#course_id').on('change', function() {
                const courseId = $(this).val();
                if (!courseId) return;

                const url = "{{ url('gdmf/instructor/material_request/project_info') }}/" + courseId;

                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(data) {
                        $('#training_project').val(data.project.name);
                        $('#training_project_id').val(data.project.id);
                        $('#budget_limit').val(parseFloat(data.budget).toLocaleString());
                        materials = data.materials;
                        updateMaterialOptions();
                    },
                    error: function(xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.info) {
                            Swal.fire({
                                icon: 'info',
                                title: 'Información',
                                text: xhr.responseJSON.info
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Ocurrió un error al cargar la información del proyecto.'
                            });
                        }
                    }
                });
            });

            function updateMaterialOptions() {
                $('.material-select').each(function() {
                    const select = $(this);
                    const selectedValue = select.val();
                    select.empty();
                    select.append(`<option value="">Seleccione</option>`);
                    materials.forEach(mat => {
                        select.append(
                            `<option value="${mat.id}" data-price="${mat.price}">${mat.name} - $${mat.price.toLocaleString()} (${mat.unit})</option>`
                        );
                    });
                    if (selectedValue) select.val(selectedValue);
                });
            }

            let materialIndex = 0;

            $('#add-material').on('click', function() {
                const row = `
<tr>
    <td>
        <select class="form-control material-select" name="items[${materialIndex}][element_id]" required onchange="updatePrice(this)">
            <option value="">Seleccione</option>
        </select>
    </td>
    <td>
        <input type="hidden" class="form-control price" readonly>
        <span class="price-display">$0</span>
    </td>
    <td><input type="number" name="items[${materialIndex}][quantity]" class="form-control quantity" min="1" value="1" onchange="calculateSubtotal(this)"></td>
    <td>
        <input type="hidden" class="form-control subtotal" readonly>
        <span class="subtotal-display">$0</span>
    </td>
    <td><button type="button" class="btn btn-danger" onclick="$(this).closest('tr').remove(); updateTotal();">X</button></td>
</tr>
    `;
                $('#materials-table tbody').append(row);
                updateMaterialOptions();
                materialIndex++;
            });
        });
    </script>
@endsection
