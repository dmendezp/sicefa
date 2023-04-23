@extends('ptventa::layouts.master')

@section('head')
    <style>
        .card-image {
            height: 200px;
            width: 300px;
            background-size: cover !important;
            color: white;
            position: relative;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .card-image:hover {
            opacity: 0.8;
        }

        .card-category {
            border-start-start-radius: 5px;
            border-start-end-radius: 5px;
            padding-left: 5px;
            background-color:rgba(0, 0, 0, 0.386);
            width: 100%;
            position: absolute;
            font-size: 15px;
        }

        .card-description {
            border-end-start-radius: 5px;
            border-end-end-radius: 5px;
            bottom: 0px;
            width: 100%;
            height: 30px;
            position: absolute;
            padding-inline: 10px;
            background-color: OliveDrab;
            font-size: 14px;
        }
    </style>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Inicio</a></li>
    <li class="breadcrumb-item active">Productos</li>
    <li class="breadcrumb-item active">Imágenes</li>
@endsection

@section('content')
    <div class="card card-success card-outline">
        <div class="card-body">

                <div class="d-inline-flex">
                    <div class="row  justify-content-center mx-auto">
                        @foreach ($elements as $e)
                            <div class="col-auto">
                                <div class="card-image" style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.2)), url('{{ asset($e->image) }}'), url('{{ asset('modules/sica/images/sinImagen.png') }}');">
                                    <div class="card-category text-center"><strong>{{ $e->name }}</strong></div>
                                    <div class="card-description">
                                        <p class="mt-1">
                                            {{ $e->category->name }}
                                            <a href="#" class="text-light float-right">
                                                <i class="fa-solid fa-pen-to-square fs-6"></i>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

        </div>
    </div>
@endsection

@section('scripts')
@endsection
