<!DOCTYPE html>
<html lang="en" @if(selected_lang()->rtl == 1) dir="rtl" @endif>
<head>
  <title>{{$w_title}}</title>
  <meta charset="utf-8" />  
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta name="Description" content="{{$description}}" />
  <meta name="keyword" content="{{$w_title}}, {{$keyword}}">
  <meta name="MobileOptimized" content="320" />
  <meta name="csrf-token" content="{{ csrf_token() }}">  
  <link rel="icon" type="image/icon" href="{{asset('images/favicon/favicon.png')}}"> <!-- favicon-icon -->
  <!-- theme style -->
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> <!-- google font -->
  @if(selected_lang()->rtl == 0)
    <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/> <!-- bootstrap css -->
  @else
    <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/> <!-- bootstrap css -->
    <link href="{{url('css/bootstrap.rtl.min.css')}}" rel="stylesheet" type="text/css"/><!-- bootstrap rtl css -->
  @endif
  <link href="{{url('css/video_v6-js.css')}}" rel="stylesheet"> <!-- videojs css -->
  <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/> <!-- fontawsome css -->
    @php
if(Schema::hasTable('color_schemes')){
  $color = App\ColorScheme::first();
}
@endphp
@if(isset($color))
@if($color->color_scheme == 'dark')

  <style type="text/css">
    
   :root {
   
    --body_bg_color: #111;
    --btn-prime_bg_color: {{$color->custom_text_color != NULL ? $color->custom_text_color : $color->default_text_color}};
    --footer_bg_color: {{$color->custom_footer_background_color != NULL ? $color->custom_footer_background_color : $color->default_footer_background_color }};
    --background_black_bg_color: #111;
    --background_white_bg_color: #FFF;
    --background_dark-black_bg_color: #000;
    --back2top_bg_color: #DDD;
    --bg-success_bg_color: #198754;
    --blue_bg_color: {{$color->custom_text_color != NULL ? $color->custom_text_color : $color->default_text_color}};
    --light-blue_bg_color: #90DFFE;
    --watchhistory_remove_bg_color: #D9534F;
    --btn-default_bg_color: #515151;

    --blue_border_color: {{$color->custom_text_color != NULL ? $color->custom_text_color : $color->default_text_color}};
    --light-grey_border_color: #B1B1B1;
    --btn-prime_border_color: {{$color->custom_text_color != NULL ? $color->custom_text_color : $color->default_text_color}};
    --see-more_border_color: #B1B1B1;
    --btn-default_border_color: #515151;

    --text_blue_color: {{$color->custom_text_color != NULL ? $color->custom_text_color : $color->default_text_color}};
    --text_black_color: #111;
    --text_light_grey_color: #B1B1B1;
    --text_light_blue_color: {{$color->custom_text_on_color != NULL ? $color->custom_text_on_color : $color->default_text_on_color}};
    --text_grey_color: #949494;
    --text_white_color: #FFF;

    /*add more */
    --navigation_bg_color: {{$color->custom_navigation_color != NULL ? $color->custom_navigation_color : $color->default_navigation_color}};
    --back2top_bg_color_on_hover:  {{$color->custom_back_to_top_bgcolor_on_hover != NULL ? $color->custom_back_to_top_bgcolor_on_hover : $color->default_back_to_top_bgcolor_on_hover}};
    --back2top_color_on_hover: {{$color->custom_back_to_top_color_on_hover != NULL ? $color->custom_back_to_top_color_on_hover : $color->default_back_to_top_color_on_hover}};
    
    }
  </style>
@else
  <style type="text/css">
   :root {
 
      --body_bg_color: #111;
      --btn-prime_bg_color: {{$color->custom_text_color != NULL ? $color->custom_text_color : $color->default_text_color}};
      --footer_bg_color: {{$color->custom_footer_background_color != NULL ? $color->custom_footer_background_color : $color->default_footer_background_color }};
      --background_black_bg_color: #111;
      --background_white_bg_color: #FFF;
      --background_dark-black_bg_color: #000;
      --back2top_bg_color: #DDD;
      --bg-success_bg_color: #198754;
      --blue_bg_color: {{$color->custom_text_color != NULL ? $color->custom_text_color : $color->default_text_color}};
      --light-blue_bg_color: {{$color->custom_text_on_color != NULL ? $color->custom_text_on_color : $color->default_text_on_color}};
      --watchhistory_remove_bg_color: #D9534F;
      --btn-default_bg_color: #515151;

      --blue_border_color: {{$color->custom_text_color != NULL ? $color->custom_text_color : $color->default_text_color}};
      --light-grey_border_color: #B1B1B1;
      --btn-prime_border_color: {{$color->custom_text_color != NULL ? $color->custom_text_color : $color->default_text_color}};
      --see-more_border_color: #B1B1B1;
      --btn-default_border_color: {{$color->custom_text_on_color != NULL ? $color->custom_text_on_color : $color->default_text_on_color}};

      --text_blue_color:{{$color->custom_text_color != NULL ? $color->custom_text_color : $color->default_text_color}};
      --text_black_color: #111;
      --text_light_grey_color: #B1B1B1;
      --text_light_blue_color: {{$color->custom_text_on_color != NULL ? $color->custom_text_on_color : $color->default_text_on_color}};
      --text_grey_color: #949494;
      --text_white_color: #FFF;

      --white: #FFF;

      --navigation_bg_color: {{$color->custom_navigation_color != NULL ? $color->custom_navigation_color : $color->default_navigation_color}};
      --back2top_bg_color_on_hover:  {{$color->custom_back_to_top_bgcolor_on_hover != NULL ? $color->custom_back_to_top_bgcolor_on_hover : $color->default_back_to_top_bgcolor_on_hover}};
      --back2top_color_on_hover: {{$color->custom_back_to_top_color_on_hover != NULL ? $color->custom_back_to_top_color_on_hover : $color->default_back_to_top_color_on_hover}};
    }
  </style>
@endif
@if($color->color_scheme == 'light')
  @if(selected_lang()->rtl == 0)
    <link href="{{url('css/style-light.css')}}" rel="stylesheet" type="text/css"/> 
  @else
    <link href="{{url('css/style-light-rtl.css')}}" rel="stylesheet" type="text/css"/>
  @endif
@else
  @if(selected_lang()->rtl == 0)
    <link href="{{url('css/style.css')}}" rel="stylesheet" type="text/css"/>
  @else
    <link href="{{url('css/style-rtl.css')}}" rel="stylesheet" type="text/css"/>
  @endif
@endif
@endif
  <link href="{{asset('css/custom-style.css')}}" rel="stylesheet" type="text/css"/>
</head>
<body class="bg-black">
  <div class="signup__container container">
    <div class="row"> 
      <div class="col-sm-6 col-md-offset-2 col-md-4 pad-0">
        <div class="container__child signup__thumbnail" style="background-image: url({{ asset('images/login/'.$auth_customize->image) }});">
          <div class="thumbnail__logo">
            @if($logo != null)
              <a href="{{url('/')}}" title="{{$w_title}}"><img src="{{asset('images/logo/'.$logo)}}" class="img-responsive" alt="{{$w_title}}"></a>
            @endif
          </div>
          <div class="thumbnail__content text-center">
            {!! $auth_customize->detail !!}
          </div>
          
          <div class="signup__overlay"></div>
        </div>
         <div class="signup-thumbnail">
          @if($logo != null)
              <a href="{{url('/')}}" title="{{$w_title}}"><img src="{{asset('images/logo/'.$logo)}}" class="img-responsive" alt="{{$w_title}}"></a>
            @endif  
        </div>
      </div>
      <div class="col-sm-6 col-md-4 pad-0">
        <div class="container__child signup__form">
          <form method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name">{{__('Username')}}</label>
              <input id="name" type="text" class="form-control" name="name" placeholder="{{__('Enter Your Username')}}"value="{{ old('name') }}" required autofocus>
              @if ($errors->has('name'))
                <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email">{{__('Email')}}</label>
              <input id="email" type="text" class="form-control" name="email" placeholder="{{__('Enter Your Email')}}" value="{{ old('email') }}" required autofocus>
              @if ($errors->has('email'))
                <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password">{{__('Password')}}</label>
              <input id="password" type="password" class="form-control" name="password" placeholder="{{__('Enter Your Password')}}" value="{{ old('password') }}" required>
                @if ($errors->has('password'))
                  <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
            </div>
            <div class="form-group">
              <label for="password-confirm">{{__('Repeat Password')}}</label>
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{__('Enter Your Password Again')}}" required>
            </div>
            @if($af_system->enable_affilate == 1)
              <div class="form-group{{ $errors->has('refer_code') ? ' has-error' : '' }}">
                <label for="refercode">{{__('Refer code')}}</label>
                <input id="refer_code" type="text" class="form-control" name="refer_code" placeholder="{{__('Enter Refer Code')}}" value="{{ app('request')->input('refercode') ?? old('refer_code') }}" >
                  @if ($errors->has('refer_code'))
                    <span class="help-block">
                      <strong>{{ $errors->first('refer_code') }}</strong>
                    </span>
                  @endif
              </div>
            @endif
          
            @if($configs->captcha == 1)
              <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                  {!! app('captcha')->display() !!}
                  @if ($errors->has('g-recaptcha-response'))
                      <span class="help-block">
                          <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                      </span>
                  @endif
              </div>
            @endif
            <br/>

            <div class="m-t-lg">
              <input class="btn btn--form btn--form-login" type="submit" value={{__('Register')}} />
              <div class="social-login">
                <div class="row">
                
                  <div class="col-md-12">
                    @if($configs->fb_login==1)
                <a href="{{ url('/auth/facebook') }}" class="btn btn--form btn--form-login fb-btn" title={{__('Register With Facebook')}}><i class="fa fa-facebook-f"></i> {{__('Register With Facebook')}}</a>
                @endif
                  @if($configs->google_login==1)
                <a href="{{ url('/auth/google') }}" class="btn btn--form btn--form-login gplus-btn" title={{__('Register With Google')}}><i class="fa fa-google"></i> {{__('Register With Google')}}</a>
                @endif
                @if($configs->amazon_login==1)
                <a href="{{ url('/auth/amazon') }}" class="btn btn--form btn--form-login amazon-btn" title={{__('Register With Amazon')}}><i class="fa fa-amazon"></i> {{__('Register With Amazon')}}</a>
                @endif
                  @if($configs->gitlab_login==1)
                 <a style="background: linear-gradient(270deg, #48367d 0%, #241842 100%);" href="{{ url('/auth/gitlab') }}" class="btn btn--form btn--form-login" title={{__('Register With Gitlab')}}><i class="fa fa-gitlab"></i> {{__('Register With Gitlab')}}</a>
                 @endif                  </div>
                </div>
              </div>
              <a class="signup__link" href="{{url('login')}}">{{__('I am Already A Member')}}</a>
            </div>
          </form>  
        </div>
      </div>
    </div>
  </div>
  <!-- Scripts -->
  <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script> <!-- bootstrap js -->
  <script type="text/javascript" src="{{asset('js/jquery.popover.js')}}"></script> <!-- bootstrap popover js -->
  <script type="text/javascript" src="{{asset('js/jquery.curtail.min.js')}}"></script> <!-- menumaker js -->
  <script type="text/javascript" src="{{asset('js/jquery.scrollSpeed.js')}}"></script> <!-- owl carousel js -->
  <script type="text/javascript" src="{{asset('js/custom-js.js')}}"></script>
  <script type="text/javascript" src="{{url('js/recaptcha_api.js')}}"></script>
</body>
</html>