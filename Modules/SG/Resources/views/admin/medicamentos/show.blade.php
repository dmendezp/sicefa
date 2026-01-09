@extends('sg::layouts.master')

@section('content')
<br><br>
<div>
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle del Medicamento
        </h2>
    </div>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-lg font-bold text-gray-700">Nombre Comercial</h3>
                        <p class="text-xl text-gray-900">{{ $medicine->name }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-700">Principio Activo</h3>
                        <p class="text-xl text-gray-900">{{ $medicine->active_principle }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-700">Presentación</h3>
                        <p>{{ $medicine->presentation }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-700">Unidad de Dosis</h3>
                        <p>{{ $medicine->dose_unit }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-700">Laboratorio</h3>
                        <p>{{ $medicine->manufacturer ?: 'No especificado' }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-700">Lote</h3>
                        <p>{{ $medicine->batch ?: 'Sin lote' }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-700">Fecha de Vencimiento</h3>
                        <p class="{{ $medicine->expiration_date < now() ? 'text-red-600' : '' }}">
                            {{ $medicine->expiration_date->format('d/m/Y') }}
                        </p>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-700">Stock Actual</h3>
                        <p class="{{ $medicine->stock <= $medicine->minimum_stock ? 'text-red-600 font-bold' : 'text-gray-900' }}">
                            {{ $medicine->stock }} {{ $medicine->dose_unit }}
                        </p>
                    </div>
                </div>

                <div class="mt-8">
                    <h3 class="text-lg font-bold text-gray-700 mb-3">Observaciones</h3>
                    <p class="text-gray-600">{{ $medicine->observations ?: 'Sin observaciones' }}</p>
                </div>

                <div class="mt-10 flex space-x-4">
                    <a href="{{ route('sg.admin.sg.medicamentos.edit', $medicine) }}" 
                       class="btn btn-warning">
                        Editar Medicamento
                    </a>
                    <a href="{{ route('sg.admin.sg.medicamentos.index') }}" 
                       class="btn btn-primary">
                        ← Volver al Listado
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection