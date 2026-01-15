@extends('cafeto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('cafeto.admin.formulations.index') }}" class="text-decoration-none text-white">
            Formulaciones
        </a>
    </li>
    <li class="breadcrumb-item active text-light-gray">
        Aprobar Formulación #{{ $formulation->id }}
    </li>
@endpush

@section('content')
    <div class="container mt-4">
        <div class="card border-0 shadow-sm bg-dark text-white">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Aprobar Formulación</h4>
            </div>

            <div class="card-body">
                <h5 class="text-white mb-4">Producto final: {{ $formulation->element->name ?? 'Sin nombre' }}</h5>
                <p>Cantidad producida: <strong>{{ $formulation->amount }}</strong></p>
               <p>Fecha de producción: <strong>{{ $formulation->date ? \Carbon\Carbon::parse($formulation->date)->format('d/m/Y') : 'Sin fecha' }}</strong></p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('cafeto.admin.formulations.approve.store', $formulation) }}" method="POST">
                    @csrf
                    @method('POST')

                    <!-- Campos del producto producido -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label text-white">Fecha de vencimiento</label>
                            <input type="date" name="produced_expiration_date" 
                                   value="{{ old('produced_expiration_date', $formulation->produced_expiration_date ?? '') }}"
                                   class="form-control bg-dark text-white border-secondary">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-white">
                                <span class="text-danger">*</span> Número de lote
                            </label>
                            <input type="text" name="produced_lot_number" 
                                   value="{{ old('produced_lot_number', $formulation->produced_lot_number ?? '') }}"
                                   class="form-control bg-dark text-white border-secondary" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-white">Código de inventario</label>
                            <input type="text" name="produced_inventory_code" 
                                   value="{{ old('produced_inventory_code', $formulation->produced_inventory_code ?? '') }}"
                                   class="form-control bg-dark text-white border-secondary">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-white">Marca</label>
                            <input type="text" name="produced_mark" 
                                   value="{{ old('produced_mark', $formulation->produced_mark ?? '') }}"
                                   class="form-control bg-dark text-white border-secondary">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-white">
                                <span class="text-danger">*</span> Destino
                            </label>
                            <select name="produced_destination" class="form-select bg-dark text-white border-secondary" required>
                                <option value="">{{ trans('cafeto::formulations.Select Destination') }}</option>
                                @foreach ($destinations as $destination)
                                    <option value="{{ $destination }}" 
                                            {{ old('produced_destination', $formulation->produced_destination ?? '') == $destination ? 'selected' : '' }}>
                                        {{ $destination }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="d-flex gap-3 justify-content-end mt-4">
                        <a href="{{ route('cafeto.admin.formulations.index') }}" class="btn btn-secondary">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-success">
                            Aprobar y registrar en inventario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection