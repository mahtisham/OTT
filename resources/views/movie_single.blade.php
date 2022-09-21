@extends('layouts.theme')
 
@if(isset($movie))
@section('custom-meta')
@section('title',$movie->title.' | ')
<link rel="canonical" href="{{ url()->full() }}"/>
<meta name="robots" content="all">
<meta property="og:title" content="{{$movie->title}}"/>
<meta property="og:description" content="{{substr(strip_tags($movie->detail), 0, 100)}}{{strlen(strip_tags($movie->detail))>100 ? '...' : ""}}" />
<meta property="og:type" content="website"/>
<meta property="og:url" content="{{ url()->full() }}" />
<meta property="og:image" content="{{url('public/images/movies/thumbnails/'.$movie->thumbnail)}}" />

<meta name="twitter:title" content="{{$movie->title}}" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:description" content="{{$movie->detail}}" />
<meta name="twitter:site" content="{{ url()->full() }}" />
@endsection

@elseif($season)
 @php
   $title = $season->tvseries->title;
  @endphp
@section('custom-meta')
<meta name="Description" content="{{$season->tvseries->description}}" />
<meta name="keyword" content="{{$season->tvseries->title}}, {{$season->tvseries->keyword}}">
@endsection

@section('title',"$title")

@endif
 @php
 
    $withlogin= App\Config::findOrFail(1)->withlogin;
    $catlog= App\Config::findOrFail(1)->catlog;
    $configs=App\Config::findOrFail(1);
    $auth=Auth::user();
 
       
 @endphp
@section('main-wrapper')
<!-- main wrapper -->
  <section class="main-wrapper">

  <!-- Age -->
  @include('modal.agemodal')
  <!-- Age warning -->
  @include('modal.agewarning')

    @if(isset($movie))
      @if($movie->poster != null)
        <div id="big-main-poster-block" class="big-main-poster-block" style="background-image: url('{{url('images/movies/posters/'.$movie->poster)}}');">
          <div class="overlay-bg"></div>
        </div>
      @else
        <div id="big-main-poster-block" class="big-main-poster-block" style="background-image: url('{{url('images/default-poster.jpg')}}');">
          <div class="overlay-bg"></div>
        </div>
      @endif
    @endif
    @if(isset($season))
      @if($season->poster != null)
        <div id="big-main-poster-block" class="big-main-poster-block" style="background-image: url('{{url('images/tvseries/posters/'.$season->poster)}}');">
          <div class="overlay-bg"></div>
        </div>
      @elseif($season->tvseries->poster != null)
        <div id="big-main-poster-block" class="big-main-poster-block" style="background-image: url('{{url('images/tvseries/posters/'.$season->tvseries->poster)}}');">
          <div class="overlay-bg"></div>
        </div>
      @else
        <div id="big-main-poster-block" class="big-main-poster-block" style="background-image: url('{{url('images/default-poster.jpg')}}');">
          <div class="overlay-bg"></div>
        </div>
      @endif
    @endif
    <div id="full-movie-dtl-main-block" class="full-movie-dtl-main-block full-movie-dtl-block-custom">
      <div class="container-fluid">
        @if(isset($movie))
          @php
           
            $a_languages = collect();
            if ($movie->a_language != null) {
              $a_lan_list = explode(',', $movie->a_language);
              for($i = 0; $i < count($a_lan_list); $i++) {
                try {
                  $a_language = \App\AudioLanguage::find($a_lan_list[$i])->language;
                  $a_languages->push($a_language);
                } catch (Exception $e) {
                }
              }
            }
          if(isset($auth)){


            $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                        ['user_id', '=', $auth->id],
                                                                        ['movie_id', '=', $movie->id],
                                                                       ])->first();
                                                                        }
            // Directors list of movie from model
            $directors = collect();
            if ($movie->director_id != null) {
              $p_directors_list = explode(',', $movie->director_id);
              for($i = 0; $i < count($p_directors_list); $i++) {
                try {
                  $p_director = \App\Director::find($p_directors_list[$i])->name;
                  $directors->push($p_director);
                } catch (Exception $e) {

                }
              }
            }

            // Actors list of movie from model
            $actors = collect();
            if ($movie->actor_id != null) {
              $p_actors_list = explode(',', $movie->actor_id);
              for($i = 0; $i < count($p_actors_list); $i++) {
                try {
                  $p_actor = \App\Actor::find($p_actors_list[$i])->name;
                  $actors->push($p_actor);
                } catch (Exception $e) {

                }
              }
            }

            // Genre list of movie from model
            $genres = collect();
            if (isset($movie->genre_id)){
              $genre_list = explode(',', $movie->genre_id);
              for ($i = 0; $i < count($genre_list); $i++) {
                try {
                  $genre = \App\Genre::find($genre_list[$i])->name;
                  $genres->push($genre);
                } catch (Exception $e) {

                }
              }
            }

          @endphp
          <div class="row">
            <div class="col-md-8">
              <div class="full-movie-dtl-block">
                <h2 id="full-movie-name" class="section-heading">{{$movie->title}}</h2>
                <div class="imdb-ratings-block">
                  <ul>
                    @if(isset($movie->publish_year))<li>{{$movie->publish_year}}</li>@endif
                     @if($movie->live!=1)
                    @if(isset($movie->duration))<li>{{$movie->duration}} {{__('Mins')}}</li>@endif
                    @endif
                    @if(isset($movie->maturity_rating))<li>{{$movie->maturity_rating}}</li>@endif
                     @if($movie->live!=1)
                      @if($configs->user_rating != 1)
                        @if(isset($movie->rating))<li>{{__('Tmdb Rating')}} {{$movie->rating}}</li>@endif
                      @endif
                    @endif
                     
                    <li><i title="views" class="fa fa-eye"></i> {{ views($movie)
                      ->unique()
                      ->count() + $movie->views}}
                    </li>
                    <li data-toggle="modal" href="#sharemodal">
                      <i title="Share" class="fa fa-share-alt" aria-hidden="true"></i>
                    </li>
                    @if($configs->user_rating==1)
                      <li>
                        <div class="dropdown rating-dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-star"></i> {{__('Rate Movie')}}
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                           
                              @auth
                             
                                @php
                                  $uid=auth()->user()->id;
                                  $rating=App\UserRating::where('user_id',$uid)->where('movie_id',$movie->id)->first();
                                  
                                  @endphp
                              {!! Form::open(['method' => 'POST', 'id'=>'formrating', 'action' => 'UserRatingController@store']) !!}
                              
                                <input type="text" hidden="" name="movie_id" value="{{$movie->id}}">
                                <input type="text" hidden="" name="user_id" value="{{$auth->id}}">
                                <input id="rating" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="0.5"  value="{{isset($rating) ? $rating->rating: 0}}">
                              
                            
                              <div class="form-group">
                                <textarea class="form-control" rows="5" id="comment" name="review" placeholder="Write your review here">{{isset($rating) ? $rating->review : ''}}</textarea>
                              </div>
                              <button type="submit" class="btn btn-default">{{__('Submit a review')}}</button>
                             
                              @endauth
                              @guest
                              <a href="{{url('login')}}" class="btn btn-default">{{__('Login to leave a review')}}</a>
                              @endguest
                              {!!Form::close()!!} 
                          </ul>
                        </div>
                      </li>
                      @endif

                  </ul>
                </div>
                

                 <div id="wishlistelement" class="screen-play-btn-block ">
                @if($auth && getSubscription()->getData()->subscribed == true)
                  @if($movie->is_upcoming != 1)
                    @if(checkInMovie($movie) == true && isset($movie->video_link)) 
                      @if($movie->maturity_rating == 'all age' || $age>=str_replace('+', '',$movie->maturity_rating))
                        @if(isset($movie->video_link['iframeurl']) && $movie->video_link['iframeurl'] != null)
                          
                          <a href="{{route('watchmovieiframe',$movie->id)}}"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                          </a>
                
                        @else

                          <a href="{{route('watchmovie',$movie->id)}}" class="watch-trailer-btn iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                            </a>
                            
                        @endif
                      @else

                        <a onclick="myage({{$age}})"  class="watch-trailer-btn btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                        </a>
                        
                      @endif
                    @endif
                  @endif
                  @if($movie->trailer_url != null || $movie->trailer_url != '')
                    <a href="{{ route('watchTrailer',$movie->id)  }}" class="watch-trailer-btn iframe btn btn-default">{{__('Watch Trailer')}}</a>
                  @endif
                @else
                   @if($movie->trailer_url != null || $movie->trailer_url != '')
                    <a href="{{ route('guestwatchtrailer',$movie->id)  }}" class="watch-trailer-btn iframe btn btn-default">{{__('Watch Trailer')}}</a>
                  @endif
                @endif
                @if($catlog ==0 && getSubscription()->getData()->subscribed == true)
                  @if (isset($wishlist_check->added))
                    <a onclick="addWish({{$movie->id}},'{{$movie->type}}')" class="watch-trailer-btn addwishlistbtn{{$movie->id}}{{$movie->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</a>
                  @else
                    <a onclick="addWish({{$movie->id}},'{{$movie->type}}')" class="watch-trailer-btn addwishlistbtn{{$movie->id}}{{$movie->type}} btn-default">{{__('Add to Watchlist')}}</a>
                  @endif
                @elseif($catlog ==1 && $auth)
                  @if (isset($wishlist_check->added))
                    <a onclick="addWish({{$movie->id}},'{{$movie->type}}')" class="watch-trailer-btn addwishlistbtn{{$movie->id}}{{$movie->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</a>
                  @else
                    <a onclick="addWish({{$movie->id}},'{{$movie->type}}')" class="watch-trailer-btn addwishlistbtn{{$movie->id}}{{$movie->type}} btn-default">{{__('Add to Watchlist')}}</a>
                  @endif
                @endif
                 
                @php
                 $mlc = array();
                  if(isset($movie->multilinks)){
                    foreach ($movie->multilinks as $key => $value) {
                       if($value->download == 1){
                        $mlc[] = 1;
                       }else{
                          $mlc[] = 0;
                       }
                    }
                  }
                @endphp

                @if(isset($movie->multilinks) && count($movie->multilinks) > 0 )   
                  @if(Auth::user() && getSubscription()->getData()->subscribed == true)
                    @if(in_array(1, $mlc))
                      <button type="button" class="watch-trailer-btn btn btn-default" data-toggle="collapse" data-target="#downloadmovie">{{__('download')}}</button>

                      <div id="downloadmovie" class="collapse">
                        <table  class=" text-center table table-bordered table-responsive detail-multiple-link">
                          <thead>
                            <th align="center">#</th>
                            <th align="center">{{__('Download')}}</th>
                            <th align="center">{{__('Quality')}}</th>
                            <th align="center">{{__('Size')}}</th>
                            <th align="center">{{__('Language')}}</th>
                            <th align="center">{{__('Clicks')}}</th>
                            <th align="center">{{__('User')}}</th>
                            <th align="center">{{__('Added')}}</th>
                          </thead>
                     
                          <tbody>
                            @foreach($movie->multilinks as $key=> $link)
                              @if($link->download == 1)
                                <tr>
                                  @php
                                    $lang = App\AudioLanguage::where('id',$link->language)->first();
                                  @endphp

                                  <td align="center">{{$key+1}}</td>
                                  <td align="center"><a data-id="{{$link->id}}" class="download btn btn-sm btn-success" title="{{__('Download')}}" href="{{$link->url}}" ><i class="fa fa-download"></i></td>
                                  <td align="center">{{$link->quality}}</td>
                                  <td align="center">{{$link->size}}</td>
                                  <td align="center">@if(isset($lang)){{$lang->language}}@endif</td>
                                  <td>{{$link->clicks}}</td>
                                  <td align="center">{{$link->movie->user->name}}</td>
                                  <td align="center">{{date('Y-m-d',strtotime($link->created_at))}}</td>
                                </tr>
                              @endif
                            @endforeach
                          </tbody>
                          
                        </table>
                      </div>
                    @endif
                  @endif
                @endif
              </div>
                <p>
                  {{$movie->detail}}
                </p>
              </div>
              <div class="screen-casting-dtl">
                <ul class="casting-headers">
                  @if($movie->live!=1)
                   @if (count($directors) > 0)
                      <li>{{__('Directors')}} : 
                        <span class="categories-count">
                            @for($i = 0; $i < count($directors); $i++)
                              @if($i == count($directors)-1)
                                <a href="{{url('video/detail/director_search', trim($directors[$i]))}}">{{$directors[$i]}}</a>
                              @else
                                <a href="{{url('video/detail/director_search', trim($directors[$i]))}}">{{$directors[$i]}}</a>,
                              @endif
                            @endfor
                        </span>
                      </li>
                    @endif
                    @if (count($actors) > 0)
                     <li>{{__('Starring')}} : 
                        <span class="categories-count">
                            @for($i = 0; $i < count($actors); $i++)
                              @if($i == count($actors)-1)
                                <a href="{{url('video/detail/actor_search', trim($actors[$i]))}}">{{$actors[$i]}}</a>
                              @else
                                <a href="{{url('video/detail/actor_search', trim($actors[$i]))}}">{{$actors[$i]}}</a>,
                              @endif
                            @endfor
                        </span>
                     </li>
                    @endif
                  @endif
                  @if (count($genres) > 0)
                   <li>{{__('Genres')}} : 
                      <span class="categories-count">
                          @for($i = 0; $i < count($genres); $i++)
                            @if($i == count($genres)-1)
                              <a href="{{url('video/detail/genre_search', trim($genres[$i]))}}">{{$genres[$i]}}</a>
                            @else
                              <a href="{{url('video/detail/genre_search', trim($genres[$i]))}}">{{$genres[$i]}}</a>,
                            @endif
                          @endfor
                      </span>
                    </li>
                  @endif
                  <li>{{__('Uploaded By')}} : 
                      <span class="categories-count">
                      {{$movie->user->name}}
                      </span>
                  </li>
                  @if(count($movie->subtitles)>0)
                    <li>{{__('subtitles')}} : 
                      <span class="categories-count">
                          @foreach($movie->subtitles as $key=> $sub)
                           @if($key == count($movie->subtitles)-1)
                            {{ $sub['sub_lang'] }}
                           @else
                             {{ $sub['sub_lang'] }},
                           @endif
                          @endforeach  
                      </span>
                    </li>
                  @endif
                  @if (count($a_languages) > 0)
                    <li>{{__('Audio Language')}} : 
                       <span class="categories-count">
                          @if($movie->a_language != null && isset($a_languages))
                            @for($i = 0; $i < count($a_languages); $i++)
                              @if($i == count($a_languages)-1)
                                {{$a_languages[$i]}}
                              @else
                                {{$a_languages[$i]}},
                              @endif
                            @endfor
                          @else
                            -
                          @endif
                       </span>
                    </li>
                  @endif
                </ul>
          
              </div>
              
            </div>
            @if($button->remove_thumbnail == 0)
             
            <div class="col-md-4">
              <div id="poster-thumbnail" class="poster-thumbnail-block home-prime-slider">
                @if($movie->thumbnail != null || $movie->thumbnail != '')
                <img data-src="{{url('images/movies/thumbnails/'.$movie->thumbnail)}}" class="img-responsive lazy" alt="genre-image">
              @else
                <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-responsive lazy" alt="genre-image">
              @endif
               
              </div>
            </div>
            @endif
          </div>
        @elseif(isset($season))
          @php
            $subtitles = collect();
            if ($season->subtitle == 1) {
              $subtitle_list = explode(',', $season->subtitle_list);
              for($i = 0; $i < count($subtitle_list); $i++) {
                try {
                  $subtitle = \App\AudioLanguage::find($subtitle_list[$i])->language;
                  $subtitles->push($subtitle);
                } catch (Exception $e) {
                }
              }
            }
            $a_languages = collect();
            if ($season->a_language != null) {
              $a_lan_list = explode(',', $season->a_language);
              for($i = 0; $i < count($a_lan_list); $i++) {
                try {
                  $a_language = \App\AudioLanguage::find($a_lan_list[$i])->language;
                  $a_languages->push($a_language);
                } catch (Exception $e) {
                }
              }
            }
             if(isset($auth)){
            $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                          ['user_id', '=', $auth->id],
                                                                          ['season_id', '=', $season->id],
                                                                         ])->first();
                                                                       }
            // Actors list of movie from model
            $actors = collect();
            if ($season->actor_id != null) {
              $p_actors_list = explode(',', $season->actor_id);
              for($i = 0; $i < count($p_actors_list); $i++) {
                try {
                  $p_actor = \App\Actor::find(trim($p_actors_list[$i]))->name;
                  $actors->push($p_actor);
                } catch (Exception $e) {
                }
              }
            }

            // Genre list of movie from model
            $genres = collect();
            if ($season->tvseries->genre_id != null){
              $genre_list = explode(',', $season->tvseries->genre_id);
              for ($i = 0; $i < count($genre_list); $i++) {
                try {
                  $genre = \App\Genre::find($genre_list[$i])->name;
                  $genres->push($genre);
                } catch (Exception $e) {
                }
              }
            }
          @endphp
          <div class="row">
            <div class="col-md-8">
              <div class="full-movie-dtl-block">
                <h2 id="full-movie-name" class="section-heading">{{$season->tvseries->title}}</h2>
                 <br/>
                <select style="width:20%;-webkit-box-shadow: none;box-shadow: none;color: #FFF;background: #000;display: block;clear: both;border: 1px solid #666;border-radius: 0;" name="" id="selectseason" class="form-control">
                  @foreach($season->tvseries->seasons as $allseason)

                  <option {{ $season->season_slug == $allseason->season_slug ? "selected" : "" }} value="{{ $allseason->season_slug }}">{{__('Season')}} {{ $allseason->season_no }}</option>
                  
                  @endforeach
                </select>
                <br>
                <div class="imdb-ratings-block">
                  <ul>
                    @if(isset($season->publish_year))<li>{{$season->publish_year}}</li>@endif
                    @if(isset($season->season_no))<li>{{$season->season_no}} {{__('Season')}}</li>@endif
                    @if(isset($season->tvseries->age_req))<li>{{$season->tvseries->age_req}}</li>@endif
                    @if($configs->user_rating != 1)
                     @if(isset($season->tvseries->rating))<li>{{__('Tmdb Rating')}} {{$season->tvseries->rating}}</li>@endif
                    @endif
                    
                      <li><i title="views" class="fa fa-eye"></i> {{ views($season)
                        ->unique()
                        ->count() + $season->views }}</li>

                      <li data-toggle="modal" href="#sharemodal">
                        
                        <i title="Share" class="fa fa-share-alt" aria-hidden="true"></i>

                      </li>
                      @if($configs->user_rating==1)
                      <li>
                        <div class="dropdown rating-dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-star"></i> {{__('Rate Movie')}}
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                           
                              @auth
                             
                                @php
                                  $uid=auth()->user()->id;
                                  $rating=App\UserRating::where('user_id',$uid)->where('tv_id',$season->tvseries->id)->first();
                                  $avg_rating=App\UserRating::where('tv_id',$season->tvseries->id)->avg('rating');
                                  @endphp
                               {!! Form::open(['method' => 'POST', 'id'=>'formratingtv', 'action' => 'UserRatingController@store']) !!}
                               <input type="text" hidden="" name="tv_id" 
                               value="{{$season->tvseries->id}}">
                                 <input type="text" hidden="" name="user_id" value="{{$auth->id}}">
                               <input id="rating" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{isset($rating)? $rating->rating: 2}}">
                            
                            
                              <div class="form-group">
                                <textarea class="form-control" rows="5" id="comment" name="review" placeholder="Write your review here">{{isset($rating) ? $rating->review : ''}}</textarea>
                              </div>
                              <button type="submit" class="btn btn-default">{{__('Submit a review')}}</button>
                             
                              @endauth
                              @guest
                              <a href="{{url('login')}}" class="btn btn-default">{{__('Login to leave a review')}}</a>
                              @endguest
                              {!!Form::close()!!} 
                          </ul>
                        </div>
                      </li>
                      @endif
                   
                  </ul>

                </div>
                

                <div class="screen-play-btn-block">
                 @if($auth && getSubscription()->getData()->subscribed == true)
                  @if(isset($season->episodes[0]) && checkInTvseries($season->tvseries) == true && isset($season->episodes[0]->video_link))
                    @if($season->tvseries->age_req =='all age' || $age>=str_replace('+', '',$season->tvseries->age_req))
                      @if($season->episodes[0]->video_link['iframeurl'] !="")
                       
                        <a href="#" onclick="playoniframe('{{ $season->episodes[0]->video_link['iframeurl'] }}','{{ $season->tvseries->id }}','tv')" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                        </a>
                      @else
                        <a href="{{ route('watchTvShow',$season->id)  }}" class="watch-trailer-btn iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span></a>
                      @endif
                    @else
                      <a  onclick="myage({{$age}})" class="watch-trailer-btn btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span></a>
                    @endif
                  @endif
                   @if($season->trailer_url != null || $season->trailer_url != '')
                    <a href="{{ route('watchtvTrailer',$season->id)  }}" class="watch-trailer-btn iframe btn btn-default">{{__('Watch Trailer')}}</a>
                  @endif
                @else
                   @if($season->trailer_url != null || $season->trailer_url != '')
                    <a href="{{ route('guestwatchtvtrailer',$season->id)  }}" class="watch-trailer-btn iframe btn btn-default">{{__('Watch Trailer')}}</a>
                  @endif
                @endif
                @if($catlog == 0 && getSubscription()->getData()->subscribed == true)
                  @if (isset($wishlist_check->added))
                    <a onclick="addWish({{$season->id}},'{{$season->type}}')" class="watch-trailer-btn addwishlistbtn{{$season->id}}{{$season->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</a>
                  @else
                    <a onclick="addWish({{$season->id}},'{{$season->type}}')" class="watch-trailer-btn addwishlistbtn{{$season->id}}{{$season->type}} btn-default">{{__('Add to Watchlist')}}</a>
                  @endif
                @elseif($catlog ==1 && $auth)
                  @if (isset($wishlist_check->added))
                    <a onclick="addWish({{$season->id}},'{{$season->type}}')" class="watch-trailer-btn addwishlistbtn{{$season->id}}{{$season->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</a>
                  @else
                    <a onclick="addWish({{$season->id}},'{{$season->type}}')" class="watch-trailer-btn addwishlistbtn{{$season->id}}{{$season->type}} btn-default">{{__('Add to Watchlist')}}</a>
                  @endif
                @endif
              </div>
                <p>
                  @if ($season->detail != null || $season->detail != '')
                    {{$season->detail}}
                  @else
                    {{$season->tvseries->detail}}
                  @endif
                </p>
              </div>
              <div class="screen-casting-dtl">
                <ul class="casting-headers">
                  @if (count($actors) > 0)
                    <li>{{__('Starring')}} : 
                       <span class="categories-count">
                          @for($i = 0; $i < count($actors); $i++)
                            @if($i == count($actors)-1)
                              <a href="{{url('video/detail/actor_search', trim($actors[$i]))}}">{{$actors[$i]}}</a>
                            @else
                              <a href="{{url('video/detail/actor_search', trim($actors[$i]))}}">{{$actors[$i]}}</a>,
                            @endif
                          @endfor
                       </span>
                    </li>
                  @endif
                  @if (count($genres) > 0)
                    <li>{{__('Genres')}} : 
                       <span class="categories-count">
                          @for($i = 0; $i < count($genres); $i++)
                            @if($i == count($genres)-1)
                              <a href="{{url('video/detail/genre_search', trim($genres[$i]))}}">{{$genres[$i]}}</a>
                            @else
                              <a href="{{url('video/detail/genre_search', trim($genres[$i]))}}">{{$genres[$i]}}</a>,
                            @endif
                          @endfor
                       </span>
                    </li>
                  @endif
                  <li>{{__('Uploaded By')}} : 
                      <span class="categories-count">
                      {{isset($season->user) && $season->user->name}}
                      </span>
                  </li>

                  @if($season->a_language != null && isset($a_languages))
                    <li>{{__('Audio language')}} : 
                       <span class="categories-count">
                          @for($i = 0; $i < count($a_languages); $i++)
                            @if($i == count($a_languages)-1)
                              {{$a_languages[$i]}}
                            @else
                              {{$a_languages[$i]}},
                            @endif
                          @endfor
                       </span>
                    </li>
                  @endif
                </ul>
              </div>
               
             
            </div>
            @if($button->remove_thumbnail == 0)
             
            <div class="col-md-4">
              <div id="poster-thumbnail" class="poster-thumbnail-block home-prime-slider">
                @if($season->thumbnail != null)
                <img data-src="{{url('images/tvseries/thumbnails/'.$season->thumbnail)}}" class="img-responsive lazy" alt="genre-image">
              @elseif($season->tvseries->thumbnail != null)
                <img data-src="{{url('images/tvseries/thumbnails/'.$season->tvseries->thumbnail)}}" class="img-responsive lazy" alt="genre-image">
              @else
                <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-responsive lazy" alt="genre-image">
              @endif
               
              </div>
            </div>
            @endif
          </div>
        @endif
      </div>
    </div>
    <!-- movie series -->
    @if(isset($movie->movie_series) && $movie->series != 1)
      @if(count($movie->movie_series) > 0)
        <div class="container-fluid movie-series-section search-section">
          <h5 class="movie-series-heading">{{count($movie->movie_series)}} Series </h5>
          <div>
            @foreach($movie->movie_series as $series)
              @php
                $single_series = \App\Movie::where('id', $series->series_movie_id)->first();
               if(isset($auth)){
              
                $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                            ['user_id', '=', $auth->id],
                                                                            ['movie_id', '=', $single_series->id],
                                                                           ])->first();
                                                                         }
                
              @endphp
              <div class="movie-series-block movie-section">
                <div class="row">
                  <div class="col-lg-2">
                    <div class="movie-series-img home-prime-slider">
                      @if($single_series->thumbnail != null || $single_series->thumbnail != '')
                      <img src="{{url('images/movies/thumbnails/'.$single_series->thumbnail)}}" class="img-responsive lazy" alt="movie-image">
                    @else
                      <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-responsive lazy" alt="movie-image">
                    @endif
                     
                    </div>
                  </div>
                  <div class="col-lg-10">
                    <div class="movie-series-section">
                      <div class="row">
                        <div class="col-lg-8"> 
                          @if($auth && getSubscription()->getData()->subscribed == true)
                            <h5 class="movie-series-heading movie-series-name"><a href="{{url('movie/detail', $single_series->slug)}}">{{$single_series->title}}</a></h5>
                          @else
                            <h5 class="movie-series-heading movie-series-name"><a href="{{url('movie/guest/detail', $single_series->slug)}}">{{$single_series->title}}</a></h5>
                          @endif
                        </div>
                        <div class="col-lg-4">
                          <ul class="movie-series-des-list">
                            <li>{{$single_series->duration}} {{__('Mins')}}</li>
                          </ul>
                        </div>
                      </div>
                      <p>
                        {{str_limit($single_series->detail,360)}}
                        @if($auth && getSubscription()->getData()->subscribed == true)
                          <a href="{{url('movie/detail', $single_series->slug)}}">{{__('Read More')}}</a>
                        @else
                          <a href="{{url('movie/guest/detail', $single_series->slug)}}">{{__('Read More')}}</a>
                        @endif
                      </p>
                     
                    <div class="des-btn-block des-in-list">
                    @if($auth && getSubscription()->getData()->subscribed == true && checkInMovie($single_series) == true && isset($single_series->video_link))
                    @if(isset($single_series) && $single_series->is_upcoming != 1)
                      @if($single_series->maturity_rating == 'all age' || $age>=str_replace('+', '',$single_series->maturity_rating))
                        @if(isset($single_series->video_link['iframeurl']) && $single_series->video_link['iframeurl'] != null)
                          
                          <a href="{{route('watchmovieiframe',$single_series->id)}}"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                           </a>
                 
                        @else

                          <a href="{{route('watchmovie',$single_series->id)}}" class="watch-trailer-btn iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                            </a>
                            
                        @endif
                      @else

                        <a onclick="myage({{$age}})"  class="watch-trailer-btn btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                        </a>
                        
                      @endif
                    @endif
                      @if($single_series->trailer_url != null || $single_series->trailer_url != '')
                        <a href="{{ route('watchTrailer',$single_series->id)  }}" class="iframe btn btn-default">{{__('Watch Trailer')}}</a>
                      @endif
                    @else
                       @if($single_series->trailer_url != null || $single_series->trailer_url != '')
                        <a href="{{ route('guestwatchtrailer',$single_series->id)  }}" class="iframe btn btn-default">{{__('Watch Trailer')}}</a>
                      @endif
                    @endif
                    @if($catlog ==0 && getSubscription()->getData()->subscribed == true)
                      @if (isset($wishlist_check->added))
                        <a onclick="addWish({{$single_series->id}},'{{$single_series->type}}')" class="addwishlistbtn{{$single_series->id}}{{$single_series->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</a>
                      @else
                        <a onclick="addWish({{$single_series->id}},'{{$single_series->type}}')" class="addwishlistbtn{{$single_series->id}}{{$single_series->type}} btn-default">{{__('Add to Watchlist')}}</a>
                      @endif
                    @elseif($catlog ==1 && $auth)
                      @if (isset($wishlist_check->added))
                        <a onclick="addWish({{$single_series->id}},'{{$single_series->type}}')" class="addwishlistbtn{{$single_series->id}}{{$single_series->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</a>
                      @else
                        <a onclick="addWish({{$single_series->id}},'{{$single_series->type}}')" class="addwishlistbtn{{$single_series->id}}{{$single_series->type}} btn-default">{{__('Add to Watchlist')}}</a>
                      @endif
                    @endif
                     
                    @php
                     $mlc = array();
                      if(isset($single_series->multilinks)){
                        foreach ($single_series->multilinks as $key => $value) {
                           if($value->download == 1){
                            $mlc[] = 1;
                           }else{
                              $mlc[] = 0;
                           }
                        }
                      }
                    @endphp

                    @if(isset($single_series->multilinks) && count($single_series->multilinks) > 0 )   
                      @if(Auth::user() && getSubscription()->getData()->subscribed == true)
                        @if(in_array(1, $mlc))
                           <button type="button" class="btn btn-sm btn-default watch-trailer-btn download-btn" data-toggle="collapse" data-target="#downloadmovie{{$single_series->id}}">{{__('download')}}</button>

                          <div id="downloadmovie{{$single_series->id}}" class="collapse">
                            <table  class=" text-center table table-bordered table-responsive detail-multiple-link">
                              <thead>
                                <th align="center">#</th>
                                <th align="center">{{__('Download')}}</th>
                                <th align="center">{{__('Quality')}}</th>
                                <th align="center">{{__('Size')}}</th>
                                <th align="center">{{__('Language')}}</th>
                                <th align="center">{{__('Clicks')}}</th>
                                <th align="center">{{__('User')}}</th>
                                <th align="center">{{__('Added')}}</th>
                              </thead>
                         
                              <tbody>
                                
                               @foreach($single_series->multilinks as $key=> $link)
                                
                                  @if($link->download == 1)
                                    <tr>

                                      @php
                                    
                                        $lang = App\AudioLanguage::where('id',$link->language)->first();
                                      @endphp

                                      <td align="center">{{$key+1}}</td>
                                      <td align="center"><a data-id="{{$link->id}}" class="download btn btn-sm btn-success" title="{{__('Download')}}" href="{{$link->url}}" ><i class="fa fa-download"></i></td>
                                      <td align="center">{{$link->quality}}</td>
                                      <td align="center">{{$link->size}}</td>
                                      <td align="center">@if(isset($lang)){{$lang->language}}@endif</td>
                                      <td>{{$link->clicks}}</td>
                                      <td align="center">{{$link->movie->user->name}}</td>
                                      <td align="center">{{date('Y-m-d',strtotime($link->created_at))}}</td>
                                     
                                      
                                    </tr>

                                  @endif

                                @endforeach
                              
                              </tbody>
                              
                            </table>
                          </div>
                        @endif
                      @endif
                    @endif
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endif
    @endif
    @if(isset($filter_series) && $movie->series == 1)
      @if(count($filter_series) > 0)
        <div class="container-fluid movie-series-section search-section">
          <h5 class="movie-series-heading">SEries{{count($filter_series)}}</h5>
          <div>
            @foreach($filter_series as $key => $series)
              @php
               if(isset($auth)){
                $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                            ['user_id', '=', $auth->id],
                                                                            ['movie_id', '=', $series->id],
                                                                           ])->first();
                                                                     }
               
              @endphp
              <div class="movie-series-block movie-section">
                <div class="row">
                  <div class="col-lg-2">
                    <div class="movie-series-img home-prime-slider">
                      @if($series->thumbnail != null)
                        <img src="{{url('images/movies/thumbnails/'.$series->thumbnail)}}" class="img-responsive lazy" alt="movie-image">
                      @else
                        <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-responsive lazy" alt="movie-image">
                      @endif
                    
                    </div>
                  </div>
                  <div class="col-lg-10">
                    <div class="movie-series-section">
                      <div class="row">
                        <div class="col-lg-8"> 
                          @if($auth && getSubscription()->getData()->subscribed == true)
                            <h5 class="movie-series-heading movie-series-name"><a href="{{url('movie/detail', $series->slug)}}">{{$series->title}}</a></h5>
                          @else
                            <h5 class="movie-series-heading movie-series-name"><a href="{{url('movie/guest/detail', $series->slug)}}">{{$series->title}}</a></h5>
                          @endif
                        </div>
                        <div class="col-lg-4">
                          <ul class="movie-series-des-list">
                            
                            <li>{{$series->duration}} {{__('Mins')}}</li>
                          </ul>
                        </div>
                      </div>
                      <p>
                        {{str_limit($series->detail,360)}}
                        @if($auth && getSubscription()->getData()->subscribed == true)
                          <a href="{{url('movie/detail', $series->slug)}}">{{__('Read More')}}</a>
                        @else
                          <a href="{{url('movie/guest/detail', $series->slug)}}">{{__('Read More')}}</a>
                        @endif
                      </p>
                     
                    <div class="des-btn-block des-in-list">
                      @if($auth && getSubscription()->getData()->subscribed == true && checkInMovie($series) == true && isset($series->video_link))
                      @if(isset($series) && $series->is_upcoming != 1)
                        @if($series->maturity_rating == 'all age' || $age>=str_replace('+', '',$series->maturity_rating))
                          @if(isset($series->video_link['iframeurl']) && $series->video_link['iframeurl'] != null)
                            
                            <a href="{{route('watchmovieiframe',$series->id)}}"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                             </a>
                   
                          @else

                            <a href="{{route('watchmovie',$series->id)}}" class="iframe watch-trailer-btn btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                              </a>
                              
                          @endif
                        @else

                          <a onclick="myage({{$age}})"  class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                          </a>
                          
                        @endif
                        @endif
                        @if($series->trailer_url != null || $series->trailer_url != '')
                          <a href="{{ route('watchTrailer',$series->id)  }}" class="iframe watch-trailer-btn btn btn-default">{{__('Watch Trailer')}}</a>
                        @endif
                      @else
                         @if($series->trailer_url != null || $series->trailer_url != '')
                          <a href="{{ route('guestwatchtrailer',$series->id)  }}" class="iframe watch-trailer-btn btn btn-default">{{__('Watch Trailer')}}</a>
                        @endif
                      @endif
                      @if($catlog ==0 && getSubscription()->getData()->subscribed == true)
                        @if (isset($wishlist_check->added))
                          <a onclick="addWish({{$series->id}},'{{$series->type}}')" class="watch-trailer-btn addwishlistbtn{{$series->id}}{{$series->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</a>
                        @else
                          <a onclick="addWish({{$series->id}},'{{$series->type}}')" class="watch-trailer-btn addwishlistbtn{{$series->id}}{{$series->type}} btn-default">{{__('Add to Watchlist')}}</a>
                        @endif
                      @elseif($catlog ==1 && $auth)
                        @if (isset($wishlist_check->added))
                          <a onclick="addWish({{$series->id}},'{{$series->type}}')" class="watch-trailer-btn addwishlistbtn{{$series->id}}{{$series->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</a>
                        @else
                          <a onclick="addWish({{$series->id}},'{{$series->type}}')" class="watch-trailer-btn addwishlistbtn{{$series->id}}{{$series->type}} btn-default">{{__('Add to Watchlist')}}</a>
                        @endif
                      @endif
                       
                      @php
                       $mlc = array();
                        if(isset($series->multilinks)){
                          foreach ($series->multilinks as $key => $value) {
                             if($value->download == 1){
                              $mlc[] = 1;
                             }else{
                                $mlc[] = 0;
                             }
                          }
                        }
                      @endphp

                      @if(isset($series->multilinks) && count($series->multilinks) > 0 )   
                        @if(Auth::user() && getSubscription()->getData()->subscribed == true)
                          @if(in_array(1, $mlc))
                             <button type="button" class="btn btn-sm btn-default watch-trailer-btn download-btn" data-toggle="collapse" data-target="#downloadmovie{{$series->id}}">{{__('download')}}</button>

                            <div id="downloadmovie{{$series->id}}" class="collapse">
                              <table  class=" text-center table table-bordered table-responsive detail-multiple-link">
                                <thead>
                                  <th align="center">#</th>
                                  <th align="center">{{__('Download')}}</th>
                                  <th align="center">{{__('Quality')}}</th>
                                  <th align="center">{{__('Size')}}</th>
                                  <th align="center">{{__('Language')}}</th>
                                  <th align="center">{{__('Clicks')}}</th>
                                  <th align="center">{{__('User')}}</th>
                                  <th align="center">{{__('Added')}}</th>
                                </thead>
                           
                                <tbody>
                                  
                                 @foreach($series->multilinks as $key=> $link)
                                  
                                    @if($link->download == 1)
                                      <tr>

                                        @php
                                      
                                          $lang = App\AudioLanguage::where('id',$link->language)->first();
                                        @endphp

                                        <td align="center">{{$key+1}}</td>
                                        <td align="center"><a data-id="{{$link->id}}" class="download btn btn-sm btn-success" title="{{__('Download')}}" href="{{$link->url}}" ><i class="fa fa-download"></i></td>
                                        <td align="center">{{$link->quality}}</td>
                                        <td align="center">{{$link->size}}</td>
                                        <td align="center">@if(isset($lang)){{$lang->language}}@endif</td>
                                        <td>{{$link->clicks}}</td>
                                        <td align="center">{{$link->movie->user->name}}</td>
                                        <td align="center">{{date('Y-m-d',strtotime($link->created_at))}}</td>
                                       
                                        
                                      </tr>

                                    @endif

                                  @endforeach
                                
                                </tbody>
                                
                              </table>
                            </div>
                          @endif
                        @endif
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endif
    @endif
    <br/>
    <!-- end movie series -->

    <!-- episodes -->
    @if(isset($season->episodes))
      @if(count($season->episodes) > 0)
        <div class="container-fluid movie-series-section search-section">
          <h5 class="movie-series-heading">{{__('Episodes')}} {{count($season->episodes)}}</h5>
          <div>
            @foreach($season->episodes as $key => $episode)
             
              <div class="movie-series-block movie-section">
                <div  class="row">
                  <div class="col-lg-2">
                    <div class="movie-series-img home-prime-slider">
                      @if($episode->thumbnail != null)
                      <img data-src="{{url('images/tvseries/episodes/'.$episode->thumbnail)}}" class="img-responsive lazy" alt="genre-image">
                    @elseif($episode->thumbnail != null)
                      <img data-src="{{url('images/tvseries/episodes/'.$episode->thumbnail)}}" class="img-responsive lazy" alt="genre-image">
                    @else
                      <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-responsive lazy" alt="genre-image">
                    @endif
                     
                    </div>
                  </div>
                   
                  <div class="col-lg-10">
                     <div class="movie-series-section">
                      <div class="row">
                        <div class="col-lg-8"> 
                          @if($auth && getSubscription()->getData()->subscribed == true && checkInTvseries($episode->seasons->tvseries) == true && isset($episode->video_link))
                            @if($episode->seasons->tvseries->maturity_rating =='all age' || $age>=str_replace('+', '',$episode->seasons->tvseries->maturity_rating))
                              @if($episode->video_link['iframeurl'] !="")
                                 <a onclick="playoniframe('{{ $episode->video_link['iframeurl'] }}','{{ $episode->seasons->tvseries->id }}','tv')" class="btn btn-play btn-sm-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><h5 class="movie-series-heading movie-series-name">{{$key+1}}. {{$episode->title}}</h5></span></a>
                              @else
                                 <a href="{{ route('watch.Episode', $episode->id) }}" class="iframe watch-trailer-btn btn btn-play btn-sm-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><h5 class="movie-series-heading movie-series-name">{{$key+1}}. {{$episode->title}}</h5></span></a>
                              @endif
                            @else
                              <a onclick="myage({{$age}})" class="btn btn-play watch-trailer-btn btn-sm-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text"><h5 class="movie-series-heading movie-series-name">{{$key+1}}. {{$episode->title}}</h5></span></a>
                            @endif
                          @else
                            <h5 class="movie-series-heading movie-series-name">{{$key+1}}. {{$episode->title}}</h5>
                          @endif
                        </div>
                        <div class="col-lg-4">
                          @if(isset($episode->duration) && $episode->duration != '')
                          <ul class="movie-series-des-list">
                            <li>{{$episode->duration}} {{__('Mins')}}</li>
                          </ul>
                          @endif
                        </div>
                      </div>
                    
                      <p>
                        {{$episode->detail}}
                      </p>
                   
                        

                      @php
                         $elc = array();
                        if(isset($episode->multilinks)){
                          foreach ($episode->multilinks as $key => $value) {
                             if($value->download == 1){
                              $elc[] = 1;
                             }else{
                                $elc[] = 0;
                             }
                          }
                        }
                      @endphp
                      @if(isset($episode->multilinks) &&  count($episode->multilinks) >0)
                        @if(Auth::user() && getSubscription()->getData()->subscribed == true)
                          @if(in_array(1, $elc))

                           <button type="button" class="btn-default watch-trailer-btn" data-toggle="collapse" data-target="#downloadtvseries{{$episode->id}}">{{__('Download')}}</button>

                          <div id="downloadtvseries{{$episode->id}}" class="collapse">
                            <br/>
                            <table   class=" text-center table table-bordered table-responsive detail-multiple-link">
                              <thead>
                                <th align="center">#</th>
                                <th align="center">{{__('Download')}}</th>
                                <th align="center">{{__('Quality')}}</th>
                                <th align="center">{{__('Size')}}</th>
                                <th align="center">{{__('Language')}}</th>
                                <th align="center">{{__('Clicks')}}</th>
                                <th align="center">{{__('User')}}</th>
                                <th align="center">{{__('Added')}}</th>
                              </thead>
                         
                              <tbody>
                              
                                @foreach($episode->multilinks as $key=> $link)
                                 
                                  @if($link->download == 1)
                                  <tr>
                                     @php
                                  
                                    $lang = App\AudioLanguage::where('id',$link->language)->first();
                                  @endphp

                                    <td align="center">{{$key+1}}</td>
                                    <td align="center"><a data-id="{{$link->id}}" class="download btn btn-sm btn-success" title="download" href="{{$link->url}}" ><i class="fa fa-download"></i></td>
                                    <td align="center">{{$link->quality}}</td>
                                    <td align="center">{{$link->size}}</td>
                                    <td align="center">@if(isset($lang)){{$lang->language}}@endif</td>
                                    <td>{{$link->clicks}}</td>
                                    <td align="center">{{$link->episode->seasons->tvseries->user->name}}</td>
                                    <td align="center">{{date('Y-m-d',strtotime($link->created_at))}}</td>
                                   
                                    
                                  </tr>
                                  @endif
                                @endforeach
                            
                              </tbody>
                            
                            </table>
                          </div>
                 
                          @endif
                        @endif
                      @endif 
                    </div>
                  </div>
                </div>
              </div>

            @endforeach
          </div>
        </div>
      @endif
    @endif
</section>
<br/>


    {{-- comments section start from here --}}
@if(isset($movie))
  @if($configs->comments == 1 || $configs->user_rating == 1)
    
    <div class="container-fluid movie-series-section comment-nav-tabs">
       <!-- Nav tabs -->
      
      <ul class="nav nav-tabs" role="tablist" >
        @if($configs->comments == 1)
          <li role="presentation" class="active"><a href="#showcomment" aria-controls="showcomment" role="tab" data-toggle="tab" style="z-index:999;">{{__('Comment')}}</a></li>
        

          @if(getSubscription()->getData()->subscribed == true)
          <li role="presentation" style="z-index:999;"><a href="#postcomment" aria-controls="postcomment" role="tab" data-toggle="tab">{{__('Post Comment')}}</a></li>
          @endif
        @endif
        @if($configs->user_rating == 1)
        <li role="presentation" style="z-index:999;"><a href="#review" aria-controls="review" role="tab" data-toggle="tab">{{__('Review')}}</a></li>
        @endif
      </ul>
      <br/>
      <!-- Tab panes -->
      <div class="tab-content">
        @if($configs->comments == 1)
          <div role="tabpanel" class="tab-pane fade in active" id="showcomment">
            @if(isset($movie->comments) && $movie->comments->isEmpty())
            <div class="row text-center" style="color:#B1B1B1;">
              <h4 class="text-center"><i class="fa fa-comment-o"></i> &nbsp;{{__('No Comments yet!')}}</h4>&nbsp;
                <small class="text-center">{{__('Be the first to share what you think !')}}</small>
            </div>
              
            @else
              
              <h4 class="title" style="color:#B1B1B1;"><span class="glyphicon glyphicon-comment"></span> {{$movie->comments->where('status',1)->count()}} {{__('Comment')}} </h4> <br/>
              
                @foreach ($movie->comments->where('status','1') as $comment)

                    <div class="comment">
                      <div class="author-info">
                        <img src="{{ Avatar::create($comment->name )->toBase64() }}" class="author-image">
                        <div class="author-name">
                          <h4 class="author-heading">{{$comment->name}}</h4>
                          <p class="author-time">{{date('F jS, Y - g:i a',strtotime($comment->created_at))}}</p>
                        </div>
                        @if(Auth::check() && (Auth::user()->is_admin == 1 || $comment->user_id == Auth::user()->id))  
                        <button type="button" class="btn btn-danger btn-floating pull-right" data-toggle="modal" data-target="#deleteModal{{$comment->id}}" style="left:10px;position:relative;"><i class="fa fa-trash-o"></i></button>
                        @endif
                        @if(getSubscription()->getData()->subscribed == true)
                        <button type="button" class="btn btn-danger comment-btn btn-floating pull-right" data-toggle="modal" data-target="#{{$comment->id}}deleteModal"><i class="fa fa-reply"></i></button>
                        @endif
                      </div>

                      <div class="comment-content">
                      {{$comment->comment}}
                      </div>
                    </div>
                    <!-- ---------------- comment delete ------------>
                        <div id="deleteModal{{$comment->id}}" class="delete-modal  modal fade" role="dialog">
                          <div class="modal-dialog modal-sm">
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <div class="delete-icon"></div>
                              </div>
                              <div class="modal-body text-center">
                                <h4 class="modal-heading comment-delete-heading">{{__('Are You Sure')}}</h4>
                                <p class="comment-delete-detail">{{__('Model Message')}}</p>
                              </div>
                              <div class="modal-footer">
                                {!! Form::open(['method' => 'DELETE', 'action' => ['MovieCommentController@deletecomment', $comment->id]]) !!}
                                    <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                                    <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                                {!! Form::close() !!}
                              </div>
                            </div>
                          </div>
                        </div>
                      <!-------------------- end comment delete ------------------->
                  
                        
                          <!-- Modal -->
                        
                        
                  

                    @foreach($comment->subcomments->where('status',1) as $subcomment)

                      <div class="comment" style="margin-left:50px;">
                        <div class="author-info">
                          @php
                              $name=App\user::where('id',$subcomment->user_id)->first();
                            @endphp
                          <img src="{{ Avatar::create($name->name )->toBase64() }}" class="author-image">
                          <div class="author-name">
                          
                            <h5 class="author-heading">{{$name->name}}</h5>
                            <p class="author-time">{{date('F jS, Y - g:i a',strtotime($subcomment->created_at))}}</p>
                          </div>
                          @if(Auth::check() && (Auth::user()->is_admin == 1 || $subcomment->user_id == Auth::user()->id))
                        
                            <button type="button" class="btn btn-danger btn-floating comment-btn pull-right" data-toggle="modal" data-target="#subdeleteModal{{$subcomment->id}}"><i class="fa fa-trash-o"></i></button>
                          <div id="subdeleteModal{{$subcomment->id}}" class="delete-modal modal fade" role="dialog">
                          <div class="modal-dialog modal-sm">
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <div class="delete-icon"></div>
                              </div>
                              <div class="modal-body text-center">
                                <h4 class="modal-heading comment-delete-heading ">{{__('Are You Sure')}}</h4>
                                <p class="comment-delete-detail">{{__('Model Message')}}</p>
                              </div>
                              <div class="modal-footer">
                                {!! Form::open(['method' => 'DELETE', 'action' => ['MovieCommentController@deletesubcomment', $subcomment->id]]) !!}
                                    <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                                    <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                                {!! Form::close() !!}
                              </div>
                            </div>
                          </div>
                        </div>

                        
                        @endif
                        </div>

                        <div class="comment-content">
                        {{$subcomment->reply}}
                        </div>
                      
                      </div>
                    
                    @endforeach
                    <div id="{{$comment->id}}deleteModal" class="comment-modal modal fade" role="dialog"  style="margin-top: 20px;">
                            <div class="modal-dialog modal-md" style="margin-top:70px;">
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <div class="delete-icon"></div>
                                <h4 style="color:#FFF;"> {{__('Reply For')}} {{$comment->name}}</h4>
                                </div>
                                <div class="modal-body text-center">
                                  
                                    <form action="{{route('movie.comment.reply', ['cid' =>$comment->id])}}" method ="POST">
                                      {{ csrf_field() }}
                                    {{Form::label('reply',__('Your Reply'))}}
                                    {{Form::textarea('reply', null, ['class' => 'form-control', 'rows'=> '5','cols' => '10'])}} 
                                    <br/>
                                      <button type="submit" class="btn btn-danger">{{__('Submit')}}</button>
                                </form>
                                </div>
                                <div class="modal-footer">
                                
                                </div>
                              </div>
                            </div>
                    </div>
                @endforeach
            @endif
          </div>

          @auth
          <div role="tabpanel" class="tab-pane fade" id="postcomment">
              <div style="width: 90%;color:#B1B1B1;" class=" " >
                  <h3 class="author-heading">{{__('post comment')}}:</h3><br/>
                   
                    {{Form::label('comment',__('Comment'))}}
                    {{Form::textarea('comment', null, ['class' => 'form-control', 'rows'=> '5','cols' => '10'])}}
                    <br/>
                    {{Form::submit(__('add comment'), ['class' => 'btn btn-md btn-default'])}}
              </div>

          </div>
          @endauth
        @endif
        @if($configs->user_rating == 1)
        <div role="tabpanel" class="tab-pane fade in active" id="review">
          @foreach($movieRating as $mrating)
          <div class="comment">
            <div class="author-info">
              <img src="{{ Avatar::create($mrating->user->name )->toBase64() }}" class="author-image">
              <div class="author-name">
                <h4 class="author-heading">{{$mrating->user->name}} </h4> <span><input id="rating" name="rating" class="rating rating-loading" disabled data-min="0" data-max="5" data-step="0.5"  value="{{isset($mrating) ? $mrating->rating: 0}}"></span>
                <p class="author-time">{{date('F jS, Y - g:i a',strtotime($mrating->created_at))}}</p>
              </div>
             
            </div>
           
          </div>
          <div class="comment-content">
            <p class="author-heading">{{$mrating->review}}</p>
          </div>
          @endforeach
        </div>
        @endif
      </div>
    </div>
    <br/>
  @endif
@endif

      {{-- comments section start from here --}}
@if(isset($season))
  @if($configs->comments == 1)
    <div class="container-fluid movie-series-section comment-nav-tabs">
     <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
       
        <li role="presentation" class="active"><a href="#showcomment" aria-controls="showcomment" role="tab" data-toggle="tab" style="z-index:999;">{{__('Comment')}}</a></li>
        
        @if(getSubscription()->getData()->subscribed == true)
        <li role="presentation"><a href="#postcomment" aria-controls="postcomment" role="tab" data-toggle="tab" style="z-index:999;">{{__('Post comment')}}</a></li>
        @endif
      </ul>
      <br/>
    <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="showcomment">
          @if(isset($season->tvseries->comments) && $season->tvseries->comments->isEmpty())
           <div class="row text-center" style="color:#B1B1B1;">
             <h4 class="text-center"><i class="fa fa-comment-o"></i> &nbsp;{{__('No comments yet!')}}</h4>&nbsp;
              <small class="text-center">{{__('Be the first to share what you think !')}}</small>
           </div>
          @else
          <h4 class="title" style="color:#B1B1B1;"><span class="glyphicon glyphicon-comment"></span> {{$season->tvseries->comments->where('status',1)->count()}} {{__('Comment')}} </h4> <br/>
            
            @foreach ($season->tvseries->comments->where('status',1) as $comment)

                <div class="comment">
                  <div class="author-info">
                    <img src="{{ Avatar::create($comment->name )->toBase64() }}" class="author-image">
                    <div class="author-name">
                      <h4 class="author-heading">{{$comment->name}}</h4>
                      <p class="author-time">{{date('F jS, Y - g:i a',strtotime($comment->created_at))}}</p>
                    </div>
                     @if(Auth::check() && (Auth::user()->is_admin == 1 || $comment->user_id == Auth::user()->id))  
                    <button type="button" class="btn btn-danger comment-btn btn-floating pull-right" data-toggle="modal" data-target="#deleteModal{{$comment->id}}" style="left:10px;position:relative;"><i class="fa fa-trash-o"></i></button>


                      <!-- ---------------- comment delete ------------>
                    <div id="deleteModal{{$comment->id}}" class="delete-modal comment-modal modal fade" role="dialog">
                      <div class="modal-dialog modal-sm">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="delete-icon"></div>
                          </div>
                          <div class="modal-body text-center">
                            <h4 class="modal-heading comment-delete-heading">{{__('Are You Sure')}}</h4>
                            <p class="comment-delete-detail">{{__('Model Message')}}</p>
                          </div>
                           <div class="modal-footer">
                            {!! Form::open(['method' => 'DELETE', 'action' => ['TVCommentController@deletecomment', $comment->id]]) !!}
                                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                                <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                            {!! Form::close() !!}
                          </div>
                        </div>
                      </div>
                    </div>
                  <!-------------------- end comment delete ------------------->


                    @endif
                    @if(getSubscription()->getData()->subscribed == true)
                     <button type="button" class=" btn btn-danger comment-btn btn-floating pull-right" data-toggle="modal" data-target="#{{$comment->id}}deleteModal"><i class="fa fa-reply"></i> </button>
                    @endif
                  </div>

                  <div class="comment-content">
                   {{$comment->comment}}
                  </div>
                </div>
                <div>
                   
                      <!-- Modal -->
                     
                      <div id="{{$comment->id}}deleteModal" class="delete-modal comment-modal modal fade" role="dialog"  style="margin-top: 20px;">
                        <div class="modal-dialog modal-md" style="margin-top:70px;">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                               
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <div class="delete-icon"></div>
                             <h4 style="color:#FFF;"> {{__('Reply For')}} {{$comment->name}}</h4>
                            </div>
                            <div class="modal-body text-center">
                               
                                <form action="{{route('tv.comment.reply', ['cid' =>$comment->id])}}" method ="POST">
                                  {{ csrf_field() }}
                                {{Form::label('reply',__('Your Reply'))}}
                                {{Form::textarea('reply', null, ['class' => 'form-control', 'rows'=> '5','cols' => '10'])}} 
                                <br/>
                                  <button type="submit" class="btn btn-danger">{{__('Submit')}}</button>
                             </form>
                            </div>
                            <div class="modal-footer">
                             
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
                 @foreach($comment->subcomments->where('status',1) as $subcomment)
                  
                    <div class="comment" style="margin-left:50px;">
                    <div class="author-info">
                       @php
                           $name=App\user::where('id',$subcomment->user_id)->first();
                         @endphp
                      <img src="{{ Avatar::create($name->name )->toBase64() }}" class="author-image">
                      <div class="author-name">
                       
                        <h5 class="author-heading">{{$name->name}}</h5>
                        <p class="author-time">{{date('F jS, Y - g:i a',strtotime($subcomment->created_at))}}</p>
                      </div>
                        @if(Auth::check() && (Auth::user()->is_admin == 1 || $subcomment->user_id == Auth::user()->id))
                     
                         <button type="button" class="btn btn-danger comment-btn btn-floating pull-right" data-toggle="modal" data-target="#subdeleteModal{{$subcomment->id}}"><i class="fa fa-trash-o"></i></button>    
                       <div id="subdeleteModal{{$subcomment->id}}" class="delete-modal comment-modal modal fade" role="dialog">
                      <div class="modal-dialog modal-sm">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="delete-icon"></div>
                          </div>
                          <div class="modal-body text-center">
                            <h4 class="modal-heading comment-delete-heading">{{__('Are You Sure')}}</h4>
                            <p class="comment-delete-detail">{{__('Modal Message')}}</p>
                          </div>
                           <div class="modal-footer">
                            {!! Form::open(['method' => 'DELETE', 'action' => ['TVCommentController@deletesubcomment', $subcomment->id]]) !!}
                                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                                <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                            {!! Form::close() !!}
                          </div>
                        </div>
                      </div>
                    </div>

                     
                    @endif
                      


                    </div>

                    <div class="comment-content">
                     {{$subcomment->reply}}
                    </div>
                  </div>

                @endforeach
            @endforeach
          @endif
        </div>
        @auth
        <div role="tabpanel" class="tab-pane fade" id="postcomment">
            <div style="width: 90%;color:#B1B1B1;" class=" " >
                <h3>{{__('Post Comment')}}:</h3><br/>
              
                    {{Form::open( ['route' => ['tv.comment.store', $season->tvseries->id], 'method' => 'POST'])}}
                    
                    {{Form::label('comment',__('Comment'))}}
                    {{Form::textarea('comment', null, ['class' => 'form-control', 'rows'=> '5','cols' => '10'])}}
                    <br/>
                    {{Form::submit(__('addcomment'), ['class' => 'btn btn-md btn-default'])}}
            </div>

        </div>
        @endauth
      </div>
    </div>
  <br/>
  @endif
@endif


    <!-- end episodes -->
  @if($prime_genre_slider == 1)
      @php
        $all = collect();
        $all_fil_movies = App\Movie::all();
        $all_fil_tv = App\TvSeries::all();
        if (isset($movie)) {
          $genres = explode(',', $movie->genre_id);
        } elseif (isset($season)) {
          $genres = explode(',', $season->tvseries->genre_id);
        }
        for($i = 0; $i < count($genres); $i++) {
          foreach ($all_fil_movies as $fil_movie) {
            $fil_genre_item = explode(',', trim($fil_movie->genre_id));
            for ($k=0; $k < count($fil_genre_item); $k++) {
              if (trim($fil_genre_item[$k]) == trim($genres[$i])) {
                if (isset($movie)) {
                  if ($fil_movie->id != $movie->id) {
                    $all->push($fil_movie);
                  }
                } else {
                  $all->push($fil_movie);
                }
              }
            }
          }
        }
        if (isset($movie)) {
          $all = $all->except($movie->id);
        }

        for($i = 0; $i < count($genres); $i++) {
          foreach ($all_fil_tv as $fil_tv) {
            $fil_genre_item = explode(',', trim($fil_tv->genre_id));
            for ($k=0; $k < count($fil_genre_item); $k++) {
              if (trim($fil_genre_item[$k]) == trim($genres[$i])) {
                $fil_tv = $fil_tv->seasons;
                if (isset($season)) {
                  $all->push($fil_tv->except($season->id));
                } else {
                  $all->push($fil_tv);
                }
              }
            }
          }
        }
        $all = $all->unique();
        $all = $all->flatten();
      @endphp
      @if (isset($all) && count($all) > 0)
        <div class="genre-prime-block">
          <div class="container-fluid">
            <h5 class="section-heading">{{__('customeralsowatched')}}</h5>
            <div class="genre-prime-slider owl-carousel">
              @if(isset($all))
                @foreach($all as $key => $item)
                  @php
                   if(isset($auth)){
                    if ($item->type == 'S') {
                       $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                        ['user_id', '=', $auth->id],
                                                                        ['season_id', '=', $item->id],
                                                                       ])->first();
                    } elseif ($item->type == 'M') {
                      $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                        ['user_id', '=', $auth->id],
                                                                        ['movie_id', '=', $item->id],
                                                                       ])->first();
                    }

                  }
                  @endphp
                  @if($item->type == 'M')
                    @if(isset($movie))
                    <div class="genre-prime-slide owls-item">
                      <div class="genre-slide-image home-prime-slider protip" data-pt-placement="outside" data-pt-title="#prime-mix-description-block{{$item->id}}">
                        @if($auth && getSubscription()->getData()->subscribed == true)
                          <a href="{{url('movie/detail/'.$item->slug)}}">
                            @if($item->thumbnail != null)
                              <img data-src="{{url('/images/movies/thumbnails/'.$item->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                            @else
                               <img data-src="{{url('/images/default-thumbnail.jpg')}}" class="img-responsive owl-lazy" alt="genre-image">
                            @endif
                          </a>
                          @if(timecalcuate($auth->id,$item->id,$item->type) != 0)
                            <div class="progress">
                              <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:{{timecalcuate($auth->id,$item->id,$item->type)}}%">
                              </div>
                            </div>
                            @endif
                          @else
                           <a href="{{url('movie/guest/detail/'.$item->slug)}}">
                            @if($item->thumbnail != null)
                              <img data-src="{{url('/images/movies/thumbnails/'.$item->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                            @else
                              <img data-src="{{url('/images/default-thumbnail.jpg')}}" class="img-responsive owl-lazy" alt="genre-image">
                            @endif
                          </a>
                          
                        @endif
                        @if($item->is_custom_label == 1)
                          @if(isset($item->label_id))
                            <span class="badge bg-info">{{$item->label->name}}</span>
                          @endif
                        @else

                         @if(isset($item->is_upcoming) && $item->is_upcoming == 1)
                            <span class="badge bg-success">{{__('Upcoming')}}</span>
                          @endif
                        @endif
                      </div>
                      <div id="prime-mix-description-block{{$item->id}}" class="prime-description-block">
                        <h5 class="description-heading">{{$item->title}}</h5>
                        
                        <ul class="description-list">
                          <li>{{__('Tmdb Rating')}} {{$item->rating}}</li>
                          <li>{{$item->duration}} {{__('Mins')}}</li>
                          <li>{{$item->publish_year}}</li>
                          <li>{{$item->maturity_rating}}</li>
                          @if($item->subtitle == 1)
                            <li>CC</li>
                            <li>
                             {{__('subtitles')}}
                            </li>
                          @endif
                        </ul>
                        <div class="main-des">
                          <p>{{str_limit($item->detail,100,'...')}}</p>
                          @if($auth && getSubscription()->getData()->subscribed == true)
                            <a href="{{url('movie/detail',$item->slug)}}">{{__('Read More')}}</a>
                          @else
                            <a href="{{url('movie/guest/detail',$item->slug)}}">{{__('Read More')}}</a>
                          @endif
                        </div>
                        <div class="des-btn-block">
                          @if($auth  && getSubscription()->getData()->subscribed == true && checkInMovie($item) == true && isset($item->video_link))
                            @if(isset($item) && $item->is_upcoming != 1)
                              @if($item->maturity_rating =='all age' || $age>=str_replace('+', '',$item->maturity_rating))

                                @if(isset($item->video_link['iframeurl']) && $item->video_link['iframeurl'] != null)
                            
                                  <a href="{{route('watchmovieiframe',$item->id)}}"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                                  </a>

                                @else 
                                  <a href="{{ route('watchmovie',$item->id) }}" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span></a>
                                @endif
                              @else
                                <a onclick="myage({{$age}})" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                                  </a>
                              @endif
                            @endif
                            @if($item->trailer_url != null || $item->trailer_url != '')
                              <a href="{{ route('watchTrailer',$item->id) }}" class="watch-trailer-btn iframe btn-default">{{__('Watch Trailer')}}</a>
                            @endif
                          @else
                            @if($item->trailer_url != null || $item->trailer_url != '')
                              <a href="{{ route('guestwatchtrailer',$item->id) }}" class="watch-trailer-btn iframe btn-default">{{__('Watch Trailer')}}</a>
                            @endif
                          @endif

                          @if($catlog ==0 && getSubscription()->getData()->subscribed == true)
                        
                            @if (isset($wishlist_check->added))
                              <a onclick="addWish({{$item->id}},'{{$item->type}}')" class="watch-trailer-btn addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('add to watch list')}}</a>
                            @else
                              <a onclick="addWish({{$item->id}},'{{$item->type}}')" class="watch-trailer-btn addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{__('Add to Watchlist')}}</a>
                            @endif
                          @elseif($catlog ==1 && $auth)
                            @if (isset($wishlist_check->added))
                              <a onclick="addWish({{$item->id}},'{{$item->type}}')" class="watch-trailer-btn addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</a>
                            @else
                              <a onclick="addWish({{$item->id}},'{{$item->type}}')" class="watch-trailer-btn addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{__('Add to Watchlist')}}</a>
                            @endif
                          @endif
                        </div>
                      </div>
                    </div>
                  @endif
                  @endif

                  @if($item->type == "S")
                    @if(!isset($movie))
                      
                    <div class="genre-prime-slide owls-item">
                      <div class="genre-slide-image home-prime-slider protip" data-pt-placement="outside" data-pt-title="#prime-mix-description-block{{$item->id}}{{$item->type}}">
                        @if($auth && getSubscription()->getData()->subscribed == true)
                          <a href="{{url('show/detail/'.$item->season_slug)}}">
                            @if($item->thumbnail != null)
                            <img data-src="{{url('images/tvseries/thumbnails/'.$item->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                          @elseif($item->tvseries->thumbnail != null)
                            <img data-src="{{url('images/tvseries/thumbnails/'.$item->tvseries->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                          @else
                            <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-responsive owl-lazy" alt="genre-image">
                          @endif
                          </a>
                          @else
                          <a href="{{url('show/guest/detail/'.$item->season_slug)}}">
                            @if($item->thumbnail != null)
                            <img data-src="{{url('images/tvseries/thumbnails/'.$item->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                          @elseif($item->tvseries->thumbnail != null)
                            <img data-src="{{url('images/tvseries/thumbnails/'.$item->tvseries->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                          @else
                            <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-responsive owl-lazy" alt="genre-image">
                          @endif
                          </a>
                        @endif
                        @if($item->tvseries->is_custom_label == 1)
                          @if(isset($item->tvseries->label_id))
                            <span class="badge bg-info">{{$item->tvseries->label->name}}</span>
                          @endif
                        @endif
                      
                      </div>
                      <div id="prime-mix-description-block{{$item->id}}{{$item->type}}" class="prime-description-block">
                        <h5 class="description-heading">{{$item->tvseries->title}}</h5>
                        <div class="movie-rating">{{__('Tmdb Rating')}} {{$item->tvseries->rating}}</div>
                        <ul class="description-list">
                          <li>{{__('Season')}} {{$item->season_no}}</li>
                          <li>{{$item->publish_year}}</li>
                          <li>{{$item->tvseries->age_req}}</li>
                         
                        </ul>
                        <div class="main-des">
                          @if ($item->detail != null || $item->detail != '')
                            <p>{{str_limit($item->detail,100,'...')}}</p>
                          @else
                            <p>{{str_limit($item->tvseries->detail,100,'...')}}</p>
                          @endif
                          @if($auth && getSubscription()->getData()->subscribed == true)
                            <a href="{{url('show/detail',$item->season_slug)}}">{{__('Read More')}}</a>
                          @else
                            <a href="{{url('show/guest/detail',$item->season_slug)}}">{{__('Read More')}}</a>
                          @endif
                        </div>
                        <div class="des-btn-block">
                          @if($auth && getSubscription()->getData()->subscribed == true)
                            @if(isset($item->episodes[0]) && checkInTvseries($item->tvseries) == true && isset($item->episodes[0]->video_link))
                              @if($item->tvseries->age_req =='all age' || $age>=str_replace('+', '',$item->tvseries->age_req))
                                @if($item->episodes[0]->video_link['iframeurl'] !="")

                                  <a href="#" onclick="playoniframe('{{ $item->episodes[0]->video_link['iframeurl'] }}','{{ $item->tvseries->id }}','tv')" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                                   </a>
                                @else
                                  <a href="{{route('watchTvShow',$item->id)}}" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span></a>
                                @endif
                              @else
                                <a onclick="myage({{$age}})" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                                 </a>
                              @endif
                           @endif
                           @if($item->trailer_url != null || $item->trailer_url != '')
                              <a href="{{ route('watchtvTrailer',$item->id)  }}" class="watch-trailer-btn iframe btn btn-default">{{__('Watch Trailer')}}</a>
                            @endif
                          @else
                             @if($item->trailer_url != null || $item->trailer_url != '')
                              <a href="{{ route('guestwatchtvtrailer',$item->id)  }}" class="watch-trailer-btn iframe btn btn-default">{{__('Watch Trailer')}}</a>
                            @endif
                          @endif
                          @if($catlog ==0 && getSubscription()->getData()->subscribed == true)
                            @if (isset($wishlist_check->added))
                              <a onclick="addWish({{$item->id}},'{{$item->type}}')" class="watch-trailer-btn addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{$wishlist_check->added == 1 ? __('remove fromw atchlist') : __('Add to Watchlist')}}</a>
                            @else
                              <a onclick="addWish({{$item->id}},'{{$item->type}}')" class="watch-trailer-btn addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{__('Add to Watchlist')}}</a>
                            @endif
                          @elseif($catlog ==1 && $auth)
                            @if (isset($wishlist_check->added))
                              <a onclick="addWish({{$item->id}},'{{$item->type}}')" class="watch-trailer-btn addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</a>
                            @else
                              <a onclick="addWish({{$item->id}},'{{$item->type}}')" class="watch-trailer-btn addwishlistbtn{{$item->id}}{{$item->type}} btn-default">{{__('Add to Watchlist')}}</a>
                            @endif
                          @endif
                        </div>
                      </div>
                    </div>
                    @endif
                  @endif
                @endforeach
              @endif
            </div>
          </div>
        </div>
      @endif
    @else
      @php
        $all = collect();
        $all_fil_movies = App\Movie::all();
        $all_fil_tv = App\TvSeries::all();
        if (isset($movie)) {
          $genres = explode(',', $movie->genre_id);
        } elseif (isset($season)) {
          $genres = explode(',', $season->tvseries->genre_id);
        }
        for($i = 0; $i < count($genres); $i++) {
          foreach ($all_fil_movies as $fil_movie) {
            $fil_genre_item = explode(',', trim($fil_movie->genre_id));
            for ($k=0; $k < count($fil_genre_item); $k++) {
              if (trim($fil_genre_item[$k]) == trim($genres[$i])) {
                if (isset($movie)) {
                  if ($fil_movie->id != $movie->id) {
                    $all->push($fil_movie);
                  }
                } else {
                  $all->push($fil_movie);
                }
              }
            }
          }
        }
        if (isset($movie)) {
          $all = $all->except($movie->id);
        }

        for($i = 0; $i < count($genres); $i++) {
          foreach ($all_fil_tv as $fil_tv) {
            $fil_genre_item = explode(',', trim($fil_tv->genre_id));
            for ($k=0; $k < count($fil_genre_item); $k++) {
              if (trim($fil_genre_item[$k]) == trim($genres[$i])) {
                $fil_tv = $fil_tv->seasons;
                if (isset($season)) {
                  $all->push($fil_tv->except($season->id));
                } else {
                  $all->push($fil_tv);
                }
              }
            }
          }
        }
        $all = $all->unique();
        $all = $all->flatten();
      @endphp
      @if (isset($all) && count($all) > 0)
        <div class="genre-main-block">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-3">
                <div class="genre-dtl-block">
                  <h3 class="section-heading">{{__('Customer Also Watched')}}</h3>
                  <p class="section-dtl">{{__('At the Big Screen at Home')}}</p>
                </div>
              </div>
              <div class="col-md-9">
                <div class="genre-main-slider owl-carousel">
                  @if(isset($all))
                    @foreach($all as $key => $item)
                      @if($item->type == 'S')
                        <div class="genre-slide">
                          <div class="genre-slide-image home-prime-slider owls-item">
                           
                           @if($auth && getSubscription()->getData()->subscribed == true)
                            <a href="{{url('show/detail/'.$item->season_slug)}}">
                              @if($item->thumbnail != null)
                              <img data-src="{{url('images/tvseries/thumbnails/'.$item->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                            @elseif($item->tvseries->thumbnail != null)
                              <img data-src="{{url('images/tvseries/thumbnails/'.$item->tvseries->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                            @else
                              <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-responsive owl-lazy" alt="genre-image">
                            @endif
                             
                            </a>

                            @else
                            <a href="{{url('show/guest/detail/'.$item->season_slug)}}">
                             
                              @if($item->thumbnail != null)
                              <img data-src="{{url('images/tvseries/thumbnails/'.$item->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                            @elseif($item->tvseries->thumbnail != null)
                              <img data-src="{{url('images/tvseries/thumbnails/'.$item->tvseries->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                            @else
                              <img data-src="{{url('images/default-thumbnail.jpg')}}" class="img-responsive owl-lazy" alt="genre-image">
                            @endif
                             
                            </a>
                            @endif
                             @if($item->tvseries->is_custom_label == 1)
                              @if(isset($item->tvseries->label_id))
                                <span class="badge bg-info">{{$item->tvseries->label->name}}</span>
                              @endif
                            @endif
                         
                          </div>
                          <div class="genre-slide-dtl">
                            <h5 class="genre-dtl-heading">@if($auth && getSubscription()->getData()->subscribed == true)<a href="{{url('show/detail/'.$item->season_slug)}}">{{$item->tvseries->title}}</a>
                            @else
                            <a href="{{url('show/guest/detail/'.$item->season_slug)}}">{{$item->tvseries->title}}</a>
                          @endif</h5>
                            <div class="genre-small-info">{{$item->detail != null ? str_limit($item->detail,150,'...'): str_limit($item->tvseries->detail,150,'...')}}</div>
                          </div>
                        </div>
                      @elseif($item->type == 'M')
                        <div class="genre-slide">
                          <div class="genre-slide-image home-prime-slider owls-item">
                           @if($auth && getSubscription()->getData()->subscribed == true)
                            <a href="{{url('movie/detail/'.$item->slug)}}">
                              @if($item->thumbnail != null)
                                <img data-src="{{url('images/movies/thumbnails/'.$item->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                              @endif
                            </a>
                            @if(timecalcuate($auth->id,$item->id,$item->type) != 0)
                            <div class="progress">
                              <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:{{timecalcuate($auth->id,$item->id,$item->type)}}%">
                              </div>
                            </div>
                            @endif
                            @else
                             <a href="{{url('movie/guest/detail/'.$item->slug)}}">
                              @if($item->thumbnail != null)
                                <img data-src="{{url('images/movies/thumbnails/'.$item->thumbnail)}}" class="img-responsive owl-lazy" alt="genre-image">
                              @endif
                            </a>
                            @endif
                            @if($item->is_custom_label == 1)
                              @if(isset($item->label_id))
                                <span class="badge bg-info">{{$item->label->name}}</span>
                              @endif
                            @else

                              @if(isset($item->is_upcoming) && $item->is_upcoming == 1)
                                <span class="badge bg-success">{{__('Upcoming')}}</span>
                              @endif
                            @endif
                            
                          </div>
                          <div class="genre-slide-dtl">
                            <h5 class="genre-dtl-heading">@if($auth && getSubscription()->getData()->subscribed == true)<a href="{{url('movie/detail/'.$item->slug)}}">{{$item->title}}</a>
                            @else
                            <a href="{{url('movie/guest/detail/'.$item->slug)}}">{{$item->title}}</a>
                          @endif</h5>
                          <div class="genre-small-info">{{$item->detail != null ? str_limit($item->detail,150, '...') :''}}</div>
                          </div>
                        </div>
                      @endif
                    @endforeach
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      @endif
    @endif


     <!-- Share Modal -->
      <div class="modal fade" id="sharemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">{{__('share it on')}}</h4>
            </div>
            
            <div class="text-center modal-body">
              @php
                echo Share::currentPage(null,[],'<div class="row">', '</div>')
                ->facebook()
                ->twitter()
                ->telegram()
                ->whatsapp();
              @endphp
            </div>
           
          </div>
        </div>
      </div>
  </section>



@endsection

@section('custom-script')
  
  
  <script>
    // Wishlist Js ( using Vuejs 2 )
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
          return text == "{{__('Add to Watchlist')}}" ? "{{__('Remove From Watchlist')}}" : "{{__('Add to Watchlist')}}";
        });
      }, 100);
    }
  </script>

  <script>
      $(document).ready(function(){

        
        $(".group1").colorbox({rel:'group1'});
        $(".group2").colorbox({rel:'group2', transition:"fade"});
        $(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
        $(".group4").colorbox({rel:'group4', slideshow:true});
        $(".ajax").colorbox();
        $(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
        $(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
        $(".iframe").colorbox({iframe:true, width:"100%", height:"100%"});
        $(".inline").colorbox({inline:true, width:"50%"});
        $(".callbacks").colorbox({
          onOpen:function(){ alert('onOpen: colorbox is about to open'); },
          onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
          onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
          onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
          onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
        });

        $('.non-retina').colorbox({rel:'group5', transition:'none'})
        $('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
        
        
        $("#click").click(function(){ 
          $('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
          return false;
        });
      });
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
      $('#selectseason').on('change',function(){
        var get = $('#selectseason').val();
        @if(Auth::check() && getSubscription()->getData()->subscribed == true)
        window.location.href = '{{ url('show/detail/') }}/'+get;
        @else
        window.location.href = '{{ url('show/guest/detail/') }}/'+get;
        @endif
      });
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