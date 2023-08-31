@extends('agroindustria::layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Formulación</div>

                <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                        <label for="producto">Producto</label>
                        <select class="form-control" name="producto" id="producto">
                            <option value="producto1">Leche</option>
                            <option value="producto2">Harina</option>
                        </select>
                        <br>

                        <label for="cantidad">Proceso</label>
                        <textarea class="form-control" id="cantidad" name="cantidad" rows="3"></textarea>
                        <br>

                        <label for="fecha">Fecha:</label>
                        <input type="date" class="form-control" id="fecha" name="fecha"
                            placeholder="fecha">
                        <br>

                        <label for="unidad_productiva">Unidad Productiva:</label>
                        <select class="form-control" name="unidad_productiva" id="unidad_productiva">
                            <option value="unidad1">Ganaderia</option>
                            <option value="unidad2">Agricola</option>
                        </select>
                        <br>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><br>
        <div class="col-md-9">

            <div class="card">
                <div class="card-header">Ingredientes</div>

                <div class="card-body">
                    <label for="producto">Formulación</label>
                    <select class="form-control select2" name="producto" id="producto">
                        <option value="formulacion1">Formulacion1</option>
                        <option value="formulacion1">Formulacion2</option>
                    </select>
                    <br>

                    <table class="table" id="datatables">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Ingredientes</th>
                                <th>Ingredientes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td>1</td>
                            <td></td>
                            <td></td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
