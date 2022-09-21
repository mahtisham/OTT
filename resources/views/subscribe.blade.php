@extends('layouts.theme')
@section('title',__('Subscribe'))
@section('main-wrapper')
<section id="main-wrapper" class="main-wrapper user-account-section stripe-content">
  <div class="container-fluid">
    <h3 class="payment-title">{{__('Payment Information')}}</h3><br/>
    <div class="row panel-setting-main-block">
      <div class="col-md-4 col-sm-12">
        <div class="package_information">
          <div class="panel-default">
            <div class="panel-heading">{{__('Purchase Package Information')}}</div>
            <div class="panel-body">
             
              <table class="table">
                <tr>
                  <th>{{__('Package Name')}}</th>
                  <td>{{$plan->name}}</td>
                </tr>
                <tr>
                  <th>{{__('Amount')}}</th>
                  <td><i class="{{ $plan->currency_symbol }}"></i> {{number_format(($plan->amount) / ($plan->interval_count),2)}} @if(Session::has('current_currency'))({{ currency($plan->amount, $from = $plan->currency, $to = Session::has('current_currency') ? ucfirst(Session::get('current_currency')) : $plan->currency, $format = true) }} {{ __('Equivalent to your Currency')}})@endif</td>
                </tr>
                @if(Session::has('coupon_applied'))
                <tr>
                  <th>{{__('Coupon')}} - (<b>{{ucfirst(Session::get('coupon_applied')['code'])}}</b>)</th>
                  <td><i class="{{ $plan->currency_symbol }}"></i> {{Session::get('coupon_applied')['amount'] }} OFF</td>
                </tr>

                <tr>
                  <th>{{__('Total Amount')}}</th>
                  <td><i class="{{ $plan->currency_symbol }}"></i> {{$plan->amount - Session::get('coupon_applied')['amount'] }} /  {{$plan->interval}} @if(Session::has('current_currency'))({{ currency($plan->amount - Session::get('coupon_applied')['amount'], $from = $plan->currency, $to = Session::has('current_currency') ? ucfirst(Session::get('current_currency')) : $plan->currency, $format = true) }} {{ __('Equivalent to your Currency')}}) @endif</td>
                </tr>
                @endif
                @if(!Session::has('coupon_applied'))
                <tr>
                  <th>{{__('Duration')}}</th>
                  <td>
                    <i class="{{$plan->currency_symbol}}"></i> {{number_format(($plan->amount) / ($plan->interval_count),2)}}/
                    {{$plan->interval}} @if(Session::has('current_currency')) ({{ currency($plan->amount, $from = $plan->currency, $to = Session::has('current_currency') ? ucfirst(Session::get('current_currency')) : $plan->currency, $format = true) }} {{ __('Equivalent to your Currency')}}) @endif</td>
                </tr>
              @endif
              </table>
            </div>
          </div>
        </div>
      </div>
    
      <div class="col-md-8 col-sm-12">
       &nbsp;
        <div class="col-md-4 col-sm-4 col-xs-12"> <!-- required for floating -->
          <!-- Nav tabs -->
          &nbsp;
          <ul class="nav nav-tabs tabs-left sideways">
            
            <!-- stripe tab -->
            @if (isset($stripe_payment) && $stripe_payment == 1 && in_array('stripe',$currency_payments))
              <li class="active"><a href="#stripe" data-toggle="tab">{{ __('Check out With') }} Stripe</a></li>
            @endif
            <!-- end stripe -->

            <!-- paypal tree -->
            @if (isset($paypal_payment) && $paypal_payment == 1 && in_array('paypal',$currency_payments))
              <li><a href="#paypal" data-toggle="tab">{{ __('Check out With') }} Paypal !</a></li>
            @endif
            <!-- paypal end -->

            <!-- braintree tab -->
            @if(isset($braintree) && $braintree==1 && in_array('braintree',$currency_payments))
              <li><a href="#braintree" data-toggle="tab">{{ __('Check out With') }} Braintree</a></li>
            @endif
            <!-- end braintree -->

            @if(isset($payhere_payment) && $payhere_payment == 1 && in_array('payhere',$currency_payments))
            <!-- payhere tab -->
              <li><a href="#payhere" data-toggle="tab">{{ __('Check out With') }} PayHere</a></li>
            <!-- payhere end tab -->
            @endif

            <!-- coinpayment tab -->
            @if(isset($coin_payment) && $coin_payment == 1 && in_array('coinpay',$currency_payments))
              <li><a href="#coinpay" data-toggle="tab">{{ __('Check out With') }} CoinPayment</a></li>
            @endif
              <!-- end coin payment -->

            <!-- Mollie tab -->
            @if (isset($mollie_payment) && $mollie_payment == 1 && in_array('mollie',$currency_payments))
              <li><a href="#mollie" data-toggle="tab">{{ __('Check out With') }} Mollie</a></li>
            @endif
            <!-- end Mollie -->

            <!-- Cashfree tab -->
            @if (isset($cashfree_payment) && $cashfree_payment == 1 && in_array('cashfree',$currency_payments))
              <li><a href="#cashfree" data-toggle="tab">{{ __('Check out With') }} Cashfree</a></li>
            @endif
            <!-- end cashfree -->

           
            <!-- payu tab -->
            @if (isset($payu_payment) && $payu_payment == 1 && in_array('payu',$currency_payments))
              <li><a href="#payu" data-toggle="tab">{{ __('Check out With') }} PayUmoney !</a></li>
            @endif
          
            <!-- end payu tab -->

            <!-- Paytm tab-->
            @if (isset($paytm_payment) && $paytm_payment == 1 && in_array('paytm',$currency_payments))
              <li><a href="#paytm" data-toggle="tab">{{ __('Check out With') }} Paytm</a></li>
            @endif
            <!-- end paytm-->

            <!-- Razorpay tab-->
            @if (isset($razorpay_payment) && $razorpay_payment == 1 && in_array('razorpay',$currency_payments))
              <li><a href="#razorpay" data-toggle="tab">{{ __('Check out With') }} Razorpay</a></li>
            @endif
            <!-- end razorpay-->

            <!-- Instamojo tab-->
            @if (isset($instamojo_payment) && $instamojo_payment == 1 && in_array('instamojo',$currency_payments))
              <li><a href="#instamojo" data-toggle="tab">{{ __('Check out With') }} Instamojo</a></li>
            @endif
            <!-- end instamojo-->
           
            <!-- Paystack Tab -->
            @if(isset($paystack) && $paystack == 1 && in_array('paystack',$currency_payments))
              <li><a href="#paystack" data-toggle="tab">{{ __('Check out With') }} Paystack</a></li>
            @endif
            <!-- flutterrave tab-->
            @if(isset($flutterrave_payment) && $flutterrave_payment == 1 && in_array('flutterrave',$currency_payments))
              <li><a href="#flutterrave" data-toggle="tab">{{ __('Check out With') }} Flutterrave</a></li>
            @endif
            <!-- end flutterrave tab-->
           
            <!-- omise tab -->
            @if (isset($omise_payment) && $omise_payment == 1 && in_array('omise',$currency_payments))
              <li class=""><a href="#omise" data-toggle="tab">{{ __('Check out With') }} Omise</a></li>
            @endif
            <!-- end omise -->
           

            @if (isset($manualpaymentmethod)) 
              @foreach($manualpaymentmethod as $mpm)
              <li><a href="#{{str_slug($mpm->payment_name, '-')}}" data-toggle="tab">{{ __('Check out With') }} {{$mpm->payment_name}}</a></li>
              @endforeach
            @endif

            @if (isset($bankdetails) && $bankdetails == 1 && in_array('bankdetail',$currency_payments)) 
              <li><a href="#bankdetails" data-toggle="tab">{{ __('Check out With') }} {{ __('Bank Transfer') }}</a></li>
            @endif


            @if (isset($walletsetting) && $walletsetting->enable_wallet == 1) 
              <li><a href="#wallet" data-toggle="tab">{{ __('Check out With') }} {{ __('Wallet') }}</a></li>
            @endif

              <!-- AuthorizeNet tab -->
              @if(config('authorizenet.ENABLE') == 1 && Module::has('AuthorizeNet') && Module::find('AuthorizeNet')->isEnabled())
              @include("authorizenet::front.list")
            @endif
            <!-- end AuthorizeNet -->

            <!-- Bkash tab -->
            @if(config('bkash.ENABLE') == 1 && Module::has('Bkash') && Module::find('Bkash')->isEnabled())
              @include("bkash::front.list")
            @endif
            <!-- end Bkash -->

            <!-- DPO tab -->
            @if(config('dpopayment.enable') == 1 && Module::has('DPOPayment') && Module::find('DPOPayment')->isEnabled())
              @include("dpopayment::front.list")
            @endif
            <!-- end DPO -->

            <!-- Esewa -->
            @if(config('esewa.ENABLE') == 1 && Module::has('Esewa') && Module::find('Esewa')->isEnabled())
              @include("esewa::front.list")
            @endif
            <!-- End Esewa -->

            <!-- Midtrains -->
            @if(config('midtrains.ENABLE') == 1 && Module::has('Midtrains') && Module::find('Midtrains')->isEnabled())
              @include("midtrains::front.list")
            @endif
            <!-- End Midtrains -->

            <!-- Mpesa -->
            @if(config('mpesa.ENABLE') == 1 && Module::has('MPesa') && Module::find('MPesa')->isEnabled())
              @include("mpesa::front.list")
            @endif
            <!-- End Mpesa -->

            <!-- Paytab -->
            @if(config('paytab.ENABLE') == 1 && Module::has('Paytab') && Module::find('Paytab')->isEnabled())
              @include("paytab::front.list")
            @endif
            <!-- End Paytab -->

            <!-- Senangpay -->
            @if(config('senangpay.ENABLE') == 1 && Module::has('Senangpay') && Module::find('Senangpay')->isEnabled())
              @include("senangpay::front.list")
            @endif
            <!-- End Senangpay -->

            <!-- Smanager -->
            @if(config('smanager.ENABLE') == 1 && Module::has('Smanager') && Module::find('Smanager')->isEnabled())
              @include("smanager::front.list")
            @endif
            <!-- End Smanager -->

            <!-- SquarePay -->
            @if(config('squarepay.ENABLE') == 1 && Module::has('SquarePay') && Module::find('SquarePay')->isEnabled())
              @include("squarepay::front.list")
            @endif
            <!-- End SquarePay -->

            <!-- Worldpay -->
            @if(config('worldpay.ENABLE') == 1 && Module::has('Worldpay') && Module::find('Worldpay')->isEnabled())
              @include("worldpay::front.list")
            @endif
            <!-- End Worldpay -->
          </ul>
        </div>
        <br/>

        <div class="col-md-8 col-sm-8 col-xs-12">
          <!-- Tab panes -->
          &nbsp;
          <h4 class="heading"><a href="{{url('account')}}">{{ __('Pay') }} &nbsp;<i class="{{ $currency_symbol }}"></i> {{ $plan->amount }} {{ __('pay_method') }}</a></h4>
          <hr/>
        @php
          $session_amount = Session::has('coupon_applied') ? Session::get('coupon_applied')['amount'] : 0
        @endphp
          <div class="row">
              @if(Session::has('success'))
            
                <div class="alert alert-success">
                  {{Session::get('success')}}
                </div>

               @endif
                @if(Session::has('deleted'))
                
                <div class="alert alert-danger">
                  {{Session::get('deleted')}}
                </div>

               @endif
            </div>
            
             <form action="{{route('coupon.apply')}}" method="POST">
              @csrf
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-10 col-sm-8 col-xs-10">
                   {{--  <label for="coupon">Apply Coupon</label> --}}
                      <input id="coupon" class="form-control" type="text" name="coupon_code" placeholder="Enter Your Coupon Code">
                      <input id="plan_id" class="form-control" type="hidden" name="plan_id" value="{{$plan->id}}" >
                      <input id="user_id" class="form-control" type="hidden" name="user_id" value="{{Auth::user()->id}}" >

                    </div>
                    <div class="col-lg-2 col-sm-4 col-xs-2">
                      <input type="submit" class="btn btn-md btn-info applybutton" value="Apply">
                    </div>
                  </div>
                  
                  
                </div>
            </form>
          <div class="tab-content">
           
            <!-- Stript tab -->
            @if (isset($stripe_payment) && $stripe_payment == 1 && in_array('stripe',$currency_payments))
              <div class="tab-pane active" id="stripe">
                @if(env('STRIPE_KEY') != NULL && env('STRIPE_SECRET') != NULL)
                  {!! Form::open(['method' => 'POST', 'action' => 'UserAccountController@subscribe', 'id' => 'payment-form']) !!}
                  {{csrf_field()}}
                  <div class="form-row">
                 
                    <input type="hidden" name="plan" value="{{$plan->id}}">
                    <label for="card-element">
                      Credit or debit card
                    </label>
                    <div id="card-element">
                      <!-- a Stripe Element will be inserted here. -->
                    </div>
                    <!-- Used to display form errors -->
                    <div id="card-errors" role="alert"></div>
                  </div>
                  <button id="card-button" data-secret="{{ $intent->client_secret }}" class="payment-btn stripe"><i class="fa fa-credit-card"></i> Submit Payment</button>
                {!! Form::close() !!}
                @else
                  @component('components.alert')
                      Stripe Payment
                  @endcomponent
                @endif
              </div>
            @endif
            <!-- end stripe -->
           

            <!-- paypal tab -->
            @if (isset($paypal_payment) && $paypal_payment == 1 && in_array('paypal',$currency_payments))
          
              <div class="tab-pane" id="paypal">
                @if(env('PAYPAL_CLIENT_ID') != NULL && env('PAYPAL_SECRET_ID') != NULL && env('PAYPAL_MODE') != NULL)
                  {!! Form::open(['method' => 'POST', 'action' => 'PaypalController@postPaymentWithpaypal']) !!}
                   
                    <input type="hidden" name="plan_id" value="{{$plan->id}}">
                    <input type="hidden" name="amount" value="{{$plan->amount - $session_amount}}">
                    <button class="payment-btn paypal-btn"><i class="fa fa-credit-card"></i> {{__('Pay Via')}} Paypal</button>
                  {!! Form::close() !!}
                @else
                  @component('components.alert')
                    Paypal Payment
                  @endcomponent
                @endif
              </div>
            @endif
            <!-- end paypal -->

            <!-- Braintree tab -->
            @if(isset($braintree) && $braintree==1 && in_array('braintree',$currency_payments))
              <div class="tab-pane" id="braintree">
                @if(env('BTREE_ENVIRONMENT') != NULL && env('BTREE_MERCHANT_ID') !=NULL && env('BTREE_PUBLIC_KEY') !=NULL && env('BTREE_PRIVATE_KEY') != NULL && env('BTREE_MERCHANT_ACCOUNT_ID') != NULL)
                  <div id="paypal-errors" role="alert"></div>
                  <a href="javascript:void(0);" class="payment-btn bt-btn"><i class="fa fa-credit-card"></i> {{__('Pay Via')}} Card / Paypal</a>
                  <div class="braintree">
                    <form method="POST" id="bt-form" action="{{ url('payment/braintree') }}">
                      {{ csrf_field() }} 
                      <div class="form-group">
                       
                        <label for="amount">{{__('amount')}}</label>                       
                        <input type="text" class="form-control"name="amount" readonly="" value="{{$plan->amount - $session_amount}}">  
                      </div>
                      <div class="bt-drop-in-wrapper">
                          <div id="bt-dropin"></div>
                      </div>
                      <input type="hidden" name="plan_id" value="{{$plan->id}}"/>
                      <input id="nonce" name="payment_method_nonce" type="hidden" />
                      <div id="pay-errors" role="alert"></div>
                      <button class="payment-btn" type="submit"><span>{{__('Pay Now')}}</span></button>
                    </form>
                  </div>
                @else
                  @component('components.alert')
                    Braintree Payment
                  @endcomponent
                @endif
              </div>
              
            @endif
            <!-- end braintree -->

            <!-- Mollie tab -->
            @if (isset($mollie_payment) && $mollie_payment == 1 && in_array('mollie',$currency_payments)) 
              <div class="tab-pane" id="mollie">
                @if(env('MOLLIE_KEY') != NULL)
                <div class="paymollie">
                  <form method="POST" action="{{ route('payviamoli_subscription') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                   {{ csrf_field() }}
                    <input type="hidden" name="amount" value="{{$plan->amount - $session_amount}}"> 
                    <input type="hidden" name="currency" value="{{$plan->currency}}"> 
                    <input type="hidden" name="quantity" value="1">
                    <input type="hidden" name="metadata" value="{{ json_encode($array = ['plan_id' => $plan->id,]) }}" > 
                    
                    <button class="payment-btn paymollie-btn"><i class="fa fa-credit-card"></i> Pay Via Mollie</button>
                  </form>
                </div>
                @endif
              </div>
            @endif 
            <!-- end Mollie -->

            <!-- cashfree tab -->
            @if (isset($cashfree_payment) && $cashfree_payment == 1 && in_array('cashfree',$currency_payments))
            <div class=" row tab-pane" id="cashfree">
               @if(env('CASHFREE_APP_ID') != NULL && env('CASHFREE_SECRET_ID') != NULL && env('CASHFREE_API_END_URL') != NULL)
                  @if(isset(Auth::user()->mobile) && Auth::user()->mobile != NULL)
                    <div class="cashfree">
                      {!! Form::open(['method' => 'POST', 'action' => 'PayViaCashFreeController@payment']) !!}
                      <input type="hidden" name="plan_id" value="{{$plan->id}}">
                      <input type="hidden" name="amount" value="{{$plan->amount - $session_amount}}">
                      <input type="hidden" name="currency" value="{{$plan->currency}}">
                      <button class="payment-btn cashfree-btn"><i class="fa fa-credit-card"></i> Pay Via Cashfree</button>
                    {!! Form::close() !!}
                    </div>
                  @else
                    <p class="text-danger">{{__('Please filled your mobile no')}}. <a href="{{url('/account/profile')}}">{{__('click here')}}</a></p>
                  @endif
                @else
                  @component('components.alert')
                    Cashfree
                  @endcomponent
                @endif
            </div>
            @endif 

            <!-- end cashfree tab -->

            <!-- coinpayment tab -->
            @if(isset($coin_payment) && $coin_payment==1 && in_array('coinpay',$currency_payments))
              <div class="tab-pane" id="coinpay">
                @if(env('COINPAYMENTS_MERCHANT_ID') != NULL && env('COINPAYMENTS_PUBLIC_KEY') != NULL && env('COINPAYMENTS_PRIVATE_KEY') != NULL)
                  <div class="coinpayment">
                    <form method="POST" id="coinpayment-form" action="{{ url('payment/coinpayment') }}">
                      {{ csrf_field() }} 
                      <div class="form-group"> 
                        <label for="amount">{{__('amount')}}</label>                       
                        <input type="text" class="form-control"name="amount" readonly="" value="{{$plan->amount - $session_amount}}">
                         <label for="amount">{{__('currency')}}</label> 
                        <select style="padding: 0px; " class="form-control" name="currency">
                          <option value="BTC">BTC</option>
                           <option value="LTC">LTC</option>
                            <option value="ETH">ETH</option>
                             <option value="LOKI">LOKI</option>
                              <option value="XZC">XZC</option>
                        </select>
                           <input type="hidden" name="plan_id" value="{{$plan->id}}"/>
                      </div>
                     
                      <button class="payment-btn" type="submit"><span>{{ __('Pay Now') }}</span></button>
                    </form>
                  </div> 
                @else
                  @component('components.alert')
                    Coin Payment
                  @endcomponent
                @endif
              </div>
            @endif
            <!-- end coinpayment -->

           
            
            <!-- Payu tab -->
            @if (isset($payu_payment) && $payu_payment == 1 && in_array('payu',$currency_payments))
              <div class="tab-pane" id="payu">
                @if(env('PAYU_METHOD') != NULL && env('PAYU_DEFAULT') != NULL && env('PAYU_MERCHANT_KEY') != NULL && env('PAYU_MERCHANT_SALT') != NULL)
                  {!! Form::open(['method' => 'POST', 'action' => 'PayuController@payment']) !!}
                    <input type="hidden" name="plan_id" value="{{$plan->id}}">
                    <button class="payment-btn payu-btn"><i class="fa fa-credit-card"></i> {{__('pay via')}} Payu</button>
                  {!! Form::close() !!}
                @else
                  @component('components.alert')
                    Payu Payment
                  @endcomponent
                @endif
              </div>
            @endif
            <!-- end payu -->
            <!-- patym tab -->
            @if (isset($paytm_payment) && $paytm_payment == 1 && in_array('paytm',$currency_payments))
              <div class="tab-pane" id="paytm">
                @if(env('PAYTM_MID') != NULL && env('PAYTM_MERCHANT_KEY') != NULL)
                  <div class="paytm">
                    {!! Form::open(['method' => 'POST', 'action' => 'PaytemController@store']) !!}
                      <input type="hidden" name="plan_id" value="{{$plan->id}}">
                      <button class="payment-btn paytm-btn"><i class="fa fa-credit-card"></i> {{__('pay via')}} Paytm</button>
                    {!! Form::close() !!}
                  </div>
                @else
                  @component('components.alert')
                    Paytm Payment
                  @endcomponent
                @endif
              </div>
            @endif
            <!-- end paytm -->

            <!-- razorpay tab -->
            @if (isset($razorpay_payment) && $razorpay_payment == 1 && in_array('razorpay',$currency_payments))
              <div class="tab-pane" id="razorpay">
                @if(env('RAZOR_PAY_KEY') != NULL && env('RAZOR_PAY_SECRET') != NULL)
                  <form action="{{ route('paysuccess',$plan->id) }}" method="POST">
                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                                  data-key="{{ env('RAZOR_PAY_KEY') }}"
                                  data-amount="{{ ($plan->amount - $session_amount)*100 }}"
                                  data-buttontext="Pay Via Razorpay"
                                  data-name="{{ config('app.name') }}"
                                  data-description="Payment For Order {{ uniqid() }}"
                                  data-image="{{url('images/logo/'.$logo)}}"
                                  data-prefill.name="{{ Auth::user()->name }}"
                                  data-prefill.email="{{ Auth::user()->email }}"
                            data-theme.color="#111111">
                    </script>
                    <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                    <input type="hidden" custom="Hidden Element" name="hidden">
                  </form>
                @else
                  @component('components.alert')
                      Razorpay Payment
                  @endcomponent
                @endif
              </div>
            @endif
            <!-- end razorpay -->

            <!-- instamojo tab -->
            @if (isset($instamojo_payment) && $instamojo_payment == 1 && in_array('instamojo',$currency_payments))
              <div class="tab-pane" id="instamojo">
                @if(env('IM_API_KEY') != NULL && env('IM_AUTH_TOKEN') != NULL && env('IM_URL') != NULL)
                  <form action="{{ route('payinstamojo') }}" method="POST">
                      <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                      <input type="hidden" name="plan_id" value="{{$plan->id}}">
                  
                    <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">
                                  <strong>Name</strong>
                                  <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" placeholder="Enter Name" required>
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                  <strong>Mobile Number</strong>
                                  <input type="text" name="mobile_number" value="{{ Auth::user()->mobile ? Auth::user()->mobile:'' }}" class="form-control" placeholder="Enter Mobile Number" required>
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                  <strong>Email Id</strong>
                                  <input type="text" name="email" value="{{Auth::user()->email}}" class="form-control" placeholder="Enter Email id" required>
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                  <strong>Event Fees</strong>
                                  <input type="text" name="amount" class="form-control" placeholder="" value="{{$plan->amount - $session_amount}}" readonly="">
                              </div>
                          </div>
                          <div class="col-md-12">
                                  <button type="submit" class="payment-btn instamojo-btn">{{__('Submit')}}</button>
                          </div>
                      </div>
                  </form>
                @else
                  @component('components.alert')
                      Instamojo Payment
                  @endcomponent
                @endif
              </div>
            @endif
            <!-- end instamojo -->
            

            
            <!-- Paystack Tab -->
            @if(isset($paystack) && $paystack == 1 && in_array('paystack',$currency_payments))
              <div class="tab-pane" id="paystack">
                @if(env('PAYSTACK_PUBLIC_KEY') != NULL && env('PAYSTACK_SECRET_KEY') != NULL && env('PAYSTACK_PAYMENT_URL') != NULL)
                  <div class="paystack">
                    @php
                      $amount = ($plan->amount - $session_amount)*100;
                    @endphp
                    <form method="POST" action="{{ url('payment/paystack') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                      <input type="hidden" name="email" value="{{$auth->email}}"> 
                      <input type="hidden" name="amount" value="{{$amount}}"> 
                      <input type="hidden" name="currency" value="{{$plan->currency}}"> 
                      <input type="hidden" name="quantity" value="1">
                      <input type="hidden" name="metadata" value="{{ json_encode($array = ['plan_id' => $plan->plan_id,]) }}" > 
                      <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">
                      <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> 
                      {{ csrf_field() }}
                      <button class="payment-btn paystack-btn"><i class="fa fa-credit-card"></i>{{__('pay via')}} Paystack</button>
                    </form>
                  </div>
                @else
                  @component('components.alert')
                    Paystack Payment
                  @endcomponent
                @endif
              </div>
            @endif
            <!-- end paystack -->

            @if(isset($flutterrave_payment) && $flutterrave_payment == 1 && in_array('flutterrave',$currency_payments))
              <div class="tab-pane" id="flutterrave">
                @if(env('RAVE_PUBLIC_KEY') != NULL && env('RAVE_SECRET_KEY') != NULL && env('RAVE_COUNTRY') != NULL )
                  <form method="POST" action="{{ route('flutterrave.pay') }}" id="paymentForm">
                    {{ csrf_field() }}

                    <input class="form-control col-md-6" name="plan_id" type="hidden" value="{{$plan->id}}" placeholder="planid" />
                    <input class="form-control col-md-6" type="hidden"  name="name" value="{{auth()->user()->name}}" placeholder="Name" />
                    <input class="form-control col-md-6" type="text"  name="amount"  value="{{$plan->amount - $session_amount}}" placeholder="plan amount" readonly/>
                    <input class="form-control col-md-6" name="email" value="{{auth()->user()->email}}" type="hidden" placeholder="Your Email" />
                    <input class="form-control col-md-6" name="phone" value="{{auth()->user()->mobile ? auth()->user()->mobile : '9999999999'}}" type="hidden" placeholder="Phone number" />

                    <input type="submit" class="payment-btn" value="{{__('Pay Now')}}" />
                </form>
                @else
                  @component('components.alert')
                    Flutterrave Payment
                  @endcomponent
                @endif
              </div>
            @endif

            <!-- omise tab -->
           
            @if(isset($omise_payment) && $omise_payment == 1 && in_array('omise',$currency_payments))
                <div class="tab-pane" id="omise">
                  @if(env('OMISE_PUBLIC_KEY') != NULL && env('OMISE_SECRET_KEY') != NULL && env('OMISE_API_VERSION') != NULL)
                    <form id="checkoutForm" method="POST" action="{{ route('pay.via.omise') }}">
                      @csrf
                      <input type="hidden" name="plan_id" value="{{$plan->id}}">
                      <script type="text/javascript" src="https://cdn.omise.co/omise.js"
                        data-key="{{ env('OMISE_PUBLIC_KEY') }}"
                        data-amount="{{ ($plan->amount - $session_amount)*100 }}"
                        data-frame-label="{{ config('app.name') }}"
                        data-image="{{ url('images/logo/'.$configs->logo) }}"
                        data-currency="{{ $currency_code }}"
                        data-default-payment-method="credit_card">
                      </script>
                    </form>
                  @else
                    @component('components.alert')
                      Omise Payment
                    @endcomponent
                  @endif
                </div>
            @endif
             <!-- omise tab -->

        
            <!-- Payhere tab -->
            @php
              $payhere_order_id = uniqid();
            @endphp
            @if (isset($payhere_payment) && $payhere_payment == 1 && in_array('payhere',$currency_payments))
              <div class="tab-pane" id="payhere">
                @if(env('PAYHERE_BUISNESS_APP_CODE') != NULL && env('PAYHERE_APP_SECRET') != NULL && env('PAYHERE_MERCHANT_ID') != NULL && env('PAYHERE_MODE') != NULL)
                  <form method="post" action="https://sandbox.payhere.lk/pay/checkout">
                    @csrf
                      <input type="hidden" name="merchant_id" value="{{ env('PAYHERE_MERCHANT_ID') }}">
                      <!-- Replace your Merchant ID -->
                      <input type="hidden" name="return_url" value="{{ url('/payhere/callback') }}">
                      <input type="hidden" name="cancel_url" value="{{ url('/account/purchaseplan') }}">
                      <input type="hidden" name="notify_url" value="{{ url('/notify/payhere') }}">
                      <input type="hidden" name="order_id" value="{{ $plan->id }}">
                      <input type="hidden" name="items" value="Subscription For Package {{ $plan->name }}">
                      <input type="hidden" name="currency" value="{{__('LKR') }}">
                      <input type="text" name="amount" value="{{$plan->amount }}">
                      <input type="hidden" name="first_name" value="{{ Auth::user()->name }}">
                      <input type="hidden" name="last_name" value="{{ Auth::user()->name }}">
                      <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                      <input type="hidden" name="phone" value="{{ Auth::user()->mobile  ? Auth::user()->mobile : '99999999999' }}">
                      <input type="hidden" name="address"
                        value="{{__('No Address') }}">
                      <input type="hidden" name="city" value="{{ __('no') }}">
                      <input type="hidden" name="country" value="{{ __('no') }}">
                      <button type="submit" class="btn payment-btn">
                        {{--  <span> --}}
                        PayHere Payment
                       
                      </button>
                    </form>

                @else
                  @component('components.alert')
                    PayHere Payment
                  @endcomponent
                @endif
              </div>
            @endif
            <!-- end payhere -->
            
            <!-- Bank detail Tab -->
            @if (isset($bankdetails) && $bankdetails == 1 && in_array('bankdetail',$currency_payments))
              <div class="tab-pane" id="bankdetails">
                @if(($account_name != NULL) && ($account_no != NULL) && ($ifsc_code != NULL) && ($bank!= NULL))
                  <button class="payment-btn" id="bankbutton">{{ __('Direct Bank Transfer') }}</button>
                      <div id="bankdetail" style="display: none;">
                        <br/>
                        <table class="table">
                          <tr>
                            <th>{{__('Account Name')}}</th>
                            <td>{{$account_name}}</td>
                          </tr>
                           <tr>
                            <th>{{__('Account Number')}}</th>
                            <td>{{$account_no}}</td>
                          </tr>
                           <tr>
                            <th>{{__('Bank Name')}}</th>
                            <td>{{$bank}}</td>
                          </tr>
                           <tr>
                            <th>{{__('IFSC Code')}}</th>
                            <td>{{$ifsc_code}}</td>
                          </tr>
                        </table>
                        <div class="row">
                          
                          <div class="col-md-12">
                             <p style="color: #d63031;">* {{__('Bank Note')}} <a href="{{url('contactus')}}" style="color: #00b894;">{{__('Contact Here')}}</a></p>
                          </div>
                        </div>
                        <br/>
                        <div class="row"> 
                        <form action="{{route('manualpayment',$plan->id)}}" method="POST" enctype="multipart/form-data" >
                          @csrf
                            <div class="form-group{{ $errors->has('recipt') ? ' has-error' : '' }} input-file-block col-md-12">
                              {!! Form::label('recipt', 'Manual Payment -Slip upload for verification') !!}
                              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Manual payment - Slip Upload for verification"></i>
                              {!! Form::file('recipt', ['class' => 'input-file', 'id'=>'recipt']) !!}
                              <input type="hidden" name="user_id" value="{{$auth->id}}"> 
                              <input type="hidden" name="user_name" value="{{$auth->name}}">
                              <input type="hidden" name="price" value="{{$plan->amount -$session_amount}}"> 
                              <input type="hidden" name="status" value="0">
                              <input type="hidden" name="currency" value="{{$plan->currency}}"> 
                              <input type="hidden" name="plan_id" value="{{$plan->plan_id}}"> 
                              <input type="hidden" name="method" value="banktransfer">
                              <br/>
                             
                               <button type="submit" class="btn payment-btn ">Proceed</button>
                              
                              <small class="text-danger">{{ $errors->first('recipt') }}</small>
                            </div>
                           
                           </form>
                        </div>

                      </div>
                @else
                  @component('components.alert')
                    Bank Detail
                  @endcomponent
                @endif
              </div>
            @endif
            <!--end Bank detail tab -->

            @if(isset($manualpaymentmethod))
              @foreach($manualpaymentmethod as $mpm)
               <div class="tab-pane" id="{{str_slug($mpm->payment_name, '-')}}">
                <p>{{$mpm->description}}</p>
                @if($mpm->thumbnail != NULL)
                  <img src="{{url('/images/manualpayment/'.$mpm->thumbnail)}}" class="img img-responsive" width="150" height="100">
                @endif
                <br>
                <form action="{{route('manualpayment',$plan->id)}}" method="POST" enctype="multipart/form-data" >
                  @csrf
                  <div class="form-group{{ $errors->has('recipt') ? ' has-error' : '' }} input-file-block col-md-12">
                   <input class="form-control" type="hidden" name="user_id" value="{{$auth->id}}"> 
                    <input class="form-control" type="hidden" name="user_name" value="{{$auth->name}}">
                    <input class="form-control" type="hidden" name="price" value="{{$plan->amount - $session_amount}}"> 
                    <input  class="form-control" type="hidden" name="status" value="0">
                    <input class="form-control" type="hidden" name="currency" value="{{$plan->currency}}"> 
                    <input class="form-control" type="hidden" name="plan_id" value="{{$plan->plan_id}}"> 
                    <input class="form-control" type="hidden" name="method" value="{{$mpm->payment_name}}">
                    <input class="form-control input-file" type="file" name="recipt" required="">
                    <button type="submit" class="btn payment-btn ">{{__('Proceed')}}</button>
                  </div>
                </form>
               </div>
               @endforeach
            @endif

            <!-- Wallet -->
            @if (isset($walletsetting) && $walletsetting->enable_wallet == 1) 
              <div class="tab-pane" id="wallet">
                @if(isset(auth()->user()->wallet) && auth()->user()->wallet->balance >= ($plan->amount - $session_amount))
                  <form method="POST" action="{{ route('checkout.with.wallet') }}">
                    <input class="form-control col-md-6" name="plan_id" type="hidden" value="{{$plan->id}}" placeholder="planid" />
                    <input class="form-control col-md-6" type="hidden"  name="name" value="{{auth()->user()->name}}" placeholder="Name" />
                    <input class="form-control col-md-6" type="hidden"  name="amount"  value="{{$plan->amount - $session_amount}}" placeholder="plan amount" readonly/>
                    <input class="form-control col-md-6" name="email" value="{{auth()->user()->email}}" type="hidden" placeholder="Your Email" />
                    <button class="payment-btn">{{ __('Pay Now') }}</button>
                  </form>
                @else
                  <h4>{{__('Insufficient amount in the wallet')}} <span class="text-red">{{__('Please add money in the wallet')}}</span></h4>
                @endif
              </div>
            @else
              @component('components.alert')
                Wallet
              @endcomponent
            @endif
            <!-- end wallet -->


               <!-- Authorize Net -->
               @if(config('authorizenet.ENABLE') == 1 && Module::has('AuthorizeNet') && Module::find('AuthorizeNet')->isEnabled())
               @include("authorizenet::front.tab")
             @endif
             <!-- End Authorize Net -->
 
             <!-- Bkash -->
             @if(config('bkash.ENABLE') == 1 && Module::has('Bkash') && Module::find('Bkash')->isEnabled())
               @include("bkash::front.tab")
             @endif
             <!-- End Bkash -->
 
             <!-- DPO -->
             @if(config('dpopayment.enable') == 1 && Module::has('DPOPayment') && Module::find('DPOPayment')->isEnabled())
               @include("dpopayment::front.tab")
             @endif
             <!-- End DPO -->
 
             <!-- Esewa -->
             @if(config('esewa.ENABLE') == 1 && Module::has('Esewa') && Module::find('Esewa')->isEnabled())
               @include("esewa::front.tab")
             @endif
             <!-- End Esewa -->
             
             <!-- Midtrains -->
             @if(config('midtrains.ENABLE') == 1 && Module::has('Midtrains') && Module::find('Midtrains')->isEnabled())
               @include("midtrains::front.tab")
             @endif
             <!-- End Midtrains -->
 
             <!-- Mpesa -->
             @if(config('mpesa.ENABLE') == 1 && Module::has('MPesa') && Module::find('MPesa')->isEnabled())
               @include("mpesa::front.tab")
             @endif
             <!-- End Mpesa -->
 
             <!-- Paytab -->
             @if(config('paytab.ENABLE') == 1 && Module::has('Paytab') && Module::find('Paytab')->isEnabled())
               @include("paytab::front.tab")
             @endif
             <!-- End Paytab -->
 
             <!-- Senangpay -->
             @if(config('senangpay.ENABLE') == 1 && Module::has('Senangpay') && Module::find('Senangpay')->isEnabled())
               @include("senangpay::front.tab")
             @endif
             <!-- End Senangpay -->
 
             <!-- Smanager -->
             @if(config('smanager.ENABLE') == 1 && Module::has('Smanager') && Module::find('Smanager')->isEnabled())
               @include("smanager::front.tab")
             @endif
             <!-- End Smanager -->
 
             <!-- SquarePay -->
             @if(config('squarepay.ENABLE') == 1 && Module::has('SquarePay') && Module::find('SquarePay')->isEnabled())
               @include("squarepay::front.tab")
             @endif
             <!-- End SquarePay -->
 
             <!-- Worldpay -->
             @if(config('worldpay.ENABLE') == 1 && Module::has('Worldpay') && Module::find('Worldpay')->isEnabled())
               @include("worldpay::front.tab")
             @endif
             <!-- End Worldpay -->
            
          



          </div>
        </div>

        <div class="clearfix"></div>

      </div>
     
    </div>
  </div>
</section>
@endsection
@section('custom-script')


<script src="//js.stripe.com/v3/"></script> <!-- stripe script -->
    <script>
        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

       const stripe = Stripe('{{ env("STRIPE_KEY") }}', { locale: "{{app()->getLocale()}}" }); // Create a Stripe client.
    const elements = stripe.elements(); // Create an instance of Elements.
    const cardElement = elements.create('card', { style: style }); // Create an instance of the card Element.
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;

    cardElement.mount('#card-element'); // Add an instance of the card Element into the `card-element` <div>.

       // Handle real-time validation errors from the card Element.
    cardElement.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });
        // Handle form submission.
        var form = document.getElementById('payment-form');


        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {

        event.preventDefault();

        stripe
            .handleCardSetup(clientSecret, cardElement, {
                payment_method_data: {
                    //billing_details: { name: cardHolderName.value }
                }
            })
            .then(function(result) {
                console.log(result);
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    console.log(result);
                    // Send the token to your server.
                    stripeTokenHandler(result.setupIntent.payment_method);
                }
            });
      });

        // Submit the form with the token ID.
        function stripeTokenHandler(paymentMethod) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'paymentMethod');
            hiddenInput.setAttribute('value', paymentMethod);

            // hiddenInput.setAttribute('name', 'stripeToken');
            // hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>

  <script>
     
    $(function(){
      $('.paypal-btn').on('click', function(){
        $('.paypal-btn').addClass('load');
      });

      $('.paystack-btn').on('click', function(){
        $('.paystack-btn').addClass('load');
      });  
      $('.payu-btn').on('click', function(){
        $('.payu-btn').addClass('load');
      }); 
      $('.braintree').hide();
    });
   </script>
  <script src="{{url('js/dropin.min.js')}}"></script>
 <script>  
    var client_token = null;   
    $(function(){
      $('.bt-btn').on('click', function(){
        $('.bt-btn').addClass('load');
        $.ajax({
          headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
          },
          type: "POST",
          
          url: "{{ url('bttoken') }}",
          success: function(t) {   
              if(t.client != null){
                client_token = t.client;
                btform(client_token);
                console.log(client_token);
              }
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
            $('.bt-btn').removeClass('load');
            alert('Payment error. Please try again later.');
          }
        });
      });
    });
    function btform(token){
      var payform = document.querySelector('#bt-form'); 
      braintree.dropin.create({
        authorization: client_token,
        selector: '#bt-dropin',  
        paypal: {
          flow: 'vault'
        },
      }, function (createErr, instance) {
        if (createErr) {
          console.log('Create Error', createErr);
          alert('Payment error. Please try again later.');
          return;
        }
        else{
          $('.bt-btn').hide();
          $('.braintree').show();
        }
        payform.addEventListener('submit', function (event) {
        event.preventDefault();
        instance.requestPaymentMethod(function (err, payload) {
          if (err) {
            console.log('Request Payment Method Error', err);
            alert('Payment error. Please try again later.');
            return;
          }
          // Add the nonce to the form and submit
          document.querySelector('#nonce').value = payload.nonce;
          payform.submit();
        });
      });
    });
    }
    $('#bankbutton').click(function () {$('#bankdetail').toggle();});
  </script>
  @stack('addon-script')
@endsection