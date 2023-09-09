@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="formulario">
                    <div class="card-header">{{ $title }}</div>

                    <div class="card-body">
                        <form action="{{ route('company.senaempresa.personal_editado', $staffSenaempresa->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <div class="mb-3">
                                <label for="position_company_id" class="form-label">Id Cargo</label>
                                <select class="form-control" name="position_company_id" aria-label="Selecciona un Cargo">
                                    <option value="" selected>Selecciona un Cargo</option>
                                    @foreach ($PositionCompany as $positionCompany)
                                        <option value="{{ $positionCompany->id }}"
                                            {{ $positionCompany->id == $staffSenaempresa->position_company_id ? 'selected' : '' }}>
                                            {{ $positionCompany->id }}
                                            {{ $positionCompany->description }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="apprentice_id" class="form-label">Id Aprendiz</label>
                                <select class="form-control" name="apprentice_id" aria-label="Selecciona un Aprendiz">
                                    <option value="" selected>Selecciona un Aprendiz</option>
                                    @foreach ($apprentices as $apprentice)
                                        <option value="{{ $apprentice->id }}"
                                            {{ $apprentice->id == $staffSenaempresa->apprentice_id ? 'selected' : '' }}>
                                            {{ $apprentice->Person->document_number }}
                                            {{ $apprentice->Person->first_name }}
                                            {{ $apprentice->Person->first_last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Imgen Personal</label><br>
                                <input type="file" id="image" name="image">
                            </div>
                            <div class="mb-3">
                                <label for="current_image" class="form-label">Imagen Actual</label>
                                @if ($staffSenaempresa->image)
                                    <img src="{{ asset('storage/' . $staffSenaempresa->image) }}" alt="Imagen Personal"
                                        style="max-width: 300px;">
                                @else
                                    <p>No hay imagen registrada.</p>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-success">Actualizar</button>
                            <a href="{{ route('company.senaempresa.personal') }}"
                                class="btn btn-danger btn-xl">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    </div>
@endsection
