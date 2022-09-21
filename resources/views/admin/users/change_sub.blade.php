@extends('layouts.admin')
@section('title',__('Change Subscription'))
@section('content')
  <div class="admin-form-main-block mrgn-t-40">
    <h4 class="admin-form-text"><a href="{{url('admin/users')}}" data-toggle="tooltip" data-original-title="{{__('Go Back')}}" class="btn-floating"><i class="material-icons">reply</i></a> {{__('Change Or Add Subscription')}}</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          {!! Form::open(['method' => 'POST', 'action' => 'UsersController@change_subscription', 'files' => true]) !!}
            <div class="info form-group">
              <h5>{{__('UserName')}}: {{$user->name}}</h5>
               @php
               $planname='not exist';
              if (isset($plans)) {
                  if (isset($last_payment->plan->name) && !is_null($last_payment)){
                     $planname=$last_payment->plan->name;
                     $planid = $last_payment->plan->id;
                   }else{
                    if (isset($user_stripe_plan) && !is_null($user_stripe_plan)) {
                     $planname=$user_stripe_plan->name;
                     $planid = $user_stripe_plan->id;
                    }
                   }
               
              }else{
                  $planname='not exist';
              }

              @endphp
             
                <h5>{{__('Last Subscription Plan')}}: {{$planname}}</h5>
            </div>
            <input type="hidden" name="user_stripe_plan_id" value="{{$user_stripe_plan != null ? $user_stripe_plan->id : null}}">
            <input type="hidden" name="last_payment_id" value="{{$last_payment != null ? $last_payment->id : null}}">
            <input type="hidden" name="user_id" value="{{$user->id}}">


            @foreach ($user->paypal_subscriptions as $pu)
              @php
               $test=0;
               $status =App\Package::select('status')->where('id',$pu->package_id)->get();
                     foreach ($status as $key => $value) {
                      $test=$value->status;
                     }
              @endphp

              @if($test == 0)
                <div class="alert alert-danger">
                  {{__('User Plan Not Exist')}}
                </div>
              @endif
            @endforeach 
                <div>
                  <select name="plan_id" class="select2 form-control">
                    @foreach ($plans as $plan)
                      @if($plan->delete_status == 1)
                      <option value="{{ $plan->id }}" {{isset($planid) && $planid == $plan->id ? 'Selected' : ''}}>{{ $plan->name }}</option>
                      @endif
                    @endforeach

                  </select>
                </div>

             
                <div class="btn-group pull-right">
                  <button type="submit" class="btn btn-success">{{__('Change Subscription')}}</button>
                </div>
                <div class="clear-both"></div>
              {!! Form::close() !!}


        </div>
      </div>
    </div>
  </div>
@endsection
