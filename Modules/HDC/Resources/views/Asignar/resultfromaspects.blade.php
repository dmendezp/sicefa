@extends('hdc::layouts.master')

@push('breadcrumbs')
<li class="breadcrumb-item active">{{ trans('hdc::assign_environmental_aspects.Consult_environmental_aspects')}}</li>
@endpush

@section('content')
<h2 class="text-center">{{ trans('hdc::assign_environmental_aspects.Consult_environmental_aspects')}}</h2>
<br>
<div class="content">
    <div class="container-fluid mt">
        <div class="row justify-content-center">
            <div class="card card-success card-outline shadow col-md-5 mt-3">
                <div class="card-header">
                    <a href="{{ route('hdc.admin.assign_environmental_aspects') }}"><button type="submit" class="btn btn-success"><i class="fas fa-add"></i></button></a>
                </div>
                <div class="card-body">
                    <form id="unidadForm">
                        @csrf
                        <div class="form-group">
                            <label>{{ trans('hdc::assign_environmental_aspects.label1') }}</label>
                            <select name="productive_unit_id" class="form-control" required>
                                <option value="">{{ trans('hdc::assign_environmental_aspects.select1') }}</option>
                                @foreach ($productive_unit as $pro)
                                <option value="{{ $pro->id }}">{{ $pro->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <center><button type="submit" class="btn btn-success">{{ trans('hdc::assign_environmental_aspects.btn2') }}</button></center>
                    </form>
                </div>
            </div>
        </div>
        <!-- Contenedor para mostrar la tabla de resultados -->
        <div id="resultadosContainer"></div>
    </div>
</div>

@push('scripts')

<script>
    function ejecutarScript() {
        document.addEventListener('DOMContentLoaded', () => {
            const deleteButtons = document.querySelectorAll('.btnEliminar');

            deleteButtons.forEach((deleteButton) => {
                deleteButton.addEventListener('click', () => {
                    const formId = deleteButton.dataset.formId;
                    const form = document.getElementById(formId);

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: 'Esta acción no se puede deshacer',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Envía el formulario de manera convencional
                            form.submit();
                        } else {
                            Swal.fire('Cancelado', 'La acción ha sido cancelada', 'info');
                        }
                    });
                });
            });
        });
    }
    // Escucha el envío del formulario y realiza la solicitud AJAX
    $('#unidadForm').on('submit', function(e) {
        e.preventDefault(); // Evita el envío del formulario por defecto

        // Realiza una solicitud AJAX para obtener los resultados
        $.ajax({
            url: "{{ route('hdc.admin.mostrarResultados') }}",
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                // Actualiza el contenido del contenedor con la tabla de resultados
                $('#resultadosContainer').html(response);

                // Llama a la función para inicializar SweetAlert después de cargar los resultados
                initSweetAlert();
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    // Función para inicializar SweetAlert en los botones de eliminación
function initSweetAlert() {
    const btnEliminarArray = document.querySelectorAll('.btnEliminar');

    btnEliminarArray.forEach(btnEliminar => {
        btnEliminar.addEventListener('click', function (e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción no se puede deshacer',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminarlo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.closest('form').submit();
                }
            });
        });
    });
}


</script>

@endpush
@endsection
