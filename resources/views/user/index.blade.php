@extends('layouts.theme')
@section('title','User Dashboard')
@section('main-wrapper')
@php

$bfree = null;
$config=App\Config::first();
$auth=Auth::user();
if ($auth->is_admin==1) {
  $bfree=1;
}else{
  $ps=App\PaypalSubscription::where('user_id',$auth->id)->orderBy('id','DESC')->first();
    if (isset($ps)) {
      $current_date = Illuminate\Support\Carbon::now();
      if (date($current_date) <= date($ps->subscription_to)) {
        
        if ($ps->package_id==100 || $ps->package_id == 0) {
            $bfree=1;
        }else{
          $bfree=0;
        }
      }
    }
}
                         
                    
@endphp
  <!-- main wrapper -->
  <section id="main-wrapper" class="main-wrapper user-account-section">
    
    <div class="container-fluid">

      <div class="row">
        <div class="alert" id="message" style="display: none"></div>
        <div class="col-lg-3 col-md-4 col-sm-4">
          <div class="user-img">
            @if(isset($auth->image) && $auth->image != NULL)
              <img src="{{url('images/users/'.$auth->image)}}">
            @else
              <img src="{{url('images/default.jpg')}}">
            @endif
            <h4 class="user-img-name">{{auth()->user()->name}}</h4>
            <div class="user-mail">{{auth()->user()->email}}</div>
            <div class="membership-dtl">
              @if($auth->is_admin==1)
                <div class="membership-sub">{{__('Subscribed to')}} : {{__('FREE')}}</div>
              @else
                @if($bfree==1 && $ps->method == 'free')

                  <div class="membership-sub">{{__('Subscribed to')}} : {{__('Trail')}}</div>

                  <div class="membership-sub-date">{{__('Subscription valid till')}} : {{date('M j, Y  g:i a',strtotime($ps->subscription_to))}} </div>

                @elseif($bfree==0)
                
                  @if(isset($ps) && $current_subscription != NULL &&  $current_subscription->subscription_to < $ps->subscription_to)
                    @php
                        $psn=App\Package::where('id',$ps->package_id)->first();
                    @endphp

                    <div class="membership-sub">{{__('Subscribed to')}} : {{$psn != NULL ? ucfirst($psn['name']) : '-'}}</div>
                    <div class="membership-sub-date">{{__('Subscription valid till')}} : {{date('M j, Y  g:i a',strtotime($psn->subscription_to))}} </div>
                  @else
                    @if($current_subscription != null)
                      <div class="membership-sub">{{__('Subscribed to')}} : {{$method == 'stripe' ? ucfirst($current_subscription->name) : ucfirst($current_subscription->plan->name)}}</div>
                      <div class="membership-sub-date">{{__('Subscription valid till')}} : {{date('M j, Y  g:i a',strtotime($current_subscription->subscription_to))}} </div>
                    @endif
                  @endif
                  
                @else

                  @if($current_subscription != null)
                    <div class="membership-sub">{{__('Subscribed to')}} : {{$method == 'stripe' ? ucfirst($current_subscription->name) : ucfirst($current_subscription->plan->name)}}</div>
                    <div class="membership-sub-date">{{__('Subscription valid till')}} : {{date('M j, Y  g:i a',strtotime($current_subscription->subscription_to))}} </div>
                  @endif
                @endif
              @endif
            
              @if($current_subscription != null && $method == 'stripe') 
                @if(getPlan() == 0)
                  <a href="{{route('resumeSub', $current_subscription->stripe_plan)}}" class="btn btn-prime">{{__('resume subscription')}}</a>
                @else
                  <a href="{{route('cancelSub', $current_subscription->stripe_plan)}}" class="btn btn-prime">{{__('cancel subscription')}}</a>
                @endif
              @elseif($current_subscription != null && $method == 'paypal') 
                @if($current_subscription->status == 0)
                  <a href="{{route('resumeSubPaypal')}}" class="btn btn-prime">{{__('resume subscription')}}</a>
                @elseif ($current_subscription->status == 1)
                  <a href="{{route('cancelSubPaypal')}}" class="btn btn-prime">{{__('cancel subscription')}}</a>
                @endif
              @else 
                @if($auth->is_admin != 1)
                  <a href="{{url('account/purchaseplan')}}" class="btn btn-prime">{{__('subscribe now')}}</a>
                @endif
              @endif
            
            </div>
            <form method="POST"  id="upload_form" accept-charset="UTF-8" enctype="multipart/form-data">
              @csrf
              <div class="user-edit-icon">
                <label for="file-input">
                  <i class="fa fa-camera"></i>
                </label>
                <input id="file-input" type="file" name="image" accept=".png, .jpg, .jpeg, .webp, .gif"/>
              </div>
            </form>
          </div>
          @php
            $nav=App\Menu::orderBy('position','ASC')->get();
          @endphp
          <div class="user-account-tab">
            <div id="exTab1"> 
              <ul class="nav nav-pills" id="user-tab" role="tablist">
                @if($af_system->enable_affilate == 1)
                <li class="nav-item">
                  <a class="nav-link" id="pills-affiliate-tab" data-toggle="pill" href="#affiliate" role="tab" aria-controls="pills-affiliate" aria-selected="false"><i class="fa fa-gift"></i>{{__('Dashboard')}}</a>
                </li>
                @endif

                @if($walletsetting->enable_wallet == 1)
                <li class="nav-item">
                  <a class="nav-link" id="pills-wallet-tab"  href="{{route('user.wallet.show')}}" role="tab" aria-controls="pills-wallet" aria-selected="false"><i class="fa fa-credit-card"></i>{{__('Wallet')}}</a>
                </li>
                @endif

                <li class="nav-item">
                  <a class="nav-link"  id="pills-contact-tab" data-toggle="pill" href="#paymenthistory" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="fa fa-credit-card"></i>{{__('Payment History')}}</a>
                </li>

                <li class="nav-item active">
                  <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#details" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fa fa-user"></i> {{__('Details')}}</a>
                </li>
               
                <li class="nav-item">
                  <a class="nav-link" id="pills-history-tab" href="{{route('watchhistory')}}" role="tab" aria-controls="pills-history" aria-selected="false"><i class="fa fa-history"></i>{{__('WatchHistory')}}</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" id="pills-hidden-tab" href="{{route('hidden.videos')}}" role="tab" aria-controls="pills-hidden" aria-selected="false"><i class="fa fa-ban"></i>{{__('Hidden Video')}}</a>
                </li>
                @if (isset($nav))
                <li class="nav-item">
                  <a class="nav-link" id="pills-watchlist-tab"  href="{{url('account/watchlist', $nav[0]->slug)}}" role="tab" aria-controls="pills-watchlist" aria-selected="false"><i class="fa fa-heart"></i>{{__('Watchlist')}}</a>
                </li>
                @endif
                
              </ul>
             
            </div>
          </div>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-8">
          <div id="exTab1" class="container"> 
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade active" id="details" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="edit-profile-main-block">
                  <div class="row">
                    <div class="col-lg-6 col-sm-6">
                      <div class="edit-profile-block">
                        <h4 class="panel-setting-heading">{{__('Change Email')}}</h4>
                        <div class="info">{{__('current email')}}: {{auth()->user()->email}}</div>
                        <form method="POST" action="{{route('user.profile')}}" accept-charset="UTF-8">
                          @csrf
                          
                          <div class="form-group {{ $errors->has('new_email') ? ' has-error' : '' }}">
                            <label for="new_email">{{__('new email')}}</label>
                            <input class="form-control" name="new_email" type="email" id="new_email">
                            <small class="text-danger">{{ $errors->first('new_email') }}</small>
                          </div>
                          <div class="form-group">
                            <label for="current_password">{{__('current password')}}</label>
                            <input class="form-control" name="current_password" type="password" value="" id="current_password">
                            <small class="text-danger">{{ $errors->first('current_password') }}</small>
                          </div>
                          <div class="btn-group">
                            <input class="btn btn-success" type="submit" value="{{__('update')}}">
                          </div>
                        </form>
                      </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                      <div class="edit-profile-block">
                        <h4 class="panel-setting-heading">{{__('change password')}}</h4>
                        <div class="info">{{__('want to change your password')}}</div>
                        <form method="POST" action="{{url('account/profile')}}" accept-charset="UTF-8">
                          @csrf
                          <div class="form-group {{ $errors->has('current_password') ? ' has-error' : '' }}">
                            <label for="current_password">{{__('current password')}}</label>
                            <input class="form-control" name="current_password" type="password" value="" id="current_password">
                            <small class="text-danger">{{ $errors->first('current_password') }}</small>
                          </div>
                          <div class="form-group {{ $errors->has('new_password') ? ' has-error' : '' }}">
                            <label for="new_password">{{ __('new password')}}</label>
                            <input class="form-control" name="new_password" type="password" value="" id="new_password">
                            <small class="text-danger">{{ $errors->first('new_password') }}</small>
                          </div>
                          <div class="btn-group">
                            <input class="btn btn-success" type="submit" value="{{__('update')}}">
                          </div>
                        </form>
                      </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                      <div class="edit-profile-block">
                        <h4 class="panel-setting-heading">{{__('update age and mobile')}}</h4>
                        <div class="info">{{__('want to change age and mobile')}}</div>
                        <form method="POST" action="{{route('user.age')}}" accept-charset="UTF-8">
                          @csrf
                          <div class="form-group {{ $errors->has('age') ? ' has-error' : '' }}">
                            <label for="age">{{__('Age')}}</label>
                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please enter your Age')}}"></i>
                            <input type="number" class="form-control" name="age" @if(isset(Auth::user()->age)) value="{{Auth::user()->age}}" @endif >   
                            <small class="text-danger">{{ $errors->first('age') }}</small>
                          </div>
                          <div class="form-group {{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label for="mobile">{{ __('mobile no')}}</label>
                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('enter your mobile no')}}"></i>
                            <input type="number" class="form-control" name="mobile" @if(isset(Auth::user()->mobile)) value="{{Auth::user()->mobile}}"@endif>   
                            <small class="text-danger">{{ $errors->first('mobile') }}</small>
                          </div>
                          <div class="btn-group">
                            <input class="btn btn-success" type="submit" value="{{__('update')}}">
                          </div>
                        </form>
                      </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                      <div class="edit-profile-block">
                        <h4 class="panel-setting-heading">{{__('Other Settings')}}</h4>
                        
                        {!! Form::open(['method' => 'POST', 'action' => 'UserAccountController@update_otherprofilesetting']) !!}
                        <div class="form-group{{ $errors->has('facebook_url') ? ' has-error' : '' }}">
                          {!! Form::label('facebook_url',__('Facebook URL')) !!}
                          {!! Form::text('facebook_url', isset(auth()->user()->facebook_url) && auth()->user()->facebook_url != NULL ? auth()->user()->facebook_url : NULL, ['class' => 'form-control']) !!}
                          <small class="text-danger">{{ $errors->first('facebook_url') }}</small>
                        </div>
                        <div class="form-group{{ $errors->has('youtube_url') ? ' has-error' : '' }}">
                          {!! Form::label('youtube_url', __('Youtube URL')) !!}
                          {!! Form::text('youtube_url',isset(auth()->user()->youtube_url) && auth()->user()->youtube_url != NULL ? auth()->user()->youtube_url : NULL, ['class' => 'form-control']) !!}
                          <small class="text-danger">{{ $errors->first('youtube_url') }}</small>
                        </div>
                        <div class="form-group{{ $errors->has('twitter_url') ? ' has-error' : '' }}">
                          {!! Form::label('twitter_url', __('Youtube URL')) !!}
                          {!! Form::text('twitter_url',isset(auth()->user()->twitter_url) && auth()->user()->twitter_url != NULL ? auth()->user()->twitter_url : NULL, ['class' => 'form-control']) !!}
                          <small class="text-danger">{{ $errors->first('twitter_url') }}</small>
                        </div>
                        <div class="btn-group pull-right">
                          {!! Form::submit(__('update'), ['class' => 'btn btn-success']) !!}
                        </div>
                        {!! Form::close() !!}
                      </div>
                    </div>

                    <div class="col-lg-6 col-sm-6">
                      <div class="edit-profile-block">
                        <h4 class="panel-setting-heading">{{__('Update Address')}}</h4>
                        <div class="info">{{__('Want to change Address Country State and City')}}</div>
                        <form method="POST" action="{{route('user.address')}}" accept-charset="UTF-8">
                          @csrf
                          <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address">{{__('Address')}}</label>
                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Enter Address')}}"></i>
                            <textarea id="w3review" name="address" rows="4" cols="10">@if(isset(Auth::user()->address)) {{Auth::user()->address}} @endif</textarea>
                            <!-- <input type ="textarea"  class="form-control" name="address" @if(isset(Auth::user()->address)) value="{{Auth::user()->address}}" @endif >    -->
                            <small class="text-danger">{{ $errors->first('address') }}</small>
                          </div>
                          <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                            <label for="country">{{__('Country')}}</label>
                            {{-- <p class="inline info"> - Please enter your Country</p> --}} 
                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Your Country')}}"></i>
                            <select class="form-select"  name="country" id="country-dropdown" required>
                              <option value="">{{__('Select Your Country')}}</option>
                              @foreach ($country as $c) 
                              <option value="{{$c->id}}" {{auth()->user()->country == $c->id ? 'selected' : ''}}>
                              {{$c->name}}
                              </option>
                              @endforeach
                            </select>
                            <small class="text-danger">{{ $errors->first('country') }}</small>
                          </div>
                          <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                            <label for="state">{{__('State')}}</label>
                            {{-- <p class="inline info"> - Please enter your State</p> --}} 
                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Your state')}}"></i>
                            <select class="form-select"  name="state" id="state-dropdown">
                              <option value="">{{__('Select Your Country First')}}</option>
                              @foreach ($state as $s) 
                              <option value="{{$s->id}}" {{auth()->user()->state == $s->id ? 'selected' : ''}}>
                              {{$s->name}}
                              </option>
                              @endforeach
                            </select>
                            <small class="text-danger">{{ $errors->first('state') }}</small>
                          </div>                        
                          <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city">{{__('City')}}</label>
                            {{-- <p class="inline info"> - Please enter your City</p> --}} 
                            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Your City')}}"></i>
                            <select class="form-select"  name="city" id="city-dropdown" >
                              <option value="">{{__('Select Your State First')}}</option>
                              @foreach ($city as $ci) 
                              <option value="{{$ci->id}}" {{auth()->user()->city == $ci->id ? 'selected' : ''}}>
                              {{$ci->name}}
                              </option>
                              @endforeach
                            </select>
                            <small class="text-danger">{{ $errors->first('city') }}</small>
                          </div>
                          <div class="btn-group">
                            <input class="btn btn-success" type="submit" value="{{__('update')}}">
                          </div>
                        </form>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

             
              <div class="tab-pane fade" id="paymenthistory" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div class="panel-setting-main-block billing-history-main-block">
                  @if(isset($invoices) && $invoices != null)
                    <div class="container">
                      <h4 class="plan-dtl-heading">{{__('stripe billing history')}}</h4>
                      <div class="billing-history-block table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>{{__('date')}}</th>
                              <th>{{__('package')}}</th>
                              <th>{{__('service period')}}</th>
                              <th>{{__('payment method')}}</th>
                              <th>{{__('total')}}</th>
                              <th>{{__('Actions')}}</th>
                            </tr>
                          </thead>
                          <tbody>
                           {{-- @dd($invoices); --}}
                            @foreach($invoices as $invoice)
                        {{--     @dd($invoice->created); --}}
                              @php
                                $from = Carbon\Carbon::parse($invoice->subscription_from);
                                $from = $from->toDateString();
                                $to = Carbon\Carbon::parse($invoice->subscription_to);
                                $to = $to->toDateString();
                                 $created = Carbon\Carbon::parse($invoice->subscription_from);
                                $created = $created->toDateString();

                                $plan = App\Package::where('plan_id',$invoice->stripe_plan)->first();
                              @endphp
                              <tr>
                                <td>{{$created}}</td>
                                <td>{{$plan->name}}</td>
                                <td>{{$from}} to {{$to}}</td>
                                <td>Stripe</td>
                                <td><i class="{{$currency_symbol}}"></i> {{$invoice->amount}} ({{ currency($invoice->amount, $from = $plan->currency, $to = Session::has('current_currency') ? ucfirst(Session::get('current_currency')) : $plan->currency, $format = true) }} {{__('equivalent to your currency')}})

                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  @endif
                  @if (isset($paypal_subscriptions) && $paypal_subscriptions != null && count($paypal_subscriptions) > 0)
                    <div class="container">
                      <h4 class="plan-dtl-heading">{{__('billinghistory')}}</h4>
                      <div class="billing-history-block table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>{{__('date')}}</th>
                              <th>{{__('package')}}</th>
                              <th>{{__('service period')}}</th>
                              <th>{{__('payment method')}}</th>
                              <th>{{__('total')}}</th>
                              <th>{{__('Actions')}}</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($paypal_subscriptions as $item)
                              @php
                                $from = Carbon\Carbon::parse($item->subscription_from);
                                $from = $from->toDateString();
                                $to = Carbon\Carbon::parse($item->subscription_to);
                                $to = $to->toDateString();
                              @endphp
                              <tr>
                                <td>{{$item->created_at->toDateString()}}</td>
                                <td>{{$item->plan ? $item->plan->name : 'N/A'}}</td>
                                <td>{{$from}} to {{$to}}</td>
                                <td>{{ucfirst($item->method)}}</td>
                                <td><i class="{{$currency_symbol}}"></i> {{$item->price}} </td>
                                <td><a href="{{route('invoice.show',$item->id)}}" class="btn watch-trailer btn-default">{{__('Invoice')}}</a></td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  @endif
                </div>
              </div>


              <div class="tab-pane fade" id="affiliate" role="tabpanel" aria-labelledby="pills-affiliate-tab">
                <div class="bg-white2 " style="color:white">
                  <a href="#howitworks" data-toggle="modal" class="mt-2 h6 pull-right">
                      {{ __("How it works ?") }}
                  </a>
                  
                  <h4 class="user_m2">{{ __('Affiliate Dashboard') }}</h4>
                  
                  <hr>
                  <div class="container text-center">
                    <div class="card">
                      <div class="card-body">
                          <h3 class="card-title">
                              {{__("Start refering your friends and start earning !!")}}
                          </h3><br>
                          <p class="card-text">
                              {{__("This is your unique refer link share with your friends and family and start earning !")}}
                          </p>
                          <div class="form-group">
                              <input type="text" readonly id="{{ route('register',['refercode' => auth()->user()->refer_code ]) }}" class="text-dark text-center form-control cptext" value="{{ route('register',['refercode' => auth()->user()->refer_code ]) }}" >
                          </div>
                        <a href="#" class="copylink btn btn-default">
                            {{ __("Copy Link") }}
                        </a>
                      </div>
                    </div>
                  </div>
        
                  <div id="howitworks" class="comment-modal modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                        
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                              {!! $af_settings->about_system !!}
                            </div>
                          </div>
                      </div>
                  </div>
        
                  <div class="walletlogs">
                
                    @if($aff_history->count())
                  
                    <hr>
                    <h4 class="pull-right">{{ __('Total earning') }}  <i class="{{ $currency_symbol }}"></i> {{ $earning }}  
                     
                    </h4>
                    <h4>{{ __('Affiliate history') }}</h4>
                  
                    <hr>
        
                    @foreach($aff_history as $history)
                  
                    <h6>
                      <span
                        class="pull-right text-green""> {{ __('+') }}  <i class="{{ $currency_symbol }}"></i> {{ sprintf("%.2f",$history->amount,2) }}
                       
                      </span>
                      {{ $history->log }}
                      
                      <small class="text-muted font-size-12 wallet-log-history-block">
                        @if($history->procces == 0)
                        
                        <small class="text-white ">
                          ({{ __("Pending") }})
                        </small>
        
                        @else 
                          <small class="text-white">({{ __("Credited to wallet") }})</small>
                        @endif
                        
                      </small>
                    </h6>
                    <hr>
                    @endforeach
                    @endif
        
                    @if(isset($aff_history))
                    <div class="mx-auto width200px">
                      {!! $aff_history->links() !!}
                    </div>
                    @endif
                  </div>
        
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mobile-tabs" id="mobileTabs">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
          <li class="nav-item active">
            <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#details" role="tab" aria-controls="pills-home" aria-selected="true" title="Details"><i class="fa fa-user"></i></a>
          </li>
         
          <li class="nav-item">
            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#paymenthistory" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="fa fa-file-text"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-history-tab" href="{{route('watchhistory')}}" role="tab" aria-controls="pills-history" aria-selected="false"><i class="fa fa-history"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-hidden-tab" href="{{route('hidden.videos')}}" role="tab" aria-controls="pills-hidden" aria-selected="false"><i class="fa fa-ban"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-watchlist-tab" href="{{url('account/watchlist')}}" role="tab" aria-controls="pills-watchlist" aria-selected="false"><i class="fa fa-heart"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-wallet-tab"  href="{{route('user.wallet.show')}}" role="tab" aria-controls="pills-wallet" aria-selected="false"><i class="fa fa-credit-card"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-affiliate-tab" data-toggle="pill" href="#affiliate" role="tab" aria-controls="pills-affiliate" aria-selected="false"><i class="fa fa-gift"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </section>
  <!-- end main wrapper -->
@endsection
@section('custom-script')
<script>
  $(document).ready(function(){

  $('#upload_form').on('change', function(event){
    event.preventDefault();
    $.ajax({
      url:"{{ route('user.uploadImage') }}",
      method:"POST",
      data:new FormData(this),
      dataType:'JSON',
      contentType: false,
      cache: false,
      processData: false,
      success:function(data)
      {
        if(data.class_name == 'alert-success'){
          setTimeout(function(){// wait for 5 secs(2)
         
            $('#message').css('display', 'block');
            $('#message').html(data.message);
            $('#message').addClass(data.class_name);
              // then reload the page.(3)
            location.reload();
          }, 500); 
        }else{
          $('#message').css('display', 'block');
            $('#message').html(data.message);
            $('#message').addClass(data.class_name);
        }
       
      }
    })
  });

});
</script>
<script>
  $(window).scroll(function() {
      if ($(this).scrollTop() > 850) {

          $('#mobileTabs').addClass('d-none').removeClass('d-flex');
      } else {
          $('#mobileTabs').addClass('d-flex').removeClass('d-none');
      }
  });

  $(function(){
    $('a[data-toggle="pill"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('#user-tab a[href="' + activeTab + '"]').tab('show');
        $('#mobileTabs a[href="' + activeTab + '"]').tab('show');
    }
  });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
      $(document).ready(function() {
      $('#country-dropdown').on('change', function() {
      var country_id = this.value;
      $("#state-dropdown").html('');
      $.ajax({
      url:"{{url('get-states-by-country')}}",
      type: "POST",
      data: {
      country_id: country_id,
      _token: '{{csrf_token()}}' 
      },
      dataType : 'json',
      success: function(result){
      $('#state-dropdown').html('<option value="">Select State</option>'); 
      $.each(result.states,function(key,value){  
      $("#state-dropdown").append('<option value="'+value.id+'">'+value.name+'</option>');
      });
      $('#city-dropdown').html('<option value="">Select State First</option>'); 
      }
      });
      });    
      $('#state-dropdown').on('change', function() {
      var state_id = this.value;
      $("#city-dropdown").html('');
      $.ajax({
      url:"{{url('get-cities-by-state')}}",
      type: "POST",
      data: {
      state_id: state_id,
      _token: '{{csrf_token()}}' 
      },
      dataType : 'json',
      success: function(result){
      $('#city-dropdown').html('<option value="">Select City</option>'); 
      $.each(result.cities,function(key,value){
      $("#city-dropdown").append('<option value="'+value.id+'">'+value.name+'</option>');
      });
      }
      });
      });
      });
</script>
@endsection
