@foreach($audiolanguages as $lang)
  @php
    $audiogenreitems = NULL;
    $audiogenreitems = array();

    foreach ($menu_data as $key => $item) 
    {

        $gmovie =  App\Movie::join('videolinks','videolinks.movie_id','=','movies.id')
                 ->select('movies.id as id','movies.title as title','movies.type as type','movies.status as status','movies.genre_id as genre_id','movies.thumbnail as thumbnail','movies.rating as rating','movies.duration as duration','movies.publish_year as publish_year','movies.maturity_rating as maturity_rating','movies.detail as detail','movies.trailer_url as trailer_url','videolinks.iframeurl as iframeurl','movies.slug as slug','movies.is_custom_label as is_custom_label','movies.label_id as label_id')
                  ->where('movies.is_upcoming','!=' ,1)
                 ->where('movies.a_language', 'LIKE', '%' . $lang->id . '%')->where('movies.id',$item->movie_id)->first();



       
        if(isset($gmovie) && $gmovie != NULL){
          
           $audiogenreitems[] = $gmovie;
                  
        }

         if($section->order == 1){
            arsort($audiogenreitems);
          }

        if(count($audiogenreitems) == $section->item_limit){
            break;
            exit(1);
        }

    }
  
    $audiogenreitems = array_values(array_filter($audiogenreitems));
    foreach ($menu_data as $key => $item) {

     $gtvs = App\Tvseries::
                  join('seasons','seasons.tv_series_id','=','tv_series.id')
                  ->join('episodes','episodes.seasons_id','=','seasons.id')
                  ->join('videolinks','videolinks.episode_id','=','episodes.id')
                  ->select('seasons.id as seasonid','tv_series.genre_id as genre_id','tv_series.id as id','tv_series.type as type','tv_series.status as status','tv_series.thumbnail as thumbnail','tv_series.title as title','tv_series.rating as rating','seasons.publish_year as publish_year','tv_series.maturity_rating as age_req','tv_series.detail as detail','seasons.season_no as season_no','videolinks.iframeurl as iframeurl','seasons.trailer_url as trailer_url','seasons.tmdb as tmdb','tv_series.is_custom_label as is_custom_label','tv_series.label_id as label_id')->where('seasons.a_language', 'LIKE', '%' . $lang->id . '%')
            ->where('tv_series.id',$item->tv_series_id)->first();
            
           
            
      if(isset($gtvs)){
        
         array_push($audiogenreitems, $gtvs);
               
      }
        
      if($section->order == 1){
        arsort($audiogenreitems);
      }

      if(count($audiogenreitems) == $section->item_limit*2){
          break;
          exit(1);
      }

    }
      
    $audiogenreitems = array_values(array_filter($audiogenreitems));
      
  @endphp
  <div class="">                            
    @if($audiogenreitems != NULL && count($audiogenreitems)>0)
     <h5 class="section-heading">{{  ucfirst($lang->language) }} in {{ $menu->name }}</h5>
     
    @endif   
                           
   @if($section->view == 1)
      <div class="genre-prime-slider owl-carousel">
        @foreach($audiogenreitems as $item)
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

         <!-- List view language movies and tv shows -->
             
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
                        <div class="genre-prime-slide">
                          <div class="genre-slide-image home-prime-slider protip" data-pt-placement="outside" data-pt-title="#prime-mix-description-block{{$item->id}}">
                            @if($auth && getSubscription()->getData()->subscribed == true)
                            <a href="{{url('movie/detail',$item->slug)}}">
                              @if($src)
                                <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="movie-image">
                              @else
                                <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="movie-image">
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
                                <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="movie-image">
                             
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
                          <div id="prime-mix-description-block{{$item->id}}" class="prime-description-block">
                                <h5 class="description-heading">{{$item->title}}</h5>
                                <div class="movie-rating">{{__('Tmdb Rating')}} {{$item->rating}}</div>
                                <ul class="description-list">
                                  <li>{{$item->duration}} {{__('Mins')}}</li>
                                  <li>{{$item->publish_year}}</li>
                                  <li>{{$item->maturity_rating}}</li>
                                 
                                </ul>
                                <div class="main-des">
                                  <p>{{$item->detail}}</p>
                                  <a href="#"></a>
                                </div>
                               
                                  
                                <div class="des-btn-block">
                                  @if($auth && getSubscription()->getData()->subscribed == true)
                                    @if($item->is_upcoming != 1 && isset($item->video_link))
                                      @if($item->maturity_rating == 'all age' || $age>=str_replace('+', '', $item->maturity_rating) )
                                        @if(isset($item->video_link['iframeurl']) && $item->video_link['iframeurl'] != null)
                                    
                                          <a href="{{route('watchmovieiframe',$item->id)}}"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('playnow')}}</span>
                                          </a>

                                        @else
                                          <a href="{{route('watchmovie',$item->id)}}" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('playnow')}}</span>
                                          </a>
                                        @endif
                                      @else
                                        <a onclick="myage({{$age}})" class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('playnow')}}</span>
                                        </a>
                                      @endif
                                    @endif
                                    @if($item->trailer_url != null || $item->trailer_url != '')
                                      <a class="iframe btn btn-default" href="{{ route('watchTrailer',$item->id) }}">{{__('Watch Trailer')}}</a>
                                    @endif
                                  @else
                                    @if($item->trailer_url != null || $item->trailer_url != '')
                                      <a class="iframe btn btn-default" href="{{ route('guestwatchtrailer',$item->id) }}">{{__('Watch Trailer')}}</a>
                                    @endif
                                  @endif
                                
                                  @if($catlog == 0 && getSubscription()->getData()->subscribed == true)
                                    @if (isset($wishlist_check->added))
                                      <button onclick="addWish({{$item->id}},'{{$item->type}}')" class="addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</button>
                                    @else
                                   
                                      <button onclick="addWish({{$item->id}},'{{$item->type}}')" class="addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{__('Add to Watchlist')}}</button>
                                    @endif
                                  @elseif($catlog ==1 && $auth)
                                    @if (isset($wishlist_check->added))
                                      <button onclick="addWish({{$item->id}},'{{$item->type}}')" class="addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</button>
                                    @else
                                   
                                      <button onclick="addWish({{$item->id}},'{{$item->type}}')" class="addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{__('Add to Watchlist')}}</button>
                                    @endif
                                  @endif
                                </div>
                              </div>
                          @endif
                        </div>
                        @endif
                    @endif

                    @if($item->type == 'T')
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
                     <div class="genre-prime-slide">
                        <div class="genre-slide-image home-prime-slider protip" data-pt-placement="outside" data-pt-title="#prime-mix-description-block{{$item->id}}{{$item->type}}">
                            @if($auth && getSubscription()->getData()->subscribed == true)
                            <a @if(isset($gets1)) href="{{url('show/detail',$gets1->season_slug)}}" @endif>
                              @if($src != null)
                                
                                <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="ttvseries-image">
                              
                              @endif
                            </a>
                            <div class="hide-icon">
                              <a onclick="hideforme('{{$gets1->id}}','{{$gets1->type}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
                            </div>
                            @else
                             <a @if(isset($gets1)) href="{{url('show/guest/detail',$gets1->season_slug)}}" @endif>
                              @if($item->thumbnail != null)
                                <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="tvseries-image">
                            
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
                          <div class="movie-rating">{{__('Tmdb Rating')}} {{$item->rating}}</div>
                          <ul class="description-list">
                            <li>{{__('Season')}} {{$item->season_no}}</li>
                            <li>{{$item->publish_year}}</li>
                            <li>{{$item->age_req}}</li>
                            
                          </ul>
                          <div class="main-des">
                            @if ($item->detail != null || $item->detail != '')
                              <p>{{$item->detail}}</p>
                            @else
                              <p>{{$item->detail}}</p>
                            @endif
                            <a href="#"></a>
                          </div>
                          
                          <div class="des-btn-block">
                            @if($auth && getSubscription()->getData()->subscribed == true)
                              @if (isset($gets1->episodes[0]) && isset($gets1->episodes[0]->video_link))
                                @if($item->age_req == 'all age' || $age>=str_replace('+', '', $item->age_req) )

                                  @if($gets1->episodes[0]->video_link['iframeurl'] !="")
                               
                                    <a href="#" onclick="playoniframe('{{ $gets1->episodes[0]->video_link['iframeurl'] }}','{{ $gets1->episodes[0]->seasons->tvseries->id }}','tv')" class="btn btn-play"><span class= "play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('playnow')}}</span>
                                     </a>

                                  @else
                                    <a href="{{ route('watchTvShow',$item->seasonid) }}" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('playnow')}}</span></a>
                                  @endif
                                @else
                                  <a onclick="myage({{$age}})" class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('playnow')}}</span></a>
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
                            @if($catlog ==0 && getSubscription()->getData()->subscribed == true)
                             @if(isset($gets1))
                                @if (isset($wishlist_check->added))
                                  <a onclick="addWish({{$item->seasonid}},'{{$gets1->type}}')" class="addwishlistbtn{{$item->seasonid}}{{$gets1->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</a>
                                @else
                                  @if($gets1)
                                    <a onclick="addWish({{$item->seasonid}},'{{$gets1->type}}')" class="addwishlistbtn{{$item->seasonid}}{{$gets1->type}} btn-default">{{__('Add to Watchlist')}}
                                    </a>
                                  @endif
                                @endif
                              @endif
                            @elseif($catlog ==1 && $auth)
                              @if(isset($gets1))
                                @if (isset($wishlist_check->added))
                                  <a onclick="addWish({{$item->seasonid}},'{{$gets1->type}}')" class="addwishlistbtn{{$item->seasonid}}{{$gets1->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</a>
                                @else
                                  @if($gets1)
                                    <a onclick="addWish({{$item->seasonid}},'{{$gets1->type}}')" class="addwishlistbtn{{$item->seasonid}}{{$gets1->type}} btn-default">{{__('Add to Watchlist')}}
                                    </a>
                                  @endif
                                @endif
                              @endif
                            @endif
                          </div>
                        </div>
                        @endif
                     </div>
                     @endif
                    @endif
                 @endif
            
            <!-- end -->

          @endforeach
        </div>
     
   <!-- List view movies by language END -->
   @endif
   

                        
  @if($section->view == 0)
    
    <!-- Grid view language by movies -->
      <div class="genre-prime-block">
              
                @foreach($audiogenreitems as $item)
                   @php
                     

                     if(isset($auth) && $auth != NULL){
                        if ($item->type == 'M') {
                          $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                            ['user_id', '=', $auth->id],
                                                                            ['movie_id', '=', $item->id],
                                                                          ])->first();
                        }
                      }

       

                      $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();

                      if (isset($gets1) && $auth && $auth != NULL) {


                        $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                    ['user_id', '=', $auth->id],
                                                                    ['season_id', '=', $gets1->id],
                          ])->first();


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
                        <div class="col-lg-2 col-md-3 col-xs-6 col-sm-4">
                          <div class="cus_img">
                            <div class="genre-slide-image home-prime-slider protip" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-mix-description-block{{$item->id}}">
                                @if($auth && getSubscription()->getData()->subscribed == true)
                                  <a href="{{url('movie/detail',$item->slug)}}">
                                  @if($src)
                                    <img data-src="{{ $src }}" class="img-responsive lazy" alt="movie-image">
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
                                      <img data-src="{{$src}}" class="img-responsive lazy" alt="movie-image">
                                   
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
                             <div id="prime-mix-description-block{{$item->id}}" class="prime-description-block">
                                <h5 class="description-heading">{{$item->title}}</h5>
                                <div class="movie-rating">{{__('Tmdb Rating')}} {{$item->rating}}</div>
                                <ul class="description-list">
                                  <li>{{$item->duration}} {{__('Mins')}}</li>
                                  <li>{{$item->publish_year}}</li>
                                  <li>{{$item->maturity_rating}}</li>
                                 
                                </ul>
                                <div class="main-des">
                                  <p>{{$item->detail}}</p>
                                  <a href="#"></a>
                                </div>
                                

                                  
                                <div class="des-btn-block">
                                  @if($auth && getSubscription()->getData()->subscribed == true)
                                    @if($item->is_upcoming != 1 && isset($item->video_link))
                                      @if($item->maturity_rating == 'all age' || $age>=str_replace('+', '', $item->maturity_rating) )
                                        @if(isset($item->video_link['iframeurl']) && $item->video_link['iframeurl'] != null)
                                    
                                          <a href="{{route('watchmovieiframe',$item->id)}}"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('playnow')}}</span>
                                          </a>

                                        @else
                                          <a href="{{route('watchmovie',$item->id)}}" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('playnow')}}</span>
                                          </a>
                                        @endif
                                      @else
                                        <a onclick="myage({{$age}})" class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('playnow')}}</span>
                                        </a>
                                      @endif
                                    @endif
                                    @if($item->trailer_url != null || $item->trailer_url != '')
                                      <a class="iframe btn btn-default" href="{{ route('watchTrailer',$item->id) }}">{{__('Watch Trailer')}}</a>
                                    @endif
                                  @else
                                    @if($item->trailer_url != null || $item->trailer_url != '')
                                      <a class="iframe btn btn-default" href="{{ route('guestwatchtrailer',$item->id) }}">{{__('Watch Trailer')}}</a>
                                    @endif
                                  @endif
                                  
                                  @if($catlog==0 && getSubscription()->getData()->subscribed == true)
                                    @if (isset($wishlist_check->added))
                                      <button onclick="addWish({{$item->id}},'{{$item->type}}')" class="addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</button>
                                    @else
                                   
                                      <button onclick="addWish({{$item->id}},'{{$item->type}}')" class="addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{__('Add to Watchlist')}}</button>
                                    @endif
                                  @elseif($catlog ==1 && $auth)
                                    @if (isset($wishlist_check->added))
                                      <button onclick="addWish({{$item->id}},'{{$item->type}}')" class="addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</button>
                                    @else
                                   
                                      <button onclick="addWish({{$item->id}},'{{$item->type}}')" class="addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{__('Add to Watchlist')}}</button>
                                    @endif
                                  @endif
                                </div>
                              </div>
                              @endif
                            </div>
                        </div>
                        @endif
                      @endif

                      @if($item->type == 'T')
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
                        <div class="col-lg-2 col-md-3 col-xs-6 col-sm-4">
                                <div class="cus_img">
                                <div class="genre-slide-image home-prime-slider protip" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-mix-description-block{{$item->id}}{{$item->type}}">
                                   @if($auth && getSubscription()->getData()->subscribed == true)
                                    <a @if(isset($gets1)) href="{{url('show/detail',$gets1->season_slug)}}" @endif>
                                      @if($src)
                                        
                                        <img data-src="{{ $src }}" class="img-responsive lazy" alt="tvseries-image">
                                      
                                      @else
                                        <img data-src="{{ $src }}" class="img-responsive lazy" alt="tvseries-image">
                                      @endif
                                    </a>
                                    <div class="hide-icon">
                                      <a onclick="hideforme('{{$gets->id}}','{{$gets->type}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
                                    </div>
                                    @else
                                     <a @if(isset($gets1)) href="{{url('show/guest/detail',$gets1->season_slug)}}" @endif>
                                      @if($src)
                                        <img data-src="{{ $src }}" class="img-responsive lazy" alt="tvseries-image">
                                      
                                      @else
                                        <img data-src="{{ $src }}" class="img-responsive lazy" alt="tvseries-image">
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
                                        @if (isset($gets1->episodes[0]) && isset($gets1->episodes[0]->video_link))
                                          @if($item->age_req == 'all age' || $age>=str_replace('+', '', $item->age_req))
                                            @if($gets1->episodes[0]->video_link['iframeurl'] !="")
                                         
                                              <a href="#" onclick="playoniframe('{{ $gets1->episodes[0]->video_link['iframeurl'] }}','{{ $gets1->episodes[0]->seasons->tvseries->id }}','tv')" class="btn btn-play"><span class= "play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('playnow')}}</span>
                                              </a>

                                            @else
                                              <a href="{{ route('watchTvShow',$gets1->id) }}" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('playnow')}}</span></a>
                                            @endif
                                          @else
                                           <a onclick="myage({{$age}})" class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('playnow')}}</span></a>
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
                                      @if($catlog == 1 && getSubscription()->getData()->subscribed == true)
                                        @if(isset($gets1))
                                          @if (isset($wishlist_check->added))
                                            <a onclick="addWish({{$gets1->id}},'{{$gets1->type}}')" class="addwishlistbtn{{$gets1->id}}{{$gets1->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('add to watch list')}}</a>
                                          @else
                                            @if($gets1)
                                              <a onclick="addWish({{$gets1->id}},'{{$gets1->type}}')" class="addwishlistbtn{{$gets1->id}}{{$gets1->type}} btn-default">{{__('add to watchl ist')}}
                                              </a>
                                            @endif
                                          @endif
                                        @endif
                                      @elseif($catlog ==1 && $auth)

                                        @if(isset($gets1))
                                          @if (isset($wishlist_check->added))
                                            <a onclick="addWish({{$gets1->id}},'{{$gets1->type}}')" class="addwishlistbtn{{$gets1->id}}{{$gets1->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('add to watch list')}}</a>
                                          @else
                                            @if($gets1)
                                              <a onclick="addWish({{$gets1->id}},'{{$gets1->type}}')" class="addwishlistbtn{{$gets1->id}}{{$gets1->type}} btn-default">{{__('Add to Watchlist')}}
                                              </a>
                                            @endif
                                          @endif
                                        @endif
                                      @endif
                                    </div>
                                  </div>
                                 @endif     
                               
                              </div>
                      </div>
                      @endif
                      @endif
                    @endif
                @endforeach

        </div>
   
  <!--end grid view by language-->
  @endif
  </div>
  @endforeach


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
          return text == "{{__('addtowatchlist')}}" ? "{{ __('removefromwatchlist') }}" : "{{__('addtowatchlist')}}";
        });
      }, 100);
    }
  </script>
  @endsection