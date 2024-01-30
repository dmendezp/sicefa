@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">{{ $title }}</div>
                    <div class="card-body">
                        <form action="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.loans.updated', ['id' => $loan->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Campo Apprentice --}}
                            <input type="hidden" name="apprentice_id" value="{{ $loan->apprentice_id }}">

                            <div class="mb-3">
                                <div class="mb-3">
                                    <label for="apprentice_id"
                                        class="form-label">{{ trans('senaempresa::menu.Search Apprentice by Document or Name') }}</label>
                                    <input type="text" class="form-control" id="search-input" name="search-input"
                                        placeholder="Ingresar número o nombre">
                                        <select class="form-control" name="apprentice_id" aria-label="Selecciona Apprentice" id="apprentice-select" multiple="multiple" required>
                                            @foreach ($apprentices as $apprentice)
                                                <option value="{{ $apprentice->id }}" @if ($apprentice->id == $loan->apprentice_id) selected @endif>
                                                    {{ $apprentice->Person->document_number }} {{ $apprentice->Person->full_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="inventory_id"
                                    class="form-label">{{ trans('senaempresa::menu.Element') }}</label>
                                <select class="form-control" name="inventory_id" aria-label="{{ trans('senaempresa::menu.Select Element') }}">
                                    @foreach ($inventories as $inventory)
                                        <option value="{{ $inventory->id }}"
                                            {{ $loan->inventory_id == $inventory->id ? 'selected' : '' }}>
                                            {{ $inventory->id }} {{ $inventory->Element->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="start_datetime"
                                    class="form-label">{{ trans('senaempresa::menu.Start date and time') }}</label>
                                <input type="text" class="form-control" id="start_datetime" name="start_datetime"
                                    value="{{ $loan->start_datetime }}" readonly>
                            </div>

                            <br>
                            <button type="submit"
                                class="btn btn-success">{{ trans('senaempresa::menu.Save Changes') }}</button>
                            <a href="{{ route('senaempresa.admin.loans.index') }}"
                                class="btn btn-danger btn-xl">{{ trans('senaempresa::menu.Cancel') }}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("search-input");
        const apprenticeSelect = document.getElementById("apprentice-select");
        const startDatetimeInput = document.getElementById("start_datetime");

        searchInput.addEventListener("input", function() {
            const searchText = this.value.trim().toLowerCase();

            for (let option of apprenticeSelect.options) {
                const apprenticeId = option.value;
                const apprenticeText = option.text.toLowerCase();
                const isMatch = apprenticeText.includes(searchText);
                option.hidden = !isMatch;

                if (isMatch) {
                    apprenticeSelect.value = apprenticeId;
                }
            }
        });
    });
</script>
@endsection
