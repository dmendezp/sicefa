{{-- resources/views/formulations/edit.blade.php --}}
@extends('cafeto::layouts.master')

@push('head')
    <link rel="stylesheet" href="{{ asset('modules/cafeto/css/formulations/create.css') }}">
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
    <div class="container mt-4">
        <div class="card border-0 shadow-sm bg-dark text-white">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">
                    @if(isset($is_approval_mode) && $is_approval_mode)
                        {{ trans('cafeto::formulations.Approve') }} #{{ $formulation->id }}
                    @else
                        {{ trans('cafeto::formulations.Edit') }}
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

                @php
                    $routePrefix = getRoleRouteName(Route::currentRouteName());
                    $elementsForJs = $elements->map(fn($e) => ['id' => $e->id, 'name' => $e->name])->values();
                @endphp

                <form action="{{
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

                    <!-- Datos principales -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-white">{{ trans('cafeto::formulations.Element') }}</label>
                            <select name="element_id" class="form-select bg-dark text-white border-secondary" required>
                                <option value="">{{ trans('cafeto::formulations.None') }}</option>
                                @foreach ($elements as $element)
                                    <option value="{{ $element->id }}" {{ old('element_id', $formulation->element_id) == $element->id ? 'selected' : '' }}>
                                        {{ $element->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label text-white">
                                <span class="text-danger">*</span> {{ trans('cafeto::formulations.Amount') }}
                            </label>
                            <input type="number" name="amount" value="{{ old('amount', $formulation->amount) }}"
                                   class="form-control bg-dark text-white border-secondary" required min="0.001" step="0.01">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label text-white">
                                <span class="text-danger">*</span> {{ trans('cafeto::formulations.Date') }}
                            </label>
                            <input type="date" name="date" value="{{ old('date', $formulation->date) }}"
                                   class="form-control bg-dark text-white border-secondary" required>
                        </div>
                    </div>

                    <!-- Sección producto producido (solo aprobación) -->
                    @if(isset($is_approval_mode) && $is_approval_mode)
                        <hr class="bg-secondary my-4">
                        <h5 class="text-white mb-3">{{ trans('cafeto::formulations.Produced Product Details') }}</h5>

                        <div class="row g-3 mb-2">
                            <div class="col-md-6">
                                <label class="form-label text-white">{{ trans('cafeto::formulations.Expiration Date') }}</label>
                                <input type="date" name="produced_expiration_date"
                                       value="{{ old('produced_expiration_date') }}"
                                       class="form-control bg-dark text-white border-secondary">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-white">
                                    <span class="text-danger">*</span> {{ trans('cafeto::formulations.Lot Number') }}
                                </label>
                                <input type="text" name="produced_lot_number"
                                       value="{{ old('produced_lot_number') }}"
                                       class="form-control bg-dark text-white border-secondary" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-white">{{ trans('cafeto::formulations.Inventory Code') }}</label>
                                <input type="text" name="produced_inventory_code"
                                       value="{{ old('produced_inventory_code') }}"
                                       class="form-control bg-dark text-white border-secondary">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-white">{{ trans('cafeto::formulations.Mark') }}</label>
                                <input type="text" name="produced_mark"
                                       value="{{ old('produced_mark') }}"
                                       class="form-control bg-dark text-white border-secondary">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label text-white">
                                    <span class="text-danger">*</span> {{ trans('cafeto::formulations.Destination') }}
                                </label>
                                <select name="produced_destination" class="form-select bg-dark text-white border-secondary" required>
                                    @php $dest = old('produced_destination'); @endphp
                                    <option value="">{{ trans('cafeto::formulations.Select Destination') }}</option>
                                    @foreach ($destinations as $destination)
                                        <option value="{{ $destination }}" {{ $dest === $destination ? 'selected' : '' }}>
                                            {{ trans('cafeto::formulations.' . $destination) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    <!-- Ingredientes -->
                    <hr class="bg-secondary my-4">
                    <h5 class="text-white mb-3">{{ trans('cafeto::formulations.Ingredients') }}</h5>

                    <div id="ingredients-container">
                        @php
                            $oldIngredients = old('ingredients');
                            $rows = is_array($oldIngredients)
                                ? $oldIngredients
                                : $formulation->ingredients->map(fn($ing) => [
                                    'element_id' => $ing->element_id,
                                    'amount' => $ing->amount,
                                    'unit' => 'g', // no lo guardas en BD aún
                                ])->toArray();
                        @endphp

                        @foreach ($rows as $index => $ingredient)
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
                                    <input type="number" name="ingredients[{{ $index }}][amount]"
                                           value="{{ $ingredient['amount'] ?? '' }}"
                                           class="form-control bg-dark text-white border-secondary" required min="0.001" step="0.01">
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label text-white">{{ trans('cafeto::formulations.Unit') }}</label>
                                    @php $u = $ingredient['unit'] ?? 'g'; @endphp
                                    <select name="ingredients[{{ $index }}][unit]" class="form-select bg-dark text-white border-secondary" required>
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

                    <!-- Botones finales -->
                    <div class="d-flex gap-3 justify-content-end mt-4">
                        <a href="{{ route("cafeto.{$routePrefix}.formulations.index") }}"
                           class="btn btn-secondary">
                            {{ trans('cafeto::formulations.Back') }}
                        </a>

                        @if(isset($is_approval_mode) && $is_approval_mode)
                            <button type="submit" class="btn btn-success">
                                {{ trans('cafeto::formulations.Approve') }}
                            </button>
                        @else
                            <button type="submit" class="btn btn-primary">
                                {{ trans('cafeto::formulations.Update') }}
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const elements = @json($elementsForJs);
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
                    <input type="number" name="ingredients[${ingredientIndex}][amount]"
                           class="form-control bg-dark text-white border-secondary" required min="0.001" step="0.01">
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
                    <button type="button" class="btn btn-outline-danger btn-sm mt-4 btn-remove-ingredient"
                            onclick="removeIngredient(this)">
                        {{ trans('cafeto::formulations.Delete') }}
                    </button>
                </div>
            `;
            container.appendChild(row);
            ingredientIndex++;
            refreshRemoveButtons();
        }

        function removeIngredient(button) {
            const rows = document.querySelectorAll('.ingredient-row');
            if (rows.length > 1) {
                button.closest('.ingredient-row').remove();
                refreshRemoveButtons();
            }
        }

        function refreshRemoveButtons() {
            const rows = document.querySelectorAll('.ingredient-row');
            const disable = rows.length <= 1;
            document.querySelectorAll('.btn-remove-ingredient').forEach(btn => btn.disabled = disable);
        }
    </script>
@endpush
