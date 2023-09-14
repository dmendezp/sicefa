@extends('agroindustria::layouts.master')
@section('content')

<div class="table_formulation">
    <table id="formulation" class="hover" style="width: 100%">
        <thead>
            <tr>
                <th>{{trans('agroindustria::formulations.Recipes')}}</th>
                <th>{{trans('agroindustria::formulations.Product Name')}}</th>
                <th>{{trans('agroindustria::formulations.Process')}}</th>
                <th>{{trans('agroindustria::formulations.Production Quantity')}}</th>
                <th>{{trans('agroindustria::formulations.Ingredients')}}</th>
                <th>{{trans('agroindustria::formulations.Amount')}}</th>
                <th>{{trans('agroindustria::formulations.Utencils')}}</th>
                <th>{{trans('agroindustria::formulations.Amount')}}</th>
                <th>
                    <a href="{{route('cefa.agroindustria.instructor.formulario')}}">
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
                <td>{{$f->person->first_name . ' ' . $f->person->first_last_name . ' ' . $f->person->second_last_name}}</td>
                <td>{{$f->element->name}}</td>
                <td>{{$f->proccess}}</td>
                <td>{{$f->amount}}</td>
                <td>
                    @foreach ($f->ingredients as $ingredient)
                        {{$ingredient->element->name}}<br>
                    @endforeach
                </td>
                <td>
                    @foreach ($f->ingredients as $ingredient)
                        {{$ingredient->amount}}<br>
                    @endforeach
                </td>
                <td>
                    @foreach ($f->utensils as $utensil)
                        {{$utensil->element->name}}<br>
                    @endforeach
                </td>
                <td>
                    @foreach ($f->utensils as $utensil)
                        {{$utensil->amount}}<br>
                    @endforeach
                </td>
                <td>
                    <a href="{{route('cefa.agroindustria.instructor.form.edit',  ['id' => $f->id])}}">
                        <button data-record-id="{{$f->id}}" class="btn btn-primary float-end mb-2 edit-button" style="width: 45px; height: 35px;">
                            <i class="fa-solid fa-pen-to-square fa-sm"></i>
                        </button>
                    </a>
                    <button type="submit"  style="width: 45px; height: 35px;"  class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$f->id}}">
                        <i class="fa-solid fa-trash fa-sm"></i>
                    </button>                   
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
