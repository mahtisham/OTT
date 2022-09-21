@extends('layouts.admin')
@section('title','Progressive Web App Setting | ')
@section('content')
	<div class="admin-form-main-block mrg-t-40">
		<div class="box-header with-border">
			<div class="box-title">
				{{__('Progressive Web App Setting')}}
			</div>		
		</div>
		<div class="box-body admin-form-block z-depth-1">
			<!-- Nav tabs -->
		<ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
		  
		  <li role="presentation" class="nav-item">
			<a class="nav-link active" data-toggle="pill" href="#home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">{{__('App Setting')}}</a>
		  </li>
		  <li role="presentation" class="nav-item">
			<a class="nav-link" data-toggle="pill" href="#profile" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">{{__('Update Icons')}}</a>
		  </li>
		  
		</ul>

		<!-- Tab panes -->
		<div class="tab-content" id="custom-tabs-four-tabContent">
		  <div role="tabpanel" class="tab-pane active" id="home">
				<br>
			  <div class="callout callout-success">
				  <i class="fa fa-info-circle"></i>
				   {{__('Progessive Web App Requirements')}}
				   <ul>
					   <li><b>{{__('Https')}}</b> {{__('Https Note')}}</li>
				    	<li><b>{{__('StartURL')}}</b> {{__('Start URL Note')}}</li>
				   </ul>
			  </div>

			  <div class="row">
				  <div class="col-md-12">
					  <form action="{{ route('pwa.setting.update') }}" method="POST" enctype="multipart/form-data">
						  @csrf

						  <div class="form-group">
							 
							  <div class="form-group make-switch">
							  	<div class="col-md-5">
							  		<h5 class="bootstrap-switch-label">{{__('Enable PWA')}}</h5>
							  	</div>
								<input class="bootswitch col-md-5" {{ env("PWA_ENABLE") =='1' ? "checked" : "" }} type="checkbox" data-on-text="{{__('On')}}" data-off-text="{{__('OFF')}}" name="PWA_ENABLE" >
								
							  </div>
						  </div>
						  
						  <div class="form-group">
							  <label>{{__('App Name')}}: </label>
							  <input  class="form-control" type="text" name="app_name" value="{{ env("PWA_NAME")}}"/>
						  </div>

						  <div class="row">
							  <div class="col-md-6">
								  <div class="form-group">
									  <label>{{__('Theme Color For Header')}}: </label>
									  <input name="PWA_THEME_COLOR" class="form-control" type="color" value="{{env('PWA_THEME_COLOR') ?? '' }}"/>
								  </div>
							  </div>
							  <div class="col-md-6">
								  <div class="form-group">
									  <label for="">{{__('Background Color')}}:</label>
									  <input name="PWA_BG_COLOR" class="form-control" type="color" value="{{ env('PWA_BG_COLOR') ?? '' }}"/>
								  </div>
							  </div>
						  </div>

						  <div class="row">
							  <div class="col-md-5">

								  <div class="form-group">
						
							
									<label for="">{{__('Shortcut Icon For Home')}}: <span class="text-danger">*</span> </label>
									
									<div class="custom-file">
									  <input name="shorticon_1" type="file" class="custom-file-input @error('shorticon_1') is-invalid @enderror" id="shorticon_1">
									  <label class="custom-file-label" for="shorticon_1">{{ __("Select icon for login (96 x 96)") }}</label>
									</div>
					  
									@error('shorticon_1')
									  <span class="invalid-feedback" role="alert">
										  <strong>{{ $message }}</strong>
									  </span>
									@enderror
								  </div>
							  </div>
                            @if(env('SHORTCUT_ICON1') != NULL)
							  <div class="col-md-1 card text-center">
							  	@if(env('SHORTCUT_ICON1') != NULL)
								<div class="card-body">
									<img class="img-responsive" src="{{ url('images/icons/'.env('SHORTCUT_ICON1'))}}" alt="{{ 'shorticon_1' }}">
								</div>
								@endif
							  </div>
                            @endif
							  <div class="col-md-5">
								  <div class="form-group">
									<label for="">{{__('Shortcut Icon For Login')}}: <span class="text-danger">*</span> </label>
									
									<div class="custom-file">
									  <input name="shorticon_2" type="file" class="custom-file-input @error('shorticon_2') is-invalid @enderror" id="shorticon_2">
									  <label class="custom-file-label" for="shorticon_2">{{ __("Select icon for home (96 x 96)") }}</label>
									</div>
					  
									@error('shorticon_2')
									  <span class="invalid-feedback" role="alert">
										  <strong>{{ $message }}</strong>
									  </span>
									@enderror
								  </div>
							  </div>
                             @if(env('SHORTCUT_ICON2') != NULL)
							  <div class="col-md-1 card text-center">
							  
								  <div class="card-body">
									<img class="img-responsive" src="{{ url('images/icons/'.env('SHORTCUT_ICON2'))}}" alt="{{ 'shorticon_2' }}">
								  </div>
								
							  </div>
                            @endif
							  

						  </div>
  

						  <button  data-loading-text="<i class='fa fa-spinner fa-spin'></i> Saving..." type="submit" class="btn btn-default btn-add">
							 {{__('Save Changes')}}
						</button>
					  </form>
				  </div>

			  </div>
			  
		  </div>
		  <div role="tabpanel" class="tab-pane" id="profile">
				<br>
			  <h4>{{__('PWA Icons')}}:</h4>

			  <hr>

			  <form action="{{ route('pwa.icons.update') }}" method="POST" enctype="multipart/form-data">
				  @csrf
				  <div class="row">
					
					  <div class="col-md-6">
						  <div class="form-group">
						
							
							<label>{{__('PWAIcon')}} (512x512): <span class="text-danger">*</span> </label>
							
							<div class="custom-file">
							  <input name="icon_512" type="file" class="custom-file-input @error('icon_512') 'is-invalid' @enderror" id="icon_512">
							  <label class="custom-file-label" for="icon_512">{{ __("Select icon (512 x 512)") }}</label>
							</div>
			  
							@error('icon_512')
							  <span class="invalid-feedback" role="alert">
								  <strong>{{ $message }}</strong>
							  </span>
							@enderror
						  </div>
					  </div>

					  <div class="offset-md-1 col-md-2 card">
						  <div class="card-body">
							<img class="img-responsive" src="{{ url('images/icons/icon-512x512.png') }}" alt="icon_512x512.png">
						  </div>
					  </div>

					  <div class="col-md-12">
						  <button  data-loading-text="<i class='fa fa-spinner fa-spin'></i> Updating..." type="submit" class="btn btn-default btn-add">
							{{__('Update Icon')}}
						  </button>
					  </div>

				  </div>

				  <br>

				  <h4>{{__('Splash Screens')}}:</h4>
				  <hr>

				  <div class="row">

					  <div class="col-md-6">
						  
						  <div class="form-group">
						
							
							<label>{{__('PWA Splash Screen')}} (2048x2732): <span class="text-danger">*</span> </label>
							
							<div class="custom-file">
							  <input name="splash_2048" type="file" class="custom-file-input @error('splash_2048') 'is-invalid' @enderror" id="splash_2048">
							  <label class="custom-file-label" for="splash_2048">{{ __("Select splash screen (2048x2732)") }}</label>
							</div>
			  
							@error('splash_2048')
							  <span class="invalid-feedback" role="alert">
								  <strong>{{ $message }}</strong>
							  </span>
							@enderror
						  </div>
					  </div>

					  <div class="offset-md-1 col-md-2 card">
						 <div class="card-body">
							<img class="img-responsive" src="{{ url('images/icons/splash-2048x2732.png') }}" alt="splash-2048x2732.png">
						 </div>
					  </div>

					  <div class="col-md-12">
						<button  data-loading-text="<i class='fa fa-spinner fa-spin'></i> Updating..." type="submit" class="btn btn-default btn-add">
							{{__('Update Screen')}}
						</button>
					  </div>
					  

				  </div>



			  </form>
		  </div>
		</div>
		</div>
		
	</div>
@endsection
@section('script')
		<script>
			$("input[data-bootstrap-switch]").each(function(){
				$(this).bootstrapSwitch();
			});
		</script>
@endsection