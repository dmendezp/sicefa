@extends('bienestar::layouts.adminlte')

@section('content_header')
    <h1>Configuración de Rutas</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 style="font-family: Calibri, sans-serif; font-size: 40px; font-weight: 400; color: #000000;">Insertar de Rutas</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <select id="numeroRuta" class="form-control" style="width: 100%; height: 50px; background-color: #FFFFFF; color: #000000; font-family: Calibri, sans-serif; font-size: 16px; font-weight: 400;">
                            <option value="">Número de Ruta</option>
                            <option value="ruta1">Ruta 1</option>
                            <option value="ruta2">Ruta 2</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nombre de Ruta" style="height: 50px; background-color: #FFFFFF; color: #000000; font-family: Calibri, sans-serif; font-size: 16px; font-weight: 400;">
                    </div>
                    <div class="input-group mb-3">
                        <select id="bus" class="form-control" style="width: 100%; height: 50px; background-color: #FFFFFF; color: #000000; font-family: Calibri, sans-serif; font-size: 16px; font-weight: 400;">
                            <option value="">Bus</option>
                            <option value="bus1">Bus 1</option>
                            <option value="bus2">Bus 2</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                    
                </div>
                <div class="col-md-2">
                    <div class="input-group mb-3">
                    <button class="btn btn-success" type="button" style="background-color: #00FF22;" data-toggle="modal" data-target="#myModal">
                        <i class="fas fa-plus" style="color: #000000; width: 20px; height: 20px;"></i>
                    </button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Numero De Ruta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Contenido del modal -->
                <div class="form-group">
                    <label for="numeroRuta">Número de Ruta:</label>
                    <input type="number" class="form-control" id="numeroRuta">
                </div>            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="guardarCambios">Guardar cambios</button>

<script>
    document.getElementById("guardarCambios").addEventListener("click", function() {
        // Aquí puedes agregar la funcionalidad para guardar los cambios
        // Por ejemplo, puedes validar el formulario y enviar los datos a través de una llamada a una API
        // Una vez que los cambios se hayan guardado, puedes mostrar un mensaje de éxito o actualizar la página
        alert("Cambios guardados correctamente");
    });
</script>

            </div>
        </div>
    </div>
</div>     
                    </div>
                    <div class="input-group mb-3", style="margin-top:65%">
           <button class="btn btn-success" type="button" style="background-color: #00FF22;" data-toggle="modal" data-target="#modalBuses">
    <i class="fas fa-plus" style="color: #000000; width: 20px; height: 20px;"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="modalBuses" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Bus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Campo de texto numérico agregado -->
                <div class="form-group">
                    <label for="numeroRuta">Número de bus:</label>
                    <input type="number" class="form-control" id="numeroRuta">
                </div>      
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="guardar">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById("guardar").addEventListener("click", function() {
        // Aquí puedes agregar la funcionalidad para guardar los cambios
        // Por ejemplo, puedes validar el formulario y enviar los datos a través de una llamada a una API
        // Una vez que los cambios se hayan guardado, puedes mostrar un mensaje de éxito o actualizar la página
        alert("Cambios guardados correctamente");
    });
</script>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <select id="conductor" class="form-control" style="width: 100%; height: 50px; background-color: #FFFFFF; color: #000000; font-family: Calibri, sans-serif; font-size: 16px; font-weight: 400;">
                            <option value="">Conductor</option>
                            <option value="conductor1">Conductor 1</option>
                            <option value="conductor2">Conductor 2</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Hora Llegada</span>
                        </div>
                        <input type="time" id="horaLlegada" class="form-control" style="height: 50px; background-color: #FFFFFF; color: #000000; font-family: Calibri, sans-serif; font-size: 16px; font-weight: 400;">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Hora Salida</span>
                        </div>
                        <input type="time" id="horaSalida" class="form-control" style="height: 50px; background-color: #FFFFFF; color: #000000; font-family: Calibri, sans-serif; font-size: 16px; font-weight: 400;">
                    </div>
                    <div class="input-group mb-3">
                    <button class="btn" style="background-color: #FF001A; color: #FFFFFF;" id="showModalBtn">Cancelar</button>                    
                    <span class="ml-4"></span> <!-- Espacio entre los botones -->
                    <button class="btn btn-success" style="background-color: #00FF22;">Guardar</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                        <thead>
                            <tr>
                                <!-- Add more columns if necessary -->
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Add data rows here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
