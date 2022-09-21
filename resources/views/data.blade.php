 <link href="{{url('css/owl.carousel.min.css')}}" rel="stylesheet" type="text/css" /> <!-- owl carousel css -->
 <link href="{{url('css/owl.theme.default.min.css')}}" rel="stylesheet" type="text/css" /> <!-- owl carousel css -->

 @foreach($genres as $genre)
 @php
 $moviegenreitems = NULL;
 $moviegenreitems = array();

 foreach ($menu_data as $key => $item)
 {

 $gmovie = App\Movie::join('videolinks','videolinks.movie_id','=','movies.id')
 ->select('movies.id as id','movies.title as title','movies.type as type','movies.status as status','movies.genre_id as
 genre_id','movies.thumbnail as thumbnail','movies.rating as rating','movies.duration as duration','movies.publish_year
 as publish_year','movies.maturity_rating as maturity_rating','movies.detail as detail','movies.trailer_url as
 trailer_url','videolinks.iframeurl as iframeurl','movies.slug as slug','movies.is_upcoming as
 is_upcoming','movies.is_custom_label as is_custom_label','movies.label_id as label_id')
 ->where('movies.genre_id', 'LIKE', '%' . $genre->id . '%')->where('movies.id',$item->movie_id)->first();


 if(isset($gmovie) && $gmovie != NULL){

 $moviegenreitems[] = $gmovie;

 }

 if($section->order == 1){
 arsort($moviegenreitems);
 }

 if(count($moviegenreitems) == $section->item_limit){
 break;
 exit(1);
 }
 }

 $moviegenreitems = array_values(array_filter($moviegenreitems));
 foreach ($menu_data as $key => $item)
 {

 $gtvs = App\Tvseries::
 join('seasons','seasons.tv_series_id','=','tv_series.id')
 ->join('episodes','episodes.seasons_id','=','seasons.id')
 ->join('videolinks','videolinks.episode_id','=','episodes.id')
 ->select('seasons.id as seasonid','tv_series.genre_id as genre_id','tv_series.id as id','tv_series.type as
 type','tv_series.status as status','tv_series.thumbnail as thumbnail','tv_series.title as title','tv_series.rating as
 rating','seasons.publish_year as publish_year','tv_series.maturity_rating as age_req','tv_series.detail as
 detail','seasons.season_no as season_no','videolinks.iframeurl as iframeurl','seasons.trailer_url as
 trailer_url','tv_series.is_custom_label as is_custom_label','tv_series.label_id as
 label_id')->where('tv_series.genre_id', 'LIKE', '%' . $genre->id . '%')
 ->where('tv_series.id',$item->tv_series_id)->first();



 if(isset($gtvs) && $gtvs != NULL){

 array_push($moviegenreitems, $gtvs);

 }

 if($section->order == 1){
 arsort($moviegenreitems);
 }

 if(count($moviegenreitems) == $section->item_limit*2){
 break;
 exit(1);
 }

 }

 $moviegenreitems = array_values(array_filter($moviegenreitems));

 @endphp
 <div class="">
   @if($moviegenreitems != NULL && count($moviegenreitems)>0)
   <h5 class="section-heading">{{$genre->name }} {{__('in')}} {{ $menu->name }}</h5>

   @if($auth && getSubscription()->getData()->subscribed == true)

   <a href="{{ route('show.in.genre',$genre->id) }}" class="see-more"> <b>{{__('View All')}}</b></a>

   @else

   <a href="{{ route('show.in.guest.genre',$genre->id) }}" class="see-more"> <b>{{__('View All')}}</b></a>


   @endif
   @endif

   @if($section->view == 1)
   <!-- List view movies in genre -->
   <div class="genre-prime-slider owl-carousel">
     @foreach($moviegenreitems as $item)

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


     <!-- List view genre movies and tv shows -->

     @if($item->status == 1)
     @if($item->type == 'M')
     @php
     $image = 'images/movies/thumbnails/'.$item->thumbnail;
     // Read image path, convert to base64 encoding

     $imageData = base64_encode(@file_get_contents($image));
     if($imageData){
     // Format the image SRC: data:{mime};base64,{data};
     $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
     }else{
     $src = url('images/default-thumbnail.jpg');
     }
     @endphp
     <div class="genre-prime-slide">
       <div class="genre-slide-image home-prime-slider protip" data-pt-placement="outside"
         data-pt-title="#prime-mix-description-block{{$item->id}}">
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
         @else
         <a href="{{url('movie/guest/detail',$item->slug)}}">
           @if($src)
           <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="movie-image">
           @else
           <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="movie-image">
           @endif
         </a>
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
         {{-- <span class="badge bg-success">Upcoming</span> --}}
         @endif
         @endif

       </div>
       @if(isset($protip) && $protip == 1)
       <div id="prime-mix-description-block{{$item->id}}" class="prime-description-block">
         <h5 class="description-heading">{{$item->title}}</h5>
         <ul class="description-list">
           <li>{{__('tmdb rating')}} {{$item->rating}}</li>
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
           @if($item->is_upcoming != 1)
           @if($item->maturity_rating == 'all age' || $age>=str_replace('+', '', $item->maturity_rating))
           @if(isset($item->video_link['iframeurl']) && $item->video_link['iframeurl'] != null)

           <a href="{{route('watchmovieiframe',$item->id)}}" class="btn btn-play iframe"><span class="play-btn-icon"><i
                 class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
           </a>

           @else
           <a href="{{route('watchmovie',$item->id)}}" class="iframe btn btn-play"><span class="play-btn-icon"><i
                 class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
           </a>
           @endif
           @else
           <a onclick="myage({{$age}})" class=" btn btn-play play-btn-icon"><span class="play-btn-icon"><i
                 class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span></a>
           @endif
           @endif
           @if($item->trailer_url != null || $item->trailer_url != '')
           <a class="iframe btn btn-default"
             href="{{ route('watchTrailer',$item->id) }}">{{__('Watch Trailer')}}</a>
           @endif
           @else
           @if($item->trailer_url != null || $item->trailer_url != '')
           <a class="iframe btn btn-default"
             href="{{ route('guestwatchtrailer',$item->id) }}">{{__('Watch Trailer')}}</a>
           @endif
           @endif

           @if($catlog==0 && getSubscription()->getData()->subscribed == true)
           @if (isset($wishlist_check->added))
           <button onclick="addWish({{$item->id}},'{{$item->type}}')"
             class="addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add To Watchlist')}}</button>
           @else 

           <button onclick="addWish({{$item->id}},'{{$item->type}}')"
             class="addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{__('add to watch list')}}</button>
           @endif
           @elseif($catlog ==1 && $auth)
           @if (isset($wishlist_check->added))
           <button onclick="addWish({{$item->id}},'{{$item->type}}')"
             class="addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</button>
           @else

           <button onclick="addWish({{$item->id}},'{{$item->type}}')"
             class="addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{__('Add to Watchlist')}}</button>
           @endif
           @endif
         </div>
       </div>
       @endif
     </div>
     @endif

     @if($item->type == 'T')
     @php
     $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
     // Read image path, convert to base64 encoding

     $imageData = base64_encode(@file_get_contents($image));
     if($imageData){
     // Format the image SRC: data:{mime};base64,{data};
     $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
     }else{
     $src = url('images/default-thumbnail.jpg');
     }
     @endphp
     <div class="genre-prime-slide">
       <div class="genre-slide-image home-prime-slider  protip" data-pt-placement="outside"
         data-pt-title="#prime-mix-description-block{{$item->id}}{{$item->type}}">
         @if($auth && getSubscription()->getData()->subscribed == true)
         <a @if(isset($gets1)) href="{{url('show/detail',$gets1->season_slug)}}" @endif>
           @if($item->thumbnail != null)

           <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="tvseries-image">

           @else
           <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="tvseries-image">
           @endif
         </a>
         <div class="hide-icon">
          <a onclick="hideforme('{{$gets1->id}}','{{$gets1->type}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
        </div>
         @else
         <a @if(isset($gets1)) href="{{url('show/guest/detail',$gets1->season_slug)}}" @endif>
           @if($item->thumbnail != null)
           <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="tvseries-image">

           @else
           <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="tvseries-image">
           @endif
         </a>
         @endif
         @if($item->is_custom_label == 1)
         @if(isset($item->label_id))
         <span class="badge bg-success">{{$item->label->name}}</span>
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
           @if (isset($gets1->episodes[0]))
           @if($item->age_req == 'all age' || $age>=str_replace('+', '', $item->age_req))
           @if($gets1->episodes[0]->video_link['iframeurl'] !="")

           <a href="#"
             onclick="playoniframe('{{ $gets1->episodes[0]->video_link['iframeurl'] }}','{{ $gets1->episodes[0]->seasons->tvseries->id }}','tv')"
             class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span
               class="play-text">{{__('Play Now')}}</span>
           </a>

           @else
           <a href="{{ route('watchTvShow',$item->seasonid) }}" class="iframe btn btn-play"><span
               class="play-btn-icon"><i class="fa fa-play"></i></span> <span
               class="play-text">{{__('Play Now')}}</span></a>
           @endif
           @else
           <a onclick="myage({{$age}})" class=" btn btn-play"><span class="play-btn-icon"><i
                 class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span></a>
           @endif
           @endif
           @if($item->trailer_url != null || $item->trailer_url != '')
           <a href="{{ route('watchtvTrailer',$item->id)  }}"
             class="iframe btn btn-default">{{__('Watch Trailer')}}</a>
           @endif
           @else
           @if($item->trailer_url != null || $item->trailer_url != '')
           <a href="{{ route('guestwatchtvtrailer',$item->id)  }}"
             class="iframe btn btn-default">{{__('Watch Trailer')}}</a>
           @endif
           @endif
           @if($catlog ==0 && getSubscription()->getData()->subscribed == true)
           @if(isset($gets1))
           @if (isset($wishlist_check->added))
           <a onclick="addWish({{$item->seasonid}},'{{$gets1->type}}')"
             class="addwishlistbtn{{$item->seasonid}}{{$gets1->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</a>
           @else
           @if($gets1)
           <a onclick="addWish({{$item->seasonid}},'{{$gets1->type}}')"
             class="addwishlistbtn{{$item->seasonid}}{{$gets1->type}} btn-default">{{__('Add to Watchlist')}}
           </a>
           @endif
           @endif
           @endif
           @elseif($catlog ==1 && $auth)
           @if(isset($gets1))
           @if (isset($wishlist_check->added))
           <a onclick="addWish({{$item->seasonid}},'{{$gets1->type}}')"
             class="addwishlistbtn{{$item->seasonid}}{{$gets1->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</a>
           @else
           @if($gets1)
           <a onclick="addWish({{$item->seasonid}},'{{$gets1->type}}')"
             class="addwishlistbtn{{$item->seasonid}}{{$gets1->type}} btn-default">{{__('Add to Watchlist')}}
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

     <!-- end -->

     @endforeach
   </div>

   <!-- List view movies in genre END -->
   @endif



   @if($section->view == 0)

   <!-- Grid view genre movies -->
   <div class="genre-prime-block">

     @foreach($moviegenreitems as $item)
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
     // Format the image SRC: data:{mime};base64,{data};
     $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
     }else{
     $src = url('images/default-thumbnail.jpg');
     }
     @endphp
     <div class="col-lg-2 col-md-3 col-xs-6 col-sm-4">
       <div class="cus_img">
         <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-interactive="false"
           data-pt-title="#prime-mix-description-block{{$item->id}}">
           @if($auth && getSubscription()->getData()->subscribed == true)
           <a href="{{url('movie/detail',$item->slug)}}">
             @if($src)
             <img data-src="{{ $src }}" class="img-responsive lazy" alt="movie-image">
             @else
             <img data-src="{{ $src }}" class="img-responsive lazy" alt="movie-image">
             @endif
           </a>
           <div class="hide-icon">
            <a onclick="hideforme('{{$item->id}}','{{$item->type}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
          </div>
           @else
           <a href="{{url('movie/guest/detail',$item->slug)}}">
             @if($src)
             <img data-src="{{$src}}" class="img-responsive lazy" alt="movie-image">
             @else
             <img data-src="{{ $src }}" class="img-responsive lazy" alt="movie-image">
             @endif
           </a>

           @endif
           @if($item->is_custom_label == 1)
           @if(isset($item->label_id))
           <span class="badge bg-success">{{$item->label->name}}</span>
           @endif
           @else

           @if(isset($item->is_upcoming) && $item->is_upcoming == 1)
           <span class="badge bg-success">Upcoming</span>
           @endif
           @endif

         </div>
         @if(isset($protip) && $protip == 1)
         <div id="prime-mix-description-block{{$item->id}}" class="prime-description-block">
           <h5 class="description-heading">{{$item->title}}</h5>
           <div class="movie-rating">{{__('Tmdb Rating')}} {{$item->rating}}</div>
           <ul class="description-list">
             <li>{{$item->duration}} {{__('mins')}}</li>
             <li>{{$item->publish_year}}</li>
             <li>{{$item->maturity_rating}}</li>

           </ul>
           <div class="main-des">
             <p>{{$item->detail}}</p>
             <a href="#"></a>
           </div>

           <div class="des-btn-block">
             @if($auth && getSubscription()->getData()->subscribed == true)
             @if($item->is_upcoming != 1)
             @if($item->maturity_rating == 'all age' || $age>=str_replace('+', '', $item->maturity_rating))
             @if(isset($item->video_link['iframeurl']) && $item->video_link['iframeurl'] != null)

             <a href="{{route('watchmovieiframe',$item->id)}}" class="btn btn-play iframe"><span
                 class="play-btn-icon"><i class="fa fa-play"></i></span> <span
                 class="play-text">{{__('Play Now')}}</span>
             </a>

             @else
             <a href="{{route('watchmovie',$item->id)}}" class="iframe btn btn-play"><span class="play-btn-icon"><i
                   class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
             </a>
             @endif
             @else
             <a onclick="myage({{$age}})" class=" btn btn-play"><span class="play-btn-icon"><i
                   class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
             </a>
             @endif
             @endif
             @if($item->trailer_url != null || $item->trailer_url != '')
             <a class="iframe btn btn-default"
               href="{{ route('watchTrailer',$item->id) }}">{{__('Watch Trailer')}}</a>
             @endif
             @else
             @if($item->trailer_url != null || $item->trailer_url != '')
             <a class="iframe btn btn-default"
               href="{{ route('guestwatchtrailer',$item->id) }}">{{__('Watch Trailer')}}</a>
             @endif
             @endif

             @if($catlog ==0 && getSubscription()->getData()->subscribed == true)
             @if (isset($wishlist_check->added))
             <button onclick="addWish({{$item->id}},'{{$item->type}}')"
               class="addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</button>
             @else

             <button onclick="addWish({{$item->id}},'{{$item->type}}')"
               class="addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{__('Add to Watchlist')}}</button>
             @endif
             @elseif($catlog ==1 && $auth)
             @if (isset($wishlist_check->added))
             <button onclick="addWish({{$item->id}},'{{$item->type}}')"
               class="addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</button>
             @else

             <button onclick="addWish({{$item->id}},'{{$item->type}}')"
               class="addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{__('Add to Watchlist')}}</button>
             @endif
             @endif
           </div>
         </div>
         @endif
       </div>
     </div>
     @endif

     @if($item->type == 'T')
     @php
     $image = 'images/tvseries/thumbnails/'.$item->thumbnail;
     // Read image path, convert to base64 encoding

     $imageData = base64_encode(@file_get_contents($image));
     if($imageData){
     // Format the image SRC: data:{mime};base64,{data};
     $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
     }else{
     $src = url('images/default-thumbnail.jpg');
     }
     @endphp
     <div class="col-lg-2 col-md-3 col-xs-6 col-sm-4">
       <div class="cus_img">
         <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-interactive="false"
           data-pt-title="#prime-mix-description-block{{$item->id}}{{$item->type}}">
           @if($auth && getSubscription()->getData()->subscribed == true)
           <a @if(isset($gets1)) href="{{url('show/detail',$gets1->season_slug)}}" @endif>
             @if($src)

             <img data-src="{{ $src }}" class="img-responsive lazy" alt="tvseries-image">

             @else
             <img data-src="{{ $src }}" class="img-responsive lazy" alt="tvseries-image">
             @endif
           </a>
           <div class="hide-icon">
            <a onclick="hideforme('{{$gets1->id}}','{{$gets1->type}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
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
             @if (isset($gets1->episodes[0]))
             @if($item->age_req == 'all age' || $age>=str_replace('+', '', $item->age_req))
             @if($gets1->episodes[0]->video_link['iframeurl'] !="")

             <a href="#"
               onclick="playoniframe('{{ $gets1->episodes[0]->video_link['iframeurl'] }}','{{ $gets1->episodes[0]->seasons->tvseries->id }}','tv')"
               class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span
                 class="play-text">{{__('Play Now')}}</span>
             </a>

             @else
             <a href="{{ route('watchTvShow',$gets1->id) }}" class="iframe btn btn-play"><span class="play-btn-icon"><i
                   class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span></a>
             @endif
             @else
             <a onclick="myage({{$age}})" class=" btn btn-play"><span class="play-btn-icon"><i
                   class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span></a>
             @endif
             @endif
             @if($gets1->trailer_url != null || $gets1->trailer_url != '')
             <a href="{{ route('watchtvTrailer',$gets1->id)  }}"
               class="iframe btn btn-default">{{__('Watch Trailer')}}</a>
             @endif
             @else
             @if($gets1->trailer_url != null || $gets1->trailer_url != '')
             <a href="{{ route('guestwatchtvtrailer',$gets1->id)  }}"
               class="iframe btn btn-default">{{__('Watch Trailer')}}</a>
             @endif
             @endif
             @if($catlog == 1 && getSubscription()->getData()->subscribed == true)
             @if(isset($gets1))
             @if (isset($wishlist_check->added))
             <a onclick="addWish({{$gets1->id}},'{{$gets1->type}}')"
               class="addwishlistbtn{{$gets1->id}}{{$gets1->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</a>
             @else
             @if($gets1)
             <a onclick="addWish({{$gets1->id}},'{{$gets1->type}}')"
               class="addwishlistbtn{{$gets1->id}}{{$gets1->type}} btn-default">{{__('Add to Watchlist')}}
             </a>
             @endif
             @endif
             @endif
             @elseif($catlog ==1 && $auth)

             @if(isset($gets1))
             @if (isset($wishlist_check->added))
             <a onclick="addWish({{$gets1->id}},'{{$gets1->type}}')"
               class="addwishlistbtn{{$gets1->id}}{{$gets1->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</a>
             @else
             @if($gets1)
             <a onclick="addWish({{$gets1->id}},'{{$gets1->type}}')"
               class="addwishlistbtn{{$gets1->id}}{{$gets1->type}} btn-default">{{__('Add to Watchlist')}}
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
     @endforeach

   </div>

   <!--end grid view for genre-->
   @endif
 </div>
 @endforeach

 @section('custom-script')

 <script>
   function myage(age) {
     if (age == 0) {
       $('#ageModal').modal('show');
     } else {
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
         this.$http.post('{{route('
           addtowishlist ')}}', this.result).then((response) => {}).catch((e) => {
           console.log(e);
         });
         this.result.item_id = '';
         this.result.item_type = '';
       }
     }
   });

   function addWish(id, type) {
     app.addToWishList(id, type);
     setTimeout(function () {
       $('.addwishlistbtn' + id + type).text(function (i, text) {
         return text == "{{__('Add to Watchlist')}}" ? "{{ __('Remove From Watchlist') }}" :
           "{{__('Add to Watchlist')}}";
       });
     }, 100);
   }
 </script>
 @endsection

 <script type="text/javascript" src="{{url('js/jquery.popover.js')}}"></script> <!-- bootstrap popover js -->
 <script type="text/javascript" src="{{url('js/menumaker.js')}}"></script> <!-- menumaker js -->
 <script type="text/javascript" src="{{url('js/jquery.curtail.min.js')}}"></script> <!-- menumaker js -->
 <script type="text/javascript" src="{{url('js/owl.carousel.min.js')}}"></script> <!-- owl carousel js -->
 <script type="text/javascript" src="{{ url('js/slider.js') }}"></script>
 <script type="text/javascript" src="{{url('js/jquery.scrollSpeed.js')}}"></script> <!-- owl carousel js -->
 <script type="text/javascript" src="{{url('js/TweenMax.min.js')}}"></script> <!-- animation gsap js -->
 <script type="text/javascript" src="{{url('js/ScrollMagic.min.js')}}"></script> <!-- custom js -->
 <script type="text/javascript" src="{{url('js/animation.gsap.min.js')}}"></script> <!-- animation gsap js -->
 <script type="text/javascript" src="{{url('js/modernizr-custom.js')}}"></script> <!-- debug addIndicators js -->
 <script type="text/javascript" src="{{url('js/theme.js')}}"></script> <!-- custom js -->
 <script type="text/javascript" src="{{url('js/custom-js.js')}}"></script>
 <script type="text/javascript" src="{{ url('js/colorbox.js') }}"></script>
 <script type="text/javascript" src="{{ url('js/checkit.js') }}"></script>
 {{-- start rating js --}}
 <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>