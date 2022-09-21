@extends('layouts.theme')
@section('title',__('Purchase Plan'))
@section('main-wrapper')
  <!-- main wrapper -->
  <section id="main-wrapper" class="main-wrapper home-page user-account-section">
    <div class="container-fluid">
      <h4 class="heading">{{__('pricing plan')}}</h4>
      <ul class="bradcump">
        <li><a href="{{url('account')}}">{{__('dashboard')}}</a></li>
        <li>/</li>
        <li>{{__('pricing plan')}}</li>
      </ul>
      <div class="purchase-plan-main-block main-home-section-plans purchase-section">
        <div class="panel-setting-main-block panel-purchase">
          <div class="container">
            <div class="plan-block-dtl">
              <h3 class="plan-dtl-heading">{{__('purchase membership')}}</h3>
              <h4 class="plan-dtl-sub-heading">{{__('Purchase any of the membership package from below.')}}</h4>
              <div class="plan-dtl-list">
                <ul>
                  <li>{{__('Select any of your preferred membership package & make payment.')}}
                  </li>
                  <li>{{__('You can cancel your subscription anytime later.')}}
                  </li>
                </ul>
              </div>
            </div>
            
            <div class="snip1404 row">
              @foreach($plans as $plan)
              @if($plan->delete_status == 1)
                @if($plan->status != 'inactive')
                  <div class="col-lg-3 col-sm-6">
                    <div class="main-plan-section  @if(isset($current_subscription) && $current_subscription->package_id == $plan->id) main-plan-section-two @endif">
                      <header>
                        <h4 class="plan-home-title">
                         {{$plan->name}} 
                        </h4>
                        <div class="plan-cost"><span class="plan-price">
                          @if(Session::has('current_currency'))

                            {{ currency($plan->amount, $from = $plan->currency, $to = Session::has('current_currency') ? ucfirst(Session::get('current_currency')) : $plan->currency, $format = true) }}</span> <span class="plan-type">
                            {{ currency($plan->amount, $from = $plan->currency, $to = Session::has('current_currency') ? ucfirst(Session::get('current_currency')) : $plan->currency, $format = true) }} / {{($plan->interval_count)}} 
                          @else
                            <i class="{{$plan->currency_symbol}}"></i>{{$plan->amount}}</span><span class="plan-type">
                            <i class="{{$plan->currency_symbol}}"></i> {{number_format(($plan->amount) / ($plan->interval_count),2)}} /
                          @endif
                            @if($plan->interval == 'year')
                              {{__('Yearly')}}
                            @elseif($plan->interval == 'month')
                              {{__('Monthly')}}
                            @elseif($plan->interval == 'week')
                              {{__('Weekly')}}
                            @elseif($plan->interval == 'day')
                              {{__('Daily')}}
                            @endif
                        </span></div>
                      </header>
                        
                      @php
                      $pricingTexts = App\PricingText::where('package_id',$plan->id)->get();
                      @endphp
                      @if(isset($package_feature))
                        @foreach($package_feature as $pf)
                           <ul class="plan-features">
                            @isset($plan['feature'])
                             <li>@if(in_array($pf->id, $plan['feature']))<i class="fa fa-check "> </i>@else <i class="fa fa-close "> </i> @endif {{ $pf->name }}</li> @endisset
                           </ul>
                        @endforeach
                      @endif
                  
                      @auth
                        @if(isset($current_subscription) && $current_subscription->package_id == $plan->id)
                        <div class="plan-select"><a class="btn btn-prime btn-prime-bg">{{__('already subscribe')}}</a></div>

                        @else
                          @if(!isset($current_subscription) && $current_subscription == NULL)
                            @if($plan->free == 1 && $plan->status == 'upcoming')
                                <div class="plan-select"><a href="#" class="btn btn-prime">{{__('COMING SOON!')}}</a></div>
                            @elseif($plan->free == 1 && $plan->status == 'active')
                            <form action="{{route('free.package.subscription',$plan->id)}}" method="POST">
                              @csrf
                                <div class="plan-select btn-prime-subs"><a class="btn btn-prime"><input type="submit" class="btn-subscribe" value="{{__('subscribe')}}"></a></div>
                              </form>
                            @elseif($plan->status == 'upcoming')
                            <div class="plan-select"><a href="#" class="btn btn-prime">{{__('COMING SOON!')}}</a></div>
                            
                            @else
                              <div class="plan-select"><a href="{{route('get_payment', $plan->id)}}" class="btn btn-prime">{{__('subscribe')}}</a></div>
                            @endif
                          @endif
                        @endif
                        
                      @else
                        <div class="plan-select"><a href="{{route('register')}}">{{__('register now')}}</a></div>
                      @endauth
                    </div>
                  </div>
                @endif
              @endif
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end main wrapper -->
@endsection