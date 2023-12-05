@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">{{ $title }}</div>

                    <div class="card-body">
                        <form
                            action="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.postulates.state_updated') }}"
                            method="POST" enctype="multipart/form-data">

                            @csrf
                            <input type="hidden" name="postulate_id" value="{{ $postulate->id }}">
                            <div class="mb-3">
                                <label for="postulate_info" class="form-label">ID Postulado</label>
                                <input type="text" class="form-control" id="postulate_info" name="postulate_info"
                                    value="{{ $postulate->id }} - {{ $postulate->apprentice->person->full_name }}" readonly>
                            </div>
                            <input type="hidden" class="form-control" id="postulate_id" name="postulate_id"
                                value="{{ $postulate->id }}" readonly>
                            <div class="form-group">
                                <label for="state">Estado:</label>
                                <select name="state" id="state" class="form-control">
                                    <option value="">Actualizar Estado</option>
                                    @foreach ($estados as $estado)
                                        <option value="{{ $estado }}">{{ $estado }}</option>
                                    @endforeach
                                </select>
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
