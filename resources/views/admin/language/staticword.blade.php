@extends('layouts.admin')
@section('title',__('Static Translation'))
@section('content')
<div class="box admin-form-main-block mrg-t-40">
	<div class="box-header with-border">
		<a title="Cancel and go back" href="{{url('/admin/custom-static-words')}}" class=" btn-floating">
			<i class="material-icons">reply</i></a>
		</a>
		<div class="box-title">{{__('Static Word Translations For Language')}}: {{ $findlang->name }}
		</div>
	</div>

	<ul class="nav nav-tabs">
	   <li class="active"><a data-toggle="tab" href="#home">{{__('Static Word Translation')}}</a></li>
	</ul>
	<br/> 
	<div class="callout callout-info">
		<i class="fa fa-info-circle"></i> {{__('Language Instruction')}}
	</div>
	<div class="tab-content">
	    <div id="home" class="tab-pane fade in active">
		   	<form action="{{ route('static.update',$findlang->local) }}" method="POST">
		   	@csrf
				<div class="box-body">
						
					<textarea name="transfile" class="form-control" name="" id="" cols="100" rows="20">{{ $file }}</textarea>
				</div>
				<div class="box-footer">

					 <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> {{__('Reset')}}</button>
					
					<button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> {{__('Update')}}</button>

				</div>
			</form>
	    </div>
	
	</div>
</div>
@endsection