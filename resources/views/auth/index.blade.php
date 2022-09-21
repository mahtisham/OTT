@extends('layouts.theme')
@section('title',"2 Factor Auth | ")
@section('main-wrapper')
 <section id="main-wrapper" class="main-wrapper home-page user-account-section">
	<div class="container-fluid faq-main-block terms-main-block">
		<h4 class="heading">{{ __('Enable 2 Factor Auth') }}</h4>
		
		<div class="panel-setting-main-block">
	        <div class="panel-setting">
	          	<div class="row">
		            <div class="col-md-9"> 
		            	<p class="info">
							{{__('Two factor authentication (2FA) strengthens access security by requiring two methods (also referred to as factors) to verify your identity. Two factor authentication protects against phishing, social engineering and password brute force attacks and secures your logins from attackers exploiting weak or stolen credentials.')}}
						</p>
						<div class="info-heading">
							@if($data['google2fa_url'] != '' )
								1. {{__('Scan this QR code with your Google Authenticator App')}}:
							@endif
						</div>
						
						@if($data['google2fa_url'] != '' )
						<div class="qr-scan">
							{!! $data['google2fa_url'] !!}
						</div>
						@endif
						@if($data['google2fa_url'] == '' )
						<form action="{{ url('/generate2faSecret') }}" method="POST">
							@csrf
							
							<div class="form-group">
								<button type="submit" class="btn btn-default">
									{{__('Generate Secret Key to Enable 2FA')}}
								</button>
							</div>

						</form>
						@endif

						@if(auth()->user()->google2fa_secret != '' && auth()->user()->google2fa_enable == 0 )
						<form action="{{ url('/2fa-valid') }}" method="POST">
							@csrf
							<div class="form-group enable-password">
								<label class="font-weight-normal">{{__('Enter pin from app or above code')}}: <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="one_time_password">
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-default">
									{{__('Enable 2FA Auth')}}
								</button>
							</div>
						</form>
						@endif

						@if(auth()->user()->google2fa_enable == 1)
							<form action="{{ url('/disable-2fa') }}" method="POST">
								@csrf

								<div class="form-group disable-password">
									<label class="font-weight-normal">{{__('Enter current password to disable 2FA')}}: <span class="text-danger">*</span></label>
									<input required type="password" placeholder="{{__('Enter current password')}}" class="form-control @error('password') is-invalid @enderror" name="password">

									@error('password')
										<span class="invalid-feedback text-danger" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-default">
										{{__('Disable 2FA Auth')}}
									</button>
								</div>
							</form>
						@endif
		            </div>
	       		</div>

	    	</div>
		</div>
		
	</div>
</section>
@endsection