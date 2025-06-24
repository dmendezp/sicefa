@extends('cafeto::layouts.master')

@section('content')
    <section class="formulations-container">
        <div class="container">
            <h2 class="heading--title text-center" style="color: #4a3721;">{{ __('cafeto::formulations.Edit') }}: {{ $formulation->element ? $formulation->element->name : __('cafeto::formulations.None') }}</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('cafeto.' . (Auth::user()->roles->pluck('slug')->contains('cafeto.admin') ? 'admin' : 'instructor') . '.formulations.update', $formulation) }}" method="POST" class="formulation-form">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>{{ __('cafeto::formulations.Element') }}:</label>
                    <select name="element_id" class="form-control">
                        <option value="">{{ __('cafeto::formulations.None') }}</option>
                        @foreach ($elements as $element)
                            <option value="{{ $element->id }}" {{ old('element_id', $formulation->element_id) == $element->id ? 'selected' : '' }}>{{ $element->name }}</option>
                        @endforeach
                    </select>
                    @error('element_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('cafeto::formulations.Amount') }}:</label>
                    <input type="number" name="amount" value="{{ old('amount', $formulation->amount) }}" class="form-control" required min="0" step="0.01">
                    @error('amount')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>{{ __('cafeto::formulations.Date') }}:</label>
                    <input type="date" name="date" value="{{ old('date', $formulation->date) }}" class="form-control" required>
                    @error('date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <h3>{{ __('cafeto::formulations.Ingredients') }}</h3>
                    <div id="ingredients">
                        @foreach ($formulation->ingredients as $index => $ingredient)
                            <div class="ingredient-group mb-3">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label>{{ __('cafeto::formulations.Element') }}</label>
                                        <select name="ingredients[{{ $index }}][element_id]" class="form-control" required>
                                            @foreach ($elements as $element)
                                                <option value="{{ $element->id }}" {{ old("ingredients.$index.element_id", $ingredient->element_id) == $element->id ? 'selected' : '' }}>{{ $element->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>{{ __('cafeto::formulations.Amount') }}</label>
                                        <input type="number" name="ingredients[{{ $index }}][amount]" value="{{ old("ingredients.$index.amount", $ingredient->amount) }}" class="form-control" required placeholder="{{ __('cafeto::formulations.Amount') }}" min="0" step="0.01">
                                    </div>
                                    <div class="col-md-2">
                                        <label>{{ __('cafeto::formulations.Unit') }}</label>
                                        <select name="ingredients[{{ $index }}][unit]" class="form-control" required>
                                            <option value="g" {{ old("ingredients.$index.unit", 'g') == 'g' ? 'selected' : '' }}>{{ __('cafeto::formulations.Grams') }}</option>
                                            <option value="mg" {{ old("ingredients.$index.unit") == 'mg' ? 'selected' : '' }}>{{ __('cafeto::formulations.Milligrams') }}</option>
                                            <option value="ml" {{ old("ingredients.$index.unit") == 'ml' ? 'selected' : '' }}>{{ __('cafeto::formulations.Milliliters') }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label> </label>
                                        <button type="button" class="btn btn-outline-danger btn-sm btn-delete" {{ $loop->first && count($formulation->ingredients) == 1 ? 'disabled' : '' }} onclick="deleteIngredient(this)">{{ __('cafeto::formulations.Delete_Ingredient') }}</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addIngredient()" class="btn btn-dark btn-sm-lg btn-dark-custom">{{ __('cafeto::formulations.Add Ingredient') }}</button>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-dark btn-sm-lg btn-dark-custom">{{ __('cafeto::formulations.Update') }}</button>
                    <a href="{{ route('cafeto.' . (Auth::user()->roles->pluck('slug')->contains('cafeto.admin') ? 'admin' : 'instructor') . '.formulations.index') }}" class="btn btn-dark btn-sm-lg btn-dark-custom">{{ __('cafeto::formulations.Back') }}</a>
                </div>
            </form>
        </div>
    </section>

    <script>
        let ingredientCount = {{ count($formulation->ingredients) }};

        function addIngredient() {
            const container = document.getElementById('ingredients');
            const div = document.createElement('div');
            div.className = 'ingredient-group mb-3';
            div.innerHTML = `
                <div class="row">
                    <div class="col-md-5">
                        <label>{{ __('cafeto::formulations.Element') }}</label>
                        <select name="ingredients[${ingredientCount}][element_id]" class="form-control" required>
                            @foreach ($elements as $element)
                                <option value="{{ $element->id }}">{{ $element->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>{{ __('cafeto::formulations.Amount') }}</label>
                        <input type="number" name="ingredients[${ingredientCount}][amount]" class="form-control" required placeholder="{{ __('cafeto::formulations.Amount') }}" min="0" step="0.01">
                    </div>
                    <div class="col-md-2">
                        <label>{{ __('cafeto::formulations.Unit') }}</label>
                        <select name="ingredients[${ingredientCount}][unit]" class="form-control" required>
                            <option value="g">{{ __('cafeto::formulations.Grams') }}</option>
                            <option value="mg">{{ __('cafeto::formulations.Milligrams') }}</option>
                            <option value="ml">{{ __('cafeto::formulations.Milliliters') }}</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label> </label>
                        <button type="button" class="btn btn-outline-danger btn-sm btn-delete" onclick="deleteIngredient(this)">{{ __('cafeto::formulations.Delete_Ingredient') }}</button>
                    </div>
                </div>
            `;
            container.appendChild(div);
            ingredientCount++;
            attachDeleteListeners();
        }

        function deleteIngredient(button) {
            const ingredientGroups = document.querySelectorAll('.ingredient-group');
            if (ingredientGroups.length > 1) {
                button.closest('.ingredient-group').remove();
                attachDeleteListeners();
            }
        }

        function attachDeleteListeners() {
            const ingredientGroups = document.querySelectorAll('.ingredient-group');
            document.querySelectorAll('.btn-delete').forEach(button => {
                button.disabled = ingredientGroups.length <= 1;
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            attachDeleteListeners();
        });
    </script>
@endsection