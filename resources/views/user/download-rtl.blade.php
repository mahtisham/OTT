
<!DOCTYPE html>
<html  lang="en" dir="rtl">
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
  <link rel="stylesheet" href="{{url('css/admin.css')}}">
</head>
<body class="hold-transition skin-blue sidebar-mini" style="background: #111">
<style>
#main-wrapper {
    text-align: right;
}
table th,
table {
    text-align: right !important;
}
.printbox {
    text-align: right;
}
</style>
<!-- Main content -->

@if (isset($invoice) && $invoice != null)

<section id="main-wrapper" class="main-wrapper invoice ">
   
    <div class="container-fluid">
        <div class="panel-body">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="">
                        @php
                            $setting = App\Config::first();
                            
                            $image = 'images/logo/'.$setting['logo'];
                            // Read image path, convert to base64 encoding
                            
                            $imageData = base64_encode(@file_get_contents($image));
                            if($imageData){
                                $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                            }
                
                        @endphp
                        <div class="invoice-logo">
                        @if($setting->logo != NULL)
                            <img src="{{ $src }}" class="img-fluid" alt="logo">
                        @else
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
                <div class="col-xs-4 col-sm-4 col-md-4">
                <b>{{__('From')}}:</b>
                <address>
                    <strong>{{$setting->title}}</strong><br>
                    {{$invoice_add}}
                    {{__('Email')}}: {{$w_email}}
                </address>
                </div>
                <!-- /.col -->
                <div class="col-xs-4 col-sm-4 col-md-4">
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
                    <table class="table table-striped table-bordered">
                        <thead style="color:#48A3c6;">
                            <tr>
                                <th>#</th>
                                <th>{{__('User Name')}}</th>
                                <th>{{__('Package Name')}}</th>
                                <th>{{__('Method')}}</th>
                                <th>{{__('Line Total')}}</th>
                            </tr>
                        </thead>
                        <tbody style="margin-top: 10px;">
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
                    @php
                        $visaimage = 'images/credit/visa.png';
                            // Read image path, convert to base64 encoding
                        $visaimageData = base64_encode(@file_get_contents($visaimage));
                        if($visaimageData){
                            $visa_src = 'data: '.mime_content_type($visaimage).';base64,'.$visaimageData;
                        }
                        $mastercardimage = 'images/credit/mastercard.png';
                            // Read image path, convert to base64 encoding
                        $mastercardimageData = base64_encode(@file_get_contents($mastercardimage));
                        if($mastercardimageData){
                            $mastercard_src = 'data: '.mime_content_type($mastercardimage).';base64,'.$mastercardimageData;
                        }

                        $expressimage = 'images/credit/american-express.png';
                            // Read image path, convert to base64 encoding
                        $expressimageData = base64_encode(@file_get_contents($expressimage));
                        if($expressimageData){
                            $express_src = 'data: '.mime_content_type($expressimage).';base64,'.$expressimageData;
                        }

                        $paypal2image = 'images/credit/paypal2.png';
                            // Read image path, convert to base64 encoding
                        $paypal2imageData = base64_encode(@file_get_contents($paypal2image));
                        if($paypal2imageData){
                            $paypal2_src = 'data: '.mime_content_type($paypal2image).';base64,'.$paypal2imageData;
                        }
                    @endphp
                    
                    <p class="lead">{{__('Payment Methods')}}:</p>
                    <img src="{{$visa_src}}" alt="Visa">
                    <img src="{{$mastercard_src}}" alt="Mastercard">
                    <img src="{{$expressimage}}" alt="American Express">
                    <img src="{{$paypal2_src}}" alt="Paypal">
                </div>
            
                <!-- /.col -->
            </div>

            <p style="margin-top: 10px;">
                <div class="printbox col-12">
                    <hr>
                    {{__('This is a computer-generated invoice and does not require a physical
                    signature')}}. <br> {{__('If you have any questions concerning this invoice, feel free to write
                    to us at our email address')}}. <br> 
                  </div>
              </p>
        </div>
    </div>
</section>

@endif

<!-- /.content -->
<div class="clearfix"></div>
<!-- ./wrapper -->
<script src="{{asset('js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/admin.js')}}" type="text/javascript"></script>

</body>
</html>
