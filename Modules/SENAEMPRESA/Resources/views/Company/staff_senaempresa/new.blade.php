@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">{{ $title }}</div>

                    <div class="card-body">
                        <form
                            action="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.staff.saved') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="position_company_id"
                                    class="form-label">{{ trans('senaempresa::menu.Position') }}</label>

                                <select class="form-control" name="position_company_id" aria-label="Selecciona un Cargo"
                                    id="position-company-select" required>
                                    <option value="">Seleccione un cargo</option>
                                    @foreach ($PositionCompany as $position)
                                        <option value="{{ $position->id }}"
                                            {{ $position->id == $selectedPosition ? 'selected' : '' }}>
                                            {{ $position->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="apprentice_id"
                                    class="form-label">{{ trans('senaempresa::menu.Search Apprentice by Document or Name') }}</label>
                                <input type="text" class="form-control" id="search-input" name="search-input"
                                    placeholder="Ingresar número o nombre">
                                <select class="form-control" name="apprentice_id" aria-label="Selecciona un Aprendiz"
                                    id="apprentice-select" multiple="multiple" required>
                                    @foreach ($Apprentices as $Apprentice)
                                        <option value="{{ $Apprentice->id }}">
                                            {{ $Apprentice->Person->document_number }}
                                            {{ $Apprentice->Person->full_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="image"
                                    class="form-label">{{ trans('senaempresa::menu.self-image') }}</label><br>
                                <input type="file" id="image" name="image" required>
                            </div>
                            <div class="mb-3">
                                <label for="senaempresa_id" class="form-label">SENAEmpresa</label>
                                <select class="form-control" name="senaempresa_id" aria-label="Selecciona una Senaempresa"
                                    required>
                                    <option value="" selected>Selecciona una Senaempresa</option>
                                    @foreach ($senaempresas as $senaempresa)
                                        <option value="{{ $senaempresa->id }}">
                                            {{ $senaempresa->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">{{ trans('senaempresa::menu.Add') }}</button>
                            <a href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.staff.index') }}"
                                class="btn btn-danger btn-xl">{{ trans('senaempresa::menu.Cancel') }}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("search-input");
        const apprenticeSelect = document.getElementById("apprentice-select");

        searchInput.addEventListener("input", function() {
            const searchText = this.value.trim().toLowerCase();

            for (let option of apprenticeSelect.options) {
                const optionText = option.text.toLowerCase();
                const isMatch = optionText.includes(searchText);
                option.hidden = !isMatch;
            }
        });
    });
</script>
