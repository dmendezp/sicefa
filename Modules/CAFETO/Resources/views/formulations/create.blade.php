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
                                                        <input type="text" class="form-control typeahead input-dark" name="ingredients[0][element_name]" placeholder="{{ trans('cafeto::formulations.Search_Element') }}" required oninput="updatePreview()">
                                                        <input type="hidden" name="ingredients[0][element_id]">
                                                        <div class="typeahead-list" style="display: none;"></div>
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
            const previewIngredients = document.getElementById('preview-ingredients');
            previewIngredients.innerHTML = '';
            if (ingredients.length === 0) {
                previewIngredients.innerHTML = '<li>{{ trans('cafeto::formulations.None') }}</li>';
            } else {
                ingredients.forEach((group, index) => {
                    const elementName = group.querySelector(`input[name="ingredients[${index}][element_name]"]`)?.value || '{{ trans('cafeto::formulations.None') }}';
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
                        <input type="text" class="form-control typeahead input-dark" name="ingredients[${ingredientCount}][element_name]" placeholder="{{ trans('cafeto::formulations.Search_Element') }}" required oninput="updatePreview()">
                        <input type="hidden" name="ingredients[${ingredientCount}][element_id]">
                        <div class="typeahead-list" style="display: none;"></div>
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
            attachTypeahead(div.querySelector('.typeahead'));
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

        // Typeahead for Ingredients
        function attachTypeahead(input) {
            const elements = @json($elements->pluck('name', 'id')->toArray());
            input.addEventListener('input', function() {
                const query = this.value.toLowerCase();
                const list = this.nextElementSibling.nextElementSibling;
                list.innerHTML = '';
                if (query) {
                    const matches = Object.keys(elements).filter(id => {
                        const isSelected = Array.from(document.querySelectorAll('input[name*="[element_id]"]'))
                            .some(el => el.value === id && el !== this.nextElementSibling);
                        return elements[id].toLowerCase().includes(query) && !isSelected;
                    });
                    if (matches.length) {
                        matches.forEach(id => {
                            const item = document.createElement('div');
                            item.className = 'typeahead-item';
                            item.textContent = elements[id];
                            item.addEventListener('click', () => {
                                input.value = elements[id];
                                input.nextElementSibling.value = id;
                                list.style.display = 'none';
                                updatePreview();
                            });
                            list.appendChild(item);
                        });
                        list.style.display = 'block';
                    } else {
                        list.style.display = 'none';
                    }
                } else {
                    list.style.display = 'none';
                }
            });
            input.addEventListener('blur', () => {
                setTimeout(() => input.nextElementSibling.nextElementSibling.style.display = 'none', 200);
            });
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
            document.querySelectorAll('.typeahead').forEach(attachTypeahead);
            updateProgress();
            updatePreview();
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            tooltipTriggerList.forEach(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
        });
    </script>
@endpush