<div>
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="col-form-label col-form-label-sm">{{ trans('ptventa::inventory.SubTitleCard6') }}</label>
                    {!! Form::text(null, $puw->warehouse->name, [
                        'class' => 'form-control form-control-sm',
                        'disabled',
                    ]) !!}
                </div>
                <div class="col-md-6">
                    <label for="encargado" class="col-form-label col-form-label-sm">{{ trans('ptventa::inventory.SubTitleCard7') }}</label>
                    {!! Form::text(null, Auth::user()->person->full_name, [
                        'class' => 'form-control form-control-sm',
                        'disabled',
                    ]) !!}
                </div>
            </div>
                        

            <form method="POST">
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label my-0"><strong class="text-danger">*
                                </strong>{{ trans('ptventa::inventory.TitleForm1') }}</label>
                            <select class="form-select form-control-sm" name="inventory_id" id="inventory_id"
                                wire:model="inventory_id" required>
                                <option value="">-- Selecciona --</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ priceFormat($product->price) }}">
                                        {{ $product->element->product_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label my-0">{{ trans('ptventa::inventory.TitleForm6') }}</label>
                            {!! Form::text('lot_number', isset($inventory) ? $inventory->lot_number : '', [
                                'class' => 'form-control form-control-sm text-center',
                                'readonly',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label my-0">{{ trans('ptventa::inventory.TitleForm7') }}</label>
                            {!! Form::text('lot_number', isset($inventory) ? $inventory->inventory_code : '', [
                                'class' => 'form-control form-control-sm text-center',
                                'readonly',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label my-0">{{ trans('ptventa::inventory.TitleForm4') }}</label>
                            {!! Form::text('lot_number', isset($inventory) ? $inventory->production_date : '', [
                                'class' => 'form-control form-control-sm text-center',
                                'readonly',
                            ]) !!}
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label my-0">{{ trans('ptventa::inventory.TitleForm5') }}</label>
                            {!! Form::text('lot_number', isset($inventory) ? $inventory->expiration_date : '', [
                                'class' => 'form-control form-control-sm text-center',
                                'readonly',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label my-0">{{ trans('ptventa::inventory.TitleForm9') }}</label>
                            {!! Form::text('lot_number', isset($inventory) ? $inventory->mark : '', [
                                'class' => 'form-control form-control-sm text-center',
                                'readonly',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label my-0">{{ trans('ptventa::inventory.TitleForm10') }}</label>
                            {!! Form::text('lot_number', isset($inventory) ? $inventory->destination : '', [
                                'class' => 'form-control form-control-sm text-center',
                                'readonly',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label my-0">{{ trans('ptventa::inventory.TitleForm2') }}</label>
                            {!! Form::text('lot_number', isset($inventory) ? $inventory->price : '', [
                                'class' => 'form-control form-control-sm text-center',
                                'readonly',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label my-0">{{ trans('ptventa::inventory.TitleForm11') }}</label>
                            {!! Form::text('lot_number', isset($inventory) ? $inventory->amount : '', [
                                'class' => 'form-control form-control-sm text-center',
                                'readonly',
                            ]) !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label my-0"><strong class="text-danger">* </strong>{{ trans('ptventa::inventory.TitleForm3') }}</label>
                            <input type="text" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-sm form-control">{{ trans('ptventa::inventory.Btn7') }}
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<hr>

<!-- Productos seleccionados -->
<div class="row mx-2 mt-1">
    <div class="card shadow-sm">
        <div class="col-md-12 h-100">
            <div class="card-body">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">{{ trans('ptventa::inventory.2T1') }}</th>
                            <th>{{ trans('ptventa::inventory.2T2') }}</th>
                            <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="{{ trans('ptventa::inventory.2T8') }}">
                                <i class="fas fa-barcode"></i>
                            </th>
                            <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="{{ trans('ptventa::inventory.2T9') }}">
                                <i class="far fa-file-alt"></i>
                            </th>
                            <th class="text-center">{{ trans('ptventa::inventory.2T3') }}</th>
                            <th class="text-center">{{ trans('ptventa::inventory.2T4') }}</th>
                            <th class="text-center">{{ trans('ptventa::inventory.2T5') }}</th>
                            <th class="text-center">{{ trans('ptventa::inventory.2T6') }}</th>
                            <th class="text-center">{{ trans('ptventa::inventory.2T7') }}</th>
                            <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="{{ trans('ptventa::inventory.2T12') }}">
                                <i class="fas fa-arrow-circle-down"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="text-center">1</th>
                            <th class="text-center">1</th>
                            <th class="text-center">1</th>
                            <th class="text-center">1</th>
                            <th class="text-center">1</th>
                            <th class="text-center">1</th>
                            <th class="text-center">1</th>
                            <th class="text-center">1</th>
                            <th class="text-center">1</th>
                            <td class="text-center">
                                <button type="button" class="btn btn-outline-warning btn-sm py-0" data-toggle="tooltip"
                                    data-placement="right" title="{{ trans('ptventa::inventory.Tooltip1') }}">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm py-0"
                                    data-toggle="tooltip" data-placement="right"
                                    title="{{ trans('ptventa::inventory.Tooltip2') }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Registro de baja -->
<div class="d-flex justify-content-evenly">
    <div class="row">
        <div class="col-12 mb-3">
            <button type="button" class="btn btn-danger form-control text-truncate">
                {{ trans('ptventa::inventory.Btn8') }} <i class="fa-solid fa-arrows-down-to-line"></i>
            </button>
        </div>
    </div>
</div>
