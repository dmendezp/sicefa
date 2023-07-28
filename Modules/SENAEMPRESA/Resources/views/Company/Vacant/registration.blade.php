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
        @include('senaempresa::layouts.structure.breadcrumb')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <div class="formulario">
                        <div class="card-header">{{ $title }}</div>

                        <div class="card-body">
                            {!! Form::open(['url' => route('Registros')]) !!}
                            <div class="mb-6">
                                <label for="document_number" class="form-label">Nombre</label>
                                {!! Form::number('document_number', null, ['class' => 'form-control']) !!}
                                <br>
                            </div>
                            <div class="mb-6">
                                <label for="document_number" class="form-label">Descripción General</label>
                                {!! Form::text('document_number', null, ['class' => 'form-control']) !!}
                                <br>
                            </div>
                            <div class="mb-6">
                                <label for="document_number" class="form-label">Requisitos</label>
                                {!! Form::text('document_number', null, ['class' => 'form-control']) !!}
                                <br>
                            </div>
                            <div class="mb-6">
                                <label for="document_number" class="form-label">Cupos</label>
                                {!! Form::text('document_number', null, ['class' => 'form-control']) !!}
                                <br>
                            </div>
                            <div class="mb-6">
                                <label for="document_number" class="form-label">Presentación</label><br>
                                {!! Form::file('document_number', null, ['class' => 'form-control']) !!}
                                <br><br>
                            </div>
                            {!! Form::submit('Agregar', ['class' => 'btn btn-success', 'name' => 'vacantes']) !!}
                            <a href="{{ route('vacantes') }}">
                                {!! Form::button('Cancelar', ['class' => 'btn btn-danger', 'name' => 'cancelar']) !!}
                            </a>
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
