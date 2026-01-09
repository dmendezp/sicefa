@extends('sg::layouts.master')

@section('content')
<br><br>
<div>
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Insumo: {{ $supply->code }} - {{ $supply->name }}
        </h2>
    </div>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl rounded-lg p-8">

                <form action="{{ route('sg.admin.sg.insumos.update', $supply) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Código *</label>
                            <input type="text" name="code" value="{{ old('code', $supply->code) }}" required
                                   class="w-full px-4 py-3 border rounded-lg @error('code') border-red-500 @enderror">
                            @error('code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nombre *</label>
                            <input type="text" name="name" value="{{ old('name', $supply->name) }}" required
                                   class="w-full px-4 py-3 border rounded-lg @error('name') border-red-500 @enderror">
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tipo *</label>
                            <select name="type" required class="w-full px-4 py-3 border rounded-lg">
                                <option value="MEDICINE" {{ $supply->type === 'MEDICINE' ? 'selected' : '' }}>Medicamento</option>
                                <option value="VACCINE" {{ $supply->type === 'VACCINE' ? 'selected' : '' }}>Vacuna</option>
                                <option value="FEED" {{ $supply->type === 'FEED' ? 'selected' : '' }}>Alimento</option>
                                <option value="SUPPLEMENT" {{ $supply->type === 'SUPPLEMENT' ? 'selected' : '' }}>Suplemento</option>
                                <option value="OTHER" {{ $supply->type === 'OTHER' ? 'selected' : '' }}>Otro</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Unidad *</label>
                            <select name="unit" required class="w-full px-4 py-3 border rounded-lg">
                                <option value="ml" {{ $supply->unit === 'ml' ? 'selected' : '' }}>Mililitros (ml)</option>
                                <option value="cm³" {{ $supply->unit === 'cm³' ? 'selected' : '' }}>Centímetros cúbicos</option>
                                <option value="g" {{ $supply->unit === 'g' ? 'selected' : '' }}>Gramos (g)</option>
                                <option value="kg" {{ $supply->unit === 'kg' ? 'selected' : '' }}>Kilogramos (kg)</option>
                                <option value="units" {{ $supply->unit === 'units' ? 'selected' : '' }}>Unidades</option>
                                <option value="liters" {{ $supply->unit === 'liters' ? 'selected' : '' }}>Litros</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Presentación</label>
                            <input type="text" name="presentation" value="{{ old('presentation', $supply->presentation) }}"
                                   class="w-full px-4 py-3 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Proveedor</label>
                            <input type="text" name="supplier" value="{{ old('supplier', $supply->supplier) }}"
                                   class="w-full px-4 py-3 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Precio Unitario</label>
                            <input type="number" step="0.01" name="unit_price" value="{{ old('unit_price', $supply->unit_price) }}"
                                   class="w-full px-4 py-3 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Stock Actual *</label>
                            <input type="number" step="0.001" name="current_stock" value="{{ old('current_stock', $supply->current_stock) }}" required
                                   class="w-full px-4 py-3 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Stock Mínimo *</label>
                            <input type="number" step="0.001" name="minimum_stock" value="{{ old('minimum_stock', $supply->minimum_stock) }}" required
                                   class="w-full px-4 py-3 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Fecha de Vencimiento</label>
                            <input type="date" name="expiration_date" 
                                   value="{{ old('expiration_date', $supply->expiration_date?->format('Y-m-d')) }}"
                                   class="w-full px-4 py-3 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Número de Lote</label>
                            <input type="text" name="batch_number" value="{{ old('batch_number', $supply->batch_number) }}"
                                   class="w-full px-4 py-3 border rounded-lg">
                        </div>

                        <div class="lg:col-span-3">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Observaciones</label>
                            <textarea name="observations" rows="4"
                                      class="w-full px-4 py-3 border rounded-lg">{{ old('observations', $supply->observations) }}</textarea>
                        </div>
                    </div>

                    <div class="flex justify-end mt-10 space-x-4">
                        <a href="{{ route('sg.admin.sg.insumos.show', $supply) }}"
                           class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-8 rounded-lg">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg">
                            Actualizar Insumo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection