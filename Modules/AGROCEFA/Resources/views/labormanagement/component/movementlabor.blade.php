<form id="miFormulario">
    <!-- Agrega campos y elementos según tus necesidades -->
    <h2 class="text-center">{{ trans('agrocefa::labor.production_movement') }}</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="card-header" id="card_header" style="margin-bottom: 10px;">
                {{ trans('agrocefa::movements.Delivery') }}
            </div>
            <div class="form-group">
                {!! Form::label('productive_unit', trans('agrocefa::movements.Productive_Unit')) !!}
                {!! Form::text('productive_unit', Session::get('selectedUnitName'), [
                    'class' => 'form-control',
                    'readonly' => 'readonly',
                ]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('deliverywarehouse', trans('agrocefa::labor.warehouse')) !!}
                {!! Form::select(
                    'deliverywarehouse',
                    ['' => trans('agrocefa::labor.Select_the_warehouse')] + $warehouseData->pluck('name', 'id')->toArray(),
                    old('deliverywarehouse'),
                    ['class' => 'form-control', 'required'],
                ) !!}
            </div>

        </div>
        <div class="col-md-6">
            <div class="card-header" id="card_header" style="margin-bottom: 10px;">
                {{ trans('agrocefa::movements.Receive') }}
            </div>
            <div class="form-group">
                {!! Form::label('unit', trans('agrocefa::movements.Productive_Unit')) !!}
                {!! Form::select(
                    'unit',
                    ['' => trans('agrocefa::labor.Select_the_unit')] + $productunits->pluck('name', 'id')->toArray(),
                    null,
                    ['class' => 'form-control', 'id' => 'unitSelect', 'required']
                ) !!}
            </div>
            
            <div class="form-group">
                {!! Form::label('warehouse', trans('agrocefa::labor.warehouse')) !!}
                {!! Form::select('warehouse', [], null, ['class' => 'form-control', 'id' => 'warehouseSelect', 'required']) !!}
            </div>
        </div>
        </div>
        <br>
        </form>
        
        <script>
            $(document).ready(function () {
                // Manejador de eventos para el cambio en el campo "Unidad Productiva"
                $('#unitSelect').on('change', function () {
                    var selectedUnitId = $(this).val();
        
                    if (selectedUnitId) {
                        $.ajax({
                            url: "{{ route('agrocefa.labormanagement.warehouseUnits') }}",
                            method: 'GET',
                            data: {
                                unit: selectedUnitId
                            },
                            success: function (response) {
                                console.log(response);
                                if (response.filteredWarehouses) {
                                    var warehousesSelect = $('#warehouseSelect');
                                    warehousesSelect.empty();
                                    warehousesSelect.append(new Option('{{ trans('agrocefa::labor.Select_the_warehouse') }}', ''));
        
                                    // Recorre los resultados y crea opciones
                                    $.each(response.filteredWarehouses, function (index, warehouse) {
                                        warehousesSelect.append(new Option(warehouse.name, warehouse.id));
                                    });
                                }
                            },
                            error: function () {
                                console.error('Error en la solicitud AJAX');
                            }
                        });
                    }
                });
            });
        </script>
