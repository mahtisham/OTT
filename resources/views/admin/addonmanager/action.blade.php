@if($url != NULL)
<a href="{{url($url)}}" data-toggle="tooltip" data-original-title="{{__('Manage Settings')}}" class="btn-success btn-floating"><i class="material-icons">settings</i></a>
@endif
<a data-toggle="modal" data-target="#delete{{ $name }}" class="btn btn-floating btn-danger">
  <i class="material-icons">delete</i>
</a>

<div id="delete{{ $name }}" class="delete-modal modal fade" role="dialog">
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
          <form method="post" action="{{ route('addon.delete') }}" class="pull-right">
            @csrf
            <input type="hidden" name="modulename" value="{{ $name }}">
            <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
            <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
          </form>
        </div>
      </div>
    </div>
  </div>