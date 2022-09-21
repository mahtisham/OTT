@extends('layouts.admin')
@section('title',__('Edit Fake View'))
@section('content')
  <div class="admin-form-main-block mrg-t-40">
     <h4 class="admin-form-text">
      @can('fake.views')
        <a href="{{url('admin/fakeViews')}}" data-toggle="tooltip" data-original-title="{{__('Go Back')}}" class="btn-floating"><i class="material-icons">reply</i></a> 
      @endcan
      {{__('Edit Post')}}</h4> 
    {!! Form::model($season, ['method' => 'PATCH', 'action' => ['FakeSeasonViewController@update', $season->id], 'files' => true]) !!}
    <div class="row">
      <div class="col-md-10">
          <div class="row admin-form-block z-depth-1">
        <div class="col-md-2">
          <div>
              {!! Form::label('views', __('Add Fake View')) !!}
              {!! Form::number('views', old('views'), ['class' => 'form-control','autocomplete'=>'off','required']) !!}
          </div> 

          <div class="btn-group pull-right">
              <button type="submit" class="btn btn-success">{{__('Update')}}</button>
          </div>
          <div class="clear-both"></div>
        </div>  
    
    {!! Form::close() !!}
  </div>
        </div>
    </div>
  </div>
@endsection

@section('custom-script')

 
@endsection