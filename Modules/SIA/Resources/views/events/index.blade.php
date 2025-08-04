@extends('sia::layouts.master')

@push('head')
    <!-- Estilos personalizados si es necesario -->
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('sia.admin.events.index') }}" class="text-decoration-none text-secondary fw-bold">
            {{ trans('sia::eventsia.index_title_page') }}
        </a>
    </li>
    <li class="breadcrumb-item active">{{ trans('sia::eventsia.index_title_view') }}</li>
@endpush

@section('content')
    <div class="card card-success card-outline col-12 mx-auto custom-border-color">
        <div class="card-body">
            <h2 class="card-title">{{ $view['titleView'] }}</h2>

            <!-- Botón para crear nuevo evento -->
            <div class="mb-4 text-right">
                <a href="{{ route('sia.admin.events.create') }}" class="btn btn-success">
                    {{ trans('sia::eventsia.action_create') }}
                </a>
            </div>

            <!-- Tabla de eventos -->
            <div class="table-responsive">
                <table class="table table-striped" id="eventsTable">
                    <thead>
                        <tr>
                            <th>{{ trans('sia::eventsia.table_name') }}</th>
                            <th>{{ trans('sia::eventsia.table_location') }}</th>
                            <th>{{ trans('sia::eventsia.table_start_date') }}</th>
                            <th>{{ trans('sia::eventsia.table_status') }}</th>
                            <th>{{ trans('sia::eventsia.table_actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($events as $event)
                            <tr>
                                <td>{{ $event->name ?? 'N/A' }}</td>
                                <td>{{ $event->location ?? 'N/A' }}</td>
                                <td>{{ $event->start_date ? $event->start_date->format('Y-m-d') : 'N/A' }}</td>
                                <td>{{ $event->status ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('sia.admin.events.edit', $event->id) }}" class="btn btn-primary btn-sm">
                                        {{ trans('sia::eventsia.action_edit') }}
                                    </a>
                                    <form action="{{ route('sia.admin.events.destroy', $event->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete(event);">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            {{ trans('sia::eventsia.action_delete') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">{{ trans('sia::eventsia.no_records') }}</td>
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
                title: '{{ trans('sia::eventsia.confirm_delete') }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '{{ trans('sia::eventsia.action_delete') }}',
                cancelButtonText: '{{ trans('sia::eventsia.action_cancel') }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.closest('form').submit();
                }
            });
        }

        $(document).ready(function() {
            $('#eventsTable').DataTable({
                language: window.language_datatables,
                pageLength: 10,
                order: [[2, 'asc']] // Ordenar por fecha de inicio
            });
        });
    </script>
@endpush