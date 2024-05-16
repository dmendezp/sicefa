@extends('pqrs::layouts.master')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <div class="card card-blue card-outline shadow col-md-12">
                <div class="card-header">
                    <h3 class="card-title">Seguimiento PQRS</h3>
                </div>
                <div class="card-body">
                    <table id="tracking" class="table table-striped" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
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

@section('script')
<script>
   $("#tracking").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
</script>

@endsection