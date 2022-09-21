<div class="admin-table-action-block">
  @can('label.edit')
    <a href="{{route('label.edit', $id)}}" data-toggle="tooltip" data-original-title="{{__('Edit')}}" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
  @endcan
  @can('label.delete')
    <button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal{{$id}}"><i class="material-icons">delete</i> </button>
  @endcan
</div>
  <div id="deleteModal{{$id}}" class="delete-modal modal fade" role="dialog">
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
        <form method="POST" action="{{route("label.destroy", $id)}}">
          @method("DELETE")
          @csrf                          
          <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
            <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
        </form>
      </div>
    </div>
  </div>
</div>