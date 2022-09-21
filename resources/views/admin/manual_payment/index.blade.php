@extends('layouts.admin')
@section('title',__('All Manual Payment Transacation'))
@section('content')
  <div class="content-main-block mrg-t-40">
   <h4>{{__('ManualPaymentTransaction')}}</h4><br/>
    <div class="content-block box-body content-block-two">
       
      <table id="moviesTable" class="table table-hover">
        <thead>
          <tr class="table-heading-row">
            <th>
              <div class="inline">
                <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                <label for="checkboxAll" class="material-checkbox"></label>
              </div>
              #
            </th>
            <th>{{__('User Name')}}</th>
            <th>{{__('Package')}}</th>
            <th>{{__('Amount')}}</th>
            <th>{{__('Subscription From')}}</th>
            <th>{{__('Subscription To')}}</th>
            <th>{{__('Status')}}</th>
            <th>{{__('Actions')}}</th>
          </tr>
        </thead>
          @if($manual_payment)
          <tbody>
            @foreach($manual_payment as $key=>$payment)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$payment->user->name}}</td>
                <td>{{$payment->plan->name}}</td>
                <td>{{$payment->plan->amount}}</td>
                <td>{{date('F j, Y  g:i:a',strtotime($payment->subscription_from))}}</td>
                <td>{{date('F j, Y  g:i:a',strtotime($payment->subscription_to))}}</td>
                <td>
                  @if($payment->status == 1)
                    <a href="{{url('manualpayment',$payment->id)}}" class='btn btn-sm btn-success'>{{__('Active')}}</a>
                  @else
                    <a href="{{url('manualpayment',$payment->id)}}" class='btn btn-sm btn-danger'>{{__('Deactive')}}</a> 
                  @endif
                </td>
                <td>
                  <a href="{{url('/images/recipt/'.$payment->file)}}" data-toggle="tooltip" data-original-title="Download file" class="btn-success btn-floating" download><i class="material-icons">cloud_download</i></a></td>
              </tr>
            @endforeach
           
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


@endsection