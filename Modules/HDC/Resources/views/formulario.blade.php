@extends('hdc::layouts.master')
@push('breadcrumbs')
    <li class="breadcrumb-item active">Formulario</li>
@endpush

@section('content')
    <div class="card">
        <div class="body">
            <br>
            <h2 class="text-center">Ingrese el consumo</h2>
            <hr>
            <div class="card-body align-items-center">
                <form action="#" method="POST">
                    @csrf {{-- Ese token es necesario agregarlo en un formulario para enviar alguna información de manera segura --}}
                    <div class="row"> {{-- Divición del formulario en columnas --}}
                        <div class="col-4"> {{-- Primera columna del formulario --}}
                            <div class="mb-3"> {{-- Campo de dato para nombre --}}
                                <label for="name" class="form-label">Unidades Productivas</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    @foreach ($productive_unit as $productive_unit )
                                        <option value="1">{{ $productive_unit->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="mb-3"> {{-- Campo de dato para ciudad --}}
                                <label for="city" class="form-label"></label>
                                <input type="text" class="form-control" name="city" id="city" required>
                            </div>
                        </div>

                        <div class="col-4"> {{-- Primera columna del formulario --}}
                            <div class="mb-3"> {{-- Campo de dato para nombre --}}
                                <label for="name" class="form-label">Labor</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                        <option value="1">uno</option>


                                </select>
                            </div>
                            <div class="mb-3"> {{-- Campo de dato para número de teléfono --}}
                                <label for="telephone" class="form-label"></label>
                                <input type="number" class="form-control" name="telephone" id="telephone" required>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="mb-3"> {{-- Campo de dato para correo eletrónico --}}
                                <label for="email" class="form-label"></label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                            <div class="mb-3"> {{-- Campo de dato para correo eletrónico --}}
                                <label for="email" class="form-label"></label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                        </div>
                        <div class="col text-center"> {{-- Sección del botón para el envío del formulario --}}
                            <button type="submit" class="btn btn-primary aling-self-center">Registrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
