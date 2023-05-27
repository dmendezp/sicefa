@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <div class="col-sm-6">
        <h1 class="m-0">{{-- Text --}}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Página principal</li>
        </ol>
    </div>
@endpush

@section('content')
    <h1 class="display-3">{{ $view['titleView'] }}</h1>
    <p>Punto de venta es una unidad productiva perteneciente al centro de Formación Agroindustrial "La Angostura", aqui se
        ofertan los diferentes
        productos que se fabrican en este centro, contamos con productos que provienen directamente del campo como tambien
        aquellos que con son procesados en el sector de agroindustria.
    </p>

    <div class="row">
        <div class="col-md-6">
            <div class="card text-center mb-3 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-center">
                        <div>
                            <h4 class="text-center">Productos más populares del centro de formación</h4>
                            <p>Punto de venta es un sitio de administración para los productos que son exportados desde aquí
                                para todo en centro de formación entre ellos tenemos como:</p>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap justify-content-center mt-3">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <h5 class="text-center">Frutas</h5>
                            <div class="card-products mx-auto">
                                <img src="{{ asset('modules/ptventa/images/Card6.jpg') }}" alt=""
                                    class="card-img-top">
                                <div class="card-body">
                                    <p class="card-text head">Piña</p>>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <h5 class="text-center">Lácteos</h5>
                            <div class="card-products mx-auto">
                                <img src="{{ asset('modules/ptventa/images/Card3.jpg') }}" alt=""
                                    class="card-img-top">
                                <div class="card-body">
                                    <p class="card-text head">Yogurt</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <h5 class="text-center">Verduras</h5>
                            <div class="card-products mx-auto">
                                <img src="{{ asset('modules/ptventa/images/Card4.jpg') }}" alt=""
                                    class="card-img-top">
                                <div class="card-body">
                                    <p class="card-text head">Lechuga</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-center mb-3 shadow-sm">
                <div class="card-body">
                    <hr class="featurette-divider">
                    <div class="row featurette align-items-center">
                        <div class="col-md-7 order-md-2">
                            <h2 class="featurette-heading">Oh, sí, es tan bueno. <span class="text-muted">Míralo tú
                                    mismo.</span></h2>
                            <p class="lead">Prueba unos deliciosos Croissant, hechos por las mejores manos de los
                                aprendices del centro de formación, es decir de los tecnólogos que se dan en el complejo
                                agroindustrial.</p>
                        </div>
                        <div class="col-md-5 order-md-1">
                            <img src="{{ asset('modules/ptventa/images/Card5.jpg') }}" alt="" class="img-fluid"
                                width="300" height="300">
                        </div>
                    </div>
                    <hr class="featurette-divider">
                </div>
            </div>
        </div>
@endsection

@section('scripts')
@endsection
