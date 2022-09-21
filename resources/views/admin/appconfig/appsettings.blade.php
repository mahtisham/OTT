@extends('layouts.admin')
@section('title', __('App Settings'))

@section('content')
<div class="admin-form-main-block mrg-t-40">
  <!-- Tab buttons for site settings -->
  

  <!-- update general settings -->
  <form action="{{ route('apikey.create') }}" method="POST">
    @csrf
    <div class="row admin-form-block z-depth-1">
      <h6 class="form-block-heading apipadding">{{__('Generate Secret KEY for API')}}</h6><br/>
      <div class="col-md-6">

        <div class="form-group{{ $errors->has('generate_apikey') ? ' has-error' : '' }}">
          {!! Form::label('generate_apikey',__('Client Secret KEY')) !!}
          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please enter Client Secret KEY')}}"></i>
          {!! Form::text('generate_apikey', $appconfig->generate_apikey, ['class' => 'form-control']) !!}
          <small class="text-danger">{{ $errors->first('generate_apikey') }}</small>
        </div>
      </div>
      <div class="col-md-6">
        <div class="search form-group{{ $errors->has('purchase_code') ? ' has-error' : '' }}">
          {!! Form::label('purchase_code', __('Purchase Code')) !!}
          <input type="password" value="{{ old('purchase_code') }}" name="purchase_code" id="purchase_code-field" class="form-control">
          <span toggle="#purchase_code-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
          <small class="text-danger">{{ $errors->first('purchase_code') }}</small>
        </div>
      </div>

      <div class="btn-group pull-right">
        <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> {{__('Reset')}}</button>
        <button type="submit" class="btn btn-success" id="send_form"><i class="material-icons left">add_to_photos</i> {{$appconfig->generate_apikey != NULL ?  __('RE-GENREATE KEY') : __('GET YOUR KEY') }}</button>
      </div>
      <div class="clear-both"></div>
    </div>
    <br>
    
  </form>

  @if ($appconfig)
  {!! Form::model($appconfig, ['method' => 'PATCH', 'action' => ['AppConfigController@update', $appconfig->id], 'files' => true]) !!}
  
  <div class="row admin-form-block z-depth-1">
    <h6 class="form-block-heading apipadding">{{__('App Settings')}}</h6><br/>
    <div class="col-md-6">

      <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        {!! Form::label('title',__('App Title')) !!}
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Your App Title')}}"></i>
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
        <small class="text-danger">{{ $errors->first('title') }}</small>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group{{ $errors->has('logo') ? ' has-error' : '' }} input-file-block">
            {!! Form::label('logo', __('Project Logo')) !!} - <p class="inline info">{{__('Size')}}: 200x63</p>
            {!! Form::file('logo', ['class' => 'input-file', 'id'=>'logo']) !!}
            <label for="logo" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('Project Logo')}}">
              <i class="icon fa fa-check"></i>
              <span class="js-fileName">{{__('Choose A File')}}</span>
            </label>
            <p class="info">{{__('Choose A Logo')}}</p>
            <small class="text-danger">{{ $errors->first('logo') }}</small>
          </div>
        </div>
        <div class="col-md-6">
          <div class="image-block">
            <img src="{{asset('images/app/logo/' . $appconfig->logo)}}" class="img-responsive" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
  <br/>
  <div class="row admin-form-block z-depth-1">
    <h6 class="form-block-heading apipadding">{{__('Payment Gateway Settings')}}</h6><br/>
    <div class="col-md-6">
      <div class="payment-gateway-block">
        <div class="form-group">
          <div class="row">
            <div class="col-xs-6">
              {!! Form::label('stripe_payment',__('STRIPE PAYMENT')) !!}
            </div>
            @if(env('STRIPE_KEY') != NULL && env('STRIPE_SECRET') != NULL)
            <div class="col-xs-5 text-right">
              <label class="switch">
                {!! Form::checkbox('stripe_payment', 1, $appconfig->stripe_payment, ['class' => 'checkbox-switch']) !!}
                <span class="slider round"></span>
              </label>
            </div>
            @else
              <span class="text-danger">{{__('please fill the details properly check out here')}}<a href="{{url('/admin/api-settings/')}}"> {{__('click here')}}</a></span>
            @endif
          </div>
        </div>
      </div>
      <div class="payment-gateway-block">
        <div class="form-group">
          <div class="row">
            <div class="col-xs-6">
              {!! Form::label('paypal_payment',__('PAYPAL PAYMENT')) !!}
            </div>
            @if(env('PAYPAL_CLIENT_ID') != NULL && env('PAYPAL_SECRET_ID') != NULL && env('PAYPAL_MODE') != NULL )
            <div class="col-xs-5 text-right">
              <label class="switch">
                {!! Form::checkbox('paypal_payment', 1, $appconfig->paypal_payment, ['class' => 'checkbox-switch']) !!}
                <span class="slider round"></span>
              </label>
            </div>
            @else
              <span class="text-danger">{{__('please fill the details properly check out here')}}<a href="{{url('/admin/api-settings/')}}"> {{__('click here')}}</a></span>
            @endif
          </div>
        </div>
      </div>
      <div class="payment-gateway-block">
        <div class="form-group">
          <div class="row">
            <div class="col-xs-6">
              {!! Form::label('razorpay_payment', __('RAZORPAY PAYMENT')) !!}
            </div>
            @if(env('RAZOR_PAY_KEY') != NULL && env('RAZOR_PAY_SECRET') != NULL)
            <div class="col-xs-5 text-right">
              <label class="switch">
                {!! Form::checkbox('razorpay_payment', 1, $appconfig->razorpay_payment, ['class' => 'checkbox-switch']) !!}
                <span class="slider round"></span>
              </label>
            </div>
            @else
              <span class="text-danger">{{__('please fill the details properly check out here')}}<a href="{{url('/admin/api-settings/')}}"> {{__('click here')}}</a></span>
            @endif
          </div>
        </div>
      </div>
      <div class="payment-gateway-block">
        <div class="form-group">
          <div class="row">
            <div class="col-xs-6">
              {!! Form::label('inapp_payment',__('IN APP PAYMENT')) !!}
            </div>
            <div class="col-xs-5 text-right">
              <label class="switch">
                {!! Form::checkbox('inapp_payment', 1, $appconfig->inapp_payment, ['class' => 'checkbox-switch']) !!}
                <span class="slider round"></span>
              </label>
            </div>
          </div>
        </div>
      </div>
      <div class="payment-gateway-block">
        <div class="form-group">
          <div class="row">
            <div class="col-xs-6">
              {!! Form::label('instamojo_payment',__('INSTA MOJO PAYMENT')) !!}
            </div>
            @if(env('IM_API_KEY') != NULL && env('IM_AUTH_TOKEN') != NULL && env('IM_URL') != NULL)
            <div class="col-xs-5 text-right">
              <label class="switch">
                {!! Form::checkbox('instamojo_payment', 1, $appconfig->instamojo_payment, ['class' => 'checkbox-switch']) !!}
                <span class="slider round"></span>
              </label>
            </div>  
            @else
              <span class="text-danger">{{__('please fill the details properly check out here')}}<a href="{{url('/admin/api-settings/')}}"> {{__('click here')}}</a></span>
            @endif
          </div>
        </div>
      </div>
    </div>
     
    <div class="col-md-6">
      <div class="payment-gateway-block">
        <div class="form-group">
          <div class="row">
            <div class="col-xs-6">
              {!! Form::label('brainetree_payment',__('BRAIN TREE PAYMENT')) !!}
            </div>
            @if(env('BTREE_ENVIRONMENT') != NULL && env('BTREE_MERCHANT_ID') != NULL && env('BTREE_PUBLIC_KEY') != NULL && env('BTREE_PRIVATE_KEY') != NULL && env('BTREE_MERCHANT_ACCOUNT_ID') != NULL)
            <div class="col-xs-5 text-right">
              <label class="switch">
                {!! Form::checkbox('brainetree_payment', 1, $appconfig->brainetree_payment, ['class' => 'checkbox-switch']) !!}
                <span class="slider round"></span>
              </label>
            </div>
            @else
            <span class="text-danger">{{__('please fill the details properly check out here')}}<a href="{{url('/admin/api-settings/')}}"> {{__('click here')}}</a></span>
            @endif
          </div>
        </div>
      </div>
    
      <div class="payment-gateway-block">
        <div class="form-group">
          <div class="row">
            <div class="col-xs-6">
              {!! Form::label('paystack_payment',__('PAYSTACK PAYMENT')) !!}
            </div>
            @if(env('PAYSTACK_PUBLIC_KEY') != NULL && env('PAYSTACK_SECRET_KEY') != NULL && env('PAYSTACK_PAYMENT_URL') != NULL)
            <div class="col-xs-5 text-right">
              <label class="switch">
                {!! Form::checkbox('paystack_payment', 1, $appconfig->paystack_payment, ['class' => 'checkbox-switch']) !!}
                <span class="slider round"></span>
              </label>
            </div>
            @else
            <span class="text-danger">{{__('please fill the details properly check out here')}}<a href="{{url('/admin/api-settings/')}}"> {{__('click here')}}</a></span>
            @endif
          </div>
        </div>
      </div>
      <div class="payment-gateway-block">
        <div class="form-group">
          <div class="row">
            <div class="col-xs-6">
              {!! Form::label('bankdetails',__('BANK DETAILS')) !!}
            </div>
            
            <div class="col-xs-5 text-right">
              <label class="switch">
                {!! Form::checkbox('bankdetails', 1, $appconfig->bankdetails, ['class' => 'checkbox-switch']) !!}
                <span class="slider round"></span>
              </label>
            </div>
           
          </div>
        </div>
      </div>
      <div class="payment-gateway-block">
        <div class="form-group">
          <div class="row">
            <div class="col-xs-6">
              {!! Form::label('paytm_payment',__('PAYTM PAYMENT')) !!}
            </div>
            @if(env('PAYTM_MID') != NULL && env('PAYTM_MERCHANT_KEY') != NULL && env('PAYTM_ENVIRONMENT') != NULL && env('PAYTM_MERCHANT_WEBSITE') != NULL && env('PAYTM_CHANNEL') != NULL)
            <div class="col-xs-5 text-right">
              <label class="switch">
                {!! Form::checkbox('paytm_payment', 1, $appconfig->paytm_payment, ['class' => 'checkbox-switch']) !!}
                <span class="slider round"></span>
              </label>
            </div>
            @else
            <span class="text-danger">{{__('please fill the details properly check out here')}}<a href="{{url('/admin/api-settings/')}}"> {{__('click here')}}</a></span>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <br/>
  <div class="row admin-form-block z-depth-1">
    <h6 class="form-block-heading apipadding">{{__('Social Login Settings')}}</h6><br/>
    <div class="col-md-6">

      <div class="payment-gateway-block">
        <div class="form-group">
          <div class="row">
            <div class="col-xs-6">
              {!! Form::label('fb_check',__('Enable Facebook Login')) !!}
            </div>
             @if(env('FACEBOOK_CLIENT_ID') != NULL && env('FACEBOOK_CLIENT_SECRET') != NULL && env('FACEBOOK_CALLBACK') != NULL)
            <div class="col-xs-5 text-right">
              <label class="switch">
                {!! Form::checkbox('fb_check', 1, $appconfig->fb_login, ['class' => 'checkbox-switch']) !!}
                <span class="slider round"></span>
              </label>
            </div>
             @else
                <span class="text-danger">{{__('please fill the details properly check out here')}}<a href="{{url('/admin/social-login/')}}"> {{__('click here')}}</a></span>
              @endif
            
          </div>
        </div>
      </div>
      <div class="payment-gateway-block">
        <div class="form-group">
          <div class="row">
            <div class="col-xs-6">
              {!! Form::label('google_login',__('Enable Google Login')) !!}
            </div>
            @if(env('GOOGLE_CLIENT_ID') != NULL && env('GOOGLE_CLIENT_SECRET') != NULL && env('GOOGLE_CALLBACK') != NULL)
            <div class="col-xs-5 text-right">
              <label class="switch">
                {!! Form::checkbox('google_login', 1, $appconfig->google_login, ['class' => 'checkbox-switch']) !!}
                <span class="slider round"></span>
              </label>
            </div>
            @else
              <span class="text-danger">{{__('please fill the details properly check out here')}}<a href="{{url('/admin/social-login/')}}"> {{__('click here')}}</a></span>
            @endif
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
        <div class="payment-gateway-block">
          <div class="form-group">
            <div class="row">
              <div class="col-xs-6">
                {!! Form::label('amazon_login',__('Enable AMAZON Login')) !!}
              </div>
              @if(env('AMAZON_LOGIN_ID') != NULL && env('AMAZON_LOGIN_SECRET') != NULL && env('AMAZON_LOGIN_REDIRECT') != NULL)
              <div class="col-xs-5 text-right">
                <label class="switch">
                  {!! Form::checkbox('amazon_login', 1, $appconfig->amazon_login, ['class' => 'checkbox-switch']) !!}
                  <span class="slider round"></span>
                </label>
              </div>
              @else
                <span class="text-danger">{{__('please fill the details properly check out here')}}<a href="{{url('/admin/social-login/')}}"> {{__('click here')}}</a></span>
              @endif
            </div>
          </div>
        </div>
        
      
    </div>
  </div>
  <br/>
  <div class="row admin-form-block z-depth-1">
    <h6 class="form-block-heading apipadding">{{__('AdMob Settings')}}</h6><br/>
      
      <div class="payment-gateway-block">

        <div class="form-group">
         
          <div class="row">

            <div class="col-xs-6">
              {!! Form::label('banner_admob', __('BANNER ADMOB')) !!}
            </div>
            <div class="col-xs-5 text-right">
              <label class="switch">
                {!! Form::checkbox('banner_admob', 1, $appconfig->banner_admob, ['class' => 'checkbox-switch']) !!}
                <span class="slider round"></span>
              </label>
            </div>
          </div>
           <small class="text-danger">{{ $errors->first('banner_id') }}</small>
          <div style="{{ $appconfig->banner_admob==1 ? "" : "display: none" }}" id="banner_box" class="row">
            <div class="col-md-12">
              <div class="form-group{{ $errors->has('Banner_id') ? ' has-error' : '' }}">
                {!! Form::label('banner_id', __('BANNER ID')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Banner AdmaobID')}}"></i>
                {!! Form::text('banner_id', null, ['class' => 'form-control']) !!}
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="payment-gateway-block">
        <div class="form-group">
          <div class="row">
            <div class="col-xs-6">
              {!! Form::label('interstitial_admob', __('INTERSTITAL ADMOB')) !!}
            </div>
            <div class="col-xs-5 text-right">
              <label class="switch">
                {!! Form::checkbox('interstitial_admob', 1, $appconfig->interstitial_admob, ['class' => 'checkbox-switch']) !!}
                <span class="slider round"></span>
              </label>
            </div>
          </div>
          <div style="{{ $appconfig->interstitial_admob==1 ? "" : "display: none" }}" id="interstitial_box" class="row">
            <div class="col-md-12">
              <div class="form-group{{ $errors->has('interstitial_id') ? ' has-error' : '' }}">
                {!! Form::label('interstitial_id', __('INTERSTITAL ID')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Interstitial AdmobID')}}"></i>
                {!! Form::text('interstitial_id', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('interstitial_id') }}</small>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  <br/>
  <div class="row admin-form-block z-depth-1">
    <h6 class="form-block-heading apipadding">{{__('Push Notification Settings')}}</h6><br/>
      <div class="payment-gateway-block">
        <div class="form-group">
          <div class="row">
            <div class="col-xs-6">
              {!! Form::label('push_key', __('Push Notification')) !!}
            </div>
            <div class="col-xs-5 text-right">
              <label class="switch">
                {!! Form::checkbox('push_key', 1, $appconfig->push_key, ['class' => 'checkbox-switch','id'=> 'push_id']) !!}
                <span class="slider round"></span>
              </label>
            </div>
          </div>
           <small class="text-danger">{{ $errors->first('PUSH_AUTH_KEY') }}</small>
          <div style="{{ $appconfig->push_key == 1 ? "" : "display: none" }}" id="push_box" class="row">
            <div class="col-md-12">
              <div class="form-group{{ $errors->has('PUSH_AUTH_KEY') ? ' has-error' : '' }}">
                {!! Form::label('PUSH_AUTH_KEY', __('PUSH AUTH KEY')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Banner Admaob ID')}}"></i>
                <input type="text" name="PUSH_AUTH_KEY" class="form-control" value="{{env('PUSH_AUTH_KEY') ? env('PUSH_AUTH_KEY') : '' }}">
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  <br/>
  <div class="row admin-form-block z-depth-1">
    <h6 class="form-block-heading apipadding">{{__('Other Settings')}}</h6><br/>
    <div class="col-md-6">
      <div class="payment-gateway-block">
        <div class="form-group">
          <div class="row">
            <div class="col-xs-6">
              {!! Form::label('remove_ads',__('Remove Ads')) !!}
            </div>
            <div class="col-xs-5 text-right">
              <label class="switch">
                {!! Form::checkbox('remove_ads', 1, $appconfig->remove_ads, ['class' => 'checkbox-switch']) !!}
                <span class="slider round"></span>
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="payment-gateway-block">
        <div class="form-group">
          <div class="row">
            <div class="col-xs-6">
              {!! Form::label('is_admob',__('Admob Setting')) !!}
            </div>
            <div class="col-xs-5 text-right">
              <label class="switch">
                {!! Form::checkbox('is_admob', 1, $appconfig->is_admob, ['class' => 'checkbox-switch']) !!}
                <span class="slider round"></span>
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br/>
  
  <div class="btn-group col-xs-12">
    <button type="submit" class="btn btn-block btn-success">{{__('Save Settings')}}</button>
  </div>
  <div class="clear-both"></div>

{!! Form::close() !!}
@endif
</div>
@endsection
@section('custom-script')
<script type="text/javascript">
  $('#banner_admob').on('change',function(){
      if ($('#banner_admob').is(':checked')){
           $('#banner_box').show('fast');
        }else{
          $('#banner_box').hide('fast');
        }
    });  

  $('#interstitial_admob').on('change',function(){
    if ($('#interstitial_admob').is(':checked')){
         $('#interstitial_box').show('fast');
      }else{
        $('#interstitial_box').hide('fast');
      }
  });  

  $('#rewarded_admob').on('change',function(){
      if ($('#rewarded_admob').is(':checked')){
           $('#rewarded_box').show('fast');
        }else{
          $('#rewarded_box').hide('fast');
        }
    }); 
  $('#native_admob').on('change',function(){
      if ($('#native_admob').is(':checked')){
           $('#native_box').show('fast');
        }else{
          $('#native_box').hide('fast');
        }
    }); 
  $('#push_id').on('change',function(){
      if ($('#push_id').is(':checked')){
           $('#push_box').show('fast');
        }else{
          $('#push_box').hide('fast');
        }
    }); 

  $(".toggle-password").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
  });
</script>
@endsection
