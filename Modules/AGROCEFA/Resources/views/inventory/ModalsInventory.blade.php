    {{-- Modal agregar Registro --}}
    <div class="modal fade" id="crearegistro" tabindex="-1" aria-labelledby="crearegistro" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarAsistenciaModalLabel">
                        {{ trans('agrocefa::inventory.Addinventory') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('agrocefa.inventory.store') }}">
                        @csrf
                        <div class="form-group">
                            <label
                                for="productive_unit_warehouse_id">{{ trans('agrocefa::inventory.ProductiveUnit-Warehouse') }}:</label>
                            <select name="productive_unit_warehouse_id" id="productive_unit_warehouse_id"
                                class="form-control" required>
                                <option value="">{{ trans('agrocefa::inventory.SelectUnit-Warehouse') }}</option>
                                @foreach ($ProductiveUnitWarehouses as $UnitWarehouse)
                                    <option value="{{ $UnitWarehouse->id }}"
                                        @if ($UnitWarehouse->productive_unit_warehouse_id == $UnitWarehouse->id) selected @endif>
                                        {{ $UnitWarehouse->productive_unit->name }} -
                                        {{ $UnitWarehouse->warehouse->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="element_id">{{ trans('agrocefa::inventory.Element') }}:</label>
                            <select name="element_id" id="element_id" class="form-control" required>
                                <option value="">{{ trans('agrocefa::inventory.Select_element') }}</option>
                                @foreach ($elements as $element)
                                    <option value="{{ $element->id }}">{{ $element->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('agrocefa::inventory.Description') }}:</label>
                            <input type="text" name="description" id="description" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="destination">{{ trans('agrocefa::inventory.Destination') }}:</label>
                            <select name="destination" id="destination" class="form-control" required>
                                <option value="Producción">Producción</option>
                                <option value="Formación">Formación</option>
                                <!-- Agrega más opciones según tus valores enum -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">{{ trans('agrocefa::inventory.Price') }}:</label>
                            <input type="number" name="price" id="price" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="amount">{{ trans('agrocefa::inventory.Amount') }}:</label>
                            <input type="number" name="amount" id="amount" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock:</label>
                            <input type="number" name="stock" id="stock" class="form-control" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">{{ trans('agrocefa::inventory.Add') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal de editar --}}
    @foreach ($inventory as $item)
        <div class="modal fade" id="editarRegistroModal_{{ $item->id }}" tabindex="-1"
            aria-labelledby="editarRegistroModal_{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="agregarAsistenciaModalLabel_{{ $item->id }}">
                            {{ trans('agrocefa::inventory.Update') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editInventoryForm"
                            action="{{ route('agrocefa.inventory.update', ['id' => $item->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label
                                    for="productive_unit_warehouse_id_{{ $item->id }}">{{ trans('agrocefa::inventory.ProductiveUnit-Warehouse') }}:</label>
                                <select name="productive_unit_warehouse_id"
                                    id="productive_unit_warehouse_id_{{ $item->id }}" class="form-control" required>
                                    @foreach ($ProductiveUnitWarehouses as $UnitWarehouse)
                                        <option value="{{ $UnitWarehouse->id }}"
                                            @if ($item->productive_unit_warehouse_id == $UnitWarehouse->id) selected @endif>
                                            {{ $UnitWarehouse->productive_unit->name }} -
                                            {{ $UnitWarehouse->warehouse->name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group">
                                <label
                                    for="element_id_{{ $item->id }}">{{ trans('agrocefa::inventory.Element') }}:</label>
                                <select name="element_id" id="element_id_{{ $item->id }}" class="form-control"
                                    required>
                                    @foreach ($elements as $element)
                                        <option value="{{ $element->id }}"
                                            @if ($item->element_id == $element->id) selected @endif>{{ $element->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label
                                    for="destination_{{ $item->id }}">{{ trans('agrocefa::inventory.Destination') }}:</label>
                                <select name="destination" id="destination" class="form-control" required>
                                    <option value="Producción" @if ($item->destination == 'Producción') selected @endif>Producción
                                    </option>
                                    <option value="Formación" @if ($item->destination == 'Formación') selected @endif>Formación
                                    </option>
                                    <!-- Agrega más opciones según tus valores enum -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label
                                    for="description_{{ $item->id }}">{{ trans('agrocefa::inventory.Description') }}:</label>
                                <input type="text" name="description" id="description_{{ $item->id }}"
                                    class="form-control" value="{{ $item->description }}" required>
                            </div>
                            <div class="form-group">
                                <label for="price_{{ $item->id }}">{{ trans('agrocefa::inventory.Price') }}:</label>
                                <input type="number" name="price" id="price_{{ $item->id }}"
                                    class="form-control" required value="{{ $item->price }}">
                            </div>
                            <div class="form-group">
                                <label
                                    for="amount_{{ $item->id }}">{{ trans('agrocefa::inventory.Amount') }}:</label>
                                <input type="number" name="amount" id="amount_{{ $item->id }}"
                                    class="form-control" value="{{ $item->amount }}" required>
                            </div>
                            <div class="form-group">
                                <label for="stock_{{ $item->id }}">Stock:</label>
                                <input type="number" name="stock" id="stock_{{ $item->id }}"
                                    class="form-control" value="{{ $item->stock }}" required>
                            </div>
                            <br>
                            <button type="submit"
                                class="btn btn-primary">{{ trans('agrocefa::inventory.Updaterecord') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($inventory as $item)
        <div class="modal fade" id="eliminarinventory_{{ $item->id }}" tabindex="-1"
            aria-labelledby="eliminaractividadLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eliminaractividadLabel">
                            {{ trans('agrocefa::inventory.DeleteRecord') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{ trans('agrocefa::inventory.Sure?') }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ trans('agrocefa::inventory.Cancel') }}</button>
                        {!! Form::open(['route' => ['agrocefa.inventory.destroy', $item->id], 'method' => 'DELETE']) !!}
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{ trans('agrocefa::inventory.Delete') }}</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach