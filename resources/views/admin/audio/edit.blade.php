@extends('layouts.admin')
@section('title',__('Edit')." "." - $audio->title")

@section('content')
<div class="admin-form-main-block">
  <h4 class="admin-form-text">
    @can('audio.view')
      <a href="{{url('admin/audio')}}" data-toggle="tooltip" data-original-title="{{__('GoBack')}}" class="btn-floating"><i class="material-icons">reply</i></a> 
    @endcan
    {{__('EditAudio')}}</h4>
  <div class="row">
    <div class="col-md-6">
     <div class="admin-form-block z-depth-1">
       {!! Form::model($audio, ['method' => 'PATCH', 'action' => ['AudioController@update',$audio->id], 'files' => true]) !!}

      <div id="movie_title" class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        {!! Form::label('title', __('AudioTitle')) !!}
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Enter Audio Title')}}"></i>
        <input  type="text" class="form-control" name="title" value="{{ $audio->title }}">
        <small class="text-danger">{{ $errors->first('title') }}</small>
      </div>
         <div class="form-group{{ $errors->has('selecturl') ? ' has-error' : '' }}">
          {!! Form::label('selecturls', __('Add Audio')) !!}
          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Select One Of The Options To Add Audio')}}"></i>
           <select class="form-control select2" id="selecturl" name="selecturl">
         
            @if($audio['audiourl']!='')
            <option value="audiourl" selected="">{{__('Audio URL')}}</option>
            @else
              <option value="audiourl">{{__('Audio URL')}}</option>
            @endif
            
           
             @if($audio['upload_audio']!='')
             <option value="upload_audio" selected="">{{__('Upload Audio')}}</option>
              @else
               <option value="upload_audio">{{__('Upload Audio')}}</option>
            @endif
            

           
          </select>
           <small class="text-danger">{{ $errors->first('selecturl') }}</small>
         </div>


         <div id="ifbox" style="{{$audio['audiourl']!='' ? '' : "display: none" }}" class="form-group">
          <label for="audiourl">{{__('Audio URL:')}} </label> <a data-toggle="modal" data-target="#embdedexamp"><i class="fa fa-question-circle-o"> </i></a>
          <input  type="text" class="form-control" name="audiourl" placeholder="" value="{{$audio['audiourl']}}">
        </div>

         

       {{-- upload video --}}
      <div style="{{$audio['upload_audio']!='' ? '' : "display: none" }}"class="form-group{{ $errors->has('upload_audio') ? ' has-error' : '' }} input-file-block" id="uploadaudio" >
        {!! Form::label('upload_audio',__('Upload Audio')) !!} - <p class="info">{{__('Help Block Text')}}</p>
        <div class="input-group">
         
          <input type="text" class="form-control" id="upload_audio" name="upload_audio" >
          <span class="input-group-addon midia-toggle-upload_audio" data-input="upload_audio">{{__('Choose A Video')}}</span>
          
        </div>
        <small class="text-danger">{{ $errors->first('upload_audio') }}</small>
      </div>
     {{-- select to upload or add links code ends here --}}

     <div class="form-group{{ $errors->has('a_language') ? ' has-error' : '' }}">
      {!! Form::label('a_language', __('Audio Languages')) !!}
      <i class="fa fa-info-circle" data-toggle ="tooltip" data-placement="top" title="{{__('Please Select Audio Language')}}"></i>
      <div class="input-group">
        {!! Form::select('a_language[]', $a_lans, null, ['class' => 'form-control select2', 'multiple']) !!}
        <a href="#" data-toggle="modal" data-target="#AddLangModal" class="input-group-addon"><i class="material-icons left">add</i></a>
      </div>
      <small class="text-danger">{{ $errors->first('a_language') }}</small>
    </div>
    <div class="form-group{{ $errors->has('maturity_rating') ? ' has-error' : '' }}">
      {!! Form::label('maturity_rating', __('Maturity Rating')) !!}
      <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Select Maturity Rating')}}"></i>
      {!! Form::select('maturity_rating', array('all age' => __('All Age'), '13+' =>'13+', '16+' => '16+', '18+'=>'18+'), null, ['class' => 'form-control select2']) !!}
      <small class="text-danger">{{ $errors->first('maturity_rating') }}</small>
    </div>
    <div class="form-group" style="display: none">
      <div class="row">
        <div class="col-xs-6">
          {!! Form::label('', __('Choose Custom Thumbnail And Poster')) !!}
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
            {!! Form::label('thumbnail', __('Thumbnail')) !!} - <p class="info">{{__('Help Block Text')}}</p>
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
            <label for="poster" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title={{__('Poster')}}>
              <i class="icon fa fa-check"></i>
              <span class="js-fileName">{{__('Choose A File')}}</span>
            </label>
            <p class="info">{{__('Choose Custom Poster')}}</p>
            <small class="text-danger">{{ $errors->first('poster') }}</small>
          </div>
        </div>
      </div>
    </div>

    
    
    <div class="form-group{{ $errors->has('featured') ? ' has-error' : '' }}">
      <div class="row">
        <div class="col-xs-6">
          {!! Form::label('featured',__('Featured')) !!}
        </div>
        <div class="col-xs-5 pad-0">
          <label class="switch">
            {!! Form::checkbox('featured', 1, 0, ['class' => 'checkbox-switch']) !!}
            <span class="slider round"></span>
          </label>
        </div>
      </div>
      <div class="col-xs-12">
        <small class="text-danger">{{ $errors->first('featured') }}</small>
      </div>
    </div>

    <div class="form-group{{ $errors->has('is_protect') ? ' has-error' : '' }}">
      <div class="row">
        <div class="col-xs-6">
          {!! Form::label('is_protect', __('Protected Video?')) !!}
        </div>
        <div class="col-xs-5 pad-0">
          <label class="switch">
            <input type="checkbox" name="is_protect" class="checkbox-switch" id="is_protect">
            <span class="slider round"></span>
          </label>
        </div>
      </div>
      <div class="col-xs-12">
        <small class="text-danger">{{ $errors->first('is_protect') }}</small>
      </div>
    </div>
    <div class="search form-group{{ $errors->has('password') ? ' has-error' : '' }} is_protect" style="display: none;">
      {!! Form::label('password', __('Protected Password For Video')) !!}
      {!! Form::password('password', old('password'), ['class' => 'form-control','id'=>'password']) !!}
      <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
      <small class="text-danger">{{ $errors->first('password') }}</small>
    </div>



      <div class="form-group">
        <label for="">{{__('Meta Keyword:')}} </label>
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Enter Meta Keyword')}}"></i>
        <input name="keyword" value="{{old('keyword')}}" type="text" class="form-control" data-role="tagsinput"/>
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
                if ($menu->menu_data->where('audio_id', $audio->id)->where('menu_id', $menu->id)->first() != null) {
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
  
      <div class="form-group{{ $errors->has('rating') ? ' has-error' : '' }}">
        {!! Form::label('rating', __('Ratings')) !!}
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Ratings')}} eg:8"></i>
        {!! Form::text('rating',  old('rating'), ['class' => 'form-control', ]) !!}
        <small class="text-danger">{{ $errors->first('rating') }}</small>
      </div>
          
      <div class="form-group{{ $errors->has('genre_id') ? ' has-error' : '' }}">
       {!! Form::label('genre_id', __('Genre')) !!}
       <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Select Genres')}}"></i>
       <div class="input-group">
          <select name="genre_id[]" id="genre_id" class="form-control select2" multiple="multiple">
            @if(isset($old_genre) && count($old_genre) > 0)
            @foreach($old_genre as $old)
            <option value="{{$old->id}}" selected="selected">{{$old->name}}</option> 
            @endforeach
            @endif
            @if(isset($genre_ls))
            @foreach($genre_ls as $rest)
            <option value="{{$rest->id}}">{{$rest->name}}</option> 
            @endforeach
            @endif
          </select>  
          <a href="#" data-toggle="modal" data-target="#AddGenreModal" class="input-group-addon"><i class="material-icons left">add</i></a>
        </div>
        <small class="text-danger">{{ $errors->first('genre_id') }}</small>
      </div>
      <div class="form-group{{ $errors->has('detail') ? ' has-error' : '' }}">
         {!! Form::label('detail', __('Description')) !!}
         <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Audio Description')}}"></i>
         {!! Form::textarea('detail', old('detail'), ['class' => 'form-control materialize-textarea', 'rows' => '5']) !!}
         <small class="text-danger">{{ $errors->first('detail') }}</small>
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



<!-- Add Language Modal -->
<div id="AddLangModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">{{__('Add Language')}}</h5>
      </div>
      {!! Form::open(['method' => 'POST', 'action' => 'AudioLanguageController@store']) !!}
      <div class="modal-body">
        <div class="form-group{{ $errors->has('language') ? ' has-error' : '' }}">
          {!! Form::label('language', __('Language')) !!}
          {!! Form::text('language', null, ['class' => 'form-control', 'required' => 'required']) !!}
          <small class="text-danger">{{ $errors->first('language') }}</small>
        </div>
      </div>
      <div class="modal-footer">
        <div class="btn-group pull-right">
          <button type="reset" class="btn btn-info">{{__('Reset')}}</button>
          <button type="submit" class="btn btn-success">{{__('Create')}}</button>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>


<!-- Add Genre Modal -->
<div id="AddGenreModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">{{__('AddGenre')}}</h5>
      </div>
      {!! Form::open(['method' => 'POST', 'action' => 'GenreController@store']) !!}
      <div class="modal-body admin-form-block">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          {!! Form::label('name', __('Name')) !!}
          {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
          <small class="text-danger">{{ $errors->first('name') }}</small>
        </div>
      </div>
      <div class="modal-footer">
        <div class="btn-group pull-right">
          <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> {{__('Reset')}}</button>
          <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> {{__('Create')}}</button>
        </div>
      </div>
      <div class="clear-both"></div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection

@section('custom-script')
<script>
  $(document).ready(function(){
   
    $('#selecturl').change(function(){  
     selecturl = document.getElementById("selecturl").value;
     if (selecturl == 'audiourl') {
    $('#ifbox').show();
    $('#uploadaudio').hide();
    


  }else if (selecturl == 'upload_audio') {
   $('#uploadaudio').show();
   $('#ifbox').hide();
   

 }

});
 
  $('input[name="is_protect"]').click(function(){
    if($(this).prop("checked") == true){
      $('.is_protect').fadeIn();
    }
    else if($(this).prop("checked") == false){
      $('.is_protect').fadeOut();
    }
  });
   
  });
</script>
{{-- vimeo api code --}}


<script type="text/javascript">
    $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>
<script>
  $(".midia-toggle-upload_audio").midia({
		base_url: '{{url('')}}',
    dropzone : {
          acceptedFiles: '.mp3'
        },
    directory_name: 'audio'
	});
</script>
@endsection