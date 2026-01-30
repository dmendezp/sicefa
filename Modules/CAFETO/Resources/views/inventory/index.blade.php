{{-- Modules/CAFETO/Resources/views/inventory/index.blade.php --}}
@extends('cafeto::layouts.master')

@php $role = getRoleRouteName(Route::currentRouteName()); @endphp

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('cafeto.' . $role . '.inventory.index') }}"
           class="text-decoration-none">{{ trans('cafeto::inventory.Breadcrumb_Inventory_1') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('cafeto::inventory.Breadcrumb_Active_Inventory_1') }}</li>
@endpush

@section('content')
    <div class="card card-danger card-outline shadow-sm custom-border-color">
        <div class="card-body">

            <div class="row">
                <div class="col">
                    <h5 class="text-center"><em>{{ trans('cafeto::inventory.Title_Inventory') }}</em></h5>
                </div>
                <div class="col-auto">
                    <div class="d-flex justify-content-end">
                        @if (Auth::user()->havePermission('cafeto.' . $role . '.inventory.create'))
                            <a href="{{ route('cafeto.' . $role . '.inventory.create') }}"
                               class="btn btn-success btn-sm me-1">
                                <i class="fa-solid fa-thumbs-up fa-fade mr-2"></i>
                                {{ trans('cafeto::inventory.Btn_Register_Entry') }}
                            </a>
                        @endif

                        @if (Auth::user()->havePermission('cafeto.' . $role . '.inventory.status'))
                            <a href="{{ route('cafeto.' . $role . '.inventory.status') }}"
                               class="btn btn-secondary btn-sm me-1">
                                <i class="fa-solid fa-triangle-exclamation fa-fade mr-2"></i>
                                {{ trans('cafeto::inventory.Btn_Expired') }}
                            </a>
                        @endif

                        @if (Auth::user()->havePermission('cafeto.' . $role . '.inventory.low'))
                            <a href="{{ route('cafeto.' . $role . '.inventory.low') }}"
                               class="btn btn-danger btn-sm me-1">
                                <i class="fa-solid fa-arrow-down-wide-short fa-fade mr-2"></i>
                                {{ trans('cafeto::inventory.Btn_Register_Low') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <hr>

            <div class="mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <strong>{{ trans('cafeto::inventory.Popular_Title') }}</strong>
                    <small class="text-muted">{{ trans('cafeto::inventory.Popular_Help') }}</small>
                </div>

                <div class="row mt-2">
                    @for ($slot = 1; $slot <= 4; $slot++)
                        @php $item = $popularList->firstWhere('rank', $slot); @endphp

                        <div class="col-md-3 col-12 mb-2">
                            <div class="border rounded p-2 d-flex align-items-center justify-content-between">
                                <div class="me-2">
                                    <span class="badge bg-warning text-dark">#{{ $slot }}</span>
                                    <span class="ms-1">
                                        {{ $item ? $item->name : trans('cafeto::inventory.Dash_Empty') }}
                                    </span>
                                </div>
                                <i class="fas fa-star {{ $item ? 'text-warning' : 'text-muted' }}"></i>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <div class="table-responsive px-1" data-aos="zoom-in">
                <table class="table table-bordered border-secondary table-hover">
                    <thead class="table-dark">
                        <tr class="border-dark">
                            <th class="text-center">{{ trans('cafeto::inventory.1T_Number') }}</th>
                            <th>{{ trans('cafeto::inventory.2T_Product') }}</th>
                            <th class="text-center">{{ trans('cafeto::inventory.10T_Destination') }}</th>
                            <th class="text-center">{{ trans('cafeto::inventory.3T_Lot') }}</th>
                            <th class="text-center"><i class="fa-solid fa-calendar-days"></i> {{ trans('cafeto::inventory.4T_Production') }}</th>
                            <th class="text-center"><i class="fa-solid fa-calendar-days"></i> {{ trans('cafeto::inventory.5T_Expiration') }}</th>
                            <th class="text-center">{{ trans('cafeto::inventory.6T_Entry') }}</th>
                            <th class="text-center">{{ trans('cafeto::inventory.7T_Amount') }}</th>
                            <th class="text-center">{{ trans('cafeto::inventory.8T_Sale') }}</th>
                            <th class="text-center">{{ trans('cafeto::inventory.9T_Stocks') }}</th>
                            <th class="text-center">{{ trans('cafeto::inventory.10T_Action') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($groupedInventories as $row)
                            @php
                                $isPopular = !empty($row->popular_rank);

                                // Origen calculado (no revienta si no viene)
                                $origin = $row->origin ?? (!empty($row->made_by_formulation) ? 'Formulation' : 'Agroindustry');

                                $originLabel = $origin === 'Formulation'
                                    ? trans('cafeto::inventory.Origin_Formulation')
                                    : trans('cafeto::inventory.Origin_Agroindustry');

                                $toggleRouteName = 'cafeto.' . $role . '.inventory.popular.toggle';
                                $hasToggleRoute = \Illuminate\Support\Facades\Route::has($toggleRouteName);
                            @endphp

                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>

                                <td>
                                    {{ $row->name }}

                                    @if($isPopular)
                                        <span class="badge bg-warning text-dark ms-1">
                                            {{ trans('cafeto::inventory.Popular_Badge') }} #{{ $row->popular_rank }}
                                        </span>
                                    @endif

                                    @if(!empty($row->made_by_formulation))
                                        <span class="badge bg-info ms-1">{{ trans('cafeto::inventory.Origin_Formulation') }}</span>
                                    @endif
                                </td>

                                <td class="text-center">{{ $row->destination ?? trans('cafeto::inventory.Default_Destination') }}</td>
                                <td class="text-center">{{ $row->lot_number ?? trans('cafeto::inventory.Dash') }}</td>
                                <td class="text-center">{{ $row->production_date ?? trans('cafeto::inventory.Dash') }}</td>
                                <td class="text-center">{{ $row->expiration_date ?? trans('cafeto::inventory.Dash') }}</td>

                                <td class="text-center">{{ priceFormat($row->entry_price_avg ?? 0) }}</td>
                                <td class="text-center">{{ (int)($row->total_stock ?? 0) }}</td>
                                <td class="text-center">{{ priceFormat($row->sale_price ?? 0) }}</td>
                                <td class="text-center">{{ (int)($row->total_stock ?? 0) }}</td>

                                <td class="text-center">
                                    <span class="badge {{ $origin === 'Formulation' ? 'bg-info' : 'bg-secondary' }} me-1">
                                        {{ $originLabel }}
                                    </span>

                                    @if ($hasToggleRoute && Auth::user()->havePermission($toggleRouteName))
                                        <form action="{{ route($toggleRouteName, $row->element_id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm {{ $isPopular ? 'btn-warning' : 'btn-outline-warning' }}">
                                                <i class="fas fa-star"></i>
                                                {{ $isPopular ? trans('cafeto::inventory.Popular_Remove') : trans('cafeto::inventory.Popular_Add') }}
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center border-secondary">{{ trans('cafeto::inventory.No_Products') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <hr>

            <div class="row">
                <div class="col">
                    <h5 class="text-center"><em>{{ trans('cafeto::inventory.Title_Consumptions') }}</em></h5>
                </div>
            </div>

            <div class="table-responsive px-1" data-aos="zoom-in">
                <table class="table table-bordered border-secondary table-hover">
                    <thead class="table-dark">
                        <tr class="border-dark">
                            <th class="text-center">{{ trans('cafeto::inventory.1T_Number') }}</th>
                            <th>{{ trans('cafeto::inventory.Formulation_ID') }}</th>
                            <th class="text-center">{{ trans('cafeto::inventory.Date') }}</th>
                            <th>{{ trans('cafeto::inventory.Produced_Product') }}</th>
                            <th>{{ trans('cafeto::inventory.Consumed_Product') }}</th>
                            <th class="text-center">{{ trans('cafeto::inventory.Consumed_Amount') }}</th>
                            <th class="text-center">{{ trans('cafeto::inventory.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($consumptions as $consumption)
                            @php
                                $origin = $consumption->origin ?? 'Formulation';
                                $originLabel = $origin === 'Formulation'
                                    ? trans('cafeto::inventory.Origin_Formulation')
                                    : trans('cafeto::inventory.Origin_Agroindustry');
                            @endphp
                            <tr>
                                <td class="text-center border-secondary">{{ $loop->iteration }}</td>
                                <td class="border-secondary">{{ $consumption->formulation_id }}</td>
                                <td class="text-center border-secondary">{{ $consumption->date }}</td>
                                <td class="border-secondary">{{ $consumption->produced_product }}</td>
                                <td class="border-secondary">{{ $consumption->consumed_product }}</td>
                                <td class="text-center border-secondary">
                                    {{ number_format((float)$consumption->consumed_amount, 3, '.', '') }}
                                </td>
                                <td class="text-center border-secondary">
                                    <span class="badge {{ $origin === 'Formulation' ? 'bg-info' : 'bg-secondary' }}">
                                        {{ $originLabel }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center border-secondary">
                                    {{ trans('cafeto::inventory.No_Consumptions') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
