@extends('cafeto::layouts.master')

@push('head')
    <!-- Estilos de la galería de imágenes -->
    <link rel="stylesheet" href="{{ asset('modules/cafeto/css/image-gallery-styles.css') }}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item"><a
            href="{{ route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.recipes.index') }}"
            class="text-decoration-none">{{ trans('cafeto::recipes.Breadcrumb_Recipes_1') }}</a></li>
    <li class="breadcrumb-item active">{{ trans('cafeto::recipes.Breadcrumb_Active_Details_Recipes_1') }}</li>
@endpush

@section('content')
    <div class="card card-danger card-outline shadow-sm custom-border-color">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="e-card playing">
                        <div class="image"></div>
                        <div class="wave"></div>
                        <div class="wave"></div>
                        <div class="wave"></div>

                        <div class="infotop">
                            <img src="{{ asset('modules/cafeto/images/gifs/recipes.gif') }}" alt="dish img"
                                style="max-width: 30%; height: auto;">
                            <br>
                            Granizado con chispas de chocolate
                            <br>
                            <div class="name">Por: Jesús David Guevara Munar</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <h4>Receta para creación de 1 granizado</h4>
                            <p>Ingredientes:</p>
                            <ul>
                                <li>1 taza de café</li>
                                <li>1 taza de leche</li>
                                <li>1/2 taza de azúcar</li>
                                <li>1 taza de hielo</li>
                                <li>1/2 taza de chispas de chocolate</li>
                            </ul>
                            <p>Preparación:</p>
                            <ol>
                                <li>En una licuadora, mezcle el café, la leche, el azúcar y el hielo hasta que esté suave.
                                </li>
                                <li>Vierte en un vaso y agrega las chispas de chocolate.</li>
                                <li>Sirva inmediatamente.</li>
                            </ol>
                            <div class="d-flex flex-row-reverse">
                                <button class="btn btn-danger mx-1">Eliminar receta</button>
                                <button class="btn btn-warning mx-1">Editar receta</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
