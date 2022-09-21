@extends('layouts.admin')
@section('title',__('Create Package Feature'))
@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text">
      @can('package-feature.view')
      <a href="{{url('admin/package_feature')}}" data-toggle="tooltip" data-original-title="Go back" class="btn-floating"><i class="material-icons">reply</i></a> 
      @endcan
      {{__('Create Package Feature')}}</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          {!! Form::open(['method' => 'POST', 'action' => 'PackageFeatureController@store']) !!}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              {!! Form::label('name',__('Name')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter package feature eg: watch all time"></i>
              {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Please enter package feature ']) !!}
              <small class="text-danger">{{ $errors->first('name') }}</small>
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
