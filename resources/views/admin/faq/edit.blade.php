@extends('layouts.admin', [
  'page_header' => 'Edit Faq'
])
@section('title',__('Edit FAQ'))
@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text">
      @can('faq.view')
        <a href="{{url('admin/faqs')}}" data-toggle="tooltip" data-original-title="{{__('Go Back')}}" class="btn-floating"><i class="material-icons">reply</i></a> {{__('Edit FAQ')}}</h4>
      @endcan
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          {!! Form::model($faq, ['method' => 'PATCH', 'action' => ['FaqController@update', $faq->id]]) !!}
            <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
                {!! Form::label('question', __('Faq Question')) !!}
                <p class="inline info"> - {{__('Please Enter Your Faq Question')}}</p>
                {!! Form::text('question', null, ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('question') }}</small>
            </div>
            <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                {!! Form::label('answer', __('FaqAnswer')) !!}
                <p class="inline info"> - {{__('Please Enter Your Faq Answer')}}</p>
                {!! Form::textarea('answer', null, ['class' => 'form-control materialize-textarea', 'rows' => '5']) !!}
                <small class="text-danger">{{ $errors->first('answer') }}</small>
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
