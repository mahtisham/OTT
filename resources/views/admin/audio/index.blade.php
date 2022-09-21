@extends('layouts.admin')
@section('title',__('All Audio'))
@section('content')
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <a data-toggle="modal" data-target="#importaudio" role="button" class="btn btn-danger btn-md"><i class="material-icons left">description</i> {{__('Import Audio')}}</a>
      <a href="{{route('audio.create')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i> {{__('Create Audio')}}</a>
      <!-- Delete Modal -->
      <a type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#bulk_delete"><i class="material-icons left">delete</i> {{__('Delete Selected')}}</a>   
     
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
              {!! Form::open(['method' => 'POST', 'action' => 'AudioController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="importaudio" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h5 class="modal-title" id="exampleStandardModalLabel">{{__("Bulk Import Audio")}}</h5>
              
            </div>
            <div class="modal-body">
              <!-- main content start -->
              <a href="{{ url('files/Audios.xlsx') }}" class="btn btn-md btn-success pull-right"> {{__('Download Example xls/csv
                File')}}</a>
              <form action="{{ url('/admin/import/audio') }}" method="POST" enctype="multipart/form-data">
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
                        <td>{{__('Enter audio title / name')}}</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td> <b>{{__('keyword')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("Enter audio meta keywords")}}</td>
                      </tr>
                     
                      <tr>
                        <td>3</td>
                        <td> <b>{{__('thumbnail')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__('Name your image eg: example.jpg')}} <b>{{__('(Image can be uploaded using Media Manager / Audio / thumbnail Tab.)')}}</b></td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td> <b>{{__('poster')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__('Name your image eg: example.jpg')}} <b>{{__('(Image can be uploaded using Media Manager / Audio / poster Tab.)')}}</b></td>
                      </tr>
                      <tr>
                        <td>5</td>
                        <td> <b>{{__('genre_id')}}</b> </td>
                        <td><b>{{__('Yes')}}</b></td>
                        <td>{{__("Multiple genre id can be pass here seprate by comma .")}}</td>
                      </tr>
                      <tr>
                        <td>6</td>
                        <td> <b>{{__('detail')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("Enter audio detail")}}</td>
                      </tr>
                      <tr>
                        <td>7</td>
                        <td> <b>{{__('rating')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("Enter audio rating")}}</td>
                      </tr>
                      <tr>
                        <td>8</td>
                        <td> <b>{{__('maturity_rating')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("Enter audio maturity ratings (please wirte one of these :-  all age , 13+, 16+ or 18+)")}}</b></td>
                      </tr>
                      <tr>
                        <td>9</td>
                        <td> <b>{{__('featured')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("audio featured (1 = enabled, 0 = disabled)")}}</b></td>
                      </tr>
                      <tr>
                        <td>10</td>
                        <td> <b>{{__('menu')}}</b> </td>
                        <td><b>{{__('Yes')}}</b></td>
                        <td>{{__("Multiple menu id can be pass here seprate by comma .")}}</td>
                      </tr>
                      <tr>
                        <td>11</td>
                        <td> <b>{{__('audiourl')}}</b> </td>
                        <td><b>{{__('Yes')}}</b></td>
                        <td>{{__("audio url can be pass here.")}}</td>
                      </tr>
                      <tr>
                        <td>12</td>
                        <td> <b>{{__('upload_audio')}}</b> </td>
                        <td><b>{{__('Yes')}}</b></td>
                        <td>{{__('Name your audio file eg: 01.mp3')}} <b>{{__('(audio can be uploaded using Media Manager / Audio / Tab.)')}}</b></td>
                      </tr>
                      <tr>
                        <td>13</td>
                        <td> <b>{{__('is_protect')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("Movie protected video (1 = enabled, 0 = disabled)")}}</td>
                      </tr>
                      <tr>
                        <td>14</td>
                        <td> <b>{{__('password')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("If is_protect = 1, then the enter password here ")}}</td>
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
            <input value="{{ app('request')->input('name') ?? '' }}" type="text" name="search" cllass="form-control float-left text-center" placeholder="{{__('Search Audio')}}">
          </form>
       
        </div>
      </form>
      <div class="row">
      @if(isset($audio) && $audio->count() > 0)
       @foreach($audio as $item)
        @php
          if($item->thumbnail != NULL){
            $content = @file_get_contents(public_path() .'/images/audio/thumbnails/' . $item->thumbnail); 
            if($content){
              $image = public_path() .'/images/audio/thumbnails/' . $item->thumbnail;
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
          <div class="card-two card">
            @if($src != NULL)
              <img src="{{url('/images/audio/thumbnails/' . $item->thumbnail)}}" class="card-img-top" alt="...">
            @endif
            <div class="overlay-bg"></div>
            <div class="dropdown card-dropdown">
              <a class="btn-default btn-floating pull-right dropdown-toggle" type="button" id="dropdownMenuButton-{{$item->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="material-icons left">more_vert</i>
              </a>
              <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton-{{$item->id}}">
                @can('audio.view')
                  <a class="dropdown-item" href="{{url('audio/detail', $item->id)}}" target="__blank"><i class="material-icons">desktop_mac</i> {{__('Page Preview')}}</a>
                @endcan
                
                @can('audio.edit')
                  <a class="dropdown-item" href="{{ route('audio.edit', $item->id)}}"><i class="material-icons">mode_edit</i> {{__('Edit')}}</a>
                @endcan
              
                @can('audio.delete')
                
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
                    <form method="POST" action="{{route("audio.destroy", $item->id)}}">
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
                <h6 class="card-body-sub-heading">{{__('Genre')}}</h6>
                @php
                 $genres = collect();
                  if (isset($item->genre_id)){
                    $genre_list = explode(',', $item->genre_id);
                    for ($i = 0; $i < count($genre_list); $i++) {
                      try {
                        $genre = App\Genre::find($genre_list[$i])->name;
                        $genres->push($genre);
                      } catch (Exception $e) {

                      }
                    }
                  }
                @endphp
                <p>
                  @if (count($genres) > 0)
                    @for($i = 0; $i < count($genres); $i++)
                      @if($i == count($genres)-1)
                        {{$genres[$i]}}
                      @else
                        {{$genres[$i]}},
                      @endif
                     @endfor
                  @endif
                </p>
              </div>
              <div class="card-block">
                <h6 class="card-body-sub-heading">{{__('Description')}}</h6>
                <p>{{isset($item->description) && $item->description ? str_limit($item->description,50) : '-' }}</p>
              </div>
              {{-- <div class="card-block">
                <h6 class="card-body-sub-heading">{{__('Audio Emotions')}}</h6>
                <div class="card-icons">
                  <ul>
                    <li>
                      <a href="{{url('audio/detail', $item->id)}}" data-toggle="tooltip" data-original-title="Page Preview" target="_blank" class="btn-default btn-floating"><i class="material-icons">desktop_mac</i></a>
                    </li>
                    @can('audio.edit')
                      <li>
                        <a href="{{route('audio.edit', $item->id)}}" data-toggle="tooltip" data-original-title="{{__('Edit')}}" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                      </li>
                    @endcan
                    @can('audio.delete')
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
                                  <form method="POST" action="{{route("audio.destroy", $item->id)}}">
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
           {!! $audio->appends(request()->query())->links() !!}
        </div>
      @else
        <div class="col-md-12 text-center">
          <h5>{{__("Let's start :)")}}</h5>
          <small>{{__('Get Started by creating a audio! All of your audios will be displayed on this page.')}}</small>
        </div>
      @endif
    </div>
  
  </div>
@endsection