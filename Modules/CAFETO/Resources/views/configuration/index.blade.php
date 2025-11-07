@extends('cafeto::layouts.master')

@push('head')
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('cafeto::configuration.Breadcrumb_Active_Configuration') }}</li>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>{{ trans('cafeto::configuration.Title_Card_Ticket') }}</h4>
                            <p>{{ trans('cafeto::configuration.Text_Card_Ticket') }}</p>
                            @if (Auth::user()->havePermission(
                                    'cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.configuration.postprinting'))
                                <button class="btn btn-success"
                                    id="imprimirBtn">{{ trans('cafeto::configuration.Btn_Generate_Ticket') }}
                                    <i class="fa-solid fa-ticket"></i>
                                </button>
                            @endif
                        </div>
                        <div class="col-md-4 position-relative">
                            <div class="position-absolute start-0 top-0 bottom-0 bg-gradient-fade"></div>
                            <img class="img-fluid" src="{{ asset('modules/cafeto/images/configuration/ticket.webp') }}"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('cafeto::layouts.partials.plugins.sweetalert2')

@push('scripts')
    {{-- Ruta de la estructura fuente del plugin de Parzibyte - Impresoras termicas v3 --}}
    <script src="{{ asset('modules/cafeto/js/sale/conector_javascript_POS80C.js') }}"></script>
    <script src="{{ asset('js/ticket-test.js') }}"></script>
@endpush
