@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">Puntaje</div>

                    <div class="card-body">
                        <form action="{{ route('company.postulate.score.asignado') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="postulate_info" class="form-label">ID Postulado</label>
                                <input type="text" class="form-control" id="postulate_info" name="postulate_info"
                                    value="{{ $postulate->id }} - {{ $postulate->apprentice->person->first_name }}{{ $postulate->apprentice->person->first_last_name }}"
                                    readonly>
                                <div class="mb-3">
                                    <label for="cv_score" class="form-label">Puntaje - Hoja de vida</label><br>
                                    <input type="number" class="form-control" id="cv_score" name="cv_score" required
                                        max="100">
                                </div>
                                <div class="mb-3">
                                    <label for="personalities_score" class="form-label">Puntaje - 16
                                        Personalidades</label><br>
                                    <input type="number" class="form-control" id="personalities_score"
                                        name="personalities_score" required max="100">
                                </div>
                                <div class="mb-3">
                                    <label for="proposal_score" class="form-label">Puntaje - Propuesta</label><br>
                                    <input type="number" class="form-control" id="proposal_score" name="proposal_score"
                                        required max="100">
                                </div>

                                <div class="mb-3">
                                    <input type="hidden" class="form-control" id="average_score" name="average_score"
                                        readonly>
                                </div>


                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-success">Asignar</button>
                                <a href="{{ route('company.postulate') }}" class="btn btn-danger">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
