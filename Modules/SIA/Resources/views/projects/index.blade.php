@extends('sia::layouts.master')

@push('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active" aria-current="page">{{ trans('sia::projects.index_title_page') }}</li>
@endpush

@section('content')
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ trans('sia::projects.index_title_view') }}</h4>
        </div>
        <div class="card-body">
            @if (session('message_sia'))
                <div class="alert alert-{{ session('message_sia_type', 'info') }} alert-dismissible fade show mb-3" role="alert">
                    {{ session('message_sia') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="projectsTable">
                    <thead class="table-primary">
                        <tr>
                            <th>{{ trans('sia::projects.name') }}</th>
                            <th>{{ trans('sia::projects.start_date') }}</th>
                            <th>{{ trans('sia::projects.end_date') }}</th>
                            <th>{{ trans('sia::projects.estado') }}</th>
                            <th>{{ trans('sia::projects.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($projects as $project)
                            <tr>
                                <td>{{ $project->name ?? 'N/A' }}</td>
                                <td>{{ $project->start_date ? $project->start_date->format('Y-m-d') : 'N/A' }}</td>
                                <td>{{ $project->end_date ? $project->end_date->format('Y-m-d') : 'N/A' }}</td>
                                <td>{{ trans('sia::projects.estado_' . strtolower($project->estado)) ?? 'N/A' }}</td>
                                <td>
                                    @if (Auth::user()->hasRole('admin|sia.inst-inv') && ($project->leader_id === Auth::id() || Auth::user()->hasRole('admin')))
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('sia.admin.projects.edit', $project->id) }}" class="btn btn-warning btn-sm me-1">
                                                <i class="fas fa-edit"></i> {{ trans('sia::projects.action_edit') }}
                                            </a>
                                            <form action="{{ route('sia.admin.projects.destroy', $project->id) }}" method="POST" style="display:inline;"
                                                onsubmit="return confirmDelete(event);">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> {{ trans('sia::projects.action_delete') }}
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                    @if (!$project->users()->where('user_id', Auth::id())->exists())
                                        <form action="{{ route('sia.projects.register', $project->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm" {{ $project->isInProgress() ? '' : 'disabled' }}>
                                                <i class="fas fa-user-plus"></i> {{ trans('sia::projects.register') }}
                                            </button>
                                        </form>
                                    @else
                                        <span class="badge bg-secondary">{{ trans('sia::projects.registered') }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">{{ trans('sia::projects.no_records') }}</td>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#projectsTable').DataTable({
                language: window.language_datatables,
                pageLength: 10,
                order: [[1, 'desc']],
                responsive: true
            });
        });

        function confirmDelete(event) {
            event.preventDefault();
            Swal.fire({
                title: '{{ trans('sia::projects.confirm_delete') }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '{{ trans('sia::projects.action_delete') }}',
                cancelButtonText: '{{ trans('sia::projects.action_cancel') }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.closest('form').submit();
                }
            });
        }
    </script>
@endpush