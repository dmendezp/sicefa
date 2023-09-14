@extends('agroindustria::layouts.master')
@section('content')
        <div class="container">
            <div class="form">
                <div class="form-header">SOLICITUD DE BIENES</div>
                <div class="form-body">
                    {!! Form::open(['url' => route('cefa.agroindustria.instructor.enviarsolicitud'),'method' => 'post']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::label('date', 'Fecha de Solicitud') !!}
                            {!! Form::date('date', now(), ['class'=>'form-control', 'readonly' => 'readonly']) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('coordinator', 'Nombre de jefe de oficina o coordinador de área') !!}
                            {!! Form::select('coordinator', $coordinatorOptions, null, ['class' => 'form-control', 'id' => 'coordinator_select']) !!}
                            @error('coordinator')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('document_numver_coordinator', 'Cédula') !!}
                            {!! Form::number('document_number_coordinator',null, ['class'=>'form-control', 'readonly' => 'readonly', 'id' => 'document_number_coordinator']) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('receiver', 'Nombre de a quien se le asignara el bien') !!}
                            {!! Form::text('receiver', $name, ['class' => 'form-control', 'readonly' => 'readonly',]) !!}                        
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('document_number_person', 'Cédula') !!}
                            {!! Form::number('document_number_person', $cedula, ['class'=>'form-control', 'readonly' => 'readonly']) !!}    
                        </div>
                        <div class="col-md-12">
                            {!! Form::label('course_id', 'Código de grupo o ficha de caracterización') !!}
                            {!! Form::select('course_id', $courses->pluck('text', 'value')->prepend('Seleccione la ficha del programa', ''), null, ['class'=>'form-control', 'id' => 'course']) !!}
                            @error('course_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>     
                        <div class="col-md-12">
                            <div id="products">
                                <h3>Productos</h3>
                                <!-- Aquí se agregarán los campos de producto dinámicamente -->
                                <button type="button" id="add-product">Agregar Producto</button>
                                <div class="product">
                                    {!! Form::number('code_sena[]', null, ['placeholder' => 'Código SENA']) !!}
                                    {!! Form::select('product_name[]', $element->pluck('text', 'value')->prepend('Nombre del producto', ''), null, ['readonly' => 'readonly', 'id' => 'element']) !!}
                                    {!! Form::select('measurement_unit[]', $measurementUnit->pluck('text', 'value')->prepend('Unidad de Medida', ''), null, ['id' => 'measurement_unit']) !!}
                                    {!! Form::number('amount[]', null, ['placeholder' => 'Cantidad']) !!}
                                    {!! Form::text('observations[]', null, ['placeholder' => 'Observaciones']) !!}
                                    <button class="remove-product">Eliminar</button>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        
        
        <div class="button">
            {!! Form::submit('Enviar',['class' => 'enviar','name' => 'enviar']) !!}
        </div>
    {!! Form:: close() !!}
    
    @section('js')
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
            // Aplicar Select2 al campo de selección con el id 'course'
            $('#measurement_unit').select2();
        });
    
        $(document).ready(function() {
            // Agregar un nuevo campo de producto
            $("#add-product").click(function() {
                    var newProduct = '<div class="product">{!! Form::number("code_sena[]", null, ["placeholder"=>"Código SENA"]) !!} {!! Form::select("product_name[]", $element->pluck("text", "value")->prepend("Nombre del producto", ''), null, ["readonly" => "readonly", "class" => "element-select"]) !!} {!! Form::select("measurement_unit[]", $measurementUnit->pluck("text", "value")->prepend("Unidad de Medida", ""), null, ["class" => "measurement-unit-select"]) !!} {!! Form::number("amount[]", NULL, ["placeholder" => "Cantidad"]) !!} {!! Form::text("observations[]", NULL, ["placeholder" => "Observaciones"]) !!} <button class="remove-product">Eliminar</button></div>';
    
                // Agregar el nuevo campo al DOM
                $("#products").append(newProduct);
    
                // Inicializar Select2 en los campos 'element' en el nuevo campo
                $('.element-select:last').select2();
    
                // Inicializar Select2 en los campos 'measurement_unit' en el nuevo campo
                $('.measurement-unit-select:last').select2();
            });
    
            // Eliminar un campo de producto
            $("#products").on("click", ".remove-product", function() {
                $(this).parent(".product").remove();
            });
        });
    </script>
    
    
@endsection
