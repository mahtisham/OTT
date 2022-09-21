@if(!in_array($id,['1','2','3']))
  <a href="{{ route('roles.edit',$id) }}" data-toggle="tooltip" data-original-title="{{__('Edit')}}" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
@else 
  <p class="text-danger">
   {{__("System reserved role")}}
  </p> 
 @endif

@if(!in_array($id,['1','2','3']))
  <a title="Delete Role" @if(env('DEMO_LOCK')==0) data-toggle="modal" data-target="#delete{{ $id }}" @else
    disabled="disabled" title="This operation is disabled in Demo !" @endif class="btn-danger btn-floating">
    <i class="material-icons">delete</i>
  </a>

  <div id="delete{{ $id }}" class="delete-modal modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class="delete-icon"></div>
        </div>
        <div class="modal-body text-center">
          <h4 class="modal-heading">{{__('Are You Sure')}} ?</h4>
          <p>{{__('Do you really want to delete this role')}} <b>{{ $name }}</b> ? <b> {{__('By Clicking YES IF any user attach to this role will be unroled !')}}</b>{{__(' This process cannot be undone.')}}</p>
        </div>
        <div class="modal-footer">
          <form method="post" action="{{ route('roles.destroy',$id) }}" class="pull-right">
            {{csrf_field()}}
            {{method_field("DELETE")}}

            <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
            <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endif
	
