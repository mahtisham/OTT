@extends('layouts.admin')
@section('title',__('Create Advertise'))
@section('content')
<br>
<div class="admin-form-main-block">
	<h4 class="admin-form-text"><a href="{{ route('ads') }}" data-toggle="tooltip" data-original-title="{{__('Go Back')}}" class="btn-floating"><i class="material-icons">reply</i></a> {{__('Create Advertise')}}</h4>
{{-- <a href="{{ route('ads') }}" class="btn btn-md btn-danger"><< {{__('Back')}}</a> --}}
	<div class="row">
    	<div class="col-md-6">
      		<div class="admin-form-block z-depth-1">
				<form style="margin-top:-15px;" enctype="multipart/form-data" method="POST" action="{{ route('ad.store') }} ">
					<br>
						{{ csrf_field() }}
					<label for="ad_location">{{__('Ad Location:')}}</label>
					<select name="ad_location" id="test" class="form-control">
						<option value="popup">{{__('Popup')}}</option>
						<option value="onpause">{{__('On pause')}}</option>
						<option id="skipad" value="skip">{{__('Skip Add')}}</option>
					</select>

					
					<div id="s_img" class="form-group">
						<div class="form-group{{ $errors->has('ad_image') ? ' has-error' : '' }}">
							<label for="ad_image">{{__('Add Image')}}</label>
							<input type="file" name="ad_image" class="form-control">
							
						</div>
              <small class="text-danger">{{ $errors->first('ad_image') }}</small>
					</div>
					<br>
					<div style="display: none;"  id="type">
					<input  type="radio" value="upload" checked name="checkType" id="ch1"> {{__('Upload')}} 
					<input  type="radio" value="url" name="checkType" id="ch2"> {{__('URL')}}
					</div>
				
					<input style="display: none;" placeholder="http://" type="text" name="ad_url" id="ad_url">
					

					<div id="s_video" style="display: none;" class="form-group">
						<div class="form-group{{ $errors->has('ad_video') ? ' has-error' : '' }}">
						<label for="ad_image">{{__('Add Video')}}</label>
						<input type="file" name="ad_video" class="form-control">
						<span class="help-block">
			                  <strong>{{ $errors->first('ad_video') }}</strong>
			         		 </span>
					</div>
					</div>

					<label for="">{{__('Enter Add Target:')}}</label>
					<input type="text" class="form-control" placeholder="{{__('Enter Add Target URL:http://')}}" name="ad_target">
				
					<div id="forpopup1">
					<label for="">{{__('Enter Start Time:')}}</label>
					<input type="text" class="form-control" name="time" placeholder="ex. 00:00:10" >
					<small class="text-danger">{{ $errors->first('time') }}</small>
					</div>
				
					<div style="display: none;" id="ad_hold_time">
						<label for="ad_hold">{{__('Add Hold Time:')}}</label>
						<input type="text" class="form-control" placeholder="eg. 5" name="ad_hold">
					</div>

					<div id="forpopup">
					<label for="">{{__('Enter EndT ime:')}}</label>
					<input type="text" class="form-control" name="endtime" placeholder="ex. 00:00:20" >
					<small class="text-danger">{{ $errors->first('endtime') }}</small>
					</div>
					

					<input type="submit" class="btn btn-primary" value="{{__('Create')}}">

				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('custom-script')
	<script type="text/javascript">
		$('#test').change(function() {
    if($(this).val() == 'skip')
    {
    	$('#s_video').show();
    	$('#s_img').hide();
    	$('#type').show();
    	$('#forpopup1').show();
    	$('#forpopup').hide();
    	$('#ad_hold_time').show();
    }

    	else
    {
    	$('#s_video').hide();
    	$('#s_img').show();
    	$('#type').hide();
    	$('#ad_hold_time').hide();

    }

    if($(this).val() == 'popup')
    {
    	$('#s_video').hide();
    	$('#s_img').show();
    	$('#forpopup1').show();
    	$('#forpopup').show();
    	$('#type').hide();
    	$('#ad_hold_time').hide();
    }

     if($(this).val() == 'onpause')
    {
    	$('#s_video').hide();
    	$('#s_img').show();
    	$('#forpopup').hide();
    	$('#forpopup1').hide();
    	$('#type').hide();
    	$('#ad_hold_time').hide();
    }
        
	});

		$('#ch2').click(function(){
			$('#s_video').hide();
			$('#ad_url').show();
		});

		$('#ch1').click(function(){
			$('#s_video').show();
			$('#ad_url').hide();
		});

		
  

	</script>

	<script>
  $(function() {
    $('#toggle-event').change(function() {
      $('#url').val(+ $(this).prop('checked'))
    })
  })
</script>
@endsection