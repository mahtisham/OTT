@extends('layouts.admin')
@section('title',__('All Audio Languages'))
@section('content')
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      @can('audiolanguage.create')
        <a href="{{route('audio_language.create')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i>{{__('Create Audio Language')}}</a>
      @endcan
      <!-- Delete Modal -->
      @can('audiolanguage.delete')
      <a type="button" class="btn btn-danger btn-md z-depth-0" data-toggle="modal" data-target="#bulk_delete"><i class="material-icons left">delete</i> {{__('Delete Selected')}}</a>   
      @endcan
      <!-- Modal -->
      <div id="bulk_delete" class="delete-modal modal fade" role="dialog">
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
              {!! Form::open(['method' => 'POST', 'action' => 'AudioLanguageController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-block box-body genre-card">
      <form class="navbar-form" role="search">
        <div class="input-group ">
         <form method="get" action="">
            <input value="{{ app('request')->input('name') ?? '' }}" type="text" name="search" cllass="form-control float-left text-center" placeholder="{{__('Search Genre')}}">
          </form>
       
        </div>
      </form>
      <div class="row">
        @if($audio_languages != NULL && count($audio_languages) > 0)
          @foreach($audio_languages as $item)
            @php
              if($item->image != NULL){
                $content = @file_get_contents(public_path() .'/images/audiolanguage/' . $item->image); 
                if($content){
                  $image = public_path() .'/images/audiolanguage/' . $item->image;
                }else{
                  $image = Avatar::create($item->language)->toBase64();
                }
              }else{
                $image = Avatar::create($item->language)->toBase64();
              }

              $imageData = base64_encode(@file_get_contents($image));
              if($imageData){
                  $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
              } 
            @endphp
            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-2">
              <input class="form-check-card-input visibility-visible" form="bulk_delete_form" type="checkbox" value="{{$item->id}}" id="checkbox{{$item->id}}" name="checked[]">
              <div class="card">
                @if($src != NULL)
                  <img src="{{$src}}" class="card-img-top" alt="...">
                @endif
                 <div class="overlay-bg"></div>
                <div class="card-body">
                  <h5 class="card-title">{{$item->language}}</h5>
                  <div class="card-icons">
                    <ul>
                      @can('audiolanguage.edit')
                        <li>
                          <a href="{{route('audio_language.edit', $item->id)}}" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                        </li>
                      @endcan
                      @can('audiolanguage.delete')
                        <li>
                         <button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal{{$item->id }}"><i class="material-icons">delete</i> </button>
                          <div id="deleteModal{{$item->id }}" class="delete-modal modal fade" role="dialog">
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
                                  <form method="POST" action="{{route("audio_language.destroy", $item->id)}}">
                                    @method("DELETE")
                                    @csrf
                                      <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                                      <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </li>
                      @endcan
                    </ul>
                  </div>
                </div>
              </div>

            </div>
          @endforeach
          <div class="col-md-12 pagination-block">
           {!! $audio_languages->appends(request()->query())->links() !!}
          </div>
        @else
          <div class="col-md-12 text-center">
            <h5>{{__("Let's start :)")}}</h5>
            <small>{{__('Get Started by creating a genre! All of your genres will be displayed on this page.')}}</small>
          </div>
        @endif
     
      </div>
    </div>
  
  </div>
@endsection
