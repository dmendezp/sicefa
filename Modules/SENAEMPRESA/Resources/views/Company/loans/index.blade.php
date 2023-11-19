@extends('senaempresa::layouts.master')
@section('stylesheet')
    <style>
        .text-danger {
            color: red;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <h1 class="text-center"><strong><em><span>{{ $title }}</span></em></strong></h1>
    
            <div class="col-md-3">
                <form action="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.loans.index') }}"
                    method="GET">
                    <div class="form-group">
                        <label for="loan_state">{{ trans('senaempresa::menu.Filter by State') }}:</label>
                        <select name="loan_state" id="loan_state" class="form-control" onchange="this.form.submit()">
                            <option value="">{{ trans('senaempresa::menu.All') }}</option>
                            <option value="Prestado" {{ request('loan_state') == 'Prestado' ? 'selected' : '' }}>
                                {{ trans('senaempresa::menu.Borrowed') }}
                            </option>
                            <option value="Devuelto" {{ request('loan_state') == 'Devuelto' ? 'selected' : '' }}>
                                {{ trans('senaempresa::menu.Returned') }}
                            </option>
                        </select>
                    </div>
                </form>
            </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-primary card-outline shadow">
                    <div class="card-body">
                        <table id="datatable" class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th>{{ trans('senaempresa::menu.Id') }}</th>
                                    <th>{{ trans('senaempresa::menu.People ID') }}</th>
                                    <th>{{ trans('senaempresa::menu.Inventory ID') }}</th>
                                    <th>{{ trans('senaempresa::menu.Start date and time') }}</th>
                                    <th>{{ trans('senaempresa::menu.End date and time') }}</th>
                                    <th>{{ trans('senaempresa::menu.Status') }}</th>
                                   
                                        <th>
                                            <a href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.loans.new') }}"
                                                class="btn btn-success btn-sm"><i class="fas fa-user-plus"></i></a>
                                        </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loans as $loan)
                                    @if (Auth::check())
                                        @if (Auth::user()->roles[0]->name === 'Usuario Senaempresa')
                                            @if ($loan->state === 'Prestado')
                                                <tr>
                                                    <td>{{ $loan->id }}</td>
                                                    <td>
                                                        @foreach ($staff_senaempresas as $staff_senaempresa)
                                                            @if ($staff_senaempresa->id == $loan->staff_senaempresa_id)
                                                                {{ $loan->staff_senaempresa_id }}
                                                                {{ $staff_senaempresa->Apprentice->Person->full_name }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($inventories as $inventory)
                                                            @if ($inventory->id == $loan->inventory_id)
                                                                {{ $loan->inventory_id }} {{ $inventory->Element->name }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $loan->start_datetime }}</td>
                                                    <td>
                                                        @if ($loan->state === 'Devuelto')
                                                            @php
                                                                $endDatetime = \Carbon\Carbon::parse($loan->end_datetime);
                                                                $startDatetime = \Carbon\Carbon::parse($loan->start_datetime);
                                                            @endphp

                                                            @if (
                                                                $endDatetime->toDateString() !== $startDatetime->toDateString() ||
                                                                    ($endDatetime->hour >= 16 && $endDatetime->minute > 0))
                                                                <span class="text-danger">{{ $loan->end_datetime }}</span>
                                                            @else
                                                                {{ $loan->end_datetime }}
                                                            @endif
                                                        @else
                                                            {{ $loan->end_datetime }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($loan->state === 'Devuelto')
                                                            @php
                                                                $endDatetime = \Carbon\Carbon::parse($loan->end_datetime);
                                                            @endphp

                                                            @if (
                                                                $endDatetime->toDateString() !== $startDatetime->toDateString() ||
                                                                    ($endDatetime->hour >= 16 && $endDatetime->minute > 0))
                                                                <span class="text-danger">{{ $loan->state }}</span>
                                                            @else
                                                                {{ $loan->state }}
                                                            @endif
                                                        @else
                                                            {{ $loan->state }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @elseif (Auth::user()->roles[0]->name === 'Administrador Senaempresa' ||
                                                Auth::user()->roles[0]->name === 'Pasante Senaempresa')
                                            <tr>
                                                <td>{{ $loan->id }}</td>
                                                <td>
                                                    @foreach ($staff_senaempresas as $staff_senaempresa)
                                                        @if ($staff_senaempresa->id == $loan->staff_senaempresa_id)
                                                            {{ $loan->staff_senaempresa_id }}
                                                            {{ $staff_senaempresa->Apprentice->Person->full_name }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($inventories as $inventory)
                                                        @if ($inventory->id == $loan->inventory_id)
                                                            {{ $loan->inventory_id }} {{ $inventory->Element->name }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>{{ $loan->start_datetime }}</td>
                                                <td>
                                                    @if ($loan->state === 'Devuelto')
                                                        @php
                                                            $endDatetime = \Carbon\Carbon::parse($loan->end_datetime);
                                                            $startDatetime = \Carbon\Carbon::parse($loan->start_datetime);
                                                        @endphp

                                                        @if (
                                                            $endDatetime->toDateString() !== $startDatetime->toDateString() ||
                                                                ($endDatetime->hour >= 16 && $endDatetime->minute > 0))
                                                            <span class="text-danger">{{ $loan->end_datetime }}</span>
                                                        @else
                                                            {{ $loan->end_datetime }}
                                                        @endif
                                                    @else
                                                        {{ $loan->end_datetime }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($loan->state === 'Devuelto')
                                                        @php
                                                            $endDatetime = \Carbon\Carbon::parse($loan->end_datetime);
                                                        @endphp

                                                        @if (
                                                            $endDatetime->toDateString() !== $startDatetime->toDateString() ||
                                                                ($endDatetime->hour >= 16 && $endDatetime->minute > 0))
                                                            <span class="text-danger">{{ $loan->state }}</span>
                                                        @else
                                                            {{ $loan->state }}
                                                        @endif
                                                    @else
                                                        {{ $loan->state }}
                                                    @endif
                                                </td>
                                                @if ($loan->state === 'Prestado')
                                                    <td>
                                                        <a href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.loans.return', ['id' => $loan->id]) }}"
                                                            class="btn btn-primary btn-sm">{{ trans('senaempresa::menu.Return') }}</a>
                                                        <a href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.loans.edit', ['id' => $loan->id]) }}"
                                                            class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                                    </td>
                                                @elseif ($loan->state === 'Devuelto')
                                                    <td>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endif
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
