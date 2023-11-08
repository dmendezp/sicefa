<div class="row justify-content-center">
    <!-- card -->
    <div class="content mt-3">
        <div class="container-fluid">
            <div class="card card-success card-outline shadow mt-3">
                <div class="card-header">
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
                                        <td contenteditable="true">{{ $resultado->name }}</td>
                                        <td>
                                            <ul>
                                                @foreach ($resultado->environmental_aspects as $aspect)
                                                    <li>{{ $aspect->name }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary" data-activityId="{{ $resultado->id }}" onclick="editarActividad(this)">
                                                Editar
                                            </button>
                                            <button class="btn btn-danger" data-resultado="{{ $resultado->id }}" onclick="eliminarActividad(this)">
                                                Eliminar
                                            </button>
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
</div>

@push('scripts')
    <!-- Agregar un script para manejar las funciones de edición y eliminación -->
    <script>
        function editarActividad(button) {
            var row = button.closest('tr'); // Encuentra la fila que contiene el botón
            var actividadCell = row.querySelector('td:first-child'); // Obtiene la celda de la actividad
            var nuevoNombre = prompt('Editar nombre de actividad:', actividadCell.textContent);
    
            if (nuevoNombre !== null) {
                // Realiza una solicitud Ajax para actualizar el nombre de la actividad
                var actividadId = button.getAttribute('data-activityId');
                var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Obtén el token CSRF
    
                // Realiza la solicitud Ajax utilizando fetch
                fetch('/actividad/' + actividadId, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({ nombre: nuevoNombre })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Actualiza la celda de la tabla con el nuevo nombre
                        actividadCell.textContent = nuevoNombre;
                        alert('Actividad actualizada con éxito');
                    } else {
                        alert('Error al actualizar la actividad');
                    }
                })
                .catch(error => {
                    console.error(error);
                    alert('Error en la solicitud Ajax');
                });
            }
        }
    
        function eliminarActividad(button) {
            if (confirm('¿Estás seguro de que deseas eliminar esta actividad?')) {
                var activityId = button.getAttribute('data-resultado');
                // Realiza una solicitud Ajax para eliminar la actividad con actividadId
                // Agregar aquí la lógica Ajax para eliminar la actividad
                // Luego, elimina la fila de la tabla si la solicitud es exitosa
                // Por ejemplo, button.closest('tr').remove();
            }
        }
    </script>
@endpush
