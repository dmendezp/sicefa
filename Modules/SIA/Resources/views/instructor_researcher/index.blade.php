@extends('sia::layouts.master')

@push('head')
    <!-- Estilos personalizados si es necesario -->
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('sia.admin.instructor-researchers.index') }}" class="text-decoration-none text-secondary fw-bold">
            {{ trans('sia::instructorresearcher.index_title_page') }}
        </a>
    </li>
    <li class="breadcrumb-item active">{{ trans('sia::instructorresearcher.index_title_view') }}</li>
@endpush

@section('content')
    <div class="card card-success card-outline col-12 mx-auto custom-border-color">
        <div class="card-body">
            <h2 class="card-title">{{ $view['titleView'] }}</h2>

            <!-- Botón para crear nuevo instructor -->
            <div class="mb-4 text-right">
                <a href="{{ route('sia.admin.instructor-researchers.create') }}" class="btn btn-success">
                    {{ trans('sia::instructorresearcher.create_new') }}
                </a>
            </div>

            <!-- Tabla de instructores -->
            <div class="table-responsive">
                <table class="table table-striped" id="instructorsTable">
                    <thead>
                        <tr>
                            <th>{{ trans('sia::instructorresearcher.table_name') }}</th>
                            <th>{{ trans('sia::instructorresearcher.table_email') }}</th>
                            <th>{{ trans('sia::instructorresearcher.table_profession') }}</th>
                            <th>{{ trans('sia::instructorresearcher.table_research_skills') }}</th>
                            <th>{{ trans('sia::instructorresearcher.table_actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($instructors as $instructor)
                            <tr>
                                <td>{{ $instructor->person->fullName ?? 'N/A' }}</td>
                                <td>{{ $instructor->user->email ?? 'N/A' }}</td>
                                <td>{{ $instructor->profession->name ?? 'N/A' }}</td>
                                <td>{{ $instructor->research_skills ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('sia.admin.instructor-researchers.edit', $instructor->id) }}" class="btn btn-primary btn-sm">
                                        {{ trans('sia::instructorresearcher.action_edit') }}
                                    </a>
                                    <form action="{{ route('sia.admin.instructor-researchers.destroy', $instructor->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete(event);">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            {{ trans('sia::instructorresearcher.action_delete') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">{{ trans('sia::instructorresearcher.no_records') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mensajes de retroalimentación -->
            @if (session('message_sia'))
                @push('scripts')
                    <script>
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true
                        };
                        toastr['{{ session('message_sia_type', 'info') }}'](`{{ session('message_sia') }}`);
                    </script>
                @endpush
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function confirmDelete(event) {
            event.preventDefault();
            Swal.fire({
                title: '{{ trans('sia::instructorresearcher.confirm_delete') }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '{{ trans('sia::instructorresearcher.action_delete') }}',
                cancelButtonText: '{{ trans('sia::instructorresearcher.action_cancel') }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.closest('form').submit();
                }
            });
        }

        $(document).ready(function() {
            $('#instructorsTable').DataTable({
                language: window.language_datatables,
                pageLength: 10,
                order: [[0, 'asc']]
            });
        });
    </script>
@endpush