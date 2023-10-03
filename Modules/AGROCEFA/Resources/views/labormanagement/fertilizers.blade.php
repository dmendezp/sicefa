@extends('agrocefa::layouts.master')

@section('content')
<style>
    body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.formulario {
    margin: 0 auto;
    display: block;
    width: 950px;
    padding: 20px;
    background-color: #f5f5f5;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    margin-bottom: 20px;
    padding: 4%;
    text-align: let;
}

label {
    display: block;
    margin-bottom: 10px;
}

input[type="text"],
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

input[type="submit"] {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 3px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

h2 {
    text-align: center;
    font-size: 24px;
}
/*estilo de la tabla de eliminar y editar modificar un poco pregunrle a mario*/
h2 {
    font-size: 24px;
}


table {
    width: 100%;
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid #ccc;
}

th{
    text-align: center;
}
th, td {
    padding: 8px;
    text-align: let;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #ddd;
}

.action-buttons button {
    padding: 5px 10px;
    margin-right: 5px;
    cursor: pointer;
}

.icon-button {
    background-color: #17a92d;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
.button-container {
    text-align: center;
}

#editar-button {
    background-color: green;
    color: white; 
}

#eliminar-button {
    background-color: red;
    color: white; 
}

.icon-button i {
    margin-right: 5px;
}

.icon-button:hover {
    background-color: #45a049;
}


.action-buttons button:hover {
    opacity: 0.8;
}
</style>
<div class="container">
    <div class="column">
        <div class="card">
            Click me
          </div>
    </div>
    <div class="column">
        <div class="card">
            Click me
          </div>
    </div>
  </div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="mt-5">
                <h2 class="text-white">Fertilizantes</h2>
            </div>
            <div class="mt-3">
                <button id="mostrar-formulario" class="btn btn-primary">Crear Fertilizante</button>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <table class="table table-bordered table-striped text-white">
                <thead class="thead-light">
                    <tr>
                        <th>Producto</th>
                        <th>Dosis</th>
                        <th>Cantidad Total</th>
                        <th>Costo Total</th>
                        <th>Método de Aplicación</th>
                        <th>Registro ICA</th>
                        <th>Lote</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fw-bold">Nombre del fertilizante</td>
                        <td>Valor de dosis</td>
                        <td>Cantidad total</td>
                        <td>Costo total</td>
                        <td>Método de aplicación</td>
                        <td>Registro ICA</td>
                        <td>Lote</td>
                        <td>
                            <a href="#" class="btn btn-warning">Editar</a>

                            <form action="#" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Mostrar el formulario de creación al hacer clic en el botón -->
    <div class="row mt-4" id="crear-fertilizante">
        <div class="col-12">
            <div>
                <h2>Crear Fertilizante</h2>
            </div>
            <div>
                <a href="" class="btn btn-primary">Volver</a>
            </div>
        </div>

        <form action="" method="POST">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <div class="form-group">
                        <label for="producto">Producto:</label>
                        <input type="text" name="producto" id="producto" class="form-control" placeholder="Producto" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <div class="form-group">
                        <label for="dosis">Dosis:</label>
                        <input type="text" name="dosis" id="dosis" class="form-control" placeholder="Dosis" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <div class="form-group">
                        <label for="cantidad_total">Cantidad Total:</label>
                        <input type="text" name="cantidad_total" id="cantidad_total" class="form-control" placeholder="Cantidad Total" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <div class="form-group">
                        <label for="costo_total">Costo Total:</label>
                        <input type="text" name="costo_total" id="costo_total" class="form-control" placeholder="Costo Total" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <div class="form-group">
                        <label for="metodo_de_aplicacion">Método de Aplicación:</label>
                        <input type="text" name="metodo_de_aplicacion" id="metodo_de_aplicacion" class="form-control" placeholder="Método de Aplicación" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <div class="form-group">
                        <label for="registro_ica">Registro ICA:</label>
                        <input type="text" name="registro_ica" id="registro_ica" class="form-control" placeholder="Registro ICA" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <div class="form-group">
                        <label for="lote">Lote:</label>
                        <input type="text" name="lote" id="lote" class="form-control" placeholder="Lote" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Mostrar el formulario de creación al hacer clic en el botón
    document.getElementById('mostrar-formulario').addEventListener('click', function () {
        document.getElementById('crear-fertilizante').style.display = 'block';
    });
</script>
@endsection
