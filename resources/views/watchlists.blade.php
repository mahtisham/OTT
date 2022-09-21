@extends('layouts.theme')
@section('title',__('Watchlist'))
@section('main-wrapper')
  <!-- main wrapper -->
  @php
 $withlogin= App\Config::first()->withlogin;
 $catlog= App\Config::first()->catlog;
 $auth=Auth::user();
 $subscribed = null;
 
@endphp

@include('modal.agemodal')
  <!-- Modal -->
  @include('modal.agewarning')
  <section class="main-wrapper">
    <div class="container-fluid">
      @if($watchlists > 0)
      <div class="watchlist-section">
        <h5 class="watchlist-heading">{{__('Watchlist')}}</h5>
        <div class="watchlist-btn-block">
          <div class="btn-group">
            @php
               $auth=Auth::user();
               if(isset($auth) || $auth->is_admin){
               $nav=App\Menu::orderBy('position','ASC')->get();
             }
            @endphp
              @if (isset($nav))
                 
                  @foreach ($nav as $menu)
                 
                    <a class="{{isset($menu) ? 'active' : ''}}" href="{{url('account/watchlist', $menu->slug)}}"  title="{{$menu->name}}">{{$menu->name}} </a>
                    
                  @endforeach
              
              @endif
            
          </div>
        </div>
      <!-- Modal -->
  

        @if(isset($movies))
          <div class="watchlist-main-block">
            @foreach($movies as $key => $item)
              @if($item->type=='S')
              @if($item->tvseries->status == 1)
              @if(hidedata($item->id,$item->type) != 1)
              <div class="watchlist-block">
                <div class="watchlist-img-block home-prime-slider protip" data-pt-placement="outside" data-pt-title="#prime-show-description-block{{$item->id}}">
                  <a href="{{url('show/detail',$item->season_slug)}}">
                    @if($item->thumbnail != null)
                      <img data-src="{{url('images/tvseries/thumbnails/'.$item->thumbnail)}}" class="img-responsive lazy watchlist-img" alt="genre-image">
                    @elseif($item->tvseries['thumbnail'] != null)
                      <img data-src="{{url('images/tvseries/thumbnails/'.$item->tvseries->thumbnail)}}" class="img-responsive lazy watchlist-img" alt="genre-image">
                    @else
                      <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-responsive lazy watchlist-img" alt="genre-image">
                    @endif
                  </a>
             
                  @if($item->tvseries->is_custom_label == 1)
                    @if(isset($item->tvseries->label_id))
                      <span class="badge bg-info">{{$item->tvseries->label->name}}</span>
                    @endif
                  @endif
                  
                </div>
                {!! Form::open(['method' => 'DELETE', 'action' => ['WishListController@showdestroy', $item->id]]) !!}
               
                 <button type="submit" class="watchhistory_remove"><i class="flaticon-cancel"></i></button><br/>
                {!! Form::close() !!}
                @if(isset($protip) && $protip == 1)
                <div id="prime-show-description-block{{$item->id}}" class="prime-description-block">
                  <h5 class="description-heading">{{$item->tvseries['title']}}</h5>
                  <div class="movie-rating">{{__('Tmdb Rating')}} {{$item->tvseries['rating']}}</div>
                  <ul class="description-list">
                    <li>{{__('Season')}} {{$item->season_no}}</li>
                    <li>{{$item->publish_year}}</li>
                    <li>{{$item->tvseries['age_req']}}</li>
                    @if($item->subtitle == 1)
                      <li>
                       {{__('Sub Titles')}}
                      </li>
                    @endif
                  </ul>
                  <div class="main-des">
                    @if ($item->detail != null || $item->detail != '')
                      <p>{{$item->detail}}</p>
                    @else
                      <p>{{$item->tvseries['detail']}}</p>
                    @endif
                    <a href="#"></a>
                  </div>
                  <div class="des-btn-block">
                    @if($auth && getSubscription()->getData()->subscribed == true)
                      @if(isset($item->episodes[0]) && checkInTvseries($item->tvseries) == true && isset($item->episodes[0]->video_link))
                        @if($item->tvseries['age_req'] == 'all age' || $age>=str_replace('+', '', $item->tvseries['age_req']) )
                          @if($item->episodes[0]->video_link['iframeurl'] !="")

                            <a href="#" onclick="playoniframe('{{ $item->episodes[0]->video_link['iframeurl'] }}','{{ $item->tvseries['id'] }}','tv')" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                           </a>

                          @else
                            <a href="{{ route('watchTvShow',$item->id) }}" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span></a>
                          @endif
                        @else

                          <a onclick="myage({{$age}})" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                         </a>
                        @endif
                      @endif
                      @if($item->trailer_url != null || $item->trailer_url != '')
                        <a href="{{ route('watchtvTrailer',$item->id)  }}" class="iframe btn btn-default">{{__('Watch Trailer')}}</a>
                      @endif
                    @else
                       @if($item->trailer_url != null || $item->trailer_url != '')
                        <a href="{{ route('guestwatchtvtrailer',$item->id)  }}" class="iframe btn btn-default">{{__('Watch Trailer')}}</a>
                      @endif
                    @endif
                    
                  </div>
                </div>
                @endif
              </div>
              @endif
              @endif
              @endif
            @endforeach
          </div>
        @endif
      
        
        @if(isset($movies))
          <div class="watchlist-main-block">
            @foreach($movies as $key => $movie)
           
             @if($movie->type=="M")
             @if($movie->status == 1)
             @php
             
              if(getSubscription()->getData()->subscribed == true){
                foreach($movie->menus as $moviemenu){
                  if(array_search($moviemenu->menu_id, array_column(getSubscription()->getData()->nav_menus, 'id')) !== false)
                  {
                      $is_play = 1;
                  }
                }
              }
            @endphp
            @if(hidedata($movie->id,$movie->type) != 1)
              <div class="watchlist-block">
                <div class="watchlist-img-block home-prime-slider protip progress-movie" data-pt-placement="outside" data-pt-title="#prime-description-block{{$movie->id}}">
                  @if($auth && getSubscription()->getData()->subscribed == true)
                  <a href="{{url('movie/detail',$movie->slug)}}">
                    @if($movie->thumbnail != null || $movie->thumbnail != '')
                      <img data-src="{{url('images/movies/thumbnails/'.$movie->thumbnail)}}" class="img-responsive lazy watchlist-img" alt="genre-image">
                    @else
                      <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-responsive lazy watchlist-img" alt="genre-image">
                    @endif
                  </a>
               
                  @if(timecalcuate($auth->id,$movie->id,$movie->type) != 0)
                  <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:{{timecalcuate($auth->id,$movie->id,$movie->type)}}%">
                    </div>
                  </div>
                  @endif
                  @else
                    <a href="{{url('movie/guest/detail',$movie->slug)}}">
                    @if($movie->thumbnail != null || $movie->thumbnail != '')
                      <img data-src="{{url('images/movies/thumbnails/'.$movie->thumbnail)}}" class="img-responsive lazy watchlist-img" alt="genre-image">
                    @else
                      <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-responsive lazy watchlist-img" alt="genre-image">
                    @endif
                  </a>
                  @endif
                
                 @if($movie->is_custom_label == 1)
                    @if(isset($movie->label_id))
                      <span class="badge bg-info">{{$movie->label->name}}</span>
                    @endif
                  @else

                    @if(isset($movie->is_upcoming) && $movie->is_upcoming == 1)
                      @if($movie->upcoming_date != NULL)
                        <span class="badge bg-success">{{date('M jS Y',strtotime($movie->upcoming_date))}}</span>
                      @else
                        <span class="badge bg-danger">{{__('Coming Soon')}}</span>
                      @endif
                  
                    @endif
                  @endif
                 
                </div>
                {!! Form::open(['method' => 'DELETE', 'action' => ['WishListController@moviedestroy', $movie->id]]) !!}
                
                    <button type="submit" class="watchhistory_remove"><i class="flaticon-cancel"></i></button><br/>
                {!! Form::close() !!}
                @if(isset($protip) && $protip == 1)
                <div id="prime-description-block{{$movie->id}}" class="prime-description-block">
                  <div class="prime-description-under-block">
                    <h5 class="description-heading">{{$movie->title}}</h5>
                    <div class="movie-rating">{{__('Tmdb Rating')}} {{$movie->rating}}</div>
                    <ul class="description-list">
                      <li>{{$movie->duration}} {{__('Mins')}}</li>
                      <li>{{$movie->publish_year}}</li>
                      <li>{{$movie->maturity_rating}}</li>
                      @if($movie->subtitle == 1)
                        <li>
                         {{__('Sub Titles')}}
                        </li>
                      @endif
                    </ul>
                    <div class="main-des">
                      <p>{{$movie->detail}}</p>
                      <a href="#"></a>
                    </div>
                    <div class="des-btn-block">
                      @if($auth && getSubscription()->getData()->subscribed == true)
                        @if($movie->is_upcoming != 1)
                          @if(checkInMovie($movie) == true && isset($movie->video_link))
                            @if($movie->maturity_rating == 'all age' || $age>=str_replace('+', '', $movie->maturity_rating))
                              @if($movie->video_link['iframeurl'] != null)
                                <a href="{{route('watchmovieiframe',$item->id)}}"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                                </a>

                              @else 
                                <a href="{{ route('watchmovie',$movie->id) }}" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span></a>
                              @endif
                            @else
                              <a onclick="myage({{$age}})" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                              </a>
                            @endif
                          @endif
                        @endif
                        @if($movie->trailer_url != null || $movie->trailer_url != '')
                          <a href="{{ route('watchTrailer',$movie->id) }}" class="iframe btn btn-default">{{__('Watch Trailer')}}</a>
                        @endif
                      @else
                        @if($movie->trailer_url != null || $movie->trailer_url != '')
                          <a href="{{ route('guestwatchtrailer',$movie->id) }}" class="iframe btn btn-default">{{__('Watch Trailer')}}</a>
                        @endif
                      @endif
                    </div>
                  </div>
                </div>
                @endif
              </div>
            @endif
              @endif
               @endif
            @endforeach
          </div>
        @endif
        
      </div>
      
    </div>
    @else
      <div class="search-box">
        <h5 class="movie-series-heading text-center">{{__('Your wishlist is currently empty!')}}</h5>
        <p class="text-center">{{__('Add  items that you want to watch later by clicking Add to Watchlist.')}}</p>
      </div>
    
    @endif
      <!-- google adsense code -->
        <div class="container-fluid">
         <?php
          if (isset($ad)) {
           if ($ad->iswishlist==1 && $ad->status==1) {
              $code=  $ad->code;
              echo html_entity_decode($code);
           }
          }
?>
      </div>
  </section>


  <!--End-->
 
@endsection

@section('custom-script')
  <script>

      function playoniframe(url,id,type){
          
 
   $(document).ready(function(){
    var SITEURL = '{{URL::to('')}}';
       $.ajax({
            type: "get",
            url: SITEURL + "/user/watchhistory/"+id+'/'+type,
            success: function (data) {
             console.log(data);
            },
            error: function (data) {
               console.log(data)
            }
        });
       
   
         
  
  });       
        $.colorbox({ href: url, width: '100%', height: '100%', iframe: true });
      }
      
    </script>
   <script>

      function myage(age){
        if (age==0) {
        $('#ageModal').modal('show'); 
      }else{
          $('#ageWarningModal').modal('show');
      }
    }
      
    </script>

@endsection