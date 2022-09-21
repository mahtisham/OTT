@extends('layouts.theme')
@section('title',__('View All'))
@section('main-wrapper')
<br>
@php
 $withlogin= $configs->withlogin;
 $catlog= $configs->catlog;
  $auth=Auth::user();
  $subscribed = null;
          
@endphp
  @if (isset($pusheditems) && count($pusheditems) > 0 )
          <div class="genre-prime-block">
            <div class="container-fluid">
              <h5 class="section-heading">{{__('View All In')}} {{ $genre->name }}</h5>
              <div class="">
                @if(isset($pusheditems))
                  @foreach($pusheditems as $item)
                  
                   @if($auth && getSubscription()->getData()->subscribed == true)
                  
                    @php
                     if ($item['type'] == 'M') {
                      $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                          ['user_id', '=', $auth->id],
                                                                          ['movie_id', '=', $item->id],
                                                                         ])->first();
                     }

                      $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();

                      if (isset($gets1)) {


                        $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                    ['user_id', '=', $auth->id],
                                                                    ['season_id', '=', $gets1->id],
                          ])->first();


                      }
                    @endphp
                      @endif
                    
                  
                  @if($item['type'] == "M")

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
                          
                        
                      <div class="genre-slide-image home-prime-slider protip progress-movie" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block{{$item->id}}">
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
                       @if($item->is_custom_label == 1)
                          @if(isset($item->label_id))
                            <span class="badge bg-info">{{$item->label->name}}</span>
                          @endif
                       
                        @endif
                       
                      </div>
                      @if(isset($protip) && $protip == 1)
                      <div id="prime-next-item-description-block{{$item->id}}" class="prime-description-block">
                        <div class="prime-description-under-block">
                          <h5 class="description-heading">{{$item->title}}</h5>
                        
                          <ul class="description-list">
                            <li>{{__('Rating')}} {{$item->rating}}</li>
                            <li>{{$item->duration}} {{__('mins')}}</li>
                            <li>{{$item->publish_year}}</li>
                            <li>{{$item->maturity_rating}}</li>
                            @if($item->subtitle == 1)
                              <li>
                               {{__('Sub Titles')}}
                              </li>
                            @endif
                          </ul>
                          <div class="main-des">
                            <p>{{$item->detail}}</p>
                            <a href="{{url('movie/detail',$item->slug)}}">{{__('Read More')}}</a>
                          </div>
                         
                          <div class="des-btn-block">
                            @if($auth && getSubscription()->getData()->subscribed == true)
                              @if($item->is_upcoming != 1)
                                @if(checkInMovie($item) == true && isset($item->video_link))
                                  @if($item->maturity_rating == 'all age' || $age>=str_replace('+', '', $item->maturity_rating))
                                    @if(isset($item->video_link['iframeurl']) && $item->video_link['iframeurl'] != null)
                                      <a href="{{route('watchmovieiframe',$item->id)}}"class="btn btn-play iframe"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                                      </a>
                                    @else 
                                        <a href="{{route('watchmovie',$item->id)}}" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span></a>
                                    @endif
                                  @else
                                    <a onclick="myage({{$age}})" class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span></a>
                                  @endif
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
                           
                            @if($catlog ==0 && getSubscription()->getData()->subscribed == true)
                              @if (isset($wishlist_check->added))
                                <a onclick="addWish({{$item->id}},'{{$item['type']}}')" class="addwishlistbtn{{$item->id}}{{$item['type']}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</a>
                              @else
                                <a onclick="addWish({{$item->id}},'{{$item['type']}}')" class="addwishlistbtn{{$item->id}}{{$item['type']}} btn-default">{{__('Add to Watchlist')}}</a>
                              @endif
                            @elseif($catlog ==1 && $auth)
                              @if (isset($wishlist_check->added))
                                <a onclick="addWish({{$item->id}},'{{$item['type']}}')" class="addwishlistbtn{{$item->id}}{{$item['type']}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</a>
                              @else
                                <a onclick="addWish({{$item->id}},'{{$item['type']}}')" class="addwishlistbtn{{$item->id}}{{$item['type']}} btn-default">{{__('Add to Watchlist')}}</a>
                              @endif
                            @endif
                          </div>
                         
                        </div>
                      </div>
                      @endif
                    </div>
                      
                  </div>
                  @endif
                    @elseif($item['type'] == "T")

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
                       @if(hidedata($item->seasons[0]['id'],$item->seasons[0]['type']) != 1)
                        @if(isset($item->seasons[0]) && hidedata($item->seasons[0]['id'],$item->seasons[0]['type']) != 1)
                        <div class="col-lg-2 col-md-3 col-xs-6 col-sm-4">
                          <div class="cus_img">
                            
                          
                          <div class="genre-slide-image home-prime-slider protip" data-pt-placement="outside" data-pt-interactive="false" data-pt-title="#prime-next-item-description-block{{$item->id}}{{ $item['type'] }}">
                            @if($auth && getSubscription()->getData()->subscribed == true)
                                <a href="{{isset($item->seasons[0]) && $item->seasons[0] != NULL ?  url('show/detail',$item->seasons[0]['season_slug']) : '#'}}">
                                  @if($src)
                                    <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                  
                                  @endif
                                </a>
                                <div class="hide-icon hide-icon-two">
                                  <a onclick="hideforme('{{$item->seasons[0]['id']}}','{{$item->seasons[0]['type']}}')" title="{{__('Hide this Movie')}}" class=""><i class="fa fa-eye-slash"></i></a>
                                </div>
                              @else
                                <a href="{{isset($item->seasons[0]) && $item->seasons[0] != NULL ? url('show/guest/detail',$item->seasons[0]['season_slug']) : '#'}}">
                                  @if($src)
                                    <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                                
                                  @endif
                                </a>
                              @endif
                              
                            </div>

                            @if(isset($protip) && $protip == 1)
                            <div id="prime-next-item-description-block{{$item->id}}{{$item['type']}}" class="prime-description-block">
                                <h5 class="description-heading">{{$item->title}}</h5>
                                <div class="movie-rating">{{__('Tmdb Rating')}} {{$item->rating}}</div>
                                <ul class="description-list">
                                  <li>{{__('Season')}} {{$item->season_no}}</li>
                                  <li>{{$item->publish_year}}</li>
                                  <li>{{$item->age_req}}</li>
                                  @if($item->subtitle == 1)
                                    <li>
                                      {{__('Sub Titles')}}
                                    </li>
                                  @endif
                                </ul>
                                <div class="main-des">
                                  @if ($item->detail != null || $item->detail != '')
                                    <p>{{$item->detail}}</p>
                                  @endif
                                  <a href="#"></a>
                                </div>
                              
                                <div class="des-btn-block">
                                  @if($auth && getSubscription()->getData()->subscribed == true)
                                    @if (isset($item->seasons[0]->episodes[0]) && checkInTvseries($item) == true && isset($item->seasons[0]->episodes[0]->video_link))
                                      @if($item->age_req == 'all age' || $age>=str_replace('+', '', $item->age_req))
                                        @if(isset($item->seasons[0]) && $item->seasons[0]->episodes[0]->video_link['iframeurl'] !="")

                                          <a href="#" onclick="playoniframe('{{ $item->seasons[0]->episodes[0]->video_link['iframeurl'] }}','{{ $item->id }}','tv')" class="btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                                          </a>

                                        @else
                                          <a href="{{ route('watchTvShow',$item->seasons[0]['id']) }}" class="iframe btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span></a>
                                        @endif
                                      @else
                                        <a onclick="myage({{$age}})" class=" btn btn-play"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span></a>
                                      @endif
                                    @endif
                                    @if(isset($item->seasons[0]) && $item->seasons[0]->trailer_url != null || isset($item->seasons[0]) && $item->seasons[0]->trailer_url != '')
                                      <a href="{{ route('watchtvTrailer',$item->seasons[0]->id)  }}" class="iframe btn btn-default">{{__('Watch Trailer')}}</a>
                                    @endif
                                  @else
                                    @if(isset($item->seasons[0]) && $item->seasons[0]->trailer_url != null || isset($item->seasons[0]) && $item->seasons[0]->trailer_url != '')
                                      <a href="{{ route('guestwatchtvtrailer',$item->seasons[0]->id)  }}" class="iframe btn btn-default">{{__('watch trailer')}}</a>
                                    @endif
                                  @endif
                                  @if($catlog ==0 && getSubscription()->getData()->subscribed == true)
                                    @if (isset($wishlist_check->added))
                                      <a onclick="addWish({{$item->seasons[0]['id']}},'{{$item['type']}}')" class="addwishlistbtn{{$item->seasons[0]['id']}}{{$item['type']}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</a>
                                    @else
                                      <a onclick="addWish({{$item->seasons[0]['id']}},'{{$item['type']}}')" class="addwishlistbtn{{$item->seasons[0]['id']}}{{$item['type']}} btn-default">{{__('Add to Watchlist')}}
                                      </a>
                                    @endif
                                  @elseif($catlog ==1 && $auth )
                                  @if(isset($item->seasons[0]))
                                    @if (isset($wishlist_check->added))

                                      <a onclick="addWish({{$item->seasons[0]['id']}},'{{$item['type']}}')" class="addwishlistbtn{{$item->seasons[0]['id']}}{{$item['type']}} btn-default">{{$wishlist_check->added == 1 ? __('Remove From Watchlist') : __('Add to Watchlist')}}</a>
                                    @else
                                      <a onclick="addWish({{$item->seasons[0]['id']}},'{{$item['type']}}')" class="addwishlistbtn{{$item->seasons[0]['id']}}{{$item['type']}} btn-default">{{__('Add to Watchlist')}}
                                      </a>
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

                @endif
                
              </div>
            </div>
            <div class="">
                <div align="center">
                   {!! $pusheditems->links() !!}
                </div>
             </div>
              
          @if (isset($ad)) 
          
              @if ($ad->isviewall==1 && $ad->status==1)
                @php
                  $code=  $ad->code;
                  echo html_entity_decode($code);
                @endphp
              @endif
         
          @endif

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

</script>

 <script>
     function addWish(id, type) {
      app.addToWishList(id, type);
      setTimeout(function() {
        $('.addwishlistbtn'+id+type).text(function(i, text){
          return text == "{{__('Add to Watchlist')}}" ? "{{__('Remove From Watchlist')}}" : "{{__('Add to Watchlist')}}";
        });
      }, 100);
    }

  </script>
@endsection