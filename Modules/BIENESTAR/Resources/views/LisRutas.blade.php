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
                                <a href="#" class="btn btn-info btn-sm custom-icon-btn" data-toggle="modal" data-target="#settingsModal">
  <i class="fas fa-cog" style="color: #000000;"></i>
</a>
&nbsp;
<a href="#" class="btn btn-danger btn-sm custom-icon-btn" data-toggle="modal" data-target="#deleteModal">
  <i class="fas fa-trash" style="color: #000000;"></i>
</a>

<!-- Modal for Settings -->
<div class="modal fade" id="settingsModal" tabindex="-1" role="dialog" aria-labelledby="settingsModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="settingsModalLabel">Configuración</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Contenido de la configuración -->
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Eliminar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>¿Estás seguro de que deseas eliminar este elemento?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger">Eliminar</button>
      </div>
    </div>
  </div>
</div>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Incluye los scripts de AdminLTE, jQuery y Popper.js -->
<script src="ruta_al_archivo_jquery.js"></script>
<script src="ruta_al_archivo_popper.js"></script>
<script src="ruta_al_archivo_adminlte.js"></script>

@endsection
