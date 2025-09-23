@extends('gdmf::layouts.master')

@section('content')
    <div class="container">
        <div class="card card-menta card-outline shadow">
            <div class="card-body">
                {{-- Filtros --}}
                <form method="GET" class="row g-3 mb-4">
                    <div class="col-md-3">
                        <label>Instructor</label>
                        <select name="instructor_id" class="form-control select2">
                            <option value="">Todos</option>
                            @foreach ($instructors as $id => $name)
                                <option value="{{ $id }}" {{ request('instructor_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>Ficha (Curso)</label>
                        <select name="course_id" class="form-control select2">
                            <option value="">Todos</option>
                            @foreach ($courses as $id => $code)
                                <option value="{{ $id }}" {{ request('course_id') == $id ? 'selected' : '' }}>
                                    {{ $code }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label>Desde</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label>Hasta</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}" class="form-control">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-menta w-100">Filtrar</button>
                    </div>
                </form>

                {{-- Tabla de solicitudes --}}
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Fecha</th>
                                <th>Instructor</th>
                                <th>Ficha</th>
                                <th>Proyecto</th>
                                <th>Financiación</th>
                                <th>Total</th>
                                <th>Detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tbody>
                            @forelse($requests as $req)
                                <tr>
                                    <td>{{ $req->created_at->format('Y-m-d H:i') }}</td>
                                    <td>{{ $req->person->full_name }}</td>
                                    <td>{{ $req->course->code }}</td>
                                    <td>{{ Str::limit($req->training_project->name, 40) }}</td>
                                    <td>{{ $req->funding_source }}</td>
                                    <td>${{ number_format($req->total, 0, ',', '.') }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#modalReq{{ $req->id }}">
                                            Ver
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No se encontraron solicitudes.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- MODALES AQUÍ ABAJO --}}
                    @foreach ($requests as $req)
                        <div class="modal fade" id="modalReq{{ $req->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Solicitud #{{ $req->id }} Detalles</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Ingresada por:</strong> {{ $req->person->full_name }} el
                                            {{ $req->created_at->format('Y-m-d H:i') }}</p>
                                        <p><strong>Ficha:</strong> {{ $req->course->code }} | <strong>Proyecto:</strong>
                                            {{ $req->training_project->name }}</p>
                                        <p><strong>Total:</strong> ${{ number_format($req->total, 0, ',', '.') }}</p>
                                        <p><strong>Financiación:</strong>
                                            @if ($req->funding_source === 'proyecto')
                                                100% Proyecto Formativo
                                            @elseif ($req->funding_source === 'produccion')
                                                100% Producción de Centro
                                            @else
                                                Proyecto:
                                                ${{ number_format($req->from_project, 0, ',', '.') }} |
                                                Producción:
                                                ${{ number_format($req->from_production, 0, ',', '.') }}
                                            @endif
                                        </p>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Material</th>
                                                    <th>Precio Unit.</th>
                                                    <th>Cantidad</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($req->items as $it)
                                                    <tr>
                                                        <td>{{ $it->element->name }}</td>
                                                        <td>${{ number_format($it->unit_price, 0, ',', '.') }}</td>
                                                        <td>{{ $it->quantity }}</td>
                                                        <td>${{ number_format($it->subtotal, 0, ',', '.') }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                    </table>
                    {{ $requests->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(() => $('.select2').select2());
    </script>
@endpush
