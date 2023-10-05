@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">Puntaje</div>

                    <div class="card-body">
                        <div class="mb-3">
                            <label for="postulate_id" class="form-label">Postulate ID</label>
                            <select class="form-control" name="postulate_id" aria-label="Seleccionar Postulado ID" required>
                                <option value="" selected>Seleccionar Postulado ID
                                </option>
                                @foreach ($postulates as $postulate)
                                    <option value="{{ $postulate->id }}">
                                        {{ $postulate->id }}
                                        {{ $postulate->apprentice->person->first_name }}
                                        {{ $postulate->apprentice->person->first_last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="cv_score" class="form-label">Hoja de vida</label><br>
                            <input type="number" class="form-control" id="cv_score" name="cv_score" required>
                        </div>
                        <div class="mb-3">
                            <label for="personalities_score" class="form-label">16 Personalidades</label><br>
                            <input type="number" class="form-control" id="personalities_score" name="personalities_score"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="proposal_score" class="form-label">Propuesta</label><br>
                            <input type="number" class="form-control" id="proposal_score" name="proposal_score" required>
                        </div>
                        <div class="mb-3"><a href="" class="btn btn-primary">Asignar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
