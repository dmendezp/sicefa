@extends('sia::layouts.master')

@push('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item active" aria-current="page">{{ trans('sia::groups.index_title_page') }}</li>
@endpush

@section('content')
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ trans('sia::groups.index_title_view') }}</h4>
        </div>
        <div class="card-body">
            @if (session('message_sia'))
                <div class="alert alert-{{ session('message_sia_type', 'info') }} alert-dismissible fade show mb-3" role="alert">
                    {{ session('message_sia') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="groupsTable">
                    <thead class="table-primary">
                        <tr>
                            <th>{{ trans('sia::groups.name') }}</th>
                            <th>{{ trans('sia::groups.description') }}</th>
                            <th>{{ trans('sia::groups.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($groups as $group)
                            <tr>
                                <td>{{ $group->name ?? 'N/A' }}</td>
                                <td>{{ $group->description ?? 'N/A' }}</td>
                                <td>
                                    @if (Auth::user()->hasRole('admin'))
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('sia.groups.edit', $group->id) }}" class="btn btn-warning btn-sm me-1">
                                                <i class="fas fa-edit"></i> {{ trans('sia::groups.action_edit') }}
                                            </a>
                                            <form action="{{ route('sia.groups.destroy', $group->id) }}" method="POST" style="display:inline;"
                                                onsubmit="return confirmDelete(event);">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> {{ trans('sia::groups.action_delete') }}
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">{{ trans('sia::groups.no_records') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if (Auth::user()->hasRole('admin'))
            <div class="card-footer bg-light text-end">
                <a href="{{ route('sia.groups.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> {{ trans('sia::groups.action_create') }}
                </a>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#groupsTable').DataTable({
                language: window.language_datatables,
                pageLength: 10,
                order: [[0, 'asc']],
                responsive: true
            });
        });

        function confirmDelete(event) {
            event.preventDefault();
            Swal.fire({
                title: '{{ trans('sia::groups.confirm_delete') }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '{{ trans('sia::groups.action_delete') }}',
                cancelButtonText: '{{ trans('sia::groups.action_cancel') }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.closest('form').submit();
                }
            });
        }
    </script>
@endpush