@extends('layouts.admin')
@section('title',__('All Users'))
@section('content')
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      @can('users.create')
        <a href="{{route('users.create')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i> {{__('Create User')}}</a>
      @endcan
      <!-- Delete Modal -->
      @can('users.delete')
        <a type="button" class="btn btn-danger btn-md z-depth-0" data-toggle="modal" data-target="#bulk_delete"><i class="material-icons left">delete</i> {{__('Delete Selected')}}</a>   
      @endcan
      <!-- Modal -->
      <div id="bulk_delete" class="delete-modal  modal right fade" role="dialog">
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
              {!! Form::open(['method' => 'POST', 'action' => 'UsersController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
      
    </div>
    <div class="content-block box-body content-block-two">
      <table id="usersTable" class="table table-hover">
        <thead>
          <tr class="table-heading-row">
            <th>
              <div class="inline">
                <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                <label for="checkboxAll" class="material-checkbox"></label>
              </div>
              #
            </th>
            <th>{{__('ID')}}</th>
            <th>{{__('Name')}}</th>
            <th>{{__('Email')}}</th>
            <th>{{__('Created At')}}</th>
            <th>{{__('Updated At')}}</th>
            <th>{{__('Status')}}</th>
            <th>{{__('Actions')}}</th>
          </tr>
        </thead>
        @if ($users)
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
      
      var table = $('#usersTable').DataTable({
          processing: true,
          serverSide: true,
         responsive: true,
         autoWidth: false,
         scrollCollapse: true,
       
         
          ajax: "{{ route('users.index') }}",
          columns: [
              
              {data: 'checkbox', name: 'checkbox',orderable: false, searchable: false},
              {data: 'DT_RowIndex', name: 'DT_RowIndex',searchable: false},
              {data: 'name', name: 'name'},
              {data: 'email', name: 'email'},
              {data: 'created_at', name: 'created_at',searchable: false},
              {data: 'updated_at', name: 'updated_at',searchable: false},
                {data: 'status', name: 'status'},
              {data: 'action', name: 'action',searchable: false}
             
          ],
          dom : 'lBfrtip',
          buttons : [
            'csv','excel','pdf','print'
          ],
          order : [[0,'desc']],
           "oLanguage": {
              "sEmptyTable":     "<b>Let's start :)</b><br><small>Get Started by creating a user! All of your users will be displayed on this page.</small><br/> "
          }
      });
      
    });
var SITEURL = '{{URL::to('')}}';
     /* When click Status Button */
    $('body').on('click', '.status', function () {
      var pid = $(this).data('id');
    
       $.ajax({
            type: "get",
            url: SITEURL + "/admin/user/status/"+pid,
            success: function (data) {
            var oTable = $('#usersTable').dataTable(); 
            oTable.fnDraw(false);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
     
   });

  // $('#usersTable').dataTable({
  //   "oLanguage": {
  //       "sEmptyTable": "My Custom Message On Empty Table"
  //   }
  // });
  </script>
@endsection