@extends('layouts.admin')
@section('title',__('Edit Slider'))
@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><a href="{{url('admin/home_slider')}}" data-toggle="tooltip" data-original-title="{{__('Go Back')}}" class="btn-floating"><i class="material-icons">reply</i></a> {{__('Edit Slider')}}</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          {!! Form::model($home_slide, ['method' => 'PATCH', 'action' => ['HomeSliderController@update', $home_slide->id], 'files' => true]) !!}
            <div class="bootstrap-checkbox slide-option-switch form-group{{ $errors->has('prime_main_slider') ? ' has-error' : '' }}">
              <div class="row">
                <div class="col-md-7">
                  <h5 class="bootstrap-switch-label">{{__('Prime Main Slider Type')}}</h5>
                </div>
                <div class="col-md-5 pad-0">
                  <div class="make-switch">
                    {!! Form::checkbox('', 1, (isset($movie_dtl) ? 1 : 0), ['class' => 'bootswitch', 'id' => 'TheCheckBox', "data-on-text"=>"Movies", "data-off-text"=>"Tv Series", "data-size"=>"small",]) !!}
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <small class="text-danger">{{ $errors->first('prime_main_slider') }}</small>
              </div>
            </div>
            <div id="movie_id_block" class="form-group{{ $errors->has('movie_id') ? ' has-error' : '' }}">
              {!! Form::label('movie_id', __('Select Slide For Movie')) !!}
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Select Slide For Movie')}}"></i>
              @if(isset($movie_dtl))
                {!! Form::select('movie_id', [$movie_dtl->id => $movie_dtl->title] + $movie_list, null, ['class' => 'form-control select2', 'placeholder' => '']) !!}
              @else
                {!! Form::select('movie_id', $movie_list, null, ['class' => 'form-control select2', 'placeholder' => '']) !!}
              @endif
              <small class="text-danger">{{ $errors->first('movie_id') }}</small>
            </div>
            <div id="tv_series_id_block" class="form-group{{ $errors->has('tv_series_id') ? ' has-error' : '' }}">
              {!! Form::label('tv_series_id', __('Select Slide For TvShow')) !!}
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Select Slide For Tv Show')}}"></i>
              @if(isset($tv_series_dtl))
                {!! Form::select('tv_series_id', [$tv_series_dtl->id => $tv_series_dtl->title] + $tv_series_list, null, ['class' => 'form-control select2', 'placeholder' => '']) !!}
              @else
                {!! Form::select('tv_series_id', $tv_series_list, null, ['class' => 'form-control select2', 'placeholder' => '']) !!}
              @endif
              <small class="text-danger">{{ $errors->first('tv_series_id') }}</small>
            </div>

             

            <div style="{{ $home_slide->type == 'v' ? "display: none" : "" }}" id="slider_image" class="form-group{{ $errors->has('slide_image') ? ' has-error' : '' }} input-file-block">
              {!! Form::label('slide_image', __('SlideImage')) !!}
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Upload Slide Image')}}"></i>
              {!! Form::file('slide_image', ['class' => 'input-file', 'id'=>'slide_image']) !!}
              <label for="slide_image" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('Slide Image')}}">
                <i class="icon fa fa-check"></i>
                <span class="js-fileName">{{__('Choose A File')}}</span>
              </label>
              <p class="info">{{__('Choose Slide Image')}}</p>
              <small class="text-danger">{{ $errors->first('slide_image') }}</small>
            </div>
           
            @if($button->kids_mode==1)
              <div class="form-group{{ $errors->has('is_kids') ? ' has-error' : '' }}">
                <div class="row">
                  <div class="col-xs-6">
                    {!! Form::label('is_kids', __('Only for kids ?')) !!}
                  </div>
                  <div class="col-xs-5 pad-0">
                    <label class="switch">
                      {!! Form::checkbox('is_kids', 1, $home_slide->is_kids, ['class' => 'checkbox-switch','id'=>'kids_mode']) !!}
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
                <div class="col-xs-12">
                  <small class="text-danger">{{ $errors->first('is_kids') }}</small>
                </div>
              </div>
            @endif
           
            <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
              <div class="row">
                <div class="col-xs-3">
                  {!! Form::label('active', __('Active')) !!}
                </div>
                <div class="col-xs-5 pad-0">
                  <label class="switch">
                    {!! Form::checkbox('active', 1, $home_slide->active, ['class' => 'checkbox-switch']) !!}
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-xs-12">
                <small class="text-danger">{{ $errors->first('series') }}</small>
              </div>
            </div>
            <div class="btn-group pull-right">
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> {{__('Update')}}</button>
            </div>
            <div class="clear-both"></div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('custom-script')
  <script>
    $(document).ready(function(){
      @if(isset($movie_dtl))
        $('#tv_series_id_block').hide();
      @elseif(isset($tv_series_dtl))
        $('#movie_id_block').hide();  
      @endif

      $('#TheCheckBox').on('switchChange.bootstrapSwitch', function (event, state) {

          if (state == true) {

            $('#tv_series_id').val("");
            $('#tv_series_id_block').hide();
            $('#movie_id_block').show();

          } else if (state == false) {

            $('#tv_series_id_block').show();
            $('#movie_id').val("");
            $('#movie_id_block').hide(); 

          };

      });
      
    });
  </script>
@endsection