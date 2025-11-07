{{-- CRUD Parametro Recurso --}}
<div class="card">
    <div class="card-header">
        {{ trans('hdc::parameters.resource')}}
        <button class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#crearrecurso"><i class="fas fa-add"></i>
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-striped" style="font-size: 0.9rem;">
                <thead>
                    <tr>
                        <th class="col-1">#</th>
                        <th class="col-2">{{ trans('hdc::parameters.1T_Name') }}</th>
                        @auth
                            @if (Auth::user()->havePermission('hdc.' . getRoleRouteName(Route::currentRouteName()) . '.parameter'))
                                <th class="col-2">{{ trans('hdc::parameters.1T_Actions') }}</th>
                            @endif
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @foreach($resource as $r)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $r->name}}</td>
                            @auth
                                @if (Auth::user()->havePermission('hdc.' . getRoleRouteName(Route::currentRouteName()) . '.parameter'))
                                    <td>
                                        <button class="btn btn-primary btn-sm btn-edit-aspect" data-bs-toggle="modal"
                                            data-bs-target="#editarrecurso_{{ $r->id }}"
                                            data-recurso-name="{{ $r->name }}"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="btn btn-danger btn-sm btn-delete-aspect" data-externalactivity-id="{{ $r->id }}"><i class="fas fa-trash-alt"></i></button>

                                        <form id="delete-externalactivity-form-{{ $r->id }}"
                                            action="{{ route('hdc.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.resource.destroy', ['id' => $r->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                @endif
                            @endauth
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<br>

{{-- Modal recurso --}}
<div class="modal fade" id="crearrecurso" tabindex="-1" aria-labelledby="crearrecurso" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarAsisteciaModalLabel">{{ trans('hdc::parameters.Modal_Add_Resource') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'hdc.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.resource.store', 'method' => 'POST']) !!}
                @csrf
                <div class="form-group">
                    {!! Form::label('name', trans('hdc::parameters.Modal_Name')) !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre del recurso']) !!}
                </div>
                <br>
                {!! Form::submit(trans('hdc::parameters.Btn_add_resource'), ['class' => 'btn btn-success']) !!}
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>

@foreach($resource as $r)
    {{-- Modal editar recurso Ambiental --}}
    <div class="modal fade" id="editarrecurso_{{$r->id}}" tabindex="-1" aria-labelledby="editarrecurso" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarAsisteciaModalLabel">{{ trans('hdc::parameters.Edit_Resource') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'hdc.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.resource.update', 'method' => 'POST']) !!}
                    @csrf
                    <div class="form-group">
                        {!! Form::hidden('id', $r->id) !!}
                        {!! Form::label('name', trans('hdc::parameters.1T_Name')) !!}
                        {!! Form::text('name', $r->name, ['class' => 'form-control', 'placeholder' => 'Nombre del recurso ambiental']) !!}
                    </div>
                    <br>
                    {!! Form::submit(trans('hdc::parameters.Btn_save_resource'), ['class' => 'btn btn-success']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endforeach

<script>
    $(document).ready(function() {
            $('.btn-delete-aspect').on('click', function(event) {
            var external_activity_id = $(this).data('externalactivity-id');

            // Mostrar SweetAlert para confirmar la eliminación
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción no se puede deshacer.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, enviar el formulario de eliminación
                    document.getElementById('delete-externalactivity-form-' + external_activity_id).submit();
                }
            });
        });
    });
    
</script>