@extends('gth::layouts.master')

@section('css')
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h3 class="mt-4 mb-4">Gestión de Asistencia</h3>

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
        <br>

        <div class="table-responsive">
            <table id="biometric" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
                <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Número de Documento</th>
                        <th scope="col">Estado de Registro</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@section('js')
    new DataTable('#biometric', {
    ajax: '../ajax/data/arrays.txt'
    });
@endsection
<!-- Modal de Creación -->
@foreach ($people as $person)
    <div class="modal fade" id="crearModal_{{ $person->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Nuevo Registro Biometrico</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('gth.biometricreports.create', ['id' => $person->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="biometric_code">Registro Biometrico:</label>
                            <input type="text" name="biometric_code" class="form-control"
                                value="{{ $person->biometric_code }}" required>
                        </div>
                        <!-- Agrega más campos de formulario según tus necesidades -->
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success" id="Guardar">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

<!-- Modal de Ver detalles -->
<div class="modal fade" id="detallesModal" tabindex="-1" role="dialog" aria-labelledby="detallesModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detallesModalLabel">Detalles de la Persona</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nombre:</strong> <span id="modalNombre"></span></p>
                <p><strong>Documento de Identidad:</strong> <span id="modalDocumento"></span></p>
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

<!-- Código JavaScript para activar el modal y establecer los detalles -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const detallesBtns = document.querySelectorAll('.detalles-btn');
        const modalNombre = document.getElementById('modalNombre');
        const modalDocumento = document.getElementById('modalDocumento');
        const modalCodigoBiometrico = document.getElementById('modalCodigoBiometrico');
        const modalEstado = document.getElementById('modalEstado');

        detallesBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                // Obtiene los datos desde los atributos de datos del botón
                const nombre = btn.getAttribute('data-nombre');
                const documento = btn.getAttribute('data-documento');
                const codigoBiometrico = btn.getAttribute('data-codigo-biometrico');
                const estado = btn.getAttribute('data-estado');

                // Establece los datos en el modal
                modalNombre.textContent = nombre;
                modalDocumento.textContent = documento;
                modalCodigoBiometrico.textContent = codigoBiometrico;
                modalEstado.textContent = estado;
            });
        });
    });
</script>



<script>
    // Script para el modal de registro biométrico
    console.log('Script de registro biométrico ejecutado'); // Agregar esta línea para verificar
    document.addEventListener('DOMContentLoaded', function() {
        // Script para abrir el modal de creación
        const crearRegistroBtn = document.getElementById('crearRegistroBtn');
        const crearRegistroModal = document.getElementById('crearRegistroModal');

        crearRegistroBtn.addEventListener('click', function() {
            crearRegistroModal.style.display = 'block';
        });

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

        // Cierra el modal si el usuario hace clic fuera de él
        window.addEventListener('click', function(event) {
            if (event.target === crearRegistroModal) {
                crearRegistroModal.style.display = 'none';
            }
        });

        // Cierra el modal si el usuario presiona la tecla Esc
        window.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && crearRegistroModal.style.display === 'block') {
                crearRegistroModal.style.display = 'none';
            }
        });
    });
</script>

<!-- Script para el filtro del estado de registro -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filtro = document.getElementById('registroFiltro');
        const filas = document.querySelectorAll('tbody tr');
        filtro.addEventListener('change', function() {
            const valorFiltro = filtro.value;
            filas.forEach(function(fila) {
                const registro = fila.getAttribute('data-registro');
                if (valorFiltro === 'all' || registro === valorFiltro) {
                    fila.style.display = 'table-row';
                } else {
                    fila.style.display = 'none';
                }
            });
        });
        // Asegúrate de que se muestren todas las filas al inicio
        filtro.dispatchEvent(new Event('change'));
    });
</script>
@endsection
