@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">{{ $title }}</div>

                    <div class="card-body">
                        <form
                            action="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.positions.saved') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ trans('senaempresa::menu.Name') }}</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="description"
                                    class="form-label">{{ trans('senaempresa::menu.Description') }}</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="state">{{ trans('senaempresa::menu.Status') }}</label>
                                <select class="form-control @error('state') is-invalid @enderror" id="state"
                                    name="state" aria-label="Selecciona un Cargo" required>>
                                    <option value="">{{ trans('senaempresa::menu.Select Status') }}</option>
                                    <option value="activo" {{ old('state') == 'activo' ? 'selected' : '' }}>
                                        {{ trans('senaempresa::menu.Active') }}</option>
                                    <option value="inactivo" {{ old('state') == 'inactivo' ? 'selected' : '' }}>
                                        {{ trans('senaempresa::menu.Inactive') }}</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">{{ trans('senaempresa::menu.Add') }}</button>
                            <a href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.positions.index') }}"
                                class="btn btn-danger btn-xl">{{ trans('senaempresa::menu.Cancel') }}</a>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
