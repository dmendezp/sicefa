@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">Puntaje</div>

                    <div class="card-body">
                        <form
                            action="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.postulates.score_assigned') }}"
                            method="POST" enctype="multipart/form-data">

                            @csrf
                            <input type="hidden" name="postulate_id" value="{{ $postulate->id }}">
                            <div class="mb-3">
                                <label for="postulate_info" class="form-label">ID Postulado</label>
                                <input type="text" class="form-control" id="postulate_info" name="postulate_info"
                                    value="{{ $postulate->id }} - {{ $postulate->apprentice->person->full_name }}" readonly>
                            </div>
                            <input type="hidden" class="form-control" id="postulate_id" name="postulate_info"
                                value="{{ $postulate->id }}" readonly>

                            <div class="mb-3">
                                <label for="vacancy_info"
                                    class="form-label">{{ trans('senaempresa::menu.Vacancy') }}</label>
                                <input type="text" class="form-control" id="vacancy_info" name="vacancy_info"
                                    value="{{ $postulate->vacancy_id }} - {{ $postulate->vacancy->name }}" readonly>
                            </div>
                            <input type="hidden" class="form-control" id="vacancy_id" name="vacancy_id"
                                value="{{ $postulate->vacancy_id }}" readonly>
                            <div class="mb-3">
                                <label for="cv_score" class="form-label">Puntaje - Hoja de vida</label><br>
                                <input type="number" class="form-control" id="cv_score" name="cv_score" value="0"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="personalities_score" class="form-label">Puntaje - 16
                                    Personalidades</label><br>
                                <input type="number" class="form-control" id="personalities_score"
                                    name="personalities_score" value="0" required>
                            </div>
                            <div class="mb-3">
                                <label for="proposal_score" class="form-label">Puntaje - Propuesta</label><br>
                                <input type="number" class="form-control" id="proposal_score" name="proposal_score"
                                    value="0" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-success">Asignar</button>
                                <a href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.postulates.index') }}"
                                    class="btn btn-danger">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
