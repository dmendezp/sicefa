@extends('hdc::layouts.master')
@push('breadcrumbs')
    <li class="breadcrumb-item active">Administrar Recursos</li>
@endpush

@Section('content')
<div class="card">
    <div class="card-body">
        <h2 class="text-center">ADMINISTRAR RECURSOS</h2>   
    </div>
</div>
<div class="row d-flex justify-content-center">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Unidad</th>
                            <th scope="col">Recurso Utilizado</th>
                            <th scope="col">Cantidad(L)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>Twitter</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>Malanta</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry the Bird</td>
                            <td>Larry the mouse</td>
                            <td>Larry the elephant</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  
</div>
@endsection