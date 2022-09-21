<div class="genre-prime-block genre-prime-block-one genre-paddin-top">
           <div class="container-fluid">
                
                <h5 class="section-heading">{{__('Upcoming Movie')}} {{ $menu->name }}</h5>

                
                <!-- Upcoming Tvshows and movies in List view -->
                @if($section->view == 1)
                  <div class="genre-prime-slider owl-carousel">

                     @foreach($upcomingitems->menu_data as $item)
                         @php
                         if(isset($auth) && $auth != NULL){


                           if ($item->type == 'M') {
                            $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                              ['user_id', '=', $auth->id],
                                                                              ['movie_id', '=', $item->id],
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
                                $src = url('images/default-thumbnail.jpg');
                            }
                          @endphp

                            <div class="genre-prime-slide">
                              <div class="genre-slide-image home-prime-slider protip" data-pt-placement="outside" data-pt-title="#prime-mix-description-block{{$item->movie->id}}">
                                @if($auth && getSubscription()->getData()->subscribed == true)
                                <a href="{{url('movie/detail',$item->movie->slug)}}">
                                  @if($src)
                                    <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                  @else
                                    <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                  @endif
                                </a>
                                
                                @else
                                <a href="{{url('movie/guest/detail',$item->movie->slug)}}">
                                  @if($src)
                                    <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                                  @else
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
                              @if(isset($protip) && $protip == 1)
                              <div id="prime-mix-description-block{{$item->movie->id}}" class="prime-description-block">
                                  <h5 class="description-heading">{{$item->movie->title}}</h5>
                                 
                                  <ul class="description-list">
                                    <li>{{__('Tmdb Rating')}} {{$item->movie->rating}}</li>
                                    <li>{{$item->movie->duration}} {{__('Mins')}}</li>
                                    <li>{{$item->movie->publish_year}}</li>
                                    <li>{{$item->movie->maturity_rating}}</li>
                                    
                                  </ul>
                                  <div class="main-des">
                                    <p>{{str_limit($item->movie->detail,100,'...')}}</p>
                                    @if($auth && getSubscription()->getData()->subscribed == true)
                                      <a href="{{url('movie/detail',$item->movie->slug)}}">{{__('Read More')}}</a>
                                    @else
                                       <a href="{{url('movie/guest/detail',$item->movie->slug)}}">{{__('Read More')}}</a>
                                    @endif
                                  </div>
                                
                                    
                                  <div class="des-btn-block">
                                    @if($auth && getSubscription()->getData()->subscribed == true)
                                      
                                      @if($item->movie->trailer_url != null || $item->movie->trailer_url != '')
                                         <a class="iframe btn btn-default" href="{{ route('watchTrailer',$item->movie->id) }}">{{__('Watch Trailer')}}</a>
                                      @endif
                                    @else
                                      @if($item->movie->trailer_url != null || $item->movie->trailer_url != '')
                                        <a class="iframe btn btn-default" href="{{ route('guestwatchtrailer',$item->movie->id) }}">{{__('Watch Trailer')}}</a>
                                      @endif
                                    @endif

                                    @if($catlog == 0 && getSubscription()->getData()->subscribed == true)
                                      @if (isset($wishlist_check->added))
                                        <button onclick="addWish({{$item->movie->id}},'{{$item->movie->type}}')" class="addwishlistbtn{{$item->movie->id}}{{$item->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</button>
                                      @else
                                     
                                        <button onclick="addWish({{$item->movie->id}},'{{$item->movie->type}}')" class="addwishlistbtn{{$item->movie->id}}{{$item->type}} btn-default">{{__('Add to Watchlist')}}</button>
                                      @endif
                                    @elseif($catlog ==1 && $auth)
                                      @if (isset($wishlist_check->added))
                                        <button onclick="addWish({{$item->movie->id}},'{{$item->movie->type}}')" class="addwishlistbtn{{$item->movie->id}}{{$item->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</button>
                                      @else
                                     
                                        <button onclick="addWish({{$item->movie->id}},'{{$item->movie->type}}')" class="addwishlistbtn{{$item->movie->id}}{{$item->movie->type}} btn-default">{{__('Add to Watchlist')}}</button>
                                      @endif
                                    @endif
                                    
                                  </div>
                                 
                              </div>
                              @endif
                            </div>
                          @endif
                       
                     @endforeach 
                  </div>
                @endif
                <!-- Upcoming Tvshows and movies in List view END -->

                <!-- Upcoming Tvshows and movies in Grid view -->
                @if($section->view == 0)
                     <div class="genre-prime-block">
                        @foreach($upcomingitems->menu_data as $item)
                           @php
                             if(isset($auth) && $auth != NULL){


                               if ($item->movie != NULL && $item->movie->type == 'M' && $item->movie['status'] == 1) {
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
                                    $src = url('images/default-thumbnail.jpg');
                                }
                              @endphp

                                <div class="col-lg-2 col-md-3 col-xs-6 col-sm-4">
                                    <div class="cus_img">
                                      <div class="genre-slide-image home-prime-slider protip " data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-mix-description-block{{$item->movie->id}}">
                                        @if($auth && getSubscription()->getData()->subscribed == true)
                                        <a href="{{url('movie/detail',$item->movie->slug)}}">
                                        @if($src)
                                          <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                        @else
                                          <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                        @endif
                                      </a>
                                      @else
                                       <a href="{{url('movie/guest/detail',$item->movie->slug)}}">
                                        @if($src)
                                          <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                        @else
                                          <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                        @endif
                                      </a>

                                      @endif
                                      @if($item->movie->is_custom_label == 1)
                                        @if(isset($item->movie->label_id))
                                          <span class="badge bg-info">{{$item->movie->label->name}}</span>
                                        @endif
                                      @else

                                        @if(isset($item->movie->is_upcoming) && $item->movie->is_upcoming == 1)
                                          @if($item->upcoming_date != NULL)
                                            <span class="badge bg-success">{{date('M jS Y',strtotime($item->upcoming_date))}}</span>
                                          @else
                                            <span class="badge bg-danger">{{__('Coming Soon')}}</span>
                                          @endif
                                          
                                        @endif
                                      @endif
                                     
                                    </div>
                                    @if(isset($protip) && $protip == 1)
                                    <div id="prime-mix-description-block{{$item->movie->id}}" class="prime-description-block">
                                      <h5 class="description-heading">{{$item->movie->title}}</h5>
                                    
                                      <ul class="description-list">
                                        <li>{{__('Tmdb Rating')}} {{$item->movie->rating}}</li>
                                        <li>{{$item->movie->duration}} {{__('Mins')}}</li>
                                        <li>{{$item->movie->publish_year}}</li>
                                        <li>{{$item->movie->maturity_rating}}</li>
                                       
                                      </ul>
                                      <div class="main-des">
                                        <p>{{str_limit($item->movie->detail,100,'...')}}</p>
                                        @if($auth && getSubscription()->getData()->subscribed == true)
                                          <a href="{{url('movie/detail',$item->movie->slug)}}">{{__('Read More')}}</a>
                                        @else
                                           <a href="{{url('movie/guest/detail',$item->movie->slug)}}">{{__('Read More')}}</a>
                                        @endif
                                      </div>
                                      <div class="des-btn-block">
                                        @if($auth && getSubscription()->getData()->subscribed == true)
                                       
                                          @if($item->movie->trailer_url != null || $item->movie->trailer_url != '')
                                             <a class="iframe btn btn-default" href="{{ route('watchTrailer',$item->movie->id) }}">{{__('Watch Trailer')}}</a>
                                          @endif
                                        @else
                                          @if($item->movie->trailer_url != null || $item->movie->trailer_url != '')
                                            <a class="iframe btn btn-default" href="{{ route('guestwatchtrailer',$item->movie->id) }}">{{__('Watch Trailer')}}</a>
                                          @endif
                                        @endif

                                        @if($catlog == 0 && getSubscription()->getData()->subscribed == true)
                                          @if (isset($wishlist_check->added))
                                            <button onclick="addWish({{$item->movie->id}},'{{$item->movie->type}}')" class="addwishlistbtn{{$item->movie->id}}{{$item->movie->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</button>
                                          @else
                                         
                                            <button onclick="addWish({{$item->movie->id}},'{{$item->movie->type}}')" class="addwishlistbtn{{$item->movie->id}}{{$item->movie->type}} btn-default">{{__('Add to Watchlist')}}</button>
                                          @endif
                                        @elseif($catlog ==1 && $auth)
                                          @if (isset($wishlist_check->added))
                                            <button onclick="addWish({{$item->movie->id}},'{{$item->movie->type}}')" class="addwishlistbtn{{$item->movie->id}}{{$item->movie->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</button>
                                          @else
                                         
                                            <button onclick="addWish({{$item->movie->id}},'{{$item->movie->type}}')" class="addwishlistbtn{{$item->movie->id}}{{$item->movie->type}} btn-default">{{__('Add to Watchlist')}}</button>
                                          @endif
                                        @endif
                                        
                                      </div> 
                                         
                                    </div>
                                     @endif 
                                  
                                    </div>
                                </div>
                              @endif
                            
                        @endforeach
                     </div>
                @endif
              
            </div>
        </div> 