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
                                <li class="breadcrumb-item active">Registrar</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->





            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        <div class="formulario">
                            <div class="card-header">{{ $title }}</div>

                            <div class="card-body">
                                {!! Form::open(['url' => route('Registros')]) !!}
                                <div class="mb-6">
                                    <label for="document_number" class="form-label">Documento</label>
                                    {!! Form::number('document_number', null, ['class' => 'form-control']) !!}
                                    <br>
                                </div>
                                <div class="mb-6">
                                    <label for="document_number" class="form-label">Nombre</label>
                                    {!! Form::text('document_number', null, ['class' => 'form-control']) !!}
                                    <br>
                                </div>
                                <div class="mb-6">
                                    <label for="document_number" class="form-label">Correo</label>
                                    {!! Form::text('document_number', null, ['class' => 'form-control']) !!}
                                    <br>
                                </div>
                                <div class="mb-6">
                                    <label for="document_number" class="form-label">Telefono</label>
                                    {!! Form::number('document_number', null, ['class' => 'form-control']) !!}
                                    <br>
                                </div>
                                <div class="mb-6">
                                    <label for="document_number" class="form-label">Fecha</label>
                                    {!! Form::date('document_number', null, ['class' => 'form-control']) !!}
                                    <br>
                                </div>
                                <div class="mb-6">
                                    <label for="document_number" class="form-label">Id Vacante</label>
                                    {!! Form::text('document_number', null, ['class' => 'form-control']) !!}
                                    <br>
                                </div>
                                <div class="mb-6">
                                    <label for="document_number" class="form-label">Hoja de vida</label><br>
                                    {!! Form::file('document_number', null, ['class' => 'form-control']) !!}
                                    <br><br>
                                </div>
                                {!! Form::submit('Postulación', ['class' => 'btn btn-success', 'name' => 'Postulación']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>
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
