@extends('layouts.admin')
@section('title', __('App Ui Shorting'))

@section('content')
<div class="admin-form-main-block mrg-t-40">
  <!-- Tab buttons for site settings -->
    <h5>{{__('App Ui Shorting')}}</h5><br/>
  
  <p class="info">{{__('DragAnDrop')}}</p>
  <div class="content-block box-body content-block-two">
      <table id="full_detail_table" class="table table-hover">
        <thead>
          <tr class="table-heading-row">
          <th class="text-center">#</th>
          <th class="text-center">{{__('App Menu Name')}}</th>
          <th class="text-center">{{__('Status')}}</th>
          </tr>
        </thead>
        @if ($appUiShorting)
          <tbody id="sortable">
            @foreach ($appUiShorting as $key => $aus)

            <tr class="sortable row1" data-id="{{ $aus->id }}">
                <td>{{$key+1}}</td>
                <td>{{$aus->name}}</td>
                <td>
                    <form action="{{ Route('appmenustatus',$aus->id) }}" method="POST">
                      {{ csrf_field() }}
                    @if($aus->is_active == '1')
                    <input type="hidden" value="0" name="is_active">
                    <button type="submit" class="btn btn-sm btn-success">{{__('Active')}}</button>
                    @else
                    <input type="hidden" value="1" name="is_active">
                    <button type="submit" class="btn btn-sm btn-danger">{{__('Deactive')}}</button>
                    @endif
                    </form>
                </td>
              </tr>
              
              </div>

            @endforeach
          </tbody>
        @endif
      </table>
    </div>
</div>
@endsection
@section('custom-script')
<script>
    $(function() {
      $('#cb3').change(function() {
        $('#is_active').val(+ $(this).prop('checked'))
      })
    })
  </script>
  <script>
 
 var sorturl = {!!json_encode(route('app_ui_reposition'))!!};

</script>
<script>
 $(function(){
   $('#checkboxAll').on('change', function(){
     if($(this).prop("checked") == true){
       $('.material-checkbox-input').attr('checked', true);
     }
     else if($(this).prop("checked") == false){
       $('.material-checkbox-input').attr('checked', false);
     }
   });
 });


 $( "#full_detail_table" ).sortable({
   items: "tr",
   cursor: 'move',
   opacity: 0.6,
   update: function() {
       sendOrderToServer();
   }
 });

 function sendOrderToServer() {
   var order = [];
   var token = $('meta[name="csrf-token"]').attr('content');
   $('tr.row1').each(function(index,element) {
     order.push({
       id: $(this).attr('data-id'),
       position: index+1
     });
   });
   $.ajax({
     type: "POST", 
     dataType: "json", 
     url: sorturl,
     data: {
         order: order,
       _token: token
     },
     success: function(response) {
         if (response.status == "success") {
           console.log(response);
         } else {
           console.log(response);
         }
     }
   });
 }
    
</script>
@endsection
