@extends('layouts.admin')
@section('title',__('All Movies'))
@section('content')
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      @can('movies.create')
      <a data-toggle="modal" data-target="#importmovie" role="button" class="btn btn-danger btn-md"><i class="material-icons left">description</i> {{__('Import Movies')}}</a>
        <a href="{{route('movies.create')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i> {{__('Create Movie')}}</a>
      @endcan
      <!-- Delete Modal -->
      @can('movies.delete')
      <a type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#bulk_delete"><i class="material-icons left">delete</i> {{__('Delete Selected')}}</a> 
      @endcan
      @if (Session::has('changed_language'))
        <a href="{{ route('tmdb_movie_translate') }}" class="btn btn-danger btn-md"><i class="material-icons left">translate</i> {{__('Translate All To')}} {{Session::get('changed_language')}}</a>   
      @endif
      {{-- <a type="button" class="btn btn-danger btn-md"><input class="form-check-input width-18 height-18 position-relative left-0 top--3 mr-10 visibility-visible" type="checkbox" value="" id="flexCheckDefault">Select All</a> --}}
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
              {!! Form::open(['method' => 'POST', 'action' => 'MovieController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="importmovie" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
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
              <a href="{{ url('files/Movies.xlsx') }}" class="btn btn-md btn-success pull-right"> {{__('Download Example xls/csv
                File')}}</a>
              <form action="{{ url('/admin/import/movies') }}" method="POST" enctype="multipart/form-data">
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
                        <td>{{__('Enter movie title / name')}}</td>
                      </tr>
  
                      <tr>
                        <td>2</td>
                        <td> <b>{{__('is_upcoming')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__('upcoming movie (1 = enabled, 0 = disabled)')}}</td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td> <b>{{__('upcoming_date')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__('If is_upcoming = 1 , then the pass upcoming date here')}}</b></td>
                      </tr>
  
                      <tr>
                        <td>4</td>
                        <td> <b>{{__('is_custom_label')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("custom label (1 = enabled, 0 = disabled)")}}</b></td>
                      </tr>
  
                      <tr>
                        <td>5</td>
                        <td> <b>{{__('label_id')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("If is_custom_label = 1 , then the pass label id here")}}</b></td>
                      </tr>

                      <tr>
                        <td>6</td>
                        <td> <b>{{__('selecturl')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("Enter actor's DOB")}}</b></td>
                      </tr>
                      <tr>
                        <td>7</td>
                        <td> <b>{{__('iframeurl')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("Enter actor's DOB")}}</b></td>
                      </tr>
                      <tr>
                        <td>8</td>
                        <td> <b>{{__('ready_url')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("Enter actor's DOB")}}</b></td>
                      </tr>
                      <tr>
                        <td>9</td>
                        <td> <b>{{__('url_360')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__('Name your video eg: example.jpg')}} <b>{{__('(Video can be uploaded using Media Manager / Movie / URL 360 Tab.)')}}</b></td>
                      </tr>
                      <tr>
                        <td>10</td>
                        <td> <b>{{__('url_480')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__('Name your video eg: example.jpg')}} <b>{{__('(Video can be uploaded using Media Manager / Movie / URL 480 Tab.)')}}</b></td>
                      </tr>
                      <tr>
                        <td>11</td>
                        <td> <b>{{__('url_720')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__('Name your video eg: example.jpg')}} <b>{{__('(Video can be uploaded using Media Manager / Movie / URL 720 Tab.)')}}</b></td>
                      </tr>
                      <tr>
                        <td>12</td>
                        <td> <b>{{__('url_1080')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__('Name your video eg: example.jpg')}} <b>{{__('(Video can be uploaded using Media Manager / Movie / URL 1080 Tab.)')}}</b></td>
                      </tr>
                      <tr>
                        <td>13</td>
                        <td> <b>{{__('upload_video')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__('Name your video eg: example.jpg')}} <b>{{__('(Video can be uploaded using Media Manager / Movie uploads Tab.)')}}</b></td>
                      </tr>
                      <tr>
                        <td>14</td>
                        <td> <b>{{__('a_language')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("Multiple a_language id can be pass here seprate by comma")}}</b></td>
                      </tr>
                      <tr>
                        <td>15</td>
                        <td> <b>{{__('maturity_rating')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("Enter movie maturity ratings (please wirte one of these :-  all age , 13+, 16+ or 18+)")}}</b></td>
                      </tr>
                      <tr>
                        <td>16</td>
                        <td> <b>{{__('thumbnail')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__('Name your image eg: example.jpg')}} <b>{{__('(Image can be uploaded using Media Manager / Movies / thumbnail Tab.)')}}</b></td>
                      </tr>
                      <tr>
                        <td>17</td>
                        <td> <b>{{__('poster')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__('Name your image eg: example.jpg')}} <b>{{__('(Image can be uploaded using Media Manager / Movies / poster Tab.)')}}</b></td>
                      </tr>
                      <tr>
                        <td>18</td>
                        <td> <b>{{__('series')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("Movie Series (1 = enabled, 0 = disabled)")}}</b></td>
                      </tr>
                      <tr>
                        <td>19</td>
                        <td> <b>{{__('movie_id')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("If series = 1 , then movie id can be pass here .")}}</b></td>
                      </tr>
                      <tr>
                        <td>20</td>
                        <td> <b>{{__('featured')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("Movie featured (1 = enabled, 0 = disabled)")}}</b></td>
                      </tr>
                      <tr>
                        <td>21</td>
                        <td> <b>{{__('subtitle')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("Movie subtitle (1 = enabled, 0 = disabled)")}}</b></td>
                      </tr>
                      <tr>
                        <td>22</td>
                        <td> <b>{{__('sub_lang')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("If subtitle = 1 , then enter subtitle language name here ")}}</b></td>
                      </tr>
                      <tr>
                        <td>23</td>
                        <td> <b>{{__('sub_t')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("If subtitle = 1 , then enter subtitile files")}}  ({{__('Name your file eg: example.txt')}} <b>{{__('(files can be uploaded using Media Manager / subtitle / Movies Tab.)')}} </b> )</td>
                      </tr>
                      
                      <tr>
                        <td>26</td>
                        <td> <b>{{__('keyword')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("Enter movie meta keywords")}}</td>
                      </tr>
                      <tr>
                        <td>27</td>
                        <td> <b>{{__('description')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("Enter movie meta description")}}</td>
                      </tr>
                      <tr>
                        <td>28</td>
                        <td> <b>{{__('menu')}}</b> </td>
                        <td><b>{{__('Yes')}}</b></td>
                        <td>{{__("Multiple menu id can be pass here seprate by comma .")}}</td>
                      </tr>
                      <tr>
                        <td>29</td>
                        <td> <b>{{__('director_id')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("Multiple director id can be pass here seprate by comma .")}}</td>
                      </tr>
                      <tr>
                        <td>30</td>
                        <td> <b>{{__('actor_id')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("Multiple actor id can be pass here seprate by comma .")}}</td>
                      </tr>
                      <tr>
                        <td>31</td>
                        <td> <b>{{__('genre_id')}}</b> </td>
                        <td><b>{{__('Yes')}}</b></td>
                        <td>{{__("Multiple genre id can be pass here seprate by comma .")}}</td>
                      </tr>
                      <tr>
                        <td>32</td>
                        <td> <b>{{__('duration')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("Enter movie duration in minutes")}}</td>
                      </tr>
                      <tr>
                        <td>33</td>
                        <td> <b>{{__('publish_year')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("Enter movie publish year")}}</td>
                      </tr>
                      <tr>
                        <td>34</td>
                        <td> <b>{{__('rating')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("Enter movie rating")}}</td>
                      </tr>
                      <tr>
                        <td>35</td>
                        <td> <b>{{__('released')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("Enter movie released date")}}</td>
                      </tr>
                      <tr>
                        <td>36</td>
                        <td> <b>{{__('detail')}}</b> </td>
                        <td><b>{{__('No')}}</b></td>
                        <td>{{__("Enter movie detail")}}</td>
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
            <input value="{{ app('request')->input('name') ?? '' }}" type="text" name="search" cllass="form-control float-left text-center" placeholder="{{__('Search Movies')}}">
          </form>
       
        </div>
      </form>
      <div class="row">
        @if(isset($movies) && count($movies) > 0)
          @foreach($movies as $item)
            @php
              if($item->thumbnail != NULL){
                $content = @file_get_contents(public_path() .'/images/movies/thumbnails/' . $item->thumbnail); 
                if($content){
                  $image = public_path() .'/images/movies/thumbnails/' . $item->thumbnail;
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
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
              <input class="form-check-card-input visibility-visible" form="bulk_delete_form" type="checkbox" value="{{$item->id}}" id="checkbox{{$item->id}}" name="checked[]">
              {{-- <label for="checkboxAll" class="material-checkbox"></label> --}}
              <div class="card">
                @if($src != NULL)
                  <img src="{{$src}}" class="card-img-top" alt="...">
                @endif
                <div class="overlay-bg"></div>
                <div class="dropdown card-dropdown">
                  <a class="btn-default btn-floating pull-right dropdown-toggle" type="button" id="dropdownMenuButton-{{$item->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons left">more_vert</i>
                  </a>
                  <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton-{{$item->id}}">
                    @can('movies.view')
                      <a class="dropdown-item" href="{{url('movie/detail', $item->slug)}}" target="__blank"><i class="material-icons">desktop_mac</i> {{__('Page Preview')}}</a>
                    @endcan
                    
                    @can('movies.edit')
                      <a class="dropdown-item" href="{{route('movies.edit', $item->id)}}"><i class="material-icons">mode_edit</i> {{__('Edit')}}</a>
                    @endcan
                  
                    @can('movies.delete')
                      <a type="button" class="dropdown-item" data-toggle="modal" data-target="#deleteModal{{$item->id}}"><i class="material-icons">delete</i> {{__('Delete')}}</a>
                    @endcan
                    <a class="dropdown-item" href="{{route('movies.link', $item->id)}}"><i class="material-icons">link</i> {{__('Add more links')}}</a>
                    
                    
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
                        <form method="POST" action="{{route("movies.destroy", $item->id)}}">
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
                  <h5 class="card-title">{{$item->title}}</h5><br>
                </div>
                <div class="card-body">
                  <div class="card-block row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <h6 class="card-body-sub-heading">{{__('Year')}}</h6>
                      <p>{{isset($item->publish_year) && $item->publish_year ? $item->publish_year : '-' }}</p>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <h6 class="card-body-sub-heading">{{__('Length')}}</h6>
                      <p>{{isset($item->publish_year) && $item->publish_year ? $item->publish_year : '-' }}</p>
                    </div>
                    
                  </div>
                  <div class="card-block card-block-ratings">
                    <h6 class="card-body-sub-heading">{{__('Ratings')}}</h6>
                    @php
                    $rating = ($item->rating)/2;
                    @endphp
                    <table>
                      <tr>
                        <td>
                          <input class="rating" id="input-{{$item->id}}" name="input-3" value="{{$rating}}" class="rating-loading" disabled>
                        </td>
                      </tr>
                    </table>
                    <p>{{$item->rating}}/10</p>
                  </div>
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
                 
                  
                
                  <div class="card-block row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                      <h6 class="card-body-sub-heading">{{__('Created By')}}</h6>
                      @php 
                        $username = App\User::find($item->created_by);
                      @endphp
                      <p>{{isset($username) && $username != NULL ? $username->name :'user deleted'}}</p>
                    </div>
                    <div class="col-xs-6 col-md-6 col-md-6">
                      <h6 class="card-body-sub-heading">{{__('Status')}}</h6>
                    <p class="status-btn">
                      @if($item->status == 1)
                            <a href="{{route('quick.movie.status', $item->id) }}" class='btn btn-sm btn-success'>{{__('Active')}}</a>
                        @else
                            <a href="{{route('quick.movie.status', $item->id) }}" class='btn btn-sm btn-danger'>{{__('De Active')}}</a>
                       @endif
                     </p>
                    </div>
                    
                  </div>
              
                </div>
              </div>
            </div>
          @endforeach
          <div class="col-md-12 pagination-block text-center">
            {!! $movies->appends(request()->query())->links() !!}
          </div>
        @else
        
         <div class="col-md-12 text-center">
            <h5>{{__("Let's start :)")}}</h5>
            <small>{{__('Get Started by creating a movie! All of your movies will be displayed on this page.')}}</small>
          </div>
        @endif
    </div>
  </div>
@endsection
@section('custom-script')
 <script>
    $(document).ready(function(){
        $('.rating').rating({displayOnly: false, step: 0.5});
    });
</script>
@endsection