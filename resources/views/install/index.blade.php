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
    <title>{{ __('Basic Setup') }}</title>
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
                  {{ __('Welcome To Setup Wizard') }}
              </h3>
          </div>
   				<div class="card-body" id="stepbox">
                <form autocomplete="off" action="{{ route('storeBasicSetup') }}" id="step1form" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                  @csrf
                   <h3>{{ __('Basic Setup') }}</h3>
                   <hr>
                  <div class="form-row">
                    <br>
                    <div class="col-md-6 mb-3">
                      <label for="validationCustom01">{{ __('App/Project Name') }}:</label>
                      <input pattern="[^' ']+" title="Make sure project name not contain any white space" name="APP_NAME" type="text" class="form-control  @error('APP_NAME') is-invalid @enderror" id="validationCustom01" placeholder="Project Name" value="{{ env('APP_NAME') }}" required>
                      <div class="valid-feedback">
                        {{ __('Looks good!') }}
                      </div>
                      @error('APP_NAME')
                      <span class="invalid-feedback" role="alert">
                          {{ __('Please choose an app name.') }}
                      </span>
                      @enderror
                    </div>
                     <div class="col-md-6 mb-3">
                      <label for="validationCustom01">App URL:</label>
                      <input name="APP_URL" type="url" class="form-control  @error('APP_URL') is-invalid @enderror" id="validationCustom01" placeholder="https://" value="{{ env('APP_URL') }}" required>
                      <div class="valid-feedback">
                       {{ __(' Looks good!') }}
                      </div>
                      @error('APP_URL')
                       <span class="invalid-feedback" role="alert">
                          {{ __('Please enter app URL.') }}
                      </span>
                      @enderror
                    </div>

                  </div>

                   <button class="float-right btn btn-default" type="submit">{{ __('Continue') }}...</button>
              </form>
          </div>
                  
                  
                
   				</div>
   			</div>
        <p class="text-center m-3 text-white">&copy;{{ date('Y') }} | {{__('Next Hour - Movie Tv Show & Video Subscription Portal Cms')}} | <a class="text-white" href="http://mediacity.co.in">{{ __('Media City') }}</a></p>
   		</div>
      
      <div class="corner-ribbon bottom-right sticky green shadow">{{ __('Basic Setup') }} </div>
    <!-- Optional JavaScript -->
     <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="{{ url('installer/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ url('installer/js/jquery.validate.min.js') }}"></script>
    <!-- jquery -->
    <script type="text/javascript" src="{{url('installer/js/bootstrap.min.js')}}"></script> <!-- bootstrap js -->
    <script type="text/javascript" src="{{url('installer/js/popper.min.js')}}"></script> 
    <script src="{{ url('installer/js/shards.min.js') }}"></script>
    <script>var baseUrl= "<?= url('/') ?>";</script>
 
    @notify_js
    @notify_render
</body>
</html>