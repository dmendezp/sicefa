@extends('agroindustria::layouts.master')
@section('content')
    <h1 style="text-align: center">Producción</h1>
    <div class="production" style="margin-left:20px; margin-right:20px;">
        <table id="table-production" class="table table-striped" style="width: 100%;">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Fecha Expiración</th>
                    <th>Lote</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($production as $p)                
                <tr>
                    <td>{{$p->element->name}}</td>
                    <td>{{$p->amount}}</td>
                    <td>{{$p->expiration_date}}</td>
                    <td>{{$p->lot}}</td>
                    <td>
                    <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Detalles
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Detalles de Produccion</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                
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