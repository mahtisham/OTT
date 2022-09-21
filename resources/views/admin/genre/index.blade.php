@extends('layouts.admin')
@section('title',__('All Genres'))
@section('content')

  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      @can('genre.create')
      <a data-toggle="modal" data-target="#importgenre" role="button" class="btn btn-danger btn-md"><i class="material-icons left">description</i> {{__('Import Genres')}}</a>
        <a href="{{route('genres.create')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i> {{__('Create Genre')}}</a>
      @endcan
      {{-- <a href="{{url('admin/update-to-english')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i> Update Genre to english</a> --}}
      <!-- Delete Modal -->
      @can('genre.delete')
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
              {!! Form::open(['method' => 'POST', 'action' => 'GenreController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="importgenre" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h5 class="modal-title" id="exampleStandardModalLabel">{{__("Bulk Import Actors")}}</h5>
             
            </div>
            <div class="modal-body">
              <!-- main content start -->
              <a href="{{ url('files/Genres.xlsx') }}" class="btn btn-md btn-success pull-right"> {{__('Download Example xls/csv
                File')}}</a>
              <form action="{{ url('/admin/import/genres') }}" method="POST" enctype="multipart/form-data">
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
                        <td>{{__('Enter genre name')}}</td>
                      </tr>
  
                      <tr>
                        <td>2</td>
                        <td> <b>{{__('image')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__('Name your image eg: example.jpg')}} <b>{{__('(Image can be uploaded using Media Manager / Genre Tab.)')}}</b></td>
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
    <div class="content-block box-body genre-card">
      <form class="navbar-form" role="search">
        <div class="input-group ">
         <form method="get" action="">
            <input value="{{ app('request')->input('name') ?? '' }}" type="text" name="search" cllass="form-control float-left text-center" placeholder="{{__('Search Genre')}}">
          </form>
       
        </div>
      </form>
   
      <div class="row text-center">
        @if(isset($genres) && $genres->count() > 0)
          @foreach($genres as $genre)
          @php
            if($genre->image != NULL){
              $content = @file_get_contents(public_path() .'/images/genre/' . $genre->image); 
              if($content){
                $image = public_path() .'/images/genre/' . $genre->image;
              }else{
                $image = Avatar::create($genre->name)->toBase64();
              }
            }else{
              $image = Avatar::create($genre->name)->toBase64();
            }

            $imageData = base64_encode(@file_get_contents($image));
            if($imageData){
                $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
            } 
          @endphp
          <div class="col-xs-6 col-sm-6 col-md-4 col-lg-2">
            <input class="form-check-card-input visibility-visible" form="bulk_delete_form" type="checkbox" value="{{$genre->id}}" id="checkbox{{$genre->id}}" name="checked[]">
            <div class="card">
              @if($src != NULL)
                <img src="{{$src}}" class="card-img-top" alt="...">
             
              @endif
               <div class="overlay-bg"></div>
              <div class="card-body">
                <h5 class="card-title">{{$genre->name}}</h5>
                <div class="card-icons">
                  <ul>
                    @can('genre.edit')
                      <li>
                        <a href="{{route('genres.edit', $genre->id)}}" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                      </li>
                    @endcan
                    @can('genre.delete')
                      <li>
                       <a type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal{{$genre->id }}"><i class="material-icons">delete</i> </a>
                         <div id="deleteModal{{$genre->id }}" class="delete-modal modal fade" role="dialog">
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
                                <form method="POST" action="{{route("genres.destroy", $genre->id)}}">
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
             {!! $genres->appends(request()->query())->links() !!}
          </div> 
           
        @else
          <div class="col-md-12 text-center">
            <h5>{{__("Let's start :)")}}</h5>
            <small>{{__('Get Started by creating a genre! All of your genres will be displayed on this page.')}} <a href="{{route('genres.create')}}"> {{__('click here')}}</a></small>
          </div>
        @endif
      </div>
     
@endsection
