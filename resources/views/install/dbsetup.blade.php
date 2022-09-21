<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('installer/css/bootstrap.min.css') }}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{url('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ url('installer/css/custom.css') }}">
    <link rel="stylesheet" href="{{ url('installer/css/shards.min.css') }}">
    <title>{{ __('Installing App - Database Details') }}</title>
   
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
                  {{ __('Welcome To Setup Wizard - Setting Up Database') }}
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

            <form autocomplete="off" action="{{ route('store.step2') }}" id="step2form" method="POST" class="needs-validation" novalidate>
           @csrf
          <h3>{{ __('Database Details') }}</h3>
          <hr>
  <div class="form-row">
        <br>
        <div class="col-md-6 mb-3">
             <label for="DB_HOST">{{ __('Database Host') }}: <small class="text-muted">({{ __('ex: localhost, 127.0.0.1') }})</small></label>
             <input name="DB_HOST" type="text" class="form-control @error('DB_HOST') is-invalid @enderror" id="DB_HOST" placeholder="localhost" value="{{ env('DB_HOST') != '' ? env('DB_HOST') : old('DB_HOST') }}" required>
             @error('DB_PORT')
            <div class="invalid-feedback">
                {{ $errors->first('DB_HOST') }}
            </div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
             <label for="DB_PORT">{{ __('Database Port') }}:  <small class="text-muted">({{ __('ex: 3306') }})</small></label>
             <input name="DB_PORT" type="text" class="form-control @error('DB_PORT') is-invalid @enderror" id="DB_PORT" placeholder="3306" value="{{ env('DB_PORT') }}" required>
            @error('DB_PORT')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
             <label for="DB_DATABASE">{{ __('Database Name') }}:</label>
             <input name="DB_DATABASE" type="text" class="form-control @error('DB_DATABASE') is-invalid @enderror" id="DB_DATABASE" placeholder="Database Name" value="{{ env('DB_DATABASE') != '' ? env('DB_DATABASE') : old('DB_DATABASE') }}" required>

            @error('DB_DATABASE')
            <div class="invalid-feedback">
               {{ $message }}
            </div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
             <label for="DB_USERNAME">{{ __('Database Username') }}:</label>
             <input name="DB_USERNAME" type="text" class="form-control @error('DB_USERNAME') is-invalid @enderror" id="DB_USERNAME" placeholder="Database User Name" value="{{ env('DB_USERNAME') !='' ? env('DB_USERNAME') : old('DB_USERNAME') }}" required>
             @error('DB_USERNAME')
            <div class="invalid-feedback">
                {{ $message}}
            </div>
            @enderror
        </div>

        <div class="eyeCy col-md-6 mb-3">
             <label for="DB_PASSWORD">{{ __('Database Password') }}:</label>
             <input name="DB_PASSWORD" type="password" class="form-control" id="DB_PASSWORD" placeholder="*****" value="{{ env('DB_PASSWORD') }}">
              <span toggle="#DB_PASSWORD" class="eye fa fa-fw fa-eye field-icon toggle-password"></span>
            
        </div>



  </div>

  <button class="float-right step1btn btn btn-default" type="submit">{{ __('Continue') }}...</button>

</form>

              
          </div>
        </div>
        <p class="text-center m-3 text-white">&copy;{{ date('Y') }} | {{__('Next Hour - Movie Tv Show & Video Subscription Portal')}} | <a class="text-white" href="http://mediacity.co.in">{{ __('Media City') }}</a></p>
      </div>
      
      <div class="corner-ribbon bottom-right sticky green shadow">{{ __('Database') }} </div>
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