@extends('layouts.theme')
@section('title',__('Contact Us'))
@section('main-wrapper')

<div class="contact-main-block container" style="background-color: #111;">
  <br>
  @if(Session::has('success'))
  <div class="alert alert-success">
    {{__('Success')}} : {{ Session::get('success') }}
  </div>
  @endif
  <h3 class="contact-us-heading text-center">{{__('Contact')}} <span
      class="us_text">{{__('Us')}}</span></h3>
  <br>
  <h5 class="contact-us-heading text-center">{{__('Contact Detail')}}</h5>
  <form class="contact-block" action="{{ route('send.contactus') }}" method="post">
    {{ csrf_field() }}
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          <label style="color: #fff;" for="">{{__('Name')}}:</label>
          <input type="text" class="form-control custom-field-contact" name="name">
          @if ($errors->has('name'))
          <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
          </span>
          @endif
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label style="color: #fff;" for="">{{__('Email')}}:</label>
          <input type="email" class="search-input form-control custom-field-contact" name="email">
          @if ($errors->has('email'))
          <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
          </span>
          @endif
        </div>

        <div class="form-group{{ $errors->has('subj') ? ' has-error' : '' }}">
          <label style="color: #fff;" for="">{{__('subject')}}:</label>
          <select name="subj" id="" class="form-control custom-field-contact">
            <option value="Billing Issue">{{__('Billing Issue')}}</option>
            <option value="Streaming Issue">{{__('Streaming Issue')}}</option>
            <option value="Application Issue">{{__('Application Issue')}}</option>
            <option value="Advertising">{{__('Advertising')}}</option>
            <option value="Partnership">{{__('Partnership')}}</option>
            <option value="Other">{{__('Other')}}</option>
          </select>
          @if ($errors->has('subj'))
          <span class="help-block">
            <strong>{{ $errors->first('subj') }}</strong>
          </span>
          @endif
        </div>

        <div class="form-group{{ $errors->has('msg') ? ' has-error' : '' }}">
          <label style="color: #fff;" for="">{{__('message')}}:</label>
          <textarea name="msg" class="form-control custom-field-contact" rows="5" cols="50"></textarea>
          @if ($errors->has('msg'))
          <span class="help-block">
            <strong>{{ $errors->first('msg') }}</strong>
          </span>
          @endif
        </div>

        <input type="submit" class="btn btn-subscribe" value="{{__('Send')}}">
      </div>
    </div>
  </form>

  <br>
</div>
@endsection