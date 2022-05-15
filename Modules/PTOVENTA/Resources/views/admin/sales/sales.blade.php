@extends('ptoventa::layouts.master')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="#"> {{ trans('ptoventa::menu.Sales') }}</a></li>
@endsection
@section('content')
{{-- <div id="pntoventasales"></div> --}}
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-cafeto card-outline shadow">
                <div class="card-header text-muted border-bottom-0">
                    {{-- {/* { translator.trans('cafeto::menu.Sales') } */} --}}
                </div>
                <div class="card-body pt-0">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <form method="POST">
                                <input type="hidden" name="_token"
                                    />
                                <input value="" type="number"
                                    class="form-control" placeholder="Ingrese el documento."  name="search" required/>

                                <br/>
                                <div class="row justify-content-center">
                                    <div class="col-md-3">
                                        <input class="btn  btn-outline-primary" type="submit"  />
                                    </div>
                                </div>
                                <br/>
                                {{-- <span class="text-center">
                                    {props.isLoading && (
                                    <>
                                        <p class="loading">
                                            Loading...
                                        </p>
                                    </>
                                    )}
                                </span> --}}

                                {{-- <span style=" color: red ">
                                    {props.errorMsg && (
                                    <p class="errorMsg">
                                        {props.errorMsg}
                                    </p>
                                    )}
                                </span> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="invoice p-3 mb-3">
                {{-- {/* title row */} --}}
                <div class="row">
                    <div class="col-12">
                        <h4>
                            <i class="fas fa-shopping-cart"> Punto de venta</i>
                            <small class="float-right">
                                Fecha:
                            </small>
                        </h4>
                    </div>
                    {{-- {/* /.col */} --}}
                </div>
                {{-- {/* info row */} --}}

                <div class="row invoice-info">
                    <div class="col-sm-5 invoice-col">
                        <address>
                            <strong>CENTRO DE FORMACIÓN AGROINDUSTRIAL.</strong>
                            {{-- {/* <br />
                            Nit. 899.99934-1 */} --}}
                            <br />
                            Producción de Centro - SENA Empresa La Angostura
                            {{-- {/* <br />
                            Art 17 Decreto 1001 de 1997
                            <br /> */} --}}
                            {{-- {/* Email: info@almasaeedstudio.com */} --}}
                        </address>
                    </div>
                    {{-- {/* /.col */} --}}
                    <div class="col-sm-4 invoice-col">
                        <address>
                            <strong>Cliente</strong>
                            <br/> Nombre:

                            <br/>
                            Documento:
                            <br/>
                            {{-- {/* Phone: (555) 539-1037
                            <br /> */} --}}
                            {{-- {/* Email: john.doe@example.com */} --}}
                        </address>
                    </div>
                    {{-- {/* /.col */} --}}
                    <div class="col-sm-3 invoice-col">
                        <b>Factura N° 007612</b>
                        <br />
                        <br />
                    </div>
                    {{-- {/* /.col */} --}}
                </div>
                {{-- {/* /.row */}
                {/* Table row */} --}}
                <div class="row">
                    {{-- {/* {SearchProducts} */} --}}

                    <br />

                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="7">
                                        <div
                                            class="flex-grow-1 d-flex flex-column justify-content-center align-items-center">
                                            <span class="text-secondary">
                                                <em>No hay productos todavía</em>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                {{-- {/* /.row */}
                {/* this row will not appear when printing */} --}}
                <div class="row no-print">
                    <div class="col-12">
                        <form method="post" action="/register">
                            <input type="hidden" name="people_id" value={data.id} />
                            <input type="hidden" name="product_id" />
                            <input type="hidden" name="amount" />
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-print">Print</i>
                            </button>

                        </form>

                    </div>
                </div>
            </div>
            {{-- {/* /.invoice */}
            {/* /.col */}
            {/* /.row */}
            {/* /.container-fluid */} --}}
        </div>
    </div>
</div>


@endsection
@section('js')
{{-- <script>
    $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
        )}
</script> --}}
@endsection