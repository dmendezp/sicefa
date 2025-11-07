@extends('cefamaps::layouts.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('cefamaps.' . getRoleRouteName(Route::currentRouteName()) . '.dashboard') }}"><i class="fas fa-solid fa-user-tie"></i>
            {{ trans('cefamaps::environment.Breadcrumb_Environment') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('cefamaps.' . getRoleRouteName(Route::currentRouteName()) . '.config.environment.index') }}"><i
                class="nav-icon fas fa-solid fa-chalkboard-user"></i> {{ trans('cefamaps::environment.Breadcrumb_Active_Environment') }}</a>
    </li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-lightblue card-outline">
                        <div class="card-header">
                            <h3 class="m-0">{{ trans('cefamaps::environment.Title_Card_Environments') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="content table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ trans('cefamaps::environment.1T_Number') }}</th>
                                            <th>{{ trans('cefamaps::environment.1T_Name') }}</th>
                                            <th>{{ trans('cefamaps::environment.1T_Picture') }}</th>
                                            <th>{{ trans('cefamaps::environment.1T_Description') }}</th>
                                            <th>{{ trans('cefamaps::environment.1T_Farm') }}</th>
                                            <th>{{ trans('cefamaps::environment.1T_Productive_Units') }}</th>
                                            <th>{{ trans('cefamaps::environment.1T_Status') }}</th>
                                            <th>{{ trans('cefamaps::environment.1T_Environment_Type') }}</th>
                                            <th >{{ trans('cefamaps::environment.1T_Environment_Class') }}</th>
                                            <th>{{ trans('cefamaps::environment.1T_Environment_Page') }}</th>
                                            <th>
                                                <a href="{{ route('cefamaps.' . getRoleRouteName(Route::currentRouteName()) . '.config.environment.add') }}"
                                                    class="btn btn-success">
                                                    <i class="fa-solid fa-square-plus"></i>
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($environ as $env)
                                        <tr>
                                            @php
                                                $productiveUnitNames = [];
                                            @endphp
                                            @foreach ($env->environment_productive_units as $pro)
                                                @php
                                                    $productiveUnitNames[] = $pro->productive_unit->name;
                                                @endphp
                                            @endforeach
                                                <td>{{ $env->id }}</td>
                                                <td>{{ $env->name }}</td>
                                                <td><img src="{{ asset('modules/cefamaps/images/uploads/' . $env->picture) }}" width="100" height="100"></td>
                                                <td>{{ $env->description }}</td>
                                                <td>{{ $env->farm->name }}</td>
                                                <td>{{ implode('|',$productiveUnitNames) }}</td>
                                                <td>{{ $env->status }}</td>
                                                <!-- Inicio del modal pra las coordenadas -->
                                                <td class="col-1">
                                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                                        data-target="#modal-info-{{ $env->id }}">{{ $env->type_environment }}</button>
                                                    <div class="modal fade" id="modal-info-{{ $env->id }}">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content bg-info">
                                                                <div class="modal-header">
                                                                    <br>
                                                                    <!-- aqui va el nombre del punto  -->
                                                                    <h1 class="modal-title" style="center">
                                                                        {{ trans('cefamaps::environment.1M_Environment_Spot') }} : <em>{{ $env->name }}</em> </h1>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <i class="fa-solid fa-xmark"></i>
                                                                    </button>
                                                                </div>
                                                                <!-- Inicio del punto del mapa -->
                                                                <div class="container text-center">
                                                                    <div class="row align-items-start">
                                                                        <div class="col">
                                                                            <div class="modal-header">
                                                                                <h3 class="modal-title">
                                                                                    {{ trans('cefamaps::environment.1M_Label_Length_Environment') }}
                                                                                </h3>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <h5>{{ $env->length }}</h5>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="modal-header">
                                                                                <h3 class="modal-title">
                                                                                    {{ trans('cefamaps::environment.1M_Label_Latitude_Environment') }}
                                                                                </h3>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <h5>{{ $env->latitude }}</h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Fin del punto del mapa -->
                                                                <!-- aqui va el nombre del poligono -->
                                                                <h1 class="modal-title" style="center">
                                                                    {{ trans('cefamaps::environment.1M_Environment_Polygon') }} : <em>{{ $env->name }}</em></h1>
                                                                <div class="row align-items-center">
                                                                    <div class="col">
                                                                        <div class="modal-header">
                                                                            <h3 class="modal-title">
                                                                                {{ trans('cefamaps::environment.1M_Label_Length_Environment') }}
                                                                            </h3>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            @foreach ($env->coordinates as $c)
                                                                                <h5>{{ $c->length }}</h5>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="modal-header">
                                                                            <h3 class="modal-title">
                                                                                {{ trans('cefamaps::environment.1M_Label_Latitude_Environment') }}
                                                                            </h3>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            @foreach ($env->coordinates as $c)
                                                                                <h5>{{ $c->latitude }}</h5>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <!-- Fin del modal pra las coordenadas -->
                                                <td>{{ $env->class_environment->name }}</td>
                                                <!-- Inicio del ID para el filtro de las paginas -->
                                                <td>
                                                    <a class="btn btn-primary"
                                                        href="{{ url('/cefamaps/page/index?id=' . $env->id) }}">
                                                        <i class="fas fa-regular fa-file-lines"></i>
                                                    </a>
                                                </td>
                                                <!-- Fin del ID para el filtro de las paginas -->
                                                <!-- Inico para Editar y Eliminar -->
                                                <td>
                                                    <a href="{{ url('/cefamaps/' . getRoleRouteName(Route::currentRouteName()) . '/environment/edit/' . $env->id) }}"
                                                        class="btn btn-warning">
                                                        <i class="fas fa-map-signs"></i>
                                                    </a>
                                                    <a class="btn btn-danger delete-environment" href="#"
                                                        type="submit" data-action="delete"
                                                        data-object="{{ $env->id }}"
                                                        data-path="/cefamaps/' . getRoleRouteName(Route::currentRouteName()) . '/environment/delete/">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </td>
                                                <!-- Fin para Editar y Eliminar -->
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#example1').DataTable({
                order: [
                    [3, 'desc']
                ],
            });
        });
    </script>

    <script type="text/javascript">
        /*
          Para poder eliminar un Environment
        */
        $(document).ready(function() {
            $(document).on("click", ".delete-environment", function() {
                var id = $(this).data('object');
                var url = "{{ url('/cefamaps/' . getRoleRouteName(Route::currentRouteName()) . '/environment/delete/') }}/" + id;
                Swal.fire({
                    title: '{{ trans('cefamaps::environment.Title_Alert') }}',
                    text: '{{ trans('cefamaps::environment.Text_Alert') }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{ trans('cefamaps::unit.Btn_Accept') }}',
                    cancelButtonText: '{{ trans('cefamaps::unit.Btn_Cancel') }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url
                    }
                })
            })
        })
    </script>
@endsection
