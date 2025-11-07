@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">{{ $title }}</div>
                    <div class="card-body">
                        <form
                            action="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.loans.saved') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <div class="mb-3">
                                    <label for="apprentice_id"
                                        class="form-label">{{ trans('senaempresa::menu.Search Apprentice by Document or Name') }}</label>
                                    <input type="text" class="form-control" id="search-input" name="search-input"
                                        placeholder="Ingresar número o nombre">
                                    <select class="form-control" name="apprentice_id" aria-label="Selecciona Apprentice"
                                        id="apprentice-select" multiple="multiple" required>
                                        @foreach ($apprentices as $apprentice)
                                            <option value="{{ $apprentice->id }}">
                                                {{ $apprentice->Person->document_number }}
                                                {{ $apprentice->Person->full_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="inventory_id"
                                    class="form-label">{{ trans('senaempresa::menu.Element') }}</label>
                                <select class="form-control" name="inventory_id" aria-label="{{ trans('senaempresa::menu.Select Element') }}"
                                    required>
                                    <option value="" selected>{{ trans('senaempresa::menu.Select Element') }}
                                    </option>
                                    @foreach ($inventories as $inventory)
                                        <option value="{{ $inventory->id }}">
                                            {{ $inventory->id }} {{ $inventory->Element->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="start_datetime"
                                    class="form-label">{{ trans('senaempresa::menu.Start date and time') }}</label>
                                <input type="datetime-local" class="form-control" id="start_datetime" name="start_datetime"
                                    placeholder="Fecha Inicio" required readonly>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-success">{{ trans('senaempresa::menu.New') }}</button>
                            <a href="{{ route('senaempresa.' . getRoleRouteName(Route::currentRouteName()) . '.loans.index') }}"
                                class="btn btn-danger btn-xl">{{ trans('senaempresa::menu.Cancel') }}</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.32/moment-timezone-with-data.min.js"></script>

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

        // Obtén la fecha y hora actual en la zona horaria de Colombia
        const now = moment().tz("America/Bogota");

        // Formatea la fecha y hora actual en un formato adecuado para el campo
        const formattedDatetime = now.format("YYYY-MM-DDTHH:mm");

        // Establece el valor del campo de fecha y hora de inicio con la fecha y hora actual en la zona horaria de Colombia
        startDatetimeInput.value = formattedDatetime;
    });
</script>
@endsection
