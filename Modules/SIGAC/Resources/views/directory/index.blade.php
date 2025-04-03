@extends('sigac::layouts.master')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ trans('sigac::directory.List_Emails') }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="javascript:searchDirectory()" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 pr-3 pb-3">
                                    <div class="form-group">
                                        {!! Form::label('vinculacion', trans('sigac::directory.Bonding')) !!}
                                        {!! Form::select('vinculacion', $vinculacion, old('vinculacion'), ['class' => 'form-control select'],) !!}
                                    </div>
                                </div>
                                <div class="col-md-6 pr-3 pb-3">
                                    <div class="form-group">
                                        {!! Form::label('rol', trans('sigac::directory.Rol')) !!}
                                        {!! Form::select('rol', $employees, old('rol'), ['class' => 'form-control select'],) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-3 pb-3">
                                    <div class="form-group">
                                        {!! Form::label('profesion', trans('sigac::directory.Profession')) !!}
                                        {!! Form::select('profesion', $proffesions, old('profesion'), ['class' => 'form-control select'],) !!}
                                    </div>
                                </div>
                                <div class="col-md-6 pr-3 pb-3">
                                    <div class="form-group">
                                        <br>
                                        {!! Form::checkbox('lider', 1, null, ['id' => 'lider']) !!}
                                        {!! Form::label('lider', trans('sigac::directory.Leaders')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-search fa-fw"></i>
                                    {{ trans('sigac::directory.Search')}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div id="divDirectory">
        </div>
        <br>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $('.select').select2();
    });

    function searchDirectory() {
        var vinculacion = $('#vinculacion').val();
        var rol = $('#rol').val();
        var profesion = $('#profesion').val();
        var lider = $('#lider').is(":checked");

        if (vinculacion == "") {
            Swal.fire({
                title: 'Atención',
                text: 'Debe seleccionar la vinculación',
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#FF9966',
                confirmButtonText: 'Cerrar'
            });
            return;
        }

        $.ajax({
            type: 'POST',
            url: "{{ route('cefa.sigac.directory_search') }}",
            data: {
                _token: "{{ csrf_token() }}",
                vinculacion: vinculacion,
                rol: rol,
                profesion: profesion,
                lider: lider
            },
            success: function(data) {
                // Actualizar el contenedor con los resultados filtrados
                $('#divDirectory').html(data);
                $('#table').DataTable({});
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
</script>