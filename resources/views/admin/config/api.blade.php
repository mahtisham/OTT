@extends('layouts.admin')
@section('title', __('API Settings'))

@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <div class="tabsetting">
      <a href="{{url('admin/settings')}}" style="color: #7f8c8d;" ><button class="tablinks ">{{__('Genral Setting')}}</button></a>
      <a href="{{url('admin/seo')}}" style="color: #7f8c8d;" ><button class="tablinks">{{__('SEO Setting')}}</button></a>
      <a href="#" style="color: #7f8c8d;"><button class="tablinks active">{{__('API Setting')}}</button></a>
      <a href="{{route('mail.getset')}}" style="color: #7f8c8d;"><button class="tablinks">{{__('Mail Settings')}}</button></a>

    </div>
  
    {!! Form::model($env_files, ['method' => 'POST', 'action' => 'ConfigController@changeEnvKeys']) !!}

      <div class="row admin-form-block z-depth-1">
        <h6 class="form-block-heading apipadding">{{__('You Tube Api')}}</h6>
        <br>  
        <div class="form-group{{ $errors->has('YOUTUBE_API_KEY') ? ' has-error' : '' }}">
          {!! Form::label('YOUTUBE_API_KEY', __('YouTubeAPIKEY')) !!}
            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter You tube ApiKey')}}"></i>
          {!! Form::text('YOUTUBE_API_KEY',null, ['class' => 'form-control']) !!}
            <small class="text-danger">{{ $errors->first('YOUTUBE_API_KEY') }}</small>
        </div>
      </div>

      <div class="row admin-form-block z-depth-1">
        <h6 class="form-block-heading apipadding">{{__('Vimeo Api')}}</h6>
        <br>
        <div class="form-group{{ $errors->has('VIMEO_ACCESS') ? ' has-error' : '' }}">
          {!! Form::label('VIMEO_ACCESS', __('Vimeo APIKEY')) !!}
            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Vimeo ApiKey')}}"></i>
          {!! Form::text('VIMEO_ACCESS',null, ['class' => 'form-control']) !!}
            <small class="text-danger">{{ $errors->first('VIMEO_ACCESS') }}</small>
        </div>
      </div>  

      <div class="row admin-form-block z-depth-1">
        <h6 class="form-block-heading apipadding">{{__('Captcha Credentials')}} <a target="__blank" title="Get your keys from here" class=" pull-right text-info" href="https://www.google.com/recaptcha/admin/create"><i class="fa fa-key"></i> {{__('Get Your reCAPTCHA v2 Keys From Here')}}</a></h6>
        <br>
        <div class="payment-gateway-block">
          <div class="form-group">
            <div class="row">
              <div class="col-xs-6">
                {!! Form::label('captcha', __('GOOGLE CAPTCHA')) !!}
              </div>
              <div class="col-xs-5 text-right">
                <label class="switch">
                  {!! Form::checkbox('captcha', 1, $config->captcha, ['class' => 'checkbox-switch']) !!}
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
          </div>
          <div style="{{ $config->captcha==1 ? "" : "display: none" }}" id="captcha_box" class="row">
            <div class="col-md-6">
              <div class="form-group{{ $errors->has('NOCAPTCHA_SITEKEY') ? ' has-error' : '' }}">
                {!! Form::label('NOCAPTCHA_SITEKEY', __('CAPTCHA SITEKEY')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Captcha SiteKey')}}"></i>
                {!! Form::text('NOCAPTCHA_SITEKEY', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('NOCAPTCHA_SITEKEY') }}</small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="search form-group{{ $errors->has('NOCAPTCHA_SECRET') ? ' has-error' : '' }}">
                {!! Form::label('NOCAPTCHA_SECRET', __('CAPTCHA SECRET KEY')) !!}
                  <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Captcha SecretKey')}}"></i>
                  <input type="password" id="captcha-password-field" name="NOCAPTCHA_SECRET" @if(isset( $env_files['NOCAPTCHA_SECRET'])) value="{{ $env_files['NOCAPTCHA_SECRET'] }}" @endif>
                  <span toggle="#captcha-password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                  <small class="text-danger">{{ $errors->first('NOCAPTCHA_SECRET') }}</small>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="row admin-form-block z-depth-1">
        <div class="api-main-block">
          <h5 class="form-block-heading apipadding">{{__('Payment Gateways')}}</h5>
          <div class="payment-gateway-block">
            <div class="form-group">
              <div class="row">
                <div class="col-xs-6">
                  {!! Form::label('stripe_payment', __('STRIPE PAYMENT')) !!}
                </div>
                <div class="col-xs-5 text-right">
                  <label class="switch">
                    {!! Form::checkbox('stripe_payment', 1, $config->stripe_payment, ['class' => 'checkbox-switch']) !!}
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
            </div>
            <div style="{{ $config->stripe_payment==1 ? "" : "display: none" }}" id="stripe_box" class="row">
              <div class="col-md-6">
                <div class="form-group{{ $errors->has('STRIPE_KEY') ? ' has-error' : '' }}">
                    {!! Form::label('STRIPE_KEY', __('STRIPE KEY')) !!}
                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter StripeKey')}}"></i>
                    {!! Form::text('STRIPE_KEY', null, ['class' => 'form-control']) !!}

                    <small class="text-danger">{{ $errors->first('STRIPE_KEY') }}</small>
                </div>
              </div>
              <div class="col-md-6">
                <div class="search form-group{{ $errors->has('STRIPE_SECRET') ? ' has-error' : '' }}">
                    
                        {!! Form::label('STRIPE_SECRET', __('STRIPE SECRETKEY')) !!}
                        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Stripe SecretKey')}}"></i>
                        {{-- {!! Form::password('STRIPE_SECRET', null, ['id' => 'password-field', 'class' => 'form-control']) !!} --}}

                        <input type="password" id="password-field" name="STRIPE_SECRET" value="{{ $env_files['STRIPE_SECRET'] }}">
                      

                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                      

                    

                    <small class="text-danger">{{ $errors->first('STRIPE_SECRET') }}</small>
                </div>
              </div>
            </div>
          </div>
          <div  class="payment-gateway-block">
            <div class="form-group">
              <div class="row">
                <div class="col-xs-6">
                  {!! Form::label('paypal_payment', __('PAYPAL PAYMENT')) !!}
                </div>
                <div class="col-xs-5 text-right">
                  <label class="switch">
                    {!! Form::checkbox('paypal_payment', 1, $config->paypal_payment, ['class' => 'checkbox-switch']) !!}
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
            </div>
          <div id="paypal_box" style="{{ $config->paypal_payment==1 ? "" : "display: none" }}" id="paypal_box">

            <div class="search form-group{{ $errors->has('PAYPAL_CLIENT_ID') ? ' has-error' : '' }}">
              
                
                  {!! Form::label('PAYPAL_CLIENT_ID', __('PAYPAL CLIENTID')) !!}
                  <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Paypal ClientId')}}"></i>
                  <input type="password" name="PAYPAL_CLIENT_ID" id="pclientid" value="{{ $env_files['PAYPAL_CLIENT_ID'] }}" class="form-control">
              
                
                  <span toggle="#pclientid" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
                
              

                <small class="text-danger">{{ $errors->first('PAYPAL_CLIENT_ID') }}</small>
            



            <div class="search form-group{{ $errors->has('PAYPAL_SECRET_ID') ? ' has-error' : '' }}">
              
                
                  {!! Form::label('PAYPAL_SECRET_ID',__('PAYPAL SECRETID')) !!}
                  <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Paypal SecretId')}}"></i>
                  <input type="password" name="PAYPAL_SECRET_ID" value="{{ $env_files['PAYPAL_SECRET_ID'] }}" id="paypal_secret" class="form-control">
                
                
                    <span toggle="#paypal_secret" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
                  
              

                <small class="text-danger">{{ $errors->first('PAYPAL_SECRET_ID') }}</small>
            </div>
            <div class="search form-group{{ $errors->has('PAYPAL_MODE') ? ' has-error' : '' }}">
                {!! Form::label('PAYPAL_MODE',__('PAYPALMODE')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Paypal Mode')}}"></i>
                {!! Form::text('PAYPAL_MODE', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('PAYPAL_MODE') }}</small>
            </div>

          </div>
          </div>
          
        </div>
            

        <div class="payment-gateway-block">
            <div class="form-group">
              <div class="row">
                <div class="col-xs-6">
                  {!! Form::label('razorpay_payment',__('RAZORPAY PAYMENT')) !!}
                </div>
                <div class="col-xs-5 text-right">
                  <label class="switch">
                    {!! Form::checkbox('razorpay_payment', 1, $config->razorpay_payment, ['class' => 'checkbox-switch']) !!}
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
            </div>
            <div style="{{ $config->razorpay_payment==1 ? "" : "display: none" }}" id="razorpay_box" class="row">
              <div class="col-md-6">
                <div class="form-group{{ $errors->has('RAZOR_PAY_KEY') ? ' has-error' : '' }}">
                    {!! Form::label('RAZOR_PAY_KEY',__('RAZOR PAYKEY')) !!}
                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Razor payKey')}}"></i>
                    {!! Form::text('RAZOR_PAY_KEY', null , ['class' => 'form-control']) !!}

                    <small class="text-danger">{{ $errors->first('RAZOR_PAY_KEY') }}</small>
                </div>
              </div>
              <div class="col-md-6">
                <div class="search form-group{{ $errors->has('RAZOR_PAY_SECRET') ? ' has-error' : '' }}">
                    
                        {!! Form::label('RAZOR_PAY_SECRET', __('RAZOR PAY SECRETKEY')) !!}
                        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Razorpay SecretKey')}}"></i>
                        

                        <input type="password" id="razorpay_secret" name="RAZOR_PAY_SECRET" value="{{ $env_files['RAZOR_PAY_SECRET'] }}" >
                      

                        <span toggle="#razorpay_secret" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
                      

                    

                    <small class="text-danger">{{ $errors->first('RAZOR_PAY_SECRET') }}</small>
                </div>
              </div>
            </div>
        </div>


        <div class="payment-gateway-block">
            <div class="form-group">
              <div class="row">
                <div class="col-xs-6">
                  {!! Form::label('payu_payment', __('PAYU PAYMENT')) !!}
                </div>
                <div class="col-xs-5 text-right">
                  <label class="switch">
                    {!! Form::checkbox('payu_payment', 1, $config->payu_payment, ['class' => 'checkbox-switch']) !!}
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
            </div>
            <div id="payu_box" style="{{ $config->payu_payment==1 ? "" : "display: none" }}" class="row">
              <div class="col-md-6">
                <div class="form-group{{ $errors->has('PAYU_METHOD') ? ' has-error' : '' }}">
                    {!! Form::label('PAYU_METHOD', __('PAYU METHOD')) !!}
                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Payu Method')}}"></i>
                    {!! Form::text('PAYU_METHOD', null, ['class' => 'form-control']) !!}
                    <small class="text-danger">{{ $errors->first('PAYU_METHOD') }}</small>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group{{ $errors->has('PAYU_DEFAULT') ? ' has-error' : '' }}">
                    {!! Form::label('PAYU_DEFAULT', __('PAYU DEFAULT OPTION')) !!}
                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Default Payu Option')}}"></i>
                    {!! Form::text('PAYU_DEFAULT', null, ['class' => 'form-control']) !!}
                    <small class="text-danger">{{ $errors->first('PAYU_DEFAULT') }}</small>
                </div>
              </div>
              <div class="col-md-6">
                <div class="search form-group{{ $errors->has('PAYU_MERCHANT_KEY') ? ' has-error' : '' }}">
                  
                      {!! Form::label('PAYU_MERCHANT_KEY', __('PAYU MERCHANT KEY')) !!}
                      <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Payu Merchant Key')}}"></i>
                      <input id="payum" type="password" class="form-control" name="PAYU_MERCHANT_KEY" value="{{ $env_files['PAYU_MERCHANT_KEY'] }}">
                    

                    
                      <span toggle="#payum" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
                    

                  

                    <small class="text-danger">{{ $errors->first('PAYU_MERCHANT_KEY') }}</small>
                </div>
              </div>
              <div class="col-md-6">
                <div class="search form-group{{ $errors->has('PAYU_MERCHANT_SALT') ? ' has-error' : '' }}">
                  
                    
                      {!! Form::label('PAYU_MERCHANT_SALT', __('PAYU MERCHANT SALT')) !!}
                      <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Payu Merchant Salt')}}"></i>
                      <input type="password" value="{{ $env_files['PAYU_MERCHANT_SALT'] }}" name="PAYU_MERCHANT_SALT" id="payusalt" class="form-control">
                    
                      <span toggle="#payusalt" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
                    

                    <small class="text-danger">{{ $errors->first('PAYU_MERCHANT_SALT') }}</small>
                
              </div>
            </div>
          </div>

        </div>

        {{-- braintree payment --}}
        <div class="payment-gateway-block">
          <div class="form-group">
            <div class="row">
              <div class="col-xs-6">
                {!! Form::label('braintree', __('BRAIN TREE PAYMENT')) !!}
              </div>
              <div class="col-xs-5 text-right">
                <label class="switch">
                  {!! Form::checkbox('braintree', 1, $config->braintree, ['class' => 'checkbox-switch', 'id' => 'braintree_check']) !!}
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
          </div>

          <div id="braintree_box" style="{{ $config->braintree == 1 ? "" : "display:none" }}">
            <div class="form-group">
              <label>{{__('BTREE ENVIRONMENT')}}: </label>
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter MerchantID')}}"></i>
              <input type="text" name="BTREE_ENVIRONMENT" value="{{ $env_files['BTREE_ENVIRONMENT'] }}" class="form-control">
            </div>

            <div class="form-group">
              <label>{{__('BTREE MERCHANTID')}}: </label>
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter MerchantKey')}}"></i>
              <input type="text" name="BTREE_MERCHANT_ID" value="{{ $env_files['BTREE_MERCHANT_ID'] }}" class="form-control">
            </div>

            <div class="form-group">
              <label>{{__('BTREE MERCHANT ACCOUNT ID')}}: </label>
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter merchant key"></i>
              <input type="text" name="BTREE_MERCHANT_ACCOUNT_ID" value="{{ $env_files['BTREE_MERCHANT_ACCOUNT_ID'] }}" class="form-control">
            </div>
        

            <div class="form-group">
              <label>{{__('BTREE PUBLIC KEY')}}: </label>
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter MerchantKey')}}"></i>
              <input type="text" name="BTREE_PUBLIC_KEY" value="{{ $env_files['BTREE_PUBLIC_KEY'] }}" class="form-control">
            </div>

            <div class="form-group">
              <label>{{__('BTREE PRIVATE KEY')}}: </label>
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Merchant Key')}}"></i>
              <input type="text" name="BTREE_PRIVATE_KEY" value="{{ $env_files['BTREE_PRIVATE_KEY'] }}" class="form-control">
            </div>
          </div>
          
        </div>

        {{-- coinpay payment --}}
        <div class="payment-gateway-block">
          <div class="form-group">
            <div class="row">
              <div class="col-xs-6">
                {!! Form::label('coinpay',__('COIN PAYMENT')) !!}
                <label><a href="https://www.coinpayments.net/">  ({{__('Coin Payment Site')}})</a></label>
              </div>
              <div class="col-xs-5 text-right">
                <label class="switch">
                  {!! Form::checkbox('coinpay', 1, $config->coinpay, ['class' => 'checkbox-switch', 'id' => 'coinpay_check']) !!}
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
          </div>

          <div id="coinpay_box" style="{{ $config->coinpay == 1 ? "" : "display:none" }}">
            <div class="form-group">
              <label>{{__('COINPAYMENTSMERCHANTID')}}: </label>
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter MerchantID')}}"></i>
              <input type="text" name="COINPAYMENTS_MERCHANT_ID" value="{{ $env_files['COINPAYMENTS_MERCHANT_ID'] }}" class="form-control">
            </div>

            <div class="form-group">
              <label>{{__('COIN PAYMENTS PUBLIC KEY')}}: </label>
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Merchant Key')}}"></i>
              <input type="text" name="COINPAYMENTS_PUBLIC_KEY" value="{{ $env_files['COINPAYMENTS_PUBLIC_KEY'] }}" class="form-control">
            </div>

            <div class="form-group">
              <label>{{__('COIN PAYMENTS PRIVATE KEY')}}: </label>
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Merchant Key')}}"></i>
              <input type="text" name="COINPAYMENTS_PRIVATE_KEY" value="{{ $env_files['COINPAYMENTS_PRIVATE_KEY'] }}" class="form-control">
            </div>
          </div>
              
        </div>


        <div class="payment-gateway-block">
          <div class="form-group">
            <div class="row">
              <div class="col-xs-6">
                {!! Form::label('paystack',__('PAY STACK PAYMENT')) !!}
                <label> (Only Works on NGN Currency)</label>
              </div>
              <div class="col-xs-5 text-right">
                <label class="switch">
                  {!! Form::checkbox('paystack', 1, $config->paystack, ['class' => 'checkbox-switch', 'id' => 'paystack_check']) !!}
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
          </div>

          <div id="paystack_box" style="{{ $config->paystack == 1 ? "" : "display:none" }}">
            <div class="form-group">
              <label>{{__('PAY STACK PUBLIC KEY')}}: </label>
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Merchant ID')}}"></i>
              <input type="text" name="PAYSTACK_PUBLIC_KEY" value="{{ $env_files['PAYSTACK_PUBLIC_KEY'] }}" class="form-control">
            </div>

            <div class="form-group">
              <label>{{__('PAY STACK SECRETKEY')}}: </label>
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter merchant key"></i>
              <input type="text" name="PAYSTACK_SECRET_KEY" value="{{ $env_files['PAYSTACK_SECRET_KEY'] }}" class="form-control">
            </div>
            <div class="form-group">
              <label>{{__('MERCHANT EMAIL')}}: </label>
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Merchant Email')}}"></i>
              <input type="text" name="MERCHANT_EMAIL" value="{{ $env_files['MERCHANT_EMAIL'] }}" class="form-control">
            </div>
            <div class="form-group">
              <label>{{__('PAY STACK PAYMENT URL')}}: </label>
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Pay stack Url')}}"></i>
              <input type="text" name="PAYSTACK_PAYMENT_URL" value="{{ $env_files['PAYSTACK_PAYMENT_URL'] }}" class="form-control">
            </div>
      
          </div>
        </div>

        <div class="payment-gateway-block">
          <div class="form-group">
            <div class="row">
              <div class="col-xs-6">
                {!! Form::label('paypal_payment', __('PAYTM PAYMENT')) !!}
              </div>
              <div class="col-xs-5 text-right">
                <label class="switch">
                  {!! Form::checkbox('paytm_payment', 1, $config->paytm_payment, ['class' => 'checkbox-switch', 'id' => 'paytm_check']) !!}
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
          </div>

          <div id="paytm_box" style="{{ $config->paytm_payment == 1 ? "" : "display:none" }}">
            <div class="form-group">
              <label>{{__('Merchant ID')}}: </label>
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Merchant ID')}}"></i>
              <input type="text" name="PAYTM_MID" value="{{ $env_files['PAYTM_MID'] }}" class="form-control">
            </div>
    
            <div class="form-group">
              <label>{{__('Merchant KEY')}}: </label>
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Merchant Key')}}"></i>
              <input type="text" name="PAYTM_MERCHANT_KEY" value="{{ $env_files['PAYTM_MERCHANT_KEY'] }}" class="form-control">
            </div>
            <div class="bootstrap-checkbox form-group{{ $errors->has('paytm_test') ? ' has-error' : '' }}">
              <div class="row">
                <div class="col-md-7">
                  <h5 class="bootstrap-switch-label">{{__('Paytm Testing Live')}}</h5>
                </div>
                <div class="col-md-5 pad-0">
                  <div class="make-switch">
                    {!! Form::checkbox('paytm_test', 1, ($config->paytm_test == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"Live", "data-off-text"=>"Test", "data-size"=>"small"]) !!}
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <small class="text-danger">{{ $errors->first('paytm_test') }}</small>
              </div>
            </div>
          </div>
        </div>


        <div class="payment-gateway-block">
          <div class="form-group">
            <div class="row">
              <div class="col-xs-6">
                {!! Form::label('instamojo_payment', __('INSTA MOJO PAYMENT')) !!}
                <label> ({{__('Indian Currency')}})</label>
              </div>
              <div class="col-xs-5 text-right">
                <label class="switch">
                  <input id="instamojo_check" {{$config->instamojo_payment == 1 ? "checked" : ""}} type="checkbox" class="checkbox-switch" name="instamojo_payment">
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
          </div>

          <div id="instamojo_box" style="{{ $config->instamojo_payment == 1 ? "" : "display:none" }}">
            <div class="form-group">
              <label>{{__('INSTA MOJO API KEY')}}: </label>
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Api Key')}}"></i>
              <input type="text" name="IM_API_KEY" value="{{ $env_files['IM_API_KEY'] }}" class="form-control">
            </div>

            <div class="form-group">
              <label>{{__('INSTA MOJO AUTH TOKEN')}}: </label>
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Insta mojo Auth Token Key')}}"></i>
              <input type="text" name="IM_AUTH_TOKEN" value="{{ $env_files['IM_AUTH_TOKEN'] }}" class="form-control">
            </div>
                
            <div class="form-group">
              <label>{{__('INSTA MOJO PAYMENT URL')}}: </label>
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Instamojo Url')}}"></i>
              <input type="text" name="IM_URL" value="{{ $env_files['IM_URL'] }}" class="form-control">
            </div>
            <small class="text-danger">
              {{__('Note')}} :- <br/>
              <b>- {{__('ForTestingModePaymentUrlIs')}} https://test.instamojo.com/api/1.1/<br/>
              - {{__('ForLiveModePaymentUrlIs')}} https://www.instamojo.com/api/1.1/</b>
            </small>
      
          </div>
        </div>

        <div class="payment-gateway-block">
          <div class="form-group">
            <div class="row">
              <div class="col-xs-6">
                {!! Form::label('mollie_payment',__('MOLLIE PAYMENT')) !!}
              </div>
              <div class="col-xs-5 text-right">
                <label class="switch">
                  {!! Form::checkbox('mollie_payment',1, ($config->mollie_payment == 1 ? 1: 0), ['class' => 'checkbox-switch','id' => 'mollie_check']) !!}
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
          </div>
          <div style="{{ $config->mollie_payment==1 ? "" : "display: none" }}" id="mollie_box" class="row">
            <div class="col-md-12">
              <div class="form-group{{ $errors->has('MOLLIE_KEY') ? ' has-error' : '' }}">
                {!! Form::label('MOLLIE_KEY', __('MOLLIE KEY')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Mollie Key')}}"></i>
                <input type="text" name="MOLLIE_KEY" class="form-control" value="{{env('MOLLIE_KEY') ? env('MOLLIE_KEY') : ''}}" placeholder="{{__('PleaseEnterMollieKey')}}" >

                <small class="text-danger">{{ $errors->first('MOLLIE_KEY') }}</small>
              </div>
            </div>
          </div>
        </div>

        <div  class="payment-gateway-block">
          <div class="form-group">
            <div class="row">
              <div class="col-xs-6">
                {!! Form::label('cashfree_payment', __('CASH FREE PAYMENT')) !!}
              </div>
              <div class="col-xs-5 text-right">
                <label class="switch">
                  {!! Form::checkbox('cashfree_payment', 1, ($config->cashfree_payment == 1 ? 1 : 0), ['class' => 'checkbox-switch','id' => 'cashfree_check']) !!}
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
          </div>
          <div id="cashfree_box" style="{{ $config->cashfree_payment == 1 ? "" : "display: none" }}" >
            <div class="search form-group{{ $errors->has('CASHFREE_APP_ID') ? ' has-error' : '' }}">
              {!! Form::label('CASHFREE_APP_ID',__('CASH FREE APP ID')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Cash Free App Id')}}"></i>
              {!! Form::text('CASHFREE_APP_ID', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('CASHFREE_APP_ID') }}</small>
            </div>
            <div class="search form-group{{ $errors->has('CASHFREE_SECRET_ID') ? ' has-error' : '' }}">
              {!! Form::label('CASHFREE_SECRET_ID',__('CASHFREE SECRETID')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Cashfree Secret Id')}}"></i>
              <input type="password" name="CASHFREE_SECRET_ID" value="{{env('CASHFREE_SECRET_ID') ? env('CASHFREE_SECRET_ID') :''}}" id="cashfree_secret" class="form-control">
              <span toggle="#cashfree_secret" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
              <small class="text-danger">{{ $errors->first('CASHFREE_SECRET_ID') }}</small>
            </div>
            <div class="search form-group{{ $errors->has('CASHFREE_API_END_URL') ? ' has-error' : '' }}">
              {!! Form::label('CASHFREE_API_END_URL', __('CASHFREE API ENDURL')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Cashfree Api Endurl')}}"></i>
                  {{--  {!! Form::text('CASHFREE_API_END_URL', null, ['class' => 'form-control']) !!} --}}
              <input type="text" name="CASHFREE_API_END_URL" value="{{env('CASHFREE_API_END_URL') ? env('CASHFREE_API_END_URL') : ''}}" placeholder="https://test.cashfree.com">
              <small class="text-danger">
                {{__('Note')}} :- 
                <ul>
                  <li>
                    {{__('For Test Mode Use CASHFREE API END URL')}} : <b>https://test.cashfree.com</b>
                  </li>
                  <li>
                    {{__('For Live Mode Use CASHFREE API END URL')}} : <b>https://cashfree.com</b>
                  </li>
                </ul>
              </small>
              <small class="text-danger">{{ $errors->first('CASHFREE_API_END_URL') }}</small>
            </div>
          </div>
        </div>
          

        <div class="payment-gateway-block">
          <div class="form-group">
            <div class="row">
              <div class="col-xs-6">
                {!! Form::label('omise_payment',__('OMISE PAYMENT')) !!}
              </div>
              <div class="col-xs-5 text-right">
                <label class="switch">
                  {!! Form::checkbox('omise_payment', 1, $config->omise_payment, ['class' => 'checkbox-switch','id' => 'omise_check']) !!}
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
          </div>
          <div style="{{ $config->omise_payment==1 ? "" : "display: none" }}" id="omise_box" class="row">
            <div class="col-md-6">
              <div class="form-group{{ $errors->has('OMISE_PUBLIC_KEY') ? ' has-error' : '' }}">
                {!! Form::label('OMISE_PUBLIC_KEY',__('OMISEPUBLICKEY')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Omise public Key')}}"></i>
                {!! Form::text('OMISE_PUBLIC_KEY', null , ['class' => 'form-control']) !!}

                <small class="text-danger">{{ $errors->first('OMISE_PUBLIC_KEY') }}</small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="search form-group{{ $errors->has('OMISE_SECRET_KEY') ? ' has-error' : '' }}">
                {!! Form::label('OMISE_SECRET_KEY', __('OMISE SECRETKEY')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Omise Secret Key')}}"></i>
                  <input type="password" id="omise_secret" name="OMISE_SECRET_KEY" value="{{ $env_files['OMISE_SECRET_KEY'] ? $env_files['OMISE_SECRET_KEY'] : '' }}" >
                <span toggle="#omise_secret" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
                <small class="text-danger">{{ $errors->first('OMISE_SECRET_KEY') }}</small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group{{ $errors->has('OMISE_API_VERSION') ? ' has-error' : '' }}">
                {!! Form::label('OMISE_API_VERSION',__('OMISE API VERSION')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Omise api version')}}"></i>
                {!! Form::text('OMISE_API_VERSION', null , ['class' => 'form-control']) !!}

                <small class="text-danger">{{ $errors->first('OMISE_API_VERSION') }}</small>
              </div>
            </div>
          </div>
        </div>


        <div class="payment-gateway-block">
          <div class="form-group">
            <div class="row">
              <div class="col-xs-6">
                {!! Form::label('flutterrave', 'Flutter Rave') !!}
                <label><a href="https://dashboard.flutterwave.com/signup">  (Flutter Rave Site)</a></label>
              </div>
              <div class="col-xs-5 text-right">
                <label class="switch">
                  {!! Form::checkbox('flutterrave_payment', 1, $config->flutterrave_payment, ['class' => 'checkbox-switch', 'id' => 'flutter_check']) !!}
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
          </div>
          <div class="row" id="flutterave_box" style="{{ $config->flutterrave_payment == 1 ? "" : "display:none" }}">
            <div class="col-md-6">
              <div class="form-group">
                <label>RAVE PUBLIC KEY: </label>
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter public key"></i>
                <input type="text" name="RAVE_PUBLIC_KEY" value="{{ $env_files['RAVE_PUBLIC_KEY'] ? $env_files['RAVE_PUBLIC_KEY'] : '' }}" class="form-control">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>RAVE SECRET KEY: </label>
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter secret key"></i>
                <input type="text" name="RAVE_SECRET_KEY" value="{{ $env_files['RAVE_SECRET_KEY'] ? $env_files['RAVE_SECRET_KEY'] :'' }}" class="form-control">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Country Code: </label>
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter country code"></i>
                <input type="text" name="RAVE_COUNTRY" value="{{ $env_files['RAVE_COUNTRY'] ? $env_files['RAVE_COUNTRY'] : '' }}" class="form-control">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>RAVE LOGO: </label>
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter rave logo"></i>
                <label>Enter Full URL to Image</label>
                <input type="text" name="RAVE_LOGO" value="{{ $env_files['RAVE_LOGO'] ? $env_files['RAVE_LOGO'] : '' }}" class="form-control">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>RAVE PREFIX: </label>
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter rave prefix"></i>
                <input type="text" name="RAVE_PREFIX" value="{{ $env_files['RAVE_PREFIX'] ? $env_files['RAVE_PREFIX'] : '' }}" class="form-control">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>RAVE SECRET HASH: </label>
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter rave secret hash"></i>
                <input type="text" name="RAVE_SECRET_HASH" value="{{ $env_files['RAVE_SECRET_HASH'] ? $env_files['RAVE_SECRET_HASH'] : '' }}" class="form-control">
              </div>
            </div>
          </div>
        </div>


        <div class="payment-gateway-block">
          <div class="form-group">
            <div class="row">
              <div class="col-xs-6">
                {!! Form::label('payhere',__('PayHere Payment')) !!}
              </div>
              <div class="col-xs-5 text-right">
                <label class="switch">
                  {!! Form::checkbox('payhere_payment', 1, $config->payhere_payment, ['class' => 'checkbox-switch', 'id' => 'payhere_check']) !!}
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
          </div>

          <div id="payhere_box" style="{{ $config->payhere_payment == 1 ? "" : "display:none" }}">
            <div class="form-group">
              <label>{{__('PAYHERE BUISNESS APP CODE')}}: </label>
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Enter PAYHERE BUISNESS APP CODE')}}"></i>
              <input type="text" name="PAYHERE_BUISNESS_APP_CODE" value="{{ $env_files['PAYHERE_BUISNESS_APP_CODE'] }}" class="form-control">
            </div>

            <div class="form-group">
              <label>{{__('PAYHERE APP Secret Key')}}: </label>
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Enter PAYHERE APP secret key"></i>
              <input type="text" name="PAYHERE_APP_SECRET" value="{{ $env_files['PAYHERE_APP_SECRET'] }}" class="form-control">
            </div>
            <div class="form-group">
              <label>{{__('PAYHERE MERCHANT ID')}}: </label>
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Enter PAYHERE MERCHANT ID CODE')}}"></i>
              <input type="text" name="PAYHERE_MERCHANT_ID" value="{{ $env_files['PAYHERE_MERCHANT_ID'] }}" class="form-control">
            </div>
            <div class="bootstrap-checkbox form-group{{ $errors->has('PAYHERE_MODE') ? ' has-error' : '' }}">
              <div class="row">
                <div class="col-md-7">
                  <h5 class="bootstrap-switch-label">{{__('Payhere Payment Enviourment')}}</h5>
                </div>
                <div class="col-md-5 pad-0">
                  <div class="make-switch">
                    {!! Form::checkbox('PAYHERE_MODE', 1, ($env_files['PAYHERE_MODE'] == 'live' ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>"Live", "data-off-text"=>"Sandbox", "data-size"=>"small"]) !!}
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <small class="text-danger">{{ $errors->first('PAYHERE_MODE') }}</small>
              </div>
            </div>
          </div>
              
        </div>

          

        <div class="payment-gateway-block">
          <div class="form-group">
            <div class="row">
              <div class="col-xs-6">
                {!! Form::label('bankdetails', __('BANKDETAILS')) !!}
              </div>
              <div class="col-xs-5 text-right">
                <label class="switch">
                  {!! Form::checkbox('bankdetails', 1, $config->bankdetails, ['class' => 'checkbox-switch']) !!}
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
          </div>
          <div id="bank_box" style="{{ $config->bankdetails==1 ? "" : "display: none" }}" class="row">
            <div class="col-md-6">
              <div class="form-group{{ $errors->has('account_no') ? ' has-error' : '' }}">
                {!! Form::label('account_no', __('AccountNumber')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('PleaseEnterYourBankAccountNumber')}}"></i>
                <input id="payum" type="text" class="form-control" value="{{$config->account_no}}" name="account_no">
                
                <small class="text-danger">{{ $errors->first('account_no') }}</small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group{{ $errors->has('account_name') ? ' has-error' : '' }}">
                {!! Form::label('account_name', __('AccountName')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('PleaseEnterYourAccountHolderNames')}}"></i>
                <input id="payum" type="text" class="form-control" value="{{$config->account_name}}" name="account_name">
                
                <small class="text-danger">{{ $errors->first('account_name') }}</small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="search form-group{{ $errors->has('ifsc_code') ? ' has-error' : '' }}">
                {!! Form::label('ifsc_code',__('IFSCCode')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter IFSCCode')}}"></i>
                <input id="payum" type="text" class="form-control" value="{{$config->ifsc_code}}" name="ifsc_code">
                <small class="text-danger">{{ $errors->first('ifsc_code') }}</small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="search form-group{{ $errors->has('bank_name') ? ' has-error' : '' }}">
                {!! Form::label('bank_name',__('BankName')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter BankName')}}"></i>
                <input type="text" name="bank_name" value="{{$config->bank_name}}" id="payusalt" class="form-control">
                <small class="text-danger">{{ $errors->first('bank_name') }}</small>
              
              </div>
            </div>
          </div>
        </div>


        <div class="payment-gateway-block">
          <div class="form-group">
            <div class="row">
              <div class="col-xs-6">
                {!! Form::label('aws', __('AWS Storage Details')) !!}
              </div>
              <div class="col-xs-5 text-right">
                <label class="switch">
                  {!! Form::checkbox('aws', 1, $config->aws, ['class' => 'checkbox-switch']) !!}
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
          </div>
          <div id="aws_box" style="{{ $config->aws==1 ? "" : "display: none" }}" class="row">
            <div class="col-md-6">
              <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
                {!! Form::label('key', __('AWS Access Key')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Aws Access Key')}}"></i>
                <input id="payum" type="text" class="form-control" value="{{isset($env_files['key']) ? $env_files['key'] : '' }}" name="key">
                
                <small class="text-danger">{{ $errors->first('key') }}</small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group{{ $errors->has('secret') ? ' has-error' : '' }}">
                {!! Form::label('secret',__('AWS Secret Key')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Aws Secret Key')}}"></i>
                <input id="payum" type="text" class="form-control" value="{{isset($env_files['secret']) ? $env_files['secret'] :'' }}" name="secret">
                
                <small class="text-danger">{{ $errors->first('secret') }}</small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="search form-group{{ $errors->has('region') ? ' has-error' : '' }}">
                {!! Form::label('region', __('AWS Bucket Region')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Aws Bucket Region')}}"></i>
                <input id="payum" type="text" class="form-control" value="{{isset($env_files['region']) ? $env_files['region'] : '' }}" name="region">
                <small class="text-danger">{{ $errors->first('region') }}</small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="search form-group{{ $errors->has('bucket') ? ' has-error' : '' }}">
                {!! Form::label('bucket', __('AWS Bucket Name')) !!}
                  <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Aws Bucket Name')}}"></i>
                <input type="text" name="bucket" value="{{isset($env_files['bucket']) ? $env_files['bucket'] : '' }}" id="payusalt" class="form-control">
                <small class="text-danger">{{ $errors->first('bucket') }}</small>
              </div>
            </div>
          </div>
        </div>
            

        <div class="payment-gateway-block">
          <div class="api-main-block">
            <h5 class="form-block-heading apipadding">{{__('Other Apis')}}</h5>
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-6">
                  <div class="search form-group{{ $errors->has('MAILCHIMP_APIKEY') ? ' has-error' : '' }}">
                    {!! Form::label('MAILCHIMP_APIKEY', __('MAILCHIMP API KEY')) !!}
                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Mail chimp Api Key')}}"></i>
                    <input type="password" id="mailc" value="{{ $env_files['MAILCHIMP_APIKEY'] }}" name="MAILCHIMP_APIKEY" class="form-control">
                    <span toggle="#mailc" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
                    <small class="text-danger">{{ $errors->first('MAILCHIMP_APIKEY') }}</small>
                  </div>
                  <div class="form-group{{ $errors->has('MAILCHIMP_LIST_ID') ? ' has-error' : '' }}">
                    {!! Form::label('MAILCHIMP_LIST_ID',__('MAILCHIMP LIST ID')) !!}
                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Mailchimp List Id')}}"></i>
                    {!! Form::text('MAILCHIMP_LIST_ID', null, ['class' => 'form-control']) !!}
                    <small class="text-danger">{{ $errors->first('MAILCHIMP_LIST_ID') }}</small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="search form-group{{ $errors->has('TMDB_API_KEY') ? ' has-error' : '' }}">
                    {!! Form::label('TMDB_API_KEY', __('TMDB API KEY')) !!}
                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Tmdb ApiKey')}}"></i>
                    <input type="password" id="tmdb_secret" name="TMDB_API_KEY" value="{{ $env_files['TMDB_API_KEY'] }}" id="tmdb_secret" class="form-control">
                
                    <span toggle="#tmdb_secret" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
                    <small class="text-danger">{{ $errors->first('TMDB_API_KEY') }}</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="btn-group col-xs-12">
            <button type="submit" class="btn btn-block btn-success">{{__('Save Settings')}}</button>
          </div>
          <div class="clear-both"></div>
        </div>
      </div>
    {!! Form::close() !!}
    
  </div>
@endsection
@section('custom-script')
  <script>
    $(".toggle-password").click(function() {

      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    }); 

    $(".toggle-password2").click(function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });

  </script>

  <script>
    $('#stripe_payment').on('change',function(){
      if ($('#stripe_payment').is(':checked')){
           $('#stripe_box').show('fast');
        }else{
          $('#stripe_box').hide('fast');
        }
    });  

    $('#razorpay_payment').on('change',function(){
      if ($('#razorpay_payment').is(':checked')){
           $('#razorpay_box').show('fast');
        }else{
          $('#razorpay_box').hide('fast');
        }
    });   

    $('#paypal_payment').on('change',function(){
      if ($('#paypal_payment').is(':checked')){
           $('#paypal_box').show('fast');
        }else{
          $('#paypal_box').hide('fast');
        }
    });   

    $('#payu_payment').on('change',function(){
      if ($('#payu_payment').is(':checked')){
           $('#payu_box').show('fast');
        }else{
          $('#payu_box').hide('fast');
        }
    }); 

    $('#bankdetails').on('change',function(){
      if ($('#bankdetails').is(':checked')){
           $('#bank_box').show('fast');
        }else{
          $('#bank_box').hide('fast');
        }
    }); 
      

    $('#paytm_check').on('change',function(){
      if ($('#paytm_check').is(':checked')){
           $('#paytm_box').show('fast');
        }else{
          $('#paytm_box').hide('fast');
        }
    }); 

    $('#braintree_check').on('change',function(){
      if ($('#braintree_check').is(':checked')){
           $('#braintree_box').show('fast');
        }else{
          $('#braintree_box').hide('fast');
        }
    }); 
     $('#paystack_check').on('change',function(){
      if ($('#paystack_check').is(':checked')){
           $('#paystack_box').show('fast');
        }else{
          $('#paystack_box').hide('fast');
        }
    }); 

    $('#payhere_check').on('change',function(){
      if ($('#payhere_check').is(':checked')){
           $('#payhere_box').show('fast');
        }else{
          $('#payhere_box').hide('fast');
        }
    }); 

    $('#instamojo_check').on('change',function(){
      if ($('#instamojo_check').is(':checked')){
           $('#instamojo_box').show('fast');
        }else{
          $('#instamojo_box').hide('fast');
        }
    });

    $('#mollie_check').on('change',function(){
      if ($('#mollie_check').is(':checked')){
           $('#mollie_box').show('fast');
        }else{
          $('#mollie_box').hide('fast');
        }
    });

    $('#cashfree_check').on('change',function(){
      if ($('#cashfree_check').is(':checked')){
           $('#cashfree_box').show('fast');
        }else{
          $('#cashfree_box').hide('fast');
        }
    });

    $('#omise_check').on('change',function(){
      if ($('#omise_check').is(':checked')){
           $('#omise_box').show('fast');
        }else{
          $('#omise_box').hide('fast');
        }
    }); 

    $('#flutter_check').on('change',function(){
      if ($('#flutter_check').is(':checked')){
           $('#flutterave_box').show('fast');
        }else{
          $('#flutterave_box').hide('fast');
        }
    });    

   

    $('#coinpay_check').on('change',function(){
      if ($('#coinpay_check').is(':checked')){
           $('#coinpay_box').show('fast');
        }else{
          $('#coinpay_box').hide('fast');
        }
    });  

    $('#aws').on('change',function(){
      if ($('#aws').is(':checked')){
           $('#aws_box').show('fast');
        }else{
          $('#aws_box').hide('fast');
        }
    });  
    $('#captcha').on('change',function(){
      if ($('#captcha').is(':checked')){
           $('#captcha_box').show('fast');
        }else{
          $('#captcha_box').hide('fast');
        }
    });   
  </script>




@endsection
