@if(isset($audio) && count($audio)>0)
<div class="genre-prime-block">
  <div class="container-fluid">
    <h5 class="section-heading">Audio</h5>
    <div class="genre-prime-slider owl-carousel">
      @foreach($audio as $audios)

      <div class="genre-prime-slide">
        <div class="genre-slide-image protip" data-pt-placement="outside"
          data-pt-title="#prime-mix-description-block-blog{{$audios->id}}">
          @if($auth && getSubscription()->getData()->subscribed == true)
          <a href="{{url('audio/detail/'.$audios->id)}}">
            @if($audios->thumbnail != null)
            <img data-src="{{ asset('images/audio/thumbnails/'.$audios->thumbnail) }}" class="img-responsive owl-lazy"
              alt="audio-image">
            @else
            <img data-src="{{asset('images/default-thumbnail.jpg')}}" class="img-responsive owl-lazy" alt="blog-image">
            @endif
          </a>
          @else
          <a href="{{url('audio/guest/detail/'.$audios->id)}}">
            @if($audios->thumbnail != null)
            <img data-src="{{ asset('images/audio/thumbnails/'.$audios->thumbnail) }}" class="img-responsive owl-lazy"
              alt="audio-image">
            @else
            <img data-src="{{asset('images/default-thumbnail.jpg')}}" class="img-responsive owl-lazy" alt="blog-image">
            @endif
          </a>
          @endif
        </div>
        <div id="prime-mix-description-block-blog{{$audios->id}}" class="prime-description-block">
          <h5 class="description-heading">{{$audios['title']}}</h5>

          <div class="main-des">
            <p>{!! str_limit($audios->detail, 100) !!}</p>

          </div>
        </div>
      </div>

      @endforeach
    </div>
  </div>
</div>
@endif