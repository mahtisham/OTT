@extends('layouts.admin')
@section('title',__('Device History'))
@section('content')

  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
    
        <h4>{{__('DeviceHistory')}}</h4> <br/>
    <div class="content-block box-body content-block-two">
      <table id="devicetable" class="table table-hover db">
        <thead>
          <tr class="table-heading-row">
            <th>#</th>
            
            <th>{{ __("User name")}}</th>
            <th>{{ __("IP Address") }}</th>
            <th>{{ __("Platform") }}</th>
            <th>{{ __("Browser") }}</th>
            <th>{{ __("Logged in at") }}</th>
            <th>{{ __("Logged out at") }}</th>
          </tr>
        </thead>
       
          <tbody>
        
          </tbody>
       
      </table>
    </div>
  </div>
@endsection
@section('custom-script')
 <script>
    $(function () {
      
      var table = $('#devicetable').DataTable({
          processing: true,
          serverSide: true,
         responsive: true,
         autoWidth: false,
         scrollCollapse: true,
       
         
          ajax: "{{ route('device_history') }}",
          columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'username',
                    name: 'users.name'
                },
                {
                    data: 'ip_address',
                    name: 'auth_log.ip_address'
                },
                {
                    data: 'platform',
                    name: 'auth_log.platform'
                },
                {
                    data: 'browser',
                    name: 'auth_log.browser'
                },
                {
                    data: 'login_at',
                    name: 'auth_log.login_at'
                },
                {
                    data: 'logout_at',
                    name: 'auth_log.logout_at'
                }
          ],
          dom : 'lBfrtip',
          buttons : [
            'csv','excel','pdf','print'
          ],
          order : [[0,'desc']]
      });
      
    });
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
    
  </script>

@endsection
