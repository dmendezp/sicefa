@extends('ptventa::layouts.master')

@push('head')
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">
        <a href="{{ route('ptventa.' . getRoleRouteName(Route::currentRouteName()) . '.movements.index') }}"
            class="text-decoration-none">{{ trans('ptventa::inventory.B4') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('ptventa::inventory.B5') }}</li>
@endpush

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="ribbon-wrapper ribbon-xl">
                    <div class="ribbon bg-olive">
                        {{ trans('ptventa::inventory.FormText1') }} {{ $movement->voucher_number }}
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-4">
                        <label class="form-label">{{ trans('ptventa::inventory.FormText2') }}</label>
                        <input type="text" class="form-control" value="{{ $movement->warehouse_movements->where('role', 'Entrega')->first()->productive_unit_warehouse->warehouse->name }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ trans('ptventa::inventory.FormText3') }}</label>
                        <input type="text" class="form-control"
                            value="{{ $movement->movement_responsibilities->where('role', 'ENTREGA')->first()->person->full_name }}"
                            readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ trans('ptventa::inventory.FormText4') }}</label>
                        <input type="text" class="form-control" value="{{ $movement->registration_date }}" readonly>
                    </div>
                </div>

                <div class="row mt-1">
                    <div class="col-md-4">
                        <label class="form-label">{{ trans('ptventa::inventory.FormText5') }}</label>
                        <input type="text" class="form-control"
                            value="{{ $movement->warehouse_movements->where('role', 'Recibe')->first()->productive_unit_warehouse->warehouse->name }}" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">{{ trans('ptventa::inventory.FormText6') }}</label>
                        <input type="text" class="form-control"
                            value="{{ $movement->movement_responsibilities->where('role', 'RECIBE')->first()->person->full_name }}"
                            readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ trans('ptventa::inventory.FormText7') }}</label>
                        <input type="text" class="form-control" value="{{ $movement->movement_type->name }}" readonly>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="text-center">{{ trans('ptventa::inventory.3T1') }}</th>
                                <th scope="col">{{ trans('ptventa::inventory.3T2') }}</th>
                                <th scope="col" class="text-center">{{ trans('ptventa::inventory.3T3') }}</th>
                                <th scope="col" class="text-center">{{ trans('ptventa::inventory.3T4') }}</th>
                                <th scope="col" class="text-center">{{ trans('ptventa::inventory.3T5') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($movement->movement_details as $md)
                                <tr>
                                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                    <td>{{ $md->inventory->element->name }}</td>
                                    <td class="text-center">{{ $md->amount }}</td>
                                    <td class="text-center fw-bold">{{ priceFormat($md->price) }}</td>
                                    <td class="text-center fw-bold">{{ priceFormat($md->price * $md->amount) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <td class="text-center fw-bold">Total:</td>
                                <td class="text-center fw-bold">{{ priceFormat($movement->price) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="text-center mt-4">
                    <button class="btn btn-success">{{ trans('ptventa::inventory.Btn5') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Scripts del plugin para imprimer en impresoras termicas -->
    <script src="{{ asset('modules/ptventa/js/sale/conector_javascript_POS80C.js') }}"></script>
    <!-- Recursos para los formatedores de datos -->
    <script src="{{ asset('libs/cleave.js-1.6.0/dist/cleave.js') }}"></script>
    <!-- Formateadores de datos -->
    <script src="{{ asset('modules/ptventa/js/data-formats.js') }}"></script>
    <!-- Scripts del componente register-sale -->
    <script src="{{ asset('modules/ptventa/js/print/pos_print.js') }}"></script>
    <!-- Scripts del componente register-sale -->
    <script src="{{ asset('modules/ptventa/js/sale/register/livewire-register-sale.js') }}"></script>
@endpush