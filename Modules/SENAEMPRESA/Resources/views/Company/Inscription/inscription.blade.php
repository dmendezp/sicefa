@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">{{ $title }}</div>

                    <div class="card-body">
                        <form
                            action="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.registered') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="apprentice_info"
                                    class="form-label">{{ trans('senaempresa::menu.Apprentice') }}</label>
                                <input type="text" class="form-control" id="apprentice_info" name="apprentice_info"
                                    value="{{ $ApprenticeId }} - {{ auth()->user()->person->full_name }}" readonly>
                            </div>
                            <input type="hidden" id="apprentice_id" name="apprentice_id" value="{{ $ApprenticeId }}"
                                readonly>

                            <div class="mb-3">
                                <label for="vacancy_info"
                                    class="form-label">{{ trans('senaempresa::menu.Vacancy') }}</label>
                                <input type="text" class="form-control" id="vacancy_info" name="vacancy_info"
                                    value="{{ $vacancy->id }} - {{ $vacancy->name }}" readonly>
                            </div>
                            <input type="hidden" class="form-control" id="vacancy_id" name="vacancy_id"
                                value="{{ $vacancy->id }}" readonly>
                            @if ($existingPostulatesCount == 0)
                                <div class="mb-3">
                                    <label for="cv"
                                        class="form-label">{{ trans('senaempresa::menu.Currículum') }}</label><br>
                                    <input type="file" id="cv" name="cv" accept=".pdf" required>
                                </div>
                                <div class="mb-3">
                                    <label for="personalities"
                                        class="form-label">{{ trans('senaempresa::menu.16 personalities') }}</label><br>
                                    <input type="file" id="personalities" name="personalities" accept=".pdf" required>
                                </div>
                                <div class="mb-3">
                                    <label for="proposal"
                                        class="form-label">{{ trans('senaempresa::menu.Proposal') }}</label><br>
                                    <input type="file" id="proposal" name="proposal" accept=".pdf" required>
                                </div>
                                <div class="mb-3">
                                    <label for="employment_certificate" class="form-label">{{ trans('senaempresa::menu.Public employment agency certificate employment') }}
                                    </label><br>
                                    <input type="file" id="employment_certificate" name="employment_certificate"
                                        accept=".pdf" required>
                                </div>
                            @endif

                            <button type="submit"
                                class="btn btn-success">{{ trans('senaempresa::menu.Register') }}</button>
                                <a href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.vacancies.index') }}"
                                class="btn btn-danger btn-xl">{{ trans('senaempresa::menu.Cancel') }}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
