@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">{{ $title }}</div>

                    <div class="card-body">
                        <form action="{{ route('company.senaempresa.personal_editado', $staffSenaempresa->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <div class="mb-3">
                                <label for="position_company_id" class="form-label">{{ trans('senaempresa::menu.Position ID') }}</label>
                                <select class="form-control" name="position_company_id" aria-label="Selecciona un Cargo">
                                    <option value="" selected>{{ trans('senaempresa::menu.Select a Position') }}</option>
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
                                <label for="apprentice_id" class="form-label">{{ trans('senaempresa::menu.Apprentice Id') }}</label>
                                <select class="form-control" name="apprentice_id" aria-label="Selecciona un Aprendiz">
                                    <option value="" selected>{{ trans('senaempresa::menu.Select an Apprentice') }}</option>
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
                                <label for="image" class="form-label">{{ trans('senaempresa::menu.self-image') }}</label><br>
                                <input type="file" id="image" name="image">
                            </div>
                            <div class="mb-3">
                                <label for="current_image" class="form-label">{{ trans('senaempresa::menu.Current image') }}</label>
                                @if ($staffSenaempresa->image)
                                    <img src="{{ asset('storage/' . $staffSenaempresa->image) }}" alt="Imagen Personal"
                                        style="max-width: 300px;">
                                @else
                                    <p>{{ trans('senaempresa::menu.There’s no registered image.') }}</p>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-success">{{ trans('senaempresa::menu.Update') }}</button>
                            <a href="{{ route('company.senaempresa.personal') }}"
                                class="btn btn-danger btn-xl">{{ trans('senaempresa::menu.Cancel') }}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    </div>
@endsection
