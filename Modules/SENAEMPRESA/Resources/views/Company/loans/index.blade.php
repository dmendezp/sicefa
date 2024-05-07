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
        @if (Route::is('senaempresa.admin.*') ||
                (Route::is('senaempresa.human_talent_leader.*') &&
                    Auth::user()->havePermission('senaempresa.admin-pasante.loans.filter')))
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
        @endif
        <br>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-primary card-outline shadow">
                    <div class="card-body">
                        @if (Route::is('senaempresa.apprentice.*'))
                            <table id="inventory" class="table table-striped table-bordered">
                            @else
                                <a href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.loans.generate.pdf') }}"
                                    class="btn btn-primary">{{ trans('senaempresa::menu.Generate PDF') }}</a>
                                <table id="inventory" class="table table-striped table-bordered">
                        @endif
                        <thead>
                            <tr>
                                <th style="width: 15px;">#</th>
                                <th>{{ trans('senaempresa::menu.Apprentice') }}</th>
                                <th>{{ trans('senaempresa::menu.Element') }}</th>
                                <th>{{ trans('senaempresa::menu.Start date and time') }}</th>
                                <th>{{ trans('senaempresa::menu.End date and time') }}</th>
                                <th>{{ trans('senaempresa::menu.Status') }}</th>
                                @if (Route::is('senaempresa.admin.*') ||
                                        (Route::is('senaempresa.human_talent_leader.*') &&
                                            Auth::user()->havePermission('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.loans.new')))
                                    <th>
                                        <a href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.loans.new') }}"
                                            class="btn btn-success btn-sm">
                                            <i class="fas fa-user-plus"></i>
                                        </a>
                                    </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loans as $loan)
                                @if (Auth::check() && Auth::user()->roles[0]->slug === 'senaempresa.apprentice')
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @foreach ($apprentices as $apprentice)
                                                @if ($apprentice->id == $loan->apprentice_id)
                                                    {{ $apprentice->Person->full_name }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($inventories as $inventory)
                                                @if ($inventory->id == $loan->inventory_id)
                                                    {{ $inventory->Element->name }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $loan->start_datetime }}</td>
                                        <td>
                                            @php
                                                $endDatetime = \Carbon\Carbon::parse($loan->end_datetime);
                                                $startDatetime = \Carbon\Carbon::parse($loan->start_datetime);
                                            @endphp

                                            @if (
                                                $loan->state === 'Devuelto' &&
                                                    ($endDatetime->toDateString() !== $startDatetime->toDateString() ||
                                                        ($endDatetime->hour >= 16 && $endDatetime->minute > 0)))
                                                <span class="text-danger">{{ $loan->end_datetime }}</span>
                                            @else
                                                {{ $loan->end_datetime }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (
                                                $loan->state === 'Devuelto' &&
                                                    ($endDatetime->toDateString() !== $startDatetime->toDateString() ||
                                                        ($endDatetime->hour >= 16 && $endDatetime->minute > 0)))
                                                <span class="text-danger">{{ $loan->state }}</span>
                                            @else
                                                {{ $loan->state }}
                                            @endif
                                        </td>
                                    </tr>
                                @elseif (Auth::user()->havePermission('senaempresa.admin-human_talent_leader.loans.filter'))
                                    <tr>
                                        <td>{{ $loan->id }}</td>
                                        <td>
                                            @foreach ($apprentices as $apprentice)
                                                @if ($apprentice->id == $loan->apprentice_id)
                                                    {{ $apprentice->Person->full_name }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($inventories as $inventory)
                                                @if ($inventory->id == $loan->inventory_id)
                                                    {{ $inventory->Element->name }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $loan->start_datetime }}</td>
                                        <td>
                                            @php
                                                $endDatetime = \Carbon\Carbon::parse($loan->end_datetime);
                                                $startDatetime = \Carbon\Carbon::parse($loan->start_datetime);
                                            @endphp

                                            @if (
                                                $loan->state === 'Devuelto' &&
                                                    ($endDatetime->toDateString() !== $startDatetime->toDateString() ||
                                                        ($endDatetime->hour >= 16 && $endDatetime->minute > 0)))
                                                <span class="text-danger">{{ $loan->end_datetime }}</span>
                                            @else
                                                {{ $loan->end_datetime }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (
                                                $loan->state === 'Devuelto' &&
                                                    ($endDatetime->toDateString() !== $startDatetime->toDateString() ||
                                                        ($endDatetime->hour >= 16 && $endDatetime->minute > 0)))
                                                <span class="text-danger">{{ $loan->state }}</span>
                                            @else
                                                {{ $loan->state }}
                                            @endif
                                        </td>

                                        @if ($loan->state === 'Prestado')
                                            @if (Route::is('senaempresa.admin.*') ||
                                                    (Route::is('senaempresa.human_talent_leader.*') &&
                                                        Auth::user()->havePermission('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.loans.edit')))
                                                <td>
                                                    <a href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.loans.return', ['id' => $loan->id]) }}"
                                                        class="btn btn-warning btn-sm">{{ trans('senaempresa::menu.Return') }}</a>
                                                    <a href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.loans.edit', ['id' => $loan->id]) }}"
                                                        class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                                    </a>
                                                </td>
                                            @endif
                                        @elseif ($loan->state === 'Devuelto')
                                            <td>
                                            </td>
                                        @endif
                                    </tr>
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
