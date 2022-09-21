@extends('layouts.admin')
@section('title',__('Manage Season'))
@section('content')
<div class="admin-form-main-block mrg-t-40">
  <h4 class="admin-form-text">
    @can('tvseries.view')
    <a href="{{url('admin/tvseries')}}" data-toggle="tooltip" data-original-title="{{__('Go Back')}}" class="btn-floating"><i class="material-icons">reply</i></a> 
    @endcan
    {{__('Manage Seasons')}} <span>{{__('Of')}} {{$tv_series->title}}
    @if ($tv_series->tmdb == 'Y')
      <span class="min-info">{!!$tv_series->tmdb == 'Y' ? '<i class="material-icons">check_circle</i> by tmdb' : ''!!}</span>
    @endif
  </span></h4>
  <div class="admin-create-btn-block">
    <a id="createButton" onclick="showCreateForm()" class="btn btn-danger btn-md"><i class="material-icons left">add</i> {{__('Create Season')}}</a>
    <a data-toggle="modal" data-target="#importseasons" role="button" class="btn btn-danger btn-md"><i class="material-icons left">description</i> {{__('Import Seasons')}}</a>
  </div>

  <div class="modal fade" id="importseasons" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="exampleStandardModalLabel">{{__("Bulk Import Seasons")}}</h5>
          
        </div>
        <div class="modal-body">
          <!-- main content start -->
          <a href="{{ url('files/Seasons.xlsx') }}" class="btn btn-md btn-success pull-right"> {{__('Download Example xls/csv
            File')}}</a>
          <form action="{{ url('/admin/import/seasons') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
              <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }} input-file-block col-md-12">
                {!! Form::label('file', __('Choose your xls/csv File :')) !!}
                {!! Form::file('file', ['class' => 'input-file', 'id'=>'file']) !!}
                <label for="file" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('Choose your xls/csv File')}}">
                  <i class="icon fa fa-check"></i>
                  <span class="js-fileName">{{__('Choose A File')}}</span>
                </label>
                <small class="text-danger">{{ $errors->first('file') }}</small>

                <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-file-excel-o"></i> {{__('Import')}}</button>
              </div>

            </div>

          </form>

          <div class="box box-danger">
            <div class="box-header">
              <div class="box-title">{{__('Instructions')}}</div>
            </div>
            <div class="box-body table-responsive ">
            
              <h6><b>{{__('Follow the instructions carefully before importing the file.')}}</b></h6>
              <small>{{__('The columns of the file should be in the following order.')}}</small>
              
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>{{__('Column No')}}</th>
                    <th>{{__('Column Name')}}</th>
                    <th>{{__('Required')}}</th>
                    <th>{{__('Description')}}</th>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                    <td>1</td>
                    <td><b>{{__('tvseries_id')}}</b></td>
                    <td><b>{{__('Yes')}}</b></td>
                    <td>{{__('Enter tvseries id')}} <b>{{__('i.e')}}</b> {{$tv_series->id}} </td>
                  </tr>

                  <tr>
                    <td>2</td>
                    <td><b>{{__('season_no')}}</b></td>
                    <td><b>{{__('Yes')}}</b></td>
                    <td>{{__('Enter season number')}}</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td> <b>{{__('thumbnail')}}</b> </td>
                    <td><b>{{__('No')}}</b></td>
                    <td>{{__('Name your image eg: example.jpg')}} <b>{{__('(Image can be uploaded using Media Manager / Seasons / thumbnail Tab.)')}}</b></td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td> <b>{{__('poster')}}</b> </td>
                    <td><b>{{__('No')}}</b></td>
                    <td>{{__('Name your image eg: example.jpg')}} <b>{{__('(Image can be uploaded using Media Manager / Seasons / poster Tab.)')}}</b></td>
                  </tr>

                  <tr>
                    <td>5</td>
                    <td> <b>{{__('a_language')}}</b> </td>
                    <td><b>{{__('No')}}</b></td>
                    <td>{{__("Multiple a_language id can be pass here seprate by comma")}}</b></td>
                  </tr>
                  
                 
                  <tr>
                    <td>6</td>
                    <td> <b>{{__('featured')}}</b> </td>
                    <td><b>{{__('No')}}</b></td>
                    <td>{{__("seasons featured (1 = enabled, 0 = disabled)")}}</b></td>
                  </tr>
              
                  <tr>
                    <td>7</td>
                    <td> <b>{{__('is_protect')}}</b> </td>
                    <td><b>{{__('No')}}</b></td>
                    <td>{{__("seasons protected video (1 = enabled, 0 = disabled)")}}</td>
                  </tr>
                  <tr>
                    <td>8</td>
                    <td> <b>{{__('password')}}</b> </td>
                    <td><b>{{__('No')}}</b></td>
                    <td>{{__("If is_protect = 1, then the enter password here ")}}</td>
                  </tr>
                  <tr>
                    <td>9</td>
                    <td> <b>{{__('actor_id')}}</b> </td>
                    <td><b>{{__('No')}}</b></td>
                    <td>{{__("Multiple actor id can be pass here seprate by comma .")}}</td>
                  </tr>
                  
                  
                  <tr>
                    <td>10</td>
                    <td> <b>{{__('publish_year')}}</b> </td>
                    <td><b>{{__('No')}}</b></td>
                    <td>{{__("Enter seasons publish year")}}</td>
                  </tr>
                 
                  <tr>
                    <td>11</td>
                    <td> <b>{{__('detail')}}</b> </td>
                    <td><b>{{__('No')}}</b></td>
                    <td>{{__("Enter seasons detail")}}</td>
                  </tr>
                  <tr>
                    <td>12</td>
                    <td> <b>{{__('trailer_url')}}</b> </td>
                    <td><b>{{__('No')}}</b></td>
                    <td>{{__("Enter seasons trailer_url")}}</td>
                  </tr>

                </tbody>
              </table>
              
              
            </div>
            
          </div>
          <!-- main content end -->
        </div>

      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="admin-form-block z-depth-1">
        <div id="createForm">
          {!! Form::open(['method' => 'POST', 'action' => 'TvSeriesController@store_seasons', 'files' => true]) !!}
            <div class="form-group{{ $errors->has('season_no') ? ' has-error' : '' }}">
              <input type="hidden" name="tvseries" value="{{$tv_series->title}}">
              {!! Form::label('season_no', __('Season No.')) !!}
              {!! Form::number('season_no', null, ['class' => 'form-control', 'min' => '0']) !!}
              <small class="text-danger">{{ $errors->first('season_no') }}</small>
            </div>
            <div class="form-group{{ $errors->has('season_slug') ? ' has-error' : '' }}">
              {!! Form::label('season_slug',__('Season Slug')) !!}
              {!! Form::text('season_slug', null, ['class' => 'form-control', 'min' => '0']) !!}
              <small class="text-danger">{{ $errors->first('season_slug') }}</small>
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
            <div class="upload-image-main-block">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group{{ $errors->has('thumbnail') ? ' has-error' : '' }} input-file-block">
                    {!! Form::label('thumbnail', __('Thumbnail')) !!} - <p class="inline info">{{__('HelpBlockText')}}</p>
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
                    {!! Form::label('poster',__('Poster')) !!} - <p class="inline info">{{__('Help Block Text')}}</p>
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
              {!! Form::password('password', null, ['class' => 'form-control','id'=>'password']) !!}
              <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
             
            </div>
             <small class="text-danger">{{ $errors->first('password') }}</small>
          
            {{ Form::hidden('tv_series_id', $id) }}
            <div class="switch-field">
              <div class="switch-title">{{__('Want IMDB Ratings And More Or Custom')}}?</div>
              <input type="radio" id="switch_left" class="imdb_btn" name="tmdb" value="Y" checked/>
              <label for="switch_left">{{__('TMDB')}}</label>
              <input type="radio" id="switch_right" class="custom_btn" name="tmdb" value="N" />
              <label for="switch_right">{{__('Custom')}}</label>
            </div>
            <div id="custom_dtl" class="custom-dtl">
              <div class="form-group{{ $errors->has('actor_id') ? ' has-error' : '' }}">
                  {!! Form::label('actor_id', __('Actors')) !!}
                  <p class="inline info"> - {{__('Please Select Tvseries Seasons Actor')}}</p>
                  {!! Form::select('actor_id[]', $actor_ls, null, ['class' => 'form-control select2', 'multiple']) !!}
                  <small class="text-danger">{{ $errors->first('actor_id') }}</small>
              </div>
              <div class="form-group{{ $errors->has('publish_year') ? ' has-error' : '' }}">
                {!! Form::label('publish_year', __('Publish Year')) !!}
                {!! Form::number('publish_year', null, ['class' => 'form-control', 'min' => '0']) !!}
                <small class="text-danger">{{ $errors->first('publish_year') }}</small>
              </div>
              <div class="form-group{{ $errors->has('trailer_url') ? ' has-error' : '' }}">
                {!! Form::label('trailer_url',__('Trailer URL')) !!}
                {!! Form::text('trailer_url', null, ['class' => 'form-control','placeholder'=>__('Please Enter Trailer Url')]) !!}
                <small class="text-danger">{{ $errors->first('trailer_url') }}</small>
              </div>
              <div class="form-group{{ $errors->has('detail') ? ' has-error' : '' }}">
                {!! Form::label('detail', __('Description')) !!}
                {!! Form::text('detail', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('detail') }}</small>
              </div>
            </div>
            <div class="btn-group pull-right">
              <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> {{__('Reset')}}</button>
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> {{__('Create')}}</button>
            </div>
            <div class="clear-both"></div>
          {!! Form::close() !!}
        </div>
        @if(isset($seasons))
          @foreach($seasons as $key => $season)
            @php
                $all_languages = App\AudioLanguage::all();
                // get old audio language values
                $old_lans = collect();
                $a_lans = collect();
                if ($season->a_language != null){
                  $old_list = explode(',', $season->a_language);
                  for ($i = 0; $i < count($old_list); $i++) {
                    $old1 = App\AudioLanguage::find($old_list[$i]);
                    if ( isset($old1) ) {
                      $old_lans->push($old1);
                    }
                  }
                }
                $a_lans = $all_languages->diff($old_lans);
               

            @endphp
            <div id="editForm{{$season->id}}" class="edit-form">
              {!! Form::model($season, ['method' => 'PATCH', 'files' => true, 'action' => ['TvSeriesController@update_seasons', $season->id]]) !!}
               <input type="hidden" name="tvseries" value="{{$tv_series->title}}">
                <div class="form-group{{ $errors->has('season_no') ? ' has-error' : '' }}">
                  {!! Form::label('season_no', __('Season No.')) !!}
                  {!! Form::number('season_no', null, ['class' => 'form-control', 'min' => '0']) !!}
                  <small class="text-danger">{{ $errors->first('season_no') }}</small>
                </div>
                <div class="form-group{{ $errors->has('season_slug') ? ' has-error' : '' }}">
                  {!! Form::label('season_slug',__('Season Slug')) !!}
                  {!! Form::text('season_slug', null, ['class' => 'form-control', 'min' => '0']) !!}
                  <small class="text-danger">{{ $errors->first('season_slug') }}</small>
                </div>
                {{ Form::hidden('tv_series_id', $id) }}
                <div class="form-group{{ $errors->has('a_language') ? ' has-error' : '' }}">
                  {!! Form::label('a_language', __('Audio Languages')) !!}
                  <div class="input-group">
                    <select name="a_language[]" id="a_language" class="form-control select2" multiple="multiple">
                      @if(isset($old_lans) && count($old_lans) > 0)
                        @foreach($old_lans as $old)
                          <option value="{{$old->id}}" selected="selected">{{$old->language}}</option>
                        @endforeach
                      @endif
                      @if(isset($a_lans))
                        @foreach($a_lans as $rest)
                          <option value="{{$rest->id}}">{{$rest->language}}</option>
                        @endforeach
                      @endif
                    </select>
                    <a href="#" data-toggle="modal" data-target="#AddLangModal" class="input-group-addon"><i class="material-icons left">add</i></a>
                  </div>
                  <small class="text-danger">{{ $errors->first('a_language') }}</small>
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
                <div class="upload-image-main-block">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group{{ $errors->has('thumbnail') ? ' has-error' : '' }} input-file-block">
                        {!! Form::label('thumbnail',__('Thumbnail')) !!} - <p class="inline info">{{__('Help Block Text')}}</p>
                        {!! Form::file('thumbnail', ['class' => 'input-file', 'id'=>'thumbnail'.$season->id]) !!}
                        <label for="thumbnail{{$season->id}}" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{isset($season->thumbnail) ? $season->thumbnail :__('Thumbnail')}}">
                          <i class="icon fa fa-check"></i>
                          <span class="js-fileName">{{isset($season->thumbnail) ? $season->thumbnail :__('Choose A File')}}</span>
                        </label>
                        <p class="info">{{__('Choose Custom Thumbnail')}}</p>
                        <small class="text-danger">{{ $errors->first('thumbnail') }}</small>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group{{ $errors->has('poster') ? ' has-error' : '' }} input-file-block">
                        {!! Form::label('poster', __('Poster')) !!} - <p class="inline info">{{__('Help Block Text')}}</p>
                        {!! Form::file('poster', ['class' => 'input-file', 'id'=>'poster'.$season->id]) !!}
                        <label for="poster{{$season->id}}" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{isset($season->poster) ? $season->poster :__('Poster')}}">
                          <i class="icon fa fa-check"></i>
                          <span class="js-fileName">{{isset($season->poster) ? $season->poster :__('Choose A File')}}</span>
                        </label>
                        <p class="info">{{__('Choose Custom Poster')}}</p>
                        <small class="text-danger">{{ $errors->first('poster') }}</small>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="form-group{{ $errors->has('is_protect') ? ' has-error' : '' }}">
                  <div class="row">
                    <div class="col-xs-6">
                      {!! Form::label('is_protect', __('Protected Video?')) !!}
                    </div>
                    <div class="col-xs-5 pad-0">
                      <label class="switch">
                        <input type="checkbox" name="is_protect" {{ $season->is_protect == 1 ? 'checked' : '' }} class="checkbox-switch" id="is_protect">
                        <span class="slider round"></span>
                      </label>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <small class="text-danger">{{ $errors->first('is_protect') }}</small>
                  </div>
                </div>
                <div class="search form-group{{ $errors->has('password') ? ' has-error' : '' }} is_protect" style="{{ $season->is_protect == 1 ? '' : 'display:none' }}">
                  {!! Form::label('password', __('Protected Password For Video')) !!}
                  <input type="password" id="passwordedit" name="password"  class="form-control">
                  <span toggle="#passwordedit" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                  
                </div>
                <small class="text-danger">{{ $errors->first('password') }}</small>

                <div class="switch-field">
                  <div class="switch-title">{{__('Want IMDB Ratings And More Or Custom')}}?</div>
                  <input type="radio" id="switch_left{{$season->id}}" class="imdb_btn" name="tmdb" value="Y" {{$season->tmdb == 'Y' ? 'checked' : ''}}/>
                  <label for="switch_left{{$season->id}}" onclick="hide_custom({{$season->id}})">{{__('TMDB')}}</label>
                  <input type="radio" id="switch_right{{$season->id}}" class="custom_btn" name="tmdb" value="N" {{$season->tmdb != 'Y' ? 'checked' : ''}}/>
                  <label for="switch_right{{$season->id}}" onclick="show_custom({{$season->id}})">{{__('Custom')}}</label>
                </div>
                <div id="custom_dtl{{$season->id}}" class="custom-dtl">
                  @php
                    // get old actor list
                    $actor_ls = App\Actor::all();
                    $old_actor = collect();
                    if ($season->actor_id != null){
                      $old_list = explode(',', $season->actor_id);
                      for ($i = 0; $i < count($old_list); $i++) {
                        $old3 = App\Actor::find(trim($old_list[$i]));
                        if ( isset($old3) ) {
                          $old_actor->push($old3);
                        }
                      }
                    }
                    $old_actor = $old_actor->filter(function($value, $key) {
                      return  $value != null;
                    });
                    $actor_ls = $actor_ls->diff($old_actor);

                  @endphp

                  <div class="form-group{{ $errors->has('actor_id') ? ' has-error' : '' }}">
    									{!! Form::label('actor_id', __('Actors')) !!}
                      <p class="inline info"> - {{__('Please Select Tvseries Seasons Actor')}}</p>
                      <div class="input-group">
                        <select name="actor_id[]" id="actor_id" class="form-control select2" multiple="multiple">
                          @if(isset($old_actor) && count($old_actor) > 0)
                            @foreach($old_actor as $old)
                              <option value="{{$old->id}}" selected="selected">{{$old->name}}</option>
                            @endforeach
                          @endif
                          @if(isset($actor_ls))
                            @foreach($actor_ls as $rest)
                              <option value="{{$rest->id}}">{{$rest->name}}</option>
                            @endforeach
                          @endif
                        </select>
                        <a href="#" data-toggle="modal" data-target="#AddActorModal" class="input-group-addon"><i class="material-icons left">add</i></a>
                      </div>
    									<small class="text-danger">{{ $errors->first('actor_id') }}</small>
    							</div>


                  <div class="form-group{{ $errors->has('publish_year') ? ' has-error' : '' }}">
                    {!! Form::label('publish_year', __('Publish Year')) !!}
                    {!! Form::number('publish_year', null, ['class' => 'form-control', 'min' => '0']) !!}
                    <small class="text-danger">{{ $errors->first('publish_year') }}</small>
                  </div>
                  <div class="form-group{{ $errors->has('trailer_url') ? ' has-error' : '' }}">
                    {!! Form::label('trailer_url',__('Traile rURL')) !!}
                    {!! Form::text('trailer_url', null, ['class' => 'form-control','placeholder'=>__('Please Enter Trailer Url')]) !!}
                    <small class="text-danger">{{ $errors->first('trailer_url') }}</small>
                  </div>
                  <div class="form-group{{ $errors->has('detail') ? ' has-error' : '' }}">
                    {!! Form::label('detail',__('Description')) !!}
                    {!! Form::text('detail', null, ['class' => 'form-control']) !!}
                    <small class="text-danger">{{ $errors->first('detail') }}</small>
                  </div>
                </div>
                <div class="btn-group pull-right">
                  <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i>{{__('Update Season')}}</button>
                </div>
                <div class="clear-both"></div>
              {!! Form::close() !!}
            </div>
          @endforeach
        @endif
      </div>
    </div>
    <div class="col-md-6">
      <div class="admin-form-block content-block z-depth-1">
        <table class="table table-hover">
          <thead>
          <tr class="table-heading-row side-table">
            <th>#</th>
            <th>{{__('Thumbnail')}}</th>
            <th>{{__('Season')}}</th>
            <th>{{__('Episodes')}}</th>
            <th>{{__('ByTMDB')}}</th>
            <th>{{__('Actions')}}</th>
          </tr>
          </thead>
          @if ($seasons)
            <tbody>
            @foreach ($seasons as $key => $season)
              <tr>
                <td>{{$key+1}}</td>
                <td>
                  @if ($season->thumbnail != null)
                    <img src="{{ asset('images/tvseries/thumbnails/'.$season->thumbnail) }}" width="45px" class="img-responsive" alt="image">
                   
                  @endif
                </td>
                <td>
                  Season {{$season->season_no}}
                </td>
                <td>
                  @if (isset($season->episodes) && count($season->episodes) > 0)
                    {{count($season->episodes)}} episodes
                  @else
                    N/A
                  @endif
                </td>
                <td>{!!$season->tmdb == 'Y' ? '<i class="material-icons done">done</i>' : '-'!!}</td>
                <td>
                  <div class="admin-table-action-block side-table-action">
                    @can('tvseries.edit')
                      <a id="editButton{{$season->id}}" onclick="showForms({{$season->id}})" data-toggle="tooltip" data-original-title="{{__('Edit')}}" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                    @endcan
                    @can('tvseries.view')
                    <a href="{{route('show_episodes', $season->id)}}" data-toggle="tooltip" data-original-title="{{__('Manage Episodes')}}" class="btn-success btn-floating"><i class="material-icons">settings</i></a>
                    @endcan
                    @can('tvseries.delete')
                      <button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#{{$season->id}}deleteModal"><i class="material-icons">delete</i> </button>
                    @endcan
                  </div>
                </td>
              </tr>
              <!-- Delete Modal -->
              <div id="{{$season->id}}deleteModal" class="delete-modal modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <div class="delete-icon"></div>
                    </div>
                    <div class="modal-body text-center">
                      <h4 class="modal-heading">{{__('Are You Sure')}}</h4>
                      <p>{{__('Delete Warrning')}}</p>
                    </div>
                    <div class="modal-footer">
                      {!! Form::open(['method' => 'DELETE', 'action' => ['TvSeriesController@destroy_seasons', $season->id]]) !!}
                      {!! Form::reset(__('No'), ['class' => 'btn btn-gray', 'data-dismiss' => 'modal']) !!}
                      {!! Form::submit(__('Yes'), ['class' => 'btn btn-danger']) !!}
                      {!! Form::close() !!}
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
            </tbody>
          @endif
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Add Actor Modal -->
<div id="AddActorModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">{{__('Add Actor')}}</h5>
      </div>
      {!! Form::open(['method' => 'POST', 'action' => 'ActorController@store', 'files' => true]) !!}
        <div class="modal-body admin-form-block">
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              {!! Form::label('name',__('Name')) !!}
              {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
              <small class="text-danger">{{ $errors->first('name') }}</small>
          </div>
          <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }} input-file-block">
            {!! Form::label('image', __('Image')) !!} - <p class="inline info">{{__('Help Block Text')}}</p>
            {!! Form::file('image', ['class' => 'input-file', 'id'=>'image']) !!}
            <label for="image" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('Image')}}">
              <i class="icon fa fa-check"></i>
              <span class="js-fileName">{{__('Choose A File')}}</span>
            </label>
            <p class="info">{{__('Choose Custom Image')}}</p>
            <small class="text-danger">{{ $errors->first('image') }}</small>
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

<!-- Add Language Modal -->
<div id="AddLangModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">{{__('AddLanguage')}}</h5>
      </div>
      {!! Form::open(['method' => 'POST', 'action' => 'AudioLanguageController@store']) !!}
      <div class="modal-body">
        <div class="form-group{{ $errors->has('language') ? ' has-error' : '' }}">
          {!! Form::label('language',__('Language')) !!}
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
@endsection

@section('custom-script')
  <script>
    $(document).ready(function(){
      $('#createForm').siblings().hide();
      $('.custom-dtl').hide();
      $('.upload-image-main-block').hide();
      $('.subtitle_list').hide();
      $('input[name="subtitle"]').click(function(){
        if($(this).prop("checked") == true){
          $('.subtitle_list').fadeIn();
        }
        else if($(this).prop("checked") == false){
          $('.subtitle_list').fadeOut();
        }
      });
    });

    $('input[name="is_protect"]').click(function(){
      if($(this).prop("checked") == true){
        $('.is_protect').fadeIn();
      }
      else if($(this).prop("checked") == false){
        $('.is_protect').fadeOut();
      }
    }); 

    $('.for-custom-image input').click(function(){
      if($(this).prop("checked") == true){
        $('.upload-image-main-block').fadeIn();
      }
      else if($(this).prop("checked") == false){
        $('.upload-image-main-block').fadeOut();
      }
    });
    let showCreateForm = () => {
      $('#createForm').show().siblings().hide();
    };
    let showForms = (id) => {
      let editForm = '#editForm' + id;
      $(editForm).show().siblings().hide();
      var custom_dtl = '#custom_dtl'+id;
      var custom_check = '#switch_right'+id;
      if ($(custom_check).is(':checked')) {
        $(custom_dtl).show();
      }
    };
    let hide_custom = (id) => {
      var custom_dtl = '#custom_dtl'+id;
      $(custom_dtl).hide();
    };
    let show_custom = (id) => {
      var custom_dtl = '#custom_dtl'+id;
      $(custom_dtl).show();
    };
  </script>
  
<script>
     $(document).ready(function() {
  var SITEURL = '{{URL::to('')}}';

 
        $.ajax({
            type: "GET",
            url: SITEURL + "/admin/tvshow/upload_video/converting",
            success: function (data) {
           console.log('Success:',data);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

    
     });
</script>
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
@endsection
