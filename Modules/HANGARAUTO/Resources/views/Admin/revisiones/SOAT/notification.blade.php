@extends('hangarauto::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item active">{{ trans('hangarauto::Soat.Soat') }}</li>
@endpush

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col pt-4">
                <div class="card-header">
                    <h4>{{ $title }}</h4>
                </div><br>
                <div class="card">
                    <div class="card-body">
                        <h5>Notificaciones de vencimiento de {{ $title }}</h5>
                        <table id="SoatTable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <th>#</th>
                                <th>{{ trans('hangarauto::Vehiculos.Vehicle') }}</th>
                                <th>{{ trans('hangarauto::Vehiculos.Responsability') }}</th>
                                <th>{{ trans('hangarauto::Vehiculos.Review Date') }}</th>
                                <th>{{ trans('hangarauto::Vehiculos.Expiration Date') }}</th>
                            </thead>
                            <tbody>
                                @foreach($notifications as $key => $notification)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $notification['vehicle'] }}</td>
                                        <td>{{ $notification['responsability'] }}</td>
                                        <td>{{ $notification['review_date'] }}</td>
                                        <td>{{ $notification['expiration_date'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection