@extends('layouts.admin')
@section('title',__('All Directors'))
@section('content')
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      @can('director.create')
      <a data-toggle="modal" data-target="#importdirector" role="button" class="btn btn-danger btn-md"><i class="material-icons left">description</i> {{__('Import Directors')}}</a>
        <a href="{{route('directors.create')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i> {{__('CreateDirector')}}</a>
      @endcan
      <!-- Delete Modal -->
      @can('director.delete')
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
              {!! Form::open(['method' => 'POST', 'action' => 'DirectorController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="importdirector" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h5 class="modal-title" id="exampleStandardModalLabel">{{__("Bulk Import Directors")}}</h5>
             
            </div>
            <div class="modal-body">
              <!-- main content start -->
              <a href="{{ url('files/Directors.xlsx') }}" class="btn btn-md btn-success pull-right"> {{__('Download Example xls/csv
                File')}}</a>
              <form action="{{ url('/admin/import/directors') }}" method="POST" enctype="multipart/form-data">
                @csrf
  
                <div class="row">
                  <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }} input-file-block col-md-12">
                    {!! Form::label('file', __('Choose your xls/csv File :')) !!}
                    {!! Form::file('file', ['class' => 'input-file', 'id'=>'file']) !!}
                    <label for="file" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('Choose your xls/csv File')}}">
                      <i class="icon fa fa-check"></i>
                      <span class="js-fileName">{{__('Choose A File')}}</span>
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
                <div class="box-body table-responsive">
                
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
                        <td><b>{{__('name')}}</b></td>
                        <td><b>{{__('Yes')}}</b></td>
                        <td>{{__('Enter director name')}}</td>
                      </tr>
  
                      <tr>
                        <td>2</td>
                        <td> <b>{{__('image')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__('Name your image eg: example.jpg')}} <b>{{__('(Image can be uploaded using Media Manager / Director Tab.)')}}</b></td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td> <b>{{__('biography')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__('Enter directors biography')}}</b></td>
                      </tr>
  
                      <tr>
                        <td>4</td>
                        <td> <b>{{__('place_of_birth')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("Enter director's place of birth")}}</b></td>
                      </tr>
  
                      <tr>
                        <td>5</td>
                        <td> <b>{{__('DOB')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("Enter director's DOB")}}</b></td>
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
            <input value="{{ app('request')->input('name') ?? '' }}" type="text" name="search" cllass="form-control float-left text-center" placeholder="{{__('Search Directors')}}">
          </form>
       
        </div>
      </form>
      <div class="row">
        @if(isset($directors) && $directors->count() > 0)
          @foreach($directors as $item)
            @php
              if($item->image != NULL){
                $content = @file_get_contents(public_path() .'/images/directors/' . $item->image); 
                if($content){
                  $image = public_path() .'/images/directors/' . $item->image;
                }else{
                  $image = Avatar::create($item->name)->toBase64();
                }
              }else{
                $image = Avatar::create($item->name)->toBase64();
              }

              $imageData = base64_encode(@file_get_contents($image));
              if($imageData){
                  $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
              } 
            @endphp
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
              <input class="form-check-card-input visibility-visible" form="bulk_delete_form" type="checkbox" value="{{$item->id}}" id="checkbox{{$item->id}}" name="checked[]">
              <div class="card-two card">
                @if($src != NULL)
                <img src="{{$src}}" class="card-img-top" alt="...">
               
                @endif
                <div class="overlay-bg"></div>
                <div class="dropdown card-dropdown">
                  <a class="btn-default btn-floating pull-right dropdown-toggle" type="button" id="dropdownMenuButton-{{$item->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons left">more_vert</i>
                  </a>
                  <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton-{{$item->id}}">
                    @can('director.view')
                      <a class="dropdown-item" href="{{url('video/detail/director_search', $item->slug)}}" target="__blank"><i class="material-icons">desktop_mac</i> {{__('Page Preview')}}</a>
                    @endcan
                    
                    @can('director.edit')
                      <a class="dropdown-item" href="{{ route('directors.edit', $item->id)}}"><i class="material-icons">mode_edit</i> {{__('Edit')}}</a>
                    @endcan
                  
                    @can('director.delete')
                    
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
                        <form method="POST" action="{{route("directors.destroy", $item->id)}}">
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
                  <h5 class="card-title">{{$item->name}}</h5>
                </div>
                <div class="card-body">
                  <div class="card-block">
                    <h6 class="card-body-sub-heading">{{__('DOB')}}</h6>
                    <p>{{isset($item->DOB) && $item->DOB != NULL ? $item->DOB : '-' }}</p>
                  </div>
                 
                  <div class="card-block">
                    <h6 class="card-body-sub-heading">{{__('Place Of Birth')}}</h6>
                    <p>{{isset($item->place_of_birth) && $item->place_of_birth != NULL ? str_limit($item->place_of_birth,30) : '-'}}</p>
                  </div>
                  <div class="card-block">
                    <h6 class="card-body-sub-heading">{{__('BioGraphy')}}</h6>
                    <p>{{isset($item->biography) && $item->biography != NULL ? str_limit($item->biography,50) : '-'}}</p>
                  </div>
                  {{-- <div class="card-block">
                    <h6 class="card-body-sub-heading">{{__('Director Emotions')}}</h6>
                    <div class="card-icons">
                      <ul>
                        <li>
                          <a href="{{url('video/detail/director_search', $item->slug)}}" target="__blank" data-toggle="tooltip" data-original-title="Page Preview" class="btn-default btn-floating"><i class="material-icons">desktop_mac</i></a>
                        </li>
                        @can('director.edit')
                          <li>
                            <a href="{{route('directors.edit', $item->id)}}" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                          </li>
                        @endcan
                        @can('director.delete')
                          <li>
                            <a type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal{{$item->id}}"><i class="material-icons">delete</i> </a>
                            <div id="deleteModal{{$item->id}}" class="delete-modal modal fade" role="dialog">
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
                                    <form method="POST" action="{{route("directors.destroy", $item->id)}}">
                                      @method('DELETE')
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
          <div class="col-md-12 pagination-block text-center">
           {!! $directors->appends(request()->query())->links() !!}
          </div>
        @else
          <div class="col-md-12 text-center">
            <h5>{{__("Let's start :)")}}</h5>
            <small>{{__('Get Started by creating a director ! All of your directors will be displayed on this page.')}}</small>
          </div>
        @endif
      </div>
   
  </div>
@endsection
