@extends('bienestar::layouts.master')

@section('content')
<div class="container">
    <div class="container-fluid">
        <h1 class="mb-4">{{ trans('bienestar::consult.Consult_postulation') }}<i class="fas fa-search"></i></h1>
        <div class="row justify-content-md-center pt-4">
            <div class="card shadow col-md-8">
                <div class="card-body">
                    <div class="input-group mb-3">
                        <input type="number" name="search" class="form-control" placeholder="Ingrese su número el documento" id="search">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit" id="searchButtonassitance"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="divPostulation"></div>
</div>
<script>
    $(document).on("change", "#search", function() {
        performSearch();
    });

    $(document).on("click", "#searchButtonassitance", function(event) {
        event.preventDefault(); // Evitar el envío del formulario por defecto
        performSearch();
    });

    function performSearch() {
        var miObjeto = new Object();
        miObjeto = $('#search').val();
        var data = JSON.stringify(miObjeto);
        console.log(data);
        ajaxReplace('divPostulation', '/bienestar/callconsultation/search-postulation', data);
        
    }
</script>
@endsection