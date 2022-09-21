<!-- select 2 -->
   
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('css/admin.css')}}"/>

<select name="actor_id[]" id="" class="form-control actorList select2" multiple="multiple">
 	@foreach($actor_list as $list)
		<option value="{{ $list->id }}">{{ $list->name }}</option>
 	@endforeach
 </select>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
 <script>
 	
 	$(".actorList").select2({
        placeholder: "Pick Actor from list",
        theme: "material"
    });

     $(".select2-selection__arrow")
        .addClass("material-icons")
        .html("arrow_drop_down");
 
 </script>