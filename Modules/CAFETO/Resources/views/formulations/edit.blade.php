{{-- EDIT: resources/views/modules/cafeto/formulations/edit.blade.php --}}
@extends('cafeto::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/cafeto/css/formulations/create.css') }}">
    @livewireStyles()
@endpush

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('cafeto.' . getRoleRouteName(Route::currentRouteName()) . '.formulations.index') }}"
           class="text-decoration-none text-white">{{ trans('cafeto::formulations.Breadcrumb_Formulations_1') }}</a>
    </li>
    @if(isset($is_approval_mode) && $is_approval_mode)
        <li class="breadcrumb-item active text-light-gray">
            {{ trans('cafeto::formulations.Breadcrumb_Active_Approve_Formulations') }}
        </li>
    @else
        <li class="breadcrumb-item active text-light-gray">
            {{ trans('cafeto::formulations.Edit') }}
        </li>
    @endif
@endpush

@section('content')
@php
    $routePrefix = getRoleRouteName(Route::currentRouteName());
    $MAX_AMOUNT = $max_amount ?? 100000;
@endphp

<div class="container mt-4">
    <div class="card border-0 shadow-sm bg-dark text-white">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">
                @if(isset($is_approval_mode) && $is_approval_mode)
                    {{ trans('cafeto::formulations.Approve') }} #{{ $formulation->id }}
                @else
                    {{ trans('cafeto::formulations.Edit') }} #{{ $formulation->id }}
                @endif
            </h4>
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

            <form id="formulation-form" action="{{
                (isset($is_approval_mode) && $is_approval_mode)
                    ? route("cafeto.{$routePrefix}.formulations.approve", $formulation)
                    : route("cafeto.{$routePrefix}.formulations.update", $formulation)
            }}" method="POST">
                @csrf
                @if(isset($is_approval_mode) && $is_approval_mode)
                    @method('POST')
                @else
                    @method('PUT')
                @endif

                <div class="row g-3 mb-3">
                    <div class="col-md-12">
                        @livewire('cafeto::formulation.select-product', ['formulation' => $formulation])
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label text-white">
                            <span class="text-danger">*</span> {{ trans('cafeto::formulations.Amount') }}
                        </label>

                        <div id="amount-alert" class="alert alert-warning py-2 px-3 mb-2 d-none" role="alert"></div>

                        <input type="number" id="amount" name="amount"
                               value="{{ old('amount', $formulation->amount) }}"
                               class="form-control bg-dark text-white border-secondary"
                               required min="1" max="{{ $MAX_AMOUNT }}" step="1" inputmode="numeric">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label text-white">
                            <span class="text-danger">*</span> {{ trans('cafeto::formulations.Date') }}
                        </label>
                        <input type="date" name="date"
                               value="{{ old('date', $formulation->date) }}"
                               class="form-control bg-dark text-white border-secondary" required>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-12">
                        <label class="form-label text-white">Proceso</label>
                        <textarea name="process"
                                  class="form-control bg-dark text-white border-secondary"
                                  rows="4"
                                  placeholder="Describe el proceso...">{{ old('process', $formulation_process_text ?? null) }}</textarea>
                        <small class="text-light opacity-75">
                            Se guarda dentro de <b>formulations.proccess</b> (sin crear columnas nuevas).
                        </small>
                    </div>
                </div>

                @if(isset($is_approval_mode) && $is_approval_mode)
                    <hr class="bg-secondary my-4">
                    <h5 class="text-white mb-3">{{ trans('cafeto::formulations.Produced Product Details') }}</h5>

                    <div class="row g-3 mb-2">
                        <div class="col-md-6">
                            <label class="form-label text-white">{{ trans('cafeto::formulations.Expiration Date') }}</label>
                            <input type="date" name="produced_expiration_date"
                                   value="{{ old('produced_expiration_date', $formulation->produced_expiration_date) }}"
                                   class="form-control bg-dark text-white border-secondary">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-white">
                                <span class="text-danger">*</span> {{ trans('cafeto::formulations.Lot Number') }}
                            </label>
                            <input type="text" name="produced_lot_number"
                                   value="{{ old('produced_lot_number', $formulation->produced_lot_number) }}"
                                   class="form-control bg-dark text-white border-secondary" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-white">{{ trans('cafeto::formulations.Inventory Code') }}</label>
                            <input type="text" name="produced_inventory_code"
                                   value="{{ old('produced_inventory_code', $formulation->produced_inventory_code) }}"
                                   class="form-control bg-dark text-white border-secondary">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-white">{{ trans('cafeto::formulations.Mark') }}</label>
                            <input type="text" name="produced_mark"
                                   value="{{ old('produced_mark', $formulation->produced_mark) }}"
                                   class="form-control bg-dark text-white border-secondary">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-white">
                                <span class="text-danger">*</span> {{ trans('cafeto::formulations.Destination') }}
                            </label>
                            <select name="produced_destination" class="form-select bg-dark text-white border-secondary" required>
                                <option value="">{{ trans('cafeto::formulations.Select Destination') }}</option>
                                @foreach ($destinations as $destination)
                                    <option value="{{ $destination }}"
                                        {{ old('produced_destination', $formulation->produced_destination) === $destination ? 'selected' : '' }}>
                                        {{ trans('cafeto::formulations.' . $destination) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif

                <hr class="bg-secondary my-4">
                <h5 class="text-white mb-3">{{ trans('cafeto::formulations.Ingredients') }}</h5>

                <div id="ingredients-alert" class="alert alert-info py-2 px-3 mb-3 d-none" role="alert"></div>

                <div id="ingredients-container">
                    @php
                        $oldIngredients = old('ingredients');
                        $rows = is_array($oldIngredients)
                            ? $oldIngredients
                            : $formulation->ingredients->map(fn($ing) => [
                                'element_id' => $ing->element_id,
                                'amount' => $ing->amount,
                                'unit' => 'g',
                            ])->toArray();
                    @endphp

                    @foreach ($rows as $index => $ingredient)
                        @php $u = $ingredient['unit'] ?? 'g'; @endphp
                        <div class="ingredient-row row g-3 mb-3 align-items-end">
                            <div class="col-md-5">
                                <label class="form-label text-white">{{ trans('cafeto::formulations.Element') }}</label>
                                <select name="ingredients[{{ $index }}][element_id]" class="form-select bg-dark text-white border-secondary" required>
                                    @foreach ($elements as $element)
                                        <option value="{{ $element->id }}"
                                            {{ (string)($ingredient['element_id'] ?? '') === (string)$element->id ? 'selected' : '' }}>
                                            {{ $element->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label text-white">{{ trans('cafeto::formulations.Amount') }}</label>
                                <input type="number"
                                       name="ingredients[{{ $index }}][amount]"
                                       value="{{ $ingredient['amount'] ?? '' }}"
                                       class="form-control bg-dark text-white border-secondary ingredient-amount"
                                       data-base="{{ $ingredient['amount'] ?? '' }}"
                                       required min="0.000001" step="any" inputmode="decimal">
                            </div>

                            <div class="col-md-2">
                                <label class="form-label text-white">{{ trans('cafeto::formulations.Unit') }}</label>
                                <select name="ingredients[{{ $index }}][unit]" class="form-select bg-dark text-white border-secondary ingredient-unit" required>
                                    <option value="g"  {{ $u === 'g' ? 'selected' : '' }}>g</option>
                                    <option value="mg" {{ $u === 'mg' ? 'selected' : '' }}>mg</option>
                                    <option value="ml" {{ $u === 'ml' ? 'selected' : '' }}>ml</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <button type="button"
                                        class="btn btn-outline-danger btn-sm mt-4 btn-remove-ingredient"
                                        onclick="removeIngredient(this)"
                                        {{ $index === 0 && count($rows) === 1 ? 'disabled' : '' }}>
                                    {{ trans('cafeto::formulations.Delete') }}
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button type="button" class="btn btn-outline-light mb-4" onclick="addIngredient()">
                    + {{ trans('cafeto::formulations.Add Ingredient') }}
                </button>

                <div class="d-flex gap-3 justify-content-end mt-4">
                    <a href="{{ route("cafeto.{$routePrefix}.formulations.index") }}" class="btn btn-secondary">
                        {{ trans('cafeto::formulations.Back') }}
                    </a>
                    <button type="submit" class="btn btn-success">
                        @if(isset($is_approval_mode) && $is_approval_mode)
                            {{ trans('cafeto::formulations.Approve') }}
                        @else
                            {{ trans('cafeto::formulations.Update') }}
                        @endif
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@livewireScripts()
<script>
    const MAX_AMOUNT = {{ $MAX_AMOUNT }};
    const elements = @json($elements->map(fn($e)=>['id'=>$e->id,'name'=>$e->name])->values());
    let ingredientIndex = {{ count($rows) }};

    function elementOptionsHtml(selectedId = '') {
        let html = '';
        for (const el of elements) {
            const selected = String(selectedId) === String(el.id) ? 'selected' : '';
            html += `<option value="${el.id}" ${selected}>${el.name}</option>`;
        }
        return html;
    }

    function addIngredient() {
        const container = document.getElementById('ingredients-container');
        const row = document.createElement('div');
        row.className = 'ingredient-row row g-3 mb-3 align-items-end';

        row.innerHTML = `
            <div class="col-md-5">
                <label class="form-label text-white">{{ trans('cafeto::formulations.Element') }}</label>
                <select name="ingredients[${ingredientIndex}][element_id]" class="form-select bg-dark text-white border-secondary" required>
                    ${elementOptionsHtml()}
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label text-white">{{ trans('cafeto::formulations.Amount') }}</label>
                <input type="number"
                       name="ingredients[${ingredientIndex}][amount]"
                       class="form-control bg-dark text-white border-secondary ingredient-amount"
                       data-base=""
                       required min="0.000001" step="any" inputmode="decimal">
            </div>

            <div class="col-md-2">
                <label class="form-label text-white">{{ trans('cafeto::formulations.Unit') }}</label>
                <select name="ingredients[${ingredientIndex}][unit]" class="form-select bg-dark text-white border-secondary ingredient-unit" required>
                    <option value="g">g</option>
                    <option value="mg">mg</option>
                    <option value="ml">ml</option>
                </select>
            </div>

            <div class="col-md-2">
                <button type="button" class="btn btn-outline-danger btn-sm mt-4 btn-remove-ingredient"
                        onclick="removeIngredient(this)">{{ trans('cafeto::formulations.Delete') }}</button>
            </div>
        `;
        container.appendChild(row);
        ingredientIndex++;
        refreshRemoveButtons();
        bindIngredientHandlers(container.lastElementChild);
        recalcTotals(true);
        showIngredientsInfo('Ingrediente agregado. Totales actualizados en los campos.');
    }

    function removeIngredient(button) {
        const rows = document.querySelectorAll('.ingredient-row');
        if (rows.length <= 1) return;
        button.closest('.ingredient-row').remove();
        refreshRemoveButtons();
        recalcTotals(true);
    }

    function refreshRemoveButtons() {
        const rows = document.querySelectorAll('.ingredient-row');
        const disable = rows.length <= 1;
        document.querySelectorAll('.btn-remove-ingredient').forEach(btn => btn.disabled = disable);
    }

    function parseNumberLoose(value) {
        if (value === null || value === undefined) return 0;
        let v = String(value).trim();
        if (v === '') return 0;
        v = v.replace(/\s+/g, '');
        v = v.replace(',', '.');
        v = v.replace(/[^0-9.]/g, '');
        const dotCount = (v.match(/\./g) || []).length;
        if (dotCount > 1) {
            const parts = v.split('.');
            v = parts.shift() + '.' + parts.join('');
        }
        const n = parseFloat(v);
        return isNaN(n) ? 0 : n;
    }

    function formatSmart(n) {
        if (!isFinite(n)) return '';
        return (Math.round(n * 1000000) / 1000000).toString();
    }

    function getAmountMultiplier() {
        const input = document.getElementById('amount');
        let m = parseInt(input.value || '1', 10);
        if (isNaN(m) || m < 1) m = 1;
        if (m > MAX_AMOUNT) m = MAX_AMOUNT;
        return m;
    }

    function showAmountWarning(msg) {
        const box = document.getElementById('amount-alert');
        if (!msg) { box.classList.add('d-none'); box.textContent=''; return; }
        box.classList.remove('d-none');
        box.textContent = msg;
    }

    function showIngredientsInfo(msg) {
        const box = document.getElementById('ingredients-alert');
        if (!msg) { box.classList.add('d-none'); box.textContent=''; return; }
        box.classList.remove('d-none');
        box.textContent = msg;
    }

    function bindIngredientHandlers(scope = document) {
        scope.querySelectorAll('.ingredient-amount').forEach(inp => {
            inp.addEventListener('focus', () => inp.select());

            inp.addEventListener('input', () => {
                const m = getAmountMultiplier();
                const typed = parseNumberLoose(inp.value);
                if (typed <= 0) return;

                const base = (m > 1) ? (typed / m) : typed;
                inp.dataset.base = String(base);

                showIngredientsInfo('Ingredientes actualizados automáticamente en los campos.');
            });

            inp.addEventListener('blur', () => recalcTotals(true));
        });
    }

    function recalcTotals(updateInputs = false) {
        const m = getAmountMultiplier();
        if (m === 1) showAmountWarning('');
        else showAmountWarning(`Cantidad = ${m}. Los ingredientes se actualizan en los campos (Base × Cantidad).`);

        document.querySelectorAll('.ingredient-amount').forEach(inp => {
            let base = parseNumberLoose(inp.dataset.base);
            const current = parseNumberLoose(inp.value);

            if ((!base || base <= 0) && current > 0) {
                base = (m > 1) ? (current / m) : current;
                inp.dataset.base = String(base);
            }

            const total = base * m;

            if (updateInputs) {
                inp.value = total > 0 ? formatSmart(total) : '';
            }
        });
    }

    function prepareSubmitAsBase() {
        document.querySelectorAll('.ingredient-amount').forEach(inp => {
            const base = parseNumberLoose(inp.dataset.base);
            if (base > 0) inp.value = formatSmart(base);
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        refreshRemoveButtons();

        const amountInput = document.getElementById('amount');
        amountInput.addEventListener('focus', () => amountInput.select());
        amountInput.addEventListener('input', () => {
            let v = parseInt(amountInput.value || '1', 10);
            if (isNaN(v) || v < 1) v = 1;
            if (v > MAX_AMOUNT) v = MAX_AMOUNT;
            amountInput.value = v;
            recalcTotals(true);
        });

        bindIngredientHandlers(document);
        recalcTotals(true);

        document.getElementById('formulation-form').addEventListener('submit', () => {
            prepareSubmitAsBase();
        });
    });
</script>
@endpush
