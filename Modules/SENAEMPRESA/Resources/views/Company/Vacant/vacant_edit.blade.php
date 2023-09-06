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
                            <form action="{{ route('vacante_editado', ['id' => $vacancy->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $vacancy->name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Presentación</label><br>
                                    <input type="file" id="image" name="image">
                                </div>
                                <div class="mb-3">
                                    <label for="current_image" class="form-label">Imagen Actual</label><br>
                                    @if ($vacancy->image)
                                        <img src="{{ asset('storage/' . $vacancy->image) }}" alt="Imagen de la vacante"
                                            style="max-width: 300px;">
                                    @else
                                        <p>No hay imagen registrada.</p>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="description_general" class="form-label">Descripción General</label>
                                    <textarea class="form-control" id="description_general" name="description_general" rows="3">{{ $vacancy->description_general }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="requirement" class="form-label">Requisitos</label><br>
                                    <input type="text" class="form-control" id="requirement" name="requirement"
                                        value="{{ $vacancy->requirement }}">
                                </div>
                                <div class="mb-3">
                                    <label for="position_company_id" class="form-label">Id Cargo</label>
                                    <select class="form-control" name="position_company_id" id="position_company_id">
                                        @foreach ($positionCompany as $position)
                                            <option value="{{ $position->id }}"
                                                @if ($position->id === $vacancy->position_company_id) selected @endif>
                                                {{ $position->id }} {{ $position->description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="start_datetime" class="form-label">Fecha y Hora de Inicio</label>
                                    <input type="datetime-local" class="form-control" id="start_datetime"
                                        name="start_datetime" value="{{ $vacancy->start_datetime }}">
                                </div>
                                <div class="mb-3">
                                    <label for="end_datetime" class="form-label">Fecha y Hora de Fin</label>
                                    <input type="datetime-local" class="form-control" id="end_datetime"
                                        name="end_datetime" value="{{ $vacancy->end_datetime }}">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                                    <a href="{{ route('vacantes') }}" class="btn btn-danger btn-xl"
                                        id="cancelButton">Cancelar</a>
                                </div>
                            </form>
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
