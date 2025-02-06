@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">{{ $title }}</div>

                    <div class="card-body">
                        <form
                            action="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.saved') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ trans('senaempresa::menu.Name') }}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="{{ trans('senaempresa::menu.Name') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="image"
                                    class="form-label">{{ trans('senaempresa::menu.Presentation') }}</label><br>
                                <input type="file" id="image" name="image">
                            </div>
                            <div class="mb-3">
                                <label for="description_general"
                                    class="form-label">{{ trans('senaempresa::menu.General Description') }}</label>
                                <textarea class="form-control" id="description_general" name="description_general" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="requirement"
                                    class="form-label">{{ trans('senaempresa::menu.Requirements') }}</label><br>
                                <input type="text" class="form-control" id="requirement" name="requirement"
                                    placeholder="{{ trans('senaempresa::menu.Requirements') }}">
                            </div>
                            <div class="mb-3">
                                <label for="senaempresa_id"
                                    class="form-label">SENA Empresa</label>
                                <select class="form-control" name="senaempresa_id" required>
                                    <option value="" selected>{{ trans('senaempresa::menu.Select SENAEmpresa') }}
                                    </option>
                                    @foreach ($senaempresas as $senaempresa)
                                        <option value="{{ $senaempresa->id }}">
                                            {{ $senaempresa->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="position_company_id"
                                    class="form-label">{{ trans('senaempresa::menu.Position') }}</label>
                                <select class="form-control" name="position_company_id"
                                    aria-label="{{ trans('senaempresa::menu.Select a position') }}" required>
                                    <option value="" selected>
                                        {{ trans('senaempresa::menu.Select a position') }}</option>
                                    @foreach ($PositionCompany as $positionCompany)
                                        <option value="{{ $positionCompany->id }}">{{ $positionCompany->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="start_datetime"
                                    class="form-label">{{ trans('senaempresa::menu.Start Date and Time') }}</label>
                                <input type="datetime-local" class="form-control" id="start_datetime" name="start_datetime"
                                    placeholder="{{ trans('senaempresa::menu.Start Date and Time') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="end_datetime"
                                    class="form-label">{{ trans('senaempresa::menu.Date and Time End') }}</label>
                                <input type="datetime-local" class="form-control" id="end_datetime" name="end_datetime"
                                    placeholder="{{ trans('senaempresa::menu.Date and Time End') }}" required>
                            </div><br>
                            <button type="submit" class="btn btn-success">{{ trans('senaempresa::menu.Add') }}</button>
                            <a href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.index') }}"
                                class="btn btn-danger btn-xl">{{ trans('senaempresa::menu.Cancel') }}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
@endsection
