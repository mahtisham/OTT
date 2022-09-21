<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{__('Watch Movie')}} - {{ $movie->title }}</title>
</head>
<body>
	@php
	$cpy = App\PlayerSetting::first();
	$user_id = auth()->user()->id;
	$movie_id = $movie->id;
		if($cpy->is_resume == 1){
			$filename = 'time.json';
			if(file_exists(storage_path() .'/app/time/movie/user_'.$user_id.'/movie_'.$movie_id.'/'.$filename)){
				$result = @file_get_contents(storage_path() .'/app/time/movie/user_'.$user_id.'/movie_'.$movie_id.'/'.$filename);
				$result = json_decode($result);
				$current_time = $result->current_time;
			}else{
				$current_time = '00';
			}
		}else{
			$current_time = '00';
		}
	@endphp

	@if(isset($movie->video_link->iframeurl) && $movie->video_link->iframeurl != NULL)
		@if(strstr($movie->video_link->iframeurl,'https://bradmax.com/'))
			<iframe id="myVideo" src="{{$movie->video_link->iframeurl}}?t={{$current_time}}" allowfullscreen frameborder="0" width="100%"  height="615px" controls>
			</iframe>
		@elseif(strstr($movie->video_link->iframeurl,'.mp4'))
			<video id="myVideo" data-x="" src="{{$movie->video_link->iframeurl}}#t={{$current_time}}" allowfullscreen border="0" width="100%"  height="615px" controls controlsList="nodownload">
			</video>
		@elseif(strstr($movie->video_link->iframeurl,'.mkv'))
			<video id="myVideo" src="{{$movie->video_link->iframeurl}}#t={{$current_time}}" allowfullscreen border="0" width="100%"  height="615px" controls controlsList="nodownload">
			</video>
		
		
		@else
			<iframe id="myVideo" src="{{$movie->video_link->iframeurl}}?t={{$current_time}}" allowfullscreen frameborder="0" width="100%"  height="615px" controls >
			</iframe>
		@endif
	@endif
	
</body>
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script>
$( document ).ready(function() {
	var vid = document.getElementById("myVideo");

      console.log(vid.currentTime);
      setInterval(function(){
		  var current_time = vid.currentTime;
		  

		  var total_time = vid.duration;

		console.log(total_time);
       
		var SITEURL = '{{URL::to('')}}';
		var user_id='{{Auth::check() ? Auth::user()->id : $user}}';
		var movie_id='{{$movie->id}}';

		$.ajax({
			method: "get",
			url: SITEURL + "/user/movie/time/"+ current_time +'/'+movie_id+'/'+user_id+'/'+ total_time,
			data:{
				curDurration:Math.round(current_time),
				totalDuration:Math.round(total_time)
			},
			success: function (data) {
				console.log(data);
			},
			error: function (data) {
				console.log(data)
			}
		});

	  },1000);
	  
		

});

</script>

</html>
	