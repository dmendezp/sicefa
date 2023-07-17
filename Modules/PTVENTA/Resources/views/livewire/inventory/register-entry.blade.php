<div>

    <!-- Seleccionar y agregar producto -->
    <div class="row mx-3">

        <!-- Responsables y bodegas -->
        <div class="col-md-3">
            <div class="card card-success">
                <div class="card-header text-center">
                    <strong>Responsables y bodegas</strong>
                </div>
                <div class="card-body tex-center pt-1">
                    <label class="form-label my-0 mt-1">Entrega:</label>
                    <div class="row mb-1">
                        <div class="col-5 pe-1">
                            {!! Form::number(null, null, [
                                'class'=>'form-control form-control-sm',
                                'wire:model.defer'=>'delivery_document_number',
                                'wire:keydown.enter'=>'consultPersonDelivery',
                                'wire:loading.attr'=>'disabled',
                                'wire:target'=>'consultPersonDelivery'
                            ])!!}
                        </div>
                        <div class="col ps-1">
                            {!! Form::text(null, $delivery_person ? $delivery_person->document_type : '------------------', [
                                'class'=>'form-control form-control-sm',
                                'disabled'
                            ])!!}
                        </div>
                    </div>
                    {!! Form::text(null, $delivery_person ? $delivery_person->full_name : '------------------', [
                        'class'=>'form-control form-control-sm',
                        'disabled'
                    ])!!}
                    <label class="form-label my-0">Bodega de origen:</label>
                    <select class="form-select form-select-sm" wire:model='delivery_warehouse_id'>
                        <option value="">-- Selecciona --</option>
                        @foreach ($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                        @endforeach
                    </select>
                    <hr class="mb-1">
                    <label class="form-label my-0">Recibe:</label>
                    {!! Form::text(null, Auth::user()->person->full_name, [
                        'class'=>'form-control form-control-sm',
                        'disabled'
                    ])!!}
                    <label class="form-label my-0">Bodega de destino:</label>
                    {!! Form::text(null, $warehouse->name, [
                        'class'=>'form-control form-control-sm',
                        'disabled'
                    ])!!}
                </div>
            </div>
        </div>

        <!-- Datos de inventario para el producto -->
        <div class="col-md-7 h-100">
            <div class="row mx-3 align-items-end">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="producto">Producto:</label>
                        <input type="text" class="form-control" id="producto" name="producto">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="precio">Precio:</label>
                        <input type="number" class="form-control" id="precio" name="precio">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cantidad">Cantidad:</label>
                        <input type="number" class="form-control" id="precio" name="precio">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="marca">Marca:</label>
                        <input type="text" class="form-control" id="marca" name="marca">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="numeroLote">Número de lote:</label>
                        <input type="number" class="form-control" id="numeroLote" name="numeroLote">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="fechaProduccion">Fecha de Producción:</label>
                        <input type="date" class="form-control" id="fechaProduccion" name="fechaProduccion">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="fechaExpiracion">Fecha de Expiración:</label>
                        <input type="date" class="form-control" id="fechaExpiracion" name="fechaExpiracion">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="codInventario">Código de Inventario:</label>
                        <input type="number" class="form-control" id="codInventario" name="codInventario">
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Acerca de:</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="input-group">
                            <button type="button" class="btn btn-success form-control text-truncate">Agregar Producto <i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Productos seleccionados -->
    <div class="row mx-3">
        <div class="card shadow-sm">
            <div class="col-md-12 h-100">
                <div class="card-body">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Marca (Producto)</th>
                                <th scope="col" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Código de Inventario"><i class="fas fa-barcode"></i></th>
                                <th scope="col" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Observación"><i class="far fa-file-alt"></i></th>
                                <th scope="col">Precio</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Fecha Producción</th>
                                <th scope="col">Núm Lote</th>
                                <th scope="col">Fecha Expiración</th>
                                <th scope="col" class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Acciones"><i class="fas fa-arrow-circle-down"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Yogurt Alpine</td>
                                <td><i class="fas fa-times text-danger"></i></td>
                                <td><i class="fas fa-check text-success"></i></td>
                                <td>$ 1.200</td>
                                <td>16</td>
                                <td>11/04/23</td>
                                <td>340-FCH</td>
                                <td>15/06/23</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-outline-warning btn-sm py-0" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Editar Producto">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger btn-sm py-0" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Eliminar Producto">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Croquetas</td>
                                <td><i class="fas fa-check text-success"></i></td>
                                <td><i class="fas fa-times text-danger"></i></td>
                                <td>$ 2.200</td>
                                <td>20</td>
                                <td>14/04/23</td>
                                <td>355-GCH</td>
                                <td>17/06/23</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-outline-warning btn-sm py-0" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Editar Producto">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger btn-sm py-0" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Eliminar Producto">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Registro de entrada -->
    <div class="d-flex justify-content-evenly">
        <div class="row">
            <div class="col-12 mb-3">
                <button type="button" class="btn btn-success form-control text-truncate">Registrar entrada <i class="fas fa-save"></i></button>
            </div>
        </div>
    </div>

    @section('sripts-register-entry')
        <!-- Scripts del componente register-entry -->
        <script src="{{ asset('modules/ptventa/js/inventory/entry/livewire-register-entry.js') }}"></script>
    @endsection

</div>
