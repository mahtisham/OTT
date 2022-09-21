@extends('layouts.admin')
@section('title',__('All Multiple Links'))
@section('content')

<div class="modal fade" id="multiplelinkadd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">{{__('Add Multiple Links')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         {!! Form::open(['method' => 'POST', 'action' => ['MovieController@storelink',$id]]) !!}
          <div class="form-group{{ $errors->has('download') ? ' has-error' : '' }} switch-main-block">
            <div class="row">
              <div class="col-xs-5">
                {!! Form::label('download', __('Do Yo uWant To Download Link?')) !!}
              </div>
              <div class="col-xs-5 pad-0">
                <label class="switch">                
                  {!! Form::checkbox('download', 1, 1, ['class' => 'checkbox-switch']) !!}
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
            <div class="col-xs-12">
              <small class="text-danger">{{ $errors->first('download') }}</small>
            </div>
          </div>
          <div class="form-group{{ $errors->has('quality') ? ' has-error' : '' }}">
                {!! Form::label('quality', __('Quality')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Enter Quality')}} eg:HD"></i>
                {!! Form::text('quality', null, ['class' => 'form-control', 'autofocus', 'autocomplete'=>'off','required', 'placeholder'=> __('Enter Quality')]) !!}
                <small class="text-danger">{{ $errors->first('quality') }}</small>
          </div>
           <div class="form-group{{ $errors->has('size') ? ' has-error' : '' }}">
                {!! Form::label('size', __('Size')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Enter Size Of Link')}} eg:10 MB"></i>
                {!! Form::text('size', null, ['class' => 'form-control', 'autofocus', 'autocomplete'=>'off','required', 'placeholder'=> __('Enter Size Of Link')]) !!}
                <small class="text-danger">{{ $errors->first('size') }}</small>
          </div>
           <div class="form-group{{ $errors->has('language') ? ' has-error' : '' }}">
              {!! Form::label('language', __('Languages')) !!}
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Select Language')}}"></i>
              <div class="input-group cd-md-12" style="width:100%">
                
                <select name="language[]" id="" class="select2" multiple="multiple">
                  @foreach($language as $lang)
                      <option value="{{ $lang->id }}">{{ $lang->language }}</option>
                  @endforeach
                </select>
               
              </div>
              <small class="text-danger">{{ $errors->first('language') }}</small>
            </div>
          <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                {!! Form::label('url', __('Url And Links')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{__('Please Enter Your Downlod Link')}}eg:Arrow"></i>
                {!! Form::url('url', null, ['class' => 'form-control', 'autofocus', 'autocomplete'=>'off','required', 'placeholder'=> __('Please Enter Your Downlod Link')]) !!}
                <small class="text-danger">{{ $errors->first('url') }}</small>
          </div>
          
              
            <div class="btn-group pull-right">
              <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> {{__('Reset')}}</button>
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> {{__('Add Links')}} </button>
            </div>
            <div class="clear-both"></div>
          {!! Form::close() !!}
      </div>
    {{--   <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Add Link</button>
      </div> --}}
    </div>
  </div>
</div>

  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <a href="#" class="btn btn-danger btn-md" data-toggle="modal" data-target="#multiplelinkadd"><i class="material-icons left">add</i> {{__('Create Multiple Links')}}</a>
    </div>
    <div class="content-block box-body table-responsive content-block-two">
      <table id="audio_languageTable" class="table table-hover">
        <thead>
          <tr class="table-heading-row">
          <th>
            <div class="inline">
              <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
              <label for="checkboxAll" class="material-checkbox"></label>
            </div>
            
          </th>
          <th>{{__('Movie')}}</th>
          <th>{{__('Url And Links')}}</th>
          <th>{{__('Quality')}}</th>
          <th>{{__('Size')}}</th>
          <th>{{__('Language')}}</th>
          <th>{{__('Visits')}}</th>
          <th>{{__('Downlodable')}}</th>
          <th>{{__('User')}}</th>
          <th>{{__('Added')}}</th>
          <th>{{__('Actions')}}</th>

        </tr>
        </thead>
       @if(isset($links))
          <tbody>
            @foreach($links as $key=> $link)
            @php
             
              $lang = App\AudioLanguage::where('id',$link->language)->first();
            @endphp
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$link->movie['title']}}</td>
              <td>{{$link->url}}</td>
              <td>{{$link->quality}}</td>
              <td>{{$link->size}}</td>
            <td>@if(isset($lang)){{$lang->language}} @else - @endif</td>
              <td>{{$link->clicks}}</td>
              <td>{{ $link->download == 1 ? "YES" : "NO" }}</td>
              <td>{{$link->movie->user->name}}</td>
              <td>{{$link->created_at}}</td>
              <td>  <a data-original-title="Edit" class="btn-info btn-floating" data-toggle="modal" data-target="#multiplelinkedit"><i class="material-icons">mode_edit</i></a>
                <button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal{{$link->id}}"><i class="material-icons">delete</i> </button>
              </td>

              <div id="deleteModal{{$link->id}}"  class="delete-modal modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
                <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <div class="delete-icon"></div>
                    </div>
                    <div class="modal-body text-center">
                      <h4 class="modal-heading">{{__('AreYouSure')}}</h4>
                      <p>{{__('DeleteWarrnig')}}</p>
                      </div>
                      <div class="modal-footer">
                      <form method="POST" action={{route("movies.deletelink", $link->id) }}>
                        {{csrf_field()}}
                        {{ method_field('DELETE') }}
                      <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                      <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                      </form>
                      </div>
                    </div>
                  </div>
              </div>

            </tr>
            @endforeach
          </tbody>
        @endif
      </table>
    </div>
  </div>
 @foreach($links as $key=> $link)

<div class="modal fade" id="multiplelinkedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">{{__('Edit Multiple Links')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         {!! Form::model($link,['method' => 'PATCH', 'action' => ['MovieController@editlink',$link->id]]) !!}
          <div class="form-group{{ $errors->has('download') ? ' has-error' : '' }} switch-main-block">
            <div class="row">
              <div class="col-xs-4">
                {!! Form::label('download', __('Do You Want To Download Link')) !!}
              </div>
              <div class="col-xs-5 pad-0">
                <label class="switch">                
                  {!! Form::checkbox('download', 0,1, ['class' => 'checkbox-switch']) !!}
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
            <div class="col-xs-12">
              <small class="text-danger">{{ $errors->first('download') }}</small>
            </div>
          </div>
          <div class="form-group{{ $errors->has('quality') ? ' has-error' : '' }}">
                {!! Form::label('quality',__('Quality')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('EnterQuality')}}  eg:HD"></i>
                {!! Form::text('quality',null, ['class' => 'form-control', 'autofocus', 'autocomplete'=>'off','required', 'placeholder'=> __('Enter Quality')]) !!}
                <small class="text-danger">{{ $errors->first('quality') }}</small>
          </div>
           <div class="form-group{{ $errors->has('size') ? ' has-error' : '' }}">
                {!! Form::label('size', __('Size')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Enter Size Of Link ')}}eg:10 MB"></i>
                {!! Form::text('size', null,['class' => 'form-control', 'autofocus', 'autocomplete'=>'off','required', 'placeholder'=> __('Enter Size Of Link ')]) !!}
                <small class="text-danger">{{ $errors->first('size') }}</small>
          </div>
          <div class="form-group{{ $errors->has('language') ? ' has-error' : '' }}">
              {!! Form::label('language', __('Languages')) !!}
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Select Language')}}"></i>
              <div class="input-group cd-md-12" style="width:100%">
                
                <select name="language[]" id="" class="select2" multiple="multiple">
                  @foreach($language as $lang)
                  
                      <option @if(!empty($link->language)) @foreach($link->language as $a) {{ $a == $lang->id ? "selected" : "" }} @endforeach @endif value="{{ $lang->id }}">{{ $lang->language }}</option>
                  @endforeach
                </select>
               
              </div>
              <small class="text-danger">{{ $errors->first('language') }}</small>
            </div>
          <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                {!! Form::label('url', __('UrlAndLinks')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Enter Download Link')}} eg:Arrow"></i>
                {!! Form::url('url',null, ['class' => 'form-control', 'autofocus', 'autocomplete'=>'off','required']) !!}
                <small class="text-danger">{{ $errors->first('url') }}</small>
          </div>
          
              
            <div class="btn-group pull-right">
              <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> {{__('Reset')}}</button>
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i>{{__('Update')}}</button>
            </div>
            <div class="clear-both"></div>
          {!! Form::close() !!}
      </div>
      
    </div>
  </div>
</div>
@endforeach
@endsection
@section('custom-script')

@endsection