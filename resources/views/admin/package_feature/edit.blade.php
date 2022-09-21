@extends('layouts.admin')
@section('title',"Edit: $p_feature->name")
@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text">
      @can('package-feature.view')
      <a href="{{url('admin/package_feature')}}" data-toggle="tooltip" data-original-title="Go back" class="btn-floating"><i class="material-icons">reply</i></a>
      @endcan
      {{__('Edit Package Feature')}}</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
        {!! Form::model($p_feature, ['method' => 'PATCH', 'action' => ['PackageFeatureController@update', $p_feature->id]]) !!}
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {!! Form::label('name',__('Name')) !!}
            <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter package feature name eg:English"></i>
            {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
            <small class="text-danger">{{ $errors->first('name') }}</small>
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
