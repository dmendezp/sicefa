<!DOCTYPE html>
<html lang="en">
@include('hdc::layouts.partials.head')

<body>
    @csrf
    <div class="wrapper">
        <!-- Navbar -->
        @include('hdc::layouts.partials.navbar')
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        @include('hdc::layouts.partials.aside')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
           
            <!-- /.content-header -->

            @section('content')
            @show

            <!-- Control Sidebar -->

            <!-- /.control-sidebar -->

        </div>

        <!-- Main Footer -->
        @include('hdc::layouts.partials.footer')

        @include('hdc::layouts.partials.scripts')

</body>

</html>
