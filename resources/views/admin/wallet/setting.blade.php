@extends('layouts.admin')
@section('title','Wallet Setting | ')
@section('content')

<div class="admin-form-main-block mrg-t-40">
  <div class="admin-create-btn-block">
    <div class="col-md-12">
      <h5>{{__('Edit Wallet Setting')}}</h5><br>
      <div class="content-block box-body content-block-two">
        <div class="col-md-12">
          <form action="{{ route('admin.update.wallet.settings') }}" method="POST">
           @csrf
            <div class="col-md-12">
              <div class="bootstrap-checkbox form-group{{ $errors->has('enable_wallet') ? ' has-error' : '' }}">
                <div class="col-md-7">
                  <h5 class="bootstrap-switch-label">{{__('Enable wallet ?')}}</h5>
                </div>
                <div class="col-md-5 pad-0">
                  <div class="make-switch">
                    {!! Form::checkbox('enable_wallet', 1, (isset($wallet) && $wallet->enable_wallet == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>__('On'), "data-off-text"=>__('OFF'), "data-size"=>"small"]) !!}
                  </div>
                </div>
                <small class="text-danger">{{ $errors->first('enable_wallet') }}</small>
                <small class="text-muted"><i class="fa fa-info-circle"></i> {{__('It will activate the wallet on portal')}}</small>
              </div>

              <h6 class="form-block-heading apipadding">{{__('Enable Payment Options on Wallet')}}</h6>
              <br> 

              <div class="col-md-4">
                <div class="bootstrap-checkbox form-group{{ $errors->has('stripe_enable') ? ' has-error' : '' }}">
                  <div class="col-md-7">
                    <h5 class="bootstrap-switch-label">{{__('Enable In Stripe ?')}}</h5>
                  </div>
                  <div class="col-md-5 pad-0">
                    <div class="make-switch">
                      {!! Form::checkbox('stripe_enable', 1, (isset($wallet) && $wallet->stripe_enable == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>__('On'), "data-off-text"=>__('OFF'), "data-size"=>"small"]) !!}
                    </div>
                
                  </div>
                  <small class="text-danger">{{ $errors->first('stripe_enable') }}</small>
                </div>
              </div>
              <div class="col-md-4">
                <div class="bootstrap-checkbox form-group{{ $errors->has('paytm_enable') ? ' has-error' : '' }}">
                  <div class="col-md-7">
                    <h5 class="bootstrap-switch-label">{{__('Enable In Paytm ?')}}</h5>
                  </div>
                  <div class="col-md-5 pad-0">
                    <div class="make-switch">
                      {!! Form::checkbox('paytm_enable', 1, (isset($wallet) && $wallet->paytm_enable == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>__('On'), "data-off-text"=>__('OFF'), "data-size"=>"small"]) !!}
                    </div>
                
                  </div>
                  <small class="text-danger">{{ $errors->first('paytm_enable') }}</small>
                  
                </div>
              </div>
              <div class="col-md-4">
                <div class="bootstrap-checkbox form-group{{ $errors->has('paypal_enable') ? ' has-error' : '' }}">
                  <div class="col-md-7">
                    <h5 class="bootstrap-switch-label">{{__('Enable In Paypal ?')}}</h5>
                  </div>
                  <div class="col-md-5 pad-0">
                    <div class="make-switch">
                      {!! Form::checkbox('paypal_enable', 1, (isset($wallet) && $wallet->paypal_enable == 1 ? 1 : 0), ['class' => 'bootswitch', "data-on-text"=>__('On'), "data-off-text"=>__('OFF'), "data-size"=>"small"]) !!}
                    </div>
                
                  </div>
                  <small class="text-danger">{{ $errors->first('paypal_enable') }}</small>
                </div>
              </div>
            
            </div>
            <br>
            <div class="btn-group col-xs-12">
              <button type="submit" class="btn btn-block btn-success">{{__('Save Settings')}}</button>
            </div>
            <div class="clear-both"></div>
          
          </form> 
        </div>
      </div>
    </div> 
  </div>
  <br>
  @can('wallet.history')
  <div class="admin-create-btn-block">
    <div class="col-md-12 mrg-t-40">
      <h5>{{__('Wallet Transactions')}}</h5><br>
      <div class="content-block box-body content-block-two">
        <div class="col-md-12">
          <table id="wallet_logs_table" class="table table-hover db">
            <thead>
              <tr class="table-heading-row">
                <th>#</th>
                <th>{{__('User')}}</th>
                <th>{{__('Type')}}</th>
                <th>{{__('Amount')}}</th>
                <th>{{__('Note')}}</th>
              </tr>
            </thead>
            
            <tbody>
             
            </tbody>
          </table>
        </div>
      </div>
    </div> 
  </div>
  @endcan
</div>           
                  
                 
@endsection     
@section('custom-script')
<script>

    $(function () {
      "use strict";
      var table = $('#wallet_logs_table').DataTable({
          processing: true,
          serverSide: true,
          ajax: '{{ route("admin.wallet.settings") }}',
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable : false},
              {data : 'user', name : 'user'},
              {data : 'type', name : 'type'},
              {data : 'amount', name : 'amount'},
              {data : 'log', name : 'log'},
          ],
          dom : 'lBfrtip',
          buttons : [
            'csv','excel','pdf','print'
          ],
          order : [[0,'DESC']]
      });
      
});

</script>
@endsection
                    
  
       


        
         
        
  
                  
                   
  
  
  
  


          
         

            
            
              
            
             
              
          
           
      

    
                  
          
                  
    
    
          
                  
    
    
                  
                  
                
    
                
                                      


          

            
          
              




            

            
            
            
  
                 
  
               
  
          
    
             
            

          


