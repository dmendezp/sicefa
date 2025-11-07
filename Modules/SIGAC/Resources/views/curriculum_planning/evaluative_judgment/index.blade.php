@extends('sigac::layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="card card-blue card-outline shadow col-md-10">
                    <div class="card-header">
                        <h3 class="card-title">Consultar aprendices</h3>
                    </div>
                    <div class="card-body">
                        <div class="form_search" id="form_search">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        {!! Form::select('course_id', $courses, null, [
                                            'class' => 'form-control',
                                            'placeholder' => '-- Seleccione --',
                                            'id' => 'course_id',
                                            'height' => '38px',
                                        ]) !!}
                                    </div>
                                </div>
                                {{-- <div class="col-md-1">
                                    {!! Form::button('Busqueda avanzada', ['class' => 'btn btn-link btn-xs']) !!}
                                </div> --}}
                                <div class="col-md-2">
                                    <a class="btn btn-outline-secondary" href="{{ route('sigac.academic_coordination.curriculum_planning.evaluative_judgment.load.create') }}">Cargar Archivo</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="divApprentices">
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(function() {
        $('#course_id').select2();
    })

    $(document).ready(function() {
        $('#course_id').on('change', function () {
            var course_id = $('#course_id').val();
            $.ajax({
                    type: 'POST',
                    url: "{{ route('sigac.academic_coordination.curriculum_planning.evaluative_judgment.search') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        course_id: course_id
                    },
                    success: function(data) {
                        // Actualizar el contenedor con los resultados filtrados
                        $('#divApprentices').html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
        });

        
    });
</script>


