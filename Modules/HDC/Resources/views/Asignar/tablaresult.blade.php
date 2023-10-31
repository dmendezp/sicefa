<div class="row justify-content-center">
    <!-- card -->
    <div class="content mt-3">
        <div class="container-fluid">
            <div class="card card-success card-outline shadow mt-3">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <div class="mtop16">
                        @if ($resultados->isNotEmpty())
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Actividad</th>
                                    <th>Aspectos Ambientales</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($resultados as $resultado)
                                <tr>
                                    <td>{{ $resultado->name }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($resultado->environmental_aspects as $aspect)
                                            <li>{{ $aspect->name }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary editar-actividad" data-actividad="{{ $resultado->id }}"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="btn btn-danger eliminar-actividad" data-actividad="{{ $resultado->id }}"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                            <p>No hay datos disponibles.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Agregar un script para manejar las funciones de editar y eliminar mediante Ajax -->
<script>
    $(document).ready(function () {
        // Escucha el clic en los botones de editar
        $('.editar-actividad').click(function () {
            var actividadId = $(this).data('actividad');

            // Realiza una solicitud Ajax para abrir el formulario de edición o realizar la edición
            $.ajax({
                type: 'GET',
                url: '/editar-actividad/' + actividadId, // Ruta que manejará la solicitud en el controlador
                success: function (data) {
                    // Maneja la respuesta exitosa (por ejemplo, abrir un modal o cargar un formulario)
                    console.log(data);
                },
                error: function (error) {
                    // Maneja errores en la solicitud Ajax
                    console.error(error);
                }
            });
        });

        // Escucha el clic en los botones de eliminar
        $('.eliminar-actividad').click(function () {
            var actividadId = $(this).data('actividad');

            // Realiza una solicitud Ajax para eliminar la actividad
            $.ajax({
                type: 'POST',
                url: '/eliminar-actividad/' + actividadId, // Ruta que manejará la solicitud en el controlador
                success: function (data) {
                    // Maneja la respuesta exitosa (por ejemplo, actualizar la vista)
                    console.log(data);
                },
                error: function (error) {
                    // Maneja errores en la solicitud Ajax
                    console.error(error);
                }
            });
        });
    });
</script>
