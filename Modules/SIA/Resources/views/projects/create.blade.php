@extends('sia::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('sia.admin.projects.index') }}" class="text-decoration-none text-dark">
            {{ trans('sia::projects.index_title_page') }}
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">{{ trans('sia::projects.create_title_page') }}</li>
@endpush

@section('content')
    <form action="{{ route('sia.admin.projects.store') }}" method="POST" id="form-project" enctype="multipart/form-data">
        @csrf
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">{{ trans('sia::projects.create_title_view') }}</h4>
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
                            <label for="name" class="form-label">{{ trans('sia::projects.name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required
                                value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-label">{{ trans('sia::projects.description') }} <span class="text-danger">*</span></label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_date" class="form-label">{{ trans('sia::projects.start_date') }} <span class="text-danger">*</span></label>
                            <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" required
                                value="{{ old('start_date') }}" min="{{ now()->format('Y-m-d') }}">
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="end_date" class="form-label">{{ trans('sia::projects.end_date') }} <span class="text-danger">*</span></label>
                            <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" required
                                value="{{ old('end_date') }}">
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pdf_report_path" class="form-label">{{ trans('sia::projects.pdf_report_path') }}</label>
                            <input type="file" name="pdf_report_path" id="pdf_report_path" class="form-control @error('pdf_report_path') is-invalid @enderror"
                                accept=".pdf">
                            @error('pdf_report_path')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="estado" class="form-label">{{ trans('sia::projects.estado') }} <span class="text-danger">*</span></label>
                            <select name="estado" id="estado" class="form-select @error('estado') is-invalid @enderror" required>
                                <option value="">{{ trans('sia::projects.select_status') }}</option>
                                <option value="EN_CURSO" {{ old('estado') == 'EN_CURSO' ? 'selected' : '' }}>
                                    {{ trans('sia::projects.estado_EN_CURSO') }}
                                </option>
                                <option value="FINALIZADO" {{ old('estado') == 'FINALIZADO' ? 'selected' : '' }}>
                                    {{ trans('sia::projects.estado_FINALIZADO') }}
                                </option>
                                <option value="CANCELADO" {{ old('estado') == 'CANCELADO' ? 'selected' : '' }}>
                                    {{ trans('sia::projects.estado_CANCELADO') }}
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
                <a href="{{ route('sia.admin.projects.index') }}" class="btn btn-secondary btn-sm me-2">
                    <i class="fas fa-times"></i> {{ trans('sia::projects.action_cancel') }}
                </a>
                <button type="submit" class="btn btn-primary btn-sm" id="btn-register-project">
                    <i class="fas fa-save"></i> {{ trans('sia::projects.action_register') }}
                </button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#form-project').on('submit', function(e) {
                $('#btn-register-project').prop('disabled', true).html(
                    '<i class="fas fa-spinner fa-spin"></i> {{ trans("sia::projects.processing") }}'
                );
            });

            $('#name, #description, #start_date, #end_date, #pdf_report_path, #estado').on('input change', function() {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            });

            $('#end_date').on('change', function() {
                var startDate = $('#start_date').val();
                if (startDate && $(this).val() <= startDate) {
                    $(this).addClass('is-invalid');
                    $(this).after('<div class="invalid-feedback">{{ trans("sia::controllers.SIA_project_end_date_valid") }}</div>');
                }
            });
        });
    </script>
@endpush