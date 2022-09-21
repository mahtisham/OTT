<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	@php
		$page = App\Button::first();
	@endphp
	@if(isset($page) && $page->comming_soon == 1)
		<title>{{__('Comming Soon')}}</title>
	@else
		<title>503 {{__('Service Unavailable')}}</title>
	@endif
	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:700,900" rel="stylesheet">

	<!-- Custom stlylesheet -->
<link href="{{url('css/error.css')}}" rel="stylesheet" type="text/css"/> 



</head>


<body>

	<div id="notfound">
		<div class="notfound">
			@php
				$page = App\Button::first();
			@endphp
			<div class="notfound-404">
				@if(isset($page) && $page->comming_soon == 1)
					@if(isset($page->comming_soon_text) && $page->comming_soon_text != NULL)
						<h2 style="top:10%;">{{$page->comming_soon_text}}</h2>
					@else
						<h2 style="top:10%;">{{__('We Are Comming Soon')}}</h2>
					@endif
				@else
				<h1>503</h1>
				<h2>{{__(Service Unavailable)}}</h2>
				@endif
			</div>
			@if(isset($page) && $page->comming_soon == 1)
			@else
				<a href={{url('/')}}>{{__('Homepage')}}</a>
			@endif

		</div>
	</div>

</body>

</html>