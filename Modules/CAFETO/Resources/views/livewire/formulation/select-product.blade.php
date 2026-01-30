<div>
    <div class="row g-3">
        <div class="col-md-4">
            <label class="form-label text-white">
                <span class="text-danger">*</span> Categoría
            </label>
            <select class="form-select bg-dark text-white border-secondary"
                    name="category_id" wire:model="category_id" required>
                <option value="">Selecciona</option>
                @foreach($categories as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
            <small class="text-light opacity-75 d-block mt-1">
                Por defecto queda la categoría #6.
            </small>
        </div>

        <div class="col-md-8">
            <label class="form-label text-white">
                <span class="text-danger">*</span> Producto final
            </label>

            <div class="d-flex gap-3 align-items-center mb-2">
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="optExisting"
                           wire:model="useNewProduct" value="0">
                    <label class="form-check-label text-white" for="optExisting">
                        Seleccionar existente
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" id="optNew"
                           wire:model="useNewProduct" value="1">
                    <label class="form-check-label text-white" for="optNew">
                        Crear producto nuevo (opcional)
                    </label>
                </div>
            </div>

            @if(!$useNewProduct)
                <select class="form-select bg-dark text-white border-secondary"
                        name="element_id" wire:model="element_id"
                        @if (empty($elements) || count($elements)==0) disabled @endif
                        required>
                    <option value="">Selecciona</option>
                    @if(!empty($elements))
                        @foreach($elements as $e)
                            <option value="{{ $e->id }}">{{ $e->name }}</option>
                        @endforeach
                    @endif
                </select>

                <input type="hidden" name="use_new_product" value="0">
                <input type="hidden" name="new_element_name" value="">
            @else
                <input type="text"
                       class="form-control bg-dark text-white border-secondary"
                       name="new_element_name"
                       wire:model.defer="new_element_name"
                       placeholder="Ej: Café americano"
                       required>

                <input type="hidden" name="use_new_product" value="1">
                <input type="hidden" name="element_id" value="">
            @endif
        </div>
    </div>
</div>
