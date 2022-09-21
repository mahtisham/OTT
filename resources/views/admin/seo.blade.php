@extends('layouts.admin')
@section('title', __('Seo'))

@section('content')
  <div class="admin-form-main-block mrg-t-40">
  <div class="tabsetting">
  <a href="{{url('admin/settings')}}" style="color: #7f8c8d;" ><button class="tablinks">{{__('Genral Setting')}}</button></a>
  <a href="#" style="color: #7f8c8d;" ><button class="tablinks active">{{__('SEO Setting')}}</button></a>
  <a href="{{url('admin/api-settings')}}" style="color: #7f8c8d;"><button class="tablinks">{{__('API Setting')}}</button></a>
  <a href="{{route('mail.getset')}}" style="color: #7f8c8d;"><button class="tablinks">{{__('Mail Settings')}}</button></a>
  
</div>
    <div class="row admin-form-block z-depth-1">
      @if ($seo)
         {!! Form::model($seo, ['method' => 'PATCH', 'action' => ['SeoController@update', $seo->id], 'files' => true]) !!}

          <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
              {!! Form::label('author',__('Author Name')) !!}
              {!! Form::text('author', null, ['placeholder' => __('EnterAuthorName'),'id' => 'textbox', 'class' => 'form-control']) !!}
              <small class="text-danger">{{ $errors->first('author') }}</small>
           </div>
        
          <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
              {!! Form::label('description', __('Metadata Description')) !!}
              {!! Form::textarea('description', null, ['id' => 'textbox', 'class' => 'form-control']) !!}
              <small class="text-danger">{{ $errors->first('description') }}</small>
           </div>
          <div class="form-group{{ $errors->has('keyword') ? ' has-error' : '' }}">
              {!! Form::label('keyword', __('Metadata Keyword')) !!}
              {!! Form::textarea('keyword', null, ['placeholder' => __('Keyword Placeholder'),'id' => 'textbox', 'class' => 'form-control']) !!}
              <small class="text-danger">{{ $errors->first('keyword') }}</small>
          </div>
    
          <div class="form-group{{ $errors->has('google') ? ' has-error' : '' }}">
                  {!! Form::label('google',__('Google Analytics')) !!}
                  {!! Form::text('google', null, ['class' => 'form-control']) !!}
                  <small class="text-danger">{{ $errors->first('google') }}</small>
              </div>
          <div class="form-group{{ $errors->has('fb') ? ' has-error' : '' }}">
              {!! Form::label('fb', __('Facebook Pixcal')) !!}
              {!! Form::text('fb', null, ['id' => 'textbox1', 'class' => 'form-control']) !!}
              <small class="text-danger">{{ $errors->first('fb') }}</small>
          </div>
          <div class="btn-group pull-right">
            <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> {{__('Save')}}</button>
          </div>
          <div class="clear-both"></div>
        {!! Form::close() !!}
      @endif
    </div>
    <br>
    <div class="row admin-form-block z-depth-1">
      <h6 class="form-block-heading apipadding">{{__('Site Map Settings')}}</h6>
      <br>  
      <div class="form-group">
        <div class="col-md-12">
          {!! Form::label('sitemap', __('Generate Sitemap')) !!}
          <br>
          <a href="{{ url('/sitemap') }}" class="btn btn-md btn-default">{{ __('Generate') }}</a>
          @if(@file_get_contents(public_path().'/sitemap.xml'))
            <a href="{{ url('/sitemap/download') }}" class="btn-success btn-floating" data-toggle="tooltip" data-original-title="{{__('download sitemap.xml')}}"><i class="material-icons">download</i>Sitemap.xml</a>
            |
            <a href="{{ url('/sitemap.xml') }}" class="btn-info btn-floating" data-toggle="tooltip" data-original-title="{{__('view sitemap')}}"><i class="material-icons">visibility</i>Sitemap</a>
          @endif
        
        </div>
       
      </div>
    </div>
 </div> 
@endsection

@section('custom-script')
  <script>
    $(function () {
      CKEDITOR.replace('editor1');
    });
  </script>
@endsection