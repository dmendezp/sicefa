@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        @if (Auth::check() && (Auth::user()->roles[0]->name === 'Administrador Senaempresa' || Auth::user()->roles[0]->name === 'Pasante Senaempresa' ))
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">{{ trans('senaempresa::menu.Loans') }}</div>
                    <div class="card-body">
                        <form action="{{ route('company.loan.prestamo_nuevo') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="staff_senaempresa_id"
                                    class="form-label">{{ trans('senaempresa::menu.People ID') }}</label>
                                <select class="form-control" name="staff_senaempresa_id"
                                    aria-label="Selecciona Personal ID">
                                    <option value="" selected>{{ trans('senaempresa::menu.Select Personal ID') }}
                                    </option>
                                    @foreach ($staff_senaempresas as $staff_senaempresa)
                                        <option value="{{ $staff_senaempresa->id }}">
                                            {{ $staff_senaempresa->id }}
                                            {{ $staff_senaempresa->Apprentice->Person->first_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="inventory_id"
                                    class="form-label">{{ trans('senaempresa::menu.Inventory ID') }}</label>
                                <select class="form-control" name="inventory_id" aria-label="Selecciona Inventario ID">
                                    <option value="" selected>{{ trans('senaempresa::menu.Select Inventory ID') }}
                                    </option>
                                    @foreach ($inventories as $inventory)
                                        <option value="{{ $inventory->id }}">
                                            {{ $inventory->id }} {{ $inventory->Element->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="start_datetime"
                                    class="form-label">{{ trans('senaempresa::menu.Start date and time') }}</label>
                                <input type="datetime-local" class="form-control" id="start_datetime" name="start_datetime"
                                    placeholder="Fecha Inicio">
                            </div>
                            <div class="mb-3">
                                <label for="end_datetime"
                                    class="form-label">{{ trans('senaempresa::menu.End date and time') }}</label>
                                <input type="datetime-local" class="form-control" id="end_datetime" name="end_datetime"
                                    placeholder="Fecha Inicio">
                            </div><br>
                            <button type="submit"
                                class="btn btn-success">{{ trans('senaempresa::menu.Provide') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <br>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">{{ $title }}</div>

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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loans as $loan)
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
                                        </td>inventories
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
                                        <td>
                                            @if ($loan->state === 'Prestado')
                                                <a href="{{ route('company.loan.devolver_prestamo', ['id' => $loan->id]) }}"
                                                    class="btn btn-primary">{{ trans('senaempresa::menu.Return') }}</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
