@extends('layouts.admin')
@section('title',__('Google Advertise'))
@section('stylesheet')
<style>
  .fl::first-letter {text-transform:uppercase}
</style>
@endsection
@section('content')
<br>
<div class="box-header">
  <h5>{{__('Google Advertise')}}</h5>
</div>

	

        <a href="{{ route('google.ads.create') }}" class="btn btn-md btn-danger">+ {{__('Create AD')}}</a>

          <!-- Delete Modal -->
      <a type="button" class="btn btn-danger btn-md z-depth-0" data-toggle="modal" data-target="#bulk_delete"><i class="material-icons left">delete</i> {{__('Delete Selected')}}</a> 


      <!-- Modal -->
      <div id="bulk_delete" class="delete-modal modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="delete-icon"></div>
            </div>
            <div class="modal-body text-center">
              <h4 class="modal-heading">{{__('Are You Sure')}}</h4>
              <p>{{__('Delete Warrning')}}</p>
            </div>
            <div class="modal-footer">
              {!! Form::open(['method' => 'POST', 'action' => 'GoogleAdsController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>

		<br>
        <div class="content-block box-body content-block-two">

        <table id="full_detail_table" class="table table-hover">
            <thead>
            	<th><div class="inline">
                <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                <label for="checkboxAll" class="material-checkbox"></label>
              </div></th>
                <th>#</th>
                <th>{{__('Google Ad Client')}}</th>
                <th>{{__('Google Ad Slot')}}</th>
                <th>{{__('Edit')}}</th>
                <th>{{__('Actions')}}</th>
            </thead>

            <tbody>
                <tr>
                @php $i=0; @endphp
                @foreach($googleads as $ad)
                @php $i++ @endphp

                <td>
                	<div class="inline">
                    <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="{{$ad->id}}" id="checkbox{{$ad->id}}">
                    <label for="checkbox{{$ad->id}}" class="material-checkbox"></label>
                  </div>
                </td>

                 <td>{{ $i }}</td>
                 <td class="fl">{{ $ad->google_ad_client }}</td>
                 <td class="fl">{{ $ad->google_ad_slot }}</td>
                 <td><a href="{{ route('google.ads.edit',$ad->id) }}" class="btn btn-sm btn-success">{{__('Edit')}}</a></td>
                 <td>
                     <form action="{{ route('google.ads.delete',$ad->id) }}" method="POST">
                        {{ csrf_field() }} 
                        {{ method_field('DELETE')}}
                        <input type="submit" value="{{__('Delete')}}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger"/>
                        
                     </form>
                 </td>
                 </tr>
                @endforeach
            </tbody>
        </table>

       </div>
@endsection

@section('custom-script')
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
  </script>
@endsection

