@extends('pqrs::layouts.master')

@section('stylesheet')

<style>
    .email{
        position: relative;
        right: 290px;
    }

    .excel{
        position: relative;
        right: 580px;
    }

    .row-yellow{
        background-color: yellow !important;
    }

    .modal_answer{
        font-weight: bold;
    }

    .info{
        margin-bottom: 10px;
    }

    .filing_response{
        margin-top: 10px;
    }
</style>

@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <div class="card card-blue card-outline shadow col-md-12">
                <div class="card-header">
                    <div class="card-title">Filtrar por:</div>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        {!! Form::select('filter', $options, null, ['class' => 'form-control', 'id' => 'filter']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="table_tracking">
</div>

@endsection

@section('script')
<script>
    
    $(document).ready(function() {
       $('#filter').select2();
        var option = 'EN PROCESO';
        // Escuchar el cambio en el checkbox
        
        $.ajax({
            type: 'POST',
            url: "{{ route('pqrs.tracking.search') }}",
            data: {
                _token: "{{ csrf_token() }}",
                option: option
            },
            success: function(data) {
                console.log(data);
                // Actualizar el contenedor con los resultados filtrados
                $('#table_tracking').html(data);
                $("#tracking").DataTable({
                    'responsive' : true,
                    'ordering' : false,
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

        $('#filter').on('change', function () {
            var option = $('#filter').val();

            $.ajax({
                type: 'POST',
                url: "{{ route('pqrs.tracking.search') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    option: option
                },
                success: function(data) {
                    // Actualizar el contenedor con los resultados filtrados
                    $('#table_tracking').html(data);
                    $("#tracking").DataTable({
                        'responsive' : true,
                        'ordering' : false,
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>

@endsection