@extends('layouts.admin')
@section('title',__('Edit Advertise'))
@section('stylesheet')
<style>
	.adl::first-letter {text-transform:uppercase}
</style>
@endsection
@section('content')

<div class="admin-form-main-block">
	<h4 class="admin-form-text"><a href="{{ route('ads') }}" data-toggle="tooltip" data-original-title="{{__('Go Back')}}" class="btn-floating"><i class="material-icons">reply</i></a> {{__('Edit Advertise')}}</h4>
	<div class="row">
    	<div class="col-md-6">
      		<div class="admin-form-block z-depth-1">
				@if($ad->ad_location == "onpause" || $ad->ad_location=="popup")
				
				<h5 >{{__('EditAD:')}} {{ $ad->id }} | {{__('Location')}}: <span class="adl">{{ $ad->ad_location }}</span></h5>
				<br>
				<form enctype="multipart/form-data" action="{{ route('ad.update.solo',$ad->id) }}" method="POST">
					{{ csrf_field() }}
					{{ method_field('PUT') }}

					<div class="form-group{{ $errors->has('ad_image') ? ' has-error' : '' }}">
					<label for="ad_image">@if($ad->ad_location == 'popup'){{__('Edit Popup Image')}} @else
					{{__('EditImage')}} @endif
					</label>
					<input name="ad_image" type="file" class="form-control">
					 <span class="help-block">
			                  <strong>{{ $errors->first('ad_image') }}</strong>
			          </span>
					</div>

					<br>
					<label for="">Current Image:</label>
					<img src="{{ asset('adv_upload/image/'.$ad->ad_image)}}" alt="" width="100px" class="img-responsive">
					<br>
					<label for="ad_target">{{__('Edit Ad Target:')}}</label>
					<input type="text" name="ad_target" placeholder="http://" value="{{ $ad->ad_target }} ">
					<br>
					<input type="submit"  value="{{__('Save')}}" class="btn btn-md btn-success">
				</form>
				@elseif($ad->ad_location == "skip")
						
					<form action="{{ route('ad.update.video',$ad->id) }}" enctype="multipart/form-data" method="POST">
						{{ csrf_field() }}
						{{ method_field('PUT') }}
						
						<br>	
						@if($ad->ad_video !="no")
						<div class="form-group{{ $errors->has('ad_video') ? ' has-error' : '' }}">
						<label for="ad_video">{{__('Change ADD Video:')}}</label>
						<input type="file" class="form-control" name="ad_video">
						 <span class="help-block">
			                  <strong>{{ $errors->first('ad_video') }}</strong>
			             </span>
						</div>

						<br>
						<label for="">{{__('Current Video')}}</label>
						<br>
						<video width="320" height="240" controls>

						  <source src="{{ asset('adv_upload/video/'.$ad->ad_video) }}" type="video/mp4">
						  
						</video>
						@else

						<div id="urlbox">
							<label for="url">{{__('ADD URL:')}}</label>
							<input type="text" name="ad_url" value="{{ $ad->ad_url }}">
						</div>
						
						@endif
						<br><br>
						<label for="ad_target">{{__('Edit Add Target:')}}</label>
						<input type="text" value="{{ $ad->ad_target }}" name="ad_target" placeholder="http://">
						<input type="submit" class="btn btn-md btn-success">
					</form>

				@endif
			</div>
		</div>
	</div>
</div>
@endsection

