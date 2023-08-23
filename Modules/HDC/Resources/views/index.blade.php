@extends('hdc::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">Pagina Principal</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="text-center">Bienvenido a HDC</h2>
            <h4 class="text-center">(Huella de Carbono)</h4>
            <hr>
            <div class="row">
                <div class="col-6">
                    <h3>¿Que Es Huella de Carbono?</h3>
                    <p>Huella de carbono es un termino que se utiliza para medir la cantidad de emisiones de gases efecto
                        invernadero (GEI),
                        principalmente el dioxido de carbono (CO2)que son liberadas a la atmósfera debido a las actividades
                        humanas,
                        como la quema de combustibles fósiles, la deforestación y la producción industrial.
                    </p>
                </div>
                <div class="col-6">
                    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="3000">
                                <img src="{{ asset('modules/HDC/img/huella-de-carbono.jpg') }}" class="d-block w-100"
                                    alt="...">
                            </div>
                            <div class="carousel-item" data-bs-interval="3000">
                                <img src="{{ asset('modules/HDC/img/Auto.jpg') }}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item" data-bs-interval="3000">
                                <img src="{{ asset('modules/HDC/img/Planeta-verde.jpg') }}" class="d-block w-100"
                                    alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h3>Mision</h3>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h3>Grafica Mensual</h3>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
