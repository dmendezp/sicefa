@extends('sia::layouts.master')

@push('head')
    <!-- Estilos personalizados si es necesario -->
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('sia.admin.apprentice-researchers.index') }}" class="text-decoration-none text-secondary fw-bold">
            {{ trans('sia::apprenticeresearcher.index_title_page') }}
        </a>
    </li>
    <li class="breadcrumb-item active">{{ trans('sia::apprenticeresearcher.index_title_view') }}</li>
@endpush

@section('content')
    <div class="card card-success card-outline col-12 mx-auto custom-border-color">
        <div class="card-body">
            <h2 class="card-title">{{ $view['titleView'] }}</h2>

            <!-- Botón para crear nuevo aprendiz -->
            <div class="mb-4 text-right">
                <a href="{{ route('sia.admin.apprentice-researchers.create') }}" class="btn btn-success">
                    {{ trans('sia::apprenticeresearcher.create_new') }}
                </a>
            </div>

            <!-- Tabla de aprendices -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>{{ trans('sia::apprenticeresearcher.table_name') }}</th>
                            <th>{{ trans('sia::apprenticeresearcher.table_nickname') }}</th>
                            <th>{{ trans('sia::apprenticeresearcher.table_program') }}</th>
                            <th>{{ trans('sia::apprenticeresearcher.table_course') }}</th>
                            <th>{{ trans('sia::apprenticeresearcher.table_institution') }}</th>
                            <th>{{ trans('sia::apprenticeresearcher.table_actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($apprentices as $apprentice)
                            <tr>
                                <td>{{ $apprentice->person->fullName ?? 'N/A' }}</td>
                                <td>{{ $apprentice->user->nickname ?? 'N/A' }}</td>
                                <td>{{ $apprentice->program->name ?? 'N/A' }}</td>
                                <td>{{ $apprentice->course->codeName ?? 'N/A' }}</td>
                                <td>{{ $apprentice->institution ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('sia.admin.apprentice-researchers.edit', $apprentice->id) }}" class="btn btn-primary btn-sm">
                                        {{ trans('sia::apprenticeresearcher.action_edit') }}
                                    </a>
                                    <form action="{{ route('sia.admin.apprentice-researchers.destroy', $apprentice->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete(event);">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            {{ trans('sia::apprenticeresearcher.action_delete') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">{{ trans('sia::apprenticeresearcher.no_records') }}</td>
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
                title: '{{ trans('sia::apprenticeresearcher.confirm_delete') }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '{{ trans('sia::apprenticeresearcher.action_delete') }}',
                cancelButtonText: '{{ trans('sia::apprenticeresearcher.action_cancel') }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.closest('form').submit();
                }
            });
        }

        $(document).ready(function() {
            $('.table').DataTable({
                language: window.language_datatables
            });
        });
    </script>
@endpush