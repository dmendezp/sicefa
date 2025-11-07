@extends('cafeto::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/cafeto/css/card_reports_styles.css') }}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('cafeto.'.getRoleRouteName(Route::currentRouteName()).'.reports.index') }}"
            class="text-decoration-none">{{ trans('cafeto::reports.Breadcrumb_Reports_1') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('cafeto::reports.Breadcrumb_Active_Inventory_1') }}</li>
@endpush

@section('content')
    <div class="container">
        <div class="card d-flex justify-content-evenly align-items-center">
            <div class="card-body">
                <h3 class="text-center">{{ trans('cafeto::reports.Title_Select_Report') }}</h3>
                <hr>
                <div class="row">
                    @if(Auth::user()->havePermission('cafeto.'.getRoleRouteName(Route::currentRouteName()).'.reports.inventory.generate.pdf'))
                        <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-duration="1000">
                            <!-- Botón para generar el PDF -->
                            <form method="post" action="{{ route('cafeto.'.getRoleRouteName(Route::currentRouteName()).'.reports.inventory.generate.pdf') }}">
                                @csrf
                                <button type="submit" class="card-custom card-custom">
                                    <div class="icon">
                                        <i class="fa-solid fa-file-pdf"></i>
                                    </div>
                                    <p class="title">{{ trans('cafeto::reports.Title_Card_Inventory') }}</p>
                                    <p class="text">{{ trans('cafeto::reports.Text_Card_Inventory') }}</p>
                                </button>
                            </form>
                        </div>
                    @endif
                    @if(Auth::user()->havePermission('cafeto.'.getRoleRouteName(Route::currentRouteName()).'.reports.inventory.entries'))
                        <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-duration="2000">
                            <a class="card-custom a-custom" href="{{ route('cafeto.'.getRoleRouteName(Route::currentRouteName()).'.reports.inventory.entries') }}">
                                <div class="icon">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </div>
                                <p class="title">{{ trans('cafeto::reports.Title_Card_Inventory_Entries') }}</p>
                                <p class="text">{{ trans('cafeto::reports.Text_Card_Inventory_Entries') }}</p>
                            </a>
                        </div>
                    @endif
                    @if(Auth::user()->havePermission('cafeto.'.getRoleRouteName(Route::currentRouteName()).'.reports.sales'))
                        <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-duration="3000">
                            <a class="card-custom a-custom" href="{{ route('cafeto.'.getRoleRouteName(Route::currentRouteName()).'.reports.sales') }}">
                                <div class="icon">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </div>
                                <p class="title">{{ trans('cafeto::reports.Title_Card_Inventory_Sales') }}</p>
                                <p class="text">{{ trans('cafeto::reports.Text_Card_Inventory_Sales') }}</p>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
