@extends('cafeto::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/cafeto/css/formulations/create.css') }}">
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.formulations.index') }}"
           class="text-decoration-none text-white">{{ trans('cafeto::formulations.Breadcrumb_Formulations_1') }}</a>
    </li>
    <li class="breadcrumb-item active text-light-gray">
        {{ trans('cafeto::formulations.Breadcrumb_Active_Create_Formulations_1') }}
    </li>
@endpush

@section('content')
<div class="container mt-4">
    <div class="card border-0 shadow-sm bg-dark text-white">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">{{ trans('cafeto::formulations.Create') }}</h4>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @php
                $user = Auth::user();
                $routePrefix = getRoleRouteName(Route::currentRouteName());
                $person_name = $user->person ? $user->person->full_name : $user->name;
                $today = $today ?? now()->format('Y-m-d');
                $oldIngredients = old('ingredients', []);
            @endphp

            <form action="{{ route('cafeto.' . $routePrefix . '.formulations.store') }}" method="POST">
                @csrf

                {{-- ===================== Datos principales ===================== --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label text-white">{{ trans('cafeto::formulations.Title_Form_Owner') }}</label>
                        <input type="text" class="form-control bg-dark text-white border-secondary"
                               value="{{ $person_name }}" readonly>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-white">
                            <span class="text-danger">*</span> {{ trans('cafeto::formulations.Product') }} (Producto final)
                        </label>
                        <select name="element_id" class="form-select bg-dark text-white border-secondary" required>
                            <option value="">{{ trans('cafeto::formulations.Select Product') }}</option>
                            @foreach ($elements as $element)
                                <option value="{{ $element->id }}" {{ old('element_id') == $element->id ? 'selected' : '' }}>
                                    {{ $element->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Fecha fija: hoy (no editable) --}}
                    <div class="col-md-4">
                        <label class="form-label text-white">
                            <span class="text-danger">*</span> {{ trans('cafeto::formulations.Date') }}
                        </label>

                        <input type="hidden" name="date" value="{{ $today }}">

                        <input type="date"
                               class="form-control bg-dark text-white border-secondary"
                               value="{{ $today }}"
                               readonly>
                        <small class="text-muted">La fecha se asigna automáticamente (hoy).</small>
                    </div>

                    {{-- Cantidad final: ENTERA --}}
                    <div class="col-md-4">
                        <label class="form-label text-white">
                            <span class="text-danger">*</span> {{ trans('cafeto::formulations.Amount') }}
                        </label>

                        <input type="number"
                               name="amount"
                               id="amount"
                               value="{{ old('amount', 1) }}"
                               class="form-control bg-dark text-white border-secondary"
                               required min="1" step="1"
                               inputmode="numeric" pattern="[0-9]*"
                               onclick="showAmountHint()"
                               oninput="forceInteger(this)">

                        <small id="amountHint" class="text-warning d-none">
                            La cantidad debe ser un número entero (1, 2, 3...). No se permiten decimales.
                        </small>
                    </div>
                </div>

                {{-- ===================== Detalles producto producido ===================== --}}
                <hr class="bg-secondary my-4">
                <h5 class="text-white mb-3">{{ trans('cafeto::formulations.Produced Product Details') }}</h5>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label text-white">{{ trans('cafeto::formulations.Expiration Date') }}</label>

                        {{-- min=HOY evita que el usuario seleccione antes de hoy --}}
                        <input type="date"
                               name="produced_expiration_date"
                               value="{{ old('produced_expiration_date') }}"
                               min="{{ $today }}"
                               class="form-control bg-dark text-white border-secondary">

                        <small class="text-muted">Si eliges fecha, debe ser desde hoy en adelante.</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-white">
                            <span class="text-danger">*</span> {{ trans('cafeto::formulations.Lot Number') }}
                        </label>
                        <input type="text"
                               name="produced_lot_number"
                               value="{{ old('produced_lot_number') }}"
                               class="form-control bg-dark text-white border-secondary"
                               required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-white">{{ trans('cafeto::formulations.Inventory Code') }}</label>
                        <input type="text"
                               name="produced_inventory_code"
                               value="{{ old('produced_inventory_code') }}"
                               class="form-control bg-dark text-white border-secondary">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-white">{{ trans('cafeto::formulations.Mark') }}</label>
                        <input type="text"
                               name="produced_mark"
                               value="{{ old('produced_mark') }}"
                               class="form-control bg-dark text-white border-secondary">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-white">
                            <span class="text-danger">*</span> {{ trans('cafeto::formulations.Destination') }}
                        </label>
                        <select name="produced_destination" class="form-select bg-dark text-white border-secondary" required>
                            <option value="">{{ trans('cafeto::formulations.Select Destination') }}</option>
                            @foreach ($destinations as $destination)
                                <option value="{{ $destination }}" {{ old('produced_destination') == $destination ? 'selected' : '' }}>
                                    {{ trans('cafeto::formulations.' . $destination) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- ===================== Ingredientes ===================== --}}
                <hr class="bg-secondary my-4">
                <h5 class="text-white mb-3">{{ trans('cafeto::formulations.Ingredients') }}</h5>

                <div id="ingredients-container">
                    @if (count($oldIngredients) > 0)
                        @foreach ($oldIngredients as $i => $ing)
                            <div class="ingredient-row row g-3 mb-3 align-items-end">
                                <div class="col-md-5">
                                    <label class="form-label text-white">{{ trans('cafeto::formulations.Element') }}</label>
                                    <select name="ingredients[{{ $i }}][element_id]" class="form-select bg-dark text-white border-secondary" required>
                                        <option value="">{{ trans('cafeto::formulations.None') }}</option>
                                        @foreach ($elements as $element)
                                            <option value="{{ $element->id }}" {{ (isset($ing['element_id']) && (int)$ing['element_id'] === (int)$element->id) ? 'selected' : '' }}>
                                                {{ $element->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label text-white">{{ trans('cafeto::formulations.Amount') }}</label>
                                    <input type="number"
                                           name="ingredients[{{ $i }}][amount]"
                                           value="{{ $ing['amount'] ?? '' }}"
                                           class="form-control bg-dark text-white border-secondary"
                                           required min="0.001" step="0.01">
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label text-white">{{ trans('cafeto::formulations.Unit') }}</label>
                                    <select name="ingredients[{{ $i }}][unit]" class="form-select bg-dark text-white border-secondary" required>
                                        @php $u = $ing['unit'] ?? 'g'; @endphp
                                        <option value="g"  {{ $u === 'g'  ? 'selected' : '' }}>g</option>
                                        <option value="mg" {{ $u === 'mg' ? 'selected' : '' }}>mg</option>
                                        <option value="ml" {{ $u === 'ml' ? 'selected' : '' }}>ml</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <button type="button"
                                            class="btn btn-outline-danger btn-sm mt-4"
                                            onclick="removeIngredient(this)"
                                            {{ $i === 0 ? '' : '' }}>
                                        {{ trans('cafeto::formulations.Delete') }}
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        {{-- fila inicial por defecto --}}
                        <div class="ingredient-row row g-3 mb-3 align-items-end">
                            <div class="col-md-5">
                                <label class="form-label text-white">{{ trans('cafeto::formulations.Element') }}</label>
                                <select name="ingredients[0][element_id]" class="form-select bg-dark text-white border-secondary" required>
                                    <option value="">{{ trans('cafeto::formulations.None') }}</option>
                                    @foreach ($elements as $element)
                                        <option value="{{ $element->id }}">{{ $element->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label text-white">{{ trans('cafeto::formulations.Amount') }}</label>
                                <input type="number"
                                       name="ingredients[0][amount]"
                                       class="form-control bg-dark text-white border-secondary"
                                       required min="0.001" step="0.01">
                            </div>

                            <div class="col-md-2">
                                <label class="form-label text-white">{{ trans('cafeto::formulations.Unit') }}</label>
                                <select name="ingredients[0][unit]" class="form-select bg-dark text-white border-secondary" required>
                                    <option value="g">g</option>
                                    <option value="mg">mg</option>
                                    <option value="ml">ml</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <button type="button" class="btn btn-outline-danger btn-sm mt-4" disabled>
                                    {{ trans('cafeto::formulations.Delete') }}
                                </button>
                            </div>
                        </div>
                    @endif
                </div>

                <button type="button" class="btn btn-outline-light mb-4" onclick="addIngredient()">
                    + {{ trans('cafeto::formulations.Add Ingredient') }}
                </button>

                {{-- ===================== Botones ===================== --}}
                <div class="d-flex gap-3 justify-content-end mt-4">
                    <a href="{{ route('cafeto.' . $routePrefix . '.formulations.index') }}"
                       class="btn btn-secondary">
                        {{ trans('cafeto::formulations.Back') }}
                    </a>
                    <button type="submit" class="btn btn-success">
                        {{ trans('cafeto::formulations.Save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // contador inicia en cantidad de ingredientes renderizados
    let ingredientIndex = {{ max(1, count(old('ingredients', []))) }};

    function showAmountHint() {
        document.getElementById('amountHint').classList.remove('d-none');
    }

    function forceInteger(input) {
        let v = (input.value ?? '').toString();
        v = v.replace(',', '.');
        v = v.replace(/[^0-9]/g, '');
        if (v === '') v = '1';
        if (parseInt(v, 10) < 1) v = '1';
        input.value = v;
    }

    function addIngredient() {
        const container = document.getElementById('ingredients-container');
        const row = document.createElement('div');
        row.className = 'ingredient-row row g-3 mb-3 align-items-end';

        row.innerHTML = `
            <div class="col-md-5">
                <label class="form-label text-white">{{ trans('cafeto::formulations.Element') }}</label>
                <select name="ingredients[${ingredientIndex}][element_id]" class="form-select bg-dark text-white border-secondary" required>
                    <option value="">{{ trans('cafeto::formulations.None') }}</option>
                    @foreach ($elements as $element)
                        <option value="{{ $element->id }}">{{ $element->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label text-white">{{ trans('cafeto::formulations.Amount') }}</label>
                <input type="number"
                       name="ingredients[${ingredientIndex}][amount]"
                       class="form-control bg-dark text-white border-secondary"
                       required min="0.001" step="0.01">
            </div>

            <div class="col-md-2">
                <label class="form-label text-white">{{ trans('cafeto::formulations.Unit') }}</label>
                <select name="ingredients[${ingredientIndex}][unit]" class="form-select bg-dark text-white border-secondary" required>
                    <option value="g">g</option>
                    <option value="mg">mg</option>
                    <option value="ml">ml</option>
                </select>
            </div>

            <div class="col-md-2">
                <button type="button" class="btn btn-outline-danger btn-sm mt-4" onclick="removeIngredient(this)">
                    {{ trans('cafeto::formulations.Delete') }}
                </button>
            </div>
        `;

        container.appendChild(row);
        ingredientIndex++;

        updateDeleteButtons();
    }

    function removeIngredient(button) {
        const rows = document.querySelectorAll('.ingredient-row');
        if (rows.length <= 1) return;

        button.closest('.ingredient-row').remove();
        updateDeleteButtons();
    }

    function updateDeleteButtons() {
        const rows = document.querySelectorAll('.ingredient-row');
        const disable = rows.length <= 1;

        rows.forEach((r, idx) => {
            const btn = r.querySelector('.btn-outline-danger');
            if (!btn) return;
            btn.disabled = disable && idx === 0;
        });
    }

    document.addEventListener('DOMContentLoaded', updateDeleteButtons);
</script>
@endpush
