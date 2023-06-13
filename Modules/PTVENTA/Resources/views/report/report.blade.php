@extends('ptventa::layouts.master')

@push('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('ptventa.report.report') }}" class="text-decoration-none">Reporte</a>
    </li>
    <li class="breadcrumb-item active">Reporte de inventario</li>
@endpush

@section('content')
<div class="row">
    <div class="col-sm-4 mb-3 mb-sm-0">
        <form action="{{ route('ptventa.report.report_results') }}" method="POST">
            @csrf
            <div class="card w-80 mb-3 card-success card-outline shadow-sm">
                <div class="card-body">
                    <label>Fecha inicial</label>
                    <input type="date" value="{{ old('fecha_ini')}}" id="fecha_ini" name="fecha_ini" class="form-control" required>

                    <label>Fecha final</label>
                    <input type="date" value="{{old('fecha_fin')}}" id="fecha_fin" name="fecha_fin" class="form-control" >
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Consultar</button>
                </div>
            </div>

        </form>
    </div>
    <div class="col-sm-8 mb-3 mb-sm-0">
        <div class="card w-80 mb-3 card-success card-outline shadow-sm">
            <div class="card-header">
                <div class="row">
                    <div class="col-11">
                        Reporte
                    </div>
                    <div class="col-1">
                        <a href="{{ route('ptventa.report.rpdf')}}" class="btn btn-danger btn-sm"> <strong>PDF</strong> </a>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">#</th>
                                <th class="text-center" scope="col">Comprobante</th>
                                <th scope="col">Producto</th>
                                <th class="text-center" scope="col">Fecha</th>
                                <th class="text-center" scope="col">Precio</th>
                                <th class="text-center" scope="col">Cantidad</th>
                                <th class="text-center" scope="col">SubTotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-center">123</td>
                                <td>YOGURT DE MORA X 25ML</td>
                                <td class="text-center">08/06/2023</td>
                                <td class="text-center">2000</td>
                                <td class="text-center">5</td>
                                <td class="text-center">10000</td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td class="text-center">456</td>
                                <td>DONA DE CHOCOLATE X 50GR</td>
                                <td class="text-center">10/05/2023</td>
                                <td class="text-center">1000</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10000</td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td class="text-center">789</td>
                                <td>QUESILLO X 100GR</td>
                                <td class="text-center">01/04/2023</td>
                                <td class="text-center">4000</td>
                                <td class="text-center">10</td>
                                <td class="text-center">40000</td>
                            </tr>
                            <tr>
                                <td class="text-center">4</td>
                                <td class="text-center">398</td>
                                <td>SALCHICHON X 300GR</td>
                                <td class="text-center">11/06/2023</td>
                                <td class="text-center">10000</td>
                                <td class="text-center">20</td>
                                <td class="text-center">200000</td>
                            </tr>
                            <tr>
                                <td class="text-center">5</td>
                                <td class="text-center">739</td>
                                <td>PAN DE YUCA X 20GR</td>
                                <td class="text-center">03/05/2023</td>
                                <td class="text-center">1000</td>
                                <td class="text-center">30</td>
                                <td class="text-center">30000</td>
                            </tr>
                            <tr>
                                <td class="text-center">6</td>
                                <td class="text-center">013</td>
                                <td>NECTAR DE GUANABANA X 30ML</td>
                                <td class="text-center">24/05/2023</td>
                                <td class="text-center">1500</td>
                                <td class="text-center">30</td>
                                <td class="text-center">45000</td>
                            </tr>
                            <tr>
                                <td class="text-center">7</td>
                                <td class="text-center">519</td>
                                <td>ARROZ CON LECHE X 70GR</td>
                                <td class="text-center">29/05/2023</td>
                                <td class="text-center">2000</td>
                                <td class="text-center">10</td>
                                <td class="text-center">20000</td>
                            </tr>
                            <tr>
                                <td class="text-center">8</td>
                                <td class="text-center">017</td>
                                <td>SEVILLANA X 25ML</td>
                                <td class="text-center">08/06/2023</td>
                                <td class="text-center">1500</td>
                                <td class="text-center">20</td>
                                <td class="text-center">30000</td>
                            </tr>
                            <tr>
                                <td class="text-center">9</td>
                                <td class="text-center">823</td>
                                <td>FIGURAS DE CHOCOLATE X 10GR</td>
                                <td class="text-center">18/04/2023</td>
                                <td class="text-center">800</td>
                                <td class="text-center">30</td>
                                <td class="text-center">24000</td>
                            </tr>
                            <tr>
                                <td class="text-center">10</td>
                                <td class="text-center">193</td>
                                <td>PAN X 10GR</td>
                                <td class="text-center">04/06/2023</td>
                                <td class="text-center">1000</td>
                                <td class="text-center">50</td>
                                <td class="text-center">50000</td>
                            </tr>
                            <tr>
                                <td colspan="5"></td>
                                <th>Total:</th>
                                <td>459000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
  @endsection

@include('ptventa::layouts.partials.plugins.datatables')
@push('scripts')
<script>
    window.onload = function(){
        var fecha = new Date(); //fecha actual
        var mes = fecha.getMonth()+1; //obteniendo mes
        var dia = fecha.getDate(); //obteniendo dia
        var ano = fecha.getFullYear(); //obteniendo año
        if(dia<10)
          dia='0'+dia; //agregar cero si es menor de 10
        if(mes<10)
          mes='0'+mes; //agregar cero si es menor de 10
        document.getElementById('fecha_fin').value=ano+"-"+mes+"-"+dia;

    }
</script>
@endpush
