@extends('layouts.admin')
@section('title',__('All Live Events'))
@section('content')
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      @can('liveevent.create')
      <a data-toggle="modal" data-target="#importliveevent" role="button" class="btn btn-danger btn-md"><i class="material-icons left">description</i> {{__('Import Live Events')}}</a>
        <a href="{{route('liveevent.create')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i> {{__('Create Live Event')}}</a>
      @endcan
      <!-- Delete Modal -->
      @can('liveevent.delete')
        <a type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#bulk_delete"><i class="material-icons left">delete</i> {{__('Delete Selected')}}</a>   
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
              {!! Form::open(['method' => 'POST', 'action' => 'LiveEventController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="importliveevent" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h5 class="modal-title" id="exampleStandardModalLabel">{{__("Bulk Import LiveEvents")}}</h5>
              
            </div>
            <div class="modal-body">
              <!-- main content start -->
              <a href="{{ url('files/Liveevents.xlsx') }}" class="btn btn-md btn-success pull-right"> {{__('Download Example xls/csv
                File')}}</a>
              <form action="{{ url('/admin/import/live-event') }}" method="POST" enctype="multipart/form-data">
                @csrf
  
                <div class="row">
                  <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }} input-file-block col-md-12">
                    {!! Form::label('file', __('Choose your xls/csv File :')) !!}
                    {!! Form::file('file', ['class' => 'input-file', 'id'=>'file']) !!}
                    <label for="file" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('Choose your xls/csv File')}}">
                      <i class="icon fa fa-check"></i>
                      <span class="js-fileName">{{__('ChooseAFile')}}</span>
                    </label>
                    <small class="text-danger">{{ $errors->first('file') }}</small>
  
                    <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-file-excel-o"></i> {{__('Import')}}</button>
                  </div>
  
                </div>
  
              </form>
  
              <div class="box box-danger">
                <div class="box-header">
                  <div class="box-title">{{__('Instructions')}}</div>
                </div>
                <div class="box-body table-responsive ">
                
                  <h6><b>{{__('Follow the instructions carefully before importing the file.')}}</b></h6>
                  <small>{{__('The columns of the file should be in the following order.')}}</small>
                  
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>{{__('Column No')}}</th>
                        <th>{{__('Column Name')}}</th>
                        <th>{{__('Required')}}</th>
                        <th>{{__('Description')}}</th>
                      </tr>
                    </thead>
  
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td><b>{{__('title')}}</b></td>
                        <td><b>{{__('Yes')}}</b></td>
                        <td>{{__('Enter live event title / name')}}</td>
                      </tr>
                     
                      <tr>
                        <td>3</td>
                        <td> <b>{{__('description')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("Enter live event meta description")}}</td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td> <b>{{__('thumbnail')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__('Name your image eg: example.jpg')}} <b>{{__('(Image can be uploaded using Media Manager / live event / thumbnail Tab.)')}}</b></td>
                      </tr>
                      <tr>
                        <td>5</td>
                        <td> <b>{{__('poster')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__('Name your image eg: example.jpg')}} <b>{{__('(Image can be uploaded using Media Manager / live event / poster Tab.)')}}</b></td>
                      </tr>
                      
                      <tr>
                        <td>11</td>
                        <td> <b>{{__('menu')}}</b> </td>
                        <td><b>{{__('Yes')}}</b></td>
                        <td>{{__("Multiple menu id can be pass here seprate by comma .")}}</td>
                      </tr>
                      <tr>
                        <td>11</td>
                        <td> <b>{{__('start_time')}}</b> </td>
                        <td><b>{{__('Yes')}}</b></td>
                        <td>{{__("enter the event start time here .")}}</td>
                      </tr>
                      <tr>
                        <td>11</td>
                        <td> <b>{{__('end_time')}}</b> </td>
                        <td><b>{{__('Yes')}}</b></td>
                        <td>{{__("enter the event end time here .")}}</td>
                      </tr>
                      <tr>
                        <td>11</td>
                        <td> <b>{{__('organized_by')}}</b> </td>
                        <td><b>{{__('Yes')}}</b></td>
                        <td>{{__("enter a organization name .")}}</td>
                      </tr>

                     
                    </tbody>
                  </table>
                  
                  
                </div>
                
              </div>
              <!-- main content end -->
            </div>
  
          </div>
        </div>
      </div>
    </div>
    <div class="content-block box-body">
      <form class="navbar-form" role="search">
        <div class="input-group ">
         <form method="get" action="">
            <input value="{{ app('request')->input('name') ?? '' }}" type="text" name="search" cllass="form-control float-left text-center" placeholder="{{__('Search LiveEvent')}}">
          </form>
       
        </div>
      </form>
      <div class="row">
        @if(isset($liveevent) && count($liveevent) > 0)
          @foreach($liveevent as $item)
            @php
              if($item->thumbnail != NULL){
                $content = @file_get_contents(public_path() .'/images/event/thumbnails/' . $item->thumbnail); 
                if($content){
                  $image = public_path() .'/images/event/thumbnails/' . $item->thumbnail;
                }else{
                  $image = Avatar::create($item->title)->toBase64();
                }
              }else{
                $image = Avatar::create($item->title)->toBase64();
              }

              $imageData = base64_encode(@file_get_contents($image));
              if($imageData){
                  $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
              } 
            @endphp
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
              <input class="form-check-card-input visibility-visible" form="bulk_delete_form" type="checkbox" value="{{$item->id}}" id="checkbox{{$item->id}}" name="checked[]">
              <div class=" card">
                @if($src != NULL)
                <img src="{{$src}}" class="card-img-top" alt="...">
               
                @endif
                <div class="overlay-bg"></div>

                <div class="dropdown card-dropdown">
                  <a class="btn-default btn-floating pull-right dropdown-toggle" type="button" id="dropdownMenuButton-{{$item->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons left">more_vert</i>
                  </a>
                  <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton-{{$item->id}}">
                    @can('liveevent.view')
                      <a class="dropdown-item" href="{{url('event/detail', $item->slug)}}" target="__blank"><i class="material-icons">desktop_mac</i> {{__('Page Preview')}}</a>
                    @endcan
                    
                    @can('liveevent.edit')
                      <a class="dropdown-item" href="{{ route('livetv.edit', $item->id)}}"><i class="material-icons">mode_edit</i> {{__('Edit')}}</a>
                    @endcan
                  
                    @can('liveevent.delete')
                    
                      <a type="button" class="dropdown-item" data-toggle="modal" data-target="#deleteModal{{$item->id}}"><i class="material-icons">delete</i> {{__('Delete')}}</a>
                     
                    @endcan
                   
                  </div>
                </div>

                <div id="deleteModal{{$item->id}}" class="delete-modal modal fade card-dropdown-modal" role="dialog">
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
                        <form method="POST" action="{{route("liveevent.destroy", $item->id)}}">
                          @method('DELETE')
                          @csrf
                            <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                            <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-body card-header">
                  <h5 class="card-title">{{$item->title}}</h5>
                </div>
                <div class="card-body">
                  <div class="card-block">
                    <h6 class="card-body-sub-heading">{{__('Start Time')}}</h6>
                    <p>{{isset($item->start_time) && $item->start_time != NULL ? date('Y/m/d, h:i:s a',strtotime($item->start_time)) : '-' }}</p>
                  </div>
                  <div class="card-block">
                    <h6 class="card-body-sub-heading">{{__('End Time')}}</h6>
                    <p>{{isset($item->end_time) && $item->end_time != NULL ? date('Y/m/d, h:i:s a',strtotime($item->end_time)) : '-' }}</p>
                  </div>
                 
                  <div class="card-block">
                    <h6 class="card-body-sub-heading">{{__('Organized By')}}</h6>
                    <p>{{isset($item->organized_by) && $item->organized_by ? $item->organized_by : '-' }}</p>
                  </div>
                  <div class="card-block">
                    <h6 class="card-body-sub-heading">{{__('Description')}}</h6>
                    <p>{{isset($item->description) && $item->description ? str_limit($item->description,50) : '-' }}</p>
                  </div>
                  {{-- <div class="card-block">
                    <h6 class="card-body-sub-heading">{{__('LiveEvent Emotions')}}</h6>
                    <div class="card-icons">
                      <ul>
                        <li>
                          <a href="{{url('event/detail', $item->slug)}}" data-toggle="tooltip" data-original-title=" Page Preview" target="_blank" class="btn-default btn-floating"><i class="material-icons">desktop_mac</i></a>
                        </li>
                        @can('liveevent.edit')
                          <li>
                            <a href="{{route('liveevent.edit', $item->id)}}" data-toggle="tooltip" data-original-title="{{__('Edit')}}" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                          </li>
                        @endcan
                        @can('liveevent.delete')
                          <li>
                            <a type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal{{$item->id}}"><i class="material-icons">delete</i> </a>
                              <div id="deleteModal{{$item->id }}" class="delete-modal modal fade" role="dialog">
                                <div class="modal-dialog modal-sm">
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <div class="delete-icon"></div>
                                    </div>
                                    <div class="modal-body text-center">
                                      <h4 class="modal-heading">{{__('AreYouSure')}}</h4>
                                      <p>{{__('DeleteWarrning')}}</p>
                                    </div>
                                    <div class="modal-footer">
                                      <form method="POST" action="{{route("liveevent.destroy", $item->id)}}">
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
                  </div> --}}
                </div>
              </div>
            </div>
          @endforeach
          <div class="col-md-12 pagination-block">
            {!! $liveevent->appends(request()->query())->links() !!}
          </div>
        @else
          <div class="col-md-12 text-center">
            <h5>{{__("Let's start :)")}}</h5>
            <small>{{__('Get Started by creating a liveevent ! All of your liveevents will be displayed on this page.')}}</small>
          </div>
        @endif
    </div>
  
  </div>
@endsection
