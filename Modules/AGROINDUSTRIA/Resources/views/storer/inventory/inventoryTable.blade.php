@extends('agroindustria::layouts.master')
@section('content')

<h1 class="title_labor">Inventario de {{ session('viewing_unit_name') }}</h1>

<select name="warehouse_id" id="warehouseSelect">
    <option value="">Seleccione una bodega</option>
    @foreach ($warehouses as $w)
        <option value="{{$w->id}}">{{$w->name}}</option>
    @endforeach
</select>

@if(auth()->check() && (checkRol('agroindustria.almacenista')))
<a href="#" id="inventoryAlertLink" style="margin-left: 120px; margin-bottom: 20px; text-decoration: none;">
    <button class="btn btn-success" >
        <i class="fas fa-eye" style="color: #ffffff;">ㅤINSUMOS PRONTO A AGOTARSEN</i>
    </button>
</a>
<a href="#" id="inventoryAlertExpLink" style="margin-left: 120px; margin-bottom: 20px; text-decoration: none;">
    <button class="btn btn-info" >
        <i class="fas fa-calendar-times"style="color: #ffffff;">ㅤINSUMOS PRONTOS A CADUCAR</i>
    </button>
</a>
@endif

@if(auth()->check() && (checkRol('agroindustria.admin')))
    <a href="#" id="inventoryAlertLink"  style="margin-left: 120px; margin-bottom: 20px; text-decoration: none;">
        <button class="btn btn-success" onclick="selectWarehouse()">
            <i class="fas fa-eye" style="color: #ffffff;">ㅤINSUMOS PRONTO A AGOTARSEN</i>
        </button>
    </a>
    <a href="#" id="inventoryAlertExpLink" style="margin-left: 120px; margin-bottom: 20px; text-decoration: none;">
        <button class="btn btn-info" >
            <i class="fas fa-calendar-times"style="color: #ffffff;">ㅤINSUMOS PRONTOS A CADUCAR</i>
        </button>
    </a>
@endif

@if(auth()->check() && (checkRol('agroindustria.instructor.vilmer') || checkRol('agroindustria.instructor.chocolate') || checkRol('agroindustria.instructor.cerveceria')))
    <a href="#" id="inventoryAlertLink" style="margin-left: 120px; margin-bottom: 20px; text-decoration: none;">
        <button class="btn btn-success" >
            <i class="fas fa-eye" style="color: #ffffff;">ㅤINSUMOS PRONTO A AGOTARSEN</i>
        </button>
    </a>
    <a href="#" id="inventoryAlertExpLink" style="margin-left: 120px; margin-bottom: 20px; text-decoration: none;">
        <button class="btn btn-info" >
            <i class="fas fa-calendar-times"style="color: #ffffff;">ㅤINSUMOS PRONTOS A CADUCAR</i>
        </button>
    </a>
@endif

<hr>

<div id="inventoryTableContainer" class="table-labors">
    <table id="inventory" class="table table-striped" style="width: 98%; margin-left: 40px;">
        <thead>
            <tr>
               <th>Producto</th>
               <th>Categoria</th>
               <th>Unidad de Medida</th>
               <th>Cantidad</th>
               <th>Stock</th>
               <th>Precio</th>
               <th>Fecha Producción</th>
               <th>Fecha Expiración</th>
               <th>Lote</th>
               @if(auth()->check() && (checkRol('agroindustria.admin')))  
               <th>Acciones</th>
               @endif
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>      
</div>

@section('script')
@endsection

<script>
    // Asignar un evento al cambio del select
    document.getElementById('warehouseSelect').addEventListener('change', function () {
        // Obtener el valor seleccionado
        var selectedWarehouseId = this.value;

        // Construir la URL con el parámetro warehouse_id
        @if(auth()->check() && (checkRol('agroindustria.admin')))
        var urlAlert = {!! json_encode(route('cefa.agroindutria.admin.units.inventoryAlert', ['waId' => ':waId'])) !!}.replace(':waId', selectedWarehouseId);
        var urlExp = {!! json_encode(route('cefa.agroindutria.admin.units.inventoryAlertexp', ['wId' => ':wId'])) !!}.replace(':wId', selectedWarehouseId);

        // Actualizar el atributo href del enlace
        document.getElementById('inventoryAlertLink').href = urlAlert;
        document.getElementById('inventoryAlertExpLink').href = urlExp;
        @endif

        @if(auth()->check() && (checkRol('agroindustria.instructor.vilmer') || checkRol('agroindustria.instructor.chocolate') || checkRol('agroindustria.instructor.cerveceria')))
        var urlAlert = {!! json_encode(route('cefa.agroindutria.instructor.units.inventoryAlert', ['waId' => ':waId'])) !!}.replace(':waId', selectedWarehouseId);
        var urlExp = {!! json_encode(route('cefa.agroindutria.instructor.units.inventoryAlertexp', ['wId' => ':wId'])) !!}.replace(':wId', selectedWarehouseId);

        // Actualizar el atributo href del enlace
        document.getElementById('inventoryAlertLink').href = urlAlert;
        document.getElementById('inventoryAlertExpLink').href = urlExp;
        @endif

        @if(auth()->check() && (checkRol('agroindustria.almacenista')))
        var urlAlert = {!! json_encode(route('cefa.agroindutria.storer.units.inventoryAlert', ['waId' => ':waId'])) !!}.replace(':waId', selectedWarehouseId);
        var urlExp = {!! json_encode(route('cefa.agroindutria.storer.units.inventoryAlertexp', ['wId' => ':wId'])) !!}.replace(':wId', selectedWarehouseId);

        // Actualizar el atributo href del enlace
        document.getElementById('inventoryAlertLink').href = urlAlert;
        document.getElementById('inventoryAlertExpLink').href = urlExp;
        @endif
    });
    
    $(document).ready(function () {
        
        $('#warehouseSelect').on('change', function() {
            var warehouseId = $(this).val();

            var url = {!! json_encode(route('cefa.agroindustria.instructor.units.inventory.elements', ['warehouseId' => ':warehouseId'])) !!}.replace(':warehouseId', warehouseId);
            console.log(url);
            if(warehouseId){
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (data) {
                        console.log(data);

                        let table = new DataTable('#inventory');
                        table.destroy();
                        // Limpia la tabla antes de agregar nuevas filas
                        $('#inventory tbody').empty();

                        // Actualiza la tabla con el nuevo inventario
                        $.each(data.inventories, function(index, inventory) {
                            var row = '<tr>' +
                                '<td>' + inventory.element.name + '</td>' +
                                '<td>' + inventory.element.category.name + '</td>' +
                                '<td>' + inventory.element.measurement_unit.name + '</td>' +
                                '<td>' + (inventory.amount / inventory.element.measurement_unit.conversion_factor) + '</td>' +
                                '<td>' + inventory.stock + '</td>' +
                                '<td>' + inventory.price + '</td>' +
                                '<td>' + inventory.production_date + '</td>' +
                                '<td>' + inventory.expiration_date + '</td>' +
                                '<td>' + inventory.lot_number + '</td>';
                            
                            // Agrega el botón si es un administrador
                            @if(auth()->check() && (checkRol('agroindustria.admin')))
                                row += '<td>' +
                                    '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dischargeModal' + inventory.id + '">' +
                                    'Dar baja' +
                                    '</button>' +
                                    '<div class="modal fade" id="dischargeModal' + inventory.id + '" tabindex="-1" aria-labelledby="dischargeModalLabel' + inventory.id + '" aria-hidden="true">' +
                                    '<div class="modal-dialog">' +
                                        '<div class="modal-content">' +
                                            '<div class="modal-header">' +
                                                '<h1 class="modal-title fs-5" id="dischargeModalLabel' + inventory.id + '">Dar baja a ' + inventory.element.name + '</h1>' +
                                                '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
                                            '</div>' +
                                            '{!! Form::open(["method" => "post", "url" => route("cefa.agroindustria.admin.discharge.create")]) !!}' +
                                            '<div class="modal-body">' +
                                                '<!-- Contenido del cuerpo del modal -->' +
                                                    '<input id="warehouse" name="warehouse" type="hidden" value="' + warehouseId + '">' +
                                                    '<input id="element" name="element" type="hidden" value="' + inventory.id + '">' +
                                                    '<input id="amount" name="amount" type="hidden" value="' + inventory.amount + '">' +
                                                    '<input id="price" name="price" type="hidden" value="' + inventory.price + '">' +
                                                    '<div class="col-md-12">' +
                                                        '{!! Form::label("date", trans("agroindustria::menu.Date Time")) !!}' +
                                                        '{!! Form::datetime("date", now()->format("Y-m-d\TH:i:s"), ["class" => "form-control", "id" => "readonly-bg-gray", "readonly" => "readonly"]) !!}' +
                                                    '</div>' +
                                                    '<div class="col-md-12">' +
                                                        '{!! Form::label("observation", trans("agroindustria::menu.Observations")) !!}' +
                                                        '{!! Form::textarea("observation", old("observation"), ["class" => "form-control", "id" => "textarea"]) !!}' +
                                                        '@error("observation")' +
                                                            '<span class="text-danger">{{ $message }}</span>' +
                                                        '@enderror' +
                                                    '</div>' +
                                                '</div>' +
                                                '<div class="modal-footer">' +
                                                    '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>' +
                                                    '{!! Form::submit(trans("agroindustria::menu.Register deregistration"), ["class" => "baja btn btn-success", "name" => "baja"]) !!}' +
                                                '{!! Form::close() !!}' +
                                            '</div>'
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                                '</td>';
                            @endif

                            row += '</tr>';

                            $('#inventory tbody').append(row);
                        });

                        new DataTable('#inventory');
                        
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
</script>
@endsection