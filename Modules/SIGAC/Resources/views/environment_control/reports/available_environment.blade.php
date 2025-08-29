@extends('sigac::layouts.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form method="GET"
                    action="{{ route('sigac.academic_coordination.environmentcontrol.environment.report') }}">
                    <div class="form-group">
                        <label>Selecciona una fecha:</label>
                        <input type="date" name="date" value="{{ $selectedDate }}" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Consultar</button>
                </form>

                <hr>

                @if ($availableEnvironments->isEmpty())
                    <p>No hay ambientes disponibles para la fecha seleccionada.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="environmentsTable">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Tipo</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($availableEnvironments as $environment)
                                    <tr>
                                        <td>{{ $environment->name }}</td>
                                        <td>{{ $environment->description ?? 'Sin descripción' }}</td>
                                        <td>{{ $environment->type_environment }}</td>
                                        <td>{{ $environment->status }}</td>
                                        <td>
                                            <a href="{{ route('sigac.academic_coordination.environmentcontrol.activity.create', ['environment_id' => $environment->id]) }}"
                                                class="btn btn-primary btn-sm">
                                                Programar Actividad
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#environmentsTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json'
                }
            });
        });
    </script>
@endpush
