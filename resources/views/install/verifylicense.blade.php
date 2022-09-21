<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ url('css/bootstrap.css') }}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('css/install.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/mckenziearts/laravel-notify/css/notify.css') }}">

    <title>{{ __('Installing App - Step  - Verify Purchase') }}</title>
   
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
                  {{ __('Verify Your Purchase') }}
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
          @if($errors->any())
            <h6 class="alert alert-danger">{{$errors->first()}}</h6>
          @endif
            <h5>{{ __('Please purchase a valid license or verify your purchase code with author') }}.</h5>
            <div align="center">
                <a title="{{ __('Go back !') }}" href="{{ url()->previous() }}" class="btn btn-md btn-success">
                  {{ __('Go back and enter valid code !') }}
                </a>
            </div>
          </div>
        </div>
        <p class="text-center m-3 text-white">&copy;{{ date('Y') }} | {{__('Next Hour - Movie Tv Show & Video Subscription Portal Cms')}} | <a class="text-white" href="http://mediacity.co.in">{{ __('Media City') }}</a></p>
      </div>
      
      <div class="corner-ribbon bottom-right sticky green shadow"> </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ url('js/jquery.js') }}"></script>
    <script src="{{ url('js/jquery.validate.min.js') }}"></script>
    <script src="{{ url('js/app.js') }}"></script>
    <script>var baseUrl = "<?= url('/') ?>";</script>
    <script src="{{ url('js/minstaller.js') }}"></script>
    
</body>
</html>