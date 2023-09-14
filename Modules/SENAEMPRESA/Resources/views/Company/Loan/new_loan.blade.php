@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
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
                                <select class="form-control" name="staff_senaempresa_id" aria-label="Selecciona Personal ID"
                                    required>
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
                                <select class="form-control" name="inventory_id" aria-label="Selecciona Inventario ID"
                                    required>
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
                                    placeholder="Fecha Inicio" required>
                            </div>
                            <div class="mb-3">
                                <label for="end_datetime"
                                    class="form-label">{{ trans('senaempresa::menu.End date and time') }}</label>
                                <input type="datetime-local" class="form-control" id="end_datetime" name="end_datetime"
                                    placeholder="Fecha Inicio" required>
                            </div><br>
                            <button type="submit"
                                class="btn btn-success">{{ trans('senaempresa::menu.Provide') }}</button>
                            <a href="{{ route('company.loan.prestamos') }}"
                                class="btn btn-danger btn-xl">{{ trans('senaempresa::menu.Cancel') }}</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
