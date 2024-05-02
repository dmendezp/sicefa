@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">{{ $title }}</div>

                    <div class="card-body">
                        <form
                            action="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.positions.updated', $position->id) }}"
                            method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ trans('senaempresa::menu.Name') }}</label>
                                <input type="text" name="name" value="{{ $position->name ?? old('name') }}"
                                    class="form-control" id="name" name="name" rows="3" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="description"
                                    class="form-label">{{ trans('senaempresa::menu.General description') }}</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $position->description ?? old('description') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="state">{{ trans('senaempresa::menu.Status') }}</label>
                                <select class="form-control" id="state" name="state">
                                    <option value="activo" {{ $position->state === 'activo' ? 'selected' : '' }}>
                                        {{ trans('senaempresa::menu.Active') }}</option>
                                    <option value="inactivo" {{ $position->state === 'inactivo' ? 'selected' : '' }}>
                                        Inactivo</option>
                                </select>
                            </div>

                            <button type="submit"
                                class="btn btn-success">{{ trans('senaempresa::menu.Save changes') }}</button>
                            <a href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.positions.index') }}"
                                class="btn btn-danger btn-xl">{{ trans('senaempresa::menu.Cancel') }}</a>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
