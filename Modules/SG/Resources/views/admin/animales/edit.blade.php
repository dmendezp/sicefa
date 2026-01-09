@extends('sg::layouts.master')

@section('content')
<br><br>
<div>
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Bovino: {{ $animal->id }} {{ $animal->name ? "- {$animal->name}" : '' }}
        </h2>
    </div>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-lg p-8">

                <form action="{{ route('sg.admin.sg.animales.update', $animal->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="text-center mb-8">
                        <div class="mx-auto w-48 h-48 bg-gray-200 border-4 border-dashed rounded-xl overflow-hidden">
                            <img src="{{ $animal->photo_url }}"
                                 id="preview"
                                 class="w-full h-full object-cover">
                        </div>
                        <input type="file" name="photo" id="photo" accept="image/*"
                               class="mt-4 block w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100">
                        <p class="text-xs text-gray-500 mt-2">Cambiar foto (dejar vacío para mantener actual)</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Código</label>
                            <input type="text" value="{{ $animal->id }}" disabled
                                   class="w-full px-4 py-3 bg-gray-100 border rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nombre</label>
                            <input type="text" name="name" value="{{ old('name', $animal->name) }}"
                                   class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                   placeholder="Ej: Luna, Estrella">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Raza *</label>
                            <select name="breed_id" required
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-yellow-500">
                                @foreach($breeds as $id => $name)
                                    <option value="{{ $id }}" {{ $animal->breed_id == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('breed_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Sexo *</label>
                            <div class="flex space-x-8">
                                <label class="flex items-center">
                                    <input type="radio" name="sex" value="FEMALE" {{ $animal->sex === 'FEMALE' ? 'checked' : '' }}
                                           class="mr-2 text-yellow-600">
                                    <span class="text-gray-700">Hembra (Vaca)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="sex" value="MALE" {{ $animal->sex === 'MALE' ? 'checked' : '' }}
                                           class="mr-2 text-yellow-600">
                                    <span class="text-gray-700">Macho (Toro)</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Fecha de Nacimiento *</label>
                            <input type="date" name="birth_date" value="{{ $animal->birth_date?->format('Y-m-d') }}" required
                                   class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-yellow-500">
                            @error('birth_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Fecha de Ingreso</label>
                            <input type="date" name="entry_date" value="{{ $animal->entry_date?->format('Y-m-d') }}"
                                   class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-yellow-500">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Peso Actual (kg)</label>
                            <input type="number" step="0.1" name="weight_kg" value="{{ $animal->weight_kg }}"
                                   class="w-full px-4 py-3 border rounded-lg"
                                   placeholder="Ej: 450.5">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Etapa de Producción *</label>
                            <select name="production_stage" required
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-yellow-500">
                                <option value="">Seleccionar etapa</option>
                                <option value="CALF" {{ $animal->production_stage == 'CALF' ? 'selected' : '' }}>Ternero</option>
                                <option value="GROWING" {{ $animal->production_stage == 'GROWING' ? 'selected' : '' }}>Crecimiento</option>
                                <option value="DRY" {{ $animal->production_stage == 'DRY' ? 'selected' : '' }}>Seca</option>
                                <option value="MILKING" {{ $animal->production_stage == 'MILKING' ? 'selected' : '' }}>En ordeño</option>
                                <option value="CULL" {{ $animal->production_stage == 'CULL' ? 'selected' : '' }}>Descarte</option>
                            </select>
                            @error('production_stage') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Grupo de Edad</label>
                            <input type="text" name="age_group" value="{{ old('age_group', $animal->age_group) }}"
                                   class="w-full px-4 py-3 border rounded-lg"
                                   placeholder="Ej: Joven, Adulto">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Valor de Inventario</label>
                            <input type="number" step="0.01" name="inventory_value" value="{{ $animal->inventory_value }}"
                                   class="w-full px-4 py-3 border rounded-lg"
                                   placeholder="Ej: 1500.00">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Lote / Corral</label>
                            <input type="text" name="lot" value="{{ $animal->lot }}"
                                   class="w-full px-4 py-3 border rounded-lg"
                                   placeholder="Ej: Corral 3, Lote A">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Condición Corporal</label>
                            <input type="text" name="body_condition" value="{{ old('body_condition', $animal->body_condition) }}"
                                   class="w-full px-4 py-3 border rounded-lg"
                                   placeholder="Ej: Bueno, Regular">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nota</label>
                            <input type="text" name="note" value="{{ old('note', $animal->note) }}"
                                   class="w-full px-4 py-3 border rounded-lg"
                                   placeholder="Nota adicional">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Observaciones</label>
                            <textarea name="observations" rows="4"
                                      class="w-full px-4 py-3 border rounded-lg">{{ $animal->observations }}</textarea>
                        </div>
                    </div>

                    <div class="flex justify-end mt-10 space-x-4">
                        <a href="{{ route('sg.admin.sg.animales.index') }}"
                           class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-8 rounded-lg">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transform hover:scale-105 transition">
                            Actualizar Bovino
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('photo').addEventListener('change', function(e) {
            const preview = document.getElementById('preview');
            const file = e.target.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);
            }
        });
    </script>
</div>
@endsection