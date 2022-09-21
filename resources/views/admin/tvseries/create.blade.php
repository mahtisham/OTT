@extends('layouts.admin')
@section('title',__('Create Tv Series'))
@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text">
      @can('tvseries.view')
        <a href="{{url('admin/tvseries')}}" data-toggle="tooltip" data-original-title="{{__('Go Back')}}" class="btn-floating"><i class="material-icons">reply</i></a>
      @endcan
      {{__('Create Tv Series')}}</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          {!! Form::open(['method' => 'POST', 'action' => 'TvSeriesController@store', 'files' => true]) !!}

            <label for="">{{__('Search Tv Series By Title')}} :</label>
          <br>
          <label class="switch">
                     <input type="checkbox" name="tv_by_id" checked="" class="checkbox-switch" id="tv_id">
                    <span class="slider round"></span>

          </label>
            <div id="tv_title" class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                {!! Form::label('title', __('Series Title')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Enter Tvseries Title')}} eg:Arrow"></i>
                {!! Form::text('title', null, ['class' => 'form-control', 'autofocus', 'placeholder'=> __('Enter Tvseries Title')]) !!}
                <small class="text-danger">{{ $errors->first('title') }}</small>
            </div>
             <div id="tvs_id" style="display: none;" class="form-group{{ $errors->has('title2') ? ' has-error' : '' }}">
                {!! Form::label('title',__('Tv Series ID')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter TVID (TMDBID)')}}"></i>
                {!! Form::text('title2', null, ['class' => 'form-control', 'placeholder' => __('Please Enter TVID (TMDBID)')]) !!}
                <small class="text-danger">{{ $errors->first('title2') }}</small>
            </div>
            
             <div class="form-group">
              <label for="">{{__('Meta Keyword')}}: </label>
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Enter Meta Keyword')}}"></i>
             <input name="keyword" type="text" class="form-control" data-role="tagsinput"/>

               
            </div>

            <div class="form-group">
              <label for="">{{__('Meta Description')}}: </label>
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Enter Meta Description')}}"></i>
              <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>

            <div class="form-group{{ $errors->has('is_custom_label') ? ' has-error' : '' }}">
              <div class="row">
                <div class="col-xs-6">
                  {!! Form::label('is_custom_label',__('Allow Custom Label ?')) !!}
                </div>
                <div class="col-xs-5 pad-0">
                  <label class="switch">
                    <input type="checkbox" name="is_custom_label" class="checkbox-switch" id="is_custom_label">
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-xs-12">
                <small class="text-danger">{{ $errors->first('is_custom_label') }}</small>
              </div>
            </div>

            <div id="label_box" style="display:none" class="form-group{{ $errors->has('label_id') ? ' has-error' : '' }}">
              {!! Form::label('label_id', __('Custom Label')) !!}
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('select custom label')}}"></i>
             <select name="label_id" id="" class="select2 form-control">
              @foreach($labels as $label)
               <option value="{{$label->id}}">{{$label->name}}</option>
               @endforeach
             </select>
              <small class="text-danger">{{ $errors->first('label_id') }}</small>
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
                    {!! Form::label('thumbnail', __('Thumbnail')) !!} - <p class="inline info">{{__('Help Block Text')}}</p>
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
                    {!! Form::label('poster', __('Poster')) !!} - <p class="inline info">{{__('Help Block Text')}}</p>
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
            @if($button->kids_mode==1)
            <div class="form-group{{ $errors->has('is_kids') ? ' has-error' : '' }}">
                <div class="row">
                  <div class="col-xs-6">
                    {!! Form::label('is_kids',__('Only for kids?')) !!}
                  </div>
                  <div class="col-xs-5 pad-0">
                  <label class="switch">
                    {!! Form::checkbox('is_kids', 1, 0, ['class' => 'checkbox-switch' ,'id' => 'kids_mode']) !!}
                    <span class="slider round"></span>
                  </label>
                  </div>
                </div>
                <div class="col-xs-12">
                  <small class="text-danger">{{ $errors->first('is_kids') }}</small>
                </div>
              </div>
              @endif

              <div class="form-group{{ $errors->has('maturity_rating') ? ' has-error' : '' }}">
                {!! Form::label('maturity_rating',__('Maturity Rating')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Select Maturity Rating')}}"></i>
                {!! Form::select('maturity_rating', array('all age' =>__('All Age'), '18+' =>'18+', '16+' => '16+', '13+'=>'13+','10+' =>'10+', '8+' => '8+', '5+'=>'5+','2+'=>'2+'), null, ['class' => 'form-control select2']) !!}
                <small class="text-danger">{{ $errors->first('maturity_rating') }}</small>
              </div>

            <div class="menu-block" id="kids_mode_hide">
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
              <small class="text-danger">{{ $errors->first('menu') }}</small>
            </div>

            <!-- country start -->
      <div class="form-group">
        <div class="row">
          <div class="col-md-12">
            <label>{{ __('Country') }}: </label>
            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Select those countries where you want to block courses')}}"></i>
            <select class="form-control select2" name="country[]" multiple="multiple">
              @foreach($countries as $country)
                  <option >{{ $country->name }}</option>
              @endforeach
            </select>
            <small class="text-info"><i class="fa fa-question-circle"></i> ({{ __('Select those countries where you want to block Movies')}} )</small>
          </div>
        </div>
      <div>
      <br>
      <!-- country end -->

      <div class="menu-block  kids_mode_show" style="display: none;">
      </div>
            <div class="switch-field">
              <div class="switch-title">{{__('Want IMDB Ratings And More Or Custom')}}?</div>
              <input type="radio" id="switch_left" class="imdb_btn" name="tmdb" value="Y" checked/>
              <label for="switch_left">{{__('TMDB')}}</label>
              <input type="radio" id="switch_right" class="custom_btn" name="tmdb" value="N" />
              <label for="switch_right">{{__('Custom')}}</label>
            </div>
            <div id="custom_dtl" class="custom-dtl">
              <div class="form-group{{ $errors->has('genre_id') ? ' has-error' : '' }}">
                  {!! Form::label('genre_id', __('Genre')) !!}
                  <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Select Genres')}}"></i>
                  {!! Form::select('genre_id[]', $genre_ls, null, ['class' => 'form-control select2', 'multiple']) !!}
                  <small class="text-danger">{{ $errors->first('genre_id') }}</small>
              </div>
              <div class="form-group{{ $errors->has('rating') ? ' has-error' : '' }}">
                  {!! Form::label('rating', __('Ratings')) !!}
                  <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Rating')}} eg:5.8"></i>
                  {!! Form::text('rating', null, ['class' => 'form-control']) !!}
                  <small class="text-danger">{{ $errors->first('rating') }}</small>
              </div>
              <div class="form-group{{ $errors->has('detail') ? ' has-error' : '' }}">
                  {!! Form::label('detail',__('Description')) !!}
                  <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Tvseries Description')}}"></i>
                  {!! Form::textarea('detail', null, ['class' => 'form-control materialize-textarea', 'rows' => '5']) !!}
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

   <script>
    $('#tv_id').on('change',function(){
      if ($('#tv_id').is(':checked')){
        $('#tv_title').show('fast');
        $('#tvs_id').hide('fast');
      }else{
         $('#tvs_id').show('fast');
        $('#tv_title').hide('fast');
      }
    });

    $('#kids_mode').on('change',function(){
      if ($('#kids_mode').is(':checked')){
        $('#kids_mode_show').show('fast');
        $('#kids_mode_hide').hide('fast');
        $('#is_kids').show('fast');
      $('#is_not_kids').hide('fast');
      }else{
         $('#kids_mode_hide').show('fast');
        $('#kids_mode_show').hide('fast');
        $('#is_not_kids').show('fast');
      $('#is_kids').hide('fast');
      }
    });
    

     $('input[name="is_custom_label"]').click(function(){
      if($(this).prop("checked") == true){
        $('#label_box').show();
      }
      else if($(this).prop("checked") == false){
        $('#label_box').hide();
      }
    });

  </script>
@endsection