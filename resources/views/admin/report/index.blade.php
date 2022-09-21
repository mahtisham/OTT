@extends('layouts.admin')
@section('title',__('Reports'))
@section('content')
  <div class="content-main-block mrg-t-40">
    <h4 class="admin-form-text">{{__('All Reports')}}</h4>
    
          @if (isset($all_reports) && count($all_reports->data) > 0)
          <div class="content-block box-body content-block-two">
              <h5>{{__('Stripe Report')}}</h5><br/>
          <table id="full_detail_table" class="table table-hover">
            <thead>
            <tr class="table-heading-row">
              <th>#</th>
              <th>{{__('Date')}}</th>
              <th>{{__('Subscribed Package')}}</th>
              <th>{{__('Paid Amount')}}</th>
              <th>{{__('Method')}}</th>
              <th>{{__('User')}}</th>
            </tr>
            </thead>
            <tbody>
            @php
              $sell = null;
            @endphp
            @foreach ($all_reports->data as $key => $report)
              @php
                \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
               
                $customer_id = \Stripe\Customer::retrieve($report->customer);
                $user = Illuminate\Support\Facades\DB::table('users')->where('email', '=', $customer_id->email)->first();
                $sell = $sell + (($report->plan->amount/100));
              @endphp
              <tr>
                <td>
                  {{$key+1}}
                </td>
                <td>
                  {{date('d/m/Y',$report->items->data[0]->created)}}
                </td>
                <td>
                  {{$report->items->data[0]->plan->id}}
                </td>
                <td>
                  <i class="{{$currency_symbol}}"></i> {{$report->plan->amount/100}}
                </td>
                <td>
                  Stripe
                </td>
                <td>
                  @if (isset($user))
                    {{$user->name ? $user->name : ''}}
                  @else
                   {{__('User Removed')}}
                  @endif
                </td>
              </tr>
            @endforeach
            </tbody>
      </table>
      <br/>
      <br/>
      <div class="total-sell" style="margin-top: 20px">
        <h5>{{__('Total Sells')}} <i class="{{$currency_symbol}}"></i>{{isset($sell) ? $sell : ''}}</h5>
      </div>
       </div>
          @endif
          <br/>
          @if (isset($paypal_subscriptions) && count($paypal_subscriptions) > 0)
          <div class="content-block box-body content-block-two">
              <h5>{{__('Paypal Report')}}</h5><br/>
          <table id="full_detail_table" class="table table-hover">
            <thead>
            <tr class="table-heading-row">
              <th>#</th>
              <th>{{__('Date')}}</th>
              <th>{{__('Subscribed Package')}}</th>
              <th>{{__('Paid Amount')}}</th>
              <th>{{__('Method')}}</th>
              <th>{{__('User')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($paypal_subscriptions as $key => $item)
              @php
                $sell = 0;
                $date = $item->created_at->toDateString();
                $sell = $sell + $item->price; 

              @endphp
              <tr>
                <td>
                  {{$key+1}}
                </td>
                <td>
                  {{$date}}
                </td>
                <td>
                  {{$item->plan ? $item->plan->name : 'N/A'}}
                </td>
                <td>
                  <i class="{{$currency_symbol}}"></i> {{$item->price}}
                </td>
                <td>
                  Paypal
                </td>
                <td>
                  {{$item->user ? $item->user->name : 'N/A'}}
                </td>
              </tr>
            @endforeach
            </tbody>
      </table>
      <br/>
      <br/>
      <div class="total-sell" style="margin-top: 20px">
        <h5>{{__('TotalSells')}} <i class="{{$currency_symbol}}"></i>{{isset($sell) ? $sell : ''}}</h5>
      </div>
       </div>
          @endif
        
   
  </div>
@endsection
