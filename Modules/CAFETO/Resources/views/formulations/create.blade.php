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
    <li class="breadcrumb-item active text-white">{{ trans('cafeto::formulations.Breadcrumb_Active_Create_Formulations_1') }}</li>
@endpush

@section('content')
    <div class="container">
        <div class="card card-dark shadow-sm" data-aos="fade-up">
            <div class="card-body">
                <div class="progress mb-3 progress-custom">
                    <div class="progress-bar" role="progressbar" style="width: 0%;" id="form-progress">0%</div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dark" data-aos="fade-in">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-8">
                        @php
                            $user = Auth::user();
                            $roles = $user->roles->pluck('slug')->toArray();
                            $routePrefix = in_array('cafeto.admin', $roles) ? 'admin' : (in_array('cafeto.instructor', $roles) ? 'instructor' : 'cashier');
                            $person_id = $user->person ? $user->person->id : $user->id;
                            $person_name = $user->person ? $user->person->full_name : $user->name;
                        @endphp

                        <form action="{{ route('cafeto.' . $routePrefix . '.formulations.store') }}" method="POST" id="formulation-form">
                            @csrf
                            <div class="row mx-3 align-items-end" data-aos="fade-up" data-aos-delay="100">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="label-white">
                                            <strong class="text-danger">*</strong> {{ trans('cafeto::formulations.Title_Form_Owner') }}
                                            <i class="fas fa-info-circle text-light-gray" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('cafeto::formulations.Tooltip_Owner') }}"></i>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text input-group-dark">
                                                    <i class="fa-solid fa-user-tag text-light-gray"></i>
                                                </span>
                                            </div>
                                            <input type="hidden" name="person_id" value="{{ $person_id }}">
                                            <input type="text" class="form-control input-dark input-owner" value="{{ $person_name }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="label-white">
                                            {{ trans('cafeto::formulations.Element') }}
                                            <i class="fas fa-info-circle text-light-gray" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('cafeto::formulations.Tooltip_Element') }}"></i>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text input-group-dark">
                                                    <i class="fas fa-list text-light-gray"></i>
                                                </span>
                                            </div>
                                            <select name="element_id" class="form-select input-dark" onchange="updatePreview()">
                                                <option value="">{{ trans('cafeto::formulations.None') }}</option>
                                                @foreach ($elements as $element)
                                                    <option value="{{ $element->id }}" {{ old('element_id') == $element->id ? 'selected' : '' }}>{{ $element->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="label-white">
                                            <strong class="text-danger">*</strong> {{ trans('cafeto::formulations.Date') }}
                                            <i class="fas fa-info-circle text-light-gray" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('cafeto::formulations.Tooltip_Date') }}"></i>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text input-group-dark">
                                                    <i class="fa-solid fa-calendar-days text-light-gray"></i>
                                                </span>
                                            </div>
                                            <input type="date" name="date" value="{{ old('date', \Carbon\Carbon::now()->toDateString()) }}" class="form-control text-center input-dark" required onchange="updatePreview()">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="label-white">
                                            <strong class="text-danger">*</strong> {{ trans('cafeto::formulations.Amount') }}
                                            <i class="fas fa-info-circle text-light-gray" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('cafeto::formulations.Tooltip_Amount') }}"></i>
                                            <button type="button" class="btn btn-sm btn-outline-light ms-2" onclick="startVoiceInput('amount')" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('cafeto::formulations.Tooltip_Voice') }}">
                                                <i class="fas fa-microphone text-light-gray"></i>
                                            </button>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text input-group-dark">
                                                    <i class="far fa-keyboard text-light-gray"></i>
                                                </span>
                                            </div>
                                            <input type="number" id="amount" name="amount" value="{{ old('amount', 1) }}" class="form-control text-center input-dark" required min="0" oninput="validateAmount(this); updatePreview()">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Nuevos campos para el producto producido -->
                            <hr class="hr-dark">

                            <div class="col-md-12" data-aos="fade-up" data-aos-delay="150">
                                <div class="card card-dark-inner">
                                    <div class="collapsible-header" data-bs-toggle="collapse" data-bs-target="#produced-collapse">
                                        <h5 class="mb-0 text-white">{{ trans('cafeto::formulations.Produced Product Details') }} <i class="fas fa-chevron-down float-end text-light-gray"></i></h5>
                                    </div>
                                    <div id="produced-collapse" class="collapse show">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="label-white">
                                                            {{ trans('cafeto::formulations.Expiration Date') }}
                                                            <i class="fas fa-info-circle text-light-gray" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('cafeto::formulations.Tooltip_Expiration_Date') }}"></i>
                                                        </label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text input-group-dark">
                                                                    <i class="fa-solid fa-calendar-days text-light-gray"></i>
                                                                </span>
                                                            </div>
                                                            <input type="date" name="produced_expiration_date" value="{{ old('produced_expiration_date') }}" class="form-control text-center input-dark" onchange="updatePreview()">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="label-white">
                                                            <strong class="text-danger">*</strong> {{ trans('cafeto::formulations.Lot Number') }}
                                                            <i class="fas fa-info-circle text-light-gray" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('cafeto::formulations.Tooltip_Lot_Number') }}"></i>
                                                        </label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text input-group-dark">
                                                                    <i class="far fa-keyboard text-light-gray"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" name="produced_lot_number" value="{{ old('produced_lot_number') }}" class="form-control input-dark" required oninput="updatePreview()">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="label-white">
                                                            {{ trans('cafeto::formulations.Inventory Code') }}
                                                            <i class="fas fa-info-circle text-light-gray" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('cafeto::formulations.Tooltip_Inventory_Code') }}"></i>
                                                        </label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text input-group-dark">
                                                                    <i class="far fa-keyboard text-light-gray"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" name="produced_inventory_code" value="{{ old('produced_inventory_code') }}" class="form-control input-dark" oninput="updatePreview()">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="label-white">
                                                            {{ trans('cafeto::formulations.Mark') }}
                                                            <i class="fas fa-info-circle text-light-gray" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('cafeto::formulations.Tooltip_Mark') }}"></i>
                                                        </label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text input-group-dark">
                                                                    <i class="far fa-keyboard text-light-gray"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" name="produced_mark" value="{{ old('produced_mark') }}" class="form-control input-dark" oninput="updatePreview()">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="label-white">
                                                            <strong class="text-danger">*</strong> {{ trans('cafeto::formulations.Destination') }}
                                                            <i class="fas fa-info-circle text-light-gray" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('cafeto::formulations.Tooltip_Destination') }}"></i>
                                                        </label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text input-group-dark">
                                                                    <i class="fas fa-list text-light-gray"></i>
                                                                </span>
                                                            </div>
                                                            <select name="produced_destination" class="form-select input-dark" required onchange="updatePreview()">
                                                                <option value="">{{ trans('cafeto::formulations.Select Destination') }}</option>
                                                                @foreach ($destinations as $destination)
                                                                    <option value="{{ $destination }}" {{ old('produced_destination') == $destination ? 'selected' : '' }}>{{ trans('cafeto::formulations.' . $destination) }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="hr-dark">

                            <div class="col-md-12" data-aos="fade-up" data-aos-delay="200">
                                <div class="card card-dark-inner">
                                    <div class="collapsible-header" data-bs-toggle="collapse" data-bs-target="#ingredients-collapse">
                                        <h5 class="mb-0 text-white">{{ trans('cafeto::formulations.Ingredients') }} <i class="fas fa-chevron-down float-end text-light-gray"></i></h5>
                                    </div>
                                    <div id="ingredients-collapse" class="collapse show">
                                        <div class="card-body" id="ingredients">
                                            <div class="row ingredient-group mb-3" draggable="true">
                                                <div class="col-md-5">
                                                    <label class="mt-3 label-white">{{ trans('cafeto::formulations.Element') }}</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text input-group-dark">
                                                                <i class="fas fa-list text-light-gray"></i>
                                                            </span>
                                                        </div>
                                                        <select name="ingredients[0][element_id]" class="form-select input-dark" required onchange="updatePreview()">
                                                            <option value="">{{ trans('cafeto::formulations.None') }}</option>
                                                            @foreach ($elements as $element)
                                                                <option value="{{ $element->id }}" {{ old('ingredients.0.element_id') == $element->id ? 'selected' : '' }}>{{ $element->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="mt-3 label-white">{{ trans('cafeto::formulations.Amount') }}</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text input-group-dark">
                                                                <i class="far fa-keyboard text-light-gray"></i>
                                                            </span>
                                                        </div>
                                                        <input type="number" name="ingredients[0][amount]" value="{{ old('ingredients.0.amount') }}" class="form-control input-dark" required placeholder="{{ trans('cafeto::formulations.Amount') }}" min="0" oninput="validateAmount(this); updatePreview()">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="mt-3 label-white">{{ trans('cafeto::formulations.Unit') }}</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text input-group-dark">
                                                                <i class="fas fa-list text-light-gray"></i>
                                                            </span>
                                                        </div>
                                                        <select name="ingredients[0][unit]" class="form-select input-dark" required onchange="updatePreview()">
                                                            <option value="g" {{ old('ingredients.0.unit') === 'g' ? 'selected' : '' }}>{{ trans('cafeto::formulations.Grams') }}</option>
                                                            <option value="mg" {{ old('ingredients.0.unit') === 'mg' ? 'selected' : '' }}>{{ trans('cafeto::formulations.Milligrams') }}</option>
                                                            <option value="ml" {{ old('ingredients.0.unit') === 'ml' ? 'selected' : '' }}>{{ trans('cafeto::formulations.Milliliters') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label mt-3"> </label>
                                                    <button type="button" class="btn btn-outline-light btn-sm btn-delete d-block" disabled>{{ trans('cafeto::formulations.Delete_Ingredient') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12 text-center">
                                                <button type="button" onclick="addIngredient()" class="btn btn-dark btn-sm-lg btn-dark-custom">{{ trans('cafeto::formulations.Add Ingredient') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="sticky-footer mt-3" data-aos="fade-up" data-aos-delay="300">
                                <div class="row">
                                    <div class="col-auto mx-auto">
                                        <button type="submit" class="btn btn-dark form-control text-truncate btn-dark-custom" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('cafeto::formulations.Tooltip_Save') }}" onclick="checkProgress(event)">
                                            {{ trans('cafeto::formulations.Save') }} <i class="fas fa-plus text-light-gray"></i>
                                        </button>
                                        <a href="{{ route('cafeto.' . $routePrefix . '.formulations.index') }}" class="btn btn-dark form-control mt-2 btn-dark-custom" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('cafeto::formulations.Tooltip_Back') }}">
                                            {{ trans('cafeto::formulations.Back') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <div class="preview-card" data-aos="fade-left" data-aos-delay="400">
                            <h5 class="text-white">{{ trans('cafeto::formulations.Preview') }}</h5>
                            <p class="text-light-gray"><strong>{{ trans('cafeto::formulations.Element') }}:</strong> <span id="preview-element">{{ trans('cafeto::formulations.None') }}</span></p>
                            <p class="text-light-gray"><strong>{{ trans('cafeto::formulations.Amount') }}:</strong> <span id="preview-amount">0</span></p>
                            <p class="text-light-gray"><strong>{{ trans('cafeto::formulations.Date') }}:</strong> <span id="preview-date">{{ \Carbon\Carbon::now()->toDateString() }}</span></p>
                            <p class="text-light-gray"><strong>{{ trans('cafeto::formulations.Expiration Date') }}:</strong> <span id="preview-produced-expiration-date">N/A</span></p>
                            <p class="text-light-gray"><strong>{{ trans('cafeto::formulations.Lot Number') }}:</strong> <span id="preview-produced-lot-number">N/A</span></p>
                            <p class="text-light-gray"><strong>{{ trans('cafeto::formulations.Inventory Code') }}:</strong> <span id="preview-produced-inventory-code">N/A</span></p>
                            <p class="text-light-gray"><strong>{{ trans('cafeto::formulations.Mark') }}:</strong> <span id="preview-produced-mark">N/A</span></p>
                            <p class="text-light-gray"><strong>{{ trans('cafeto::formulations.Destination') }}:</strong> <span id="preview-produced-destination">N/A</span></p>
                            <h6 class="text-white">{{ trans('cafeto::formulations.Ingredients') }}</h6>
                            <ul id="preview-ingredients" class="text-light-gray">
                                <li>{{ trans('cafeto::formulations.None') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @livewireScripts()
    <script src="{{ asset('libs/AOS-2.3.1/dist/aos.js') }}"></script>
    <script>
        AOS.init();

        // Form Progress Indicator
        function updateProgress() {
            const form = document.getElementById('formulation-form');
            const requiredFields = form.querySelectorAll('[required]');
            let filledFields = 0;
            requiredFields.forEach(field => {
                if (field.value) filledFields++;
            });
            const progress = (filledFields / requiredFields.length) * 100;
            const progressBar = document.getElementById('form-progress');
            progressBar.style.width = `${progress}%`;
            progressBar.textContent = `${Math.round(progress)}%`;
            return progress;
        }

        // Check Progress on Submit
        function checkProgress(event) {
            updateProgress();
        }

        // Real-Time Amount Validation
        function validateAmount(input) {
            if (input.value < 0) {
                input.value = 0;
                const tooltip = bootstrap.Tooltip.getOrCreateInstance(input, {
                    title: '{{ trans('cafeto::formulations.validation.amount_negative') }}',
                    trigger: 'manual'
                });
                tooltip.show();
                setTimeout(() => tooltip.hide(), 2000);
            }
            updateProgress();
        }

        // Live Preview Update
        function updatePreview() {
            const elementSelect = document.querySelector('select[name="element_id"]');
            const amountInput = document.querySelector('input[name="amount"]');
            const dateInput = document.querySelector('input[name="date"]');
            const ingredients = document.querySelectorAll('.ingredient-group');
            document.getElementById('preview-element').textContent = elementSelect.options[elementSelect.selectedIndex]?.text || '{{ trans('cafeto::formulations.None') }}';
            document.getElementById('preview-amount').textContent = amountInput.value || '0';
            document.getElementById('preview-date').textContent = dateInput.value || '{{ \Carbon\Carbon::now()->toDateString() }}';
            document.getElementById('preview-produced-expiration-date').textContent = document.querySelector('input[name="produced_expiration_date"]')?.value || 'N/A';
            document.getElementById('preview-produced-lot-number').textContent = document.querySelector('input[name="produced_lot_number"]')?.value || 'N/A';
            document.getElementById('preview-produced-inventory-code').textContent = document.querySelector('input[name="produced_inventory_code"]')?.value || 'N/A';
            document.getElementById('preview-produced-mark').textContent = document.querySelector('input[name="produced_mark"]')?.value || 'N/A';
            const destinationSelect = document.querySelector('select[name="produced_destination"]');
            document.getElementById('preview-produced-destination').textContent = destinationSelect.options[destinationSelect.selectedIndex]?.text || 'N/A';
            const previewIngredients = document.getElementById('preview-ingredients');
            previewIngredients.innerHTML = '';
            if (ingredients.length === 0) {
                previewIngredients.innerHTML = '<li>{{ trans('cafeto::formulations.None') }}</li>';
            } else {
                ingredients.forEach((group, index) => {
                    const elementSelect = group.querySelector(`select[name="ingredients[${index}][element_id]"]`);
                    const elementName = elementSelect.options[elementSelect.selectedIndex]?.text || '{{ trans('cafeto::formulations.None') }}';
                    const amount = group.querySelector(`input[name="ingredients[${index}][amount]"]`)?.value || '0';
                    const unit = group.querySelector(`select[name="ingredients[${index}][unit]"]`)?.value || 'g';
                    previewIngredients.innerHTML += `<li>${elementName}: ${amount} ${unit}</li>`;
                });
            }
        }

        // Dynamic Ingredient Management
        let ingredientCount = 1;
        function addIngredient() {
            const container = document.getElementById('ingredients');
            const div = document.createElement('div');
            div.className = 'row ingredient-group mb-3';
            div.draggable = true;
            div.innerHTML = `
                <div class="col-md-5">
                    <label class="mt-3 label-white">{{ trans('cafeto::formulations.Element') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text input-group-dark">
                                <i class="fas fa-list text-light-gray"></i>
                            </span>
                        </div>
                        <select name="ingredients[${ingredientCount}][element_id]" class="form-select input-dark" required onchange="updatePreview()">
                            <option value="">{{ trans('cafeto::formulations.None') }}</option>
                            @foreach ($elements as $element)
                                <option value="{{ $element->id }}">{{ $element->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="mt-3 label-white">{{ trans('cafeto::formulations.Amount') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text input-group-dark">
                                <i class="far fa-keyboard text-light-gray"></i>
                            </span>
                        </div>
                        <input type="number" name="ingredients[${ingredientCount}][amount]" class="form-control input-dark" required placeholder="{{ trans('cafeto::formulations.Amount') }}" min="0" oninput="validateAmount(this); updatePreview()">
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="mt-3 label-white">{{ trans('cafeto::formulations.Unit') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text input-group-dark">
                                <i class="fas fa-list text-light-gray"></i>
                            </span>
                        </div>
                        <select name="ingredients[${ingredientCount}][unit]" class="form-select input-dark" required onchange="updatePreview()">
                            <option value="g">{{ trans('cafeto::formulations.Grams') }}</option>
                            <option value="mg">{{ trans('cafeto::formulations.Milligrams') }}</option>
                            <option value="ml">{{ trans('cafeto::formulations.Milliliters') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="form-label mt-3"> </label>
                    <button type="button" class="btn btn-outline-light btn-sm btn-delete d-block">{{ trans('cafeto::formulations.Delete_Ingredient') }}</button>
                </div>
            `;
            container.appendChild(div);
            ingredientCount++;
            attachDeleteListeners();
            attachDragListeners();
            updateProgress();
            updatePreview();
        }

        // Delete Ingredient
        function attachDeleteListeners() {
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.disabled = document.querySelectorAll('.ingredient-group').length <= 1;
                button.addEventListener('click', function() {
                    if (document.querySelectorAll('.ingredient-group').length > 1) {
                        this.closest('.ingredient-group').remove();
                        attachDeleteListeners();
                        updateProgress();
                        updatePreview();
                    }
                });
            });
        }

        // Drag-and-Drop
        function attachDragListeners() {
            const ingredients = document.querySelectorAll('.ingredient-group');
            ingredients.forEach(ingredient => {
                ingredient.addEventListener('dragstart', () => {
                    ingredient.classList.add('dragging');
                });
                ingredient.addEventListener('dragend', () => {
                    ingredient.classList.remove('dragging');
                });
            });
            document.getElementById('ingredients').addEventListener('dragover', e => {
                e.preventDefault();
                const afterElement = getDragAfterElement(e.clientY);
                const dragging = document.querySelector('.dragging');
                if (afterElement == null) {
                    document.getElementById('ingredients').appendChild(dragging);
                } else {
                    document.getElementById('ingredients').insertBefore(dragging, afterElement);
                }
                updatePreview();
            });
        }

        function getDragAfterElement(y) {
            const draggableElements = [...document.querySelectorAll('.ingredient-group:not(.dragging)')];
            return draggableElements.reduce((closest, child) => {
                const box = child.getBoundingClientRect();
                const offset = y - box.top - box.height / 2;
                if (offset < 0 && offset > closest.offset) {
                    return { offset: offset, element: child };
                } else {
                    return closest;
                }
            }, { offset: Number.NEGATIVE_INFINITY }).element;
        }

        // Voice Input
        function startVoiceInput(fieldId) {
            if (!window.SpeechRecognition && !window.webkitSpeechRecognition) {
                alert('{{ trans('cafeto::formulations.Voice_Not_Supported') }}');
                return;
            }
            const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
            recognition.lang = 'es-ES';
            recognition.onresult = function(event) {
                const value = parseFloat(event.results[0][0].transcript.replace(',', '.'));
                if (!isNaN(value)) {
                    document.getElementById(fieldId).value = value;
                    validateAmount(document.getElementById(fieldId));
                    updatePreview();
                }
            };
            recognition.start();
        }

        document.addEventListener('DOMContentLoaded', () => {
            attachDeleteListeners();
            attachDragListeners();
            updateProgress();
            updatePreview();
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            tooltipTriggerList.forEach(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
        });
    </script>
@endpush