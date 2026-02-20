@extends('cafeto::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/cafeto/css/custom_styles.css') }}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('cafeto.'.getRoleRouteName(Route::currentRouteName()).'.reports.index') }}"
            class="text-decoration-none">{{ trans('cafeto::reports.Breadcrumb_Reports_1') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('cafeto::reports.Breadcrumb_Active_Sales_1') }}</li>
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">

                    <div class="row mb-3 align-items-end">
                        <div class="col-md-auto">
                            {{-- Búsqueda --}}
                            <form class="form-inline"
                                  action="{{ route('cafeto.'.getRoleRouteName(Route::currentRouteName()).'.reports.generate.sales') }}"
                                  method="POST">
                                @csrf
                                <div class="form-group mr-3">
                                    <label class="mr-2">{{ trans('cafeto::reports.Title_Form_Start_Date') }}</label>
                                    <input type="date" class="form-control" name="start_date" id="start_date" value="{{ $start_date }}" required>
                                </div>
                                <div class="form-group mr-3">
                                    <label class="mr-2">{{ trans('cafeto::reports.Title_Form_End_Date') }}</label>
                                    <input type="date" class="form-control" name="end_date" id="end_date" value="{{ $end_date }}" required>
                                </div>
                                @if(Auth::user()->havePermission('cafeto.'.getRoleRouteName(Route::currentRouteName()).'.reports.generate.sales'))
                                    <button type="submit" class="btn btn-primary">
                                        {{ trans('cafeto::reports.Btn_Search') }}
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                @endif
                            </form>
                        </div>

                        {{-- Botones: Reporte de Ventas y Reporte de Productos --}}
                        <div class="col-md d-flex gap-2">
                            @if(Auth::user()->havePermission('cafeto.'.getRoleRouteName(Route::currentRouteName()).'.reports.generate.sales.pdf'))
                                <form action="{{ route('cafeto.'.getRoleRouteName(Route::currentRouteName()).'.reports.generate.sales.pdf') }}"
                                      method="post" target="_blank" class="m-0">
                                    @csrf
                                    <input type="hidden" name="start_date" value="{{ $start_date }}">
                                    <input type="hidden" name="end_date" value="{{ $end_date }}">
                                    <button type="submit" class="btn btn-danger">
                                        {{ trans('cafeto::reports.Btn_Generate_Sales_Report') }}
                                        <i class="fa-solid fa-file-pdf"></i>
                                    </button>
                                </form>
                            @endif

@if(Auth::user()->havePermission('cafeto.'.getRoleRouteName(Route::currentRouteName()).'.reports.generate.sales.products.pdf'))
    <form action="{{ route('cafeto.'.getRoleRouteName(Route::currentRouteName()).'.reports.generate.sales.products.pdf') }}"
          method="post" target="_blank" class="m-0">
        @csrf
        <input type="hidden" name="start_date" value="{{ $start_date }}">
        <input type="hidden" name="end_date" value="{{ $end_date }}">
        <button type="submit" class="btn btn-outline-secondary">
            {{ trans('cafeto::reports.Btn_Generate_Products_Report') }}
            <i class="fa-solid fa-box-open"></i>
        </button>
    </form>
@endif
                        </div>
                    </div>

                    <hr>

                    {{-- Tabla de ventas detalladas --}}
                    @if (isset($movements) && $movements->count() > 0)
                        <h4 class="mb-3">{{ trans('cafeto::reports.Title_Sales_Detailed') }}</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center">{{ trans('cafeto::reports.2T_Number') }}</th>
                                        <th class="text-center">{{ trans('cafeto::reports.2T_Voucher') }}</th>
                                        <th>{{ trans('cafeto::reports.2T_Responsible_Delivery') }}</th>
                                        <th>{{ trans('cafeto::reports.2T_Registration_Date') }}</th>
                                        <th>{{ trans('cafeto::reports.2T_Product') }}</th>
                                        <th class="text-center">{{ trans('cafeto::reports.2T_Amount') }}</th>
                                        <th class="text-center">{{ trans('cafeto::reports.2T_Price') }}</th>
                                        <th class="text-center">{{ trans('cafeto::reports.2T_Subtotal') }}</th>
                                        <th class="text-center">{{ trans('cafeto::reports.2T_Total') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($movements as $key => $movement)
                                        @foreach ($movement->movement_details as $index => $movement_detail)
                                            <tr>
                                                @if ($index === 0)
                                                    <td class="text-center" rowspan="{{ count($movement->movement_details) }}" style="vertical-align: middle;">{{ $key + 1 }}</td>
                                                    <td class="text-center" rowspan="{{ count($movement->movement_details) }}" style="vertical-align: middle;">{{ $movement->voucher_number }}</td>
                                                    <td rowspan="{{ count($movement->movement_details) }}" style="vertical-align: middle;">
                                                        {{ $movement->movement_responsibilities->where('role', 'CLIENTE')->first()->person->full_name }}
                                                    </td>
                                                    <td rowspan="{{ count($movement->movement_details) }}" style="vertical-align: middle;">{{ $movement->registration_date }}</td>
                                                @endif
                                                <td>{{ $movement_detail->inventory->element->product_name }}</td>
                                                <td class="text-center">{{ $movement_detail->amount }}</td>
                                                <td class="text-center">{{ priceFormat($movement_detail->price) }}</td>
                                                <td class="text-center">{{ priceFormat($movement_detail->amount * $movement_detail->price) }}</td>
                                                @if ($index === 0)
                                                    <td class="text-center fw-bold" rowspan="{{ count($movement->movement_details) }}" style="vertical-align: middle;">{{ priceFormat($movement->price) }}</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    @php $totalTotal = 0; @endphp
                                    @foreach ($movements as $movement)
                                        @php $totalTotal += $movement->price; @endphp
                                    @endforeach
                                    <tr>
                                        <td colspan="8" class="text-end fw-bold">Total:</td>
                                        <td class="text-center fw-bold">{{ priceFormat($totalTotal) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        {{-- Productos vendidos agrupados --}}
                        @if (isset($groupedProducts) && count($groupedProducts) > 0)
                            <h4 class="mt-5 mb-3">{{ trans('cafeto::reports.Title_Products_Sold') }}</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>{{ trans('cafeto::reports.2T_Product') }}</th>
                                            <th class="text-center">{{ trans('cafeto::reports.2T_Amount') }}</th>
                                            <th class="text-center">{{ trans('cafeto::reports.2T_Price') }}</th>
                                            <th class="text-center">{{ trans('cafeto::reports.2T_Subtotal') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $totalProducts = 0; @endphp
                                        @foreach ($groupedProducts as $item)
                                            @php $totalProducts += $item['subtotal']; @endphp
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $item['producto'] }}</td>
                                                <td class="text-center">{{ $item['cantidad'] }}</td>
                                                <td class="text-center">
                                                    @if ($item['min_price'] == $item['max_price'])
                                                        {{ priceFormat($item['min_price']) }}
                                                    @else
                                                        {{ priceFormat($item['min_price']) }} - {{ priceFormat($item['max_price']) }}
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ priceFormat($item['subtotal']) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class="text-end fw-bold">Total General:</td>
                                            <td class="text-center fw-bold">{{ priceFormat($totalProducts) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @endif
                    @else
                        <p>{{ trans('cafeto::reports.2T_Text_Optional') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@include('cafeto::layouts.partials.plugins.sweetalert2')

@push('scripts')
    <script>
        function updateDateAttributes() {
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');
            endDateInput.min = startDateInput.value;
            startDateInput.max = endDateInput.value;
        }
        document.getElementById('start_date').addEventListener('change', updateDateAttributes);
        document.getElementById('end_date').addEventListener('change', updateDateAttributes);
    </script>
    <script>
        const Toast = Swal.mixin({
            toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true,
            didOpen: (t) => { t.addEventListener('mouseenter', Swal.stopTimer); t.addEventListener('mouseleave', Swal.resumeTimer); }
        })
        Toast.fire({ icon: 'info', title: '{{ trans('cafeto::reports.Title') }}' })
    </script>
@endpush