@extends('cafeto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.recipes.index') }}" class="text-decoration-none">{{ trans('cafeto::recipes.Breadcrumb_Recipes_1') }}</a></li>
    <li class="breadcrumb-item active">{{ trans('cafeto::recipes.Breadcrumb_Active_Recipes_1') }}</li>
@endpush

@section('content')
    <div class="container">
        <h1>Welcome to the Recipes Index Page</h1>
        <p>This is the content of the recipes index page.</p>
    </div>
@endsection