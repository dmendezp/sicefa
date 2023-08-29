@extends('bienestar::layouts.adminlte')

@section('content')

<!-- Contenido de la página -->
<div class="content-wrapper">
    <div class="content">
        <!-- Botón para abrir el modal -->
        <button id="abrirModal" class="btn btn-primary">Agregar Ruta</button>
    </div>
</div>

<!-- Modal para agregar ruta -->
<div class="modal fade" id="modalAgregarRuta">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar Ruta</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- Aquí puedes colocar el formulario para agregar la ruta -->
                <form method="POST" action="procesar.php">
                    <label for="nombreRuta">Nombre de la Ruta:</label>
                    <input type="text" id="nombreRuta" name="nombreRuta" class="form-control">
                    <!-- Agrega más campos del formulario según tus necesidades -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('rutaForm').submit();">Guardar Ruta</button>
            </div>
        </div>
    </div>
</div>

<!-- Incluye los scripts de AdminLTE, jQuery y Popper.js -->
<script src="ruta_al_archivo_jquery.js"></script>
<script src="ruta_al_archivo_popper.js"></script>
<script src="ruta_al_archivo_adminlte.js"></script>

<script>
    // Script para abrir el modal al hacer clic en el botón
    document.getElementById("abrirModal").addEventListener("click", function() {
        $("#modalAgregarRuta").modal("show");
    });
</script>

@endsection