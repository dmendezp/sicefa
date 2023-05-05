@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">Página principal</li>
@endpush

@section('content')
<div class="card text-center mb-3 shadow-sm">

    <div class="card-body">
        <div class="d-flex align-items-center justify-content-center">
            <div>
                <h4 class="text-center">Productos más populares del centro de formación</h4>
                <p>Punto de venta es un sitio de administración para los productos que son exportados desde aqui para todo en centro de formación entre ellos tenemos como:</p>
            </div>
        </div>

        <div class="d-flex justify-content-evenly mt-3">

            <div>
                <h6>Repostería</h6>
                <div class="card-products">
                    <img src="{{ asset('modules/ptventa/images/Card1.jpg') }}" alt="" class="img">
                    <div class="textBox">
                        <p class="text head">Donas</p>
                        <span>Crispy, Choco, Oreo y Chips</span>
                        <p class="text price">$2.000</p>
                    </div>
                </div>
            </div>

            <div>
                <h6>Lácteos</h6>
                <div class="card-products">
                    <img src="{{ asset('modules/ptventa/images/Card2.jpg') }}" alt="" class="img">
                    <div class="textBox">
                        <p class="text head">Leche</p>
                        <span>Producida en la unidad de ganaderia</span>
                        <p class="text price">$5.000 Lt</p>
                    </div>
                </div>
            </div>

            <div>
                <h6>Lácteos</h6>
                <div class="card-products">
                    <img src="{{ asset('modules/ptventa/images/Card3.jpg') }}" alt="" class="img">
                    <div class="textBox">
                        <p class="text head">Yogurt</p>
                        <span>Producido en el sector de Agroindustria</span>
                        <p class="text price">$5.000 Lt</p>
                    </div>
                </div>
            </div>

            <div>
                <h6>Verduras</h6>
                <div class="card-products">
                    <img src="{{ asset('modules/ptventa/images/Card4.jpg') }}" alt="" class="img">
                    <div class="textBox">
                        <p class="text head">Lechuga</p>
                        <span>Producida en los sectores de viveros</span>
                        <p class="text price">$6.000 Lt</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
  </div>
@endsection

@section('scripts')

@endsection
