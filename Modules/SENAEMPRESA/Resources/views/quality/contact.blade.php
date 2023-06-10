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
                                <li class="breadcrumb-item active">Contactos</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <div class="container text-center">
                <div class="row">
                    <div class="col">
                        <div class="card" style="width: 18rem;">
                            <img src="https://static.wixstatic.com/media/30d63c_bb9cb5514b0546beafb671ec02cd2244~mv2.png/v1/fill/w_387,h_441,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/30d63c_bb9cb5514b0546beafb671ec02cd2244~mv2.png"
                                class="card-img-top" alt="..." height="348" width="1000">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the
                                    bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card" style="width: 18rem;">
                            <img src="https://static.wixstatic.com/media/30d63c_bb9cb5514b0546beafb671ec02cd2244~mv2.png/v1/fill/w_387,h_441,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/30d63c_bb9cb5514b0546beafb671ec02cd2244~mv2.png"
                                class="card-img-top" alt="..." height="348" width="1000">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the
                                    bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card" style="width: 18rem;">
                            <img src="https://static.wixstatic.com/media/30d63c_bb9cb5514b0546beafb671ec02cd2244~mv2.png/v1/fill/w_387,h_441,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/30d63c_bb9cb5514b0546beafb671ec02cd2244~mv2.png"
                                class="card-img-top" alt="..." height="348" width="1000">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the
                                    bulk of the card's content.</p>
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
