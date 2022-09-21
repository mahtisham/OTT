<!-- Modal -->
<div id="ageModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header text-danger">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{ __('agerestrictedvideo') }}</h4>
      </div>
       {!! Form::open(['method' => 'POST', 'action' => 'UsersController@update_age']) !!}
      <div class="modal-body">
        <h6 style="color: #e74c3c">{{ __('foragerestricttext')}}</h6><br>
        <div class="search form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
          {!! Form::label('dob', 'Date Of Birth') !!}
          <input type="date" class="form-control"  name="dob"  />   
          <small class="text-danger">{{ $errors->first('dob') }}</small>
        </div>
      </div>
      <div class="modal-footer">
        <div class="pull-right">      
          <button type="submit" class="btn btn-primary">{{__('update')}}</button>
        </div>
      </div>
     {!! Form::close() !!}
    </div>

  </div>
</div>