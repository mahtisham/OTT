@extends('layouts.theme')


@section('custom-meta')

@endsection

@section('title',"$liveevent->title")


@section('main-wrapper')
<!-- main wrapper -->
<section class="main-wrapper main-wrapper-single-movie-prime">
  <div class="background-main-poster-overlay">
    <!-- Modal -->
    @if(isset($liveevent))
      @if($liveevent->poster != null)
        <div class="background-main-poster col-md-offset-4 col-md-6" style="background-image: url('{{asset('images/events/posters/'.$liveevent->poster)}}');">
      @else
        <div class="background-main-poster col-md-offset-4 col-md-6" style="background-image: url('{{asset('images/default-poster.jpg')}}');">
      @endif
    @endif
   </div>
  <div class="overlay-bg gredient-overlay-right"></div>
  <div class="overlay-bg"></div>
  </div>
  <div id="full-movie-dtl-main-block" class="full-movie-dtl-main-block">
    <div class="container-fluid">
      @if(isset($liveevent))
     
        <div class="row">
          <div class="col-md-8 small-screen-block">
            <div class="full-movie-dtl-block">
              <h2 class="section-heading">{{$liveevent->title}}</h2></br>
              <div class="">
                <ul class="casting-headers">
                   <li>{{__('Start Time')}} -
                      <span class="events-count">
                        @if (isset($liveevent->start_time))
                        {{date('M jS Y | h:i:s a',strtotime($liveevent->start_time))}} 

                      @else
                        -
                      @endif
                      </span>
                    </li><br/>
                    <li>{{__('End Time')}} -
                      <span class="events-count">
                        @if (isset($liveevent->end_time))
                        {{date('M jS Y | h:i:s a',strtotime($liveevent->end_time))}} 

                      @else
                        -
                      @endif
                      </span>
                    </li></br>
                    <li>{{__('Organized By')}} -
                      <span class="events-count">
                        @if (isset($liveevent->organized_by))
                        {{$liveevent->organized_by}} 

                      @else
                        -
                      @endif
                      </span>
                    </li>
                
                </ul>

                  <div id="wishlistelement" class="screen-play-btn-block">
                    @php
                    date_default_timezone_set('Asia/Calcutta');
                    $today_date = date('d jS Y | h:i:s');
                   
                     $start_date = date('d jS Y | h:i a',strtotime($liveevent->start_time));

                     $end_date = date('d jS Y | h:i a',strtotime($liveevent->end_time));
                    
                    @endphp
                  @if($today_date >= $start_date && $today_date <= $end_date)

                    @if(isset( $liveevent->video_link['iframeurl']) && $liveevent->video_link['iframeurl'] != null)
                      @if(Auth::check() && Auth::user()->is_admin == '1')
                        <a onclick="playoniframe('{{ $liveevent['iframeurl'] }}','{{ $liveevent->id }}','event')" class="btn btn-play play-btn-icon{{ $liveevent['id'] }}"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                         </a>
                      @else

                         <a onclick="playoniframe('{{ $liveevent['iframeurl'] }}','{{ $liveevent->id }}','event')" class="btn btn-play play-btn-icon{{ $liveevent['id'] }}"><span class="play-btn-icon "><i class="fa fa-play"></i></span><span class="play-text">{{__('Play Now')}}</span>
                          </a>
                      @endif

                    @else
                      @if(Auth::check() && Auth::user()->is_admin == '1')
                        <a  href="{{route('watchevent',$liveevent->id)}}" class="iframe btn btn-play play-btn-icon{{ $liveevent['id'] }}"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                          </a>
                      @else
                        <a href="{{url('/watch/event/'.$liveevent->id)}}" class="iframe btn btn-play play-btn-icon{{ $liveevent['id'] }}"><span class="play-btn-icon "><i class="fa fa-play" ><span class="play-text"> {{__('Play Now')}}</span></a>
                      @endif
                    @endif
                  
                  @endif
                          
                  </div>
              </div>
               
              <p>
                {{$liveevent->description}}
              </p>
            </div>
          </div>
          <div class="col-md-4 small-screen-block">
            <div class="poster-thumbnail-block">
                @if($liveevent->thumbnail != null || $liveevent->thumbnail != '')
                <img src="{{asset('images/events/thumbnails/'.$liveevent->thumbnail)}}" class="img-responsive" alt="genre-image">
                @else
                <img src="{{asset('images/default-thumbnail.jpg')}}" class="img-responsive" alt="genre-image">
                @endif
              </div>
          </div>
        </div>
      @endif
    </div>
  </div>
   

@endsection


@section('custom-script')


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

@endsection