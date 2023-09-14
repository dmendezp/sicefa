@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">{{ $title }}</div>

                    <div class="card-body">
                        <form action="{{ route('company.senaempresa.nuevo_personal') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="position_company_id" class="form-label">{{ trans('senaempresa::menu.Position ID') }}</label>
                                <select class="form-control" name="position_company_id" aria-label="Selecciona un Cargo">
                                    <option value="" selected>{{ trans('senaempresa::menu.Select a Position') }}</option>
                                    @foreach ($PositionCompany as $positionCompany)
                                        <option value="{{ $positionCompany->id }}">
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
                                    @foreach ($Apprentices as $Apprentice)
                                        <option value="{{ $Apprentice->id }}">
                                            {{ $Apprentice->Person->document_number }}
                                            {{ $Apprentice->Person->first_name }}
                                            {{ $Apprentice->Person->first_last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">{{ trans('senaempresa::menu.self-image') }}</label><br>
                                <input type="file" id="image" name="image">
                            </div>
                            <button type="submit" class="btn btn-success">{{ trans('senaempresa::menu.Add') }}</button>
                            <a href="{{ route('company.senaempresa.personal') }}" class="btn btn-danger btn-xl">{{ trans('senaempresa::menu.Cancel') }}</a>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div><br>
@endsection
