@extends('cafeto::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/cafeto/css/card_reports_styles.css') }}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('cafeto.reports.index') }}"
            class="text-decoration-none">Reportes</a>
    </li>
    <li class="breadcrumb-item active">Panel de Reportes</li>
@endpush

@section('content')
    <div class="container">
        <div class="card d-flex justify-content-evenly align-items-center">
            <div class="card-body">
                <h3 class="text-center">{{ trans('cafeto::reports.Title') }}</h3>
                <hr>
                <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <!-- Botón para generar el PDF -->
                            {{-- <form method="post" action="{{ route('cafeto.'.getRoleRouteName(Route::currentRouteName()).'.reports.inventory.generate.pdf') }}"> --}}
                                @csrf
                                <button type="submit" class="card-custom card-custom">
                                    <div class="icon">
                                        <i class="fa-solid fa-file-pdf"></i>
                                    </div>
                                    <p class="title">{{ trans('cafeto::reports.TitleCard1') }}</p>
                                    <p class="text">{{ trans('cafeto::reports.TextCard1') }}</p>
                                </button>
                            {{-- </form> --}}
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <a class="card-custom a-custom" href="{{-- {{ route('cafeto.reports.inventory.entries') }} --}}">
                                <div class="icon">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </div>
                                <p class="title">{{ trans('cafeto::reports.TitleCard2') }}</p>
                                <p class="text">{{ trans('cafeto::reports.TextCard2') }}</p>
                            </a>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <a class="card-custom a-custom" href="{{-- {{ route('cafeto.reports.sales') }} --}}">
                                <div class="icon">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </div>
                                <p class="title">{{ trans('cafeto::reports.TitleCard3') }}</p>
                                <p class="text">{{ trans('cafeto::reports.TextCard3') }}</p>
                            </a>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush