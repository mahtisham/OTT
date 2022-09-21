@extends('layouts.admin')
@section('title',__('Remove Public'))
@section('content')
<div class="admin-form-main-block mrg-t-40">
  <div class="admin-create-btn-block">
     <h4 class="admin-form-text">{{__('Remove Public')}}</h4>
  </div>
   <div class="row">
      <div class="col-lg-10 col-xs-6">
      	<div class="admin-form-block z-depth-1">
      		<div class="callout callout-danger">
	    		<i class="fa fa-info-circle"></i>
	    		 {{__('Important Notes')}}
	    		 <ol type="1">
	    		 	<li>- {{__('Removing public from URL is only works when you have installed script in main domain.')}}</li>
	    		 	<li>- {{__('Do not remove public when you have Installed script in subdomin or subfolders.')}}</li>
	    		 </ol>
	    	</div>
      		<form method="POST" action="{{route('remove.public')}}">
      			@csrf
      			<button type="submit" class="btn btn-success">{{__('Remove Public')}}</button>
      			
      		</form>
      	</div>

      </div>
  </div>
</div>
@endsection