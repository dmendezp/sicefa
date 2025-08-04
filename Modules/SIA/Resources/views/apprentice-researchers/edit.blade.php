@extends('sia::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('sia.apprentice-researchers.index') }}" class="text-decoration-none">{{ trans('sia::controllers.SIA_apprentice_index_title_page') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ trans('sia::controllers.SIA_apprentice_edit_title_page') }}</li>
@endpush

@section('content')
    <form action="{{ route('sia.apprentice-researchers.update', $apprentice->id) }}" method="POST" id="form-apprentice" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card card-success card-outline mx-auto mb-3 custom-border-color">
            <div class="card-body">
                <div class="row">
                    <!-- Columna 1: Datos Personales -->
                    <div class="col-md-6">
                        <h5>{{ trans('sia::controllers.SIA_apprentice_personal_data') }}</h5>
                        <div class="form-group">
                            <label for="tipo_documento">{{ trans('sia::controllers.SIA_apprentice_document_type') }}</label>
                            <select name="tipo_documento" id="tipo_documento" class="form-control" required>
                                <option value="">{{ trans('sia::controllers.SIA_apprentice_select_document_type') }}</option>
                                @foreach (['Cédula de ciudadanía', 'Tarjeta de identidad', 'Cédula de extranjería', 'Pasaporte', 'Documento nacional de identidad', 'Registro civil'] as $type)
                                    <option value="{{ $type }}" {{ $apprentice->person->document_type == $type ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                            @error('tipo_documento')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="numero_documento">{{ trans('sia::controllers.SIA_apprentice_document_number') }}</label>
                            <input type="number" name="numero_documento" id="numero_documento" class="form-control" value="{{ $apprentice->person->document_number }}" required>
                            @error('numero_documento')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fecha_emision">{{ trans('sia::controllers.SIA_apprentice_issue_date') }}</label>
                            <input type="date" name="fecha_emision" id="fecha_emision" class="form-control" value="{{ $apprentice->person->date_of_issue }}" required>
                            @error('fecha_emision')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nombres">{{ trans('sia::controllers.SIA_apprentice_first_name') }}</label>
                            <input type="text" name="nombres" id="nombres" class="form-control" value="{{ $apprentice->person->first_name }}" required>
                            @error('nombres')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="primer_apellido">{{ trans('sia::controllers.SIA_apprentice_first_last_name') }}</label>
                            <input type="text" name="primer_apellido" id="primer_apellido" class="form-control" value="{{ $apprentice->person->first_last_name }}" required>
                            @error('primer_apellido')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="segundo_apellido">{{ trans('sia::controllers.SIA_apprentice_second_last_name') }}</label>
                            <input type="text" name="segundo_apellido" id="segundo_apellido" class="form-control" value="{{ $apprentice->person->second_last_name }}">
                            @error('segundo_apellido')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Columna 2: Datos de Contacto y Académicos -->
                    <div class="col-md-6">
                        <h5>{{ trans('sia::controllers.SIA_apprentice_contact_academic_data') }}</h5>
                        <div class="form-group">
                            <label for="eps_id">{{ trans('sia::controllers.SIA_apprentice_eps') }}</label>
                            <select name="eps_id" id="eps_id" class="form-control" required>
                                <option value="">{{ trans('sia::controllers.SIA_apprentice_select_eps') }}</option>
                                @foreach ($epsList as $eps)
                                    <option value="{{ $eps->id }}" {{ $apprentice->person->eps_id == $eps->id ? 'selected' : '' }}>{{ $eps->name }}</option>
                                @endforeach
                            </select>
                            @error('eps_id')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="numero_celular">{{ trans('sia::controllers.SIA_apprentice_phone_number') }}</label>
                            <input type="number" name="numero_celular" id="numero_celular" class="form-control" value="{{ $apprentice->person->telephone1 }}" required>
                            @error('numero_celular')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="population_group_id">{{ trans('sia::controllers.SIA_apprentice_population_group') }}</label>
                            <select name="population_group_id" id="population_group_id" class="form-control" required>
                                <option value="">{{ trans('sia::controllers.SIA_apprentice_select_population_group') }}</option>
                                @foreach ($populationGroups as $group)
                                    <option value="{{ $group->id }}" {{ $apprentice->person->population_group_id == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                                @endforeach
                            </select>
                            @error('population_group_id')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pension_entity_id">{{ trans('sia::controllers.SIA_apprentice_pension_entity') }}</label>
                            <select name="pension_entity_id" id="pension_entity_id" class="form-control" required>
                                <option value="">{{ trans('sia::controllers.SIA_apprentice_select_pension_entity') }}</option>
                                @foreach ($pensionEntities as $entity)
                                    <option value="{{ $entity->id }}" {{ $apprentice->person->pension_entity_id == $entity->id ? 'selected' : '' }}>{{ $entity->name }}</option>
                                @endforeach
                            </select>
                            @error('pension_entity_id')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nickname">{{ trans('sia::controllers.SIA_apprentice_nickname') }}</label>
                            <input type="text" name="nickname" id="nickname" class="form-control" value="{{ $apprentice->user->nickname }}" required>
                            @error('nickname')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">{{ trans('sia::controllers.SIA_apprentice_email') }}</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ $apprentice->user->email }}" required>
                            @error('email')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{ trans('sia::controllers.SIA_apprentice_password') }}</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="{{ trans('sia::controllers.SIA_apprentice_password_placeholder') }}">
                            @error('password')
                                <div class="alert alert-danger py-0 my-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white text-right">
                <a href="{{ route('sia.apprentice-researchers.index') }}" class="btn btn-sm btn-light mr-2">
                    <strong>{{ trans('sia::controllers.SIA_apprentice_action_cancel') }}</strong>
                </a>
                <button type="submit" class="btn btn-sm btn-success" id="btn-update-apprentice">
                    <b>{{ trans('sia::controllers.SIA_apprentice_action_update') }}</b>
                </button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#form-apprentice").submit(function() {
                $("#btn-update-apprentice").prop("disabled", true);
                toastr.success('Actualizando aprendiz...', 'Procesando');
            });
        });
    </script>
@endpush