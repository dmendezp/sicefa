@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">{{ $title }}</div>

                    <div class="card-body">
                        <form
                            action="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.staff.updated', $staffSenaempresa->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <!-- ... Otros campos del formulario ... -->

                            <div class="mb-3">
                                <label for="apprentice_id"
                                    class="form-label">{{ trans('senaempresa::menu.Apprentice Id') }}</label>
                                <input type="text" class="form-control" id="search-input" name="search-input"
                                    placeholder="{{ trans('senaempresa::menu.Search by Document or Name') }}">
                                <select class="form-control" name="apprentice_id" aria-label="Selecciona un Aprendiz"
                                    id="apprentice-select" multiple="multiple" required>
                                    @foreach ($apprentices as $apprentice)
                                        <option value="{{ $apprentice->id }}"
                                            {{ $apprentice->id == $staffSenaempresa->apprentice_id ? 'selected' : '' }}>
                                            {{ $apprentice->Person->document_number }}
                                            {{ $apprentice->Person->full_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- ... Otros campos del formulario ... -->

                            <button type="submit" class="btn btn-success">{{ trans('senaempresa::menu.Update') }}</button>
                            <a href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.staff.index') }}"
                                class="btn btn-danger btn-xl">{{ trans('senaempresa::menu.Cancel') }}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><br>

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
@endsection
