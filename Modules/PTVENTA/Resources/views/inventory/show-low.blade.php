@extends('ptventa::layouts.master')

@push('head')
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active">
        <a href="{{ route('ptventa.' . getRoleRouteName(Route::currentRouteName()) . '.movements.index') }}"
            class="text-decoration-none">{{ trans('ptventa::inventory.Breadcrumb_Movement_Inventory_1') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('ptventa::inventory.Breadcrumb_Active_Movement_Inventory_1') }}</li>
@endpush

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="ribbon-wrapper ribbon-xl">
                    <div class="ribbon bg-olive">
                        {{ trans('ptventa::inventory.Form_Title_Number_Voucher') }} {{ $movement->voucher_number }}
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-3">
                        <label class="form-label">{{ trans('ptventa::inventory.Form_Title_Warehouse_Origin') }}</label>
                        <input type="text" class="form-control" value="{{ $movement->warehouse_movements->where('role', 'Entrega')->first()->productive_unit_warehouse->warehouse->name }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ trans('ptventa::inventory.Form_Title_Responsible_Low') }}</label>
                        <input type="text" class="form-control"
                            value="{{ $movement->movement_responsibilities->where('role', 'ENTREGA')->first()->person->full_name }}"
                            readonly>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">{{ trans('ptventa::inventory.Form_Title_Date_Execution') }}</label>
                        <input type="text" class="form-control" value="{{ $movement->registration_date }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ trans('ptventa::inventory.Form_Title_Movement_Type') }}</label>
                        <input type="text" class="form-control" value="{{ $movement->movement_type->name }}" readonly>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="text-center">{{ trans('ptventa::inventory.6T_Number') }}</th>
                                <th scope="col">{{ trans('ptventa::inventory.6T_Product') }}</th>
                                <th scope="col" class="text-center">{{ trans('ptventa::inventory.6T_Amount') }}</th>
                                <th scope="col" class="text-center">{{ trans('ptventa::inventory.6T_Price') }}</th>
                                <th scope="col" class="text-center">{{ trans('ptventa::inventory.6T_Total') }}</th>
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
                                <td class="text-center fw-bold">{{ trans('ptventa::inventory.6T_Total:') }}</td>
                                <td class="text-center fw-bold">{{ priceFormat($movement->price) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="text-center mt-4">
                    <button class="btn btn-danger">{{ trans('ptventa::inventory.Btn_Generate_PDF') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Recursos para los formatedores de datos -->
    <script src="{{ asset('libs/cleave.js-1.6.0/dist/cleave.js') }}"></script>
    <!-- Formateadores de datos -->
    <script src="{{ asset('modules/ptventa/js/data-formats.js') }}"></script>
@endpush
