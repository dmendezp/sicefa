
@extends('bolmeteor::layouts.master')

@section('title','Desarrolladores')

@section('breadcrumb')
<li class="breadcrumb-item active">
  <a href="{{ route('bolmeteor.estacion.desarrolladores') }}"><i class="fas fa-users"></i> {{ __('Developers') }}</a>
</li>
@endsection

@section('content')
 <!-- /.row -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-green card-outline shadow">
              <div class="card-header">
                <h3 class="card-title">
                  Desarrolladores
                </h3>
              </div>
              <br>



            <!-- Main content -->
    <div class="content">

<div class="container-fluid">
        <div class="row justify-content-md-center">
      <div class="col-md-3">
            <div class="card card-green card-outline shadow">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ asset('bolmeteor/images/imgjerly.jpg') }}"
                       alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">Jerly Yuliana Gasca Claros</h3>
                <p class="text-muted text-center">Tgo. ADSI</p>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>jygasca@misena.edu.co</b>  <a href="#" ></b></a>
                  </li>
                    <li class="list-group-item">
                    <b>Mail</b> <a href="https://mail.google.com/mail/u/0/#inbox?compose=CllgCJTHWNfxBnrcwVhNqLqTcxHWrdbkSMHhkHWTvcJfLXtXckdLrhKCvKdBKHjnHngCpVdbkXB" class="btn btn-outline-primary float-right"><b><i class="fas fa-envelope-square"></i></b></a>
                  </li>
                </ul>
              </div>
            </div>
      </div>
      <div class="col-md-3">
            <div class="card card-green card-outline shadow">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ asset('bolmeteor/images/diego.png') }}"
                       alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">Diego Andres Mendez Pastrana</h3>
                <p class="text-muted text-center">Instructor ADSI</p>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item card-green">
                    <b> dmendezp@sena.edu.co</b> <a href="#"><b></b></a>
                  </li>
                    <li class="list-group-item">
                    <b>Mail</b> <a href="https://mail.google.com/mail/u/1/#inbox/FMfcgxwLsmlqrpWHwPFghnQdNpbFcchW?compose=new" class="btn btn-outline-primary float-right"><b><i class="fas fa-envelope-square"></i></b></a>
                  </li>
                </ul>
              </div>
            </div>
      </div>
     
        </div>
          </div>  
        </div>
      </div>
    
    <!-- /.row -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-green card-outline shadow">
              <div class="card-header">
                <h3 class="card-title">
                  Autores
                </h3>
              </div>
              <br>

            <!-- Main content -->
    <div class="content">

      <div class="container-fluid">
        <div class="row justify-content-md-center">
      <div class="col-md-3">
            <div class="card card-green card-outline shadow">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ asset('bolmeteor/images/leidy.png') }}"
                       alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">Leidy Machado Cuellar</h3>
                <p class="text-muted text-center"> Investigadora Sennova </p>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>lmachado@sena.edu.co</b> <a href="#" ><b></b></a>
                  </li>
                    <li class="list-group-item">
                    <b>Mail</b> <a href="#" class="btn btn-outline-primary float-right"><b><i class="fas fa-envelope-square"></i></b></a>
                  </li>
                </ul>
              </div>
            </div>
      </div>
      <div class="col-md-3">
            <div class="card card-green card-outline shadow">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ asset('bolmeteor/images/Leonardo.png') }}"
                       alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">Leonardo Rodriguez Suarez</h3>
                <p class="text-muted text-center">Investigador Sennova</p>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item card-green">
                    <b>lrodriguezsu@sena.edu.co</b> <a href="#"><b></b></a>
                  </li>
                    <li class="list-group-item">
                    <b>Mail</b> <a href="#" class="btn btn-outline-primary float-right"><b><i class="fas fa-envelope-square"></i></b></a>
                  </li>
                </ul>
              </div>
            </div>
      </div>
      <div class="col-md-3">
            <div class="card card-green card-outline shadow">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ asset('bolmeteor/images/Sergio.png') }}"
                       alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">Sergio Andres Orduz Tovar</h3>
                <p class="text-muted text-center">Líder Sennova</p>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>sorduz@sena.edu.co</b> <a href="#" ><b></b></a>
                  </li>
                    <li class="list-group-item">
                    <b>Mail</b> <a href="#" class="btn btn-outline-primary float-right"><b><i class="fas fa-envelope-square"></i></b></a>
                  </li>
                </ul>
              </div>
            </div>
      </div>

      <div class="col-md-3">
            <div class="card card-green card-outline shadow">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ asset('bolmeteor/images/Valentin.jpg') }}"
                       alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">Valentin Murcia Torrejano</h3>
                <p class="text-muted text-center">Investigador Sennova</p>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item card-green">
                    <b>vmurciat@sena.edu.co</b> <a href="#"><b></b></a>
                  </li>
                    <li class="list-group-item">
                    <b>Mail</b> <a href="#" class="btn btn-outline-primary float-right"><b><i class="fas fa-envelope-square"></i></b></a>
                  </li>
                </ul>
              </div>
            </div>
      </div>

      <div class="col-md-3">
            <div class="card card-green card-outline shadow">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ asset('bolmeteor/images/David.png') }}"
                       alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">David Saavedra Mora</h3>
                <p class="text-muted text-center">Investigador Sennova</p>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item card-green">
                    <b> dsaavedram@sena.edu.co </b> <a href="#"><b></b></a>
                  </li>
                    <li class="list-group-item">
                    <b>Mail</b> <a href="#" class="btn btn-outline-primary float-right"><b><i class="fas fa-envelope-square"></i></b></a>
                  </li
                </ul>
              </div>
            </div>
      </div>


        </div>
          </div>  
        </div>
      </div>
      </div>
      </div>
    

        <!-- /.row -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-green card-outline shadow">
              <div class="card-header">
                <h3 class="card-title">
                  Créditos y reconocimientos
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <ul>
                    <li>Plantilla AdminLTE de <a href="https://adminlte.io" title="AdminLTE" target="blank">adminlte.io/</a></li>
                    <li>Iconos gratuitos de <a href="https://fontawesome.com/icons?d=gallery" title="Flaticon" target="blank"> fontawesome.com</a></li>
                    <li>Iconos diseñados por <a href="https://www.flaticon.es/autores/freepik" title="Freepik" target="blank"> Freepik </a> de <a href="https://www.flaticon.es/" title="Flaticon" target="blank"> www.flaticon.es</a></li>
                  </ul>
                        
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        

      </div><!-- /.container-fluid -->
    <!-- /.content -->
  </div>

@stop