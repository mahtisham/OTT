@extends('layouts.theme')
@section('title',"Search result for $searchKey")
@section('main-wrapper')
  <!-- main wrapper -->
@php
  $age=0;
  if ($configs->age_restriction==1) {
    if(Auth::user()){
      $user_id=Auth::user()->id;
      $user=App\User::findOrfail($user_id);
      $age=$user->age;
    }
  }else{
    $age=100;
  }
 $withlogin= $configs->withlogin;
 $auth=Auth::user();


@endphp
  <section class="main-wrapper main-wrapper-single-movie-prime">
    <div class="container-fluid movie-series-section search-section">
      @if(isset($actor))
        <div class="movie-series-block">
          <div class="row">
            <div class="col-12 col-sm-3 col-lg-2">
              <div class="movie-series-img">
                @php
                  if ($actor->image != null) {
                    $content = @file_get_contents(public_path() . '/images/actors/' . $actor->image);
                    if($content){
                      $image = public_path() .'/images/actors/' . $actor->image;
                    }else{
                      $image = Avatar::create($actor->name)->toBase64();
                    }
                  }else{
                    $image = Avatar::create($actor->name)->toBase64();
                  }
                  $imageData = base64_encode(@file_get_contents($image));
                  if($imageData){
                      $actorsrc = 'data: '.mime_content_type($image).';base64,'.$imageData;
                  }

                @endphp
                @if($actorsrc != NULL)
                  <img data-src="{{$actorsrc}}" class="img-responsive actor_image lazy" alt="actor-image">
               
                @endif
              </div>
            </div>
            <div class="col-12 col-sm-9 col-lg-10">
              <div class="movie-series-section search-actor">
                <h5 class="movie-series-heading movie-series-name">
                  {{$actor->name}}
                </h5>
                <p>
                  {{__('dob')}}- {{$actor->DOB ? $actor->DOB : __('Not Available') }} </p>
                <p>
                  {{__('placeofbirth')}}- {{$actor->place_of_birth ? $actor->place_of_birth : __('Not Available')}} </p>
                <p>
                  {{$actor->biography}}
                </p>
              </div>
            </div>
          </div>
        </div>
        <h5 class="movie-series-heading">{{count($filter_video)}} {{__('Found For')}} "{{$searchKey}}"</h5>
        
      @endif

      @if(isset($director))
        <div class="movie-series-block">
          <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-3">
              <div class="movie-series-img">
                @php
                  if ($director->image != null) {
                    $content = @file_get_contents(public_path() . '/images/directors/' . $director->image);
                   
                    if($content){
                      $image = public_path() .'/images/directors/' . $director->image;
                    }else{
                      $image = Avatar::create($director->name)->toBase64();
                    }
                  }else{
                    $image = Avatar::create($director->name)->toBase64();
                  }
                  $imageData = base64_encode(@file_get_contents($image));
                  if($imageData){
                      $directorsrc = 'data: '.mime_content_type($image).';base64,'.$imageData;
                  }

                @endphp

                @if($directorsrc !=NULL)
                  <img data-src="{{$directorsrc}}" class="img-responsive actor_image lazy" alt="Director-image">
                @endif
              </div>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-9">
              <div class="movie-series-section search-actor">
                <h5 class="movie-series-heading movie-series-name">
                  {{$director->name}}
                </h5>
                <p>
                  {{__('DOB')}}- {{$director->DOB}} </p>
                <p>
                  {{__('Place of Brth')}}- {{$director->place_of_birth}}</p>                
                <p>
                  {{$director->biography}}
                </p>
              </div>
            </div>
          </div>
        </div>
        <h5 class="movie-series-heading">{{count($filter_video)}} {{__('Found For')}} "{{$searchKey}}"</h5>
      @endif

      @if(isset($filter_video))
        @if(count($filter_video) > 0)
          @foreach($filter_video->unique('id') as $key => $item)
            @php
              if($auth){
                if ($item->type == 'M')
                {
                  $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                            ['user_id', '=', $auth->id],
                                                                            ['movie_id', '=', $item->id],
                                                                           ])->first();
                } else {
                  $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                            ['user_id', '=', $auth->id],
                                                                            ['season_id', '=', $item->id],
                                                                           ])->first();
                }
              }
            @endphp
            <div class="movie-series-block">
              <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-3">
                  <div class="movie-series-img home-prime-slider">
                   
                    @if($item->type == 'M')
                      @php
                      if($item->thumbnail != NULL){
                        $content = @file_get_contents(public_path() .'/images/movies/thumbnails/'.$item->thumbnail);
                        
                        if($content){
                          $image = public_path() .'/images/movies/thumbnails/'.$item->thumbnail;
                        }else{
                          $image = Avatar::create($item->title)->toBase64();
                        }
                      }else{
                        $image = Avatar::create($item->title)->toBase64();
                      }
                      
                      $imageData = base64_encode(@file_get_contents($image));
                      if($imageData){
                          $movie_src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                      }
                      @endphp
                      @if($movie_src != null) 
                        <img data-src="{{$movie_src}}" class="img-responsive actor_image lazy" alt="genre-image">
                      @endif
                      @if($item->is_custom_label == 1)
                        @if(isset($item->label_id))
                          <span class="badge bg-info">{{$item->label->name}}</span>
                        @endif
                      @else
                        @if(isset($item->is_upcoming) && $item->is_upcoming == 1)
                          @if($item->upcoming_date != NULL)
                            <span class="badge bg-success">{{date('M jS Y',strtotime($item->upcoming_date))}}</span>
                          @else
                            <span class="badge bg-danger">{{__('Coming Soon')}}</span>
                          @endif
                      
                        @endif
                      @endif
                     
                    @elseif($item->type == 'S')
                      @php
                        if($item->thumbnail != NULL){
                          $content = @file_get_contents(public_path() .'/images/tvseries/thumbnails/'. $item->thumbnail); 
                          if($content){
                            $image = public_path() .'/images/tvseries/thumbnails/'. $item->thumbnail;
                          }
                        }elseif($item->tvseries->thumbnail != NULL){
                          $content = @file_get_contents(public_path() .'/images/tvseries/thumbnails/'. $item->tvseries->thumbnail); 
                          if($content){
                            $image = public_path() .'/images/tvseries/thumbnails/'. $item->tvseries->thumbnail;
                          }
                        }else{
                          $image = Avatar::create($item->tvseries->title)->toBase64();
                        }

                        $imageData = base64_encode(@file_get_contents($image));
                        if($imageData){
                            $tvseires_src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                        }
                        
                      @endphp
                      @if($tvseires_src != null)
                        <img data-src="{{$tvseires_src}}" class="img-responsive actor_image lazy" alt="genre-image">
                        @if($item->tvseries->is_custom_label == 1)
                          @if(isset($item->tvseries->label_id))
                            <span class="badge bg-info">{{$item->tvseries->label->name}}</span>
                          @endif
                        @endif
                      
                      @endif
                    @endif
                  </div>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-9">
                  <div class="movie-series-section search-actor">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6">
                        <h5 class="movie-series-heading movie-series-name">
                          @if($item->type == 'M')
                            @if($auth && getSubscription()->getData()->subscribed == true)
                              <a href="{{url('movie/detail', $item->slug)}}">{{$item->title}}</a>
                            @else
                                <a href="{{url('movie/guest/detail', $item->slug)}}">{{$item->title}}</a>
                            @endif
                          @elseif($item->type == 'S')
                            @if($auth && getSubscription()->getData()->subscribed == true)
                              <a href="{{url('show/detail', $item->season_slug)}}">{{$item->tvseries->title}}</a>
                            @else
                              <a href="{{url('show/guest/detail', $item->season_slug)}}">{{$item->tvseries->title}}</a>
                            @endif
                          @endif
                        </h5>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6">
                        <ul class="movie-series-des-list">
                          <li>
                            @if($item->type == 'M')
                              @if($item->duration != NULL) {{$item->duration}} {{__('Mins')}}@endif
                            @else
                              {{__('Season')}} {{$item->season_no}} 
                            @endif
                          </li>
                        </ul>
                      </div>
                    </div>
                    <p>
                      @if($item->type == 'M')
                        {{str_limit($item->detail, 360)}}
                        @if($auth && getSubscription()->getData()->subscribed == true)
                          <a href="{{url('movie/detail', $item->slug)}}">{{__('Read More')}}</a>
                        @else
                            <a href="{{url('movie/guest/detail', $item->slug)}}">{{__('Read More')}}</a>
                        @endif

                      @else
                        @if ($item->detail != null || $item->detail != '')
                          {{str_limit($item->detail, 360)}}
                          @if($auth && getSubscription()->getData()->subscribed == true)
                            <a href="{{url('show/detail', $item->season_slug)}}">{{__('Read More')}}</a>
                          @else
                              <a href="{{url('show/guest/detail', $item->season_slug)}}">{{__('Read More')}}</a>
                          @endif
                        @else
                          {{str_limit($item->tvseries->detail, 360)}}
                          @if($auth && getSubscription()->getData()->subscribed == true)
                            <a href="{{url('show/detail', $item->season_slug)}}">{{__('Read More')}}</a>
                          @else
                              <a href="{{url('show/guest/detail', $item->season_slug)}}">{{__('Read More')}}</a>
                          @endif
                        @endif
                      @endif
                    </p>
                    <div class="des-btn-block des-in-list">
                      @if($auth && getSubscription()->getData()->subscribed == true)
                        @if($item->type == 'M' )
                          @if($item->is_upcoming != 1)
                            @if(checkInMovie($item) == true && isset($item->video_link))
                              @if($item->maturity_rating =='all age' || $age>=str_replace('+', '',$item->maturity_rating))
                                @if(isset($item->video_link['iframeurl']) && $item->video_link['iframeurl'] != null)
                                  <a href="{{route('watchmovieiframe',$item->id)}}"class="btn btn-play search-btn iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                                  </a>
                                @else 
                                  <a href="{{route('watchmovie', $item->id)}}" class="iframe btn btn-play search-btn"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                                  </a>
                                @endif
                              @else
                                <a onclick="myage({{$age}})" class="btn btn-play search-btn"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                                </a>
                              @endif
                            @endif
                          @endif
                          @if($item->trailer_url != null || $item->trailer_url != '')
                            <a href="{{ route('watchTrailer',$item->id) }}" class="iframe btn btn-default">{{__('Watch Trailer')}}</a>
                          @endif
                        @else
                          @if(isset($item->episodes[0]) && checkInTvseries($item) == true && isset($item->episodes[0]->video_link))
                            @if(isset($item->episodes[0]->video_link->iframeurl) && $item->episodes[0]->video_link->iframeurl !="")

                              <a href="#" onclick="playoniframe('{{ $item->episodes[0]->video_link->iframeurl }}','{{ $item->id }}','tv')" class="btn btn-play search-btn"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                              </a>

                            @else 
                              <a href="{{route('watchTvShow', $item->id)}}" class="iframe btn btn-play search-btn"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span></a>
                            @endif
                          @endif
                        @endif
                      
                        
                        @if($auth)
                          @if (isset($wishlist_check->added))
                              <a onclick="addWish({{$item->id}},'{{$item->type}}')" class="addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{$wishlist_check->added == 1 ? __('Rmove From Watchlist') : __('Add to Watchlist')}}</a>
                          @else
                            <a onclick="addWish({{$item->id}},'{{$item->type}}')" class="addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{__('Add to Watchlist')}}</a>
                            @endif
                        @endif
                      @else
                        <div class="des-btn-block des-in-list">
                          @if($item->trailer_url != null || $item->trailer_url != '')
                            <a href="{{ route('guestwatchtrailer',$item->id) }}" class="iframe btn btn-default">{{__('Watch Trailer')}}</a>
                          @endif
                        </div>
                      @endif
                    </div>
                  </div>
                </div>
               
              </div>
            </div>
          @endforeach
        @else
          <div class="container-fluid movie-series-section search-section">
            <div class="search-box">
              <h5 class="movie-series-heading text-center">{{__('Sorry, there are no data that matched your search request')}} </h5>
              <p class="text-center">{{__('Please try diffrent criteria such as actor, director and genre etc !')}}</p>
          
            </div>
          </div>
        @endif
      @endif
    </div>
  </section>
  <!-- end main wrapper -->
 



@endsection
@section('custom-script')
  <script>
  var app = new Vue({
    el: '.des-btn-block',
    data: {
      result: {
        id: '',
        type: '',
      },
    },
    methods: {
      addToWishList(id, type) {
        this.result.id = id;
        this.result.type = type;
        this.$http.post('{{route('addtowishlist')}}', this.result).then((response) => {
        }).catch((e) => {
          console.log(e);
        });
        this.result.item_id = '';
        this.result.item_type = '';
      }
    }
  });

    

    
    function playTrailer(url) {
      $('.video-player').css({
        "visibility" : "visible",
        "z-index" : "99999",
      });
      $('body').css({
        "overflow": "hidden"
      });
      $('#my_video').show();
      $('.vjs-control-bar').removeClass('hide-visible');
      let str = url;
      let youtube_slice_1 = str.slice(0, 14);
      let youtube_slice_2 = str.slice(0, 20);
      if (youtube_slice_1 == "https://youtu." || youtube_slice_2 == "https://www.youtube.")
      {
        $('.vjs-control-bar').addClass('hide-visible');
        player.src({ type: "video/youtube", src: url});
      } else {
        player.src({ type: "video/mp4", src: url});
      }

      setTimeout(function(){
        player.play();
      }, 300);
    }

    

    function addWish(id, type) {
      app.addToWishList(id, type);
      setTimeout(function() {
        $('.addwishlistbtn'+id+type).text(function(i, text){
          return text == "{{__('Add to Watchlist')}}" ? "{{__('Rmove From Watchlist')}}" : "{{__('Add to Watchlist')}}";
        });
      }, 100);
    }

</script>



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