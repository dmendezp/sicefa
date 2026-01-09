@extends('sg::layouts.master')

@section('content')
<br><br>
<div>
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Herramienta: {{ $tool->code }}
        </h2>
    </div>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-2xl rounded-lg p-8">

                <form action="{{ route('sg.admin.sg.herramientas.update', $tool) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Código *</label>
                            <input type="text" name="code" value="{{ old('code', $tool->code) }}" required
                                   class="w-full px-4 py-3 border rounded-lg @error('code') border-red-500 @enderror">
                            @error('code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nombre *</label>
                            <input type="text" name="name" value="{{ old('name', $tool->name) }}" required
                                   class="w-full px-4 py-3 border rounded-lg @error('name') border-red-500 @enderror">
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tipo *</label>
                            <select name="type" required class="w-full px-4 py-3 border rounded-lg">
                                <option value="SCALE" {{ $tool->type === 'SCALE' ? 'selected' : '' }}>Báscula</option>
                                <option value="EAR_TAG" {{ $tool->type === 'EAR_TAG' ? 'selected' : '' }}>Arete / Marcador</option>
                                <option value="SYRINGE" {{ $tool->type === 'SYRINGE' ? 'selected' : '' }}>Jeringa</option>
                                <option value="THERMOMETER" {{ $tool->type === 'THERMOMETER' ? 'selected' : '' }}>Termómetro</option>
                                <option value="OTHER" {{ $tool->type === 'OTHER' ? 'selected' : '' }}>Otro</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Marca</label>
                            <input type="text" name="brand" value="{{ old('brand', $tool->brand) }}"
                                   class="w-full px-4 py-3 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Modelo</label>
                            <input type="text" name="model" value="{{ old('model', $tool->model) }}"
                                   class="w-full px-4 py-3 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Número de Serie</label>
                            <input type="text" name="serial_number" value="{{ old('serial_number', $tool->serial_number) }}"
                                   class="w-full px-4 py-3 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Estado *</label>
                            <select name="status" required class="w-full px-4 py-3 border rounded-lg">
                                <option value="OPERATIONAL" {{ $tool->status === 'OPERATIONAL' ? 'selected' : '' }}>Operativa</option>
                                <option value="MAINTENANCE" {{ $tool->status === 'MAINTENANCE' ? 'selected' : '' }}>En Mantenimiento</option>
                                <option value="DAMAGED" {{ $tool->status === 'DAMAGED' ? 'selected' : '' }}>Dañada</option>
                                <option value="OUT_OF_SERVICE" {{ $tool->status === 'OUT_OF_SERVICE' ? 'selected' : '' }}>Fuera de Servicio</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Ubicación</label>
                            <input type="text" name="location" value="{{ old('location', $tool->location) }}"
                                   class="w-full px-4 py-3 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Fecha de Adquisición</label>
                            <input type="date" name="acquisition_date" value="{{ $tool->acquisition_date?->format('Y-m-d') }}"
                                   class="w-full px-4 py-3 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Valor de Compra</label>
                            <input type="number" step="0.01" name="purchase_value" value="{{ old('purchase_value', $tool->purchase_value) }}"
                                   class="w-full px-4 py-3 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Responsable Actual</label>
                            <input type="text" name="current_responsible" value="{{ old('current_responsible', $tool->current_responsible) }}"
                                   class="w-full px-4 py-3 border rounded-lg">
                        </div>

                        <div class="lg:col-span-3">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Observaciones</label>
                            <textarea name="observations" rows="4"
                                      class="w-full px-4 py-3 border rounded-lg">{{ old('observations', $tool->observations) }}</textarea>
                        </div>
                    </div>

                    <div class="flex justify-end mt-10 space-x-4">
                        <a href="{{ route('sg.admin.sg.herramientas.show', $tool) }}"
                           class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-8 rounded-lg">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg">
                            Actualizar Herramienta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection