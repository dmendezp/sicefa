@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">{{ $title }}</div>

                    <div class="card-body">
                        <form action="{{ route('company.postulate.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="apprentice_info" class="form-label">Aprendiz</label>
                                <input type="text" class="form-control" id="apprentice_info" name="apprentice_info"
                                    value="{{ $ApprenticeId }} - {{ auth()->user()->person->first_name }} {{ auth()->user()->person->first_last_name }} {{ auth()->user()->person->second_last_name }}"
                                    readonly>
                            </div>
                            <input type="hidden" id="apprentice_id" name="apprentice_id" value="{{ $ApprenticeId }}"
                                readonly>
                            <div class="mb-3">
                                <label for="vacancy_id" class="form-label">Vacante ID</label>
                                <select class="form-control" name="vacancy_id" aria-label="Selecciona Vacante ID" required>
                                    <option value="" selected>Seleccionar Vacante ID
                                    </option>
                                    @foreach ($vacancies as $vacancy)
                                        <option value="{{ $vacancy->id }}">
                                            {{ $vacancy->id }}
                                            {{ $vacancy->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="cv" class="form-label">Hoja de vida</label><br>
                                <input type="file" id="cv" name="cv" required>
                            </div>
                            <div class="mb-3">
                                <label for="personalities" class="form-label">16 Personalidades</label><br>
                                <input type="file" id="personalities" name="personalities" required>
                            </div>
                            <div class="mb-3">
                                <label for="proposal" class="form-label">Propuesta</label><br>
                                <input type="file" id="proposal" name="proposal" required>
                            </div>

                            <button type="submit" class="btn btn-success">Inscribirse</button>
                            <a href="{{ route('company.vacant.vacantes') }}">
                                {!! Form::button('Cancelar', ['class' => 'btn btn-danger', 'name' => 'cancelar']) !!}
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
