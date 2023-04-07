@extends('senaempresa::layouts.master')

@section('content')


<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{route('fingerPrint.import')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for=""> </label>
                    <input type="file" class="form-control-file" name="file" id="" placeholder=""
                        aria-describedby="fileHelpId">
                    <small id="fileHelpId" class="form-text text-muted">Anexa tu archivo</small>
                </div>
                <button type="submit" class="btn text-light" style="background-color:blue" >Importar</button>
            </form>

        </div>
    </div>
</div>

@foreach($asistencia as $a)

{{$a->person->first_name}} {{$a->person->first_last_name}} {{$a->Date_In_Exit}}<br>

@endforeach

@isset($message)
    alert($message);
@endisset




@endsection