@extends('layouts.admin')
@section('title', __('Mail Settings'))

@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <div class="tabsetting">
      <a href="{{url('admin/settings')}}" style="color: #7f8c8d;" ><button class="tablinks ">{{__('Genral Setting')}}</button></a>
      <a href="{{url('admin/seo')}}" style="color: #7f8c8d;" ><button class="tablinks">{{__('SEO Setting')}}</button></a>
      <a href="{{url('admin/api-settings')}}" style="color: #7f8c8d;"><button class="tablinks">{{__('API Setting')}}</button></a>
      <a href="#" style="color: #7f8c8d;"><button class="tablinks active">{{__('Mail Settings')}}</button></a>
   
    </div>
  
    {!! Form::model($env_files, ['method' => 'POST', 'action' => 'ConfigController@changeMailEnvKeys']) !!}
      <div class="row admin-form-block z-depth-1">
        <div class="api-main-block">
          <h5 class="form-block-heading apipadding">{{__('Mail Settings')}}</h5><br/>

          <div class="">
            <div class="col-md-6 form-group{{ $errors->has('MAIL FROM NAME') ? ' has-error' : '' }}">
              {!! Form::label('MAIL_FROM_NAME',__('Sender Name')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Sender Name')}}"></i>
                <input class="form-control" type="text" name="MAIL_FROM_NAME" value="{{ $env_files['MAIL_FROM_NAME'] }}">
                <small class="text-danger">{{ $errors->first('MAIL_FROM_NAME') }}</small>
            </div>

            <div class="col-md-6 form-group{{ $errors->has('MAIL HOST') ? ' has-error' : '' }}">
              {!! Form::label('MAIL_DRIVER', __('MAIL DRIVER')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Mail Driver')}} (ex. : sendmail, smtp, mail)"></i>
                {!! Form::text('MAIL_DRIVER', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('MAIL_DRIVER') }}</small>
            </div>
            <div class="col-md-6 form-group{{ $errors->has('MAIL_FROM_ADDRESS') ? ' has-error' : '' }}">
              {!! Form::label('MAIL_DRIVER', __('MAIL FROM ADDRESS')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Mail From Address')}} (ex. : yourmail@gmail.com)"></i>
              {!! Form::email('MAIL_FROM_ADDRESS', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('MAIL_FROM_ADDRESS') }}</small>
            </div>
            <div class="col-md-6 form-group{{ $errors->has('MAIL HOST') ? ' has-error' : '' }}">
              {!! Form::label('MAIL_HOST', __('MAIL HOST')) !!}
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Mail Host')}} (ex. : smtp.gmail.com)"></i>
              {!! Form::text('MAIL_HOST', null, ['class' => 'form-control']) !!}
              <small class="text-danger">{{ $errors->first('MAIL_HOST') }}</small>
            </div>

            <div class="col-md-6 form-group{{ $errors->has('MAIL_PORT') ? ' has-error' : '' }}">
              {!! Form::label('MAIL_PORT', __('MAIL PORT')) !!}
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Mail Port')}} (ex. : 587, 487)"></i>
              {!! Form::text('MAIL_PORT', null, ['class' => 'form-control']) !!}
              <small class="text-danger">{{ $errors->first('MAIL_PORT') }}</small>
            </div>

            <div class="col-md-6 form-group{{ $errors->has('MAIL_USERNAME') ? ' has-error' : '' }}">
              {!! Form::label('MAIL_USERNAME', __('MAIL USERNAME')) !!}
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Mail Username')}} (ex. : yourmail@gmail.com)"></i>
              {!! Form::text('MAIL_USERNAME', null, ['class' => 'form-control']) !!}
              <small class="text-danger">{{ $errors->first('MAIL_USERNAME') }}</small>
            </div>

            <div class="col-md-6 search form-group{{ $errors->has('MAIL_PASSWORD') ? ' has-error' : '' }}">
              {!! Form::label('MAIL_PASSWORD', __('MAIL PASSWORD')) !!}
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Mail Password')}}"></i>
              <input type="password" name="MAIL_PASSWORD" id="mailpass" value="{{$env_files['MAIL_PASSWORD']}}" class="form-control">
              <span toggle="#mailpass" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
              <small class="text-danger">{{ $errors->first('MAIL_PASSWORD') }}</small>
            </div>

            <div class="col-md-6 form-group{{ $errors->has('MAIL_ENCRYPTION') ? ' has-error' : '' }}">
              {!! Form::label('MAIL_ENCRYPTION', __('MAIL ENCRYPTION')) !!}
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Mail Encryption')}} (ex. : SSL, TLS)"></i>
              {!! Form::text('MAIL_ENCRYPTION', null, ['class' => 'form-control']) !!}
              <small class="text-danger">{{ $errors->first('MAIL_ENCRYPTION') }}</small>
            </div>

          </div>

        </div>

        <div class="btn-group col-xs-12">
          <button type="submit" class="btn btn-block btn-success">{{__('Save Settings')}}</button>
        </div>
        <div class="clear-both"></div>
      </div>
    {!! Form::close() !!}
  </div>
@endsection
@section('custom-script')
  <script>

  $(".toggle-password2").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
  });
  </script>
@endsection
