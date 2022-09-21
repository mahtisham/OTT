<!Doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ url('installer/css/bootstrap.min.css') }}" crossorigin="anonymous">
   
    <link rel="stylesheet" href="{{ url('installer/css/custom.css') }}">
    <link rel="stylesheet" href="{{ url('installer/css/shards.min.css') }}">{{-- 
    <link rel="stylesheet" href="{{ url('installer/css/install.css') }}"> --}}
   
    
    <title>{{ __('Installing App - Terms and Condition') }}</title>
  
  </head>
  <body class="body">

 
   	   
      <div class="display-none preL">
        <div class="display-none preloader3"></div>
      </div>

   		<div class="container">
        @if ($errors->any())
            <br>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
   			<div class="card">
          <div class="card-header">
              <h3 class="m-3 text-center heading">
                  {{ __('Installing Nexthour') }}
              </h3>
          </div>
          @if(Session::has('success'))
            <div class="alert alert-success text-center">
              {{Session::get('success')}}
            </div>
           @endif
            @if(Session::has('deleted'))
            
            <div class="alert alert-danger text-center">
              {{Session::get('deleted')}}
            </div>
          @endif
   				<div class="card-body" id="stepbox">
               <form action="{{ route('store.eula') }}" id="step1form" method="POST" class="needs-validation" novalidate>
                  @csrf
                  <h3>{{ __('Terms & Conditions') }}</h3>
                   <hr>
                  <div class="form-row">
                    <br>
                   <div class="col-md-12">
                      <p class="text-dark font-weight-bold">{{ __('Please read this agreement carefully before installing or using this product') }}.</p>
                      <p class="text-dark font-weight-normal">

                      {{ __('If you agree to all of the terms of this End-User License Agreement, by checking the box or clicking the button to confirm your acceptance when you first install the web application, you are agreeing to all the terms of this agreement. Also, By downloading, installing, using, or copying this web application, you accept and agree to be bound by the terms of this End-User License Agreement, you are agreeing to all the terms of this agreement. If you do not agree to all of these terms, do not check the box or click the button and/or do not use, copy or install the web application, and uninstall the web application from all your server that you own or control') }}.</p>
                      
                      <b>{{ __('Note') }}:</b> <span class="text-dark font-weight-normal">
                        {{ __("With Nexthour, We are using the official Payment API (Paypal, PayuMoney, Stripe, Razorpay, Paystack, PayTM, Braintree) which is available on Developer Center. That is a reason why our product depends on Payment API(Paypal, Payu, Stripe). Therefore, We are not responsible if they made too many critical changes in their side. We also don't guarantee that the compatibility of the script with Payment API will be forever. Although we always try to update the lastest version of script as soon as possible. We don't provide any refund for all problems which are originated from Payments API (Paypal, PayuMoney, Stripe, Razorpay, Paystack, PayTM, Braintree)") }}.
                      </span> 
                     
                     <hr>
                    <div class="custom-control custom-checkbox">
                      <input required="" type="checkbox" class="custom-control-input" id="customCheck1" name="eula"/>
                      <label class="custom-control-label" for="customCheck1"><b>{{ __('I read the terms and condition carefully and I agree on it') }}.</b></label>
                    </div>
                   </div>
                  </div>
                  
                <button class="float-right step1btn btn btn-default" type="submit">{{ __('Continue to Installation') }}...</button>
              </form>
   				</div>
   			</div>


        <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top:150px">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header card-header">
                <h4 class="modal-title heading" id="myModalLabel">{{__('Welcome To Setup Wizard')}} </h4>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-6 custom-control custom-checkbox">
                     <input  type="radio" class="custom-control-input" id="customCheck3" name="user" value="existing"/>&nbsp;
                      <label class="custom-control-label" for="customCheck3"><b>{{ __('I\'m Existing user') }}</b></label>
                  </div>
                  <div class="col-md-6 custom-control custom-checkbox">
                      <input type="radio" class="custom-control-input" id="customCheck4" name="user" value="new"/> &nbsp;
                      <label class="custom-control-label" for="customCheck4"><b>{{ __('I\'m New user') }}</b></label>
                  </div>
                </div>
                
              </div>
              <div class="modal-footer">
                <input type="button" class="btn btn-default" id="userBtn" name="next" value="Next" />
              </div>
            </div>
          </div>
        </div>

        <p class="text-center m-3 text-white">&copy;{{ date('Y') }} | {{__('Next Hour - Movie Tv Show & Video Subscription Portal Cms')}}  | <a class="text-white" href="http://mediacity.co.in">{{ __('Media City') }}</a></p>
   		</div>


      
      
      <div class="corner-ribbon bottom-right sticky green shadow">{{ __('EULA') }} </div>
 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ url('installer/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ url('installer/js/jquery.validate.min.js') }}"></script>
    <!-- jquery -->
    <script type="text/javascript" src="{{url('installer/js/bootstrap.min.js')}}"></script> <!-- bootstrap js -->
    <script type="text/javascript" src="{{url('installer/js/popper.min.js')}}"></script> 
    <script src="{{ url('installer/js/shards.min.js') }}"></script>
    <script>var baseUrl= "<?= url('/') ?>";</script>

    <script type="text/javascript">

      $('#basicModal').modal('show');
      $('.card').css('opacity','0.5');
     
      $(document).ready(function(){
        $("input[type='button']").click(function(){

            var radioValue = $("input[name='user']:checked").val();

            if(radioValue == 'new'){

              $('#basicModal').modal('toggle');
               $('.card').css('opacity','1');
               @php
                  Cookie::queue('new_install','yes',10);
               @endphp
            }
            else if(radioValue == 'existing'){
              @php
                  Cookie::queue('new_install','no',10);
               @endphp
               window.location = "{{route('existterm')}}";
            }
          });
      });
    </script>
  
   
</body>
</html>