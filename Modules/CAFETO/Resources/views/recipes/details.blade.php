@extends('cafeto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item"><a
            href="{{ route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.recipes.index') }}"
            class="text-decoration-none">{{ trans('cafeto::recipes.Breadcrumb_Recipes_1') }}</a></li>
    <li class="breadcrumb-item active">{{ trans('cafeto::recipes.Breadcrumb_Active_Details_Recipes_1') }}</li>
@endpush

@section('content')
    <div class="card card-danger card-outline shadow-sm custom-border-color">
        <div class="card-body">
            
        </div>
    </div>
@endsection
