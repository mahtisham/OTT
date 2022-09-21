@extends('layouts.theme')
@section('title',__('Kids'))
@section('main-wrapper')
<section id="wishlistelement" class="main-wrapper">
    <div>
        @if(isset($kids_home_slides) && count($kids_home_slides) > 0)
            <div id="home-main-block" class="home-main-block">
                <div id="home-slider-one" class="home-slider-one owl-carousel">
                    @foreach($kids_home_slides as $slide)
                    @if($slide->active == 1)
                        <div class="slider-block ">
                        <div class="slider-image">
                            @if(isset($slide->slide_image))  
                            @if($slide->movie_id != null)
                                @if(isset($auth) && getSubscription()->getData()->subscribed == true)

                                <a href="{{isset($slide->movie) && $slide->movie != NULL ? url('movie/detail', $slide->movie->slug) : '#'}}">
                                    @if ($slide->slide_image != null)
                                    @php
                                        $image = 'images/home_slider/movies/'. $slide->slide_image;
                                        // Read image path, convert to base64 encoding
                                        
                                        $imageData = base64_encode(@file_get_contents($image));
                                        if($imageData){
                                        // Format the image SRC:  data:{mime};base64,{data};
                                        $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                        }else{
                                        $src = '';
                                        }
                                    @endphp
                                    <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="slider-image">
                                    @elseif ($slide->movie->poster != null)
                                        @php
                                            $image = 'images/movies/posters/'. $slide->movie->poster;
                                        // Read image path, convert to base64 encoding
                                        
                                        $imageData = base64_encode(@file_get_contents($image));
                                        if($src){
                                        // Format the image SRC:  data:{mime};base64,{data};
                                        $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                        }else{
                                            $src = '';
                                            }
                                        @endphp
                                        <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="slider-image">
                                    @endif
                                </a>
                                @else
                                <a href="{{isset($slide->movie) && $slide->movie != NULL ? url('movie/guest/detail', $slide->movie->slug) : '#'}}">
                                    @if ($slide->slide_image != null)
                                    @php
                                        $image = 'images/home_slider/movies/'. $slide->slide_image;
                                        // Read image path, convert to base64 encoding
                                        
                                        $imageData = base64_encode(@file_get_contents($image));
                                        if($imageData){
                                        // Format the image SRC:  data:{mime};base64,{data};
                                        $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                        }else{
                                            $src = '';
                                        }
                                    @endphp
                                    <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="slider-image">
                                    @elseif ($slide->movie->poster != null)
                                    @php
                                        $image = 'images/movies/posters/'. $slide->movie->poster;
                                        // Read image path, convert to base64 encoding
                                        
                                        $imageData = base64_encode(@file_get_contents($image));
                                        if($src){
                                        // Format the image SRC:  data:{mime};base64,{data};
                                        $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                        }else{
                                            $src = '';
                                        }
                                    @endphp
                                    <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="slider-image">
                                    @endif
                                </a>
                                @endif
                            @elseif($slide->tv_series_id != null)
                                @if($auth && getSubscription()->getData()->subscribed == true)
                                <a href="{{isset($slide->tvseries->seasons[0]) && $slide->tvseries->seasons[0] != NULL ? url('show/detail', $slide->tvseries->seasons[0]->season_slug) : '#'}}">
                                    @if ($slide->slide_image != null)
                                    <img data-src="{{url('images/home_slider/shows/'. $slide->slide_image)}}" class="img-responsive owl-lazy" alt="slider-image">
                                    @elseif ($slide->tvseries->poster != null)
                                    <img data-src="{{url('images/tvseries/posters/'. $slide->tvseries->poster)}}" class="img-responsive owl-lazy" alt="slider-image">
                                    @endif
                                </a>
                                @else
                                <a href="{{isset($slide->tvseries->seasons[0]) && $slide->tvseries->seasons[0] != NULL ? url('show/guest/detail', $slide->tvseries->seasons[0]->season_slug) : '#'}}">
                                    @if ($slide->slide_image != null)
                                    <img data-src="{{url('images/home_slider/shows/'. $slide->slide_image)}}" class="img-responsive owl-lazy" alt="slider-image">
                                    @elseif ($slide->tvseries->poster != null)
                                    <img data-src="{{url('images/tvseries/posters/'. $slide->tvseries->poster)}}" class="img-responsive owl-lazy" alt="slider-image">
                                    @endif
                                </a>
                                @endif
                            @else
                                <a href="#">
                                @if ($slide->slide_image != null)
                                    <img data-src="{{url('images/home_slider/'. $slide->slide_image)}}" class="img-responsive owl-lazy" alt="slider-image">
                                @endif
                                </a>
                            @endif
                            @endif
                            
                        </div>
                        </div>
                    @endif
                    @endforeach
                </div>
            </div>
        @endif
    </div>





    
<!---------------- Recently Added Movies  in kids Start  ------------------>
@if(isset($kids_movies) && count($kids_movies) > 0)
<div class="genre-prime-block genre-prime-block-one genre-paddin-top genre-top-slider">
  <div class="container-fluid">
     <h5 class="section-heading">{{__('Movies for Kids')}}</h5>
        <div class="genre-prime-slider owl-carousel">
           @foreach($kids_movies as $m)
              @if($m->status == 1)
                @if($m->type == 'M')
                  @php
                    if($m->thumbnail != NULL){
                      $image = public_path() . '/images/movies/thumbnails/'.$m->thumbnail;
                    }else{
                      $image = Avatar::create($m->title)->toBase64();
                    }
                    // Read image path, convert to base64 encoding
                    $imageData = base64_encode(@file_get_contents($image));
                    if($imageData){
                        $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                    }else{
                        $src = Avatar::create($m->title)->toBase64();
                    }
                  @endphp
                  @if(hidedata($m->id,$m->type) != 1)
                  <div class="genre-prime-slide">
                    <div class="genre-slide-image home-prime-slider protip" data-pt-placement="outside" data-pt-title="#prime-mix-description-block{{$m->id}}" data-pt-interactive="false">
                      @if($auth && getSubscription()->getData()->subscribed == true)
                        <a href="{{url('movie/detail',$m->slug)}}">
                          @if($src)
                            <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                          @endif
                        </a>
                        <div class="hide-icon">
                          <a onclick="hideforme('{{$m->id}}','{{$m->type}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
                        </div>
                        @if(timecalcuate($auth->id,$m->id,$m->type) != 0)
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:{{timecalcuate($auth->id,$m->id,$m->type)}}%">
                          </div>
                        </div>
                        @endif
                      @endif
                      @if($m->is_custom_label == 1)
                        @if(isset($m->label_id))
                          <span class="badge bg-info">{{$m->label->name}}</span>
                        @endif
                      @endif
                    </div>

                    @if($protip == 1)

                    <div id="prime-mix-description-block{{$m->id}}" class="prime-description-block">
                      <h5 class="description-heading">{{$m->title}}</h5>
                      
                      <ul class="description-list">
                        <li>{{__('tmdb rating')}} {{$m->rating}}</li>
                        <li>{{$m->duration}} {{__('Mins')}}</li>
                        <li>{{$m->publish_year}}</li>
                        <li>{{$m->maturity_rating}}</li>
                       
                      </ul>
                      <div class="main-des">
                        <p>{{str_limit($m->detail,100,'...')}}</p>
                        @if($auth && getSubscription()->getData()->subscribed == true)
                          <a href="{{url('movie/detail',$m->slug)}}">{{__('Read More')}}</a>
                        @endif
                      </div>  
                      <div class="des-btn-block">
                       
                        @if($auth && getSubscription()->getData()->subscribed == true)
                          @if($m->is_upcoming == 0)
                          @if(checkInMovie($m) == true && isset($m->video_link))
                        
                              @if(isset($m->video_link['iframeurl']) && $m->video_link['iframeurl'] != null)
                              
                              <a href="{{route('watchmovieiframe',$m->id)}}"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                              </a>

                              @else
                                <a href="{{route('watchmovie',$m->id)}}" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                                </a>
                              @endif
                            @else
                            <a onclick="myage({{$age}})" class=" btn btn-play play-btn-icon"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span></a>
                              
                            @endif
                          
                        @endif
                          @if($m->trailer_url != null || $m->trailer_url != '')
                            <a class="iframe btn btn-default" href="{{ route('watchTrailer',$m->id) }}">{{__('Watch Trailer')}}</a>
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
      </div>
    </div> 
  @endif
<!------- Recently added movies in Kids End -------->


@if(isset($kids_recent_tv) && count($kids_recent_tv) > 0)
@php
$recentlyadded = [];

foreach ($kids_recent_tv as $key => $item) {
    
    $kids_rectvs =  App\TvSeries::
                  join('seasons','seasons.tv_series_id','=','tv_series.id')
                  ->join('episodes','episodes.seasons_id','=','seasons.id')
                  ->join('videolinks','videolinks.episode_id','=','episodes.id')
                  ->select('seasons.id as seasonid','tv_series.genre_id as genre_id','tv_series.id as id','tv_series.type as type','tv_series.status as status','tv_series.thumbnail as thumbnail','tv_series.title as title','tv_series.rating as rating','seasons.publish_year as publish_year','tv_series.maturity_rating as age_req','tv_series.detail as detail','seasons.season_no as season_no','videolinks.iframeurl as iframeurl','seasons.season_slug as season_slug','seasons.trailer_url as trailer_url','seasons.tmdb as tmdb','tv_series.is_custom_label as is_custom_label','tv_series.label_id as label_id')
                  ->where('tv_series.is_kids','=' ,1)
                  ->where('tv_series.id',$item->id)->first();
      
    $recentlyadded[] = $kids_rectvs;


}



$recentlyadded = array_values(array_filter($recentlyadded));

@endphp

<div class="genre-prime-block genre-prime-block-one genre-paddin-top genre-top-slider">
<div class="container-fluid">
     
  <h5 class="section-heading">{{__('Tv-Shows for Kids')}}</h5>
     
  <!-- Recently added movies and tv shows in list view End-->
    
      <div class="genre-prime-slider owl-carousel">
         @foreach($recentlyadded as $item)
            @php
             
                  $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();
            @endphp

            @if($item->status == 1)
              
              @if($item->type == 'T')
                  @php
                       $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                      // Read image path, convert to base64 encoding
                      
                      $imageData = base64_encode(@file_get_contents($image));
                      if($imageData){
                          $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                      }else{
                          $src = Avatar::create($item->title)->toBase64();
                      }
                  @endphp
                @if(hidedata($gets1->id,$gets1->type) != 1)
                 <div class="genre-prime-slide">
                    <div class="genre-slide-image home-prime-slider protip" data-pt-placement="outside" data-pt-title="#prime-mix-description-block{{$item->id}}{{$item->type}}">
                      @if($auth && getSubscription()->getData()->subscribed == true)
                        <a @if(isset($gets1)) href="{{url('show/detail',$gets1->season_slug)}}" @endif>
                          @if($src != null)
                            
                            <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                          @endif
                        </a>
                        <div class="hide-icon">
                          <a onclick="hideforme('{{$gets1->id}}','{{$gets1->type}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
                        </div>
                      @else
                        <a @if(isset($gets1)) href="{{url('show/guest/detail',$gets1->season_slug)}}" @endif>
                          @if($item->thumbnail != null)
                            <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                          @endif
                        </a>
                      @endif
                      @if($item->is_custom_label == 1)
                        @if(isset($item->label_id))
                          <span class="badge bg-info">{{$item->label->name}}</span>
                        @endif
                      @endif
                     
                    </div>
                    @if(isset($protip) && $protip == 1)
                    <div id="prime-mix-description-block{{$item->id}}{{$item->type}}" class="prime-description-block">
                      <h5 class="description-heading">{{$item->title}}</h5>
                      
                      <ul class="description-list">
                        <li>{{__('Tmdb Rating')}} {{$item->rating}}</li>
                        <li>{{__('Season')}} {{$item->season_no}}</li>
                        <li>{{$item->publish_year}}</li>
                        <li>{{$item->age_req}}</li>
                       
                      </ul>
                      <div class="main-des">
                        @if ($item->detail != null || $item->detail != '')
                          <p>{{str_limit($item->detail,100,'...')}}</p>
                        @else
                          <p>{{str_limit($item->detail,100,'...')}}</p>
                        @endif
                        @if($auth && getSubscription()->getData()->subscribed == true)
                          <a href="{{url('show/detail',$item->season_slug)}}">{{__('Read More')}}</a>
                        @else
                           <a href="{{url('show/guest/detail',$item->season_slug)}}">{{__('Read More')}}</a>
                        @endif
                      </div>
                     
                      <div class="des-btn-block">
                        @if($auth && getSubscription()->getData()->subscribed == true)
                          @if (isset($gets1->episodes[0]) && checkInTvseries($item) == true && isset($gets1->episodes[0]->video_link))
                              @if($gets1->episodes[0]->video_link['iframeurl'] !="")
                           
                                <a href="#" onclick="playoniframe('{{ $gets1->episodes[0]->video_link['iframeurl'] }}','{{ $gets1->episodes[0]->seasons->tvseries->id }}','tv')" class="btn btn-play"><span class= "play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                                </a>

                              @else
                                <a href="{{ route('watchTvShow',$gets1->id) }}" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span></a>
                              @endif
                          @endif
                          @if($gets1->trailer_url != null || $gets1->trailer_url != '')
                            <a href="{{ route('watchtvTrailer',$gets1->id)  }}" class="iframe btn btn-default">{{__('Watch Trailer')}}</a>
                          @endif
                        @else
                           @if($gets1->trailer_url != null || $gets1->trailer_url != '')
                            <a href="{{ route('guestwatchtvtrailer',$gets1->id)  }}" class="iframe btn btn-default">{{__('Watch Trailer')}}</a>
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
    
  <!-- Recently added movies and tv shows in list view End-->
   

  </div>
</div> 
@endif


@endsection

@section('custom-script')
<script>
 
      function myage(age){
        if (age==0) {
        $('#ageModal').modal('show'); 
      }else{
          $('#ageWarningModal').modal('show');
      }
    }
  
</script>

 
<script type="text/javascript">


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

    function addWish(id, type) {
      app.addToWishList(id, type);
      setTimeout(function() {
        $('.addwishlistbtn'+id+type).text(function(i, text){
          return text == "{{__('add to watchlist')}}" ? "{{ __('Remove From Watchlist') }}" : "{{__('Add to Watchlist')}}";
        });
      }, 100);
    }
  </script> 

  @endsection