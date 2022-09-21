@extends('layouts.theme')
@php
  $auth = Auth::user();

  $withlogin= App\Config::findOrFail(1)->withlogin;
  $catlog= App\Config::findOrFail(1)->catlog;
 
@endphp
@section('title',__('Hide For Me').' | ')
@section('main-wrapper')
<section id="main-wrapper" class="main-wrapper user-account-section">
  <div class="container-fluid">
    <div class="row">
        <div class="">
            @if(isset($hideData) && count($hideData) > 0)

              @foreach($hideData as $item)
              
                    @if($auth && getSubscription()->getData()->subscribed == true)
                    
                        @php
                        if (isset($item->type) && $item->type == 'M') {
                        $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                            ['user_id', '=', $auth->id],
                                                                            ['movie_id', '=', $item->id],
                                                                            ])->first();
                        }

                        if (isset($item->type) && $item->type == 'S') {
                        $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                            ['user_id', '=', $auth->id],
                                                                            ['season_id', '=', $item->id],
                                                                        ])->first();
                        }
                        @endphp
                    @endif
                    
              
                    @if(isset($item->type) && $item->type == "M")
                        @if($item->movie->status == 1)
                       
                            <div class="col-lg-2 col-md-3 col-xs-6 col-sm-4">
                                <div class="cus_img">
                                <div class="genre-slide-image home-prime-slider protip progress-movie" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block{{$item->movie->id}}">
                                        <a href="{{url('movie/detail',$item->movie->slug)}}">
                                        @if($item->movie->thumbnail != null || $item->movie->thumbnail != '')
                                            <img data-src="{{url('images/movies/thumbnails/'.$item->movie->thumbnail)}}" class="img-responsive lazy" alt="genre-image">
                                        @else

                                            <img data-src="{{Avatar::create($item->movie->title)->toBase64()}}" class="img-responsive lazy" alt="genre-image">
                                        @endif

                                        </a>
                                        @if(timecalcuate($auth->id,$item->movie->id,$item->movie->type) != 0)
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:{{timecalcuate($auth->id,$item->movie->id,$item->movie->type)}}%">
                                            </div>
                                        </div>
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
                                   
                                    <button type="button" onclick="hideforme('{{$item->movie->id}}','{{$item->movie->type}}')" class="watchhistory_remove"><i class="flaticon-cancel"></i></button>
                                   
                                    @if(isset($protip) && $protip == 1)
                                        <div id="prime-next-item-description-block{{$item->movie->id}}" class="prime-description-block">
                                            <div class="prime-description-under-block">
                                            <h5 class="description-heading">{{$item->movie->title}}</h5>
                                            
                                            <ul class="description-list">
                                                <li>{{__('rating')}} {{$item->movie->rating}}</li>
                                                <li>{{$item->movie->duration}} {{__('mins')}}</li>
                                                <li>{{$item->movie->publish_year}}</li>
                                                <li>{{$item->movie->maturity_rating}}</li>
                                                @if($item->movie->subtitle == 1)
                                                <li>
                                                {{__('subtitles')}}
                                                </li>
                                                @endif
                                            </ul>
                                            <div class="main-des">
                                                <p>{{$item->movie->detail}}</p>
                                                <a href="{{url('movie/detail',$item->movie->slug)}}">{{__('read more')}}</a>
                                            </div>
                                            
                                            <div class="des-btn-block">
                                               
                                                @if($auth && getSubscription()->getData()->subscribed == true)
                                                @if($item->movie->is_upcoming != 1)
                                                    @if(checkInMovie($item->movie) == true)
                                                    @if($item->movie->maturity_rating == 'all age' || $age>=str_replace('+', '', $item->movie->maturity_rating))
                                                        @if($item->movie->video_link['iframeurl'] != null)
                                                    
                                                        <a href="{{route('watchmovieiframe',$item->movie->id)}}"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('play now')}}</span>
                                                        </a>

                                                        @else 
                                                        <a href="{{route('watchmovie',$item->movie->id)}}" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('play now')}}</span></a>
                                                        @endif
                                                    @else
                                                        <a onclick="myage({{$age}})" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('play now')}}</span>
                                                        </a>
                                                    @endif
                                                    @endif
                                                @endif
                                                @if($item->movie->trailer_url != null || $item->movie->trailer_url != '')
                                                    <a class="iframe btn btn-default" href="{{ route('watchTrailer',$item->movie->id) }}">{{__('watch trailer')}}</a>
                                                @endif
                                                @else
                                                @if($item->movie->trailer_url != null || $item->movie->trailer_url != '')
                                                    <a class="iframe btn btn-default" href="{{ route('guestwatchtrailer',$item->movie->id) }}">{{__('watch trailer')}}</a>
                                                @endif
                                                @endif
                                            
                                                @if($catlog == 0 && getSubscription()->getData()->subscribed == true)
                                                @if (isset($wishlist_check->added))
                                                    <a onclick="addWish({{$item->movie->id}},'{{$item->movie->type}}')" class="addwishlistbtn{{$item->movie->id}}{{$item->movie->type}} btn-default">{{$wishlist_check->added == 1 ? __('remove from watch list') : __('add t watch list')}}</a>
                                                @else
                                                    <a onclick="addWish({{$item->movie->id}},'{{$item->movie->type}}')" class="addwishlistbtn{{$item->movie->id}}{{$item->movie->type}} btn-default">{{__('add to watch list')}}</a>
                                                @endif
                                                @elseif($catlog ==1 && $auth)
                                                @if (isset($wishlist_check->added))
                                                    <a onclick="addWish({{$item->movie->id}},'{{$item->movie->type}}')" class="addwishlistbtn{{$item->movie->id}}{{$item->movie->type}} btn-default">{{$wishlist_check->added == 1 ? __('remove from watch list') : __('add to watch list')}}</a>
                                                @else
                                                    <a onclick="addWish({{$item->movie->id}},'{{$item->movie->type}}')" class="addwishlistbtn{{$item->movie->id}}{{$item->movie->type}} btn-default">{{__('add to watch list')}}</a>
                                                @endif
                                                @endif
                                            </div>
                                            
                                            </div>
                                        </div>
                                    @endif
                                
                                </div>
                            </div>
                        @endif
                    @elseif(isset($item->type) && $item->type == "S")
                        @if($item->season->tvseries->status == 1)
                            <div class="col-lg-2 col-md-3 col-xs-6 col-sm-4">
                                <div class="cus_img">
                                    
                                
                                    <div class="genre-slide-image home-prime-slider protip" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block{{$item->season->id}}{{ $item->season->type }}">
                                        <a href="{{url('show/detail',$item->season->season_slug)}}">
                                        @if($item->season->tvseries->thumbnail != null || $item->season->tvseries->thumbnail != '')
                                            <img data-src="{{url('images/tvseries/thumbnails/'.$item->season->tvseries->thumbnail)}}" class="img-responsive lazy" alt="genre-image">
                                        @else

                                            <img data-src="{{Avatar::create($item->season->tvseries->title)->toBase64()}}" class="img-responsive lazy" alt="genre-image">
                                        @endif
                                        </a>
                                        @if($item->season->tvseries->is_custom_label == 1)
                                        @if(isset($item->season->tvseries->label_id))
                                            <span class="badge bg-info">{{$item->season->tvseries->label->name}}</span>
                                        @endif
                                        @endif
                                    

                                    </div>
                                    {!! Form::open(['method' => 'POST', 'action' => ['HideForMeController@store', $item->season->id]]) !!}
                                     
                                        <button type="submit" class="watchhistory_remove"><i class="flaticon-cancel"></i></button><br/>
                                    {!! Form::close() !!}
                                    @if(isset($protip) && $protip == 1)
                                        <div id="prime-next-item-description-block{{$item->season->id}}{{$item->season->type}}" class="prime-description-block">
                                            <h5 class="description-heading">{{$item->season->tvseries->title}}</h5>
                                            <div class="movie-rating">{{__('tmdb rating')}} {{$item->season->tvseries->rating}}</div>
                                            <ul class="description-list">
                                            <li>{{__('season')}}{{$item->season->season_no}}</li>
                                            <li>{{$item->season->publish_year}}</li>
                                            <li>{{$item->season->tvseries->age_req}}</li>
                                            @if($item->season->subtitle == 1)
                                                <li>
                                                {{__('sub titles')}}
                                                </li>
                                            @endif
                                            </ul>
                                            <div class="main-des">
                                            @if ($item->season->detail != null || $item->season->detail != '')
                                                <p>{{$item->season->detail}}</p>
                                            @else
                                                <p>{{$item->season->tvseries->detail}}</p>
                                            @endif
                                            <a href="#"></a>
                                            </div>
                                            
                                            <div class="des-btn-block">
                                            @if($auth && getSubscription()->getData()->subscribed == true)
                                                @if(isset($item->season->episodes[0]) && checkInTvseries($item->season->tvseries) == true)
                                                @if($item->season->tvseries['age_req'] == 'all age' || $age>=str_replace('+', '', $item->season->tvseries['age_req']))
                                                    @if($item->season->episodes[0]->video_link['iframeurl'] !="")
                                                    <a href="#" onclick="playoniframe('{{ $item->season->episodes[0]->video_link['iframeurl'] }}','{{ $item->season->tvseries->id }}','tv')" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('playnow')}}</span>
                                                    </a>

                                                    @else
                                                    <a href="{{ route('watchTvShow',$item->season->id) }}" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('playnow')}}</span></a>
                                                    @endif
                                                @else
                                                    <a onclick="myage({{$age}})" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('playnow')}}</span>
                                                    </a>
                                                @endif
                                                @endif
                                                @if($item->season->trailer_url != null || $item->season->trailer_url != '')
                                                <a href="{{ route('watchtvTrailer',$item->season->id)  }}" class="iframe btn btn-default">{{__('watch trailer')}}</a>
                                                @endif
                                            @else
                                                @if($item->season->trailer_url != null || $item->season->trailer_url != '')
                                                <a href="{{ route('guestwatchtvtrailer',$item->season->id)  }}" class="iframe btn btn-default">{{__('watch trailer')}}</a>
                                                @endif
                                            @endif
                                            @if($catlog ==0 && getSubscription()->getData()->subscribed == true)
                                                @if (isset($wishlist_check->added))
                                                <a onclick="addWish({{$item->season->id}},'{{$item->season->type}}')" class="addwishlistbtn{{$item->season->id}}{{$item->season->type}} btn-default">{{$wishlist_check->added == 1 ? __('remove from watchlist') : __('add to watchlist')}}</a>
                                                @else
                                                <a onclick="addWish({{$item->season->id}},'{{$item->season->type}}')" class="addwishlistbtn{{$item->season->id}}{{$item->season->type}} btn-default">{{__('add to watchlist')}}
                                                </a>
                                                @endif
                                            @elseif($catlog ==1 && $auth)
                                                @if (isset($wishlist_check->added))
                                                <a onclick="addWish({{$item->season->id}},'{{$item->season->type}}')" class="addwishlistbtn{{$item->season->id}}{{$item->season->type}} btn-default">{{$wishlist_check->added == 1 ? __('remove from watchlist') : __('add to watchlist')}}</a>
                                                @else
                                                <a onclick="addWish({{$item->season->id}},'{{$item->season->type}}')" class="addwishlistbtn{{$item->season->id}}{{$item->season->type}} btn-default">{{__('add to watchlist')}}
                                                </a>
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

            @else
            <div class="search-box">
                <h5 class="movie-series-heading text-center">{{__('You have no hidden videos')}} </h5>
                <p class="text-center">{{__("After hiding a video, it appears here. These are videos that you've indicated aren't your cup of tea, are inappropriate. However, they will still show up in search results. Each profile has its own set of options. Switch to a different profile to browse and manage videos watched with that profile.")}}</p>
             
              </div>
            @endif
            
        </div>
    </div>
  </div>
</section>
@endsection
