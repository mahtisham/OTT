@if($config->blog == '1')
@if(isset($menu->getblogs) && count($menu->getblogs)>0)
<div class="genre-prime-block">
  <div class="container-fluid">
    <h5 class="section-heading">{{__('Recently Blog')}}</h5>
    <div class="genre-prime-slider owl-carousel">
      @foreach($menu->getblogs as $blog)
      @if($blog->blogs['is_active'] == 1)
      <div class="genre-prime-slide">
        <div class="genre-slide-image  protip" data-pt-placement="outside"
          data-pt-title="#prime-mix-description-block-blog{{$blog->id}}">
          <a href="{{url('account/blog/'.$blog->blogs['slug'])}}">
            @if($blog->blogs->image != null)
            <img data-src="{{ asset('images/blog/'.$blog->blogs['image']) }}" class="img-responsive owl-lazy"
              alt="blog-image">
            @else
            <img data-src="{{asset('images/default-thumbnail.jpg')}}" class="img-responsive owl-lazy" alt="blog-image">
            @endif
          </a>
        </div>
        <div id="prime-mix-description-block-blog{{$blog->id}}" class="prime-description-block">
          <h5 class="description-heading">{{$blog->blogs['title']}}</h5>
          <ul class="description-list">
            <li><i class="fa fa-clock-o"></i> {{date ('d.m.Y',strtotime($blog->blogs['created_at']))}}</li>
            <li><i class="fa fa-user"></i> {{$blog->blogs->users['name']}}</li>
          </ul>
          <div class="main-des">
            <p>{!! str_limit($blog->blogs->detail, 100) !!}</p>
            <a href="{{url('account/blog/'.$blog->blogs['slug'])}}">{{__('Read More')}}</a>
          </div>
        </div>
      </div>
      @endif
      @endforeach
    </div>
  </div>
</div>
@endif
@endif