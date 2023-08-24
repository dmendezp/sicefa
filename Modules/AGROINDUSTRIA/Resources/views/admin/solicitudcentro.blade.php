@extends('agroindustria::layouts.master')
@section('content')

    <section class="ganaderia" id="ganaderia">
        <div class="container">
            <h1>SERVICIO NACIONAL DE APRENDIZAJE SENA
                GESTIÓN DE INFRAESTRUCTURA Y LOGÍSTICA
                FORMATO SOLICITUD DE BIENES</h1>
            <div class="he-des">
                <h5>Cefa</h5>

            </div>
        </div>
        </section>
        <br>

        <div class="container">
         <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">SOLICITUD DE BIENES</div>

                <div class="card-body">
                    {!! Form::open(['url' => route('agroindustria.admin.solicitud_centro')]) !!}
                    <div class="mb-6">
                        <label for="request_date" class="form-label">Fecha de Solicitud</label>
                        {!! Form::date('request_date', now(), ['class'=>'form-control', 'readonly' => 'readonly']) !!}
                        <br>
                    </div>
                    <div class="mb-6">
                        <label for="area" class="form-label">Area</label>
                        {!! Form::text('area', 'Agroindustria', ['class'=>'form-control', 'readonly' => 'readonly']) !!}
                        <br>
                    </div>
                    <div class="mb-6">
                        <label for="region_code" class="form-label">Codigo Regional</label>
                        {!! Form::number('region_code', '41', ['class'=>'form-control', 'readonly' => 'readonly']) !!}
                        <br>
                    </div>
                    <div class="mb-6">
                        <label for="region_name" class="form-label">Nombre Regional</label>
                        {!! Form::text('region_name', 'Huila', ['class'=>'form-control', 'readonly' => 'readonly']) !!}
                        <br>
                    </div>
                    <div class="mb-6">
                        <label for="cost_code" class="form-label">Codigo de Costos</label>
                        {!! Form::number('cost_code', '911610', ['class'=>'form-control', 'readonly' => 'readonly']) !!}
                        <br>
                    </div>
                    <div class="mb-6">
                        <label for="cost_center_name" class="form-label">Nombre Centro de costo</label>
                        {!! Form::text('cost_center_name', 'Centro de Formación Agroindustrial', ['class'=>'form-control', 'readonly' => 'readonly']) !!}
                        <br>
                    </div>
                    <div class="mb-6">
                        <label for="coordinator_name" class="form-label">Nombre de jefe de oficina o coordinador de area</label>
                        {!! Form::text('coordinator_name',null, ['class'=>'form-control']) !!}
                        <br>
                    </div>
                    <div class="mb-6">
                        <label for="document_number_coordinator" class="form-label">Cedula</label>
                        {!! Form::number('document_number',null, ['class'=>'form-control']) !!}
                        <br>
                    </div>
                    <div class="mb-6">
                        <label for="document_number" class="form-label">Nombre de servidor público a quien se le asignara el bien</label>
                        {!! Form::text('document_number',null, ['class'=>'form-control']) !!}
                        <br>
                    </div>
                    <div class="mb-6">
                        <label for="document_number" class="form-label">Cedula</label>
                        {!! Form::number('document_number',null, ['class'=>'form-control']) !!}
                        <br>
                    </div>
                    <div class="mb-6">
                        <label for="document_number" class="form-label">Código de grupo o ficha de caracterización</label>
                        {!! Form::number('document_number',null, ['class'=>'form-control']) !!}
                        <br>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row clearfix">
      <div class="col-md-12">
        <table class="table table-bordered table-hover" id="tab_logic">
          <thead>
            <tr>
              <th class="text-center"> # </th>
              <th class="text-center"> Detalle Producto </th>
              <th class="text-center"> Cantidad </th>

            </tr>
          </thead>
          <tbody>
            <tr id='addr0'>
              <td>1</td>
              <td><input type="text" name='product[]'  placeholder='Descripción' class="form-control"/></td>
              <td><input type="number" name='qty[]' placeholder='Ingrese Cantidad' class="form-control qty" step="0" min="0"/></td>
            </tr>
            <tr id='addr1'></tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row clearfix">
      <div class="col-md-12">
        <button id="add_row" class="btn btn-dark pull-left">Agregar</button>
        <button id='delete_row' class="pull-right btn btn-default">Eliminar Fila</button>
      </div>
    </div>
  </div>
  <center>
    {!! Form::submit('Enviar',['class' => 'btn btn-warning','name' => 'enviar']) !!}
    {!! Form:: close() !!}
    </center>
    <script src="{{ asset('jsagroindustria/js/fact.js') }}"></script>
    <br>











<!--//--------------------------------------------------------------------------------------------------------//-->




    <footer>
        <div class="container">
            <div class="footer-content">

                <div class="footer-div">
                    <div class="social-media">

                         <h4>Mas Informacion</h4>
                        <ul class="social-icons">
                            <li>
                                <a href="#"><i class="fab fa-telegram"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fab fa-facebook-square"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fab fa-whatsapp"></i></a>
                            </li>
                        </ul>
                    </div>

                    </div>
                </div>

            </div>
        </div>
    </footer>
    @section('js')
    @endsection

    
@endsection
