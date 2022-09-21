@include('lang2')

@foreach($menu->menugenreshow->sortBy('genere.position') as $genre)
@if(isset($genre->genre) && $genre->genre != NULL)
@php
$moviegenreitems = NULL;
$moviegenreitems = array();

foreach ($menu_data as $key => $item) {

$gmovie = \DB::table('movies')->select('movies.id as id','movies.title as title','movies.type as type','movies.status as status','movies.genre_id as genre_id','movies.thumbnail as thumbnail','movies.slug as slug','movies.tmdb as tmdb','movies.is_upcoming as is_upcoming')
->where('movies.genre_id', 'LIKE', '%' . $genre->genre->id . '%')->where('movies.id',$item->movie_id)->first();


if(isset($gmovie)){

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



foreach ($menu_data as $key => $item) {

$gtvs = \DB::table('tv_series')
->join('seasons','seasons.tv_series_id','=','tv_series.id')
->select('seasons.id as seasonid','tv_series.genre_id as genre_id','tv_series.id as id','tv_series.type as type','tv_series.status as status','tv_series.title as title','tv_series.thumbnail as thumbnail','seasons.season_slug as season_slug','seasons.tmdb as tmdb','tv_series.is_custom_label as is_custom_label','tv_series.label_id as label_id')->where('tv_series.genre_id', 'LIKE', '%' . $genre->genre->id . '%')
->where('tv_series.id',$item->tv_series_id)->first();



if(isset($gtvs)){

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
@if($moviegenreitems != NULL && count($moviegenreitems)>0)
<div class="genre-main-block">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3 col-sm-5">
        <div class="genre-dtl-block">
          <h5 class="section-heading">{{ $genre->genre->name}} in {{ $menu->name }}</h5>
          <p class="section-dtl">{{__('at the bigscreen at home')}}</p>

          @if($auth && getSubscription()->getData()->subscribed == true)

          <a href="{{ route('show.in.genre',$genre->genre->id) }}" class="see-more">
            <b>{{__('View All')}}</b></a>

          @else

          <a href="{{ route('show.in.guest.genre',$genre->genre->id) }}" class="see-more">
            <b>{{__('View All')}}</b></a>

          @endif

        </div>
      </div>
      @if($section->view == 1)
      <!-- List view movies in genre -->
      <div class="col-md-9 col-sm-7">
        <div class="genre-main-slider owl-carousel">
          @foreach($moviegenreitems as $item)

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
              @if(hidedata($item->id,$item->type) != 1)
              <div class="genre-slide ">
                <div class="genre-slide-image genre-image  home-prime-slider">
                  @if($auth && getSubscription()->getData()->subscribed == true)
                    <a href="{{url('movie/detail',$item->slug)}}">
                      @if($src)
                      <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                      @else
                      <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                      @endif
                    </a>
                    <div class="hide-icon">
                      <a onclick="hideforme('{{$item->id}}','{{$item->type}}')" title="{{__('Hide this Movie')}}" class=""><i
                          class="fa fa-eye-slash"></i></a>
                    </div>
                    @if(timecalcuate($auth->id,$item->id,$item->type) != 0)
                      <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                          style="width:{{timecalcuate($auth->id,$item->id,$item->type)}}%">
                        </div>
                      </div>
                    @endif
                  @else
                    <a href="{{url('movie/guest/detail',$item->slug)}}">
                      @if($src)
                        <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                      @else
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

                $gets1 = App\Season::where('tv_series_id','=',$item->id)->first();

                    if (isset($gets1) && $auth  && $auth != NULL) {


                      $wishlist_check = \Illuminate\Support\Facades\DB::table('wishlists')->where([
                                                                  ['user_id', '=', $auth->id],
                                                                  ['season_id', '=', $gets1->id],
                        ])->first();


                      }

              @endphp
              
              @if(hidedata($gets1->id,$gets1->type) != 1)
              <div class="genre-slide">
                <div class="genre-slide-image genre-image  home-prime-slider">
                  @if($auth && getSubscription()->getData()->subscribed == true)
                    <a @if(isset($gets1)) href="{{url('show/detail',$item->season_slug)}}" @endif>
                      @if($item->thumbnail != null)
                        <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                      @else
                        <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                      @endif
                    </a>
                    <div class="hide-icon">
                      <a onclick="hideforme('{{$gets1->id}}','{{$gets1->type}}')" title="{{__('Hide this Movie')}}"
                        class=""><i class="fa fa-eye-slash"></i></a>
                    </div>
                  @else
                    <a @if(isset($gets1)) href="{{url('show/guest/detail',$item->season_slug)}}" @endif>
                      @if($item->thumbnail != null)
                        <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                      @else
                        <img data-src="{{ $src }}" class="img-responsive owl-lazy" alt="genre-image">
                      @endif
                    </a>
                  @endif
                </div>

                <div class="genre-slide-dtl">
                  @if($auth && getSubscription()->getData()->subscribed == true)
                    <h5 class="genre-dtl-heading"><a href="{{url('show/detail/'.$item->season_slug)}}">{{$item->title}}</a>
                    </h5>
                  @else
                    <h5 class="genre-dtl-heading"><a href="{{url('show/guest/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
                  @endif
                </div>
              </div>
              @endif
            @endif

          <!-- end -->
           @endif   
          @endforeach
        </div>
      </div>
      <!-- List view movies in genre END -->
      @endif



      @if($section->view == 0)

      <!-- Grid view genre movies -->
      <div class="col-md-9 col-sm-7">
        <div class="cus_img">

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

          if (isset($gets1) && $auth != NULL) {


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
          @if(hidedata($item->id,$item->type) != 1)
          <div class="col-lg-4 col-md-9 col-xs-6 col-sm-6">
            <div class="genre-slide-image genre-grid  home-prime-slider">
              @if($auth && getSubscription()->getData()->subscribed == true)
              <a href="{{url('movie/detail',$item->slug)}}">
                @if($src)
                <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                @else
                <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                @endif
              </a>
              <div class="hide-icon hide-icon-two">
                <a onclick="hideforme('{{$item->id}}','{{$item->type}}')" title="{{__('Hide this Movie')}}" class=""><i
                    class="fa fa-eye-slash"></i></a>
              </div>
              @if(timecalcuate($auth->id,$item->id,$item->type) != 0)
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                  style="width:{{timecalcuate($auth->id,$item->id,$item->type)}}%">
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
              @if(isset($item->is_upcoming) && $item->is_upcoming == 1)
              @if($item->upcoming_date != NULL)
              <span class="badge bg-success">{{date('M jS Y',strtotime($item->upcoming_date))}}</span>
              @else
              <span class="badge bg-danger">{{__('Coming Soon')}}</span>
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
          @if(hidedata($gets1->id,$gets1->type) != 1)
          <div class="col-lg-4 col-md-9 col-xs-6 col-sm-6">
            <div class="genre-slide-image genre-grid  home-prime-slider">
              @if($auth && getSubscription()->getData()->subscribed == true)
              <a @if(isset($gets1)) href="{{url('show/detail',$item->season_slug)}}" @endif>
                @if($src)

                <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">

                @else
                <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                @endif
              </a>
              <div class="hide-icon hide-icon-two">
                <a onclick="hideforme('{{$gets1->id}}','{{$gets1->type}}')" title="{{__('Hide this Movie')}}"
                  class=""><i class="fa fa-eye-slash"></i></a>
              </div>
              @else
              <a @if(isset($gets1)) href="{{url('show/guest/detail',$item->season_slug)}}" @endif>
                @if($src)
                <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">

                @else
                <img data-src="{{ $src }}" class="img-responsive lazy" alt="genre-image">
                @endif
              </a>
              @endif

            </div>
            <div class="genre-slide-dtl">
              @if($auth && getSubscription()->getData()->subscribed == true)
              <h5 class="genre-dtl-heading"><a href="{{url('show/detail/'.$item->season_slug)}}">{{$item->title}}</a>
              </h5>
              @else
              <h5 class="genre-dtl-heading"><a
                  href="{{url('show/guest/detail/'.$item->season_slug)}}">{{$item->title}}</a></h5>
              @endif
            </div>
          </div>
          @endif
          @endif
          @endif
          @endforeach


        </div>
      </div>

      <!--end grid view for genre-->
      @endif


    </div>
  </div>
</div>
<br />
@endif
@endif
@endforeach


@section('custom-script')
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
        this.$http.post('{{route('addtowishlist')}}', this.result).then((response) => {}).catch((e) => {
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
<script>
  function myage(age) {
    if (age == 0) {
      $('#ageModal').modal('show');
    } else {
      $('#ageWarningModal').modal('show');
    }
  }
</script>
@endsection



<script type="text/javascript" src="{{url('js/jquery.popover.js')}}"></script> <!-- bootstrap popover js -->
<script type="text/javascript" src="{{url('js/menumaker.js')}}"></script> <!-- menumaker js -->
<script type="text/javascript" src="{{url('js/jquery.curtail.min.js')}}"></script> <!-- menumaker js -->
@if(selected_lang()->rtl == 0)
<script type="text/javascript" src="{{url('js/owl.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{ url('js/slider.js') }}"></script>
@else
<script type="text/javascript" src="{{url('js/owl-carousel-rtl-js/owl.carousel.min.js')}}"></script>
<!-- owl carousel js -->
<script type="text/javascript" src="{{ url('js/slider-rtl.js') }}"></script>
@endif
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
<script src="{{url('js/star-rating.min.js')}}"></script>