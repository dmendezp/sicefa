@extends('gth::layouts.master')

@section('content')
    <h1>Vista funcionarios</h1>

    <div class="container">
        <h1>Gestión de Información del Contrato</h1>
        <div class="row">
            <div class="col-md-6 mb-3">
                <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Buscar por nombre">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Juan Pérez</td>
                        <td>2023-08-12</td>
                        <td>Presente</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm">Editar</a>
                            <a href="#" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Ana López</td>
                        <td>2023-08-13</td>
                        <td>Ausente</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm">Editar</a>
                            <a href="#" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
                    <!-- Agrega más filas según sea necesario -->
                </tbody>
            </table>
        </div>
    </div>

    <style>
        /* Estilos para los bordes de la tabla */
        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }
    </style>

    <script>
        // Función para filtrar la tabla según el valor del campo de búsqueda
        document.getElementById("searchInput").addEventListener("keyup", function () {
            const inputText = this.value.toLowerCase();
            const rows = document.querySelectorAll("tbody tr");

            rows.forEach((row) => {
                const name = row.querySelector("td:nth-child(2)").textContent.toLowerCase();
                if (name.includes(inputText)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    </script>
@endsection
