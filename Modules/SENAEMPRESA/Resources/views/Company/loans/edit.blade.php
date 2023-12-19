@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">{{ $title }}</div>
                    <div class="card-body">
                        <form action="{{ route('senaempresa.admin.loans.updated', ['id' => $loan->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Campo Apprentice --}}
                            <input type="hidden" name="apprentice_id" value="{{ $loan->apprentice_id }}">

                            <div class="mb-3">
                                <label for="inventory_id"
                                    class="form-label">{{ trans('senaempresa::menu.Inventory ID') }}</label>
                                <select class="form-control" name="inventory_id" aria-label="Selecciona Inventario ID">
                                    @foreach ($inventories as $inventory)
                                        <option value="{{ $inventory->id }}"
                                            {{ $loan->inventory_id == $inventory->id ? 'selected' : '' }}>
                                            {{ $inventory->id }} {{ $inventory->Element->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="start_datetime"
                                    class="form-label">{{ trans('senaempresa::menu.Start date and time') }}</label>
                                <input type="text" class="form-control" id="start_datetime" name="start_datetime"
                                    value="{{ $loan->start_datetime }}" readonly>
                            </div>

                            <br>
                            <button type="submit"
                                class="btn btn-success">{{ trans('senaempresa::menu.Save Changes') }}</button>
                            <a href="{{ route('senaempresa.admin.loans.index') }}"
                                class="btn btn-danger btn-xl">{{ trans('senaempresa::menu.Cancel') }}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
