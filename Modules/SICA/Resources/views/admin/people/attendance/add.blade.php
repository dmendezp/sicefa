

@extends('sica::layouts.master')

@section('stylesheet')
@endsection

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="card card-orange card-outline shadow col-md-12">
                <div class="card-header">
                    <h3 class="card-title">Agregar Datos</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body box-profile">



                    <form action="{{route('sica.attendance.people.basic_data.add')}}" method="post" id="submit">
                        @csrf
                    <input type="hidden" name="event_id" value="{{$event}}">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Nombres</label>
                                <input class="form-control" type="text" name="first_name" id="" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">Primer Apellido </label>
                                <input class="form-control" type="text" name="first_last_name" id="" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="">Segundo Apellido</label>
                                <input class="form-control" type="text" name="second_last_name" id="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Tipo Documento</label>
                                {!! Form::select('document_type', getEnumValues('people', 'document_type','required'),
                                null,['class' => 'form-control']
                                ,['placeholder' => 'Pick a size...']) !!}

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Número Documento </label>
                                <input class="form-control" type="text" name="document_number" value="{{$doc}}" id="" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Eps</label>
                                <select class="form-control" name="eps_id" id="">
                                   @foreach($eps as $e)
                                    <option value="{{$e->id}}">{{$e->name}}</option>
                                   @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Población de caracterización </label>
                                <select class="form-control" name="population_group_id" id="">
                                    @foreach($population_groups as $groups)
                                    <option value="{{$groups->id}}">{{$groups->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Registrar</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection

