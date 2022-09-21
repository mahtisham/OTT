@extends('layouts.admin')
@section('title',__('Create Google Advertise'))
@section('content')
<br>
<div class="admin-form-main-block">
	<h4 class="admin-form-text"><a href="{{ route('google.ads') }}" data-toggle="tooltip" data-original-title="{{__('Go Back')}}" class="btn-floating"><i class="material-icons">reply</i></a> {{__('Create Google Advertise')}}</h4>

	<div class="row">
    	<div class="col-md-6">
      		<div class="admin-form-block z-depth-1">
				<form style="margin-top:-15px;" enctype="multipart/form-data" method="POST" action="{{ route('google.ads.store') }} ">
					<br>
						{{ csrf_field() }}
					
					<div id="forpopup1">
						<label for="">{{__('Google Ad Client')}}</label>
						<input type="text" class="form-control" name="google_ad_client" placeholder="ca-pub-9227170916808685" >
						<small class="text-danger">{{ $errors->first('google_ad_client') }}</small>
					</div>
					
					<div id="forpopup1">
						<label for="">{{__('Google Ad Slot')}}</label>
						<input type="text" class="form-control" name="google_ad_slot" placeholder="7711195609" >
						<small class="text-danger">{{ $errors->first('google_ad_slot') }}</small>
					</div>

					<div id="forpopup1">
						<label for="">{{__('Google Ad Width')}}</label>
						<input type="text" class="form-control" name="google_ad_width" placeholder="100" >
						<small class="text-danger">{{ $errors->first('google_ad_width') }}</small>
					</div>

					<div id="forpopup1">
						<label for="">{{__('Google Ad Height')}}</label>
						<input type="text" class="form-control" name="google_ad_height" placeholder="300" >
						<small class="text-danger">{{ $errors->first('google_ad_height') }}</small>
					</div>
				
				
					<div id="forpopup1">
						<label for="">{{__('Enter Star Time')}}</label>
						<input type="text" class="form-control" name="google_ad_starttime" placeholder="ex. 00:00:10" >
						<small class="text-danger">{{ $errors->first('google_ad_starttime') }}</small>
					</div>
				

					<div id="forpopup">
					<label for="">{{__('Enter End Time')}}</label>
					<input type="text" class="form-control" name="google_ad_endtime" placeholder="ex. 00:00:20" >
					<small class="text-danger">{{ $errors->first('google_ad_endtime') }}</small>
					</div>
					

					<input type="submit" class="btn btn-primary" value="{{__('Create')}}">

				</form>
			</div>
		</div>
	</div>
</div>
@endsection