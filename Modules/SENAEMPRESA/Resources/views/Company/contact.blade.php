<!DOCTYPE html>
<html lang="en">
@include('senaempresa::layouts.structure.head')
<link href="{{ asset('senaempresa/css/contact.css') }}" rel="stylesheet">


<body>
    @csrf
    <div class="wrapper">

        <!-- Navbar -->
        @include('senaempresa::layouts.structure.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('senaempresa::layouts.structure.aside')
        @include('senaempresa::layouts.structure.breadcrumb')
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <div class="card rounded">
                        <div class=" d-block justify-content-center">
                            <div class="area1 p-3 py-5"> </div>
                            <div class="area2 p- text-center px-3">
                                <div class="image mr-3"> <img
                                        src="https://static.wixstatic.com/media/30d63c_bb9cb5514b0546beafb671ec02cd2244~mv2.png/v1/fill/w_387,h_441,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/30d63c_bb9cb5514b0546beafb671ec02cd2244~mv2.png"
                                        class="rounded-circle" width="100" />
                                    <h4 class=" name mt-3 ">Junior Medina</h4>
                                    <p class="information mt-3 text-center">Web designer and developer</p>
                                    <div class="d-flex justify-content-center mt-5">
                                        <ul class="list-icons">
                                            <li class="facebook"> <i class="fab fa-facebook"></i></li>
                                            <li class="youtube"> <i class="fab fa-youtube"></i></li>
                                            <li class="instagram"> <i class="fab fa-instagram"></i></li>
                                            <li class="whatsapp"> <i class="fab fa-whatsapp"></i></li>
                                            <li class="pinterest"> <i class="fab fa-pinterest"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card rounded">
                        <div class=" d-block justify-content-center">
                            <div class="area1 p-3 py-5"> </div>
                            <div class="area2 p- text-center px-3">
                                <div class="image mr-3"> <img
                                        src="https://static.wixstatic.com/media/30d63c_bb9cb5514b0546beafb671ec02cd2244~mv2.png/v1/fill/w_387,h_441,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/30d63c_bb9cb5514b0546beafb671ec02cd2244~mv2.png"
                                        class="rounded-circle" width="100" />
                                    <h4 class=" name mt-3 ">Diego Penagos</h4>
                                    <p class="information mt-3 text-center">Web designer and developer</p>
                                    <div class="d-flex justify-content-center mt-5">
                                        <ul class="list-icons">
                                            <li class="facebook"> <i class="fab fa-facebook"></i></li>
                                            <li class="youtube"> <i class="fab fa-youtube"></i></li>
                                            <li class="instagram"> <i class="fab fa-instagram"></i></li>
                                            <li class="whatsapp"> <i class="fab fa-whatsapp"></i></li>
                                            <li class="pinterest"> <i class="fab fa-pinterest"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card rounded">
                        <div class=" d-block justify-content-center">
                            <div class="area1 p-3 py-5"> </div>
                            <div class="area2 p- text-center px-3">
                                <div class="image mr-3"> <img
                                        src="https://static.wixstatic.com/media/30d63c_bb9cb5514b0546beafb671ec02cd2244~mv2.png/v1/fill/w_387,h_441,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/30d63c_bb9cb5514b0546beafb671ec02cd2244~mv2.png"
                                        class="rounded-circle" width="100" />
                                    <h4 class=" name mt-3 ">Jary Garay</h4>
                                    <p class="information mt-3 text-center">Web designer and developer</p>
                                    <div class="d-flex justify-content-center mt-5">
                                        <ul class="list-icons">
                                            <li class="facebook"> <i class="fab fa-facebook"></i></li>
                                            <li class="youtube"> <i class="fab fa-youtube"></i></li>
                                            <li class="instagram"> <i class="fab fa-instagram"></i></li>
                                            <li class="whatsapp"> <i class="fab fa-whatsapp"></i></li>
                                            <li class="pinterest"> <i class="fab fa-pinterest"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div> </div>
                            </div>
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
