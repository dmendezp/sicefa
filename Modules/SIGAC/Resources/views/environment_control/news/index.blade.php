@extends('sigac::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12"> 
                    <div class="table-responsive">
                        <table id="news" class="display table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Programa</th>
                                    <th>Ambiente</th>
                                    <th>Novedades</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
        </div>
    </div>
@endsection

<script>
    $(document).ready(function() {
        $('#news').DataTable({

        });    
    });
</script>