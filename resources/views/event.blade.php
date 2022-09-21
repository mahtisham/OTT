<!--------------------- live event ------------------------->

    @if(isset($liveevent) && count($liveevent) > 0)
      <div class="genre-prime-block">

        <div class="container-fluid">
          <h5 class="section-heading">{{__('Live Event')}} </h5>
          <div class="genre-prime-slider owl-carousel">
            @foreach($liveevent as $key => $liveevents)
              <div class="genre-prime-slide">
                <div class="genre-slide-image protip" data-pt-placement="outside" data-pt-title="#prime-genre-event-description-block{{$liveevents->id}}">
                  @if($auth && getSubscription()->getData()->subscribed == true)
                    <a href="{{url('event/detail',$liveevents->slug)}}">
                    @if($liveevents->thumbnail != null || $liveevents->thumbnail != '')
                      <img data-src="{{asset('images/events/thumbnails/'.$liveevents->thumbnail)}}" class="img-responsive owl-lazy" alt="liveevent-image">
                    @else
                      <img data-src="{{asset('images/default-thumbnail.jpg')}}" class="img-responsive owl-lazy" alt="liveevent-image">
                    @endif
                   </a>
                  @else
                    <a href="{{url('event/guest/detail',$liveevents->slug)}}">
                    @if($liveevents->thumbnail != null || $liveevents->thumbnail != '')
                      <img data-src="{{asset('images/events/thumbnails/'.$liveevents->thumbnail)}}" class="img-responsive owl-lazy" alt="liveevent-image">
                    @else
                      <img data-src="{{asset('images/default-thumbnail.jpg')}}" class="img-responsive owl-lazy" alt="liveevent-image">
                    @endif
                    </a>
                  @endif
                </div>
                @if(isset($protip) && $protip == 1)
                <div id="prime-genre-event-description-block{{$liveevents->id}}" class="prime-description-block">
                  <div class="prime-description-under-block">
                    <h5 class="description-heading">{{str_limit($liveevents->title,100)}}</h5></br>
                    <p>Start Time :- <b> {{date('F j, Y  g:i:a',strtotime($liveevents->start_time))}} </b> </p>

                    <p>End Time :- <b> {{date('F j, Y  g:i:a',strtotime($liveevents->end_time))}} </b> </p>

                    <p>Organized By :- <b> {{$liveevents->organized_by}} </b> </p>
                
                    <div class="main-des">
                      <p>{{str_limit($liveevents->description,100)}}</p>
                      
                      <a href="#">{{__('Read More')}}</a>
                    </div>
                    <div class="des-btn-block">
                     @php
                        date_default_timezone_set('Asia/Calcutta');
                        $today_date = date('d jS Y | h:i:s');

                         $start_date = date('d jS Y | h:i a',strtotime($liveevents->start_time));

                         $end_date = date('d jS Y | h:i a',strtotime($liveevents->end_time));
                          
                      @endphp
                      @if($today_date >= $start_date && $today_date <= $end_date)

                        @if(isset($liveevents->video_link['iframeurl']) && $liveevents->video_link['iframeurl'] != null)
                          @if(Auth::check() && Auth::user()->is_admin == '1')
                            <a onclick="playoniframe('{{ $liveevents['iframeurl'] }}','{{ $liveevents->id }}','event')" class="btn btn-play play-btn-icon{{ $liveevents['id'] }}"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                             </a>
                          @else

                             <a onclick="playoniframe('{{ $liveevents['iframeurl'] }}','{{ $liveevents->id }}','event')" class="btn btn-play play-btn-icon{{ $liveevents['id'] }}"><span class="play-btn-icon "><i class="fa fa-play"></i></span><span class="play-text">{{__('Play Now')}}</span>
                              </a>
                          @endif

                        @else
                          @if(Auth::check() && Auth::user()->is_admin == '1')
                            <a  href="{{route('watchevent',$liveevents->id)}}" class="btn btn-play play-btn-icon{{ $liveevents['id'] }}"><span class="play-btn-icon"><i class="fa fa-play"></i></span> <span class="play-text">{{__('Play Now')}}</span>
                              </a>
                          @else
                            <a href="{{url('/watch/event/'.$liveevents->id)}}" class=" btn btn-play play-btn-icon{{ $liveevents['id'] }}"><span class="play-btn-icon "><i class="fa fa-play" ><span class="play-text">{{__('Play Now')}} </span></a>
                          @endif
                        @endif
                      
                      @endif
                    </div>
                  </div>
                </div>
                @endif
              </div>
            @endforeach
          </div>
        </div>
      </div>
    @endif


<!-------------------- end live event ---------------------->