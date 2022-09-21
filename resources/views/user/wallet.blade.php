@extends('layouts.theme')
@php
  $user = Auth::user();
  
@endphp
@section('title',__('Wallet'))
@section('main-wrapper')
<section id="main-wrapper" class="main-wrapper user-account-section wallet-block">
  <div class="container-fluid">
    <div class="row">

      <div class="col-xl-9 col-lg-12 col-sm-12">

        <div class="bg-white2 " style="color:white">
         
          <div class="container">
            <h5 class="user_m2">{{ __('My Wallet') }}</h5>
          
          
            <div class="card">
              <div class="card-header brd-btm">
                <div class="wallet-img">
                  <img src="{{url('/images/wallet.png')}}" class="img-fluid" alt="">
                </div>
                <div class="paytm-block">
                 {{env('APP_NAME')}} {{__('Wallet')}}
                  <span>
                    <i class="{{$currency_symbol}}"></i>  
                    @if(isset($user->wallet))
                      {{ $user->wallet->balance }} 
                    @else 
                      0 
                    @endif 
                  </span>
                </div>
              </div>
              <div class="card-body">
                <form id="mainform" action="{{ route('wallet.choose.paymethod') }}" method="POST">
                  @csrf
                  <div class="add-money-block">
                    <h6 class="add-money-heading">{{__('Add Money To Wallet')}}</h6>
                    <div class="input-group">
                      <i class="{{$currency_symbol}}"></i>
                      <input type="number" class="form-control" placeholder="Enter Amount" name="amount" value="1.00"
                      placeholder="0.00" min="1" step="0.01" aria-describedby="basic-addon1">
                      <div class="add-money-btn">
                        <button type="submit" class="btn btn-default">{{__('Add Money to wallet')}}</button>  
                      </div>
                    </div>
                    <p class="text-muted">
                      <i class="fa fa-lock"></i> {{ __('Once the money is added in wallet its non refundable.') }}
                    </p>
                    <p class="text-muted">
                      <i class="fa fa-star"></i> {{ __('You can use this money to purchase product on this portal.') }}
                    </p>
                    <p class="text-muted">
                      <i class="fa fa-info-circle"></i> {{ __('Money will expire after 1 year from credited date.') }}
                    </p>
                    <p class="text-muted">
                      <i class="fa fa-info-circle"></i> {{ __(' Wallet amount will always added in default currency which is: ') }}  <b>{{ $currency_code }}</b>
                    </p>
                  </div>
                </form>
                @if(isset($wallethistory) && count($wallethistory) > 0)
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">{{__('Transactions')}}</th>
                          <th scope="col">{{__('Amount')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($wallethistory as $wallet)
                        <tr>
                          <td>
                            <div class="trasaction-img">
                              <img src="{{url('/images/wallet.png')}}" class="img-fluid" alt="">
                            </div>
                            <div class="trasaction-dtl">
                              <h6>{{$wallet->log}}</h6>
                              <div class="date-time">
                                {{date('d M Y, h:i A', strtotime($wallet->created_at))}}
                              
                              </div>
                              <ul>
                                
                                <li><span>{{__('Transaction ID')}} : </span>{{$wallet->txn_id}}</li>
                                @if($wallet->type == 'Credit' || $wallet->type == 'credit')
                                  <li class="date-time"><span>{{__('Expire ON')}} : </span>{{date('d M Y, h:i A', strtotime($wallet->expire_at))}}</li>
                                @endif
                              </ul>
                            </div>
                          </td>
                          <td>
                            @if($wallet->type == 'Credit' || $wallet->type == 'credit')
                              <span class='text-green'><b> + <i class="{{$currency_symbol}}"></i> {{$wallet->amount}} </b>
                            @else
                              <span class='text-red'><b> - <i class="{{$currency_symbol}}"></i> {{$wallet->amount}} </b>
                            @endif
                          </td>
                          
                        </tr>
                        @endforeach
                    
                      </tbody>
                    </table>
                  </div>
                @endif
              </div>
            </div>
          </div>

        </div>
      </div>


    </div>

  </div>
</section>


@endsection