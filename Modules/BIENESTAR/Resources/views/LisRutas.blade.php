@extends('bienestar::layouts.adminlte')

@section('content')

<!-- Contenido de la página -->
<div class="content-wrapper">
    <div class="content">
    <h2 style="margin-bottom: 45px;">Listado De Rutas</h2> <!-- Título con espacio --> <!-- Título fuera del card -->

        <div class="card">
            <div class="card-body">
                <!-- Tabla para mostrar los datos -->
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            <th style="text-align: center; padding: 25px; font-family: Calibri, sans-serif; font-size: 30px; font-weight: normal;">Conductor</th>
                                <th style="text-align: center; padding: 25px; font-family: Calibri, sans-serif; font-size: 30px; font-weight: normal;">Ruta</th>
                                <th style="text-align: center; padding: 25px; font-family: Calibri, sans-serif; font-size: 30px; font-weight: normal;">Placa</th>
                                <th style="text-align: center; padding: 25px; font-family: Calibri, sans-serif; font-size: 30px; font-weight: normal;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí irían las filas de datos, puedes usar un bucle para llenar los datos -->
                            <tr>
                                <td style="text-align: center;"></td>
                                <td style="text-align: center;"></td>
                                <td style="text-align: center;"></td>
                                <td style="text-align: center;">
                                <a href="#" class="btn btn-info btn-sm" style="background-color: #00DCFF;"><i class="fas fa-cog" style="color: #000000;"></i></a>
                                    &nbsp;
                                    <a href="#" class="btn btn-danger btn-sm" style="background-color: #FF001A;"><i class="fas fa-trash" style="color: #000000;"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Resto de tu código y modal... -->

@endsection
