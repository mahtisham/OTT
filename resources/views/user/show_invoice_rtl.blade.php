<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> {{__('Invoice')}} | {{env('APP_NAME')}}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}"><!-- CSRF Token -->
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet">
  <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/> <!-- fontawsome css -->
  <!-- Admin (main) Style Sheet -->
  <link rel="stylesheet" href="{{asset('css/admin.css')}}">
</head>
<body class="hold-transition skin-blue sidebar-mini" style="background: #111">
<style>
  .table-bordered > thead > tr > th {
    text-align: right;
  }
</style>
@if (isset($invoice) && $invoice != null)

<section id="main-wrapper" class="main-wrapper invoice">
    <div id="printableArea" >
        <div class="container">
            <div class="panel-body">
                <div id="printableArea">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="">
                                @php
                                    $setting = App\Config::first();
                                @endphp
                                <div class="invoice-logo">
                                @if($setting->logo != NULL)
                                    <img src="{{ asset('images/logo/'.$setting['logo']) }}" class="img-fluid" alt="logo">
                                @else()
                                    <a href="{{ url('/') }}"><b><div class="logotext">{{ $setting['title'] }}</div></b></a>
                                @endif
                                </div>
                                <br>
                                <p class="total-heading">{{ __('Puchased on') }}: {{ date('jS F Y', strtotime($invoice['created_at'])) }}</p>
                            </div>
                            <hr/>
                        </div>
                        <!-- /.col -->
                    </div>

                    <!-- info row -->
                    <div class="row">
                        <div class="col-sm-4 col-md-4">
                        <b>{{__('From')}}:</b>
                        <address>
                            <strong>{{$setting->title}}</strong><br>
                            {{$invoice_add}}
                            {{__('Email')}}: {{$w_email}}
                        </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 col-md-4">
                        <b>{{__('To')}}:</b>
                        <address>
                            <strong>{{auth()->user()->name}}</strong><br>
                            {{__('Email')}}: {{auth()->user()->email}}
                        </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 col-md-4">
                            <b>{{__('Invoice')}}: </b> # {{$invoice->id}}<br>
                            <b>{{__('Order ID')}}:</b> {{$invoice->payment_id}}<br>
                            <b>{{__('Payment Mode')}}:</b> {{ucfirst($invoice->method)}}<br>
                            <b>{{__('Subscription End')}}:</b> {{date('jS F, Y', strtotime($invoice->subscription_to))}} <br/>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <br/>
                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('User Name')}}</th>
                                        <th>{{__('Package Name')}}</th>
                                        <th>{{__('Method')}}</th>
                                        <th>{{__('Line Total')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>{{auth()->user()->name}}</td>
                                        <td>{{$invoice->plan->name}}</td>
                                        <td>{{$invoice->method}}</td>
                                        <td>{{strtoupper($currency_code)}} {{$invoice->price}}</td>
                                    </tr>
                                    <tr style="background-color:#111;">
                                        <td colspan="3"></td>
                                        <td class="total-heading">{{__('Grand Total')}}</td>
                                        <td >{{strtoupper($currency_code)}} {{$invoice->price}}</td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                
                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-12">
                        <p class="lead">{{__('Payment Methods')}}:</p>
                        <img src="{{url('images/credit/visa.png')}}" alt="Visa">
                        <img src="{{url('images/credit/mastercard.png')}}" alt="Mastercard">
                        <img src="{{url('images/credit/american-express.png')}}" alt="American Express">
                        <img src="{{url('images/credit/paypal2.png')}}" alt="Paypal">
                    
                    
                        </div>
                        <!-- /.col -->
                        
                    </div>
                    <p style="margin-top: 10px;">
                        <div class="printbox col-12 text-justify">
                        <hr>
                       {{__('This is a computer-generated invoice and does not require a physical
                       signature.')}} <br>{{__('If you have any questions concerning this invoice, feel free to write
                        to us at our email address')}}. <br> 
                        </div>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="print-btn" style="margin-left:25px;">
        <input type="button" class="btn btn-primary"  onclick="printDiv('printableArea')" value="{{__('Print')}}">
        <a href="{{route('invoice.download',$invoice->id)}}" target="_blank" class="btn btn-success">{{ __('Download') }}</a>
    </div>
    
</section>
@endif


<!-- /.content -->
<div class="clearfix"></div>
<!-- ./wrapper -->
<script src="{{asset('js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/admin.js')}}" type="text/javascript"></script>

<script type="text/javascript">
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
     }
</script>
</body>
</html>
