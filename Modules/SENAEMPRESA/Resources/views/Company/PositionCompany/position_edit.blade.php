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
                            <form action="{{ route('cefa.cargo_editado', $position->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="requirement" class="form-label">Requisitos</label>
                                    <input type="text" name="requirement"
                                        value="{{ $position->requirement ?? old('requirement') }}" class="form-control"
                                        id="requirement" name="requirement" rows="3" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Descripción General</label>
                                    <input type="text" name="description"
                                        value="{{ $position->description ?? old('description') }}"</textarea
                                        class="form-control" id="description" name="description" rows="3"
                                        required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="state">Estado</label>
                                    <select class="form-control" id="state" name="state">
                                        <option value="activo" {{ $position->state === 'activo' ? 'selected' : '' }}>
                                            Activo</option>
                                        <option value="inactivo"
                                            {{ $position->state === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-success">Guardar cambios</button>
                                <a href="{{ route('cefa.cargos') }}" class="btn btn-danger btn-xl">Cancelar</a>
                            </form>
                        </div>
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
