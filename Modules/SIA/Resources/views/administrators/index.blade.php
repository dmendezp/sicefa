@extends('sia::layouts.master')

@push('head')
    <!-- Estilos personalizados si es necesario -->
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('sia.admin.administrators.index') }}" class="text-decoration-none text-secondary fw-bold">
            {{ trans('sia::administratorresearcher.index_title_page') }}
        </a>
    </li>
    <li class="breadcrumb-item active">{{ trans('sia::administratorresearcher.index_title_view') }}</li>
@endpush

@section('content')
    <div class="card card-success card-outline col-12 mx-auto custom-border-color">
        <div class="card-body">
            <h2 class="card-title">{{ $view['titleView'] }}</h2>

            <!-- Botón para crear nuevo administrador -->
            <div class="mb-4 text-right">
                <a href="{{ route('sia.admin.administrators.create') }}" class="btn btn-success">
                    {{ trans('sia::administratorresearcher.create_new') }}
                </a>
            </div>

            <!-- Tabla de administradores -->
            <div class="table-responsive">
                <table class="table table-striped" id="administratorsTable">
                    <thead>
                        <tr>
                            <th>{{ trans('sia::administratorresearcher.table_name') }}</th>
                            <th>{{ trans('sia::administratorresearcher.table_email') }}</th>
                            <th>{{ trans('sia::administratorresearcher.table_profession') }}</th>
                            <th>{{ trans('sia::administratorresearcher.table_research_skills') }}</th>
                            <th>{{ trans('sia::administratorresearcher.table_actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($administrators as $administrator)
                            <tr>
                                <td>{{ $administrator->person->fullName ?? 'N/A' }}</td>
                                <td>{{ $administrator->user->email ?? 'N/A' }}</td>
                                <td>{{ $administrator->profession->name ?? 'N/A' }}</td>
                                <td>{{ $administrator->research_skills ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('sia.admin.administrators.edit', $administrator->id) }}" class="btn btn-primary btn-sm">
                                        {{ trans('sia::administratorresearcher.action_edit') }}
                                    </a>
                                    <form action="{{ route('sia.admin.administrators.destroy', $administrator->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete(event);">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            {{ trans('sia::administratorresearcher.action_delete') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">{{ trans('sia::administratorresearcher.no_records') }}</td>
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
                title: '{{ trans('sia::administratorresearcher.confirm_delete') }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '{{ trans('sia::administratorresearcher.action_delete') }}',
                cancelButtonText: '{{ trans('sia::administratorresearcher.action_cancel') }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.closest('form').submit();
                }
            });
        }

        $(document).ready(function() {
            $('#administratorsTable').DataTable({
                language: window.language_datatables,
                pageLength: 10,
                order: [[0, 'asc']]
            });
        });
    </script>
@endpush