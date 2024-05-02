@extends('senaempresa::layouts.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <embed src="{{ asset('modules/senaempresa/manual/manual de usuario psicologo.pdf') }}" type="application/pdf"
                    width="100%" height="562px" />
            </div>
        </div>
    </div>
@endsection
