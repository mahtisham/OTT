@extends('layouts.theme')
@section('title',__('our blog'))
@section('main-wrapper')
<div class="genre-prime-block blog-page">
  <div class="container-fluid">
    <h5 class="section-heading">{{__('All Blogs')}}</h5>
    <div class="">
      @if(isset($blogs))
      @foreach($blogs as $item)
      @php
      if($item->image != NULL){
      $image = 'images/blog/'.$item->image;

      }else{
      $image = 'images/default-thumbnail.jpg';
      }

      // Read image path, convert to base64 encoding

      $imageData = base64_encode(@file_get_contents($image));
      if($imageData){
      // Format the image SRC: data:{mime};base64,{data};
      $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
      }
      @endphp
     
      <div class="col-lg-2 col-md-3 col-xs-6 col-sm-4">
        <div class="cus_img">
          <div class="genre-slide-image home-prime-slider protip" data-pt-placement="outside"
            data-pt-interactive="false" data-pt-title="#prime-next-item-description-block{{$item->id}}">

            <a href="{{url('account/blog/'.$item->slug)}}">
              @if(isset($src))
              <img data-src="{{ $src}}" class="img-responsive lazy" alt="{{$item->title}}">
              @endif
            </a>
          </div>
          @if(isset($protip) && $protip == 1)
          <div id="prime-next-item-description-block{{$item->id}}" class="prime-description-block">
            <div class="prime-description-under-block">
              <a href="{{url('account/blog/'.$item->slug)}}"><h5 class="description-heading">{{$item->title}}</h5></a>
              <ul class="description-list">
                <li><i class="fa fa-user"></i> {{$item->users->name}}</li>
              <li><i class="fa fa-clock-o"></i> {{date ('F d,Y',strtotime($item->created_at))}} </li>
              </ul>
              <div class="main-des">
                <p>{!! str_limit($item->detail,'150') !!}</p>
                <a href="{{url('account/blog/'.$item->slug)}}">{{__('Read More')}}</a>
              </div>
            </div>
          </div>
          @endif
        </div>
      </div>
      @endforeach
      @endif
    </div>
  </div>


</div>
@endsection