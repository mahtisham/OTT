<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<style>
		@import url('https://fonts.googleapis.com/css?family=Open+Sans');
		body{
			background: #000;
			font-family: 'Open Sans', sans-serif;
		}

		h1{
			font-family: 'Open Sans', sans-serif;
			color: #fff;
			text-transform: uppercase;
		}

		.box
		{
			max-width: 50%;
		}

		.wel{
			width: 200px;
			border-radius: 0.5em;
			padding: 10px;
			background-image: linear-gradient(to right top, #44a1c5, #537196, #4b465e, #2e242d, #000000);
			border:none;
			color: #fff;
			font-weight: 600;
			font-size: 18px;
			font-family: 'Open Sans', sans-serif;
		}
		.forgot-email{
			width:100%; 
			height:2px;
			background:linear-gradient(to right top, #44a1c5, #537196, #4b465e, #2e242d, #000000);
		}
		.forgot-email-background{
			padding:50px;
			background-color:#111;
			background-size: cover;
			width: 100%;
			height: 100%;
			background: url('/images/email-bg.jpg'));
		}
	</style>
</head>
<body>
	<center>
	<div class="forgot-email-background" style="" class="box">
		<div align="center" class="logo">
			<img src="{{ asset('images/logo/'.$logo) }}" alt="logo">


			<p style="font-size:18px;font-family: 'Open Sans', sans-serif;text-align: justify;color: #fff;">
				{{__('Hello')}},
				<br><br>
				{{__('Your Password Reset Code is')}} 
				<br>

				<h1>{{$code}}</h1>
				
			</p>
			<p style="font-size:18px;font-family: 'Open Sans', sans-serif;text-align: justify;color: #fff;">{{__('Use this code in you app and rest your passowrd')}}.</p>
			<div align="center">
				<a style="cursor: pointer;" href="{{ config('app.url') }}"><button style="cursor: pointer;" class="wel">{{__('Explore Now')}} !</button></a>
			</div>

			<p style="font-size:18px;font-family: 'Open Sans', sans-serif;text-align: justify;color: #fff;">
				{{__('Have fun')}}!
				<br>
				{{ config('app.name') }}
			</p>

			<div class="forgot-email" style="">
				
			</div>
		
		</div>
	</div>
</center>
</body>
</html>