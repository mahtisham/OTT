@extends('layouts.admin')
@section('title',__('Edit Genre').''." - $genre->name")
@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text">
      @can('genre.view')
        <a href="{{url('admin/genres')}}" data-toggle="tooltip" data-original-title="{{__('Go Back')}}" class="btn-floating"><i class="material-icons">reply</i></a> 
      @endcan
        {{__('Edit Genre')}}
    </h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          {!! Form::model($genre, ['method' => 'PATCH', 'action' => ['GenreController@update', $genre->id],'files' => true]) !!}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                {!! Form::label('name', __('Name')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Genre Name')}} eg:Drama"></i>
                {!! Form::text('name', old('name'), ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('name') }}</small>
            </div>
             <div class="form-group{{ $errors->has('genre') ? ' has-error' : '' }} input-file-block">
              {!! Form::label('image', __('Genre Image')) !!}
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Upload Genre Image')}}"></i>
              {!! Form::file('image', ['class' => 'input-file', 'id'=>'image']) !!}
              <label for="image" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="genre image">
                <i class="icon fa fa-check"></i>
                <span class="js-fileName">{{isset($genre->image) ? $genre->image :__('Choose A File')}}</span>
              </label>
              <p class="info">{{__('Choose Custom Image')}}</p>
              <small class="text-danger">{{ $errors->first('image') }}</small>
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
