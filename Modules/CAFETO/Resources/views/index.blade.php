@extends('cafeto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">Inicio</li>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
            <h1 class="hmax h-lg-max h-md-max h-sm-max h-xs-max">Bienvenido a CAFETO </h1>
        </div>

        <div class="row mb-3 mt-3">
            <div class="col-12">
                <p class="p-max">CAFETO permite la administración de la estación de café del centro de formación
                    agroindustrial "La Angostura", incluyendo los procesos que se realizan desde la parte de ventas,
                    inventariado y organización general.</p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-12 mb-3">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset('modules/cafeto/images/1.jpg') }}" class="img-fluid rounded-start custom-img"
                                alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5>Prueba un delicioso Expreso!</h5>
                                <p class="card-text">Para empezar el día que mejor que una taza de cafe sin azúcar con el
                                    puro sabor del cafe de la Angostura.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12 mb-3">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset('modules/cafeto/images/2.jpg') }}" class="img-fluid rounded-start custom-img"
                                alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5>Prueba un delicioso Capuchino!</h5>
                                <p class="card-text">Un sabor suave y que da gusto probar con las hermosas figuras que se
                                    hacen cuando esta recien servido.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-12 mb-3">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset('modules/cafeto/images/1.jpg') }}" class="img-fluid rounded-start custom-img"
                                alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5>Prueba un delicioso Granizado!</h5>
                                <p class="card-text">Para empezar el día que mejor que una taza de cafe sin azúcar con el
                                    puro sabor del cafe de la Angostura.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12 mb-3">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset('modules/cafeto/images/2.jpg') }}" class="img-fluid rounded-start custom-img"
                                alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5>Prueba un delicioso Café Campesino!</h5>
                                <p class="card-text">Un sabor suave y que da gusto probar con las hermosas figuras que se
                                    hacen cuando esta recien servido.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
