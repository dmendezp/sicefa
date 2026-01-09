@extends('sg::layouts.master')

@section('content')
<br><br>
<div>
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nuevo Medicamento
        </h2>
    </div>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">

                <form action="{{ route('sg.admin.sg.medicamentos.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Nombre Comercial *
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('name') border-red-500 @enderror"
                                   placeholder="Ej: Oxitetraciclina LA 20%">
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Principio Activo *
                            </label>
                            <input type="text" name="active_principle" value="{{ old('active_principle') }}"
                                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('active_principle') border-red-500 @enderror"
                                   placeholder="Ej: Oxitetraciclina">
                            @error('active_principle')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Presentación *
                            </label>
                            <input type="text" name="presentation" value="{{ old('presentation') }}"
                                   class="w-full px-4 py-2 border rounded-lg"
                                   placeholder="Ej: Frasco 100 ml">
                            @error('presentation')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Unidad de Dosis *
                            </label>
                            <input type="text" name="dose_unit" value="{{ old('dose_unit') }}"
                                   class="w-full px-4 py-2 border rounded-lg"
                                   placeholder="Ej: ml, mg, UI">
                            @error('dose_unit')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Laboratorio
                            </label>
                            <input type="text" name="manufacturer" value="{{ old('manufacturer') }}"
                                   class="w-full px-4 py-2 border rounded-lg"
                                   placeholder="Ej: Zoetis, MSD">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Lote
                            </label>
                            <input type="text" name="batch" value="{{ old('batch') }}"
                                   class="w-full px-4 py-2 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Fecha de Vencimiento *
                            </label>
                            <input type="date" name="expiration_date" value="{{ old('expiration_date') }}"
                                   class="w-full px-4 py-2 border rounded-lg @error('expiration_date') border-red-500 @enderror">
                            @error('expiration_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Stock Actual *
                            </label>
                            <input type="number" step="0.01" name="stock" value="{{ old('stock', 0) }}"
                                   class="w-full px-4 py-2 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">
                                Stock Mínimo *
                            </label>
                            <input type="number" name="minimum_stock" value="{{ old('minimum_stock', 10) }}"
                                   class="w-full px-4 py-2 border rounded-lg">
                        </div>
                    </div>

                    <div class="mt-8">
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            Observaciones
                        </label>
                        <textarea name="observations" rows="5"
                                  class="w-full px-4 py-2 border rounded-lg">{{ old('observations') }}</textarea>
                    </div>

                    <div class="flex justify-end mt-10 space-x-4">
                        <a href="{{ route('sg.admin.sg.medicamentos.index') }}"
                           class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded">
                            Guardar Medicamento
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection