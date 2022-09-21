@extends('layouts.admin')
@section('title',__('Edit')." "." - $liveevent->title")

@section('content')
<div class="admin-form-main-block">
  <h4 class="admin-form-text">
    @can('liveevent.view')
    <a href="{{url('admin/liveevent')}}" data-toggle="tooltip" data-original-title="{{__('Go Back')}}" class="btn-floating"><i class="material-icons">reply</i></a>
    @endcan
     {{__('Edit Live Event')}}</h4>
  <div class="row">
    <div class="col-md-6">
     <div class="admin-form-block z-depth-1">
      
      <!--vimeo API Modal -->

       {!! Form::model($liveevent, ['method' => 'PATCH', 'action' => ['LiveEventController@update',$liveevent->id], 'files' => true]) !!}

   

       <div id="movie_title" class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        {!! Form::label('title', __('EventTitle')) !!}
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Live Event Title')}}"></i>
        <input id="mv_t" type="text" class="form-control" name="title" value="{{ $liveevent->title }}">
        <small class="text-danger">{{ $errors->first('title') }}</small>
      </div>

       {{--  <div id="movie_slug" class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
        {!! Form::label('slug', 'Movie Slug') !!}
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter movie slug"></i>
        <input type="text" class="form-control" name="slug" value="{{ $movie->slug }}">
        <small class="text-danger">{{ $errors->first('slug') }}</small>
      </div> --}}

      {{-- select to upload code start from here --}}
      <div class="form-group{{ $errors->has('selecturl') ? ' has-error' : '' }}">
        {!! Form::label('selecturls',__('Add Video')) !!}
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Select One Of The Options To Add Video')}}"></i>
        <select class="form-control select2" id="selecturl" name="selecturl">
          <option></option>
          @if($liveevent['iframeurl']!='')
          <option value="iframeurl" selected="">{{__('IFrame URL')}}</option>
          @else
            <option value="iframeurl">{{__('IFrame URL')}}</option>
          @endif
          
      
           @if($liveevent['ready_url']!='')
           <option value="customurl" selected="">{{__('Custom URL Youtube URL Vimeo URL')}}</option>
            @else
             <option value="customurl">{{__('Custom URL Youtube URL Vimeo URL')}}</option>
          @endif
       
        </select>
       
        <small class="text-danger">{{ $errors->first('selecturl') }}</small>
      </div>      
      <div id="ifbox"  style="{{$liveevent['iframeurl']!='' ? '' : "display: none" }}" class="form-group">
        <label for="iframeurl">{{__('IFRAME URL')}}: </label> <a data-toggle="modal" data-target="#embdedexamp"><i class="fa fa-question-circle-o"> </i></a>
        <input  type="text" value="{{$liveevent['iframeurl']}}" class="form-control" name="iframeurl" placeholder="{{__('Iframe URL')}}">
      </div>

   

      {{-- custom /M3U8 --}}
      <div id="ready_url" style="{{$liveevent['ready_url']!='' ? '' : "display: none" }}" class="form-group{{ $errors->has('ready_url') ? ' has-error' : '' }}">
       <label id="ready_url_text"></label>
       <p class="inline info"> {{__('Please Enter Your Video Url')}}</p>
       {!! Form::text('ready_url',$liveevent['ready_url'], ['class' => 'form-control','id'=>'apiUrl']) !!}
       <small class="text-danger">{{ $errors->first('ready_url') }}</small>
     </div>
    

    

  
      <div class="form-group" style="display: none">
        <div class="row">
          <div class="col-xs-6">
            {!! Form::label('', 'Choose custom thumbnail & poster') !!}
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
                <span class="js-fileName">{{__('Choose A File')}}</span>
              </label>
              <p class="info">{{__('Choose Custom Thumbnail')}}</p>
              <small class="text-danger">{{ $errors->first('thumbnail') }}</small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group{{ $errors->has('poster') ? ' has-error' : '' }} input-file-block">
              {!! Form::label('poster', __('Poster')) !!} - <p class="info">{{__('Help Block Text')}}</p>
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
              @php
              $checked = null;
              if (isset($menu->menu_data) && count($menu->menu_data) > 0) {
                if ($menu->menu_data->where('movie_id', $liveevent->id)->where('menu_id', $menu->id)->first() != null) {
                  $checked = 1;
                }
              }
              @endphp
              @if ($checked == 1)
              <input type="checkbox" class="filled-in material-checkbox-input" name="menu[]" value="{{$menu->id}}" id="checkbox{{$menu->id}}" checked>
              <label for="checkbox{{$menu->id}}" class="material-checkbox"></label>
              @else
              <input type="checkbox" class="filled-in material-checkbox-input" name="menu[]" value="{{$menu->id}}" id="checkbox{{$menu->id}}">
              <label for="checkbox{{$menu->id}}" class="material-checkbox"></label>
              @endif
            </div>
            {{$menu->name}}
          </li>
          @endforeach
        </ul>
        @endif
      </div>
            
      <div class="form-group{{ $errors->has('start_time') ? ' has-error' : '' }}">
        {!! Form::label('start_time',__('EventStartTime')) !!}
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Select Start Time')}}"></i>
         <input type="datetime-local" name="start_time" class="form-contrrol" value="{{date('Y:m:d H:i:s',strtotime($liveevent->start_time))}}" >
        <small class="text-danger">{{ $errors->first('start_time') }}</small>
      </div>
       <div class="form-group{{ $errors->has('end_time') ? ' has-error' : '' }}">
        {!! Form::label('end_time', __('Event End Time')) !!}
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Select End Time')}}"></i>
         <input type="datetime-local" name="end_time" class="form-contrrol" value="{{$liveevent->end_time}}" >
        <small class="text-danger">{{ $errors->first('end_time') }}</small>
      </div>  
 
       <div class="form-group{{ $errors->has('organized_by') ? ' has-error' : '' }}">
        {!! Form::label('organized_by', __('Event Organize dBy')) !!}
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Organized By')}} "></i>
        {!! Form::text('organized_by',  $liveevent->organized_by, ['class' => 'form-control', ]) !!}
        <small class="text-danger">{{ $errors->first('organized_by') }}</small>
      </div>
      
       
       <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
         {!! Form::label('description',__('Description')) !!}
         <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Live Event Description')}}"></i>
         {!! Form::textarea('description', null, ['class' => 'form-control materialize-textarea', 'rows' => '5']) !!}
         <small class="text-danger">{{ $errors->first('description') }}</small>
       </div>

        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
          <div class="row">
            <div class="col-xs-6">
              {!! Form::label('status',__('Status')) !!}
            </div>
            <div class="col-xs-5 pad-0">
              <label class="switch">                
                {!! Form::checkbox('status', 1, $liveevent->status, ['class' => 'checkbox-switch']) !!}
                <span class="slider round"></span>
              </label>
            </div>
          </div>
          <div class="col-xs-12">
            <small class="text-danger">{{ $errors->first('status') }}</small>
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
       $('#ready_url_text').text('Enter Custom URL orm M3U8 URL');
   }
   
});
    
</script>

@endsection