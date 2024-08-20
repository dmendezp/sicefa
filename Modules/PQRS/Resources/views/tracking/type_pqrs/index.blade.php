@extends('pqrs::layouts.master')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <div class="card card-blue card-outline shadow col-md-12">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('pqrs::tracking.type_of_pqrs') }}</h3>            
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a href="#">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crear_tipoPQRS" title="{{ trans('pqrs::tracking.create_pqrs_type') }}">
                                    <i class="fas fa-plus-circle fa-fw"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                    <br>
                    <div class="mtop16">
                        <table id="type_pqrs" class="table table-striped" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Id</th>                    
                                    <th>{{ trans('pqrs::tracking.name') }}</th>
                                    <th>{{ trans('pqrs::tracking.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($type_pqrs as $tp)
                                    <tr>
                                        <td>{{ $tp->id }}</td>
                                        <td>{{ $tp->name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminar{{ $tp->id }}" title="{{ trans('pqrs::tracking.delete_pqrs_type') }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            @include('pqrs::tracking.type_pqrs.delete')
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
</div>
@include('pqrs::tracking.type_pqrs.create')
@endsection

@section('script')
<script>
   $("#type_pqrs").DataTable({
    'responsive' : true,
    'ordering' : false,
   });
</script>

@endsection