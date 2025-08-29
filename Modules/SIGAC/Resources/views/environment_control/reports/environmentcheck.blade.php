@extends('sigac::layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="card card-blue card-outline shadow col-md-10">
                    <div class="card-header">
                        <h3 class="card-title">Consultar Chequeos de Ambiente</h3>
                    </div>
                    <div class="card-body">
                        <div class="form_search" id="form_search">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        {!! Form::label('environment_id', trans('Ambiente')) !!}
                                        {!! Form::select('environment_id', $environments, NULL, [
                                            'class' => 'form-control',
                                            'id' => 'environment',
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
    $(document).ready(function() {  
        $('#environment').select2();

        $('#environment').on('change', function () {
            var environment_id = $('#environment').val();
            $.ajax({
                    type: 'POST',
                    url: "{{ route('sigac.' . getRoleRouteName(Route::currentRouteName()) . '.environmentcontrol.check.report.result') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        environment_id: environment_id
                    },
                    success: function(data) {
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


