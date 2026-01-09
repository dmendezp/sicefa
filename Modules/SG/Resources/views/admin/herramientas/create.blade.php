@extends('sg::layouts.master')

@section('content')
<div>
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nueva Herramienta</h2>
    </div>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-2xl rounded-lg p-8">

                <form action="{{ route('sg.admin.sg.herramientas.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Código *</label>
                            <input type="text" name="code" value="{{ old('code') }}" required
                                   class="w-full px-4 py-3 border rounded-lg @error('code') border-red-500 @enderror"
                                   placeholder="Ej: HER-001, BAL-2025">
                            @error('code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nombre *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   class="w-full px-4 py-3 border rounded-lg @error('name') border-red-500 @enderror"
                                   placeholder="Ej: Báscula Electrónica 1000kg">
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tipo *</label>
                            <select name="type" required class="w-full px-4 py-3 border rounded-lg">
                                <option value="">Seleccionar tipo</option>
                                <option value="SCALE">Báscula</option>
                                <option value="EAR_TAG">Arete / Marcador</option>
                                <option value="SYRINGE">Jeringa</option>
                                <option value="THERMOMETER">Termómetro</option>
                                <option value="OTHER">Otro</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Marca</label>
                            <input type="text" name="brand" value="{{ old('brand') }}"
                                   class="w-full px-4 py-3 border rounded-lg"
                                   placeholder="Ej: Tru-Test, Allflex">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Modelo</label>
                            <input type="text" name="model" value="{{ old('model') }}"
                                   class="w-full px-4 py-3 border rounded-lg"
                                   placeholder="Ej: XR5000">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Número de Serie</label>
                            <input type="text" name="serial_number" value="{{ old('serial_number') }}"
                                   class="w-full px-4 py-3 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Estado *</label>
                            <select name="status" required class="w-full px-4 py-3 border rounded-lg">
                                <option value="OPERATIONAL">Operativa</option>
                                <option value="MAINTENANCE">En Mantenimiento</option>
                                <option value="DAMAGED">Dañada</option>
                                <option value="OUT_OF_SERVICE">Fuera de Servicio</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Ubicación</label>
                            <input type="text" name="location" value="{{ old('location') }}"
                                   class="w-full px-4 py-3 border rounded-lg"
                                   placeholder="Ej: Corral de pesaje">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Fecha de Adquisición</label>
                            <input type="date" name="acquisition_date" value="{{ old('acquisition_date') }}"
                                   class="w-full px-4 py-3 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Valor de Compra</label>
                            <input type="number" step="0.01" name="purchase_value" value="{{ old('purchase_value') }}"
                                   class="w-full px-4 py-3 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Responsable Actual</label>
                            <input type="text" name="current_responsible" value="{{ old('current_responsible') }}"
                                   class="w-full px-4 py-3 border rounded-lg"
                                   placeholder="Ej: Juan Pérez">
                        </div>

                        <div class="lg:col-span-3">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Observaciones</label>
                            <textarea name="observations" rows="4"
                                      class="w-full px-4 py-3 border rounded-lg">{{ old('observations') }}</textarea>
                        </div>
                    </div>

                    <div class="flex justify-end mt-10 space-x-4">
                        <a href="{{ route('sg.admin.sg.herramientas.index') }}"
                           class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-8 rounded-lg">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg">
                            Guardar Herramienta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection