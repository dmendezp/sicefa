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
                                <img src="{{ asset('modules/HDC/img/fish.jpg') }}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item" data-bs-interval="3000">
                                <img src="{{ asset('modules/HDC/img/plants.jpg') }}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item" data-bs-interval="3000">
                                <img src="{{ asset('modules/HDC/img/ganado.jpg') }}" class="d-block w-100"
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
                    <h3>¿Cual Es Su Objetivo?</h3>
                    <p>El objetivo de medir la huella de carbono es evaluar y cuantificar la cantidad total de gases de efecto invernadero
                        emitidos directa o indirectamente por una actividad, producto o individuo.
                        Ayuda a comprender y reducir la contribución al cambio climático, identitficando áreas donde se pueden tomar medidas para
                        disminuir las emisiones y promover practicas mas sostenibles.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h3>¿Como Se Calcula La Huella?</h3>
                    <p>Para calcular dicha huella se multiplica el dato de consumo (Actividad) por su correspondiente coeficiente o factor de emision
                        en función del tipo de recurso utilizado(Energía, combustible, Agua o Residuos) en dicha actividad.

                    </p>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h3>Grafica Del Año</h3>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
