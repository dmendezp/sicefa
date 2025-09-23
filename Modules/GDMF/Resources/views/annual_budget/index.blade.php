@extends('gdmf::layouts.master')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12"> {{-- Inicio Prsupuesto Anual --}}
                    <div class="card card-menta card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">Presupuesto Anual</h3>
                        </div>
                        <div class="card-body">
                            @include('gdmf::annual_budget.table')
                        </div>
                    </div>
                </div> {{-- Fin Prsupuesto Anual --}}

            </div>
        </div>
    </div>
@endsection
