@extends('layouts.theme')
@section('title',__('Thankyou Page'))
@section('main-wrapper')
<section id="main-wrapper" class="main-wrapper home-page user-account-section">
    <div class="purchase-plan-main-block main-home-section-plans purchase-section">
        <div class="panel-setting-main-block panel-purchase thank-you-page">
            <div class="container">
                <div class="snip1404 row">
                    <div class="col-md-6">
                        <h3 class="thank-you-heading text-center">{{__('You have successfully Subscribed!')}}</h3><br>
                        <img src="{{ url("images/thankyou.svg") }}" class="img img-fluid" alt="thankyou">
                        
                        <div class="plan-select"> 
                            <a href="{{url('/')}}" class="btn btn-prime btn-subscribe">{{__('Continue Watching')}}</a>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</section>
@endsection