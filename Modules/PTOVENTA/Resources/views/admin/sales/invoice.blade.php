@extends('ptoventa::layouts.master')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="#"> {{ trans('ptoventa::menu.Sales') }}</a></li>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <section class="invoice">

                <div class="row">
                    <div class="col-12">
                        <h2 class="page-header">
                            <i class="fas fa-globe"></i> AdminLTE, Inc.
                            <small class="float-right">Date: 2/10/2014</small>
                        </h2>
                    </div>

                </div>

                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        From
                        <address>
                            <strong>Admin, Inc.</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            Phone: (804) 123-5432<br>
                            Email: <a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                data-cfemail="5d34333b321d3c31303c2e3c3838392e2928393432733e3230">[email&#160;protected]</a>
                        </address>
                    </div>

                    <div class="col-sm-4 invoice-col">
                        To
                        <address>
                            <strong>John Doe</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            Phone: (555) 539-1037<br>
                            Email: <a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                data-cfemail="98f2f7f0f6b6fcf7fdd8fde0f9f5e8f4fdb6fbf7f5">[email&#160;protected]</a>
                        </address>
                    </div>

                    <div class="col-sm-4 invoice-col">
                        <b>Invoice #007612</b><br>
                        <br>
                        <b>Order ID:</b> 4F3S8J<br>
                        <b>Payment Due:</b> 2/22/2014<br>
                        <b>Account:</b> 968-34567
                    </div>

                </div>


                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Qty</th>
                                    <th>Product</th>
                                    <th>Serial #</th>
                                    <th>Description</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Call of Duty</td>
                                    <td>455-981-221</td>
                                    <td>El snort testosterone trophy driving gloves handsome</td>
                                    <td>$64.50</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Need for Speed IV</td>
                                    <td>247-925-726</td>
                                    <td>Wes Anderson umami biodiesel</td>
                                    <td>$50.00</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Monsters DVD</td>
                                    <td>735-845-642</td>
                                    <td>Terry Richardson helvetica tousled street art master</td>
                                    <td>$10.70</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Grown Ups Blue Ray</td>
                                    <td>422-568-642</td>
                                    <td>Tousled lomo letterpress</td>
                                    <td>$25.99</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="row">

                    <div class="col-6">
                        SENA
                    </div>

                    <div class="col-6">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Total:</th>
                                    <td>$265.24</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>

            </section>
        </div>
    </div>
</div>
@endsection

@section('js')
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script>
    window.addEventListener("load", window.print());
</script>
<script nonce="6a7cc110-f5af-4292-a399-12d3320148eb">
    (function(w,d){!function(a,e,t,r,z){a.zarazData=a.zarazData||{},a.zarazData.executed=[],a.zarazData.tracks=[],a.zaraz={deferred:[]};var s=e.getElementsByTagName("title")[0];s&&(a.zarazData.t=e.getElementsByTagName("title")[0].text),a.zarazData.w=a.screen.width,a.zarazData.h=a.screen.height,a.zarazData.j=a.innerHeight,a.zarazData.e=a.innerWidth,a.zarazData.l=a.location.href,a.zarazData.r=e.referrer,a.zarazData.k=a.screen.colorDepth,a.zarazData.n=e.characterSet,a.zarazData.o=(new Date).getTimezoneOffset(),a.dataLayer=a.dataLayer||[],a.zaraz.track=(e,t)=>{for(key in a.zarazData.tracks.push(e),t)a.zarazData["z_"+key]=t[key]},a.zaraz._preSet=[],a.zaraz.set=(e,t,r)=>{a.zarazData["z_"+e]=t,a.zaraz._preSet.push([e,t,r])},a.dataLayer.push({"zaraz.start":(new Date).getTime()}),a.addEventListener("DOMContentLoaded",(()=>{var t=e.getElementsByTagName(r)[0],z=e.createElement(r);z.defer=!0,z.src="/cdn-cgi/zaraz/s.js?z="+btoa(encodeURIComponent(JSON.stringify(a.zarazData))),t.parentNode.insertBefore(z,t)}))}(w,d,0,"script");})(window,document);
</script>

@endsection