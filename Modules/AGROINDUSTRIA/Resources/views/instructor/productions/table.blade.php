@extends('agroindustria::layouts.master')
@section('content')
    <h1 style="text-align: center">{{trans('agroindustria::labors.production')}}</h1>
    <div class="production" style="margin-left:20px; margin-right:20px;">
        <table id="table-production" class="table table-striped" style="width: 100%;">
            <thead>
                <tr>
                    <th>{{trans('agroindustria::labors.product')}}</th>
                    <th>{{trans('agroindustria::labors.quantity')}}</th>
                    <th>{{trans('agroindustria::labors.expirationDate')}}</th>
                    <th>{{trans('agroindustria::labors.lot')}}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($production as $p)                
                <tr>
                    <td>{{$p->element->name}}</td>
                    <td>{{$p->amount}}</td>
                    <td>{{$p->expiration_date}}</td>
                    <td>{{$p->lot_number}}</td>
                    <td>
                    <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detail{{$p->id}}">
                            {{trans('agroindustria::labors.details')}}
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="detail{{$p->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="details">{{trans('agroindustria::labors.productionDetails')}}</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">{{trans('agroindustria::labors.costs')}}:</th>
                                                    <td>{{ number_format($p->labor->price, 2, ',', '.') }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><hr></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">{{trans('agroindustria::labors.totalProduction')}}:</th>
                                                    <td>{{ number_format($p->amount * $p->element->price, 2, ',', '.') }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><hr></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">{{trans('agroindustria::labors.earnings')}}:</th>
                                                    <td>{{ number_format($p->element->price * $p->amount - $p->labor->price, 2, ',', '.') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@section('script')
@endsection
@endsection