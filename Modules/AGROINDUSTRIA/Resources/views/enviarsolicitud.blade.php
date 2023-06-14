@extends('agroindustria::layouts.master')
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="{{asset('cssagroindustria/style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- CSS only -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
     <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
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
                    {!! Form::open(['url' => route('agroindustria.enviarsolicitud')]) !!}
                    <div class="mb-6">
                        <label for="document_number" class="form-label">Fecha de Solicitud</label>
                        {!! Form::date('document_number',null, ['class'=>'form-control']) !!}
                        <br>
                    </div>
                    <div class="mb-6">
                        <label for="document_number" class="form-label">Area</label>
                        {!! Form::text('document_number',null, ['class'=>'form-control']) !!}
                        <br>
                    </div>
                    <div class="mb-6">
                        <label for="document_number" class="form-label">Codigo Regional</label>
                        {!! Form::number('document_number',null, ['class'=>'form-control']) !!}
                        <br>
                    </div>
                    <div class="mb-6">
                        <label for="document_number" class="form-label">Nombre Regional</label>
                        {!! Form::text('document_number',null, ['class'=>'form-control']) !!}
                        <br>
                    </div>
                    <div class="mb-6">
                        <label for="document_number" class="form-label">Codigo de Costos</label>
                        {!! Form::number('document_number',null, ['class'=>'form-control']) !!}
                        <br>
                    </div>
                    <div class="mb-6">
                        <label for="document_number" class="form-label">Nombre Centro de costo</label>
                        {!! Form::text('document_number',null, ['class'=>'form-control']) !!}
                        <br>
                    </div>
                    <div class="mb-6">
                        <label for="document_number" class="form-label">Nombre de jefe de oficina o coordinador de area</label>
                        {!! Form::text('document_number',null, ['class'=>'form-control']) !!}
                        <br>
                    </div>
                    <div class="mb-6">
                        <label for="document_number" class="form-label">Cedula</label>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    @endsection

    <script>

        const selectElement = function(element) {
            return document.querySelector(element);
        }

        let menuToggle = selectElement('.inicio-to');
        let body = selectElement('body');

        menuToggle.addEventListener('click', function(){
            body.classList.toggle('open');
        })

    </script>
@endsection
