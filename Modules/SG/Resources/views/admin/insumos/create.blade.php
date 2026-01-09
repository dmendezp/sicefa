@extends('sg::layouts.master')

@section('content')
<br><br>
<div>
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nuevo Insumo Ganadero
        </h2>
    </div>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl rounded-lg p-8">

                <form action="{{ route('sg.admin.sg.insumos.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Código *</label>
                            <input type="text" name="code" value="{{ old('code') }}" required
                                   class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-green-500 @error('code') border-red-500 @enderror"
                                   placeholder="Ej: INS-001, VAC-2025">
                            @error('code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nombre *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   class="w-full px-4 py-3 border rounded-lg @error('name') border-red-500 @enderror"
                                   placeholder="Ej: Albendazol 10%, Sal Mineralizada">
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tipo *</label>
                            <select name="type" required class="w-full px-4 py-3 border rounded-lg">
                                <option value="">Seleccionar tipo</option>
                                <option value="MEDICINE" {{ old('type') === 'MEDICINE' ? 'selected' : '' }}>Medicamento</option>
                                <option value="VACCINE" {{ old('type') === 'VACCINE' ? 'selected' : '' }}>Vacuna</option>
                                <option value="FEED" {{ old('type') === 'FEED' ? 'selected' : '' }}>Alimento</option>
                                <option value="SUPPLEMENT" {{ old('type') === 'SUPPLEMENT' ? 'selected' : '' }}>Suplemento</option>
                                <option value="OTHER" {{ old('type') === 'OTHER' ? 'selected' : '' }}>Otro</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Unidad *</label>
                            <select name="unit" required class="w-full px-4 py-3 border rounded-lg">
                                <option value="ml" {{ old('unit') === 'ml' ? 'selected' : '' }}>Mililitros (ml)</option>
                                <option value="cm³" {{ old('unit') === 'cm³' ? 'selected' : '' }}>Centímetros cúbicos</option>
                                <option value="g" {{ old('unit') === 'g' ? 'selected' : '' }}>Gramos (g)</option>
                                <option value="kg" {{ old('unit') === 'kg' ? 'selected' : '' }}>Kilogramos (kg)</option>
                                <option value="units" {{ old('unit') === 'units' ? 'selected' : '' }}>Unidades</option>
                                <option value="liters" {{ old('unit') === 'liters' ? 'selected' : '' }}>Litros</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Presentación</label>
                            <input type="text" name="presentation" value="{{ old('presentation') }}"
                                   class="w-full px-4 py-3 border rounded-lg"
                                   placeholder="Ej: Frasco 500ml, Bolsa 25kg">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Proveedor</label>
                            <input type="text" name="supplier" value="{{ old('supplier') }}"
                                   class="w-full px-4 py-3 border rounded-lg"
                                   placeholder="Ej: AgroVeterinaria La Angostura">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Precio Unitario</label>
                            <input type="number" step="0.01" name="unit_price" value="{{ old('unit_price') }}"
                                   class="w-full px-4 py-3 border rounded-lg"
                                   placeholder="0.00">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Stock Actual *</label>
                            <input type="number" step="0.001" name="current_stock" value="{{ old('current_stock', 0) }}" required
                                   class="w-full px-4 py-3 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Stock Mínimo *</label>
                            <input type="number" step="0.001" name="minimum_stock" value="{{ old('minimum_stock', 10) }}" required
                                   class="w-full px-4 py-3 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Fecha de Vencimiento</label>
                            <input type="date" name="expiration_date" value="{{ old('expiration_date') }}"
                                   class="w-full px-4 py-3 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Número de Lote</label>
                            <input type="text" name="batch_number" value="{{ old('batch_number') }}"
                                   class="w-full px-4 py-3 border rounded-lg">
                        </div>

                        <div class="lg:col-span-3">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Observaciones</label>
                            <textarea name="observations" rows="4"
                                      class="w-full px-4 py-3 border rounded-lg">{{ old('observations') }}</textarea>
                        </div>
                    </div>

                    <div class="flex justify-end mt-10 space-x-4">
                        <a href="{{ route('sg.admin.sg.insumos.index') }}"
                           class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-8 rounded-lg">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transform hover:scale-105 transition">
                            Guardar Insumo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection