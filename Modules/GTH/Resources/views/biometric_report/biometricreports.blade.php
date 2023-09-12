@extends('gth::layouts.master')

@section('content')
<div class="container">
    <h1 class="mt-4 mb-4">Gestión de Asistencia</h1>

    <!-- Barra de búsqueda -->
    <div class="input-group mb-3">
        <input type="text" class="form-control" id="searchInput" placeholder="Ingrese número de documento">
        <div class="input-group-append">
            <button class="btn btn-outline-primary" id="searchButton">Buscar</button>
        </div>
    </div>


<!-- Filtro de estado de registro -->
<div class="form-group">
    <label for="registroFiltro">Filtrar por estado de registro:</label>
    <div class="input-group">
        <select class="custom-select" id="registroFiltro">
            <option value="all">Mostrar Todos</option>
            <option value="registrado">Registrados</option>
            <option value="no_registrado">No Registrados</option>
        </select>
    </div>
</div>
<br><br><br>


<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Nombre</th>
                <th>Número de Documento</th>
                <th>Estado de Registro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($people as $person)
            <tr data-registro="{{ $person->deleted_at ? 'no_registrado' : 'registrado' }}">
                <td>{{ $person->first_name }} {{ $person->first_last_name }} {{ $person->second_last_name }}</td>
                <td>{{ $person->document_number }}</td>
                <td>
                    @if ($person->deleted_at)
                        <span>No Registrado</span>
                    @else
                        <span>Registrado</span>
                    @endif
                </td>
                <td>
                    <a href="#" class="btn btn-outline-secondary detalles-btn" data-bs-toggle="modal" data-bs-target="#detallesModal"
                       data-nombre="{{ $person->first_name }} {{ $person->first_last_name }} {{ $person->second_last_name }}"
                       data-documento="{{ $person->document_number }}"
                       data-fecha-emision="{{ $person->date_of_issue }}"
                       data-primer-apellido="{{ $person->first_last_name }}"
                       data-segundo-apellido="{{ $person->second_last_name }}"
                       data-codigo-biometrico="{{ $person->biometric_code }}"
                       data-estado="{{ $person->deleted_at ? 'No Registrado' : 'Registrado' }}">Ver detalles</a>
                    <button class="btn btn-info actualizar" data-toggle="modal" data-target="#actualizarModal">Actualizar Datos</button>
                    @if ($person->deleted_at)
                        <button class="btn btn-success" data-toggle="modal" data-target="#registrarModal">Registrar</button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>

<!-- Modal de Ver detalles -->
<div class="modal fade" id="detallesModal" tabindex="-1" role="dialog" aria-labelledby="detallesModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detallesModalLabel">Detalles de la Persona</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nombre:</strong> <span id="modalNombre"></span></p>
                <p><strong>Documento de Identidad:</strong> <span id="modalDocumento"></span></p>
                <p><strong>Fecha de Emisión:</strong> <span id="modalFechaEmision"></span></p>
                <p><strong>Primer Apellido:</strong> <span id="modalPrimerApellido"></span></p>
                <p><strong>Segundo Apellido:</strong> <span id="modalSegundoApellido"></span></p>
                <p><strong>Código Biométrico:</strong> <span id="modalCodigoBiometrico"></span></p>
                <p><strong>Estado:</strong> <span id="modalEstado"></span></p>
                <!-- Agrega más detalles aquí según tus necesidades -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Actualización de Datos Biométricos -->
<div class="modal fade" id="actualizarModal" tabindex="-1" role="dialog" aria-labelledby="actualizarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="actualizarModalLabel">Actualizar Datos Biométricos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Agrega el formulario de actualización de datos biométricos aquí -->
                <!-- Por ejemplo: -->
                <form id="actualizarForm">
                    <div class="form-group">
                        <label for="huella">Huella Biométrica</label>
                        <input type="file" class="form-control-file" id="huella">
                    </div>
                    <!-- Agrega más campos según tus necesidades -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="guardarCambios">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Registro -->
<div class="modal fade" id="registrarModal" tabindex="-1" role="dialog" aria-labelledby="registrarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrarModalLabel">Registrar Persona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
           </div>
            <div class="modal-body">
                <!-- Aquí puedes agregar el formulario de registro -->
                <!-- Por ejemplo: -->
                <form>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Ingrese nombre">
                    </div>
                    <div class="form-group">
                        <label for="documento">Documento de Identidad</label>
                        <input type="text" class="form-control" id="documento" placeholder="Ingrese número de documento">
                    </div>
                    <!-- Agrega más campos según tus necesidades -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>


<!-- Script para el boton de busqueda -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const searchButton = document.getElementById('searchButton');
        const filas = document.querySelectorAll('tbody tr');

        searchButton.addEventListener('click', function () {
            const valorBusqueda = searchInput.value.trim().toLowerCase();

            filas.forEach(function (fila) {
                const numeroDocumento = fila.querySelector('td:nth-child(2)').textContent.trim().toLowerCase();
                if (numeroDocumento.includes(valorBusqueda)) {
                    fila.style.display = 'table-row';
                } else {
                    fila.style.display = 'none';
                }
            });
        });
    });
</script>


<!-- JavaScript para manejar la lógica de registro -->
<script>
    $(document).ready(function () {
        // Agregar un evento clic al botón "Guardar" dentro del modal
        $('#registrarModal').on('click', '#guardarRegistro', function () {
            // Obtener los datos del formulario (ejemplo: nombre y documento)
            var nombre = $('#nombre').val();
            var documento = $('#documento').val();

            // Realizar la lógica de registro aquí, por ejemplo, una solicitud AJAX a Laravel
            // Supongamos que la solicitud AJAX se ha completado con éxito

            // Cerrar el modal después del registro exitoso
            $('#registrarModal').modal('hide');

            // Mostrar un mensaje de éxito o realizar otras acciones necesarias
            // Puedes mostrar un mensaje de éxito en la vista o realizar cualquier otra acción que necesites
        });
    });
</script>


<!-- Script para manejar la lógica de actualización de datos -->
<script>
    $(document).ready(function () {
        // Agregar un evento clic al botón "Guardar Cambios" dentro del modal
        $('#guardarCambios').click(function () {
            // Obtener los datos del formulario de actualización (por ejemplo, la huella biométrica)
            var huellaBiométrica = $('#huella').val();

            // Simular una solicitud AJAX para la actualización (reemplaza esto con tu lógica real)
            $.ajax({
                url: '/ruta-de-actualizacion', // Reemplaza con la URL de tu controlador de Laravel
                method: 'POST',
                data: {
                    huellaBiométrica: huellaBiométrica
                },
                success: function (response) {
                    // La actualización se ha completado con éxito

                    // Cerrar el modal después de la actualización exitosa
                    $('#actualizarModal').modal('hide');

                    // Mostrar un mensaje de éxito o realizar otras acciones necesarias
                    // Puedes mostrar un mensaje de éxito en la vista o realizar cualquier otra acción que necesites
                    alert('Actualización exitosa'); // Muestra un mensaje de éxito (puedes cambiar esto)
                },
                error: function (error) {
                    // Manejar errores si la actualización falla
                    console.error('Error de actualización:', error);
                    alert('Error en la actualización'); // Muestra un mensaje de error (puedes cambiar esto)
                }
            });
        });

        // Limpiar el formulario y cerrar el modal cuando se oculta
        $('#actualizarModal').on('hidden.bs.modal', function () {
            $('#actualizarForm')[0].reset();
        });
    });

    //Script de guardar cambios
    $(document).ready(function () {
        // Agregar un evento clic al botón "Guardar Cambios" dentro del modal
        $('#actualizarModal').on('click', '#guardarCambios', function () {
            // Obtener los datos del formulario de actualización (por ejemplo, la huella biométrica)
            var huellaBiométrica = $('#huella').val();

            // Simular una solicitud AJAX para la actualización (reemplaza esto con tu lógica real)
            $.ajax({
                url: '/ruta-de-actualizacion', // Reemplaza con la URL de tu controlador de Laravel
                method: 'POST',
                data: {
                    huellaBiométrica: huellaBiométrica
                },
                success: function (response) {
                    // La actualización se ha completado con éxito

                    // Cerrar el modal después de la actualización exitosa
                    $('#actualizarModal').modal('hide');

                    // Mostrar un mensaje de éxito o realizar otras acciones necesarias
                    // Puedes mostrar un mensaje de éxito en la vista o realizar cualquier otra acción que necesites
                    alert('Actualización exitosa'); // Muestra un mensaje de éxito (puedes cambiar esto)
                },
                error: function (error) {
                    // Manejar errores si la actualización falla
                    console.error('Error de actualización:', error);
                    alert('Error en la actualización'); // Muestra un mensaje de error (puedes cambiar esto)
                }
            });
        });
    });

</script>



<!-- Código JavaScript para activar el modal y establecer los detalles -->
<script>

    document.addEventListener('DOMContentLoaded', function () {
        const detallesBtns = document.querySelectorAll('.detalles-btn');
        const modalNombre = document.getElementById('modalNombre');
        const modalDocumento = document.getElementById('modalDocumento');
        const modalFechaEmision = document.getElementById('modalFechaEmision');
        const modalPrimerApellido = document.getElementById('modalPrimerApellido');
        const modalSegundoApellido = document.getElementById('modalSegundoApellido');
        const modalCodigoBiometrico = document.getElementById('modalCodigoBiometrico');
        const modalEstado = document.getElementById('modalEstado');

        detallesBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                // Obtiene los datos desde los atributos de datos del botón
                const nombre = btn.getAttribute('data-nombre');
                const documento = btn.getAttribute('data-documento');
                const fechaEmision = btn.getAttribute('data-fecha-emision');
                const primerApellido = btn.getAttribute('data-primer-apellido');
                const segundoApellido = btn.getAttribute('data-segundo-apellido');
                const codigoBiometrico = btn.getAttribute('data-codigo-biometrico');
                const estado = btn.getAttribute('data-estado');

                // Establece los datos en el modal
                modalNombre.textContent = nombre;
                modalDocumento.textContent = documento;
                modalFechaEmision.textContent = fechaEmision;
                modalPrimerApellido.textContent = primerApellido;
                modalSegundoApellido.textContent = segundoApellido;
                modalCodigoBiometrico.textContent = codigoBiometrico;
                modalEstado.textContent = estado;
            });
        });
    });
</script>

<!-- Script para el filtro del estado de registro  -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filtro = document.getElementById('registroFiltro');
        const filas = document.querySelectorAll('tbody tr');
        filtro.addEventListener('change', function () {
            const valorFiltro = filtro.value;
            filas.forEach(function (fila) {
                const registro = fila.getAttribute('data-registro');
                if (valorFiltro === 'all' || registro === valorFiltro) {
                    fila.style.display = 'table-row';
                } else {
                    fila.style.display = 'none';
                }
            });
        });
        // Agrega esto para asegurarte de que se muestren todas las filas al inicio
        filtro.dispatchEvent(new Event('change'));
    });
    </script>

@endsection
