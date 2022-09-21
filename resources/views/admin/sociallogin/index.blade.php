
@extends('layouts.admin')
@section('title',__('Social Login'))
@section('content')

 <div class="admin-form-main-block mrgn-t-40">
<div class="container">
	<div class="box-body">
		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
		<div class="row">
		
		@php
		$fb_login_status = App\Config::select('fb_login')->where('id','=',1)->first();
		$google_login_status = App\Config::select('google_login')->where('id','=',1)->first();
		$gitlab_login_status = App\Config::select('gitlab_login')->where('id','=',1)->first();
		$amazon_login_status = App\Config::select('amazon_login')->where('id','=',1)->first();

		@endphp
		<div class="col-md-6">
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-facebook"></i> {{__('Facebook Login Setting')}}
				</div>
				
				<div class="panel-body">
					<form action="{{ route('key.facebook') }}" method="POST">
		    {{ csrf_field() }}
		    <div class="form-group">
		    <label for="">{{__('Enable Facebook Login')}} </label>
			<input {{ $fb_login_status->fb_login == 1 ? 'checked' : "" }} type="checkbox" class="toggle-input" name="fb_check" id="fb_check">
            <label for="fb_check"></label>
				 
		    </div>
			<div id="fb_box_dtl" style="{{ $fb_login_status->fb_login == 1 ? '' : "display: none
			" }}">
				<div class="form-group">
			<label for="">{{__('Facebook Client ID')}}</label>
			<input type="text" value="{{ $env_files['FACEBOOK_CLIENT_ID'] }}" name="FACEBOOK_CLIENT_ID" class="form-control">
			</div>
			<div class="search form-group">
				<label for="">{{__('Facebook Secret ID')}}</label>	
			<input type="password" value="{{ $env_files['FACEBOOK_CLIENT_SECRET'] }}" name="FACEBOOK_CLIENT_SECRET" class="form-control" id="password-field" >
			<span  toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
			</div>
			
			<div class="form-group">
				<label for="">{{__('Facebook Redirect URL')}}</label>
			<input type="text" placeholder="https://yoursite.com/login/facebook/callback" value="{{ $env_files['FACEBOOK_CALLBACK'] }}" name="FACEBOOK_CALLBACK" class="form-control">
			</div>
			</div>
			<button type="submit" class="btn btn-md btn-primary">
				<i class="fa fa-save"></i> {{__('Save')}}
			</button>
			</form>
				</div>
			</div>
			
			
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-google"></i> {{__('Google Login Setting')}}
				</div>
				
				<div class="panel-body">
					
			<form action="{{  route('key.google') }}" method="POST">
		     {{ csrf_field() }}

			<div class="form-group">
				<label for="">{{__('Enable Google Login')}} </label>
			<input {{ $google_login_status->google_login == 1 ? 'checked' : "" }} type="checkbox" class="toggle-input" name="google_login" id="google_login" >
             <label for="google_login"></label>
			</div>
			
			<div id="g_box_detail" style="{{ $google_login_status->google_login == 1 ? '' : "display: none
			" }}">
				<div class="form-group">
				<label for="">{{__('Google Client ID')}}</label>
			<input type="text" value="{{ $env_files['GOOGLE_CLIENT_ID'] }}" name="GOOGLE_CLIENT_ID" class="form-control" >
			</div>
			
			
			<div class="search form-group">
			<label for="">{{__('Google Secret ID')}}</label>
			<input type="text" value="{{ $env_files['GOOGLE_CLIENT_SECRET'] }}" name="GOOGLE_CLIENT_SECRET" class="form-control" id="password-field2" >
			
			<span toggle="#password-field2" class="fa fa-fw fa-eye field-icon toggle-password">
			</span>

			</div>
			
			<div class="form-group">
				<label for="">{{__('GoogleRedirectURL')}}</label>
				<input type="text" placeholder="https://yoursite.com/login/google/callback" value="{{ $env_files['GOOGLE_CALLBACK'] }}" name="GOOGLE_CALLBACK" class="form-control"  >
			</div>
			</div>
			
			
			
			<button type="submit" class="btn btn-md btn-primary">
				<i class="fa fa-save"></i> {{__('Save')}}
			</button>
			</form>
				</div>
			</div>
			

		</div>

		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-gitlab"></i> {{__('Git Lab Login Setting')}}
				</div>
				
				<div class="panel-body">
					
			<form action="{{  route('key.gitlab') }}" method="POST">
		     {{ csrf_field() }}

			<div class="form-group">
				<label for="">{{__('Enable GITLAB Login')}} </label>
				<input {{ $gitlab_login_status->gitlab_login == 1 ? 'checked' : "" }} type="checkbox" class="toggle-input" name="git_lab_check" id="git_lab_check">
             <label for="git_lab_check"></label>
			</div>
			
			<div style="{{ $gitlab_login_status->gitlab_login == 1 ? '' : "display: none
			" }}" id="git_lab_box">
				<div class="form-group">
		    	<label for="">{{__('GITLAB Client ID')}}</label>
				<input type="text" value="{{ $env_files['GITLAB_CLIENT_ID'] }}" name="GITLAB_CLIENT_ID" class="form-control" >
		    	</div>
			
			
				<div class="search form-group">
					<label for="">{{__('GITLAB SecretID')}}</label>
				<input type="password" value="{{ $env_files['GITLAB_CLIENT_SECRET'] }}" name="GITLAB_CLIENT_SECRET" class="form-control" id="password-field3" >
				
				<span toggle="#password-field3" class="fa fa-fw fa-eye field-icon toggle-password">
				</span>
				
				</div>
			
				<div class="form-group">
					<label for="">{{__('GITLAB Redirect URL')}}</label>
					<input type="text" placeholder="https://yoursite.com/login/google/callback" value="{{ $env_files['GITLAB_CALLBACK'] }}" name="GITLAB_CALLBACK" class="form-control">
				</div>
			
			
			
			</div>


			<button type="submit" class="btn btn-md btn-primary">
				<i class="fa fa-save"></i> {{__('Save')}}
			</button>
		    
			</form>
				</div>
			</div>
			

		</div>
		
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-amazon"></i> {{__('Amazon Login Setting')}}
				</div>
				
				<div class="panel-body">
					
			<form action="{{  route('key.amazon') }}" method="POST">
		     {{ csrf_field() }}

			<div class="form-group">
				<label for="">{{__('Enable AMAZON Login')}} </label>
				<input {{ $amazon_login_status->amazon_login == 1 ? 'checked' : "" }} type="checkbox" class="toggle-input" name="amazon_lab_check" id="amazon_lab_check">
             <label for="amazon_lab_check"></label>
			</div>
			
			<div style="{{ $amazon_login_status->amazon_login == 1 ? '' : "display: none
			" }}" id="amazon_lab_box">
				<div class="form-group">
		    	<label for="">{{__('AMAZON LOGIN ID')}}</label>
				<input type="text" @if(isset($env_files['AMAZON_LOGIN_ID']))value="{{ $env_files['AMAZON_LOGIN_ID'] }}" @endif name="AMAZON_LOGIN_ID" class="form-control" >
		    	</div>
			
			
				<div class="search form-group">
					<label for="">{{__('AMAZON Login Secret')}}</label>
				<input type="password" @if(isset($env_files['AMAZON_LOGIN_SECRET']))value="{{ $env_files['AMAZON_LOGIN_SECRET'] }}" @endif name="AMAZON_LOGIN_SECRET" class="form-control" id="amazon-password-field3" >
				
				<span toggle="#amazon-password-field3" class="fa fa-fw fa-eye field-icon toggle-password">
				</span>
				
				</div>
			
				<div class="form-group">
					<label for="">{{__('AMAZON Redirect URL')}}</label>
					<input type="text" placeholder="https://yoursite.com/auth/amazon/callback" @if(isset($env_files['AMAZON_LOGIN_REDIRECT'])) value="{{ $env_files['AMAZON_LOGIN_REDIRECT'] }}" @endif name="AMAZON_LOGIN_REDIRECT" class="form-control">
				</div>
			
			
			
			</div>


			<button type="submit" class="btn btn-md btn-primary">
				<i class="fa fa-save"></i> {{__('Save')}}
			</button>
		    
			</form>
				</div>
			</div>
			

		</div>

	</div>
	</div>
</div>
	</div>

@endsection
@section('custom-script')
<script type="text/javascript">
  
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


 $('#fb_check').on('change',function(){
 	if ($('#fb_check').is(':checked')){
   		$('#fb_box_dtl').show('fast');
	}else{
		$('#fb_box_dtl').hide('fast');
	}
 });

 $('#google_login').on('change',function(){
 	if ($('#google_login').is(':checked')){
   		$('#g_box_detail').show('fast');
	}else{
		$('#g_box_detail').hide('fast');
	}
 });


 $('#git_lab_check').on('change',function(){
 	if ($('#git_lab_check').is(':checked')){
   		$('#git_lab_box').show('fast');
	}else{
		$('#git_lab_box').hide('fast');
	}
 });
 $('#amazon_lab_check').on('change',function(){
 	if ($('#amazon_lab_check').is(':checked')){
   		$('#amazon_lab_box').show('fast');
	}else{
		$('#amazon_lab_box').hide('fast');
	}
 });


  

</script>



@endsection