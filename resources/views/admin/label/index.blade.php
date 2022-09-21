@extends('layouts.admin')
@section('title',__('All Labels'))
@section('content')
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      @can('label.create')
        <a href="{{route('label.create')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i> {{__('Create Label')}}</a>
      @endcan
      <!-- Delete Modal -->
      @can('label.delete')
        <a type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#bulk_delete"><i class="material-icons left">delete</i> {{__('Delete Selected')}}</a>  
      @endcan 
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
              {!! Form::open(['method' => 'POST', 'action' => 'LabelController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-block box-body table-responsive content-block-two">
      <table id="labelTable" class="table table-hover">
        <thead>
          <tr class="table-heading-row">
            <th>
              <div class="inline">
                <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                <label for="checkboxAll" class="material-checkbox"></label>
              </div>
              #
            </th>
            <th>{{__('Name')}}</th>
            <th>{{__('Created At')}}</th>
            <th>{{__('Updated At')}}</th>
            <th>{{__('Actions')}}</th>
          </tr>
        </thead>
        @if (isset($labels))
          <tbody>
           
          </tbody>
        @endif
      </table>
    </div>
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
   <script>
    $(function () {
      "use strict";

      var table = $('#labelTable').DataTable({
          processing: true,
          serverSide: true,
          responsive: true,
          autoWidth: false,
          scrollCollapse: true,
          ajax: "{{ route('label.index') }}",
          columns: [
              {data: 'checkbox', name: 'checkbox',orderable: false, searchable: false},
              {data: 'name', name: 'name'},
              {data: 'created_at', name: 'created_at'},
              {data: 'updated_at', name: 'updated_at'},
              {data: 'action', name: 'action',searchable: false}
             
          ],
          dom : 'lBfrtip',
          buttons : [
            'csv','excel','pdf','print'
          ]
      });
    });

     
  </script>
@endsection