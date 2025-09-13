@extends('evs::layouts.master')

@section('title', 'Electeds')

@section('breadcrumb')
    <li class="breadcrumb-item active">
        <a href="{{ route('evs.admin.dashboard') }}"><i class="fas fa-calendar-alt"></i> {{ __('Electeds') }}</a>
    </li>
@endsection

@section('content')
    <!-- Main content -->
    <div class="content" >

        <div class="container-fluid">

            <div class="card card-purple card-outline shadow">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Electeds') }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="btns">
                        <a href="{{ route('evs.admin.electeds.add') }}" class="btn btn-primary"><i
                                class="fas fa-calendar-plus"></i> {{ __('Elected Add') }}</a>
                    </div>
                    <div class="mtop16">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Elección</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Num Votos</th>
                <th>Rol</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($electeds as $election)
                @foreach($election['candidates'] as $candidate)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $election['name'] ?? 'N/A' }}</td>

                        {{-- Nombre completo validando null --}}
                        <td>
                            {{ $candidate['person']['first_name'] ?? '' }}
                            {{ $candidate['person']['first_last_name'] ?? '' }}
                            {{ $candidate['person']['second_last_name'] ?? '' }}
                        </td>

                        {{-- Estado de la elección (o N/A si no existe) --}}
                        <td>{{ $election['status'] ?? 'N/A' }}</td>

                        {{-- Votos (si existe en el array) --}}
                        <td>{{ count($candidate['votes'])  ?? 0 }}</td>

                        {{-- Rol o cargo --}}
                        <td>{{ $candidate['job'] ?? 'N/A' }}</td>

                        {{-- Teléfono --}}
                        <td>{{ $candidate['person']['telephone1'] ?? 'No registrado' }}</td>

                        {{-- Correo --}}
                        <td>{{ $candidate['person']['personal_email'] ?? 'No registrado' }}</td>

                        {{-- Acciones --}}
                        <td>
                            <div class="opts">
                                <a href="#"
                                   data-toggle='tooltip' data-placement="top" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a class="btn-delete" href="#"
                                   data-action="delete"
                                   data-toggle='tooltip'
                                   data-placement="top"
                                   data-object="{{ $candidate['id'] ?? 0 }}"
                                   data-path="evs/admin/elected"
                                   title="Eliminar">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

    </div><!-- /.container-fluid -->
    <!-- /.content -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@stop
