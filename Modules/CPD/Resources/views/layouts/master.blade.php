<!DOCTYPE html>
<html lang="en">

<head>
    @include('cpd::layouts.partials.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        @include('cpd::layouts.partials.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('cpd::layouts.partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12" id="breadvar">
                            <ol class="breadcrumb float-sm-right text-white">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('cefa.cpd.home') }}">
                                        <i class="fas fa-seedling"></i>
                                        <b>CPD</b>
                                    </a>
                                </li>
                                @section('breadcrumb') @show
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            @section('content')@show
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        @include('cpd::layouts.partials.footer')
    </div>

    @include('cpd::layouts.partials.scripts')

    @section('scripts')@show
</body>

</html>
