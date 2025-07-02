@extends('sia::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('sia.admin.publications.index') }}" class="text-decoration-none text-dark">
            {{ trans('sia::publications.index_title_page') }}
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">{{ trans('sia::publications.edit_title_page') }}</li>
@endpush

@section('content')
    <form action="{{ route('sia.admin.publications.update', $publication->id) }}" method="POST" id="form-publication" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">{{ trans('sia::publications.edit_title_view') }}</h4>
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
                            <label for="title" class="form-label">{{ trans('sia::publications.title') }} <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" required
                                value="{{ old('title', $publication->title) }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pdf_path" class="form-label">{{ trans('sia::publications.pdf_path') }} <span class="text-danger">*</span></label>
                            <input type="file" name="pdf_path" id="pdf_path" class="form-control @error('pdf_path') is-invalid @enderror" required
                                accept=".pdf">
                            <small class="text-muted">{{ trans('sia::publications.current_pdf') }}: {{ $publication->pdf_path }}</small>
                            @error('pdf_path')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="publication_date" class="form-label">{{ trans('sia::publications.publication_date') }} <span class="text-danger">*</span></label>
                            <input type="date" name="publication_date" id="publication_date" class="form-control @error('publication_date') is-invalid @enderror" required
                                value="{{ old('publication_date', $publication->publication_date) }}" min="{{ now()->format('Y-m-d') }}">
                            @error('publication_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status" class="form-label">{{ trans('sia::publications.status') }} <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="">{{ trans('sia::publications.select_status') }}</option>
                                <option value="pending" {{ old('status', $publication->status) == 'pending' ? 'selected' : '' }}>
                                    {{ trans('sia::publications.status_pending') }}
                                </option>
                                <option value="published" {{ old('status', $publication->status) == 'published' ? 'selected' : '' }}>
                                    {{ trans('sia::publications.status_published') }}
                                </option>
                                <option value="rejected" {{ old('status', $publication->status) == 'rejected' ? 'selected' : '' }}>
                                    {{ trans('sia::publications.status_rejected') }}
                                </option>
                            </select>
                            @error('status')
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
                <button type="submit" class="btn btn-primary btn-sm" id="btn-update-publication">
                    <i class="fas fa-save"></i> {{ trans('sia::publications.action_update') }}
                </button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#form-publication').on('submit', function(e) {
                $('#btn-update-publication').prop('disabled', true).html(
                    '<i class="fas fa-spinner fa-spin"></i> {{ trans("sia::publications.processing") }}'
                );
            });

            $('#title, #pdf_path, #publication_date, #status').on('input change', function() {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            });
        });
    </script>
@endpush