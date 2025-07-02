@extends('sia::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('sia.groups.index') }}" class="text-decoration-none text-dark">
            {{ trans('sia::groups.index_title_page') }}
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">{{ trans('sia::groups.create_title_page') }}</li>
@endpush

@section('content')
    <form action="{{ route('sia.groups.store') }}" method="POST" id="form-group">
        @csrf
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">{{ trans('sia::groups.create_title_view') }}</h4>
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
                            <label for="name" class="form-label">{{ trans('sia::groups.name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required
                                value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description" class="form-label">{{ trans('sia::groups.description') }} <span class="text-danger">*</span></label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light text-end">
                <a href="{{ route('sia.groups.index') }}" class="btn btn-secondary btn-sm me-2">
                    <i class="fas fa-times"></i> {{ trans('sia::groups.action_cancel') }}
                </a>
                <button type="submit" class="btn btn-primary btn-sm" id="btn-register-group">
                    <i class="fas fa-save"></i> {{ trans('sia::groups.register') }}
                </button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#form-group').on('submit', function(e) {
                $('#btn-register-group').prop('disabled', true).html(
                    '<i class="fas fa-spinner fa-spin"></i> {{ trans("sia::groups.processing") }}'
                );
            });

            $('#name, #description').on('input change', function() {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            });
        });
    </script>
@endpush