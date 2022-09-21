@extends('layouts.theme')
@section('title',__('Welcome'))
@section('main-wrapper')
<!-- main wrapper -->

  

  <section id="main-wrapper" class="main-wrapper home-page">
  
    <div id="home-out-section-slider" class="home-out-section-slider home-out-section owl-carousel">
      @if (isset($blocks) && count($blocks) > 0)
      @foreach ($blocks as $block)
      <div class="slider-block">
        <div class="home-out-section-img">
          <img src="{{ url('images/main-home/'.$block->image) }}" class="img-fluid" alt="">
          <div class="overlay-bg {{$block->left == 1 ? 'gredient-overlay-left' : 'gredient-overlay-right'}} "></div>
          <div class="home-out-section-dtl">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6 col-sm-7 {{$block->left == 1 ? 'col-md-offset-6 col-sm-offset-6 col-sm-6 col-md-6 text-right' : ''}}">
                  <h2 class="section-heading">{{$block->heading}}</h2>
                  <p class="section-dtl {{$block->left == 1 ? 'pad-lt-100' : ''}}">{{$block->detail}}</p>
                  @if ($block->button == 1)
                    @if ($block->button_link == 'login')
                      @guest
                        <a href="{{url('login')}}" class="btn btn-prime">{{$block->button_text}}</a>
                      @endguest
                    @else
                      @guest
                        <a href="{{url('register')}}" class="btn btn-prime">{{$block->button_text}}</a>
                      @endguest
                    @endif
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
      @endif
    </div>

    
    <!-- Pricing plan main block -->
    

    @if(isset($remove_subscription) && $remove_subscription == 0) 
      @if(isset($plans) && count($plans) > 0)
     
        <div class="purchase-plan-main-block  main-home-section-plans">
          <div class="panel-setting-main-block panel-subscribe">
            <div class="container-fluid">
              <div class="plan-block-dtl">
                <h3 class="plan-dtl-heading">{{__('Purchase any of the membership package from below.')}}</h3>
                <div class="plan-dtl-list">
                  
                  <ul>
                    <li>{{__('Select any of your preferred membership package & make payment.')}}
                    </li>
                    <li>{{__('You can cancel your subscription anytime later.')}} 
                    </li>
                   
                  </ul>
                 
                </div>
               
              </div>
              @if(Auth::check())
                @php  
                  $id = Auth::user()->id;
                  $getuserplan = App\PaypalSubscription::where('status','=','1')->where('user_id',$id)->orderBy('id','DESC')->first();
                 
                @endphp
              @endif
                <?php
                  $today =  date('Y-m-d h:i:s');
                ?>

            

              <div class="snip1404 row">
                  
                @foreach($plans as $plan)
                @if($plan->delete_status ==1 )
                  @if($plan->status != 'inactive')
                    <div class="col-lg-3 col-sm-6">
                      <div class="main-plan-section @if(isset($getuserplan['package_id']) && ($getuserplan['package_id'] == $plan->id) && ($getuserplan->status == '1') && ($today <= $getuserplan->subscription_to)) main-plan-section-two  @endif">
                        <header>
                          <h4 class="plan-home-title">
                            {{$plan->name}}
                          </h4>
                          <div class="plan-cost"><span class="plan-price">
                            @if(Session::has('current_currency'))
                              {{ currency($plan->amount, $from = $plan->currency, $to = Session::has('current_currency') ? ucfirst(Session::get('current_currency')) : $plan->currency_symbol, $format = true) }}</span><span class="plan-type">
                              {{ currency($plan->amount, $from = $plan->currency, $to = Session::has('current_currency') ? ucfirst(Session::get('current_currency')) : $plan->currency_symbol, $format = true) }}/
                                {{$plan->interval}}
                            @else
                              <i class="{{$plan->currency_symbol}}"></i>{{$plan->amount}}</span><span class="plan-type">
                              <i class="{{$plan->currency_symbol}}"></i> {{number_format(($plan->amount) / ($plan->interval_count),2)}}/
                                {{$plan->interval}}
                            @endif
                          </span></div>
                        </header>
                        @php
                       
                      $pricingTexts = App\PricingText::where('package_id',$plan->id)->get();
                        @endphp
                        @if(isset($package_feature))
                          @foreach($package_feature as $pf)
                            @isset($plan['feature'])
                             <ul class="plan-features">
                              
                               <li>@if(in_array($pf->id, $plan['feature']))<i class="fa fa-check "> </i> @else <i class="fa fa-close"></i> @endif {{ $pf->name }}</li> 
                             </ul>
                            @endisset
                          @endforeach
                        @endif
                        
                        @auth
                        @if(isset($getuserplan['package_id']) && $getuserplan['package_id'] == $plan->id && $getuserplan->status == "1" && $today <= $getuserplan->subscription_to )
                          
                          <div class="plan-select"><a class="btn btn-prime btn-prime-bg">{{__('Already Subscribe')}}</a></div>

                        @else
                          @if(!isset($getuserplan['package_id']))
                            @if($plan->free == 1 && $plan->status == 'upcoming')
                              <div class="plan-select"><a href="#">{{__('COMING SOON!')}}</a></div> 
                            @elseif($plan->free == 1 && $plan->status == 'status')
                              <form action="{{route('free.package.subscription',$plan->id)}}" method="POST">
                                @csrf
                                <div class="plan-select btn-prime-subs"><a  class="btn btn-prime"><input type="submit" class="btn-subscribe" value="{{__('Subscribe')}}"></a></div>
                              </form>
                            @elseif($plan->status == 'upcoming')
                              <div class="plan-select"><a href="#">{{__('COMING SOON!')}}</a></div> 
                            @else
                              <div class="plan-select"><a href="{{route('get_payment', $plan->id)}}" class="btn btn-prime">{{__('Subscribe')}}</a></div>
                            @endif
                          @endif

                        @endif
                        @else
                            @if($plan->status == 'upcoming')
                               <div class="plan-select"><a href="#">{{__('COMING SOON!')}}</a></div> 
                            @else
                            <div class="plan-select"><a href="{{route('register')}}">{{__('Register Now')}}</a></div>
                            @endif
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
      @endif
    @endif



    
    <!-- end featured main block -->
    <!-- end out section -->
  </section>
<!-- end main wrapper -->
@endsection
@section('script')
<script>
        
        @if(isset(Auth::user()->multiplescreen))
        @if((Auth::user()->multiplescreen->activescreen!= NULL))
         $(document).ready(function(){

           $('#showM').hide();

           });
          @else
           $(document).ready(function(){

            $('#showM').modal();

           });
          @endif
          @endif



</script>
@endsection