<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<title>{{__('Ip Block')}}</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:700,900" rel="stylesheet">

	<!-- Custom stlylesheet -->
<link href="{{url('css/error.css')}}" rel="stylesheet" type="text/css"/> 



</head>


<body>

	<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<h1>403</h1>
				<h2>{{$exception->getMessage() ? $exception->getMessage() : __('Access Forbidden Your IP has been blocked')}}</h2>
			</div>
			
		</div>
	</div>

</body>

</html>