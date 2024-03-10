<div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>
                    <strong class="text-danger">*</strong> {{ trans('cafeto::recipes.Title_Form_Category') }}
                </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-list"></i>
                        </span>
                    </div>
                    <select class="form-select" name="category_id" wire:model="category_id" required>
                        <option value="">{{ trans('cafeto::recipes.Select') }}</option>
                        @foreach ($categories as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <label>
                    <strong class="text-danger">*</strong> {{ trans('cafeto::recipes.Title_Form_Product') }}
                </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-list"></i>
                        </span>
                    </div>
                    <select class="form-select" name="element_id" wire:model="element_id"
                        @if (empty($elements)) disabled @endif required>
                        <option value="">{{ trans('cafeto::recipes.Select') }}</option>
                        @if (!empty($elements))
                            @foreach ($elements as $e)
                                <option value="{{ $e->id }}">{{ $e->product_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
