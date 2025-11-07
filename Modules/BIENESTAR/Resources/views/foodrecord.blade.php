@extends('bienestar::layouts.master')

@section('content')
<div class="container-fluid">
    <h1>{{ trans('bienestar::menu.List of Affiliated Trainees')}} <i class="fas fa-pizza-slice"></i></h1>
    <div class="row justify-content-md-center pt-4">
        <div class="card shadow col-md-8">
            <div class="card-body">


                <!-- Cuadro con la tabla -->
                <div class="table-responsive">
                    <table id="datatable" class="table mt-4" style="width:100%">
                        <thead>
                            <tr>
                                <th>{{ trans('bienestar::menu.Apprentice')}}</th>
                                <th>{{ trans('bienestar::menu.Number Document')}}</th>
                                <th>{{ trans('bienestar::menu.Code')}}</th>
                                <th>{{ trans('bienestar::menu.Beneficiary')}}</th> 
                                <th>{{ trans('bienestar::menu.Percentage')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($AssistancesFoods as $assistance)
                            <tr>
                                <td>{{ $assistance->first_name }} {{ $assistance->first_last_name }}</td>
                                <td>{{ $assistance->document_number }}</td>
                                <td>{{ $assistance->code }}</td>
                                <td>{{ $assistance->name }}</td>
                                <td> {{ $assistance->porcentege }}</td>
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