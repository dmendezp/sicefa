@extends('senaempresa::layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">{{ $title }}</div>

                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <div class="mb-3">
                                    <label for="apprentice_id" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="apprentice_id" name="apprentice_id"
                                        value="{{ auth()->user()->person->first_name }} {{ auth()->user()->person->first_last_name }} {{ auth()->user()->person->second_last_name }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="vacancy_id" class="form-label">Vacante ID</label>
                                <input type="text" class="form-control" id="vacancy_id" name="vacancy_id"
                                    value="{{ request('vacancy_id') }} {{ request('vacancy_name') }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="cv" class="form-label">Hoja de vida</label><br>
                                <input type="file" id="cv" name="cv" required>
                            </div>
                            <div class="mb-3">
                                <label for="cv" class="form-label">16 Personalidades</label><br>
                                <input type="file" id="personalities" name="personalities" required>
                            </div>
                            <div class="mb-3">
                                <label for="cv" class="form-label">Propuesta</label><br>
                                <input type="file" id="proposal" name="proposal" required>
                            </div>

                            <button type="submit" class="btn btn-success">Inscribirse</button>
                            <a href="{{ route('company.vacant.vacantes') }}">
                                {!! Form::button('Cancelar', ['class' => 'btn btn-danger', 'name' => 'cancelar']) !!}
                            </a>
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
