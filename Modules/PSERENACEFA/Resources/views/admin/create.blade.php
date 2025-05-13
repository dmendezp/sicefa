@extends('pserenacefa::layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('css/create_admin.css') }}"> 

<div class="container animated fadeIn">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-container">
                <h2 class="form-title text-center">
                    <i class="fas fa-chalkboard-teacher mr-2"></i>Registrar Nuevo Ambiente
                </h2>

                <form action="{{ route('pserenacefa.admin.admin.store') }}" method="POST" id="ambienteForm" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-group">
                        <label for="name" class="form-label">
                            <i class="fas fa-bookmark mr-1"></i> Nombre Del Ambiente
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" id="name" name="name" required maxlength="100">
                            <div class="invalid-feedback">
                                Por favor ingrese el nombre del ambiente.
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="capacity" class="form-label">
                            <i class="fas fa-users mr-1"></i> Capacidad
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user-friends"></i></span>
                            </div>
                            <input type="number" class="form-control" id="capacity" name="capacity" required min="1">
                            <div class="invalid-feedback">
                                Por favor ingrese la capacidad del ambiente (mínimo 1).
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="location" class="form-label">
                            <i class="fas fa-map-marker-alt mr-1"></i> Ubicación
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                            </div>
                            <input type="text" class="form-control" id="location" name="location" required maxlength="100">
                            <div class="invalid-feedback">
                                Por favor ingrese la ubicación del ambiente.
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">
                            <i class="fas fa-align-left mr-1"></i> Descripción
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-comment-alt"></i></span>
                            </div>
                            <textarea class="form-control" id="description" name="description" maxlength="255" rows="3"></textarea>
                        </div>
                        <small class="form-text text-muted">
                            <span id="descriptionCounter">0</span>/255 caracteres
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="status" class="form-label">
                            <i class="fas fa-toggle-on mr-1"></i> Estado
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                            </div>
                            <select class="custom-select form-control" id="status" name="status" required>
                                <option value="Disponible" selected>Disponible</option>
                                <option value="No Disponible">No Disponible</option>
                            </select>
                            <div class="invalid-feedback">
                                Por favor seleccione el estado del ambiente.
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            <i class="fas fa-save mr-2"></i> Crear Ambiente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts necesarios -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.1.9/sweetalert2.min.js"></script>

<script>
    $(document).ready(function() {
        // Animación para los elementos del formulario
        $('.form-group').each(function(index) {
            $(this).addClass('animated fadeIn').css({
                'animation-delay': (index * 0.1) + 's'
            });
        });

        // Contador de caracteres para el campo de descripción
        $('#description').on('input', function() {
            const maxLength = 255;
            const currentLength = $(this).val().length;
            $('#descriptionCounter').text(currentLength);
            
            if (currentLength >= maxLength) {
                $('#descriptionCounter').addClass('text-danger');
            } else {
                $('#descriptionCounter').removeClass('text-danger');
            }
        });

        // Validación del formulario
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                const forms = document.getElementsByClassName('needs-validation');
                Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                            
                            // Mostrar SweetAlert2 para errores de validación
                            Swal.fire({
                                icon: 'error',
                                title: 'Validación fallida',
                                text: 'Por favor complete todos los campos requeridos correctamente.',
                                confirmButtonColor: '#3A5A8A'
                            });
                        } else {
                            event.preventDefault(); // Prevenir el envío real para esta demo
                            
                            // Mostrar animación de carga
                            Swal.fire({
                                title: 'Procesando...',
                                text: 'Registrando nuevo ambiente',
                                icon: 'info',
                                allowOutsideClick: false,
                                showConfirmButton: false,
                                willOpen: () => {
                                    Swal.showLoading()
                                },
                                timer: 1500
                            }).then(() => {
                                // Simular éxito después de procesar
                                Swal.fire({
                                    title: '¡Creado con éxito!',
                                    text: 'El ambiente ha sido registrado correctamente',
                                    icon: 'success',
                                    confirmButtonColor: '#3A5A8A'
                                }).then(() => {
                                    // Descomenta la siguiente línea para enviar el formulario realmente
                                    form.submit();
                                });
                            });
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        // Efectos hover en campos
        $('.form-control').hover(
            function() { $(this).addClass('shadow-sm'); },
            function() { $(this).removeClass('shadow-sm'); }
        );
    });
</script>
@endsection