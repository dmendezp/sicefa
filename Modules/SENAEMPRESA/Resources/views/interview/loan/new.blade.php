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
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Starter Page</li>
                    </ol>
                    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ $title }}</div>

                <div class="card-body">

                    <div class="mb-6">
                        <label for="document_number" class="form-label">Documento</label>
                        {!! Form::number('document_number',null, ['class'=>'form-control']) !!}
                        <br>
                    </div>
                    <div class="mb-6">
                        <label for="document_number" class="form-label">Nombre</label>
                        {!! Form::text('document_number',null, ['class'=>'form-control']) !!}
                        <br>
                    </div>
                    <div class="mb-6">
                        <label for="document_number" class="form-label">Correo</label>
                        {!! Form::text('document_number',null, ['class'=>'form-control']) !!}
                        <br>
                    </div>
                    <div class="mb-6">
                        <label for="document_number" class="form-label">Telefono</label>
                        {!! Form::number('document_number',null, ['class'=>'form-control']) !!}
                        <br>
                    </div>
                    <div class="mb-6">
                        <label for="document_number" class="form-label">Fecha</label>
                        {!! Form::date('document_number',null, ['class'=>'form-control']) !!}
                        <br>
                    </div>
                    <div class="mb-6">
                        <label for="document_number" class="form-label">Id bpa</label>
                        {!! Form::text('document_number',null, ['class'=>'form-control']) !!}
                        <br>
                    </div>
                    {!! Form::submit('Agregar',['class' => 'btn btn-warning','name' => 'agregar']) !!}
                    {!! Form:: close() !!}
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
