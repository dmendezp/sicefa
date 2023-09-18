@extends('cafeto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.index') }}"
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
                        @if (Auth::user()->havePermission('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.create'))
                            <a href="{{ route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.create') }}"
                                class="btn btn-success btn-sm me-1">
                                <i
                                    class="fa-solid fa-thumbs-up fa-fade mr-2"></i>{{ trans('cafeto::inventory.Btn_Register_Entry') }}
                            </a>
                        @endif
                        @if (Auth::user()->havePermission('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.status'))
                            <a href="{{ route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.status') }}"
                                class="btn btn-secondary btn-sm me-1">
                                <i
                                    class="fa-solid fa-triangle-exclamation fa-fade mr-2"></i>{{ trans('cafeto::inventory.Btn_Expired') }}
                            </a>
                        @endif
                        @if (Auth::user()->havePermission('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.low'))
                            <a href="{{ route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.inventory.low') }}"
                                class="btn btn-danger btn-sm me-1">
                                <i
                                    class="fa-solid fa-arrow-down-wide-short fa-fade mr-2"></i>{{ trans('cafeto::inventory.Btn_Register_Low') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <hr>

            <div class="table-responsive px-1" data-aos="zoom-in">
                <table class="table table-bordered border-secondary table-hover">
                    <thead class="table-dark">
                        <tr class="border-dark">
                            <th class="text-center">{{ trans('cafeto::inventory.1T_Number') }}</th>
                            <th>{{ trans('cafeto::inventory.2T_Product') }}</th>
                            <th class="text-center">{{ __('cafeto::inventory.10T_Destination') }}</th>
                            <th class="text-center">{{ trans('cafeto::inventory.3T_Lot') }}</th>
                            <th class="text-center">
                                <i class="fa-solid fa-calendar-days"></i>
                                {{ trans('cafeto::inventory.4T_Production') }}
                            </th>
                            <th class="text-center">
                                <i class="fa-solid fa-calendar-days"></i>
                                {{ trans('cafeto::inventory.5T_Expiration') }}
                            </th>
                            <th class="text-center">{{ trans('cafeto::inventory.6T_Entry') }}</th>
                            <th class="text-center">{{ trans('cafeto::inventory.7T_Amount') }}</th>
                            <th class="text-center">{{ trans('cafeto::inventory.8T_Sale') }}</th>
                            <th class="text-center">{{ trans('cafeto::inventory.9T_Stocks') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($groupedInventories as $group)
                            @php
                                $firstRecord = $group->first();
                                $rowspan = $group->count();
                            @endphp
                            <tr>
                                <td rowspan="{{ $rowspan }}" class="text-center border-secondary align-middle">
                                    {{ $loop->iteration }}</td>
                                <td rowspan="{{ $rowspan }}" class="border-secondary align-middle">
                                    <strong>{{ $firstRecord->element->name }}</strong>
                                </td>
                                <td class="text-center border-secondary">{{ $firstRecord->destination }}</td>
                                <td class="text-center border-secondary">{{ $firstRecord->lot_number }}</td>
                                <td class="text-center border-secondary">{{ $firstRecord->production_date }}</td>
                                <td class="text-center border-secondary">{{ $firstRecord->expiration_date }}</td>
                                <td class="text-center border-secondary">{{ priceFormat($firstRecord->price) }}</td>
                                <td class="text-center border-secondary">{{ $firstRecord->amount }}</td>
                                <td rowspan="{{ $rowspan }}" class="text-center border-secondary align-middle">
                                    <strong>{{ priceFormat($firstRecord->element->price) }}</strong>
                                </td>
                                <td rowspan="{{ $rowspan }}" class="text-center border-secondary align-middle">
                                    <strong>{{ $group->sum('amount') }}</strong>
                                </td>
                            </tr>
                            @foreach ($group->slice(1) as $record)
                                <tr>
                                    <td class="text-center border-secondary">{{ $record->destination }}</td>
                                    <td class="text-center border-secondary">{{ $record->lot_number }}</td>
                                    <td class="text-center border-secondary">{{ $record->production_date }}</td>
                                    <td class="text-center border-secondary">{{ $record->expiration_date }}</td>
                                    <td class="text-center border-secondary">{{ priceFormat($record->price) }}</td>
                                    <td class="text-center border-secondary">{{ $record->amount }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
