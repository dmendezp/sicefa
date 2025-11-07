@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">{{ $title }}</div>

                    <div class="card-body">
                        <form
                            action="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.phases.updated', $company->id) }}"
                            method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ trans('senaempresa::menu.Name') }}</label>
                                <input type="text" name="name" value="{{ $company->name ?? old('name') }}"
                                    class="form-control" id="name" name="name" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="description"
                                    class="form-label">{{ trans('senaempresa::menu.Description') }}</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $company->description ?? old('description') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="quarter_id"
                                    class="form-label">{{ trans('senaempresa::menu.Quarter') }}</label>
                                <select class="form-control" name="quarter_id" aria-label="Selecciona un Cargo" required>
                                    @foreach ($quarters as $quarter)
                                        <option
                                            value="{{ $quarter->id }}"{{ $quarter->id == $company->quarter_id ? 'selected' : '' }}>

                                            {{ $quarter->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit"
                                class="btn btn-success">{{ trans('senaempresa::menu.Save changes') }}</button>
                            <a href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.phases.index') }}"
                                class="btn btn-danger btn-xl">{{ trans('senaempresa::menu.Cancel') }}</a>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
