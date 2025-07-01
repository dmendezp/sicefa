@extends('sia::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('sia.admin.administrators.index') }}" class="text-decoration-none">
            {{ trans('sia::controllers.SIA_admin_index_title_page') }}
        </a>
    </li>
    <li class="breadcrumb-item active">{{ trans('sia::controllers.SIA_admin_edit_title_page') }}</li>
@endpush

@section('content')
    <form action="{{ route('sia.admin.administrators.update', $administrator->id) }}" method="POST" id="form-administrator" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card card-success card-outline mx-auto mb-3 custom-border-color">
            <div class="card-body">
                <div class="row">
                    <!-- Columna 1: Datos Personales -->
                    <div class="col-md-6">
                        <h5>{{ trans('sia::controllers.SIA_admin_personal_data') }}</h5>
                        <div class="form-group">
                            <label for="tipo_documento">{{ trans('sia::controllers.SIA_admin_document_type') }}</label>
                            <select name="tipo_documento" id="tipo_documento" class="form-control" required>
                                <option value="">{{ trans('sia::controllers.SIA_admin_select_document_type') }}</option>
                                @foreach (['Cédula de ciudadanía', 'Tarjeta de identidad', 'Cédula de extranjería', 'Pasaporte', 'Documento nacional de identidad', 'Registro civil'] as $type)
                                    <option value="{{ $type }}" {{ $administrator->person->document_type == $type ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                            @error('tipo_documento')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="numero_documento">{{ trans('sia::controllers.SIA_admin_document_number') }}</label>
                            <input type="number" name="numero_documento" id="numero_documento" class="form-control" value="{{ $administrator->person->document_number }}" required>
                            @error('numero_documento')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nombre_completo">{{ trans('sia::controllers.SIA_admin_full_name') }}</label>
                            <input type="text" name="nombre_completo" id="nombre_completo" class="form-control" value="{{ $administrator->person->fullName }}" required>
                            @error('nombre_completo')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="genero">{{ trans('sia::controllers.SIA_admin_gender') }}</label>
                            <select name="genero" id="genero" class="form-control" required>
                                <option value="">{{ trans('sia::controllers.SIA_admin_select_gender') }}</option>
                                <option value="Masculino" {{ $administrator->person->gender == 'Masculino' ? 'selected' : '' }}>{{ trans('sia::controllers.SIA_admin_masculino') }}</option>
                                <option value="Femenino" {{ $administrator->person->gender == 'Femenino' ? 'selected' : '' }}>{{ trans('sia::controllers.SIA_admin_femenino') }}</option>
                                <option value="Otro" {{ $administrator->person->gender == 'Otro' ? 'selected' : '' }}>{{ trans('sia::controllers.SIA_admin_otro') }}</option>
                            </select>
                            @error('genero')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Columna 2: Datos de Contacto y Profesionales -->
                    <div class="col-md-6">
                        <h5>{{ trans('sia::controllers.SIA_admin_contact_professional_data') }}</h5>
                        <div class="form-group">
                            <label for="numero_celular">{{ trans('sia::controllers.SIA_admin_phone_number') }}</label>
                            <input type="number" name="numero_celular" id="numero_celular" class="form-control" value="{{ $administrator->person->telephone1 }}" required>
                            @error('numero_celular')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="profesion">{{ trans('sia::controllers.SIA_admin_profession') }}</label>
                            <select name="profesion" id="profesion" class="form-control" required>
                                <option value="">{{ trans('sia::controllers.SIA_admin_select_profession') }}</option>
                                @foreach ($professions as $profession)
                                    <option value="{{ $profession->name }}" {{ $administrator->profession->name == $profession->name ? 'selected' : '' }}>{{ $profession->name }}</option>
                                @endforeach
                            </select>
                            @error('profesion')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="correo">{{ trans('sia::controllers.SIA_admin_email') }}</label>
                            <input type="email" name="correo" id="correo" class="form-control" value="{{ $administrator->user->email }}" required>
                            @error('correo')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="contraseña">{{ trans('sia::controllers.SIA_admin_password') }}</label>
                            <input type="password" name="contraseña" id="contraseña" class="form-control" placeholder="{{ trans('sia::controllers.SIA_admin_password_placeholder') }}">
                            @error('contraseña')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="habilidades_investigacion">{{ trans('sia::controllers.SIA_admin_research_skills') }}</label>
                            <textarea name="habilidades_investigacion" id="habilidades_investigacion" class="form-control" required>{{ $administrator->research_skills }}</textarea>
                            @error('habilidades_investigacion')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white text-right">
                <a href="{{ route('sia.admin.administrators.index') }}" class="btn btn-sm btn-light mr-2">
                    <strong>{{ trans('sia::controllers.SIA_admin_action_cancel') }}</strong>
                </a>
                <button type="submit" class="btn btn-sm btn-success" id="btn-update-administrator">
                    <b>{{ trans('sia::controllers.SIA_admin_action_update') }}</b>
                </button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#form-administrator").submit(function() {
                $("#btn-update-administrator").prop("disabled", true);
                toastr.success('{{ trans("sia::controllers.SIA_admin_updating") }}', '{{ trans("sia::controllers.SIA_admin_processing") }}');
            });

            $('#numero_documento').on('input', function() {
                let documentNumber = $(this).val();
                if (documentNumber.length > 4) {
                    $.ajax({
                        url: '{{ route("sia.admin.administrators.checkDocument") }}',
                        method: 'GET',
                        data: { numero_documento: documentNumber },
                        success: function(response) {
                            if (response.exists && response.person_id != {{ $administrator->person->id ?? 'null' }}) {
                                toastr.error('{{ trans("sia::controllers.SIA_admin_document_exists") }}', '{{ trans("sia::controllers.SIA_admin_error") }}');
                                $('#numero_documento').val('');
                            }
                        }
                    });
                }
            });
        });
    </script>
@endpush