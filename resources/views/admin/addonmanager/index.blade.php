@extends('layouts.admin')
@section('title',__('Addon Manager'))
@section('content')
 <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <!-- install Modal -->
      <a data-target="#installnew" data-toggle="modal" class="btn btn-danger btn-md"><i class="material-icons left">add</i> {{__('Install New AddOn')}}</a>   
      <!-- Modal -->
    </div>

 <div class="content-block box-body content-block-two">

    <table id="modules" class="table table-bordered">
        <thead>
            <th>#</th>
            <th>{{__('Logo')}}</th>
            <th>{{__('Name')}}</th>
            <th>{{__('Status')}}</th>
            <th>{{__('Version')}}</th>
            <th>{{__('Actions')}}</th>
        </thead>

        <tbody>

        </tbody>
    </table>

    <div data-backdrop="static" data-keyboard="false" id="installnew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="my-modal-title">
                        <b>{{ __("Install New AddOn") }}</b>
                    </h5>
                    
                </div>
                <div class="modal-body">
                    <form action="{{ route('addon.install') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>{{__('Enter Purchase Code')}}: <span class="text-danger">*</span></label>
                            <input type="text" placeholder="{{__('Envanto Purchase Code Of Your Addon')}}" class="form-control" name="purchase_code">
                        </div>

                        <div class="form-group">
                            <label>{{__('ChooseZipFile')}}: <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="addon_file">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> {{__('Install')}}</button>
                         
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom-script')
<script>
    $(function () {
        "use strict";
        var table = $('#modules').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url("admin/addon-manger") }}',
            language: {
                searchPlaceholder: "Search Modules..."
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable : false
                },
                {
                    data: 'image',
                    name: 'image',
                    searchable: false,
                    orderable : false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'version',
                    name: 'version'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ],
            dom: 'lBfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print'
            ],
            order: [
                [0, 'DESC']
            ]
        });

        $('#modules').on('change', '.toggle_addon', function (e) { 

            var modulename = $(this).data('addon');

            if($(this).is(':checked')){
                var status = 1;
            }else{
                var status = 0;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url : '{{ url("admin/toggle/module") }}',
                method : 'POST',
                data : {status : status, modulename : modulename},
                success :function(data){
                    table.draw();

                    if(data.status == 'success'){
                        toastr.success(data.msg,{timeOut: 1500});
                    }else{
                        toastr.error(data.msg, 'Oops!',{timeOut: 1500});
                    }
                    
                },
                error : function(jqXHR,err){
                    console.log(err);
                }
            });

        });

    });
</script>
@endsection