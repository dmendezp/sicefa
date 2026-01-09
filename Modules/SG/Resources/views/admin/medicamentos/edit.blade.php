@extends('sg::layouts.master')

@section('content')
<br><br>
<div>
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Medicamento: {{ $medicine->name }}
        </h2>
    </div>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">

                <form action="{{ route('sg.admin.sg.medicamentos.update', $medicine->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Nombre Comercial *
                            </label>
                            <input type="text" name="name" value="{{ old('name', $medicine->name) }}"
                                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Principio Activo *
                            </label>
                            <input type="text" name="active_principle" value="{{ old('active_principle', $medicine->active_principle) }}"
                                   class="w-full px-4 py-2 border rounded-lg @error('active_principle') border-red-500 @enderror">
                            @error('active_principle')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Presentación *</label>
                            <input type="text" name="presentation" value="{{ old('presentation', $medicine->presentation) }}"
                                   class="w-full px-4 py-2 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Unidad de Dosis *</label>
                            <input type="text" name="dose_unit" value="{{ old('dose_unit', $medicine->dose_unit) }}"
                                   class="w-full px-4 py-2 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Laboratorio</label>
                            <input type="text" name="manufacturer" value="{{ old('manufacturer', $medicine->manufacturer) }}"
                                   class="w-full px-4 py-2 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Lote</label>
                            <input type="text" name="batch" value="{{ old('batch', $medicine->batch) }}"
                                   class="w-full px-4 py-2 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Fecha de Vencimiento *</label>
                            <input type="date" name="expiration_date"
                                   value="{{ old('expiration_date', $medicine->expiration_date?->format('Y-m-d')) }}"
                                   class="w-full px-4 py-2 border rounded-lg @error('expiration_date') border-red-500 @enderror">
                            @error('expiration_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Stock Actual *</label>
                            <input type="number" step="0.01" name="stock" value="{{ old('stock', $medicine->stock) }}"
                                   class="w-full px-4 py-2 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Stock Mínimo *</label>
                            <input type="number" name="minimum_stock" value="{{ old('minimum_stock', $medicine->minimum_stock) }}"
                                   class="w-full px-4 py-2 border rounded-lg">
                        </div>
                    </div>

                    <div class="mt-8">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Observaciones</label>
                        <textarea name="observations" rows="5"
                                  class="w-full px-4 py-2 border rounded-lg">{{ old('observations', $medicine->observations) }}</textarea>
                    </div>

                    <div class="flex justify-end mt-10 space-x-4">
                        <a href="{{ route('sg.admin.sg.medicamentos.index') }}"
                           class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded">
                            Actualizar Medicamento
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection