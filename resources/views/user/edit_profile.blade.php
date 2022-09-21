@extends('layouts.theme')
@section('title', 'Account Setting')
@section('main-wrapper')
<!-- main wrapper -->
<section id="main-wrapper" class="main-wrapper home-page user-account-section">
  <div class="container-fluid">
    <h4 class="heading">{{__('account and settings')}}</h4>
    <ul class="bradcump">
      <li><a href="{{url('account')}}">{{__('dashboard')}}</a></li>
      <li>/</li>
      <li>{{__('account and settings')}}</li>
    </ul>
    <div class="panel-setting-main-block">
      <div class="edit-profile-main-block">
        <div class="row">
          <div class="col-md-6">
            <div class="edit-profile-block">
              <h4 class="panel-setting-heading">{{__('change mail')}}</h4>
              <div class="info">{{__('current email')}}: {{auth()->user()->email}}</div>
              {!! Form::open(['method' => 'POST', 'action' => 'UserAccountController@update_profile']) !!}
              <div class="form-group{{ $errors->has('new_email') ? ' has-error' : '' }}">
                {!! Form::label('new_email',__('new email')) !!}
                {!! Form::text('new_email', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('new_email') }}</small>
              </div>
              <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                {!! Form::label('current_password', __('current password')) !!}
                {!! Form::password('current_password', ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('current_password') }}</small>
              </div>
              <div class="btn-group pull-right">
                {!! Form::submit(__('update'), ['class' => 'btn btn-success']) !!}
              </div>
              {!! Form::close() !!}
            </div>
          </div>
          <div class="col-md-6">
            <div class="edit-profile-block">
              <h4 class="panel-setting-heading">{{__('change password')}}</h4>
              <div class="info">{{__('want to change your password')}}</div>
              {!! Form::open(['method' => 'POST', 'action' => 'UserAccountController@update_profile']) !!}
              <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                {!! Form::label('current_password', __('current password')) !!}
                {!! Form::password('current_password', ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('current_password') }}</small>
              </div>
              <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                {!! Form::label('new_password', __('new password')) !!}
                {!! Form::password('new_password', ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('new_password') }}</small>
              </div>
              <div class="btn-group pull-right">
                {!! Form::submit(__('update'), ['class' => 'btn btn-success']) !!}
              </div>
              {!! Form::close() !!}
            </div>
          </div>
          <div class="col-md-6">
            <div class="edit-profile-block">
              <h4 class="panel-setting-heading">{{__('update age and mobile')}}</h4>
              <div class="info">{{__('want to change age and mobile')}}</div>
              {!! Form::open(['method' => 'POST', 'action' => 'UsersController@update_age']) !!}
              
              <div class="search form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                {!! Form::label('dob',__('date of birth')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('enter date of birth user')}}"></i>

                <input type="date" class="form-control"  name="dob"  @if(isset(Auth::user()->dob)) value="{{Auth::user()->dob}}" @endif/>   
                <small class="text-danger">{{ $errors->first('dob') }}</small>
              </div>
              <div class="search form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                {!! Form::label('mobile', __('mobileno')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('enter your mobile no')}}"></i>
                <input type="number" class="form-control"  name="mobile" @if(isset(Auth::user()->mobile)) value="{{Auth::user()->mobile}}"@endif/>   
                <small class="text-danger">{{ $errors->first('mobile') }}</small>
              </div>

              <div class="btn-group pull-right">
                {!! Form::submit(__('update'), ['class' => 'btn btn-success']) !!}
              </div>

              {!! Form::close() !!}
            </div>
          </div>
         
        </div>
      </div>
    </div>
  </div>
</section>
<!-- end main wrapper -->
@endsection