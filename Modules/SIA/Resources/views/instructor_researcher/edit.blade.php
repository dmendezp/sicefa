@extends('sia::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('sia.admin.instructor-researchers.index') }}" class="text-decoration-none">
            {{ trans('sia::instructorresearcher.index_title_page') }}
        </a>
    </li>
    <li class="breadcrumb-item active">{{ trans('sia::instructorresearcher.edit_title_page') }}</li>
@endpush

@section('content')
    <form action="{{ route('sia.admin.instructor-researchers.update', $instructor->id) }}" method="POST" id="form-instructor" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card card-success card-outline mx-auto mb-3 custom-border-color">
            <div class="card-body">
                <div class="row">
                    <!-- Columna 1: Datos Personales -->
                    <div class="col-md-6">
                        <h5>{{ trans('sia::instructorresearcher.personal_data') }}</h5>
                        <div class="form-group">
                            <label for="tipo_documento">{{ trans('sia::instructorresearcher.document_type') }}</label>
                            <select name="tipo_documento" id="tipo_documento" class="form-control" required>
                                <option value="">{{ trans('sia::instructorresearcher.select_document_type') }}</option>
                                @foreach (['Cédula de ciudadanía', 'Tarjeta de identidad', 'Cédula de extranjería', 'Pasaporte', 'Documento nacional de identidad', 'Registro civil'] as $type)
                                    <option value="{{ $type }}" {{ $instructor->person->document_type == $type ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                            @error('tipo_documento')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="numero_documento">{{ trans('sia::instructorresearcher.document_number') }}</label>
                            <input type="number" name="numero_documento" id="numero_documento" class="form-control" value="{{ $instructor->person->document_number }}" required>
                            @error('numero_documento')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nombre_completo">{{ trans('sia::instructorresearcher.full_name') }}</label>
                            <input type="text" name="nombre_completo" id="nombre_completo" class="form-control" value="{{ $instructor->person->fullName }}" required>
                            @error('nombre_completo')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="genero">{{ trans('sia::instructorresearcher.gender') }}</label>
                            <select name="genero" id="genero" class="form-control" required>
                                <option value="">{{ trans('sia::instructorresearcher.select_gender') }}</option>
                                <option value="Masculino" {{ $instructor->person->gender == 'Masculino' ? 'selected' : '' }}>{{ trans('sia::instructorresearcher.masculino') }}</option>
                                <option value="Femenino" {{ $instructor->person->gender == 'Femenino' ? 'selected' : '' }}>{{ trans('sia::instructorresearcher.femenino') }}</option>
                                <option value="Otro" {{ $instructor->person->gender == 'Otro' ? 'selected' : '' }}>{{ trans('sia::instructorresearcher.otro') }}</option>
                            </select>
                            @error('genero')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Columna 2: Datos de Contacto y Profesionales -->
                    <div class="col-md-6">
                        <h5>{{ trans('sia::instructorresearcher.contact_professional_data') }}</h5>
                        <div class="form-group">
                            <label for="numero_celular">{{ trans('sia::instructorresearcher.phone_number') }}</label>
                            <input type="number" name="numero_celular" id="numero_celular" class="form-control" value="{{ $instructor->person->telephone1 }}" required>
                            @error('numero_celular')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="profesion">{{ trans('sia::instructorresearcher.profession') }}</label>
                            <select name="profesion" id="profesion" class="form-control" required>
                                <option value="">{{ trans('sia::instructorresearcher.select_profession') }}</option>
                                @foreach ($professions as $profession)
                                    <option value="{{ $profession->name }}" {{ $instructor->profession->name == $profession->name ? 'selected' : '' }}>{{ $profession->name }}</option>
                                @endforeach
                            </select>
                            @error('profesion')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="correo">{{ trans('sia::instructorresearcher.email') }}</label>
                            <input type="email" name="correo" id="correo" class="form-control" value="{{ $instructor->user->email }}" required>
                            @error('correo')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="contraseña">{{ trans('sia::instructorresearcher.password') }}</label>
                            <input type="password" name="contraseña" id="contraseña" class="form-control" placeholder="{{ trans('sia::instructorresearcher.password_placeholder') }}">
                            @error('contraseña')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="habilidades_investigacion">{{ trans('sia::instructorresearcher.research_skills') }}</label>
                            <textarea name="habilidades_investigacion" id="habilidades_investigacion" class="form-control" required>{{ $instructor->research_skills }}</textarea>
                            @error('habilidades_investigacion')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white text-right">
                <a href="{{ route('sia.admin.instructor-researchers.index') }}" class="btn btn-sm btn-light mr-2">
                    <strong>{{ trans('sia::instructorresearcher.action_cancel') }}</strong>
                </a>
                <button type="submit" class="btn btn-sm btn-success" id="btn-update-instructor">
                    <b>{{ trans('sia::instructorresearcher.action_update') }}</b>
                </button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#form-instructor").submit(function() {
                $("#btn-update-instructor").prop("disabled", true);
                toastr.success('{{ trans("sia::instructorresearcher.updating") }}', '{{ trans("sia::instructorresearcher.processing") }}');
            });

            $('#numero_documento').on('input', function() {
                let documentNumber = $(this).val();
                if (documentNumber.length > 4) {
                    $.ajax({
                        url: '{{ route("sia.admin.instructor-researchers.checkDocument") }}',
                        method: 'GET',
                        data: { numero_documento: documentNumber },
                        success: function(response) {
                            if (response.exists && response.person_id != {{ $instructor->person->id ?? 'null' }}) {
                                toastr.error('{{ trans("sia::instructorresearcher.document_exists") }}', '{{ trans("sia::instructorresearcher.error") }}');
                                $('#numero_documento').val('');
                            }
                        }
                    });
                }
            });
        });
    </script>
@endpush