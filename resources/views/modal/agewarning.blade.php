<!-- Modal -->
<div id="ageWarningModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header text-danger">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{ __('age restricted video') }}</h4>
      </div>
      <div class="modal-body">
        <h5 style="color: #c0392b">{{__('warring for age restrict text')}}</h5>
      </div>
    </div>
    <div class="modal-footer">
     {!! Form::close() !!}
    </div>
  </div>
</div>