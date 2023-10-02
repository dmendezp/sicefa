@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <h1 class="text-center"><strong><em><span>{{ $title }}</span></em></strong></h1>
        <br>
        <div class="col-md-12">
            <div class="card card-primary card-outline shadow">
                <div class="card-body">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Aprentice ID</th>
                                <th>Vacante ID</th>
                                <th>Estado</th>
                                <th>Hoja de vida</th>
                                <th>16 Personalidades</th>
                                <th>Propuesta</th>
                                <th>Puntaje Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($postulates as $postulate)
                                <tr>
                                    <td>{{ $postulate->id }}</td>
                                    <td>{{ $postulate->apprentice_id }}</td>
                                    <td>{{ $postulate->vacancy_id }}</td>
                                    <td>{{ $postulate->state }}</td>
                                    <td>{{ $postulate->cv }}</td>
                                    <td>{{ $postulate->personalites }}</td>
                                    <td>{{ $postulate->proposal }}</td>
                                    <td>0</td>
                                    <td> <a href="a" class="btn btn-primary">Asignar</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
