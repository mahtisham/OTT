@extends('layouts.admin')
@section('title',__('Create Live Event'))

@section('content')
<div class="admin-form-main-block">
  <h4 class="admin-form-text">
    @can('liveevent.view')
      <a href="{{url('admin/liveevent')}}" data-toggle="tooltip" data-original-title="{{__('Go Back')}}" class="btn-floating"><i class="material-icons">reply</i></a> {{__('Create Live Event')}}</h4>
    @endcan
  <div class="row">
    <div class="col-md-6">
      <div class="admin-form-block z-depth-1">
        {!! Form::open(['method' => 'POST', 'action' => 'LiveEventController@store', 'files' => true]) !!}
        <div id="movie_title" class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
          {!! Form::label('title',__('Event Title')) !!}
          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Enter Live Event Title')}} Eg:Avatar"></i>
          {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => __('Enter Live Event Title')]) !!}
          <small class="text-danger">{{ $errors->first('title') }}</small>
        </div>
       
        {{-- select to upload code start from here --}}
        <div class="form-group{{ $errors->has('selecturl') ? ' has-error' : '' }}">
          {!! Form::label('selecturls', __('Add Video')) !!}
          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Select One Of The Options To Add Video')}}"></i>
          {!! Form::select('selecturl', array('iframeurl' =>__('IFrameURL'), 'customurl' => __('CustomURLAndM3u8URL')), null, ['class' => 'form-control select2','id'=>'selecturl']) !!}
           <small class="text-danger">{{ $errors->first('selecturl') }}</small>
         </div>


         <div id="ifbox" style="display: none;" class="form-group">
          <label for="iframeurl">{{__('IFRAMEURL')}}: </label> <a data-toggle="modal" data-target="#embdedexamp"><i class="fa fa-question-circle-o"> </i></a>
          <input  type="text" class="form-control" name="iframeurl" placeholder="">
        </div>


        
        {{-- custom /m3u8 --}}
        <div id="ready_url" style="display: none;" class="form-group{{ $errors->has('ready_url') ? ' has-error' : '' }}">
         <label id="customurl"></label>
         <p class="inline info"> - {{__('Please Enter Your VideoUrl')}}</p>
         {!! Form::text('ready_url', null, ['class' => 'form-control','id'=>'apiUrl']) !!}
         <small class="text-danger">{{ $errors->first('ready_url') }}</small>
       </div>
    
      <div class="form-group" style="display: none">
        <div class="row">
          <div class="col-xs-6">
            {!! Form::label('',__('Choose Custom Thumbnail And Poster')) !!}
          </div>
          <div class="col-xs-5 pad-0">
            <label class="switch for-custom-image">
              {!! Form::checkbox('', 1, 1, ['class' => 'checkbox-switch']) !!}
              <span class="slider round"></span>
            </label>
          </div>
        </div>
      </div>
      <div class="upload-image-main-block">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group{{ $errors->has('thumbnail') ? ' has-error' : '' }} input-file-block">
              {!! Form::label('thumbnail',__('Thumbnail')) !!} - <p class="info">{{__('Help Block Text')}}</p>
              {!! Form::file('thumbnail', ['class' => 'input-file', 'id'=>'thumbnail']) !!}
              <label for="thumbnail" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('Thumbnail')}}">
                <i class="icon fa fa-check"></i>
                <span class="js-fileName">{{__('ChooseAFile')}}</span>
              </label>
              <p class="info">{{__('Choose Custom Thumbnail')}}</p>
              <small class="text-danger">{{ $errors->first('thumbnail') }}</small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group{{ $errors->has('poster') ? ' has-error' : '' }} input-file-block">
              {!! Form::label('poster', __('Poster')) !!} - <p class="info">{{__('HelpBlockText')}}</p>
              {!! Form::file('poster', ['class' => 'input-file', 'id'=>'poster']) !!}
              <label for="poster" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('Poster')}}">
                <i class="icon fa fa-check"></i>
                <span class="js-fileName">{{__('Choose A File')}}</span>
              </label>
              <p class="info">{{__('Choose Custom Poster')}}</p>
              <small class="text-danger">{{ $errors->first('poster') }}</small>
            </div>
          </div>
        </div>
      </div>

      <div class="menu-block">
        <h6 class="menu-block-heading">{{__('Please Select Menu')}}</h6>
        @if (isset($menus) && count($menus) > 0)
        <ul>
          @foreach ($menus as $menu)
          <li>
            <div class="inline">
              <input type="checkbox" class="filled-in material-checkbox-input" name="menu[]" value="{{$menu->id}}" id="checkbox{{$menu->id}}">
              <label for="checkbox{{$menu->id}}" class="material-checkbox"></label>
            </div>
            {{$menu->name}}
          </li>
          @endforeach
        </ul>
        @endif
      </div>

      <div class="form-group{{ $errors->has('start_time') ? ' has-error' : '' }}">
        {!! Form::label('start_time', __('Event Start Time')) !!}
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Start Time')}} eg:"></i>
       <input type="datetime-local" name="start_time" class="form-contrrol" >
        <small class="text-danger">{{ $errors->first('start_time') }}</small>
      </div>

       <div class="form-group{{ $errors->has('end_time') ? ' has-error' : '' }}">
        {!! Form::label('end_time', __('EventEndTime')) !!}
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter End Time')}} eg:"></i>
       {{--  {!! Form::datetime('end_time',  null, ['class' => 'form-control', ]) !!} --}}
        <input type="datetime-local" name="end_time" class="form-contrrol" >
        <small class="text-danger">{{ $errors->first('end_time') }}</small>
      </div>

       <div class="form-group{{ $errors->has('organized_by') ? ' has-error' : '' }}">
        {!! Form::label('organized_by', __('Event Organized By')) !!}
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Organized By')}} "></i>
        {!! Form::text('organized_by',  null, ['class' => 'form-control', ]) !!}
        <small class="text-danger">{{ $errors->first('organized_by') }}</small>
      </div>
  

      <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        {!! Form::label('description',__('Description')) !!}
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Live Event Description')}}"></i>
        {!! Form::textarea('description', null, ['class' => 'form-control materialize-textarea', 'rows' => '5']) !!}
        <small class="text-danger">{{ $errors->first('description') }}</small>
      </div>

      <div class="form-group{{ $errors->has('Status') ? ' has-error' : '' }}">
        <div class="row">
          <div class="col-xs-6">
            {!! Form::label('status', __('Status')) !!}
          </div>
          <div class="col-xs-5 pad-0">
            <label class="switch">
              {!! Form::checkbox('status', 1, 0, ['class' => 'checkbox-switch']) !!}
              <span class="slider round"></span>
            </label>
          </div>
        </div>
        <div class="col-xs-12">
          <small class="text-danger">{{ $errors->first('status') }}</small>
        </div>
      </div>

      <div class="btn-group pull-right">
        <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> {{__('Reset')}}</button>
        <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> {{__('Create')}}</button>
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
  $(document).ready(function(){

    $('#ifbox').show();

    $('#selecturl').change(function(){  
       selecturl = document.getElementById("selecturl").value;
        if (selecturl == 'iframeurl') {
          $('#ifbox').show();
          $('#ready_url').hide();
        }else if(selecturl=='customurl'){
         $('#ifbox').hide();
         $('#ready_url').show();
         $('#ready_url_text').text('Enter Custom URL or M3U8 URL');
       }
    });
  });
   
</script>


@endsection
