@extends('sigac::layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="card card-blue card-outline shadow col-md-10">
                    <div class="card-header">
                        <h3 class="card-title">Consultar Novedades del Aprendiz</h3>
                    </div>
                    <div class="card-body">
                        <div class="form_search" id="form_search">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        {!! Form::label('apprentice_id', trans('Aprendiz')) !!}
                                        {!! Form::select('apprentice_id', [], null, [
                                            'class' => 'form-control',
                                            'id' => 'apprentice',
                                            'placeholder' => 'Ingrese el nombre',
                                            'required'
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="divResult">
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

        $('#apprentice').select2({
            placeholder: 'Consulte el Aprendiz por su Nombre',
            minimumInputLength: 3,
            ajax: {
                url: '{{ route('sigac.committee.searchapprentice') }}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term,
                    };
                },
                processResults: function(data) {
                    var results = data.map(function(item) {
                        return {
                            id: item.id,
                            text: item.text
                        };
                    });
                    return {
                        results: results
                    };
                },
                cache: true
            }
        });

        $('#apprentice').on('change', function () {
            var apprentice_id = $('#apprentice').val();
            $.ajax({
                    type: 'POST',
                    url: "{{ route('sigac.' . getRoleRouteName(Route::currentRouteName()) . '.committee.report.result') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        apprentice_id: apprentice_id
                    },
                    success: function(data) {
                        // Actualizar el contenedor con los resultados filtrados
                        console.log(data);
                        $('#divResult').html(data);
                        $('#table').DataTable({

                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
        });

        
    });
</script>


