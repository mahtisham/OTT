@extends('layouts.admin')
@section('title','Currency')
@section('content')
    <div class="content-main-block mrg-t-40">
        <div class="content-block box-body content-block-two" style="padding:5px">
            <form action="{{route('currency.exchanges.save')}}" method="POST">
                @csrf
                <div class="form-group">
                  <label>OPEN EXCHANGE RATE KEY : <span class="required">*</span></label>

                  <small>
                    <a target="__blank" title="Get your keys from here" class="text-muted pull-right"
                      href="https://openexchangerates.org/signup/free"><i class="fa fa-key"></i>{{__(' Get Your OPEN EXCHANGE RATE
                      KEY From Here')}}</a>
                  </small>
                  <hr>
                  <input required id="OPEN_EXCHANGE_RATE_KEY" value="{{ env('OPEN_EXCHANGE_RATE_KEY') }}"
                    name="OPEN_EXCHANGE_RATE_KEY" type="text" class="form-control"
                    placeholder="enter OPEN EXCHANGE RATE KEY">

                    <small class="text-muted">
                      <i class="fa fa-question-circle"></i> {{__("It will be used to fetch exchange rates of currenies.")}}
                    </small>
                </div>
                <div class="form-group">
                  <button type="submit"  class="btn btn-md btn-primary">
                        <i class="fa fa-save"></i> {{ __('Save') }}
                  </button>
                </div>
            </form>
        </div>
        <div class="admin-create-btn-block">
            <a data-toggle="modal" data-target="#addcurrency" class="btn btn-danger btn-md"><i class="material-icons left">add</i> {{__('Add new currency')}}</a>
            <a class="btn btn-danger btn-md updateRateBtn"><span id="buttontext">{{__('Update Currency Rate')}}</span></a>
        </div>
        <div style="display:none;" class="alert alert-success" id="msg_div">
              <center><span id="res_message"></span></center>
        </div>
        <div class="content-block box-body content-block-two">
            <table id="currency" class="table table-hover db">
                <thead>
                  <tr class="table-heading-row">
                    <th>
                      <div class="inline">
                        <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                        <label for="checkboxAll" class="material-checkbox"></label>
                      </div>
                      
                    </th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Code')}}</th>
                    <th>{{__('Symbol')}}</th>
                    <th>{{__('Exchange rate')}}</th>
                    <th>{{__("Created at")}}</th>
                    <th>{{__("Action")}}</th>
                  </tr>
                </thead>
                <tbody>
            
               </tbody>
            </table>
        </div>
    </div>



    <div id="addcurrency" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">{{ __("Add new currency") }}</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <form action="{{ route("currency.store") }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="my-input">Currency (ISO code 3): <span class="text-danger">*</span> </label>
                        <input required class="form-control" type="text" name="code">
                    </div>
 
                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i>
                            {{ __("Create") }}
                        </button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('custom-script')
  {{--   <script src="{{ url('assets/plugins/tabledit/jquery.tabledit.js') }}"></script>  --}}  
    <script>
    

        $(document).ready(function() {
           var table = $('#currency').DataTable({
                lengthChange: false,
                responsive: true,
                serverSide: true,
                ajax: '{{ route('currency.index') }}',
                columns: [

                   {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable : false, orderable : false},
                  {data : 'name', name : 'currencies.name'},
                  {data : 'code', name : 'currencies.code'},
                  {data : 'symbol', name : 'currencies.symbol'},
                  {data : 'exchange_rate', name : 'currencies.exchange_rate'},
                  {data : 'created_at', name : 'currencies.created_at'},
                  {data : 'action', name : 'action', searchable : false, orderable : false},
                 
                ],
                dom : 'lBfrtip',
                buttons : [
                    'csv','excel','pdf','print'
                ],
                order : [[0,'desc']]
            });

            table.buttons().container().appendTo('#userstable .col-md-3:eq(0)');
        


            $('.updateRateBtn').on('click',function(){
              $.ajax({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  type: "POST",
                  url: '{{ route("auto.update.rates") }}',
                  beforeSend: function() {
                    $('#buttontext').html('<i class="fa fa-refresh fa-spin fa-fw"></i>');
                  },
                  success: function(data) {
                    table.draw();
                    console.log(data);
                    $('#msg_div').show();
                    $('#res_message').html('');
                    $('#res_message').append(data.msg);
                    $('#buttontext').html('Update Currency Rate');
                    setTimeout(function(){
                        $('#res_message').hide();
                        $('#msg_div').hide();

                    },2000);
                  
                  },
                  error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest);
                  }
                });
            });
        });
    </script>
@endsection