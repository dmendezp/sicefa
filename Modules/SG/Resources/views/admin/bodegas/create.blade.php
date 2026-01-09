@extends('sg::layouts.master')

@section('content')
<br><br>
<div>
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nueva Bodega</h2>
    <div>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">

                <form action="{{ route('sg.admin.sg.bodegas.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Código *</label>
                            <input type="text" name="code" value="{{ old('code') }}"
                                   class="w-full px-4 py-2 border rounded-lg @error('code') border-red-500 @enderror"
                                   placeholder="Ej: BOD-01, FARM-01">
                            @error('code')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nombre *</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   class="w-full px-4 py-2 border rounded-lg @error('name') border-red-500 @enderror"
                                   placeholder="Ej: Bodega Principal">
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Ubicación</label>
                            <input type="text" name="location" value="{{ old('location') }}"
                                   class="w-full px-4 py-2 border rounded-lg"
                                   placeholder="Ej: Al lado del corral de ordeño">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Descripción</label>
                            <textarea name="description" rows="4"
                                      class="w-full px-4 px-4 py-2 border rounded-lg">{{ old('description') }}</textarea>
                        </div>

                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-700">Bodega activa</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex justify-end mt-10 space-x-4">
                        <a href="{{ route('sg.admin.sg.bodegas.index') }}"
                           class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded">
                            Guardar Bodega
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection