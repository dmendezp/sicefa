@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <h1 class="text-center"><strong><em><span>{{ $title }}</span></em></strong></h1>
        @if (Auth::check() &&
                (Auth::user()->roles[0]->name === 'Administrador Senaempresa' ||
                    Auth::user()->roles[0]->name === 'Pasante Senaempresa'))
            <div class="col-md-3">
                <form action="{{ route('company.loan.prestamos') }}" method="GET">
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
                        <table id="datatable" class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th>{{ trans('senaempresa::menu.Id') }}</th>
                                    <th>{{ trans('senaempresa::menu.People ID') }}</th>
                                    <th>{{ trans('senaempresa::menu.Inventory ID') }}</th>
                                    <th>{{ trans('senaempresa::menu.Start date and time') }}</th>
                                    <th>{{ trans('senaempresa::menu.End date and time') }}</th>
                                    <th>{{ trans('senaempresa::menu.Status') }}</th>
                                    @if (Auth::check() &&
                                            (Auth::user()->roles[0]->name === 'Administrador Senaempresa' ||
                                                Auth::user()->roles[0]->name === 'Pasante Senaempresa'))
                                        <th>
                                            <a href="{{ route('company.loan.Nuevo') }}" class="btn btn-success btn-sm"><i
                                                    class="fas fa-user-plus"></i></a>
                                        </th>
                                    @endif
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
                                                                {{ $staff_senaempresa->Apprentice->Person->first_name }}
                                                                {{ $staff_senaempresa->Apprentice->Person->first_last_name }}
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
                                                    <td>{{ $loan->end_datetime }}</td>
                                                    <td>{{ $loan->state }}</td>
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
                                                            {{ $staff_senaempresa->Apprentice->Person->first_name }}
                                                            {{ $staff_senaempresa->Apprentice->Person->first_last_name }}
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
                                                <td>{{ $loan->end_datetime }}</td>
                                                <td>{{ $loan->state }}</td>
                                                @if ($loan->state === 'Prestado')
                                                    <td>
                                                        <a href="{{ route('company.loan.devolver_prestamo', ['id' => $loan->id]) }}"
                                                            class="btn btn-primary btn-sm">{{ trans('senaempresa::menu.Return') }}</a>
                                                        <a href="{{ route('company.loan.editar', ['id' => $loan->id]) }}"
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