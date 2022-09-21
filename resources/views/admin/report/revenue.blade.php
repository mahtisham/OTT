@extends('layouts.admin')
@section('title',__('All Revenue Reports'))
@section('stylesheet'){{-- 
   {!! Charts::assets() !!} --}}
@endsection
@section('content')
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <h4 class="admin-form-text">{{__('All Revenue Reports')}}</h4>
    </div>
   
    <div class="content-block box-body content-block-two">
       {{-- <div class="col-sm-3 pull-right form-group{{ $errors->has('date') ? ' has-error' : '' }}">
          <label>Date range:</label>
          <div class="input-group ">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right" id="mydate" name="date">
          </div>
       </div> --}}
      
      <div class="col-md-12">
        {!! $revenue_chart->container() !!}
      </div>

      <div class="">
        <table id="full_detail_table" class="table table-hover db" style="width: 100%">
          <thead>
            <tr class="table-heading-row">
              <th>
                #
              </th>
              <th>{{__('User Name')}}</th>
              <th>{{__('Payment Method')}}</th>
              <th>{{__('Paid Amount')}}</th>
              <th>{{__('Subscription From')}}</th>
              <th>{{__('Subscription To')}}</th>
              <th>{{__('Date')}}</th>
            </tr>
          </thead>
          @if ($revenue_report)

            <tbody>
              @foreach ($revenue_report as $key => $report)
                <tr id="item-{{$report->id}}">
                  <td>
                    {{$key+1}}
                  </td>
                  <td>{{$report->user_name}}</td>
                  <td>{{$report->method}}</td>
                  <td><i class="{{ $currency_symbol }}" aria-hidden="true"></i>{{$report->price}}</td>
                  <td>{{$report->subscription_from}}</td>
                  <td>{{$report->subscription_to}}</td>
                  <td>{{$report->created_at}}</td>
                </tr>
            
              @endforeach
            </tbody>
          @endif
        </table>
      </div>
   
</div>
@endsection
@section('custom-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
 {!! $revenue_chart->script() !!}
 <script>
  @php
    $y = date('Y');
  @endphp
  var startDate = '{{ date('m/d/Y',strtotime($y.'-01-01')) }}';
  var endDate = '{{ date('m/d/Y',strtotime($y.'-12-31')) }}';
  console.log(startDate);
   $(function(){
       $('#mydate').daterangepicker({
            startDate : startDate,
            endDate : endDate
       });
   })
 </script>
 
  <script type="text/javascript">
    $('#mydate').on('change',function(){
      var k = $(this).val();
      var startDate = k.split('-')[0];
       //alert(startDate);  // return 2018-10-21
      var endDate = k.split('-')[1]; 
      //alert(endDate);
      $.ajax({
          type : 'GET',
          data : {startDate : startDate,
                endDate : endDate
                },
          url  : '{{ route("ajaxdatefilter") }}',
          dataType : 'html',
          success : function(data){
             $('#maindata').html('');
             $('#maindata').append(data);
          }
      });

    });
  </script>
@endsection
