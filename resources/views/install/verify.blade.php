<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ url('installer/css/bootstrap.min.css') }}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{url('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ url('installer/css/custom.css') }}">
    <link rel="stylesheet" href="{{ url('installer/css/shards.min.css') }}">
    <title>{{ __('Installing App - Step - Envato Purchase Details') }}</title>
   
  </head>
  <body>
      
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
                  {{ __('Enter Your Purchase code Detail') }}
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
               <form action="{{url('verifycode')}}" id="stepvform" method="POST" class="needs-validation" novalidate>                  
                  {{ csrf_field() }}
                   <h3>{{ __('Envato Purchase details') }}</h3>
                   <hr>
                  <div class="form-row">
                   
                    <br>
                    <div class="eyeCy col-md-10 mb-3">
                      <label for="validationCustom02">{{ __('Purchase Code:') }}</label>
                      <input name="code" type="password" class="form-control @error('code') is-invalid @enderror" id="validationCustom02" placeholder="{{ __('Please enter valid purchase code') }}" value="" required>
                      <span toggle="#validationCustom02" class="eye fa fa-fw fa-eye field-icon toggle-password"></span>
                      <div class="valid-feedback">
                        {{ __('Looks good!') }}
                      </div>
                      <div class="invalid-feedback">
                      </div>                          
                        @if($errors->any())
                          <h6 class="text-danger alert alert-error">{{$errors->first()}}</h6>
                        @endif

                        <small class="text-muted font-weight-bold">
                          <i class="fa fa-question-circle"></i> <a title="{{ __('Click to know') }}" class="text-muted" href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code" target="_blank">{{ __('Where Is My Purchase Code') }} ?</a>
                        </small>

                         
                    </div>                    
                  </div>
                <button class="float-right step1btn btn btn-default" type="submit">{{ __('Continue to Next Step') }}...</button>
              </form>
          </div>
        </div>
       <p class="text-center m-3 text-white">&copy;{{ date('Y') }} | {{__('Next Hour - Movie Tv Show & Video Subscription Portal Cms')}} | <a class="text-white" href="http://mediacity.co.in">{{ __('Media City') }}</a></p>
      </div>
      
      <div class="corner-ribbon bottom-right sticky green shadow">{{ __('License') }}</div>
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
      $(".toggle-password").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
          input.attr("type", "text");
        }else {
          input.attr("type", "password");
        }
      });
    </script>
   
</body>
</html>