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
    <li class="breadcrumb-item active text-light-gray">
        {{ trans('cafeto::formulations.Create') }}
    </li>
@endpush

@section('content')
@php
    $routePrefix = getRoleRouteName(Route::currentRouteName());
    $MAX_AMOUNT = $max_amount ?? 100000;
@endphp

<div class="container mt-4">
    <div class="card border-0 shadow-sm bg-dark text-white">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">{{ trans('cafeto::formulations.Create') }}</h4>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>{{ trans('cafeto::formulations.Review the following fields') }}</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="formulation-form" action="{{ route('cafeto.' . $routePrefix . '.formulations.store') }}" method="POST" novalidate>
                @csrf

                <div class="row g-3 mb-3">
                    <div class="col-md-12">
                        @livewire('cafeto::formulation.select-product', ['formulation' => null])
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label text-white">
                            <span class="text-danger">*</span> {{ trans('cafeto::formulations.Amount') }}
                        </label>

                        <div id="amount-alert" class="alert alert-warning py-2 px-3 mb-2 d-none" role="alert"></div>

                        <input type="number" id="amount" name="amount"
                               value="{{ old('amount', 1) }}"
                               class="form-control bg-dark text-white border-secondary @error('amount') is-invalid @enderror"
                               required min="1" max="{{ $MAX_AMOUNT }}" step="1" inputmode="numeric">
                        @error('amount')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label text-white">
                            <span class="text-danger">*</span> {{ trans('cafeto::formulations.Date') }}
                        </label>
                        <input type="date"
                               class="form-control bg-dark text-white border-secondary"
                               value="{{ $today }}" readonly>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-12">
                        <label class="form-label text-white">{{ trans('cafeto::formulations.Process') }}</label>
                        <textarea name="process"
                                  class="form-control bg-dark text-white border-secondary @error('process') is-invalid @enderror"
                                  rows="4"
                                  placeholder="{{ trans('cafeto::formulations.Describe the process') }}">{{ old('process') }}</textarea>
                        @error('process')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="bg-secondary my-4">
                <h5 class="text-white mb-3">{{ trans('cafeto::formulations.Produced Product Details') }}</h5>

                <div class="row g-3 mb-2">
                    <div class="col-md-6">
                        <label class="form-label text-white">{{ trans('cafeto::formulations.Expiration Date') }}</label>
                        <input type="date" name="produced_expiration_date"
                               value="{{ old('produced_expiration_date') }}"
                               min="{{ $today }}"
                               class="form-control bg-dark text-white border-secondary @error('produced_expiration_date') is-invalid @enderror">
                        @error('produced_expiration_date')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-white">
                            <span class="text-danger">*</span> {{ trans('cafeto::formulations.Lot Number') }}
                        </label>
                        <input type="text" name="produced_lot_number"
                               value="{{ old('produced_lot_number') }}"
                               class="form-control bg-dark text-white border-secondary @error('produced_lot_number') is-invalid @enderror"
                               required>
                        @error('produced_lot_number')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-white">
                            <span class="text-danger">*</span> {{ trans('cafeto::formulations.Sale Price') }}
                        </label>
                        <input type="number"
                               name="sale_price"
                               value="{{ old('sale_price') }}"
                               class="form-control bg-dark text-white border-secondary @error('sale_price') is-invalid @enderror"
                               min="0" step="0.01" inputmode="decimal"
                               placeholder="{{ trans('cafeto::formulations.Sale Price Placeholder') }}">
                        @error('sale_price')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="text-muted d-block mt-1">
                            {{ trans('cafeto::formulations.Sale Price Help') }}
                        </small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-white">{{ trans('cafeto::formulations.Inventory Code') }}</label>

                        <div id="inventory-code-alert" class="alert alert-warning py-2 px-3 mb-2 d-none" role="alert"></div>

                        <input type="text"
                               id="produced_inventory_code"
                               name="produced_inventory_code"
                               value="{{ old('produced_inventory_code') }}"
                               class="form-control bg-dark text-white border-secondary @error('produced_inventory_code') is-invalid @enderror"
                               inputmode="numeric"
                               autocomplete="off"
                               placeholder="{{ trans('cafeto::formulations.Inventory Code Placeholder') }}">
                        @error('produced_inventory_code')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="text-muted d-block mt-1">
                            {{ trans('cafeto::formulations.Inventory Code Help') }}
                        </small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-white">{{ trans('cafeto::formulations.Mark') }}</label>
                        <input type="text" name="produced_mark"
                               value="{{ old('produced_mark') }}"
                               class="form-control bg-dark text-white border-secondary @error('produced_mark') is-invalid @enderror">
                        @error('produced_mark')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-white">
                            <span class="text-danger">*</span> {{ trans('cafeto::formulations.Destination') }}
                        </label>
                        <select name="produced_destination"
                                class="form-select bg-dark text-white border-secondary @error('produced_destination') is-invalid @enderror"
                                required>
                            <option value="">{{ trans('cafeto::formulations.Select Destination') }}</option>
                            @foreach ($destinations as $destination)
                                <option value="{{ $destination }}" {{ old('produced_destination') === $destination ? 'selected' : '' }}>
                                    {{ trans('cafeto::formulations.' . $destination) }}
                                </option>
                            @endforeach
                        </select>
                        @error('produced_destination')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="bg-secondary my-4">
                <h5 class="text-white mb-3">{{ trans('cafeto::formulations.Ingredients') }}</h5>

                <div id="ingredients-alert" class="alert alert-info py-2 px-3 mb-3 d-none" role="alert"></div>

                @php $oldIngredients = old('ingredients', []); @endphp
                <div id="ingredients-container">
                    @if(count($oldIngredients) > 0)
                        @foreach($oldIngredients as $i => $ing)
                            @php $u = $ing['unit'] ?? 'g'; @endphp
                            <div class="ingredient-row row g-3 mb-3 align-items-end">
                                <div class="col-md-5">
                                    <label class="form-label text-white">{{ trans('cafeto::formulations.Element') }}</label>
                                    <select name="ingredients[{{ $i }}][element_id]"
                                            class="form-select bg-dark text-white border-secondary @error("ingredients.$i.element_id") is-invalid @enderror"
                                            required>
                                        <option value="">{{ trans('cafeto::formulations.None') }}</option>
                                        @foreach ($elements as $element)
                                            <option value="{{ $element->id }}" {{ (int)($ing['element_id'] ?? 0) === (int)$element->id ? 'selected' : '' }}>
                                                {{ $element->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error("ingredients.$i.element_id")
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label text-white">{{ trans('cafeto::formulations.Amount') }}</label>
                                    <input type="number"
                                           name="ingredients[{{ $i }}][amount]"
                                           value="{{ $ing['amount'] ?? '' }}"
                                           class="form-control bg-dark text-white border-secondary ingredient-amount @error("ingredients.$i.amount") is-invalid @enderror"
                                           data-base="{{ $ing['amount'] ?? '' }}"
                                           required min="0.000001" step="any" inputmode="decimal">
                                    @error("ingredients.$i.amount")
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label text-white">{{ trans('cafeto::formulations.Unit') }}</label>
                                    <select name="ingredients[{{ $i }}][unit]"
                                            class="form-select bg-dark text-white border-secondary ingredient-unit @error("ingredients.$i.unit") is-invalid @enderror"
                                            required>
                                        <option value="g"  {{ $u === 'g' ? 'selected' : '' }}>g</option>
                                        <option value="mg" {{ $u === 'mg' ? 'selected' : '' }}>mg</option>
                                        <option value="ml" {{ $u === 'ml' ? 'selected' : '' }}>ml</option>
                                    </select>
                                    @error("ingredients.$i.unit")
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <button type="button"
                                            class="btn btn-outline-danger btn-sm mt-4 btn-remove-ingredient"
                                            onclick="removeIngredient(this)">
                                        {{ trans('cafeto::formulations.Delete') }}
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="ingredient-row row g-3 mb-3 align-items-end">
                            <div class="col-md-5">
                                <label class="form-label text-white">{{ trans('cafeto::formulations.Element') }}</label>
                                <select name="ingredients[0][element_id]"
                                        class="form-select bg-dark text-white border-secondary @error('ingredients.0.element_id') is-invalid @enderror"
                                        required>
                                    <option value="">{{ trans('cafeto::formulations.None') }}</option>
                                    @foreach ($elements as $element)
                                        <option value="{{ $element->id }}">{{ $element->name }}</option>
                                    @endforeach
                                </select>
                                @error('ingredients.0.element_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label class="form-label text-white">{{ trans('cafeto::formulations.Amount') }}</label>
                                <input type="number"
                                       name="ingredients[0][amount]"
                                       class="form-control bg-dark text-white border-secondary ingredient-amount @error('ingredients.0.amount') is-invalid @enderror"
                                       data-base=""
                                       required min="0.000001" step="any" inputmode="decimal">
                                @error('ingredients.0.amount')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <label class="form-label text-white">{{ trans('cafeto::formulations.Unit') }}</label>
                                <select name="ingredients[0][unit]"
                                        class="form-select bg-dark text-white border-secondary ingredient-unit @error('ingredients.0.unit') is-invalid @enderror"
                                        required>
                                    <option value="g">g</option>
                                    <option value="mg">mg</option>
                                    <option value="ml">ml</option>
                                </select>
                                @error('ingredients.0.unit')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <button type="button"
                                        class="btn btn-outline-danger btn-sm mt-4 btn-remove-ingredient"
                                        disabled>
                                    {{ trans('cafeto::formulations.Delete') }}
                                </button>
                            </div>
                        </div>
                    @endif
                </div>

                <button type="button" class="btn btn-outline-light mb-4" onclick="addIngredient()">
                    + {{ trans('cafeto::formulations.Add Ingredient') }}
                </button>

                <div class="d-flex gap-3 justify-content-end mt-4">
                    <a href="{{ route('cafeto.' . $routePrefix . '.formulations.index') }}" class="btn btn-secondary">
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
@livewireScripts()
<script>
    const MAX_AMOUNT = {{ $MAX_AMOUNT }};
    let ingredientIndex = {{ count(old('ingredients', [])) > 0 ? count(old('ingredients', [])) : 1 }};
    const elements = @json($elements->map(fn($e)=>['id'=>$e->id,'name'=>$e->name])->values());

    function elementOptionsHtml(selectedId = '') {
        let html = `<option value="">{{ trans('cafeto::formulations.None') }}</option>`;
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
                <button type="button" class="btn btn-outline-danger btn-sm mt-4 btn-remove-ingredient" onclick="removeIngredient(this)">
                    {{ trans('cafeto::formulations.Delete') }}
                </button>
            </div>
        `;

        container.appendChild(row);
        ingredientIndex++;
        refreshRemoveButtons();
        bindIngredientHandlers(container.lastElementChild);
        recalcTotals(true);
        showIngredientsInfo(`{{ trans('cafeto::formulations.Ingredient added message') }}`);
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
        document.querySelectorAll('.ingredient-row .btn-remove-ingredient').forEach((btn, idx) => {
            btn.disabled = disable && idx === 0;
        });
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

                showIngredientsInfo(`{{ trans('cafeto::formulations.Ingredients auto-updated message') }}`);
            });

            inp.addEventListener('blur', () => {
                recalcTotals(true);
            });
        });
    }

    function recalcTotals(updateInputs = false) {
        const m = getAmountMultiplier();
        if (m === 1) showAmountWarning('');
        else showAmountWarning(`{{ trans('cafeto::formulations.Amount affects ingredients message') }}`.replace(':amount', String(m)));

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

    // Regla de UI: el código de inventario solo permite números (front).
    function showInventoryCodeWarning(msg) {
        const box = document.getElementById('inventory-code-alert');
        if (!msg) { box.classList.add('d-none'); box.textContent=''; return; }
        box.classList.remove('d-none');
        box.textContent = msg;
    }

    function sanitizeDigitsOnly(value) {
        return String(value ?? '').replace(/\D+/g, '');
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

        const invCode = document.getElementById('produced_inventory_code');
        if (invCode) {
            invCode.addEventListener('input', () => {
                const before = invCode.value;
                const cleaned = sanitizeDigitsOnly(before);

                if (before !== cleaned) {
                    invCode.value = cleaned;
                    showInventoryCodeWarning(`{{ trans('cafeto::formulations.Inventory code numbers only') }}`);
                } else {
                    showInventoryCodeWarning('');
                }
            });

            invCode.addEventListener('paste', (e) => {
                e.preventDefault();
                const text = (e.clipboardData || window.clipboardData).getData('text');
                const cleaned = sanitizeDigitsOnly(text);
                document.execCommand('insertText', false, cleaned);
                if (cleaned !== text) showInventoryCodeWarning(`{{ trans('cafeto::formulations.Inventory code paste cleaned') }}`);
            });
        }

        bindIngredientHandlers(document);
        recalcTotals(true);

        document.getElementById('formulation-form').addEventListener('submit', () => {
            prepareSubmitAsBase();
            if (invCode) invCode.value = sanitizeDigitsOnly(invCode.value);
        });
    });
</script>
@endpush
