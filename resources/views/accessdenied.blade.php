<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{ __('Warning !') }}</title>
	<link rel="stylesheet" href="{{ url('installer/css/bootstrap.min.css') }}" crossorigin="anonymous">
   
    <link rel="stylesheet" href="{{ url('installer/css/custom.css') }}">
    <link rel="stylesheet" href="{{ url('installer/css/shards.min.css') }}">
	<link rel="stylesheet" href="{{url('css/font-awesome.min.css')}}">
</head>
<body>
<br/>
	<div class="container">
		<div class="card">
           <div class="card-header">
              <h3 class="m-3 text-center text-danger">
                  {{ __('Warning') }}
              </h3>
           </div>
          	<div class="card-body">
          		<div class="card-body" id="stepbox">
               			<strong class="text-black">{{ __('You tried to update the domain which is invalid !') }} {{-- <a target="_blank" href="https://codecanyon.net/item/next-hour-movie-tv-show-video-subscription-portal-cms/21435489/support">{{ __('Support') }}</a> {{ __('for updation in domain.') }}</strong> --}}
               			<hr>
               			<h4>{{ __('You can use this project only in single domain for multiple domain please check License standard') }} <a target="_blank" href="https://codecanyon.net/licenses/standard">{{ __('here') }}</a>.</h4>
                    <hr>
                    <form class="needs-validation" action="{{ url('/change-domain') }}" method="POST" novalidate>
                      @csrf

                      <div class="form-group">
                        <label>
                          {{__('Enter the new domain where you want to move the license')}} : <span class="text-danger">*</span>
                        </label>
                        <input required class="form-control @error('domain') is-invalid @enderror" type="text" name="domain" value="{{ old('domain') }}" placeholder="eg:example.com"/>

                        @if ($errors->has('domain'))
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('domain') }}</strong>
                          </span>
                        @endif

                        <small class="text-muted">
                          <i class="fa fa-question-circle"></i> {{__('IF in some cases on current domain if you face the error you can re-update the domain by entering here')}}.
                        </small>

                        <br>

                        <small class="text-muted">
                          <i class="fa fa-question-circle"></i> {{__('IF still facing the access denied error please con')}} <a target="_blank" href="https://codecanyon.net/item/next-hour-movie-tv-show-video-subscription-portal-cms/21435489/support">{{ __('Support') }}</a> {{ __('for updation in domain.') }}.
                        </small>

                      </div>
                      

                      <div class="form-group">
                        <button type="submit" class="btn btn-md btn-default">
                         {{__(' Change domain')}}
                        </button>
                      </div>
                    </form>
                  <hr>  
   				</div>
   			</div>
        <p class="text-center m-3 text-white">&copy;{{ date('Y') }} | {{__('Next Hour - Movie Tv Show & Video Subscription Portal Cms')}} | <a class="text-white" href="http://mediacity.co.in">{{ __('Media City') }}</a></p>
      </div>
      <div class="corner-ribbon bottom-right sticky green shadow">{{ __('Warning') }} </div>
	
	</div>

</body>
    <script type="text/javascript" src="{{url('installer/js/bootstrap.min.js')}}"></script> <!-- bootstrap js -->
    <script type="text/javascript" src="{{url('installer/js/popper.min.js')}}"></script> 
    <script src="{{ url('installer/js/shards.min.js') }}"></script>
    <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
        }, false);
      });
      }, false);
    })();
  </script>
</html>