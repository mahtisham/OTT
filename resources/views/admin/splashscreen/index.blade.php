@extends('layouts.admin')
@section('title',__('Splash Screen'))
@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text">{{__('Splash Screen')}}</h4>
    <div class="row">
      <div class="col-md-12">
        <div class="admin-form-block z-depth-1">
          {!! Form::model($splashscreen, ['method' => 'POST', 'action' => 'SplashScreenController@store', 'files' => true]) !!}
            <div class="row">
              <div class="col-md-6">
                 <div class="col-xs-4">
                  {!! Form::label('logo_enable', __('Logo Enable:')) !!}
                </div>
                <div class="col-xs-5 pad-0">
                  <label class="switch">                
                    {!! Form::checkbox('logo_enable', 1, $splashscreen->logo_enable, ['class' => 'checkbox-switch', 'id'=>'logo_enable']) !!}
                    <span class="slider round"></span>
                  </label>
                </div>
                <div class="col-xs-12">
                  <small class="text-danger">{{ $errors->first('logo_enable') }}</small>
                </div>
              </div>
              
               
               <div class="col-md-6 " id="logobox" style="{{ $splashscreen->logo != '' ? ""  : "display:none" }}">
                  <div class="logobox form-group{{ $errors->has('logo') ? ' has-error' : '' }} input-file-block">
                   {!! Form::label('logo',__('Logo'),['class'=>"col-xs-3"]) !!}
                    {!! Form::file('logo', ['class' => 'input-file col-xs-9', 'id'=>'logo']) !!}
                    <label for="logo" class="btn btn-danger  col-xs-9 js-labelFile" data-toggle="tooltip" data-original-title="logo">
                      <i class="icon fa fa-check"></i>
                      <span class="js-fileName">{{__('Choose A Logo')}}</span>
                    </label>{{-- 
                    <p class="info">Choose custom logo</p> --}}
                    <small class="text-danger">{{ $errors->first('logo') }}</small>
                  </div>
                </div>
           
            </div>
            <div class="row">
              <div class="col-md-6 form-group">
                    @if ($auth_customize->image != null)
                      <img src="{{ asset('images/splashscreen/'.$splashscreen->image) }}" class="img-responsive">
                    @else
                      <div class="image-block"></div>                    
                    @endif
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }} input-file-block">
                    {!! Form::label('image', __('SelectAImage')) !!}  <p class="inline info"></p>
                    {!! Form::file('image', ['class' => 'input-file', 'id'=>'image']) !!}
                    <label for="image" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('Project Image')}}">
                      <i class="icon fa fa-check"></i>
                      <span class="js-fileName">{{__('Choose A File')}}</span>
                    </label>
                    <p class="info">{{__('Choose A Image')}}</p>
                    <small class="text-danger">{{ $errors->first('image') }}</small>
                </div>
              </div>
               
            </div>
            <div class="">
                <button type="submit" class="btn btn-success btn-block">{{__('Save')}}</button>
            </div>
            <div class="clear-both"></div>
            {!! Form::close() !!}
          </div>
        </div>
        
      </div>
    </div>
  </div>
@endsection
@section('custom-script')
<script>
$('#logo_enable').on('change',function(){
  if($('#logo_enable').is(':checked')){
    //show
    $('#logobox').show();
  }else{
    //hide
     $('#logobox').hide();
  }
});
</script>
@endsection