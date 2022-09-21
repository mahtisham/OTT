@extends('layouts.admin')
@section('title',__('Edit Custom Page'))
@section('content')
  <div class="admin-form-main-block mrg-t-40">
     <h4 class="admin-form-text">
      @can('pages.view')
      <a href="{{url('admin/custom_page')}}" data-toggle="tooltip" data-original-title="{{__('Go Back')}}" class="btn-floating"><i class="material-icons">reply</i></a> 
      @endcan
      {{__('EditCustomPage')}}</h4> 
    {!! Form::model($custom, ['method' => 'PATCH', 'action' => ['CustomPageController@update', $custom->id], 'files' => true]) !!}
    <div class="row">
      <div class="col-md-12">
          <div class="row admin-form-block z-depth-1">
        <div class="col-md-12">
          <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
              {!! Form::label('title', __('CustomPageTitle')) !!} - <p class="inline info">{{__('Enter Custom Page Title')}}</p>
              {!! Form::text('title', null, ['class' => 'form-control','autocomplete'=>'off','required']) !!}
              <small class="text-danger">{{ $errors->first('title') }}</small>
          </div> 
          
          
           <div class=" form-group{{ $errors->has('detail') ? ' has-error' : '' }}">
                {!! Form::label('detail', __('Description')) !!} - <p class="inline info">{{__('Please Enter Custom Page Description')}}</p>
                {!! Form::textarea('detail', null, ['id' => 'detail','autocomplete'=>'off', 'class' => 'form-control ckeditor', '']) !!}
                <small class="text-danger">{{ $errors->first('detail') }}</small>
            </div>

          <div class="form-group{{ $errors->has('in_show_menu') ? ' has-error' : '' }} switch-main-block">
              <div class="row">
                <div class="col-xs-4">
                  {!! Form::label('in_show_menu', __('Show In Menu')) !!}
                </div>
                <div class="col-xs-5 pad-0">
                  <label class="switch">                
                    {!! Form::checkbox('in_show_menu', null, null, ['class' => 'checkbox-switch']) !!}
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-xs-12">
                <small class="text-danger">{{ $errors->first('in_show_menu') }}</small>
              </div>
          </div>  

          <div class="form-group{{ $errors->has('is_active') ? ' has-error' : '' }} switch-main-block">
              <div class="row">
                <div class="col-xs-4">
                  {!! Form::label('is_active', __('Status')) !!}
                </div>
                <div class="col-xs-5 pad-0">
                  <label class="switch">                
                    {!! Form::checkbox('is_active', null, null, ['class' => 'checkbox-switch']) !!}
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-xs-12">
                <small class="text-danger">{{ $errors->first('is_active') }}</small>
              </div>
          </div>     
                   
          <div class="btn-group pull-right">
              <button type="submit" class="btn btn-success">{{__('Update')}}</button>
          </div>
          <div class="clear-both"></div>
        </div>  
    
    {!! Form::close() !!}
  </div>
        </div>
    </div>
  </div>
@endsection

@section('custom-script')
	<script>
		$(document).ready(function(){
      $('.upload-image-main-block').hide();
      $('.for-custom-image input').click(function(){
        if($(this).prop("checked") == true){
          $('.upload-image-main-block').fadeIn();
        }
        else if($(this).prop("checked") == false){
          $('.upload-image-main-block').fadeOut();
        }
      });
    });
	</script>
 
@endsection