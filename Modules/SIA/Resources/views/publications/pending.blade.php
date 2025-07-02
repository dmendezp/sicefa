@extends('sia::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('sia.admin.publications.index') }}" class="text-decoration-none text-dark">
            {{ trans('sia::publications.index_title_page') }}
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">{{ trans('sia::publications.pending_title_page') }}</li>
@endpush

@section('content')
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ $view['titleView'] }}</h4>
        </div>
        <div class="card-body">
            @if (session('message_sia'))
                <div class="alert alert-{{ session('message_sia_type', 'info') }} alert-dismissible fade show mb-3" role="alert">
                    {{ session('message_sia') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="pendingPublicationsTable">
                    <thead class="table-primary">
                        <tr>
                            <th>{{ trans('sia::publications.title') }}</th>
                            <th>{{ trans('sia::publications.publication_date') }}</th>
                            <th>{{ trans('sia::publications.author') }}</th>
                            <th>{{ trans('sia::publications.table_actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($publications as $publication)
                            <tr>
                                <td>{{ $publication->title ?? 'N/A' }}</td>
                                <td>{{ $publication->publication_date ? $publication->publication_date->format('Y-m-d') : 'N/A' }}</td>
                                <td>{{ $publication->author->name ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('sia.admin.publications.review', $publication->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-check"></i> {{ trans('sia::publications.action_review') }}
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">{{ trans('sia::publications.no_records') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#pendingPublicationsTable').DataTable({
                language: window.language_datatables,
                pageLength: 10,
                order: [[1, 'desc']],
                responsive: true
            });
        });
    </script>
@endpush