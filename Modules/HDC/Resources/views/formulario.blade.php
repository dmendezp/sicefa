@extends('hdc::layouts.master')
@push('breadcrumbs')
    <li class="breadcrumb-item active">Formulario</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            <h3>Ingreso de consumo</h3>
            <hr>
            <form action="#" method="POST">
                @csrf {{-- Ese token es necesario agregarlo en un formulario para enviar alguna información de manera segura --}}
                <div class="row d-flex align-items-center"> {{-- Divición del formulario en columnas --}}
                    <div class="col-3"> {{-- Primera columna del formulario --}}
                        <div class="mb-3">
                            <label class="form-label">Fecha</label>
                            <input type="date" class="form-control">
                        </div>
                    </div>
                    <div class="col-4"> {{-- Primera columna del formulario --}}
                        <div class="mb-3"> {{-- Campo de dato para nombre --}}
                            <label for="name" class="form-label">Unidades Productivas</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                @foreach ($productive_unit as $productive_unit)
                                    <option value="1">{{ $productive_unit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3"> {{-- Campo de dato para nombre --}}
                            <label for="name" class="form-label">Labor</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-2"> {{-- Sección del botón para el envío del formulario --}}
                        <button type="submit" class="btn btn-primary btn-block aling-self-center">Registrar</button>
                    </div>
                </div>
            </form>
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
                                <th scope="col">Variable</th>
                                <th scope="col">Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td colspan="2">Larry the Bird</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
