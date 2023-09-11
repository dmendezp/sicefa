@extends('ptventa::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/ptventa/css/custom_styles.css') }}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.'.getRoleRouteName(Route::currentRouteName()).'.reports.index') }}"
            class="text-decoration-none">{{ trans('ptventa::reports.Breadcrumb_Reports_1') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('ptventa::reports.Breadcrumb_Active_Sales_1') }}</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row mb-3">
                        <div class="col-md-auto">
                            <form class="form-inline" action="{{ route('ptventa.'.getRoleRouteName(Route::currentRouteName()).'.reports.generate.sales') }}"
                                method="POST">
                                @csrf
                                <div class="form-group mr-3">
                                    <label class="mr-2">{{ trans('ptventa::reports.Title_Form_Start_Date') }}</label>
                                    <input type="date" class="form-control" name="start_date" id="start_date" value="{{ $start_date }}" required>
                                </div>
                                <div class="form-group mr-3">
                                    <label class="mr-2">{{ trans('ptventa::reports.Title_Form_End_Date') }}</label>
                                    <input type="date" class="form-control" name="end_date" id="end_date" value="{{ $end_date }}" required>
                                </div>
                                @if(Auth::user()->havePermission('ptventa.'.getRoleRouteName(Route::currentRouteName()).'.reports.generate.sales'))
                                    <button type="submit" class="btn btn-primary">
                                        {{ trans('ptventa::reports.Btn_Search') }}
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                @endif
                            </form>
                        </div>
                        <div class="col-md">
                            @if(Auth::user()->havePermission('ptventa.'.getRoleRouteName(Route::currentRouteName()).'.reports.generate.sales.pdf'))
                                <form action="{{ route('ptventa.'.getRoleRouteName(Route::currentRouteName()).'.reports.generate.sales.pdf') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="start_date" value="{{ $start_date }}">
                                    <input type="hidden" name="end_date" value="{{ $end_date }}">
                                    <button type="submit" class="btn btn-danger">
                                        {{ trans('ptventa::reports.Btn_Generate_PDF') }}
                                        <i class="fa-solid fa-file-pdf"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <hr>

                    @if (isset($movements) && $movements->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th class=text-center>{{ trans('ptventa::reports.2T_Number') }}</th>
                                        <th class="text-center">{{ trans('ptventa::reports.2T_Voucher') }}</th>
                                        <th>{{ trans('ptventa::reports.2T_Responsible_Delivery') }}</th>
                                        <th>{{ trans('ptventa::reports.2T_Registration_Date') }}</th>
                                        <th>{{ trans('ptventa::reports.2T_Product') }}</th>
                                        <th class="text-center">{{ trans('ptventa::reports.2T_Amount') }}</th>
                                        <th class="text-center">{{ trans('ptventa::reports.2T_Price') }}</th>
                                        <th class="text-center">{{ trans('ptventa::reports.2T_Subtotal') }}</th>
                                        <th class="text-center">{{ trans('ptventa::reports.2T_Total') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $rowNumber = 0; // Variable para hacer un seguimiento del número de fila actual
                                    @endphp

                                    @foreach ($movements as $key => $movement)
                                        @foreach ($movement->movement_details as $index => $movement_detail)
                                            <tr>
                                                @if ($index === 0)
                                                    {{-- Verificar si es la primera fila del movimiento --}}
                                                    <td class="text-center"
                                                        rowspan="{{ count($movement->movement_details) }}"
                                                        style="vertical-align: middle;">{{ $key + 1 }}</td>
                                                    <td class="text-center"
                                                        rowspan="{{ count($movement->movement_details) }}"
                                                        style="vertical-align: middle;">{{ $movement->voucher_number }}
                                                    </td>
                                                    <td rowspan="{{ count($movement->movement_details) }}"
                                                        style="vertical-align: middle;">
                                                        {{ $movement->movement_responsibilities->where('role', 'CLIENTE')->first()->person->full_name }}
                                                    </td>
                                                    <td rowspan="{{ count($movement->movement_details) }}"
                                                        style="vertical-align: middle;">{{ $movement->registration_date }}
                                                    </td>
                                                @endif
                                                <td>{{ $movement_detail->inventory->element->product_name }}</td>
                                                <td class="text-center">{{ $movement_detail->amount }}</td>
                                                <td class="text-center">{{ priceFormat($movement_detail->price) }}</td>
                                                <td class="text-center">
                                                    {{ priceFormat($movement_detail->amount * $movement_detail->price) }}
                                                </td>
                                                @if ($index === 0)
                                                    {{-- Solo mostrar el precio en la primera fila del movimiento --}}
                                                    <td class="text-center fw-bold"
                                                        rowspan="{{ count($movement->movement_details) }}"
                                                        style="vertical-align: middle;">{{ priceFormat($movement->price) }}
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    @php

                                        $totalTotal = 0;
                                    @endphp

                                    @foreach ($movements as $key => $movement)
                                        @php
                                            $totalTotal += $movement->price;
                                        @endphp
                                    @endforeach

                                    <tr>
                                        <td colspan="8" class="text-end fw-bold">Total:</td>
                                        <td class="text-center fw-bold">{{ priceFormat($totalTotal) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @else
                        <p>{{ trans('ptventa::reports.2T_Text_Optional') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@include('ptventa::layouts.partials.plugins.sweetalert2')

@push('scripts')
    <script>
        // Función para actualizar los atributos min y max de los campos de fecha
        function updateDateAttributes() {
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');

            endDateInput.min = startDateInput.value;
            startDateInput.max = endDateInput.value;
        }

        // Eventos para actualizar los atributos al cambiar las fechas
        document.getElementById('start_date').addEventListener('change', updateDateAttributes);
        document.getElementById('end_date').addEventListener('change', updateDateAttributes);
    </script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'info',
            title: '{{ trans('ptventa::reports.Title') }}'
        })
    </script>
@endpush
