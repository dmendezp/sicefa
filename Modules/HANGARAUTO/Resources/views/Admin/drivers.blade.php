@extends('hangarauto::layouts.master')
@push('breadcrumbs')
    <li class="breadcrumb-item active"><a href=""></a>{{ trans('hangarauto::drivers.Drivers') }}</li>
@endpush

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css">
@endsection

@section('content')
    <!-- Main Content --->
    <div class="container-fluid">
        <div class="row">
            <div class="col pt-4">
                <div class="card-header">
                    <h4>{{ trans('hangarauto::drivers.Drivers')}}</h4>
                </div><br>
                <a href="{{ route('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.drivers.create') }}">
                    <button type="button" class="btn btn-primary">{{ trans('hangarauto::drivers.Add Driver')}}</button>
                </a><br><br>
                <div class="card">
                    <div class="card-body">
                        <table id="travels" class="table table-striped table-bordered" style="width: 100%">
                            <thead>
                                <th>{{ trans('hangarauto::drivers.Name')}}</th>
                                <th>{{ trans('hangarauto::drivers.Document')}}</th>
                                <th>Email</th>
                                <th>{{ trans('hangarauto::drivers.Telephone')}}</th>
                                <th>{{ trans('hangarauto::drivers.Actions')}}</th>
                            </thead>
                            <tbody>
                                @foreach($drivers as $d)
                                    <tr>
                                        <td>{{$d->person->fullname}}</td>
                                        <td>{{$d->person->document_number}}</td>
                                        <td>{{$d->person->personal_email}}</td>
                                        <td>{{$d->person->telephone1}}</td>
                                        <td>
                                            <form action="{{ route('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.drivers.delete', $d->id) }}" method="post" id="formEliminar{{ $d->id }}">
                                                @csrf
                                                @method('DELETE')
    
                                                <button class="btn btn-danger btnEliminar" type="button" data-form-id="formEliminar{{ $d->id }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            <a href="{{ route('hangarauto.'. getRoleRouteName(Route::currentRouteName()) .'.drivers.edit', $d->id) }}" class="btn btn-primary btnUpdat">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
