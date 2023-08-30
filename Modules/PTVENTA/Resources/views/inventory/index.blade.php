@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.'.getRoleRouteName(Route::currentRouteName()).'.inventory.index') }}" class="text-decoration-none">{{ trans('ptventa::inventory.Inventory')}}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('ptventa::inventory.Products')}}</li>
@endpush

@section('content')
    <div class="card card-success card-outline shadow-sm">
        <div class="card-body">

            <div class="row">
                <div class="col">
                    <h5 class="text-center"><em>{{ trans('ptventa::inventory.TitleCard')}}</em></h5>
                </div>
                <div class="col-auto">
                    <div class="d-flex justify-content-end">
                        @if(Auth::user()->havePermission('ptventa.'.getRoleRouteName(Route::currentRouteName()).'.inventory.create'))
                            <a href="{{ route('ptventa.'.getRoleRouteName(Route::currentRouteName()).'.inventory.create') }}" class="btn btn-success btn-sm me-1">
                                <i class="fa-solid fa-thumbs-up fa-bounce mr-2"></i>{{ trans('ptventa::inventory.Btn1')}}
                            </a>
                        @endif
                        @if(Auth::user()->havePermission('ptventa.'.getRoleRouteName(Route::currentRouteName()).'.inventory.status'))
                            <a href="{{ route('ptventa.'.getRoleRouteName(Route::currentRouteName()).'.inventory.status') }}" class="btn btn-secondary btn-sm">
                                <i class="fa-solid fa-triangle-exclamation fa-bounce mr-2"></i>{{ trans('ptventa::inventory.Btn2')}}
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
                            <th class="text-center">{{ trans('ptventa::inventory.1T1')}}</th>
                            <th>{{ trans('ptventa::inventory.1T2')}}</th>
                            <th class="text-center">{{ trans('ptventa::inventory.1T3')}}</th>
                            <th class="text-center">
                                <i class="fa-solid fa-calendar-days"></i>
                                {{ trans('ptventa::inventory.1T4')}}
                            </th>
                            <th class="text-center">
                                <i class="fa-solid fa-calendar-days"></i>
                                {{ trans('ptventa::inventory.1T5')}}
                            </th>
                            <th class="text-center">{{ trans('ptventa::inventory.1T6')}}</th>
                            <th class="text-center">{{ trans('ptventa::inventory.1T7')}}</th>
                            <th class="text-center">{{ trans('ptventa::inventory.1T8')}}</th>
                            <th class="text-center">{{ trans('ptventa::inventory.1T9')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($groupedInventories as $group)
                            @php
                                $firstRecord = $group->first();
                                $rowspan = $group->count();
                            @endphp
                            <tr>
                                <td rowspan="{{ $rowspan }}" class="text-center border-secondary align-middle">{{ $loop->iteration }}</td>
                                <td rowspan="{{ $rowspan }}" class="border-secondary align-middle">
                                    <strong>{{ $firstRecord->element->name }}</strong>
                                </td>
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
