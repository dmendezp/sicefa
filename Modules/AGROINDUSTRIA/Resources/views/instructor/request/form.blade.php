@extends('agroindustria::layouts.master')
@section('content')
        <div class="container">
            <div class="form">
                <div class="form-header">{{trans('agroindustria::request.requestSupplies')}}</div>
                <div class="form-body">
                    {!! Form::open(['url' => route('cefa.agroindustria.units.instructor.enviarsolicitud'),'method' => 'post']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::label('date', trans('agroindustria::request.dateApplication')) !!}
                            {!! Form::date('date', now(), ['class'=>'form-control', 'id'=>'readonly-bg-gray', 'readonly' => 'readonly']) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('coordinator', trans('agroindustria::request.nameOfficeHeadAreaCoordinator')) !!}
                            {!! Form::select('coordinator', $coordinatorOptions, null, ['class' => 'form-control', 'id' => 'coordinator_select']) !!}
                            @error('coordinator')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('document_number_coordinator', trans('agroindustria::request.documentNumber')) !!}
                            {!! Form::number('document_number_coordinator',null, ['class'=>'form-control', 'readonly' => 'readonly', 'id' => 'document_number_coordinator']) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('receiver', trans('agroindustria::request.namePersonWhomPropertyWillAssigned')) !!}
                            {!! Form::text('receiver', $name, ['class' => 'form-control', 'id'=>'readonly-bg-gray', 'readonly' => 'readonly',]) !!}                        
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('document_number_person', trans('agroindustria::request.documentNumber')) !!}
                            {!! Form::number('document_number_person', $cedula, ['class'=>'form-control', 'id'=>'readonly-bg-gray', 'readonly' => 'readonly']) !!}    
                        </div>
                        <div class="col-md-12">
                            {!! Form::label('course_id', trans('agroindustria::request.groupCodeCharacterizationSheet')) !!}
                            {!! Form::select('course_id', $courses->pluck('text', 'value')->prepend('Seleccione la ficha del programa', ''), null, ['class'=>'form-control', 'id' => 'course']) !!}
                            @error('course_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>     
                        <div class="col-md-12">
                            <div id="products">
                                <h3>{{trans('agroindustria::request.products')}}</h3>
                                <!-- Aquí se agregarán los campos de producto dinámicamente -->
                                <button type="button" id="add-product" id="center_button">{{trans('agroindustria::request.addProduct')}}</button>
                                <div class="product">
                                    {!! Form::number('code_sena[]', null, ['placeholder' => trans('agroindustria::request.SENACode')]) !!}
                                    {!! Form::select('product_name[]', $element, null, ['id' => 'element']) !!}
                                    <span class="available-quantity"></span>
                                    {!! Form::number('amount[]', null, ['placeholder' => trans('agroindustria::request.amount'), 'class' => 'amount-input']) !!}
                                    {!! Form::text('observations[]', null, ['placeholder' =>  trans('agroindustria::request.observations')]) !!}
                                    {!! Form::button(trans('agroindustria::request.delete'), ['class'=>'remove-product']) !!}                                
                                </div>                           
                            </div>
                        </div>
                        
                        <div class="button">
                            {!! Form::submit(trans('agroindustria::request.send'),['class' => 'enviar','name' => 'enviar']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {!! Form:: close() !!}
    
    @section('script')
    @endsection
    <script>
        $(document).ready(function() {
            // Aplicar Select2 al campo de selección con el id 'course'
            $('#course').select2();
        });
    
        $(document).ready(function() {
            // Aplicar Select2 al campo de selección con el id 'course'
            $('#element').select2();
        });
    
        $(document).ready(function() {
            // Agregar un nuevo campo de producto
            $("#add-product").click(function() {
                    var newProduct = '<div class="product">{!! Form::number("code_sena[]", null, ["placeholder"=>"Código SENA"]) !!} {!! Form::select("product_name[]", $element, null, ["readonly" => "readonly", "class" => "element-select"]) !!}<span class="available-quantity"></span> {!! Form::number("amount[]", NULL, ["placeholder" => "Cantidad"]) !!} {!! Form::text("observations[]", NULL, ["placeholder" => "Observaciones"]) !!} {!! Form::button("Eliminar", ["class"=>"remove-product"]) !!}</div>';
    
                // Agregar el nuevo campo al DOM
                $("#products").append(newProduct);
    
                // Inicializar Select2 en los campos 'element' en el nuevo campo
                $('.element-select:last').select2();
    
            });
    
            // Eliminar un campo de producto
            $("#products").on("click", ".remove-product", function() {
                $(this).parent(".product").remove();
            });
                $("#products").on("change", "select[name^='product_name']", function() {
                var selectedElement = $(this).val();
                var parentProduct = $(this).closest('.product');
                var availableQuantity = parentProduct.find('.available-quantity');
                // Realizar una solicitud AJAX para obtener la cantidad disponible
                $.ajax({
                    url: {!! json_encode(route('cefa.agroindustria.units.instructor.amount', ['id' => ':id'])) !!}.replace(':id', selectedElement.toString()),
                    method: 'GET',
                    success: function(response) {
                        if (response.inventory.length > 0) {
                            var inventory = response.inventory[0];
                            var quantity = parseFloat(inventory.amount);

                            availableQuantity.text('Cantidad Disponible: ' + quantity);
                        } else {
                            availableQuantity.text(''); // Limpia el texto si no se encuentra la cantidad disponible
                        }
                    },
                    error: function(error) {
                        console.error('Error al obtener la cantidad disponible:', error);
                        availableQuantity.text(''); // Limpia el texto en caso de error
                    }
                });
            });
        });
    </script>   
@endsection
