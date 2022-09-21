@extends('layouts.theme')
@section('title','Enter OTP | ')
@section('main-wrapper')
    <div class="checkout-box faq-page otp-page">
        <div class="container-fluid">
        
            <div class="row">
                
                    <div class="col-md-9">

                        <h6><p>{{__('Two factor authentication (2FA) strengthens access security by requiring two methods (also referred to as factors) to verify your identity. Two factor authentication protects against phishing, social engineering and password brute force attacks and secures your logins from attackers exploiting weak or stolen credentials.')}}</p></h6>

                        <div class="card">
                            <div class="card-body">
                                <form action="{{ url('/valid-2fa') }}" method="POST">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label class="font-weight-normal">{{__('Enter the pin from Google Authenticator app')}}: <span class="text-danger">*</span></label>
                                        <input required type="password" class="form-control @error('password') is-invalid @enderror " name="password">

                                        @error('password')
    										<span class="invalid-feedback text-danger" role="alert">
    											<strong>{{ $message }}</strong>
    										</span>
    									@enderror

                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-md btn-primary">
                                            {{__('Login')}}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection