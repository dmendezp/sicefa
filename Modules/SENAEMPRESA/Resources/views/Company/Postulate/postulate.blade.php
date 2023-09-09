@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="postulate">
                    <div class="card-header">{{ $title }}</div>

                    <div class="card-body">
                        <table id="datatable" class="table table-sm table-striped">
                            <thead class="bg-danger text-white">
                                <tr>
                                    <th>Documento</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th>Fecha</th>
                                    <th>Hoja de vida</th>
                                    <th>Puntaje</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Row 1 Data 1</td>
                                    <td>Row 1 Data 2</td>
                                    <td>Row 1 Data 3</td>
                                    <td>Row 1 Data 4</td>
                                    <td>Row 1 Data 5</td>
                                    <td>Row 1 Data 6</td>
                                    <td> <a href="a" class="btn btn-primary">Asignar</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
