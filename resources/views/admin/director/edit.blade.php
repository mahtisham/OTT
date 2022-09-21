@extends('layouts.admin')
@section('title',__('Edit')." "." - $director->name")
@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text">
      @can('director.view')
        <a href="{{url('admin/directors')}}" data-toggle="tooltip" data-original-title="{{__('Go Back')}}" class="btn-floating"><i class="material-icons">reply</i></a>
      @endcan
      {{__('EditDirector')}}
    </h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          {!! Form::model($director, ['method' => 'PATCH', 'action' => ['DirectorController@update', $director->id], 'files' => true]) !!}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                {!! Form::label('name',__('Name')) !!}
                 <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Director Name')}}"></i>
                {!! Form::text('name', old('name'), ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('name') }}</small>
            </div>
               <div class="form-group{{ $errors->has('biography') ? ' has-error' : '' }}">
                {!! Form::label('biography', __('Biography')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please Enter Director Biography')}} "></i>
                {!! Form::textarea('biography', old('biography'), ['class' => 'form-control','row'=>'3', 'placeholder' => __('Please Enter Director Biography')]) !!}
                <small class="text-danger">{{ $errors->first('biography') }}</small>
            </div>
            <div class="form-group{{ $errors->has('place_of_birth') ? ' has-error' : '' }}">
              {!! Form::label('place_of_birth', __('Place of Birth')) !!}
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please enter place of birth')}} "></i>
              {!! Form::textarea('place_of_birth', old('place_of_birth'), ['class' => 'form-control','row'=>'3', 'placeholder' => __('Please enter place of birth')]) !!}
              <small class="text-danger">{{ $errors->first('place_of_birth') }}</small>
            </div>
            <div class="form-group{{ $errors->has('DOB') ? ' has-error' : '' }}">
              {!! Form::label('DOB', __('Date of Birth')) !!}
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Please enter date of birth')}} "></i>
              {!! Form::date('DOB', old('DOB'), ['class' => 'form-control','placeholder' => __('Please enter date of birth')]) !!}
              <small class="text-danger">{{ $errors->first('DOB') }}</small>
            </div>
            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }} input-file-block">
              {!! Form::label('image', __('Director Image')) !!}
               <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('Upload Director Image')}}"></i>
              {!! Form::file('image', ['class' => 'input-file', 'id'=>'image']) !!}
              <label for="image" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{ __('Director Image')}}">
                <i class="icon fa fa-check"></i>
                <span class="js-fileName">{{isset($director->image) ? $director->image :__('Choose A File')}}</span>
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
