@extends('hdc::layouts.master')

@section('content')
    <div class="col-md-12">
        <div class="card card-success card-outline shadow mt-2">
            <div class="card-header">
                <h2 class="card-title"><strong> Editar Consumo de {{--  {{ $personEnvironmentalAspect->family_person_footprint->person->full_name }}  --}} </strong>
                </h2>
            </div>
            <br>
            <div class="container">
                <div class="table-responsive">
                    <form method="post" action="{{ route('carbonfootprint.update_consumption', ['id' => $personEnvironmentalAspect->id]) }}">
                        @csrf
                        @method('POST')

                        <table class="table table-bordered table-hover" id="myTableform">
                            <thead class="table-dark">
                                <tr>
                                    <th>{{ trans('hdc::ConsumptionRegistry.Title_Heading_Table_Column1') }}</th>
                                    <th>{{ trans('hdc::ConsumptionRegistry.Title_Heading_Table_Column2') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allAspects as $aspect)
                                    <tr>
                                        <td>
                                            <input type="hidden" name="aspecto[{{ $aspect->id }}][id_aspecto]" value="{{ $aspect->id }}">
                                            {{ $aspect->name }}
                                        </td>
                                        <td>
                                            <input name="aspecto[{{ $aspect->id }}][valor_consumo]" class="form-control" type="number" value="{{ $personEnvironmentalAspect->consumption_value }}" placeholder="Ingrese el valor de consumo" required>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-around">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
