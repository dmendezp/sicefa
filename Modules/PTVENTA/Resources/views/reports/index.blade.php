@extends('ptventa::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/ptventa/css/card_reports_styles.css') }}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.'.getRoleRouteName(Route::currentRouteName()).'.reports.index') }}"
            class="text-decoration-none">{{ trans('ptventa::reports.Reports') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('ptventa::reports.Reports Panel') }}</li>
@endpush

@section('content')
    <div class="container">
        <div class="card d-flex justify-content-evenly align-items-center">
            <div class="card-body">
                <h3 class="text-center">{{ trans('ptventa::reports.Title') }}</h3>
                <hr>
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <!-- Botón para generar el PDF -->
                        <form method="post" action="{{ route('ptventa.'.getRoleRouteName(Route::currentRouteName()).'.reports.inventory.generate.pdf') }}">
                            @csrf
                            <button type="submit" class="card-custom card-custom">
                                <div class="icon">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </div>
                                <p class="title">{{ trans('ptventa::reports.TitleCard1') }}</p>
                                <p class="text">{{ trans('ptventa::reports.TextCard1') }}</p>
                            </button>
                        </form>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <a class="card-custom a-custom" href="{{ route('ptventa.'.getRoleRouteName(Route::currentRouteName()).'.reports.inventory.entries') }}">
                            <div class="icon">
                                <i class="fa-solid fa-file-pdf"></i>
                            </div>
                            <p class="title">{{ trans('ptventa::reports.TitleCard2') }}</p>
                            <p class="text">{{ trans('ptventa::reports.TextCard2') }}</p>
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <a class="card-custom a-custom" href="{{ route('ptventa.'.getRoleRouteName(Route::currentRouteName()).'.reports.sales') }}">
                            <div class="icon">
                                <i class="fa-solid fa-file-pdf"></i>
                            </div>
                            <p class="title">{{ trans('ptventa::reports.TitleCard3') }}</p>
                            <p class="text">{{ trans('ptventa::reports.TextCard3') }}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
