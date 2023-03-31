@extends('ganaderia::layouts.master')

@section('stylesheet')

@endsection

@section('content')
    <div class="content">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center">
          <!-- /.col-md-6 -->
          <div class="col-lg-8 ">

            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Contactanos</h5>
              </div>
        <div class="card-body row">
          <div class="col-5 text-center d-flex align-items-center justify-content-center">
            <div class="">
              <h2><strong>{{ env('APP_NAME') }}</strong></h2>

              <p class="lead mb-5">Km 38 via al sur de Neiva, Centro de Formación Agroindustrial<br>
                Campoalegre - Huila
              </p>
            </div>
          </div>
          <div class="col-7">
            <div class="form-group">
              <label for="inputName">Nombre</label>
              <input type="text" id="inputName" class="form-control" />
            </div>
            <div class="form-group">
              <label for="inputEmail">Correo Electronico</label>
              <input type="email" id="inputEmail" class="form-control" />
            </div>
            <div class="form-group">
              <label for="inputSubject">Asunto</label>
              <input type="text" id="inputSubject" class="form-control" />
            </div>
            <div class="form-group">
              <label for="inputMessage">Mensaje</label>
              <textarea id="inputMessage" class="form-control" rows="4"></textarea>
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-primary" value="Enviar Mensaje">
            </div>
          </div>
        </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

@endsection

@section('script')

@endsection