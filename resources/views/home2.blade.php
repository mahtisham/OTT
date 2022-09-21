@extends('layouts.theme')
@section('title',"$menu->name")
@section('main-wrapper')

@php
 $age = AgeHelper::getage();
@endphp
  <!-- main wrapper  slider -->
  <section id="wishlistelement" class="main-wrapper home-two">

    <div>
      @if(isset($home_slides) && count($home_slides) > 0)
      <div id="home-main-block" class="home-main-block">
        <div id="home-slider-one" class="home-slider-one owl-carousel">
          @foreach($home_slides as $slide)
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

 
  <!-- Age -->
  @include('modal.agemodal')
  <!-- Age warning -->
  @include('modal.agewarning')


@if(count($menu->menusections)>0)

  @foreach($menu->menusections as $section)
        @php
            $recentlyadded = [];
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //$ipaddress = '43.251.92.73';
            $ipaddress = $request->getClientIp();
            $geoip = geoip()->getLocation($ipaddress);
            $usercountry = strtoupper($geoip->country);
        
            foreach ($recent_data as $key => $item) {
              
                $rm =  \DB::table('movies')
                             ->select('movies.id as id','movies.title as title','movies.type as type','movies.status as status','movies.genre_id as genre_id','movies.thumbnail as thumbnail','movies.live as live','movies.slug as slug','movies.tmdb as tmdb','movies.is_custom_label as is_custom_label','movies.label_id as label_id')
                             ->where('movies.is_upcoming','!=' ,1)
                             ->where('movies.is_kids','!=' ,1)
                             ->where('movies.country', 'NOT like', '%'.$usercountry.'%')
                             ->where('movies.id',$item->movie_id)->first();
                  
                $recentlyadded[] = $rm;

                
                if($section->order == 1){
                  arsort($recentlyadded);
                }
               

                if(count($recentlyadded) == $section->item_limit){
                    break;
                    exit(1);
                }
            }
          }

          if ($_SERVER["REQUEST_METHOD"] == "POST") {
          //$ipaddress = '43.251.92.73';
          $ipaddress = $request->getClientIp();
          $geoip = geoip()->getLocation($ipaddress);
          $usercountry = strtoupper($geoip->country);
          
            foreach ($recent_data as $key => $item) {
                
                $rectvs =  \DB::table('tv_series')
                              ->join('seasons','seasons.tv_series_id','=','tv_series.id')
                              ->select('seasons.id as seasonid','tv_series.genre_id as genre_id','tv_series.id as id','tv_series.type as type','tv_series.status as status','tv_series.title as title','tv_series.thumbnail as thumbnail','seasons.season_slug as season_slug','seasons.tmdb as tmdb','tv_series.is_custom_label as is_custom_label','tv_series.label_id as label_id')
                              ->where('tv_series.is_kids','!=' ,1)
                              ->where('tv_series.country', 'NOT like', '%'.$usercountry.'%')
                              ->where('tv_series.id',$item->tv_series_id)->first();
                  
                $recentlyadded[] = $rectvs;

                if($section->order == 1){
                  arsort($recentlyadded);
                }
                
                if(count($recentlyadded) == $section->item_limit){
                    break;
                    exit(1);
                }

            }
            
          } 

            $recentlyadded = array_values(array_filter($recentlyadded));
            
        @endphp
     
        @if($section->section_id == 1 && $recentlyadded != NULL && count($recentlyadded)>0)
        <div class="genre-main-block">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-3 col-sm-5">
                <div class="genre-dtl-block">
                 
                  <h5 class="section-heading">{{__('Recently Added In')}} {{ $menu->name }}</h5>
                  <p class="section-dtl">{{__('at the big screen at home')}}</p>
                  @if($auth && getSubscription()->getData()->subscribed == true)
                    
                    <a href="{{ route('showall',['menuid' => $menu->id, 'menuname' => $menu->name]) }}" class="see-more"> <b>{{__('view all')}}</b></a>
           
                  @else
                    
                    <a href="{{ route('guestshowall',['menuid' => $menu->id, 'menuname' => $menu->name]) }}" class="see-more"> <b>{{__('view all')}}</b></a>
             
                  @endif
                </div>
              </div>
              <!-- Recently added movies and tv shows in list view End-->
                  @if($section->view == 1)
                    <div class="col-md-9 col-sm-7">
                      <div class="genre-main-slider owl-carousel">
                       @foreach($recentlyadded as $item)
                        @if($item->status == 1)

                          @if($item->type == 'M')
                         
                            @php
                              if(isset($auth) && $auth != NULL){
                                $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                                  ['user_id', '=', $auth->id],
                                                                                  ['movie_id', '=', $item->id],
                                                                      ])->first();
                            
                              }

                              $image = public_path() . '/images/movies/thumbnails/'.$item->thumbnail;
                              // Read image path, convert to base64 encoding
                              
                              $imageData = base64_encode(@file_get_contents($image));
                              if($imageData){
                                  $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                              }else{
                                  $src = Avatar::create($item->title)->toBase64();
                              }
                              
                            @endphp
                            
                            @if(hidedata($item->id,$item->type) != 1)
                              <div class="genre-slide">
                                <div class="genre-slide-image genre-image  home-prime-slider progress-movie">
                                  @if($auth && getSubscription()->getData()->subscribed == true)
                                    <a href="{{url('movie/detail',$item->slug)}}">
                                      @if($src)
                                        <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                      @endif
                                    </a>
                                    <div class="hide-icon hide-icon-two">
                                      <a onclick="hideforme('{{$item->id}}','{{$item->type}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
                                    </div>
                                    @if(timecalcuate($auth->id,$item->id,$item->type) != 0)
                                      <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:{{timecalcuate($auth->id,$item->id,$item->type)}}%">
                                        </div>
                                      </div>
                                    @endif
                                  @else
                                    <a href="{{url('movie/guest/detail',$item->slug)}}">
                                      @if($src)
                                        <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                      @endif
                                    </a>
                                  @endif
                                 
                                  @if($item->is_custom_label == 1 && isset($item->label))
                                    @if(isset($item->label_id) && $item->label_id != NULL)
                                      <span class="badge bg-info">{{$item->label->name}}</span>
                                    @endif
                                  @endif
                                 
                                </div>
                                <div class="genre-slide-dtl">
                                  <h5 class="genre-dtl-heading">
                                  @if($auth && getSubscription()->getData()->subscribed == true)
                                    <a href="{{url('movie/detail/'.$item->slug)}}">{{$item->title}}</a>
                                  @else
                                    <a href="{{url('movie/guest/detail/'.$item->slug)}}">{{$item->title}}</a>
                                  @endif
                                  </h5>
                                </div>
                              </div>
                            @endif
                            @elseif($item->type == 'T')
                              
                            
                              @php
                                if(isset($auth) && $auth != NULL){

                                  $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();

                                  if (isset($gets1)) {


                                    $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                                ['user_id', '=', $auth->id],
                                                                                ['season_id', '=', $gets1->id],
                                      ])->first();


                                  }

                                }
                                else{
                                  $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();
                                }
                                if($item->thumbnail != NULL){
                                  $image = public_path() . '/images/tvseries/thumbnails/'.$item->thumbnail;
                                }else{
                                  if($gets1->thumbnail != NULL){
                                    $image = public_path() . '/images/tvseries/thumbnails/'.$gets1->thumbnail;
                                  }
                                }
                                  
                                // Read image path, convert to base64 encoding
                                
                                $imageData = base64_encode(@file_get_contents($image));
                                if($imageData){
                                    $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                }else{
                                    $src = Avatar::create($item->title)->toBase64();
                                }
                              @endphp
                              
                               @if(hidedata($gets1->id,$gets1->type) != 1)
                               <div class="genre-slide">
                                  <div class="genre-slide-image genre-image  home-prime-slider progress-movie">
                                      @if($auth && getSubscription()->getData()->subscribed == true)
                                      <a @if(isset($gets1)) href="{{url('show/detail',$gets1->season_slug)}}" @endif>
                                        @if($item->thumbnail != null)
                                          
                                          <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                       
                                        @endif
                                      </a>
                                      <div class="hide-icon  hide-icon-two">
                                        <a onclick="hideforme('{{$gets1->id}}','{{$gets1->type}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
                                      </div>
                                    
                                      @else
                                        <a @if(isset($gets1)) href="{{url('show/guest/detail',$gets1->season_slug)}}" @endif>
                                          @if($item->thumbnail != null)
                                            <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                        
                                          @endif
                                        </a>
                                      @endif 
                                      
                                      @if(isset($item->label) && $item->is_custom_label == 1)
                                        @if(isset($item->label_id))
                                          <span class="badge bg-info">{{$item->label->name}}</span>
                                        @endif
                                      @endif
                                  </div>
                                  
                                  <div class="genre-slide-dtl">
                                     @if($auth && getSubscription()->getData()->subscribed == true)
                                      <h5 class="genre-dtl-heading"><a href="{{url('show/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                      @else
                                       <h5 class="genre-dtl-heading"><a href="{{url('show/guest/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                      @endif
                                  </div>  
                               </div>
                               @endif
                            @endif
                          @endif
                       @endforeach 
                      
                      </div>
                    </div>
                  @endif
              <!-- Recently added movies and tv shows in list view End-->
              
               <!-- Recently Tvshows and movies in Grid view -->
                  @if($section->view == 0)
                      <div class="col-md-9">
                        <div class="cus_img">
                          @foreach($recentlyadded as $item)
                             @php
                               if(isset($auth) && $auth != NULL){


                                 if ($item->type == 'M') {
                                  $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                                    ['user_id', '=', $auth->id],
                                                                                    ['movie_id', '=', $item->id],
                                                                                  ])->first();
                                }
                                 }

                                 if(isset($auth) && $auth != NULL){

                                    $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();

                                    if (isset($gets1)) {


                                      $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                                  ['user_id', '=', $auth->id],
                                                                                  ['season_id', '=', $gets1->id],
                                        ])->first();


                                      }

                                    }
                                    else{
                                       $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();
                                    }
                              @endphp
                              @if($item->status == 1)
                                @if($item->type == 'M')
                                @php
                                 $image =  public_path() .'/images/movies/thumbnails/'.$item->thumbnail;
                                // Read image path, convert to base64 encoding
                                
                                $imageData = base64_encode(@file_get_contents($image));
                                if($imageData){
                                // Format the image SRC:  data:{mime};base64,{data};
                                $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                }else{
                                    $src = Avatar::create($item->title)->toBase64();
                                }
                            @endphp
                                @if(hidedata($item->id,$item->type) != 1)
                                  <div class="col-lg-3 col-md-9 col-xs-6 col-sm-6">
                                      <div class="genre-slide-image genre-grid home-prime-slider progress-movie genre-image">
                                          @if($auth && getSubscription()->getData()->subscribed == true)
                                            <a href="{{url('movie/detail',$item->slug)}}">
                                            @if($src)
                                              <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                            @else
                                              <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                            @endif
                                           </a>
                                            <div class="hide-icon hide-icon-two">
                                              <a onclick="hideforme('{{$item->id}}','{{$item->type}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
                                            </div>
                                           @if(timecalcuate($auth->id,$item->id,$item->type) != 0)
                                            <div class="progress">
                                              <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:{{timecalcuate($auth->id,$item->id,$item->type)}}%">
                                              </div>
                                            </div>
                                            @endif
                                          @else
                                             <a href="{{url('movie/guest/detail',$item->slug)}}">
                                              @if($src)
                                                <img data-src="{{$src}}" class="img-responsive lazy" alt="genre-image">
                                              @else
                                                <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                              @endif
                                            </a>

                                          @endif
                                            @if($item->is_custom_label == 1)
                                              @if(isset($item->label_id))
                                                <span class="badge bg-info">{{$item->label->name}}</span>
                                              @endif
                                            @endif
                                            
                                       </div>
                                        <div class="genre-slide-dtl">
                                          <h5 class="genre-dtl-heading">
                                             @if($auth && getSubscription()->getData()->subscribed == true)
                                            <a href="{{url('movie/detail/'.$item->slug)}}">{{$item->title}}</a>
                                            @else
                                            <a href="{{url('movie/guest/detail/'.$item->slug)}}">{{$item->title}}</a>

                                            @endif
                                          </h5>
                                        </div>
                                  </div>
                                @endif
                                @elseif($item->type == 'T')
                                @php
                                    $image = public_path() . '/images/tvseries/thumbnails/'.$item->thumbnail;
                                    // Read image path, convert to base64 encoding
                                    
                                    $imageData = base64_encode(@file_get_contents($image));
                                    if($imageData){
                                    // Format the image SRC:  data:{mime};base64,{data};
                                    $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                    }else{
                                        $src =Avatar::create($item->title)->toBase64();
                                    }
                                @endphp
                                  @if(hidedata($gets1->id,$gets1->type) != 1)
                                   <div class="col-lg-3 col-md-9 col-xs-6 col-sm-6">
                                      <div class="genre-slide-image genre-grid home-prime-slider progress-movie genre-image">
                                         @if($auth && getSubscription()->getData()->subscribed == true)
                                          <a @if(isset($gets1)) href="{{url('show/detail',$gets1->season_slug)}}" @endif>
                                            @if($src)
                                              
                                              <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                            
                                            @endif
                                          </a>
                                          <div class="hide-icon hide-icon-two">
                                            <a onclick="hideforme('{{$gets1->id}}','{{$gets1->type}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
                                          </div>
                                        
                                        @else
                                           <a @if(isset($gets1)) href="{{url('show/guest/detail',$gets1->season_slug)}}" @endif>
                                            @if($src)
                                              <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                           
                                            @endif
                                          </a>
                                        @endif
                                         @if($item->is_custom_label == 1)
                                            @if(isset($item->label_id))
                                              <span class="badge bg-info">{{$item->label->name}}</span>
                                            @endif
                                          @endif
                                      </div>
                                      <div class="genre-slide-dtl">
                                          @if($auth && getSubscription()->getData()->subscribed == true)
                                          <h5 class="genre-dtl-heading"><a href="{{url('show/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                          @else
                                           <h5 class="genre-dtl-heading"><a href="{{url('show/guest/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                          @endif
                                      </div>
                                  </div>
                                  @endif
                                @endif
                              @endif
                          @endforeach
                        </div>
                      </div>
                  @endif
              <!-- Recently Tvshows and movies in Grid view END-->
               
            </div> 
         </div>
        </div>

        
  

        @endif
      
  @endforeach
      
  @foreach($menu->menusections as $section)
  
  <!-- Featured Movies and TvShows -->
        @php
            $featuresitems = [];
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //$ipaddress = '43.251.92.73';
            $ipaddress = $request->getClientIp();
            $geoip = geoip()->getLocation($ipaddress);
            $usercountry = strtoupper($geoip->country);
            foreach ($menu_data as $key => $item) {
                
                $fmovie =  \DB::table('movies')
                             ->select('movies.id as id','movies.title as title','movies.type as type','movies.status as status','movies.genre_id as genre_id','movies.thumbnail as thumbnail','movies.slug as slug','movies.tmdb as tmdb','movies.is_custom_label as is_custom_label','movies.label_id as label_id')
                             ->where('movies.is_upcoming','!=' ,1)
                             ->where('movies.is_kids','!=' ,1)
                             ->where('movies.country', 'NOT like', '%'.$usercountry.'%')
                             ->where('movies.id',$item->movie_id)->where('featured', '1')->first();
                if($fmovie){
                  $featuresitems[] = $fmovie;
                }
                 

                if($section->order == 1){
                  arsort($featuresitems);
                }

                if(count($featuresitems) == $section->item_limit){
                    break;
                    exit();
                }


            }
          }

          if ($_SERVER["REQUEST_METHOD"] == "POST") {
          //$ipaddress = '43.251.92.73';
          $ipaddress = $request->getClientIp();
          $geoip = geoip()->getLocation($ipaddress);
          $usercountry = strtoupper($geoip->country);

            foreach ($menu_data as $key => $item) {
               $ftvs =  \DB::table('tv_series')
                              ->join('seasons','seasons.tv_series_id','=','tv_series.id')
                              ->select('seasons.id as seasonid','tv_series.genre_id as genre_id','tv_series.id as id','tv_series.type as type','tv_series.status as status','tv_series.title as title','tv_series.thumbnail as thumbnail','seasons.season_slug as season_slug','seasons.tmdb as tmdb','tv_series.is_custom_label as is_custom_label','tv_series.label_id as label_id')
                              ->where('tv_series.is_kids','!=' ,1)
                              ->where('tv_series.country', 'NOT like', '%'.$usercountry.'%')
                              ->where('tv_series.id',$item->tv_series_id)->where('tv_series.featured','1')->first();
                if($ftvs){
                  $featuresitems[] = $ftvs;
                }
                

                if($section->order == 1){
                  arsort($featuresitems);
                }
                
                if(count($featuresitems) == $section->item_limit+1){
                    break;
                    exit();
                }

            }
          }

            $featuresitems = array_values(array_filter($featuresitems));
            
        @endphp


         @if($section->section_id == 3 && $featuresitems != NULL && count($featuresitems)>0)
           <div class="genre-main-block">
              <div class="container-fluid">
               
                <div class="row">
                  <div class="col-md-3 col-sm-5">
                    <div class="genre-dtl-block">
                        <h5 class="section-heading">{{__('Featured In')}} {{ $menu->name }}</h5>
                         <p class="section-dtl">{{__('at the big screen at home')}}</p>
                          <!-- Featured Tvshows and movies in List view -->
                    </div>
                  </div>
                  @if($section->view == 1)
                    <div class="col-md-9 col-sm-7">
                      <div class="genre-main-slider owl-carousel">
                       @foreach($featuresitems as $item)
                           @php
                           if(isset($auth) && $auth != NULL){


                             if ($item->type == 'M') {
                              $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                                ['user_id', '=', $auth->id],
                                                                                ['movie_id', '=', $item->id],
                                                                              ])->first();
                            }
                             }

                             if(isset($auth) && $auth != NULL){

                                $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();

                                if (isset($gets1)) {


                                  $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                              ['user_id', '=', $auth->id],
                                                                              ['season_id', '=', $gets1->id],
                                    ])->first();


                                  }

                                }
                                else{
                                   $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();
                                }
                          @endphp

                          @if($item->status == 1)
                            @if($item->type == 'M')
                            @php
                               $image = 'images/movies/thumbnails/'.$item->thumbnail;
                              // Read image path, convert to base64 encoding
                            
                              $imageData = base64_encode(@file_get_contents($image));
                              if($imageData){
                              // Format the image SRC:  data:{mime};base64,{data};
                              $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                              }else{
                                  $src = Avatar::create($item->title)->toBase64();
                              }
                            @endphp
                              @if(hidedata($item->id,$item->type) != 1)
                              <div class="genre-slide">
                                <div class="genre-slide-image genre-image  home-prime-slider progress-movie">
                                  @if($auth && getSubscription()->getData()->subscribed == true)
                                  <a href="{{url('movie/detail',$item->slug)}}">
                                    @if($src)
                                      <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                    @endif
                                  </a>
                                  <div class="hide-icon  hide-icon-two">
                                    <a onclick="hideforme('{{$item->id}}','{{$item->type}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
                                  </div>
                                  @if(timecalcuate($auth->id,$item->id,$item->type) != 0)
                                  <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:{{timecalcuate($auth->id,$item->id,$item->type)}}%">
                                    </div>
                                  </div>
                                  @endif
                                  @else
                                    <a href="{{url('movie/guest/detail',$item->slug)}}">
                                    @if($src)
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
                                <div class="genre-slide-dtl">
                                  <h5 class="genre-dtl-heading">
                                     @if($auth && getSubscription()->getData()->subscribed == true)
                                  <a href="{{url('movie/detail/'.$item->slug)}}">{{$item->title}}</a>
                                  @else
                                  <a href="{{url('movie/guest/detail/'.$item->slug)}}">{{$item->title}}</a>
                                    @endif
                                  </h5>
                                </div>
                              </div>
                              @endif
                            @elseif($item->type == 'T')
                            
                              @php
                              if($item->thumbnail != NULL){
                                $image = '/images/tvseries/thumbnails/'.$item->thumbnail;
                              }else{
                                $image = '/images/tvseries/thumbnails/'.$gets1->thumbnail;
                              }
                               
                                // Read image path, convert to base64 encoding
                              
                                $imageData = base64_encode(@file_get_contents($image));
                                if($imageData != NULL){
                                // Format the image SRC:  data:{mime};base64,{data};
                                $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                }else{
                                    $src = Avatar::create($item->title)->toBase64();
                                }
                              @endphp
                               @if(hidedata($gets1->id,$gets1->type) != 1)
                              <div class="genre-slide">
                                <div class="genre-slide-image genre-image home-prime-slider">
                                    @if($auth && getSubscription()->getData()->subscribed == true)
                                    <a @if(isset($gets1)) href="{{url('show/detail',$gets1->season_slug)}}" @endif>
                                      @if($src != null)
                                        
                                        <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                      @endif
                                    </a>
                                    <div class="hide-icon  hide-icon-two">
                                      <a onclick="hideforme('{{$gets1->id}}','{{$gets1->type}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
                                    </div>
                                    @else
                                     <a @if(isset($gets1)) href="{{url('show/guest/detail',$gets1->season_slug)}}" @endif>
                                      @if($src != null)
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
                                
                                <div class="genre-slide-dtl">
                                   @if($auth && getSubscription()->getData()->subscribed == true)
                                    <h5 class="genre-dtl-heading"><a href="{{url('show/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                    @else
                                     <h5 class="genre-dtl-heading"><a href="{{url('show/guest/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                    @endif
                                </div>  
                             </div>
                             @endif
                            @endif
                          @endif
                       @endforeach 
                      </div>
                    </div>
                  @endif
                  <!-- Featured Tvshows and movies in List view END -->

                  <!-- Featured Tvshows and movies in Grid view -->
                  @if($section->view == 0)
                      <div class="col-md-9">
                        <div class="cus_img">
                          @foreach($featuresitems as $item)
                             @php
                               if(isset($auth) && $auth != NULL){


                                 if ($item->type == 'M') {
                                  $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                                    ['user_id', '=', $auth->id],
                                                                                    ['movie_id', '=', $item->id],
                                                                                  ])->first();
                                }
                                 }

                                 if(isset($auth) && $auth != NULL){

                                    $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();

                                    if (isset($gets1)) {


                                      $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                                  ['user_id', '=', $auth->id],
                                                                                  ['season_id', '=', $gets1->id],
                                        ])->first();


                                      }

                                    }
                                    else{
                                       $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();
                                    }
                              @endphp
                              @if($item->status == 1)
                                @if($item->type == 'M')
                                @php
                                   $image = 'images/movies/thumbnails/'.$item->thumbnail;
                                  // Read image path, convert to base64 encoding
                                
                                  $imageData = base64_encode(@file_get_contents($image));
                                  if($imageData){
                                  // Format the image SRC:  data:{mime};base64,{data};
                                  $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                  }else{
                                      $src = Avatar::create($item->title)->toBase64();
                                  }
                                @endphp
                                @if(hidedata($item->id,$item->type) != 1)
                                <div class="col-lg-3 col-md-9 col-xs-6 col-sm-6">
                                  <div class="genre-slide-image genre-grid home-prime-slider progress-movie genre-image">
                                    @if($auth && getSubscription()->getData()->subscribed == true)
                                      <a href="{{url('movie/detail',$item->slug)}}">
                                      @if($src)
                                        <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                     
                                      @endif
                                     </a>
                                     <div class="hide-icon hide-icon-two">
                                      <a onclick="hideforme('{{$item->id}}','{{$item->type}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
                                    </div>
                                     @if(timecalcuate($auth->id,$item->id,$item->type) != 0)
                                    <div class="progress">
                                      <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:{{timecalcuate($auth->id,$item->id,$item->type)}}%">
                                      </div>
                                    </div>
                                    @endif
                                    @else
                                       <a href="{{url('movie/guest/detail',$item->slug)}}">
                                        @if($src)
                                          <img data-src="{{$src}}" class="img-responsive lazy" alt="genre-image">
                                        
                                        @endif
                                      </a>
                                    @endif
                                    @if($item->is_custom_label == 1)
                                      @if(isset($item->label_id))
                                        <span class="badge bg-info">{{$item->label->name}}</span>
                                      @endif
                                    @endif
                                     
                                  
                                  </div>
                                  <div class="genre-slide-dtl">
                                    <h5 class="genre-dtl-heading">
                                       @if($auth && getSubscription()->getData()->subscribed == true)
                                      <a href="{{url('movie/detail/'.$item->slug)}}">{{$item->title}}</a>
                                      @else
                                      <a href="{{url('movie/guest/detail/'.$item->slug)}}">{{$item->title}}</a>

                                      @endif
                                    </h5>
                                  </div>
                                </div>
                                @endif
                                @elseif($item->type == 'T')
                                @php
                                   $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                                  // Read image path, convert to base64 encoding
                                
                                  $imageData = base64_encode(@file_get_contents($image));
                                  if($imageData){
                                  // Format the image SRC:  data:{mime};base64,{data};
                                  $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                  }else{
                                      $src = Avatar::create($item->title)->toBase64();
                                  }
                                @endphp
                                 @if(hidedata($gets1->id,$gets1->type) != 1)
                                  <div class="col-lg-3 col-md-9 col-xs-6 col-sm-6">
                                      <div class="genre-slide-image genre-grid home-prime-slider progress-movie genre-image">
                                         @if($auth && getSubscription()->getData()->subscribed == true)
                                          <a @if(isset($gets1)) href="{{url('show/detail',$gets1->season_slug)}}" @endif>
                                            @if($src)
                                              <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                            
                                            @endif
                                          </a>
                                          <div class="hide-icon hide-icon-two">
                                            <a onclick="hideforme('{{$gets1->id}}','{{$gets1->type}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
                                          </div>
                                          @else
                                           <a @if(isset($gets1)) href="{{url('show/guest/detail',$gets1->season_slug)}}" @endif>
                                            @if($src)
                                              <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                           
                                            @endif
                                          </a>
                                          @endif
                                          @if($item->is_custom_label == 1)
                                            @if(isset($item->label_id))
                                              <span class="badge bg-info">{{$item->label->name}}</span>
                                            @endif
                                          @endif
                                      </div>
                                      <div class="genre-slide-dtl">
                                          @if($auth && getSubscription()->getData()->subscribed == true)
                                          <h5 class="genre-dtl-heading"><a href="{{url('show/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                          @else
                                           <h5 class="genre-dtl-heading"><a href="{{url('show/guest/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                          @endif
                                      </div>
                                  </div>
                                  @endif
                                @endif
                              @endif
                          @endforeach
                        </div>
                      </div>
                  @endif
                 <!-- Featured Tvshows and movies in Grid view END-->
                      
                </div>
              </div>
            </div> 
         @endif
       
     
 
   <!-- Featured Tv Shows and Movies end-->
  @endforeach

<!--Based on intrest Movies and TvShows -->
  @if(Auth::user() && $auth != NULL &&  getSubscription()->getData()->subscribed == true)

    @foreach($menu->menusections as $section)
            @php
         
          $watchistory_last_movie=App\WatchHistory::where('user_id',$auth->id)->orderBy('id','DESC')->where('movie_id','!=',NULL)->take(3)->get();

          $watchistory_last_tv=App\WatchHistory::where('user_id',$auth->id)->orderBy('id','DESC')->where('tv_id','!=',NULL)->take(3)->get();

          $customGenreMovie = [];
          $customGenreTv = [];

          foreach ($watchistory_last_movie as $key => $w) {
             $movie_find_last = App\Movie::where('id','=',$w->movie_id)->where('is_kids',0)->first();
             if(isset($movie_find_last)){
              $customGenreMovie[] = $movie_find_last->genre_id;
             }
          }

          foreach ($watchistory_last_tv as $key => $k) {
             $tv_show = App\TvSeries::where('id','=',$k->tv_id)->where('is_kids',0)->first();
             if(isset($tv_show)){
              $customGenreTv[] = $tv_show->genre_id;
             }
          }
         

       

        $customGenreMovie =  array_unique($customGenreMovie);
        $customGenreTv =  array_unique($customGenreTv);

       
        
        $recom_block = collect();

        $customGenreMovie =  array_unique($customGenreMovie);
        $customGenreTv =  array_unique($customGenreTv);

       
       
        //Getting Recommnaded Movies based on genre
        foreach ($customGenreMovie as $key => $g) {
          $x = App\Movie::orderBy('id','DESC')->where('is_kids',0)->where('genre_id', 'LIKE', '%' . $g . '%')->take(50)->get();
           $recom_block->push($x);
           
        }
       
        //Getting Recommnaded Tv Series based on genre
        foreach ($customGenreTv as $key => $g) {
             $y =App\TvSeries::orderBy('id','DESC')->where('is_kids',0)->where('genre_id', 'LIKE', '%' . $g . '%')->take(50)->get();
             $recom_block->push($y);
          }
        
        $recom_block = $recom_block->flatten();

            
        @endphp
         
        @if($section->section_id == 4 && $recom_block != NULL && count($recom_block)>0)
           <div class="genre-main-block">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-3 col-sm-5">
                    <div class="genre-dtl-block">
                      @php
                         $watch = App\WatchHistory::OrderBy('id','DESC')->first();
                         $movie = App\Movie::where('id',$watch->movie_id)->first();
                         $tv = App\TvSeries::where('id',$watch->tv_id)->first();
                      @endphp
                        @if(isset($movie))
                          <h5 class="section-heading">{{__('Because you watched')}}: {{isset($movie->title) ?ucfirst($movie->title) : ''}}</h5>
                          <p class="section-dtl">{{__('at the bigs creen at home')}}</p>
                        @else
                          <h5 class="section-heading">{{__('Because you watched')}} : {{isset($tv->title) ? ucfirst($tv->title) : ''}}</h5>
                          <p class="section-dtl">{{__('at the big screen at home')}}</p>
                        @endif
                          <!-- Based on intrest tvseries and movies in List view -->
                    </div>
                  </div>
                  @if($section->view == 1)
                    <div class="col-md-9 col-sm-7">
                      <div class="genre-main-slider owl-carousel">
                       @foreach($recom_block as $item)
                           @php
                           if(isset($auth) && $auth != NULL){


                             if ($item->type == 'M') {
                              $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                                ['user_id', '=', $auth->id],
                                                                                ['movie_id', '=', $item->id],
                                                                              ])->first();
                            }
                             }

                             if(isset($auth) && $auth != NULL){

                                $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();

                                if (isset($gets1)) {


                                  $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                              ['user_id', '=', $auth->id],
                                                                              ['season_id', '=', $gets1->id],
                                    ])->first();


                                  }

                                }
                                else{
                                   $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();
                                }
                          @endphp

                          @if($item->status == 1)
                            @if($item->type == 'M')
                            @php
                               $image = 'images/movies/thumbnails/'.$item->thumbnail;
                              // Read image path, convert to base64 encoding
                            
                              $imageData = base64_encode(@file_get_contents($image));
                              if($imageData){
                              // Format the image SRC:  data:{mime};base64,{data};
                              $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                              }else{
                                  $src = Avatar::create($item->title)->toBase64();
                              }
                            @endphp
                              @if(isset($item) && hidedata($item->id,$item->type) != 1)
                              <div class="genre-slide">
                                <div class="genre-slide-image genre-image home-prime-slider progress-movie ">
                                  @if($auth && getSubscription()->getData()->subscribed == true)
                                  <a href="{{url('movie/detail',$item->slug)}}">
                                    @if($src)
                                      <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                    
                                    @endif
                                  </a>
                                  <div class="hide-icon hide-icon-two">
                                    <a onclick="hideforme('{{$item->id}}','{{$item->type}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
                                  </div>
                                  @if(timecalcuate($auth->id,$item->id,$item->type) != 0)
                                  <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:{{timecalcuate($auth->id,$item->id,$item->type)}}%">
                                    </div>
                                  </div>
                                  @endif
                                  @else
                                    <a href="{{url('movie/guest/detail',$item->slug)}}">
                                    @if($src)
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
                                <div class="genre-slide-dtl">
                                  <h5 class="genre-dtl-heading">
                                  @if($auth && getSubscription()->getData()->subscribed == true)
                                    <a href="{{url('movie/detail/'.$item->slug)}}">{{$item->title}}</a>
                                  @else
                                    <a href="{{url('movie/guest/detail/'.$item->slug)}}">{{$item->title}}</a>
                                    @endif
                                  </h5>
                                </div>
                              </div>
                              @endif
                            @elseif($item->type == 'T')
                            
                              @php
                                 $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                                // Read image path, convert to base64 encoding
                              
                                $imageData = base64_encode(@file_get_contents($image));
                                if($imageData){
                                // Format the image SRC:  data:{mime};base64,{data};
                                $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                }else{
                                    $src = Avatar::create($item->title)->toBase64();
                                }
                              @endphp
                               @if(isset($gets1) && hidedata($gets1->id,$gets1->type) != 1)
                              <div class="genre-slide">
                                <div class="genre-slide-image genre-image home-prime-slider progress-movie genre-image">
                                    @if($auth && getSubscription()->getData()->subscribed == true)
                                    <a @if(isset($gets1)) href="{{url('show/detail',$gets1->season_slug)}}" @endif>
                                      @if($item->thumbnail != null)
                                        
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
                                
                                <div class="genre-slide-dtl">
                                   @if($auth && getSubscription()->getData()->subscribed == true)
                                    <h5 class="genre-dtl-heading"><a href="{{url('show/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                    @else
                                     <h5 class="genre-dtl-heading"><a href="{{url('show/guest/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                    @endif
                                </div>  
                             </div>
                             @endif
                            @endif
                          @endif
                       @endforeach 
                      </div>
                    </div>
                  @endif
                  <!-- Based on intrest tvseries and movies in List view END -->

                  <!-- Based on intrest tvseries and movies in Grid view -->
                  @if($section->view == 0)
                      <div class="col-md-9">
                        <div class="cus_img">
                          @foreach($recom_block as $item)
                             @php
                               if(isset($auth) && $auth != NULL){


                                 if ($item->type == 'M') {
                                  $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                                    ['user_id', '=', $auth->id],
                                                                                    ['movie_id', '=', $item->id],
                                                                                  ])->first();
                                }
                                 }

                                 if(isset($auth) && $auth != NULL){

                                    $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();

                                    if (isset($gets1)) {


                                      $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                                  ['user_id', '=', $auth->id],
                                                                                  ['season_id', '=', $gets1->id],
                                        ])->first();


                                      }

                                    }
                                    else{
                                       $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();
                                    }
                              @endphp
                              @if($item->status == 1)
                                @if($item->type == 'M')
                                @php
                                   $image = 'images/movies/thumbnails/'.$item->thumbnail;
                                  // Read image path, convert to base64 encoding
                                
                                  $imageData = base64_encode(@file_get_contents($image));
                                  if($imageData){
                                  // Format the image SRC:  data:{mime};base64,{data};
                                  $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                  }else{
                                      $src = Avatar::create($item->title)->toBase64();
                                  }
                                @endphp
                                 @if(isset($item) && hidedata($item->id,$item->type) != 1)
                                <div class="col-lg-3 col-md-9 col-xs-6 col-sm-6">
                                  <div class="genre-slide-image genre-grid home-prime-slider progress-movie genre-image">
                                    @if($auth && getSubscription()->getData()->subscribed == true)
                                      <a href="{{url('movie/detail',$item->slug)}}">
                                      @if($src)
                                        <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                     
                                      @endif
                                     </a>
                                     <div class="hide-icon hide-icon-two">
                                      <a onclick="hideforme('{{$item->id}}','{{$item->type}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
                                    </div>
                                     @if(timecalcuate($auth->id,$item->id,$item->type) != 0)
                                    <div class="progress">
                                      <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:{{timecalcuate($auth->id,$item->id,$item->type)}}%">
                                      </div>
                                    </div>
                                    @endif
                                    @else
                                       <a href="{{url('movie/guest/detail',$item->slug)}}">
                                        @if($src)
                                          <img data-src="{{$src}}" class="img-responsive lazy" alt="genre-image">
                                       
                                        @endif
                                      </a>

                                      @endif
                                      @if($item->is_custom_label == 1)
                                        @if(isset($item->label_id))
                                          <span class="badge bg-info">{{$item->label->name}}</span>
                                        @endif
                                      @endif
                                   
                                  </div>
                                  <div class="genre-slide-dtl">
                                    <h5 class="genre-dtl-heading">
                                       @if($auth && getSubscription()->getData()->subscribed == true)
                                      <a href="{{url('movie/detail/'.$item->slug)}}">{{$item->title}}</a>
                                      @else
                                      <a href="{{url('movie/guest/detail/'.$item->slug)}}">{{$item->title}}</a>

                                      @endif
                                    </h5>
                                  </div>
                                </div>
                                @endif
                                @elseif($item->type == 'T')
                                @php
                                   $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                                  // Read image path, convert to base64 encoding
                                
                                  $imageData = base64_encode(@file_get_contents($image));
                                  if($imageData){
                                  // Format the image SRC:  data:{mime};base64,{data};
                                  $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                  }else{
                                      $src = Avatar::create($item->title)->toBase64();
                                  }
                                @endphp
                                 @if(isset($gets1) && hidedata($gets1->id,$gets1->type) != 1)
                                  <div class="col-lg-3 col-md-9 col-xs-6 col-sm-6">
                                      <div class="genre-slide-image genre-grid home-prime-slider progress-movie genre-image">
                                         @if($auth && getSubscription()->getData()->subscribed == true)
                                          <a @if(isset($gets1)) href="{{url('show/detail',$gets1->season_slug)}}" @endif>
                                            @if($src)
                                              
                                              <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                           
                                            @endif
                                          </a>
                                          <div class="hide-icon hide-icon-two">
                                            <a onclick="hideforme('{{$gets1->id}}','{{$gets1->type}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
                                          </div>
                                          @else
                                           <a @if(isset($gets1)) href="{{url('show/guest/detail',$gets1->season_slug)}}" @endif>
                                            @if($src)
                                              <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                           
                                            @endif
                                          </a>
                                          @endif
                                          @if($item->is_custom_label == 1)
                                            @if(isset($item->label_id))
                                              <span class="badge bg-info">{{$item->label->name}}</span>
                                            @endif
                                          @endif
                                      </div>
                                      <div class="genre-slide-dtl">
                                          @if($auth && getSubscription()->getData()->subscribed == true)
                                          <h5 class="genre-dtl-heading"><a href="{{url('show/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                          @else
                                           <h5 class="genre-dtl-heading"><a href="{{url('show/guest/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                          @endif
                                      </div>
                                  </div>
                                  @endif
                                @endif
                              @endif
                          @endforeach
                        </div>
                      </div>
                  @endif
                 <!--Based on intrest tvseries and movies in Grid view END-->
                      
                </div>
              </div>
            </div> 
         @endif
       
     
    @endforeach
  @endif
  <!-- Based on intrest watch Tv Shows and Movies end-->
 
  <!----------- Toprated Movie----------------->

  @foreach($menu->menusections as $section)
    @if($section->section_id == 12  && $top_data != NULL)
      <div class="genre-main-block">
        @if(isset($top_data->menu_data))
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-3 col-sm-5">
                <div class="genre-dtl-block">
                  <h5 class="section-heading">{{__('Top rated')}} {{__('in')}} {{ $menu->name }}</h5>
                </div>
              </div>
              <div class="col-md-9 col-sm-7">
                <div class="genre-main-slider owl-carousel">
                  @php
                    $i = 0;
                  @endphp
                  @foreach($top_data->menu_data  as $key => $item)
                    @if(isset($item->movie) && $item->movie != NULL && views($item->movie)->unique()->count() >= $button->toprated_count ) 
                      <div class="genre-slide">
                        <div class="genre-slide-image genre-image  home-prime-slider progress-movie">
                          @if($auth && getSubscription()->getData()->subscribed == true)
                            <a href="{{url('movie/detail',$item->movie->slug)}}">
                              @if($item->movie->thumbnail != NULL)
                                <img data-src="{{url('/images/movies/thumbnails/'.$item->movie->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                              @else
                              <img data-src="{{url('/images/default-thumbnail.jpg')}}" class="img-responsive owl-lazy" alt="genre-image">
                              @endif
                            </a>
                            <div class="hide-icon">
                              <a onclick="hideforme('{{$item->movie->id}}','{{$item->movie->type}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
                            </div>
                            @if(timecalcuate($auth->id,$item->movie->id,$item->movie->type) != 0)
                              <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:{{timecalcuate($auth->id,$item->movie->id,$item->movie->type)}}%">
                                </div>
                              </div>
                            @endif
                          @else
                            <a href="{{url('movie/guest/detail',$item->movie->slug)}}">
                              @if($item->movie->thumbnail != NULL)
                                <img data-src="{{url('images/movies/thumbnails/'.$item->movie->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                              @else
                                <img data-src="{{Avatar::create($item->movie->title)->toBase64()}}" class="img-responsive owl-lazy" alt="genre-image">
                              @endif
                            </a>
                          @endif
                          @if($item->movie->is_custom_label == 1)
                            @if(isset($item->movie->label_id))
                              <span class="badge bg-info">{{$item->movie->label->name}}</span>
                            @endif
                          @endif
                         
                          <div class="top-ten-heading">{{++$i}}</div>
                        </div>
                        <div class="genre-slide-dtl">
                          <h5 class="genre-dtl-heading">
                            @if($auth && getSubscription()->getData()->subscribed == true)
                              <a href="{{url('movie/detail/'.$item->slug)}}">{{$item->title}}</a>
                            @else
                              <a href="{{url('movie/guest/detail/'.$item->slug)}}">{{$item->title}}</a>
                            @endif
                          </h5>
                        </div>
                      </div>
                    @elseif(isset($item->tvseries) && $item->tvseries != NULL && isset($item->tvseries->seasons[0]) && views($item->tvseries->seasons[0])->unique()->count() >= $button->toprated_count)
                      @php
                        $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                          // Read image path, convert to base64 encoding
                          
                        $imageData = base64_encode(@file_get_contents($image));
                        if($imageData){
                          $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                        }else{
                          $src = Avatar::create($item->tvseries->title)->toBase64();
                        }
                      @endphp
                      <div class="genre-slide">
                        <div class="genre-slide-image genre-image  home-prime-slider">
                          @if($auth && getSubscription()->getData()->subscribed == true)
                            <a @if(isset($gets1)) href="{{url('show/detail',$gets1->season_slug)}}" @endif>
                              @if($item->tvseries->thumbnail != null)
                                
                                <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                              
                              @endif
                            </a>
                            <div class="hide-icon">
                              <a onclick="hideforme('{{$gets1->id}}','{{$gets1->type}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
                            </div>
                          @else
                            <a @if(isset($gets1)) href="{{url('show/guest/detail',$gets1->season_slug)}}" @endif>
                              @if($item->tvseries->thumbnail != null)
                                <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                            
                              @endif
                            </a>
                          @endif 
                          @if($item->tvseries->is_custom_label == 1)
                                @if(isset($item->tvseries->label_id))
                                  <span class="badge bg-info">{{$item->label->name}}</span>
                                @endif
                              @endif
                          <div class="top-ten-heading">{{++$i}}</div>
                        </div>
                        <div class="genre-slide-dtl">
                          @if($auth && getSubscription()->getData()->subscribed == true)
                            <h5 class="genre-dtl-heading"><a href="{{url('show/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                          @else
                            <h5 class="genre-dtl-heading"><a href="{{url('show/guest/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                          @endif
                        </div>  
                      </div>
                    @endif
                  @endforeach 
                </div>
              </div>
            </div> 
          </div>
        @endif
      </div>
    @endif
  @endforeach

<!----------- Toprated Movie  end ----------------->

  <!--continue watch Movies and TvShows -->
  @if(Auth::user() && $auth != NULL && getSubscription()->getData()->subscribed == true)

    @foreach($menu->menusections as $section)
        @php
            $historyadded = [];
           
            foreach ($watchistory as $key => $item) {
              
                $rm =  App\Movie::
                            join('watch_histories','movies.id','=','watch_histories.movie_id')
                            ->join('menu_videos','menu_videos.movie_id','=','movies.id')
                            ->join('videolinks','videolinks.movie_id','=','movies.id')
                             ->select('movies.id as id','watch_histories.movie_id as movie_id','movies.title as title','movies.rating as rating','movies.duration as duration','movies.publish_year as publish_year','movies.maturity_rating as maturity_rating','movies.detail as detail','movies.trailer_url as trailer_url','videolinks.iframeurl as iframeurl','movies.status as status','movies.type as type','movies.thumbnail as thumbnail','movies.slug as slug','movies.tmdb as tmdb','movies.is_custom_label as is_custom_label','movies.label_id as label_id')
                             ->where('movies.is_upcoming','!=' ,1)
                             ->where('watch_histories.id',$item->id)->where('menu_videos.menu_id',$menu->id)->first();
                  
                $historyadded[] = $rm;

                
                if($section->order == 1){
                  arsort($historyadded);
                }
               

                if(count($historyadded) == $section->item_limit){
                    break;
                    exit(1);
                }
            }
           

            foreach ($watchistory as $key => $item) {
                
                $rectvs =  App\TvSeries::
                              join('watch_histories','tv_series.id','=','watch_histories.tv_id')
                                 ->join('seasons','seasons.tv_series_id','=','tv_series.id')
                              ->join('episodes','episodes.seasons_id','=','seasons.id')
                              ->join('videolinks','videolinks.episode_id','=','episodes.id')
                             ->join('menu_videos','menu_videos.tv_series_id','=','tv_series.id')
                              ->select('seasons.id as seasonid','tv_series.genre_id as genre_id','tv_series.id as id','tv_series.type as type','tv_series.status as status','tv_series.thumbnail as thumbnail','tv_series.title as title','tv_series.rating as rating','seasons.publish_year as publish_year','tv_series.maturity_rating as age_req','tv_series.detail as detail','seasons.season_no as season_no','videolinks.iframeurl as iframeurl','seasons.season_slug as season_slug','seasons.tmdb as tmdb','tv_series.is_custom_label as is_custom_label','tv_series.label_id as label_id')
                              ->where('watch_histories.id',$item->id)->where('menu_videos.menu_id',$menu->id)->first();
                  
                $historyadded[] = $rectvs;
              

                if($section->order == 1){
                  arsort($historyadded);
                }
                
                if(count($historyadded) == $section->item_limit){
                    break;
                    exit(1);
                }

            }
            
            

            $historyadded = array_values(array_filter($historyadded));
            
        @endphp
         
        @if($section->section_id == 5 && $historyadded != NULL && count($historyadded)>0)
           <div class="genre-main-block">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-3 col-sm-5">
                    <div class="genre-dtl-block">
                        <h5 class="section-heading">{{__('Continue Watching For')}} {{Auth::user()->name}}</h5>
                         <p class="section-dtl">{{__('at the big screen at home')}}</p>
                        @if($auth && getSubscription()->getData()->subscribed == true)
                    
                         <a href="{{ route('watchhistory') }}" class="see-more"> <b>{{__('view all')}}</b></a>
                 
                       
                   
                        @endif 
                          <!-- continue watch and movies in List view -->
                    </div>
                  </div>
                  @if($section->view == 1)
                    <div class="col-md-9 col-sm-7">
                      <div class="genre-main-slider owl-carousel">
                       @foreach($historyadded as $item)
                           @php
                           if(isset($auth) && $auth != NULL){


                             if ($item->type == 'M') {
                              $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                                ['user_id', '=', $auth->id],
                                                                                ['movie_id', '=', $item->id],
                                                                              ])->first();
                            }
                             }

                             if(isset($auth) && $auth != NULL){

                                $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();

                                if (isset($gets1)) {


                                  $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                              ['user_id', '=', $auth->id],
                                                                              ['season_id', '=', $gets1->id],
                                    ])->first();


                                  }

                                }
                                else{
                                   $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();
                                }
                          @endphp

                          @if($item->status == 1)
                            @if($item->type == 'M')
                            @php
                               $image = 'images/movies/thumbnails/'.$item->thumbnail;
                              // Read image path, convert to base64 encoding
                            
                              $imageData = base64_encode(@file_get_contents($image));
                              if($imageData){
                              // Format the image SRC:  data:{mime};base64,{data};
                              $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                              }else{
                                  $src = Avatar::create($item->title)->toBase64();
                              }
                            @endphp
                               @if(hidedata($item->id,$item->type) != 1)
                              <div class="genre-slide">
                                <div class="genre-slide-image genre-image  home-prime-slider progress-movie">
                                  @if($auth && getSubscription()->getData()->subscribed == true)
                                    <a href="{{url('movie/detail',$item->slug)}}">
                                      @if($src)
                                        <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                     
                                      @endif
                                    </a>
                                    <div class="hide-icon">
                                      <a onclick="hideforme('{{$item->id}}','{{$item->type}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
                                    </div>
                                    @if(timecalcuate($auth->id,$item->id,$item->type) != 0)
                                    <div class="progress">
                                      <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:{{timecalcuate($auth->id,$item->id,$item->type)}}%">
                                      </div>
                                    </div>
                                    @endif
                                  @else
                                    <a href="{{url('movie/guest/detail',$item->slug)}}">
                                    @if($src)
                                      <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                    
                                    @endif
                                  </a>
                                 
                                  @endif
                                  @if(isset($item->is_upcoming) && $item->is_upcoming == 1)
                                    <span class="badge bg-success">Upcoming</span>
                                  @endif
                                
                                </div>
                                <div class="genre-slide-dtl">
                                  <h5 class="genre-dtl-heading">
                                  @if($auth && getSubscription()->getData()->subscribed == true)
                                    <a href="{{url('movie/detail/'.$item->slug)}}">{{$item->title}}</a>
                                  @else
                                  <a href="{{url('movie/guest/detail/'.$item->slug)}}">{{$item->title}}</a>
                                 
                                  @endif
                                  </h5>
                                </div>
                              </div>
                              @endif
                            @elseif($item->type == 'T')
                            
                              @php
                                 $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                                // Read image path, convert to base64 encoding
                              
                                $imageData = base64_encode(@file_get_contents($image));
                                if($imageData){
                                // Format the image SRC:  data:{mime};base64,{data};
                                $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                }else{
                                    $src = Avatar::create($item->title)->toBase64();
                                }
                              @endphp
                               @if(hidedata($gets1->id,$gets1->type) != 1)
                              <div class="genre-slide">
                                <div class="genre-slide-image genre-image  home-prime-slider">
                                    @if($auth && getSubscription()->getData()->subscribed == true)
                                    <a @if(isset($gets1)) href="{{url('show/detail',$gets1->season_slug)}}" @endif>
                                      @if($item->thumbnail != null)
                                        
                                        <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                      
                                      @endif
                                    </a>
                                    <div class="hide-icon">
                                      <a onclick="hideforme('{{$gets1->id}}','{{$gets1->type}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
                                    </div>
                                   
                                    @endif 
                                   
                                </div>
                                
                                <div class="genre-slide-dtl">
                                   @if($auth && getSubscription()->getData()->subscribed == true)
                                    <h5 class="genre-dtl-heading"><a href="{{url('show/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                   
                                    @endif
                                </div>  
                             </div>
                             @endif
                            @endif
                          @endif
                       @endforeach 
                      </div>
                    </div>
                  @endif
                  <!-- continue watch and movies in List view END -->

                  <!-- continue watch and movies in Grid view -->
                  @if($section->view == 0)
                      <div class="col-md-9">
                        <div class="cus_img">
                          @foreach($historyadded as $item)
                             @php
                               if(isset($auth) && $auth != NULL){


                                 if ($item->type == 'M') {
                                  $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                                    ['user_id', '=', $auth->id],
                                                                                    ['movie_id', '=', $item->id],
                                                                                  ])->first();
                                }
                                 }

                                 if(isset($auth) && $auth != NULL){

                                    $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();

                                    if (isset($gets1)) {


                                      $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                                  ['user_id', '=', $auth->id],
                                                                                  ['season_id', '=', $gets1->id],
                                        ])->first();


                                      }

                                    }
                                    else{
                                       $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();
                                    }
                              @endphp
                              @if($item->status == 1)
                                @if($item->type == 'M')
                                @php
                                   $image = 'images/movies/thumbnails/'.$item->thumbnail;
                                  // Read image path, convert to base64 encoding
                                
                                  $imageData = base64_encode(@file_get_contents($image));
                                  if($imageData){
                                  // Format the image SRC:  data:{mime};base64,{data};
                                  $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                  }else{
                                      $src = Avatar::create($item->title)->toBase64();
                                  }
                                @endphp
                                 @if(hidedata($item->id,$item->type) != 1)
                                <div class="col-lg-3 col-md-9 col-xs-6 col-sm-6">
                                  <div class="genre-slide-image genre-grid home-prime-slider progress-movie genre-image">
                                    @if($auth && getSubscription()->getData()->subscribed == true)
                                      <a href="{{url('movie/detail',$item->slug)}}">
                                      @if($src)
                                        <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                      @endif
                                     </a>
                                     <div class="hide-icon hide-icon-two">
                                      <a onclick="hideforme('{{$item->id}}','{{$item->type}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
                                     </div>
                                     @if(timecalcuate($auth->id,$item->id,$item->type) != 0)
                                      <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:{{timecalcuate($auth->id,$item->id,$item->type)}}%">
                                        </div>
                                      </div>
                                      @endif
                                    @else
                                       <a href="{{url('movie/guest/detail',$item->slug)}}">
                                      @if($src)
                                        <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                    
                                      @endif
                                     </a>
                                    
                                    @endif
                                    @if(isset($item->is_upcoming) && $item->is_upcoming == 1)
                                      <span class="badge bg-success">Upcoming</span>
                                    @endif
                                  
                                  </div>
                                  <div class="genre-slide-dtl">
                                    <h5 class="genre-dtl-heading">
                                      @if($auth && getSubscription()->getData()->subscribed == true)
                                        <a href="{{url('movie/detail/'.$item->slug)}}">{{$item->title}}</a>
                                      @else
                                        <a href="{{url('movie/guest/detail/'.$item->slug)}}">{{$item->title}}</a>
                                      @endif
                                    </h5>
                                  </div>
                                </div>
                                @endif
                                @elseif($item->type == 'T')
                                @php
                                   $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
                                  // Read image path, convert to base64 encoding
                                
                                  $imageData = base64_encode(@file_get_contents($image));
                                  if($imageData){
                                  // Format the image SRC:  data:{mime};base64,{data};
                                  $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                  }else{
                                      $src = Avatar::create($item->title)->toBase64();
                                  }
                                @endphp
                                 @if(hidedata($gets1->id,$gets1->type) != 1)
                                  <div class="col-lg-3 col-md-9 col-xs-6 col-sm-6">
                                      <div class="genre-slide-image genre-grid home-prime-slider progress-movie genre-image">
                                         @if($auth && getSubscription()->getData()->subscribed == true)
                                          <a @if(isset($gets1)) href="{{url('show/detail',$gets1->season_slug)}}" @endif>
                                            @if($src)
                                              
                                              <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                            
                                            
                                            @endif
                                          </a>
                                          <div class="hide-icon hide-icon-two">
                                            <a onclick="hideforme('{{$gets1->id}}','{{$gets1->type}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
                                          </div>
                                         
                                          @endif
                                           
                                      </div>
                                      <div class="genre-slide-dtl">
                                          @if($auth && getSubscription()->getData()->subscribed == true)
                                          <h5 class="genre-dtl-heading"><a href="{{url('show/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                                         
                                          @endif
                                      </div>
                                  </div>
                                @endif
                                @endif
                              @endif
                          @endforeach
                        </div>
                      </div>
                  @endif
                 <!--continue watch and movies in Grid view END-->
                      
                </div>
              </div>
            </div> 
         @endif
       
     
    @endforeach
  @endif
   <!-- continue watch Tv Shows and Movies end-->
  
<!------------- Movie Pormotion ------------------->


    @foreach($menu->menusections as $section)
      <div class="container-fluid" >
        @if($section->section_id == 7 && $short_promo != NULL && count($short_promo)>0)

        <div id="myCarousel" class="carousel slide home-dtl-slider" data-ride="carousel" style="background-image: url('{{ asset('images/home_slider/movies/slide_1591259550414580.jpg') }}')">
          <div class="overlay-bg"></div>
          <!-- Indicators -->
          
          <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          @php
              $homeblocks = [];
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //$ipaddress = '43.251.92.73';
            $ipaddress = $request->getClientIp();
            $geoip = geoip()->getLocation($ipaddress);
            $usercountry = strtoupper($geoip->country);
              foreach ($short_promo as $key => $item) {
                  
                  $home_movie =  App\Movie::join('videolinks','videolinks.movie_id','=','movies.id')
                              ->join('home_blocks','home_blocks.movie_id','=','movies.id')
                               ->select('movies.id as id','movies.title as title','movies.type as type','movies.status as status','movies.genre_id as genre_id','movies.poster as poster','movies.rating as rating','movies.duration as duration','movies.publish_year as publish_year','movies.maturity_rating as maturity_rating','movies.detail as detail','movies.trailer_url as trailer_url','movies.slug as slug','movies.is_upcoming as is_upcoming','movies.is_custom_label as is_custom_label','movies.label_id as label_id')
                               ->where('movies.is_upcoming','!=' ,1)
                               ->where('movies.country', 'NOT like', '%'.$usercountry.'%')
                               ->where('movies.id',$item->movie_id)->first();
                    
                   $homeblocks[] = $home_movie;

                 

              }
            }

              foreach ($short_promo as $key => $item) {
                 $home_tvs = App\TvSeries::
                                join('seasons','seasons.tv_series_id','=','tv_series.id')
                                ->join('episodes','episodes.seasons_id','=','seasons.id')
                                ->join('videolinks','videolinks.episode_id','=','episodes.id')
                                ->join('home_blocks','home_blocks.tv_series_id','=','tv_series.id')
                                ->select('seasons.id as seasonid','tv_series.genre_id as genre_id','tv_series.id as id','tv_series.type as type','tv_series.status as status','tv_series.thumbnail as thumbnail','tv_series.title as title','tv_series.rating as rating','seasons.publish_year as publish_year','tv_series.maturity_rating as age_req','tv_series.detail as detail','seasons.season_no as season_no','videolinks.iframeurl as iframeurl','tv_series.poster as poster','seasons.trailer_url as trailer_url')
                                ->where('tv_series.id',$item->tv_series_id)->first();
                    
                  $homeblocks[] = $home_tvs;



              }

              $homeblocks = array_values(array_filter($homeblocks));

          @endphp

          @foreach($homeblocks as $ki => $item)
            
              @php
               if(isset($auth) && $auth != NULL){
                 if ($item->type == 'M') {
                  $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                    ['user_id', '=', $auth->id],
                                                                    ['movie_id', '=', $item->id],
                                                                  ])->first();
                  }
                 }

                 if(isset($auth) && $auth != NULL){

                    $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();

                    if (isset($gets1)) {


                      $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                  ['user_id', '=', $auth->id],
                                                                  ['season_id', '=', $gets1->id],
                        ])->first();


                      }

                    }
                    else{
                       $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();
                    }
              @endphp
   
                <div class="item {{ $ki==0 ? "active" : "" }}">
                  <div class="row">
                    
                          <div class="col-md-6">
                            @if($item->status == 1)
                              @if($item->type == 'M')
                                @php
                                   $image = 'images/movies/posters/'.$item->poster;
                                  // Read image path, convert to base64 encoding
                                
                                  $imageData = base64_encode(@file_get_contents($image));
                                  if($imageData){
                                  // Format the image SRC:  data:{mime};base64,{data};
                                  $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                  }else{
                                      $src = Avatar::create($item->title)->toBase64();
                                  }
                                @endphp
                                <div class="slider-height">
                                
                                  @if($auth && getSubscription()->getData()->subscribed == true)
                                    @if($item->trailer_url != null || $item->trailer_url != '')
                                        @php
                                          $url = str_replace("https://youtu.be/", "https://youtube.com/embed/", $item->trailer_url)
                                        @endphp
                                         <iframe src="{{$url}}" height="350" width="100%"></iframe>
                                      @else
                                        <a href="{{url('movie/detail',$item->slug)}}">
                                          @if($src)
                                            <img data-src="{{ $src }}" class="img-responsive lazy" alt="movie-image" style="width:100%">
                                          @else
                                            <img data-src="{{ $src }}" class="img-responsive lazy" alt="movie-image" style="width:100%">
                                          @endif
                                        </a>
                                    @endif              

                                  @else
                                   
                                    @if($item->trailer_url != null || $item->trailer_url != '')
                                      @php
                                        $url = str_replace("https://youtu.be/", "https://youtube.com/embed/", $item->trailer_url)
                                      @endphp
                                       <iframe src="{{$url}}" height="215" width="100%"></iframe>
                                    @else
                                      <a href="{{url('movie/guest/detail',$item->slug)}}">
                                        @if($src)
                                          <img data-src="{{ $src }}" class="img-responsive lazy" alt="movie-image" style="width:100%">
                                        @else
                                          <img data-src="{{ $src }}" class="img-responsive lazy" alt="movie-image" style="width:100%">
                                        @endif
                                      </a>
                                    @endif             
                                  @endif
                                </div>
                              @elseif($item->type === 'T')
                                  @php
                                                                
                                    $image = 'images/tvseries/posters/'.$item->poster;
                                      // Read image path, convert to base64 encoding
                                    
                                      $imageData = base64_encode(@file_get_contents($image));
                                      if($imageData){
                                      // Format the image SRC:  data:{mime};base64,{data};
                                      $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                                      }else{
                                          $src = Avatar::create($item->title)->toBase64();
                                      }
                                  @endphp
                                  <div class="slider-height">
                                    @if($auth && getSubscription()->getData()->subscribed == true)
                                      <a @if(isset($gets1)) href="{{url('show/detail',$gets1->season_slug)}}" @endif>
                                        @if($src)
                                          <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="tvseries-image" style="width:100%">
                                        @endif
                                      </a>
                                    @else
                                      <a @if(isset($gets1)) href="{{url('show/guest/detail',$gets1->season_slug)}}" @endif>
                                        @if($src)
                                          
                                          <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="tvseries-image" style="width:100%">
                                        
                                        @else
                                          <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="tvseries-image" style="width:100%">
                                        @endif
                                      </a>                
                                    @endif
                                  </div>
                              @endif
                            @endif
                          </div>
                          <div class="col-md-6">
                            @if($item->status == 1)
                              @if($item->type == 'M')
                               
                                <div class="slider-height-dtl">
                                  <img src="{{url('images/logo/'.$logo)}}" class="img-responsive" alt="{{$w_title}}">
                                    <h1>{{$item->title}}</h1><br/>
                                    <div class="row">
                                       <div class="des-btn-block des-in-list">
                                          @if($auth && getSubscription()->getData()->subscribed == true)
                                            @if($item->maturity_rating == 'all age' || $age>=str_replace('+', '', $item->maturity_rating))
                                              @if($item->video_link['iframeurl'] != null)
                                                <a href="{{route('watchmovieiframe',$item->id)}}"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                                                </a>

                                              @else
                                                <a href="{{route('watchmovie',$item->id)}}" class="iframe btn btn-play"> <span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                                                </a>
                                              @endif
                                            @else
                                              <a onclick="myage({{$age}})" class=" iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                                              </a>
                                            @endif
                                            
                                          @endif
                                         
                                          @if($auth && getSubscription()->getData()->subscribed == true)
                                            <a class="btn btn-default" href="{{url('movie/detail',$item->slug)}}"><i class="fa fa-info-circle"></i> {{__('moreinfo')}}</a>
                                          @else
                                            <a class="btn btn-default" href="{{url('movie/guest/detail',$item->slug)}}"><i class="fa fa-info-circle"></i> {{__('moreinfo')}}</a>
                                          @endif
                                        </div>
                                      </div>
                                      <br/>
                                      <p>{{str_limit($item->detail,150,'...')}}</p>
                                      @if($auth && getSubscription()->getData()->subscribed == true)
                                        <a href="{{url('movie/detail',$item->slug)}}">{{__('Read More')}}</a>
                                      @else
                                         <a href="{{url('movie/guest/detail',$item->slug)}}">{{__('Read More')}}</a>
                                      @endif
                                      <br/>
                                      <p class="text-right promotion"># {{count($homeblocks)}}  {{__('Top In')}} {{$menu->name}}</p>
                                </div>
                              @elseif($item->type === 'T')
                                <div class="slider-height-dtl">
                              <img data-src="{{url('images/logo/'.$logo)}}" class="img-responsive lazy" alt="{{$w_title}}">
                              <h1>{{$item->title}}</h1>
                              <br/>
                              <div>
                               <div class="des-btn-block des-in-list des-in-list-one">
                                  @if (isset($gets1->episodes[0]) &&  getSubscription()->getData()->subscribed == true && $auth)
                                    @if($item->age_req == 'all age' || $age>=str_replace('+', '', $item->age_req))

                                      @if($gets1->episodes[0]->video_link['iframeurl'] !="")
                                       
                                        <a href="#" onclick="playoniframe('{{ $gets1->episodes[0]->video_link['iframeurl'] }}','{{ $gets1->episodes[0]->seasons->tvseries->id }}','tv')" class="btn btn-play"><span class= "play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                                         </a>

                                      @else
                                        <a href="{{ route('watchTvShow',$gets1->id) }}" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span></a>
                                      @endif
                                    @else
                                     <a onclick="myage({{$age}})" class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span></a>
                                    @endif
                                   
                                  @endif
                                  @if($auth && getSubscription()->getData()->subscribed == true)
                                    <a class="btn btn-default" @if(isset($gets1)) href="{{url('show/detail',$gets1->season_slug)}}" @endif><i class="fa fa-info-circle"></i> {{__('More Info')}}</a>
                                  @else
                                    <a class="btn btn-default" @if(isset($gets1)) href="{{url('show/guest/detail',$gets1->season_slug)}}" @endif><i class="fa fa-info-circle"></i> {{__('More Info')}}</a>

                                  @endif
                                </div>
                              </div>

                               <br/>
                              <p>{{str_limit($item->detail,150,'...')}}</p>
                              @if($auth && getSubscription()->getData()->subscribed == true)
                                <a href="{{url('show/detail',$gets1->season_slug)}}">{{__('Read More')}}</a>
                              @else
                                 <a href="{{url('show/guest/detail',$gets1->season_slug)}}">{{__('Read More')}}</a>
                              @endif
                              <br/>
                              <p class="text-right promotion"># {{count($homeblocks)}}  {{__('top in')}} {{$menu->name}}</p>
                            </div>
                              @endif
                            @endif
                          </div>
                  </div>
                </div>     
              @endforeach
           
        </div>

         
         <!-- Left and right controls -->
          <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">{{__('Previous')}}</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">{{__('Next')}}</span>
          </a>
        </div>
        @endif
      </div>
    @endforeach
    <br/>

  <!----------- Movie Pormotion end ----------------->

<!----------- Upcoming Movie----------------->

  @foreach($menu->menusections as $section)
     @if($section->section_id == 9 && $upcomingitems != NULL)
       <div class="genre-main-block">
          <div class="container-fluid">
           
            <div class="row">
              <div class="col-md-3 col-sm-5">
                <div class="genre-dtl-block">
                    <h5 class="section-heading">{{__('Upcoming Movie')}} {{ $menu->name }}</h5>
                     <p class="section-dtl">{{__('at the big screen at home')}}</p>
                      
                </div>
              </div>
              @if($section->view == 1)
                <div class="col-md-9 col-sm-7">
                  <div class="genre-main-slider owl-carousel">
                   @foreach($upcomingitems->menu_data as $item)
                       @php
                       if(isset($auth) && $auth != NULL){


                         if ($item->type == 'M') {
                          $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                            ['user_id', '=', $auth->id],
                                                                            ['movie_id', '=', $item->movie->id],
                                                                          ])->first();
                        }
                         }

                        
                      @endphp

                     
                        @if($item->movie != NULL && $item->movie->type == 'M' && $item->movie['status'] == 1)
                        @php
                           $image = 'images/movies/thumbnails/'.$item->movie->thumbnail;
                          // Read image path, convert to base64 encoding
                        
                          $imageData = base64_encode(@file_get_contents($image));
                          if($imageData){
                          // Format the image SRC:  data:{mime};base64,{data};
                          $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
                          }else{
                              $src = Avatar::create($item->movie->title)->toBase64();
                          }
                        @endphp
                          
                          <div class="genre-slide">
                            <div class="genre-slide-image genre-image home-prime-slider">
                              @if($auth && getSubscription()->getData()->subscribed == true)
                              <a href="{{url('movie/detail',$item->movie->slug)}}">
                                @if($src)
                                  <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                
                                @endif
                              </a>
                              <div class="hide-icon">
                                <a onclick="hideforme('{{$item->movie->id}}','{{$item->movie->type}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
                              </div>
                              @else
                                <a href="{{url('movie/guest/detail',$item->movie->slug)}}">
                                @if($src)
                                  <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                               
                                @endif
                              </a>
                              @endif
                              @if($item->movie->is_custom_label == 1)
                                @if(isset($item->movie->label_id))
                                  <span class="badge bg-info">{{$item->movie->label->name}}</span>
                                @endif
                              @else
                                @if(isset($item->movie->is_upcoming) && $item->movie->is_upcoming == 1)
                                  @if($item->movie->upcoming_date != NULL)
                                    <span class="badge bg-success">{{date('M jS Y',strtotime($item->movie->upcoming_date))}}</span>
                                  @else
                                    <span class="badge bg-danger">{{__('Coming Soon')}}</span>
                                  @endif
                                @endif
                              @endif
                             
                            </div>
                            <div class="genre-slide-dtl">
                              <h5 class="genre-dtl-heading">
                                 @if($auth && getSubscription()->getData()->subscribed == true)
                              <a href="{{url('movie/detail/'.$item->movie->slug)}}">{{$item->movie->title}}</a>
                              @else
                              <a href="{{url('movie/guest/detail/'.$item->movie->slug)}}">{{$item->movie->title}}</a>
                                @endif
                              </h5>
                            </div>
                          </div>

                      @endif
                   @endforeach 
                  </div>
                </div>
              @endif
                  
            </div>
          </div>
        </div> 
     @endif
  @endforeach
<!----------- Upcoming Movie  end ----------------->


<!--- language ---->

@foreach($menu->menusections as $section)

     @if($section->section_id == 6)
        
        @include('lang2')

       @if(count($getallaudiolanguage) > 0)
        <div class="genre-prime-block genre-prime-block-one genre-paddin-top genre-view-all">
          <div class="container-fluid">
               <h5 class="section-heading">{{__('view all language')}}</h5>
                <div class="genre-prime-slider owl-carousel">
                   @foreach($getallaudiolanguage as $alang)
                   <div class="item genre-prime-slide owls-item">
                        @if($auth && getSubscription()->getData()->subscribed == true) 
                          <a href="{{ route('show.in.alang',$alang->id) }}">
                            <div class="protip text-center" data-pt-placement="outside">
                            @if($alang->image != NULL)

                              <img data-src="{{url('images/audiolanguage/'.$alang->image)}}" class="img img-responsive genreview owl-lazy">
                              @else
                              <img data-src="{{url('/images/default-thumbnail.jpg')}}" class="img img-responsive genreview owl-lazy">
                            @endif
                            </div>
                             <div class="content">
                              <h1 class="content-heading">{{$alang->name}}</h1>
                            </div>

                          </a>
                          @else
                            <a href="{{ route('show.in.guest.alang',$alang->id) }}">
                             <div class="protip text-center" data-pt-placement="outside">
                            @if($alang->image != NULL)

                              <img data-src="{{url('images/audiolanguage/'.$alang->image)}}" class="img img-responsive genreview owl-lazy">
                              @else
                              <img data-src="{{url('/images/default-thumbnail.jpg')}}" class="img img-responsive genreview owl-lazy">
                            @endif
                            </div>
                             <div class="content">
                              <h1 class="content-heading">{{$alang->name}}</h1>
                            </div>
                            </a>
                          @endif
                    </div>
                  @endforeach
                </div>

              </div>  
          </div>
        @endif       
    @endif
  @endforeach
<!--- End Language ---->
       
  @foreach($menu->menusections as $section)

     @if($section->section_id == 2)
        
        @if(count($menu->menugenreshow) > 0)
          @include('selectgenre2')
        @endif

       @if(count($getallgenre) > 0)
        <div class="genre-prime-block genre-prime-block-one genre-paddin-top genre-view-all">
          <div class="container-fluid">
               <h5 class="section-heading">{{__('view all genre')}}</h5>
               
                <div class="genre-prime-slider owl-carousel">
                   @foreach($getallgenre as $genre)
                   <div class="item genre-prime-slide owls-item">
                   
                      
                          @if($auth && getSubscription()->getData()->subscribed == true) 
                         
                          <a href="{{ route('show.in.genre',$genre->id) }}">
                            <div class="protip text-center" data-pt-placement="outside">
                            @if($genre->image != NULL)

                              <img data-src="{{url('images/genre/'.$genre->image)}}" class="img img-responsive genreview owl-lazy">
                              @else
                              <img data-src="{{url('/images/default-thumbnail.jpg')}}" class="img img-responsive genreview owl-lazy">
                            @endif
                            </div>
                             <div class="content">
                              <h1 class="content-heading">{{$genre->name}}</h1>
                            </div>

                          </a>
                          @else
                            <a href="{{ route('show.in.guest.genre',$genre->id) }}">
                             <div class="protip text-center" data-pt-placement="outside">
                            @if($genre->image != NULL)

                              <img data-src="{{url('images/genre/'.$genre->image)}}" class="img img-responsive genreview owl-lazy">
                              @else
                              <img data-src="{{url('/images/default-thumbnail.jpg')}}" class="img img-responsive genreview owl-lazy">
                            @endif
                            </div>
                             <div class="content">
                              <h1 class="content-heading">{{$genre->name}}</h1>
                            </div>
                            </a>
                          @endif
                        
                     
                    </div>
                      @endforeach
                </div>

              </div>  
          </div>
        @endif
                      
          @endif


  @endforeach

   
@endif

<!----------------------- Blog ------------------->
@foreach($menu->menusections as $section)
  @if($section->section_id == 8)
    @if($configs->blog == '1')
      @if(isset($menu->getblogs) && count($menu->getblogs)>0)
        <div class="genre-main-block">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-3 col-sm-5">
                <div class="genre-dtl-block">
                  <h3 class="section-heading">{{__('recently blog')}}</h3>
                  <p class="section-dtl">{{__('atthebigscreenathome')}}</p>
                  <a href="{{ route('all blog') }}" class="see-more"> <b>{{__('view all')}}</b></a>
                </div>
              </div>
              <div class="col-md-9 col-sm-7">
                <div class="genre-main-slider owl-carousel">
                  @foreach($menu->getblogs as $blog)
                   @if($blog->blogs['is_active'] == 1)
                  <div class="genre-slide">
                    <div class="genre-slide-image genre-image">
                      <a href="{{url('account/blog/'.$blog->blogs['slug'])}}">
                        @if($blog->blogs['image'] != null)
                        <img data-src="{{ asset('images/blog/'.$blog->blogs['image']) }}" class="img-responsive owl-lazy" alt="genre-image">
                        @else
                        <img data-src="{{asset('images/default-thumbnail.jpg')}}" class="img-responsive owl-lazy" alt="genre-image">
                        @endif
                      </a>
                   
                    </div>
                    <div class="genre-slide-dtl">
                      <h5 class="genre-dtl-heading">
                        <a href="{{url('account/blog/'.$blog->blogs['slug'])}}">{{$blog->blogs['title']}}</a>
                      </h5>
                    </div>
                  </div>
                   @endif
                     
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      @endif
    @endif
  @endif

@endforeach

<!-------------------------- end Blog ----------------->




<!----------------------- live event ------------------->

@if(isset($liveevent) && count($liveevent) > 0)
<div class="genre-main-block">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3 col-sm-5">
        <div class="genre-dtl-block">
          <h3 class="section-heading">{{__('live event')}}</h3>
          <p class="section-dtl">{{__('at the big screen at home')}}</p>
        </div>
      </div>
      <div class="col-md-9 col-sm-7">
        <div class="genre-main-slider owl-carousel">
          @foreach($liveevent as $key => $liveevents)
          
          <div class="genre-slide">
            <div class="genre-slide-image genre-image">
              @if($auth && getSubscription()->getData()->subscribed == true)
              <a href="{{url('event/detail/'.$liveevents->slug)}}">
                @if($liveevents->thumbnail != null)
                <img data-src="{{asset('images/events/thumbnails/'.$liveevents->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                @else
                <img data-src="{{asset('images/default-thumbnail.jpg')}}" class="img-responsive owl-lazy" alt="genre-image">
                @endif
              </a>
              @else
              <a href="{{url('event/guest/detail/'.$liveevents->slug)}}">
                @if($liveevents->thumbnail != null)
                <img data-src="{{asset('images/events/thumbnails/'.$liveevents->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                @else
                <img data-src="{{asset('images/default-thumbnail.jpg')}}" class="img-responsive owl-lazy" alt="genre-image">
                @endif
              </a>
              @endif
            </div>
            <div class="genre-slide-dtl">
              <h5 class="genre-dtl-heading">
                @if($auth && getSubscription()->getData()->subscribed == true)
                <a href="{{url('event/detail/'.$liveevents->slug)}}">{{$liveevents->title}}</a>

                @else
                <a href="{{url('event/guest/detail/'.$liveevents->slug)}}">{{$liveevents->title}}</a>
                @endif
              </h5>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endif

<!-------------------------- end live event ----------------->



<!----------------------- Audio ------------------->
@if(isset($audio) && count($audio)>0)
  <div class="genre-main-block">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3 col-sm-5">
          <div class="genre-dtl-block">
            <h3 class="section-heading">{{__('Audio')}}</h3>
          
          </div>
        </div>
        <div class="col-md-9 col-sm-7">
          <div class="genre-main-slider owl-carousel">
            @foreach($audio as $audios)
            
            <div class="genre-slide">
              <div class="genre-slide-image genre-image">
                @if($auth && getSubscription()->getData()->subscribed == true)
                <a href="{{url('audio/detail/'.$audios->id)}}">
                  @if($audios->thumbnail != null)
                    <img data-src="{{ url('images/audio/thumbnail/'.$audios->thumbnail) }}" class="img-responsive owl-lazy" alt="genre-image">
                  @else
                    <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-responsive owl-lazy" alt="genre-image">
                  @endif
                </a>
                @else
                  <a href="{{url('audio/guest/detail/'.$audios->id)}}">
                    @if($audios->thumbnail != null)
                      <img data-src="{{ url('images/audio/thumbnail/'.$audios->thumbnail) }}" class="img-responsive owl-lazy" alt="genre-image">
                    @else
                      <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-responsive owl-lazy" alt="genre-image">
                    @endif
                  </a>
                @endif
             
              </div>
              <div class="genre-slide-dtl">
                <h5 class="genre-dtl-heading">
                  @if($auth && getSubscription()->getData()->subscribed == true)
                    <a href="{{url('audio/detail/'.$audios->id)}}">{{$audios['title']}}</a>
                  @else
                    <a href="{{url('audio/guest/detail/'.$audios->id)}}">{{$audios['title']}}</a>
                  @endif
                </h5>
              </div>
            </div>
            
               
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endif
   

<!-------------------------- end Audio ----------------->


<!-- google adsense code -->
       
     
  </section>
 <div class="container-fluid" id="adsense">
      @php
        if (isset($ad) ) {
            if ($ad->ishome==1 && $ad->status==1) {
              $code=  $ad->code;
              echo html_entity_decode($code);
            }
        }
      @endphp
  </div>
    

@endsection

@section('custom-script')

<script type="text/javascript">
  var page = 1;
  var wHeight;
  var dHeight;
  $(document).ready(function(){
     wHeight =  $(window).height();
     dHeight =  $(document).height();
  });
  
  $(window).scroll(function() {
     wHeight =  $(window).height();
     dHeight =  $(document).height();
     
      if($(window).scrollTop() + wHeight >= dHeight) {
          page++;
          
      }
      loadMoreData(page);
  });


  function loadMoreData(p){
    var lastVal = p;
    if(lastVal == page){
     page++;
    }
    
    $.ajax(
          {
              url: '?page=' + page,
              type: "get",
              beforeSend: function()
              {
                  $('.ajax-load').show();
              }
          })
          .done(function(data)
          {
              if(data.html == ''){
                  $('.ajax-load').html("You explored all :) we will add more...");
                  return;
              }else{
                page++;
              }
              $('.ajax-load').hide();
              $("#post-data").append(data.html);
              console.log(data.html);
          })
          .fail(function(jqXHR, ajaxOptions, thrownError)
          {
                console.log(jqXHR);
          });
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
       
   
         
  
  });        $.colorbox({ href: url, width: '100%', height: '100%', iframe: true });
       
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
   <script type="text/javascript">


    var app = new Vue({
      el: '#wishlistelement',
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
          return text == "{{__('addtowatchlist')}}" ? "{{ __('removefromwatchlist') }}" : "{{__('addtowatchlist')}}";
        });
      }, 100);
    }
  </script>

   <script src="{{ url('js/slider.js') }}"></script>
  
@endsection