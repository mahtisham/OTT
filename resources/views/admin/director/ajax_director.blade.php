<!-- select 2 -->
   
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('css/admin.css')}}"/>

<select name="director_id[]" id="" class="form-control directorList select2" multiple="multiple">
 	@foreach($director_list as $list)
		<option value="{{ $list->id }}">{{ $list->name }}</option>
 	@endforeach
 </select>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
 <script>
 	
 	$(".directorList").select2({
        placeholder: "Pick Director from list",
        theme: "material"
    });

     $(".select2-selection__arrow")
        .addClass("material-icons")
        .html("arrow_drop_down");
 
 </script>