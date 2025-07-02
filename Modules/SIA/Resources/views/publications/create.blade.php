@extends('sia::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('sia.admin.publications.index') }}" class="text-decoration-none text-dark">
            {{ trans('sia::publications.index_title_page') }}
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">{{ trans('sia::publications.create_title_page') }}</li>
@endpush

@section('content')
    <form action="{{ route('sia.admin.publications.store') }}" method="POST" id="form-publication" enctype="multipart/form-data">
        @csrf
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">{{ $view['titleView'] }}</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="titulo" class="form-label">{{ trans('sia::publications.title') }} <span class="text-danger">*</span></label>
                            <input type="text" name="titulo" id="titulo" class="form-control @error('titulo') is-invalid @enderror" required
                                value="{{ old('titulo') }}">
                            @error('titulo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="contenido" class="form-label">{{ trans('sia::publications.pdf_path') }} <span class="text-danger">*</span></label>
                            <input type="file" name="contenido" id="contenido" class="form-control @error('contenido') is-invalid @enderror" required
                                accept=".pdf">
                            @error('contenido')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fecha_publicacion" class="form-label">{{ trans('sia::publications.publication_date') }} <span class="text-danger">*</span></label>
                            <input type="date" name="fecha_publicacion" id="fecha_publicacion" class="form-control @error('fecha_publicacion') is-invalid @enderror" required
                                value="{{ old('fecha_publicacion') }}" min="{{ now()->format('Y-m-d') }}">
                            @error('fecha_publicacion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="estado" class="form-label">{{ trans('sia::publications.status') }} <span class="text-danger">*</span></label>
                            <select name="estado" id="estado" class="form-select @error('estado') is-invalid @enderror" required>
                                <option value="">{{ trans('sia::publications.select_status') }}</option>
                                <option value="PENDIENTE" {{ old('estado') == 'PENDIENTE' ? 'selected' : '' }}>
                                    {{ trans('sia::publications.status_pending') }}
                                </option>
                                <option value="PUBLICADO" {{ old('estado') == 'PUBLICADO' ? 'selected' : '' }}>
                                    {{ trans('sia::publications.status_published') }}
                                </option>
                                <option value="RECHAZADO" {{ old('estado') == 'RECHAZADO' ? 'selected' : '' }}>
                                    {{ trans('sia::publications.status_rejected') }}
                                </option>
                            </select>
                            @error('estado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light text-end">
                <a href="{{ route('sia.admin.publications.index') }}" class="btn btn-secondary btn-sm me-2">
                    <i class="fas fa-times"></i> {{ trans('sia::publications.action_cancel') }}
                </a>
                <button type="submit" class="btn btn-primary btn-sm" id="btn-register-publication">
                    <i class="fas fa-save"></i> {{ trans('sia::publications.action_register') }}
                </button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#form-publication').on('submit', function(e) {
                $('#btn-register-publication').prop('disabled', true).html(
                    '<i class="fas fa-spinner fa-spin"></i> {{ trans("sia::publications.processing") }}'
                );
            });

            // Validación en tiempo real
            $('#titulo, #contenido, #fecha_publicacion, #estado').on('input change', function() {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            });
        });
    </script>
@endpush