<!DOCTYPE html>
<html lang="en">
    @include('senaempresa::layouts.structure.head')


    <body>
        @csrf
        <div class="wrapper">



        <!-- Navbar -->
        @include('senaempresa::layouts.structure.navbar')
        <!-- /.navbar -->


        <!-- Main Sidebar Container -->
        @include('senaempresa::layouts.structure.aside')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Nosotros</li>
                    </ol>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

           <div class="container">
          <h2 class="display-8">CENTRO DE FORMACIÓN AGROINDUSTRIAL "LA ANGOSTURA"!</h2>
          <p class="lead">El Centro de Formación Agroindustrial del Huila tiene como función principal impartir formación profesional integral con calidad a todos los Colombianos; con el fin de desarrollar competencias laborales que permitan la inserción laboral del personal no vinculado en el sector productivo y la cualificación del talento humano en las empresas. De igual forma articula entidades y procesos para contribuir con el desarrollo económico de la Región.</p>
        </div><br>
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <div class="card" style="width: 20rem; height: 35rem;">
                        <img src="https://agriculturadelasamericas.com/wp-content/uploads/2019/07/tecnologia-agricola.jpg" class="card-img-top" alt="..." height="348" width="1000">
                        <div class="card-body">
                            <h5 class="card-title"> Tecnologo en Producción Agrícola</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 20rem; height: 35rem;">
                        <img src="https://iescinoc.edu.co/wp-content/uploads/14144-copia-1-1199x799.jpg" class="card-img-top" alt="..." height="348" width="1000">
                        <div class="card-body">
                            <h5 class="card-title">Tecnologo en Gestión de Empresas Agropecuarias</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 20rem; height: 35rem;">
                        <img src="https://www.bioaquafloc.com/wp-content/uploads/2021/09/Tecnologi%CC%81a-simbio%CC%81tica-en-acuicultura-1024x768.jpg" class="card-img-top" alt="..." height="348" width="1000">
                        <div class="card-body">
                            <h5 class="card-title">Tecnologo en Acuicultura</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card" style="width: 20rem; height: 35rem;">
                        <img src="https://infoamazonia.org/wp-content/uploads/2016/02/aa-peru%CC%81-2011-2015.jpg" class="card-img-top" alt="..." height="348" width="1000">
                        <div class="card-body">
                            <h5 class="card-title"> Tecnologo en Control Ambiental</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 20rem; height: 35rem;">
                        <img src="https://universidadeuropea.com/resources/media/images/control-calidad-alimentos-1200x630.original.jpg" class="card-img-top" alt="..." height="348" width="1000">
                        <div class="card-body">
                            <h5 class="card-title">Tecnologo en Control de Calidad de Alimentos</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 20rem; height: 35rem;">
                        <img src="https://www.traza.net/wp-content/uploads/2022/02/control_de_calidad_de_alimentos.jpg" class="card-img-top" alt="..." height="348" width="1000">
                        <div class="card-body">
                          <h5 class="card-title">Tecnologo en Gestión de Mercados</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                      </div>
                </div>
            </div>
        </div>

        @section('content')
        @show

        <!-- Control Sidebar -->

        <!-- /.control-sidebar -->



        </div>

        <!-- Main Footer -->
        @include('senaempresa::layouts.structure.footer')

        @include('senaempresa::layouts.structure.scripts')

        <!--scripts utilizados para procesos-->
        @section('scripts')
        @show

        @section('dataTables')
        @show




    </body>
</html>
