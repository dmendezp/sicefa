@extends('hdc::layouts.master')

@section('content')
    <div class="col-md-12">
        <div class="card card-success card-outline shadow mt-2">
            <div class="card-header">
                <h2 class="card-title"><strong> {{ $person->full_name }} Registre los aspectos ambientales generados mensualmente en su casa </strong>
                </h2>
            </div>
            <br>
            <div class="container">
                <div class="table-responsive">
                    <form method="post" action="{{ route('Carbonfootprint.save_consumption') }}">

                        @csrf
                        <input type="hidden" name="person_id" value="{{ $person->id }}">

                        <table class="table table-bordered table-hover" id="myTableform">
                            <thead class="table-dark">
                                <tr>
                                    <th>{{ trans('hdc::ConsumptionRegistry.Title_Heading_Table_Column1') }}</th>
                                    <th>{{ trans('hdc::ConsumptionRegistry.Title_Heading_Table_Column2') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($environmentalAspects as $aspectId => $aspectName)
                                    <tr>
                                        <td>
                                            <input type="hidden" name="aspecto[{{ $aspectId }}][id_aspecto]"
                                                value="{{ $aspectId }}">
                                            {{ $aspectName }}
                                        </td>
                                        <td>
                                            <input name="aspecto[{{ $aspectId }}][valor_consumo]" class="form-control"
                                                type="number" placeholder="Ingrese el valor de consumo">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-around">
                            <button type="submit"
                                class="btn btn-success">{{ trans('hdc::ConsumptionRegistry.Btn_Save') }}</button>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection



