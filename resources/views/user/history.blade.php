@extends('layouts.theme')

@section('main-wrapper')
  <!-- main wrapper -->
  <section id="main-wrapper" class="main-wrapper home-page user-account-section">
    <div class="container-fluid">
      <h4 class="heading">{{__('invoice details')}}</h4>
      <ul class="bradcump">
        <li><a href="{{url('account')}}">{{__('dashboard')}}</a></li>
        <li>/</li>
        <li>{{__('invoice details')}}</li>
      </ul>
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
                       $created = Carbon\Carbon::parse($invoice->created);
                      $created = $created->toDateString();

                      $plan = App\Package::where('plan_id',$invoice->lines->data[0]->plan->id)->first();
                    @endphp
                    <tr>
                      <td>{{$created}}</td>
                      <td>{{$plan->name}}</td>
                      <td>{{$from}} to {{$to}}</td>
                      <td>Stripe</td>
                      <td><i class="{{$currency_symbol}}"></i> {{$invoice->lines->data[0]->plan->amount/100}}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        @endif
        @if (isset($paypal_subscriptions) && $paypal_subscriptions != null && count($paypal_subscriptions) > 0)
          <div class="container">
            <h4 class="plan-dtl-heading">{{__('billing history')}}</h4>
            <div class="billing-history-block table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>{{__('date')}}</th>
                    <th>{{__('package')}}</th>
                    <th>{{__('service period')}}</th>
                    <th>{{__('payment method')}}</th>
                    <th>{{__('total')}}</th>
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
                      <td><i class="{{$currency_symbol}}"></i> {{$item->price}}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        @endif
      </div>
    </div>
  </section>
  <!-- end main wrapper -->
@endsection