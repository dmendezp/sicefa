@extends('sia::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('sia.alliances.index') }}" class="text-decoration-none text-dark">
            {{ trans('sia::alliances.index_title_page') }}
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">{{ trans('sia::alliances.create_title_page') }}</li>
@endpush

@section('content')
    <form action="{{ route('sia.alliances.store') }}" method="POST" id="form-alliance">
        @csrf
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">{{ trans('sia::alliances.create_title_view') }}</h4>
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
                            <label for="name" class="form-label">{{ trans('sia::alliances.name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required
                                value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="organization" class="form-label">{{ trans('sia::alliances.organization') }} <span class="text-danger">*</span></label>
                            <input type="text" name="organization" id="organization" class="form-control @error('organization') is-invalid @enderror" required
                                value="{{ old('organization') }}">
                            @error('organization')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">{{ trans('sia::alliances.email') }} <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" required
                                value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description" class="form-label">{{ trans('sia::alliances.description') }} <span class="text-danger">*</span></label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="start_date" class="form-label">{{ trans('sia::alliances.start_date') }} <span class="text-danger">*</span></label>
                            <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" required
                                value="{{ old('start_date') }}" min="{{ now()->format('Y-m-d') }}">
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="end_date" class="form-label">{{ trans('sia::alliances.end_date') }}</label>
                            <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror"
                                value="{{ old('end_date') }}">
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status" class="form-label">{{ trans('sia::alliances.status') }} <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="">{{ trans('sia::alliances.select_status') }}</option>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                    {{ trans('sia::alliances.status_active') }}
                                </option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                    {{ trans('sia::alliances.status_inactive') }}
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
                <a href="{{ route('sia.alliances.index') }}" class="btn btn-secondary btn-sm me-2">
                    <i class="fas fa-times"></i> {{ trans('sia::alliances.action_cancel') }}
                </a>
                <button type="submit" class="btn btn-primary btn-sm" id="btn-register-alliance">
                    <i class="fas fa-save"></i> {{ trans('sia::alliances.action_create') }}
                </button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#form-alliance').on('submit', function(e) {
                $('#btn-register-alliance').prop('disabled', true).html(
                    '<i class="fas fa-spinner fa-spin"></i> {{ trans("sia::alliances.processing") }}'
                );
            });

            $('#name, #organization, #email, #description, #start_date, #end_date, #status').on('input change', function() {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            });

            $('#end_date').on('change', function() {
                var startDate = $('#start_date').val();
                if (startDate && $(this).val() && $(this).val() <= startDate) {
                    $(this).addClass('is-invalid');
                    $(this).after('<div class="invalid-feedback">{{ trans("sia::controllers.SIA_alliance_end_date_after") }}</div>');
                }
            });
        });
    </script>
@endpush