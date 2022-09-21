@extends('layouts.admin')
@section('title',__('Edit Episodes'))

@section('content')
  <div class="admin-form-main-block mrg-t-40">

<!--youtube API Modal -->
    <div id="myyoutubeModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
        <!--youtube API Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h5 class="modal-title">{{__('Search From Youtube API')}}</h5>
          </div>
          <div class="modal-body">
            @if(is_null(env('YOUTUBE_API_KEY')))
            <p>{{__('Make Sure You Have Added Youtube APIKey In')}} <a href="{{url('admin/api-settings')}}">{{__('API Settings')}}</a></p>
            @endif
           
              <div id="hyv-page-container" style="clear:both;">
                    <div class="hyv-content-alignment">
                        <div id="hyv-page-content" class="" style="overflow:hidden;">
                            <div class="container-4">
                                <form action="" method="post" name="hyv-yt-search" id="hyv-yt-search">
                                    <input type="search" name="hyv-search" id="hyv-search" placeholder="{{__('Search')}}..." class="ui-autocomplete-input" autocomplete="off">
                                    <button class="icon" id="hyv-searchBtn"></button>
                                </form>
                            </div>
                            <div>
                                <input type="hidden" id="pageToken" value="">
                                <div class="btn-group" role="group" aria-label="...">
                                  <button type="button" id="pageTokenPrev" value="" class="btn btn-default">{{__('Prev')}}</button>
                                  <button type="button" id="pageTokenNext" value="" class="btn btn-default">{{__('Next')}}</button>
                                </div>
                            </div>
                            <div id="hyv-watch-content" class="hyv-watch-main-col hyv-card hyv-card-has-padding">
                                <ul id="hyv-watch-related" class="hyv-video-list">
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Close')}}</button>
          </div>
        </div>

      </div>
    </div>

    <h4 class="admin-form-text">
      @can('tvseries.view')
      <a href="{{url('admin/tvseries/seasons/' .$season->id. '/episodes')}}" data-toggle="tooltip" data-original-title="{{__('Go Back')}}" class="btn-floating"><i class="material-icons">reply</i></a> 
      @endcan
      {{__('Edit Episodes')}} <span>{{__('Of')}} {{$season->tvseries->title}} {{__('Season')}} {{$season->season_no}} {{__('Episode Number')}} {{$episode->episode_no}}
      @if ($season->tmdb == 'Y')
        <span class="min-info">{!!$season->tmdb == 'Y' ? '<i class="material-icons">check_circle</i> by tmdb' : ''!!}</span>
      @endif
    </span></h4>
   

<!--vimeo API Modal -->
    <div id="myvimeoModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">

        <!--vimeo API Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h5 class="modal-title">{{__('Search From Vimeo API')}}</h5>
          </div>
          <div class="modal-body">
            @if(is_null(env('VIMEO_ACCESS')))
            <p>{{__('Make Sure You Have Added Youtube APIKey In')}} <a href="{{url('admin/api-settings')}}">{{__('API Settings')}}</a>></p>
            @endif
           
              <div id="vimeo-page-container" style="clear:both;">
                    <div class="vimeo-content-alignment">
                        <div id="vimeo-page-content" class="" style="overflow:hidden;">
                            <div class="container-4">
                                <form action="" method="post" name="vimeo-yt-search" id="vimeo-yt-search">
                                    <input type="search" name="vimeo-search" id="vimeo-search" placeholder="{{__('Search')}}..." class="ui-autocomplete-input" autocomplete="off">
                                    <button class="icon" id="vimeo-searchBtn"></button>
                                </form>
                            </div>
                            <div>
                                <input type="hidden" id="vpageToken" value="">
                                <div class="btn-group" role="group" aria-label="...">
                                  <button type="button" id="vpageTokenPrev" value="" class="btn btn-default">{{__('Prev')}}</button>
                                  <button type="button" id="vpageTokenNext" value="" class="btn btn-default">{{__('Next')}}</button>
                                </div>
                            </div>
                            <div id="vimeo-watch-content" class="vimeo-watch-main-col vimeo-card vimeo-card-has-padding">
                                <ul id="vimeo-watch-related" class="vimeo-video-list">
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Close')}}</button>
          </div>
        </div>

      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="admin-form-block z-depth-1">
          
          @if(isset($episode))
          
              <div id="editForm{{$episode->id}}" class="edit-form">

                {!! Form::model($episode, ['method' => 'PATCH', 'action' => ['TvSeriesController@update_episodes', $episode->id], 'files' => true]) !!}
                 

                  <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    {!! Form::label('title', __('Episode Title')) !!}
                    <p class="inline info"> - {{__('Enter Your Episode Title')}}</p>
                    {!! Form::text('title', null, ['class' => 'form-control', 'min' => '1']) !!}
                    <small class="text-danger">{{ $errors->first('title') }}</small>
                  </div>

                  <div class="form-group{{ $errors->has('episode_no') ? ' has-error' : '' }}">
                    {!! Form::label('episode_no',__('Episode No.')) !!}
                    <p class="inline info"> - ({{__('Must Fill By Tmdb')}})</p>
                    {!! Form::number('episode_no', null, ['class' => 'form-control', 'min' => '1']) !!}
                    <small class="text-danger">{{ $errors->first('episode_no') }}</small>
                  </div>

                  <div class="form-group{{ $errors->has('duration') ? ' has-error' : '' }}">
                    {!! Form::label('duration', __('Duration')) !!} <p class="inline info">- {{__('In Minutes')}}(exa. 60)</p>
                    {!! Form::text('duration', null, ['class' => 'form-control']) !!}
                    <small class="text-danger">{{ $errors->first('duration') }}</small>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-xs-6">
                        {!! Form::label('', __('Choose Custom Thumbnail And Poster')) !!}
                      </div>
                      <div class="col-xs-5 pad-0">
                        <label class="switch for-custom-image">
                          {!! Form::checkbox('', 1, 0, ['class' => 'checkbox-switch']) !!}
                          <span class="slider round"></span>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="upload-image-main-block" style="display: none;">
                    <div class="row">
                      <div class="form-group{{ $errors->has('thumbnail') ? ' has-error' : '' }} input-file-block">
                        {!! Form::label('thumbnail',__('Thumbnail')) !!} - <p class="info">{{__('Help Block Text')}}</p>
                        {!! Form::file('thumbnail', ['class' => 'input-file', 'id'=>'thumbnail']) !!}
                        <label for="thumbnail" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{isset($episode->thumbnail) ? $episode->thumbnail :__('Thumbnail')}}">
                          <i class="icon fa fa-check"></i>
                          <span class="js-fileName">{{isset($episode->thumbnail) ? $episode->thumbnail :__('Choose A File')}}</span>
                        </label>
                        <p class="info">{{__('Choose Custom Thumbnail')}}</p>
                        <small class="text-danger">{{ $errors->first('thumbnail') }}</small>
                      </div>
                    </div>
                  </div>
                  <div class="form-group{{ $errors->has('a_language') ? ' has-error' : '' }}">
                      {!! Form::label('a_language', __('Audio Languages')) !!}
                      <p class="inline info"> - {{__('Please Select Audio Language')}}</p>
                      <div class="input-group">
                        {!! Form::select('a_language[]', $a_lans, null, ['class' => 'form-control select2', 'multiple']) !!}
                        <a href="#" data-toggle="modal" data-target="#AddLangModal" class="input-group-addon"><i class="material-icons left">add</i></a>
                      </div>
                      <small class="text-danger">{{ $errors->first('a_language') }}</small>
                  </div>
                               {{-- select to upload code start from here --}}
                  <div class="form-group{{ $errors->has('selecturl') ? ' has-error' : '' }}">
                    {!! Form::label('selecturls', __('Add Video')) !!}
                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Select One Of The Options To Add Video')}}"></i>
                      <select class="form-control select2" id="selecturl" name="selecturl">
                        <option></option>
                        @if(isset($video_link['iframeurl']) && $video_link['iframeurl']!='')
                        <option value="iframeurl" selected="">{{__('IFrame URL Embed URL')}}</option>
                        @else
                          <option value="iframeurl">{{__('IFrame URL Embed URL')}}</option>
                        @endif
                        
                        <option value="youtubeapi">{{__('You Tube Api')}}</option>
                         <option value="vimeoapi">{{__('Vimeo Api')}}</option>
                         @if(isset($video_link['ready_url']) && $video_link['ready_url']!='')
                         <option value="customurl" selected="">{{__('Custom URL Youtube URL Vimeo URL')}}</option>
                          @else
                           <option value="customurl">{{__('Custom URL Youtube URL Vimeo URL')}}</option>
                      @endif
                        @if(isset($video_link['url_360']) && $video_link['url_360'] || isset($video_link['url_480']) && $video_link['url_480'] || isset($video_link['url_720']) && $video_link['url_720'] || isset($video_link['url_1080']) && $video_link['url_1080'] !='')
                         <option  selected=""  value="multiqcustom">{{__('Multi Quality Custom URL And URL Upload')}}</option>
                         @else
                          <option value="multiqcustom">{{__('Multi Quality Custom URL And URL Upload')}}</option>
                        @endif
                      </select>
                    <small class="text-danger">{{ $errors->first('selecturl') }}</small>
                  </div>
                  <div id="ifbox" style="{{isset($video_link['iframeurl']) && $video_link['iframeurl']!='' ? '' : "display: none" }}" class="form-group">
                    <label for="iframeurl">{{__('IFrame URL Embed URL')}}: </label> <a data-toggle="modal" data-target="#embdedexamp"><i class="fa fa-question-circle-o"> </i></a>
                    <input  type="text" value="{{isset($video_link['iframeurl']) && $video_link['iframeurl']}}" class="form-control" name="iframeurl" placeholder="">
                  </div>

                  <div style="{{ isset($video_link['url_360']) && $video_link['url_360'] || isset($video_link['url_480']) && $video_link['url_480'] || isset($video_link['url_720']) && $video_link['url_720'] || isset($video_link['url_1080']) && $video_link['url_1080'] != '' ? "" : "display:none" }}" id="custom_url">
                    
                    <p style="color: red" class="inline info">{{__('Upload Videos Not Support')}} !</p>
                    <br>
                    <p class="inline info">{{__('Openload Google Drive And Other URL Add Here')}}!</p>
                    <br><br>
                    <div class="row">
                      <div class="col-md-7">
                         <div class="form-group{{ $errors->has('url_360') ? ' has-error' : '' }}">
                            {!! Form::label('url_360', __('Video Url For 360  Quality')) !!}
                            <p class="inline info"> - {{__('Please Enter Your Video Url')}}</p>
                            {!! Form::text('url_360',isset($video_link['url_360']) && $video_link['url_360'] ? $video_link['url_360'] : NULL, ['class' => 'form-control']) !!}
                            <small class="text-danger">{{ $errors->first('url_360') }}</small>
                         </div>
                      </div>
                      <div class="col-md-5">
                        {!! Form::label('upload_video', 'Upload Video in 360p') !!} - <p class="inline info">{{__('Choose A Video')}}</p>
                        <div class="input-group">
                          <input type="text" class="form-control" id="upload_video_360" name="upload_video_360" >
                          <span class="input-group-addon midia-toggle-upload_video_360" data-input="upload_video_360">{{__('Choose A Video')}}</span>
                        </div>
                        <small class="text-danger">{{ $errors->first('upload_video_360') }}</small>
                      </div>
                    </div>
                    <div class="form-group{{ $errors->has('url_480') ? ' has-error' : '' }}">
                      <div class="row">
                        <div class="col-md-7">
                          {!! Form::label('url_480',__('Video Url For 480 Quality')) !!}
                          <p class="inline info"> - {{__('Please Enter Your Video Url')}}</p>
                          {!! Form::text('url_480', isset($video_link['url_480']) && $video_link['url_480'] ? $video_link['url_480'] : NULL, ['class' => 'form-control']) !!}
                          <small class="text-danger">{{ $errors->first('url_480') }}</small>
                        </div>
                        <div class="col-md-5">
                          {!! Form::label('upload_video', __('Upload Video In 480p')) !!} - <p class="inline info">{{__('Choose A Video')}}</p>
                          <div class="input-group">
                            <input type="text" class="form-control" id="upload_video_480" name="upload_video_480" >
                            <span class="input-group-addon midia-toggle-upload_video_480" data-input="upload_video_480">{{__('Choose A Video')}}</span>
                          </div>
                          <small class="text-danger">{{ $errors->first('upload_video_480') }}</small>
                        </div>
                      </div>
                    </div>
                    <div class="form-group{{ $errors->has('url_720') ? ' has-error' : '' }}">
                      <div class="row">
                        <div class="col-md-7">
                          {!! Form::label('url_720', __('Video Url For 720 Quality')) !!}
                          <p class="inline info"> - {{__('Please Enter Your Video Url')}}</p>
                          {!! Form::text('url_720',isset($video_link['url_720']) && $video_link['url_720'] ? $video_link['url_720'] : NULL, ['class' => 'form-control']) !!}
                          <small class="text-danger">{{ $errors->first('url_720') }}</small>
                        </div>

                        <div class="col-md-5">
                           {!! Form::label('upload_video', __('Upload Video In 720p')) !!} - <p class="inline info">{{__('Choose A Video')}}</p>
                           <div class="input-group">
                            <input type="text" class="form-control" id="upload_video_720" name="upload_video_720" >
                            <span class="input-group-addon midia-toggle-upload_video_720" data-input="upload_video_720">{{__('Choose A Video')}}</span>
                          </div>
                          <small class="text-danger">{{ $errors->first('upload_video_720') }}</small>
                        </div>
                      </div>
                    </div>
                    <div class="form-group{{ $errors->has('url_1080') ? ' has-error' : '' }}">
                     <div class="row">
                       <div class="col-md-7">
                          {!! Form::label('url_1080',__('Video Url For 1080 Quality')) !!}
                          <p class="inline info"> - {{__('Please Enter Your Video Url')}}</p>
                          {!! Form::text('url_1080', isset($video_link['url_1080']) && $video_link['url_1080'] ? $video_link['url_1080'] : NULL, ['class' => 'form-control']) !!}
                          <small class="text-danger">{{ $errors->first('url_1080') }}</small>
                       </div>

                        <div class="col-md-5">
                          {!! Form::label('upload_video', 'Upload Video in 1080p') !!} - <p class="inline info">Choose A Video</p>
                          <div class="input-group">
                            <input type="text" class="form-control" id="upload_video_1080" name="upload_video_1080" >
                            <span class="input-group-addon midia-toggle-upload_video_1080" data-input="upload_video_1080">{{__('Choose A Video')}}</span>
                          </div>
                              <small class="text-danger">{{ $errors->first('upload_video_1080') }}</small>
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="modal fade" id="embdedexamp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h6 class="modal-title" id="myModalLabel">{{__('Embded URL Examples')}}: </h6>
                        </div>
                        <div class="modal-body">
                          <p style="font-size: 15px;"><b>{{__('Youtube')}}:</b> {{__('Youtube Url Link')}} </p>

                          <p style="font-size: 15px;"><b>{{__('Google Drive')}}:</b> {{__('Google Drive Link')}}</p>

                          <p style="font-size: 15px;"><b>{{__('Openload')}}:</b> {{__('Openload Link')}} </p>

                          <p style="font-size: 15px;"><b>{{__('Note')}}:</b> {{__('Do Not Include')}} &lt;iframe&gt; {{__('Tag Before URL')}}</p>
                        </div>
                        
                      </div>
                    </div>
                  </div>

                  {{-- youtube and vimeo url --}}
                  <div id="ready_url" style="{{isset($video_link['ready_url']) && $video_link['ready_url'] != '' ? '' : "display: none" }}"  class="form-group{{ $errors->has('ready_url') ? ' has-error' : '' }}">
                    <label id="ready_url_text"></label>
                      <p class="inline info"> - {{__('Please Enter Your Video Url')}}</p> <button type="button" onclick="encript()" id="encryptlink" class="btn btn-sm btn-info">{{__('Encrypt Link')}}</button>
                     {!! Form::text('ready_url', isset($video_link['ready_url']) && $video_link['ready_url'] ? $video_link['ready_url'] : NULL, ['class' => 'form-control','id'=>'apiUrl']) !!}
                    <small class="text-danger">{{ $errors->first('ready_url') }}</small>
                  </div>

                 {{-- upload video --}}
                
                  {{-- select to upload or add links code ends here --}}

                  <div class="pad_plus_border" id="subtitle_section">
                    <div class="form-group{{ $errors->has('subtitle') ? ' has-error' : '' }}">
                      <div class="row">
                        <div class="col-xs-6">
                          {!! Form::label('subtitle', __('Subtitle')) !!}
                        </div>
                        <div class="col-xs-5 pad-0">
                          <label class="switch">
                            <input {{ $episode->subtitle == 1 ? "checked" : "" }} type="checkbox" id="subtitle_check" name="subtitle">
                            <span class="slider round"></span>
                          </label>
                        </div>
                      </div>
                      <div class="col-xs-12">
                        <small class="text-danger">{{ $errors->first('subtitle') }}</small>
                      </div>
                    </div>
                   
                    <div>
                      <div class="subtitle-box" style="{{ $episode->subtitle == 1 ? "" : "display: none" }}">
                        <label>{{__('Subtitle')}}:</label>
                        <table class="table table-bordered" id="dynamic_field">  
                          <tr> 
                              <td>
                                 <div class="form-group{{ $errors->has('sub_t') ? ' has-error' : '' }} input-file-block">
                                  <input type="file" name="sub_t[]"/>
                                  <p class="info">{{__('ChooseSubtitleFile')}} ex. subtitle.srt, or. txt</p>
                                  <small class="text-danger">{{ $errors->first('sub_t') }}</small>
                                </div>
                              </td>

                              <td>
                                <input type="text" name="sub_lang[]" placeholder="{{__('Subtitle Language')}}" class="form-control name_list" />
                              </td>  
                              <td><button type="button" name="add" id="add" class="btn btn-xs btn-success">
                                <i class="fa fa-plus"></i>
                              </button></td>  
                          </tr>  
                        </table>
                      </div>
                    </div>
                  </div>

                  <div class="switch-field">
                    <div class="switch-title">{{__('Want TMDB Data And More Or Custom')}}?</div>
                    <input type="radio" id="switch_left" class="imdb_btn" name="tmdb" value="Y" {{$episode->tmdb == 'Y' ? 'checked' : ''}}/>
                    <label for="switch_left">{{__('TMDB')}}</label>
                    <input type="radio" id="switch_right" class="custom_btn" name="tmdb" value="N" {{$episode->tmdb == 'N' ? 'checked' : ''}} />
                    <label for="switch_right">{{__('Custom')}}</label>
                  </div>

                  <div id="custom_dtl" class="custom-dtl">
                    <div class="form-group{{ $errors->has('released') ? ' has-error' : '' }}">
                      {!! Form::label('released',__('Released')) !!} <p class="inline info">- {{__('Release Date')}}</p>
                      {!! Form::date('released', null, ['class' => 'form-control']) !!}
                      <small class="text-danger">{{ $errors->first('released') }}</small>
                    </div>
                    <div class="form-group{{ $errors->has('detail') ? ' has-error' : '' }}">
                      {!! Form::label('detail',__('Description')) !!}
                      {!! Form::textarea('detail', null, ['class' => 'form-control materialize-textarea', 'rows' => '5']) !!}
                      <small class="text-danger">{{ $errors->first('detail') }}</small>
                    </div>
                  </div>

                  {!! Form::hidden('seasons_id', $season->id) !!}
                  {!! Form::hidden('tv_series_id', $season->tvseries->id) !!}
                  <div class="btn-group pull-right">
                    <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> {{__('Reset')}}</button>
                    <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> {{__('Update')}}</button>
                  </div>
                  <div class="clear-both"></div>
                    {!! Form::close() !!}
              </div>       
          @endif
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
                <button type="submit" class="btn btn-success">{{__('Update')}}</button>
              </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="admin-form-block z-depth-1">
         {{--  <a data-target="#submodal" data-toggle="modal"  class="btn btn-success pull-right">Add Subtitle</a> --}}
          <h5>{{__('Subtitles')}}</h5>

          <hr>

          <table class="table table-borderd">
            <thead>
              <tr>
                <th>#</th>
                <th>{{__('Subtitle Language')}}</th>
                <th>{{__('Actions')}}</th>
              </tr>
            </thead>

            <tbody>
              @foreach($episode->subtitles as $key=> $subtitle)
              <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $subtitle->sub_lang }}</td>
                <td>
                 <button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#{{$subtitle->id}}deleteModal"><i class="material-icons">delete</i> </button></td>
               </tr>

               <div id="{{$subtitle->id}}deleteModal" class="delete-modal modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <div class="delete-icon"></div>
                    </div>
                    <div class="modal-body text-center">
                      <h4 class="modal-heading">{{__('Are You Sure')}} ?</h4>
                      <p>{{__('Delete Warrning')}}</p>
                    </div>
                    <div class="modal-footer">
                      {!! Form::open(['method' => 'POST', 'action' => ['SubtitleController@delete', $subtitle->id]]) !!}
                      <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                      <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                      {!! Form::close() !!}
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('custom-script')

  <script>
      $('.for-custom-image input').click(function(){
    if($(this).prop("checked") == true){
      $('.upload-image-main-block').fadeIn();
    }
    else if($(this).prop("checked") == false){
      $('.upload-image-main-block').fadeOut();
    }
  });
    $(document).ready(function(){
   

    $('#selecturl').change(function(){  
     selecturl = document.getElementById("selecturl").value;
       if (selecturl == 'iframeurl') {
    $('#ifbox').show();
     $('#subtitle_section').show();
     $('#ready_url').hide();
     $('#custom_url').hide();

   }else if (selecturl=='customurl') {
    $('#custom_url').hide();
      $('#ready_url_text').text('Enter Custom URL or Vimeo or Youtube URL');
     $('#ready_url').show();
       $('#ifbox').hide();
        $('#subtitle_section').show();
   }
    else if (selecturl == 'youtubeapi') {
    $('#subtitle_section').show();
   $('#ready_url').show();
 $('#custom_url').hide();
   $('#ifbox').hide();
   $('#ready_url_text').text('Import From Youtube API');

 }else if(selecturl=='vimeoapi'){
   $('#ifbox').hide();
    $('#subtitle_section').show();
   $('#ready_url').show();
   $('#custom_url').hide();
   $('#ready_url_text').text('Import From Vimeo API');
 }
 else if(selecturl=='multiqcustom'){
   $('#ifbox').hide();
   $('#ready_url').hide();
   $('#subtitle_section').show();
   $('#custom_url').show();
 }

 }); 
  });
</script>

     
 

  <script>
        $(document).ready(function() {
           var videourl;
            youtubeApiCall();
            $("#pageTokenNext").on( "click", function( event ) {
                $("#pageToken").val($("#pageTokenNext").val());
                youtubeApiCall();
            });
            $("#pageTokenPrev").on( "click", function( event ) {
                $("#pageToken").val($("#pageTokenPrev").val());
                youtubeApiCall();
            });
            $("#hyv-searchBtn").on( "click", function( event ) {
                youtubeApiCall();
                return false;
            });
            jQuery( "#hyv-search" ).autocomplete({
              source: function( request, response ) {
                //console.log(request.term);
                var sqValue = [];
                jQuery.ajax({
                    type: "POST",
                    url: "http://suggestqueries.google.com/complete/search?hl=en&ds=yt&client=youtube&hjson=t&cp=1",
                    dataType: 'jsonp',
                    data: jQuery.extend({
                        q: request.term
                    }, {  }),
                    success: function(data){
                        console.log(data[1]);
                        obj = data[1];
                        jQuery.each( obj, function( key, value ) {
                            sqValue.push(value[0]);
                        });
                        response( sqValue);
                    }
                });
              },
              select: function( event, ui ) {
                setTimeout( function () { 
                    youtubeApiCall();
                }, 300);
              }
            });  
        });
function youtubeApiCall(){
    $.ajax({
        cache: false,
        data: $.extend({
            key: '{{env('YOUTUBE_API_KEY')}}',
            q: $('#hyv-search').val(),
            part: 'snippet'
        }, {maxResults:15,pageToken:$("#pageToken").val()}),
        dataType: 'json',
        type: 'GET',
        timeout: 5000,
        url: 'https://www.googleapis.com/youtube/v3/search'
    })
    .done(function(data) {
        if (typeof data.prevPageToken === "undefined") {$("#pageTokenPrev").hide();}else{$("#pageTokenPrev").show();}
        if (typeof data.nextPageToken === "undefined") {$("#pageTokenNext").hide();}else{$("#pageTokenNext").show();}
        var items = data.items, videoList = "";
        $("#pageTokenNext").val(data.nextPageToken);
        $("#pageTokenPrev").val(data.prevPageToken);
        // console.log(items);
        $.each(items, function(index,e) {
             
             videourl="https://www.youtube.com/watch?v="+e.id.videoId;
               console.log(videourl);
            videoList = videoList 
            + '<li class="hyv-video-list-item" ><div class="hyv-content-wrapper"><p  class="hyv-content-link" title="'+e.snippet.title+'"><span class="title">'+e.snippet.title+'</span><span class="stat attribution">by <span>'+e.snippet.channelTitle+'</span></span></p><button class="bn btn-info btn-sm inline" onclick=setVideoURl("'+videourl+'")>Add</button></div><div class="hyv-thumb-wrapper"><p class="hyv-thumb-link"><span class="hyv-simple-thumb-wrap"><img alt="'+e.snippet.title+'" src="'+e.snippet.thumbnails.default.url+'" height="90"></span></p></div></li>';
              
          
        });

        $("#hyv-watch-related").html(videoList);
       
    });
}
    </script>
<script type="text/javascript">
  var i= 1;
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="file" name="sub_t[]"/></td><td><input type="text" name="sub_lang[]" placeholder="Subtitle Language" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-sm btn_remove">X</button></td></tr>');  
      });

      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
      
  function setVideoURl(videourls){
    console.log(videourls);
  $('#apiUrl').val(videourls); 
    $('#myyoutubeModal').modal("hide");
  }
</script>
<script type="text/javascript">
  $(document).ready(function(){ 
    $('#selecturl').change(function() {
     $('#apiUrl').val('');  
        var opval = $(this).val(); //Get value from select element
        if(opval=="youtubeapi"){ //Compare it and if true
            $('#myyoutubeModal').modal("show"); //Open Modal
        }
    });
});
</script>
{{-- vimeo api code --}}

<script>
        $(document).ready(function() {
           var videourl;
            vimeoApiCall();
            $("#vpageTokenNext").on( "click", function( event ) {
                $("#vpageToken").val($("#vpageTokenNext").val());
                vimeoApiCall();
            });
            $("#vpageTokenPrev").on( "click", function( event ) {
                $("#vpageToken").val($("#vpageTokenPrev").val());
                vimeoApiCall();
            });
            $("#vimeo-searchBtn").on( "click", function( event ) {
                vimeoApiCall();
                return false;
            });
            jQuery( "#vimeo-search" ).autocomplete({
              source: function( request, response ) {
                //console.log(request.term);
                var sqValue = [];
                var accesstoken='{{env('VIMEO_ACCESS')}}';
                var myvimeourl='https://api.vimeo.com/videos?query=videos'+'&access_token=' + accesstoken +'&per_page=1';
                console.log(myvimeourl);
                jQuery.ajax({
                    type: "GET",
                    url: myvimeourl,
                    dataType: 'jsonp',
                    
                    success: function(data){
                        console.log(data[1]);
                        obj = data[1];
                        jQuery.each( obj, function( key, value ) {
                            sqValue.push(value[0]);
                        });
                        response( sqValue);
                    }
                });
              },
              select: function( event, ui ) {
                setTimeout( function () { 
                    vimeoApiCall();
                }, 300);
              }
            });  
        });
function vimeoApiCall(){
  console.log('yeah i am here');
    var accesstoken='{{env('VIMEO_ACCESS')}}';
    var text=$("#vimeo-search").val();
   var next=  $("#vpageTokenNext").val();
   console.log('jxhh'+next);
   var prev= $("#vpageTokenPrev").val();
    var myvimeourl=null;
   if (next != null && next !='') {
     myvimeourl='https://api.vimeo.com'+next;
   }else if (prev != null && prev !='') {
       myvimeourl='https://api.vimeo.com'+prev;
   }else{
       myvimeourl='https://api.vimeo.com/videos?query='+ text + '&access_token=' + accesstoken+'&per_page=5';
   }
  
   console.log('url'+myvimeourl);
    $.ajax({
        cache: false,
     
        dataType: 'json',
        type: 'GET',
       
        url: myvimeourl,

    })
    .done(function(data) {
      console.log(data);
    // alert('duhjf');
        if ( data.paging.previous === null) {$("#vpageTokenPrev").hide();}else{$("#vpageTokenPrev").show();}
        if ( data.paging.next === null) {$("#vpageTokenNext").hide();}else{$("#vpageTokenNext").show();}
        var items = data.data, videoList = "";
     
        $("#vpageTokenNext").val(data.paging.next);
        $("#vpageTokenPrev").val(data.paging.previous);
        console.log(items);
        $.each(items, function(index,e) {
             
             videourl=e.link;
               // console.log(videourl);
            videoList = videoList 
            + '<li class="hyv-video-list-item" ><div class="hyv-thumb-wrapper"><p class="hyv-thumb-link"><span class="hyv-simple-thumb-wrap"><img alt="'+e.name+'" src="'+e.pictures.sizes[3].link+'" height="90"></span></p></div><div class="hyv-content-wrapper"><p  class="hyv-content-link">'+e.name+'<span class="title">'+e.description.substr(0, 105)+'</span><span class="stat attribution">by <span>'+e.user.name+'</span></span></p><button class="bn btn-info btn-sm inline" onclick=setVideovimeoURl("'+videourl+'")>Add</button></div></li>';
              
          
        });

        $("#vimeo-watch-related").html(videoList);
       
    });

}
</script>
<script type="text/javascript">
  function setVideovimeoURl(videourls){
    console.log(videourls);
  $('#apiUrl').val(videourls); 
    $('#myvimeoModal').modal("hide");
  }
</script>
<script type="text/javascript">
  $(document).ready(function(){ 
    $('#selecturl').change(function() {
     $('#apiUrl').val('');  
        var opval = $(this).val(); //Get value from select element
        if(opval=="youtubeapi"){ //Compare it and if true
            $('#myyoutubeModal').modal("show"); //Open Modal
        }
        if(opval=="vimeoapi"){ //Compare it and if true
            $('#myvimeoModal').modal("show"); //Open Modal
        }
    });
});
</script>
<script>
  $('#subtitle_check').on('change',function(){

    if($('#subtitle_check').is(':checked')){
      $('.subtitle-box').show('fast');
    }else{
       $('.subtitle-box').hide('fast');
    }

  });
</script>
<script>
  $(".midia-toggle-upload_video_360").midia({
   base_url: '{{url('')}}',
   dropzone : {
          acceptedFiles: '.mp4,.m3u8'
        },
   directory_name: 'tvshow_upload/url_360'
 });

 $(".midia-toggle-upload_video_480").midia({
   base_url: '{{url('')}}',
   dropzone : {
          acceptedFiles: '.mp4,.m3u8'
        },
   directory_name: 'tvshow_upload/url_480'
 });

 $(".midia-toggle-upload_video_720").midia({
   base_url: '{{url('')}}',
   dropzone : {
          acceptedFiles: '.mp4,.m3u8'
        },
   directory_name: 'tvshow_upload/url_720'
 });

 $(".midia-toggle-upload_video_1080").midia({
   base_url: '{{url('')}}',
   dropzone : {
          acceptedFiles: '.mp4,.m3u8'
        },
   directory_name: 'tvshow_upload/url_1080'
 });
</script>
<script type="text/javascript" src="{{url('js/encrypt.js')}}"></script> <!-- bootstrap js -->
<script>
  $(document).ready(function() {
    $apicurrentValue = $('#apiUrl').val();
    if($apicurrentValue.includes('encrypt:')){
      //console.log('true');
      $('#encryptlink').hide();
    }else{
      //console.log('false');
      $('#encryptlink').show();
    }
  });
  $('#apiUrl').on('change',function(){
    $apicurrentValue = $('#apiUrl').val();
    if($apicurrentValue.includes('encrypt:')){
      //console.log('true');
      $('#encryptlink').hide();
    }else{
      //console.log('false');
      $('#encryptlink').show();
    }
  });
</script>
@endsection
