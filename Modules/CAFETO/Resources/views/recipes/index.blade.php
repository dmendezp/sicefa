@extends('cafeto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.recipes.index') }}" class="text-decoration-none">{{ trans('cafeto::recipes.Breadcrumb_Recipes_1') }}</a></li>
    <li class="breadcrumb-item active">{{ trans('cafeto::recipes.Breadcrumb_Active_Recipes_1') }}</li>
@endpush

@section('content')
    <div class="container">
        <h1>Welcome to the Recipes Index Page</h1>
        <p>This is the content of the recipes index page.</p>
        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th>Fecha de creación</th>
                        <th>Propietario</th>
                        <th>Nombre del producto</th>
                        <th>Cantidad de producción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($formulations as $f)
                        <tr>
                            <td>{{ $f->date }}</td>
                            <td>{{ $f->person->full_name }}</td>
                            <td>{{ $f->element->product_name }}</td>
                            <td>{{ $f->amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
