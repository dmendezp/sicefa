@extends('agroindustria::layouts.master')
@section('content')

<div class="container-sm">
    <table id="formulation" class="table table-striped" style="width: 100%">
        <thead>
            <tr>
                <th>{{trans('agroindustria::formulations.dateCreation')}}</th>
                <th>{{trans('agroindustria::formulations.Owner')}}</th>
                <th>{{trans('agroindustria::formulations.Product Name')}}</th>
                <th>{{trans('agroindustria::formulations.Production Quantity')}}</th>
                <th>
                    <a href="{{route('agroindustria.instructor.units.formulario')}}">
                        <button class="btn btn-success float-end mb-2">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($formulations as $f)        
            <tr>
                <td>{{$f->date}}</td>
                <td>{{$f->person->first_name . ' ' . $f->person->first_last_name . ' ' . $f->person->second_last_name}}</td>
                <td>{{$f->element->name}}</td>
                <td>{{$f->amount}}</td>
                <td>
                    <div class="d-flex justify-content-between">
                        <a href="{{route('agroindustria.instructor.units.formulations.details', ['id' => $f->id])}}">
                            <button class="btn btn-warning" style="width: 45px; height: 35px;">
                                <i class="fas fa-eye" style="color: #ffffff;"></i>
                            </button>
                        </a>
                        <div style="width: 5px;"></div>
                        <a href="{{route('agroindustria.instructor.units.form.edit',  ['id' => $f->id])}}">
                            <button data-record-id="{{$f->id}}" class="btn btn-primary edit-button" style="width: 45px; height: 35px;">
                                <i class="fa-solid fa-pen-to-square fa-sm"></i>
                            </button>
                        </a>
                        <div style="width: 5px;"></div>
                        <button type="submit" class="btn btn-danger" style="width: 45px; height: 35px;" data-bs-toggle="modal" data-bs-target="#delete{{$f->id}}">
                            <i class="fa-solid fa-trash fa-sm"></i>
                        </button>
                    </div>                
                    @include('agroindustria::instructor.formulations.delete')                
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@section('script')
@endsection
@endsection
