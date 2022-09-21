@extends('layouts.admin')
@section('title',__('All Coupons'))
@section('content')
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      @can('coupon.create')
        <a href="{{route('coupons.create')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i>{{__('Create Coupon')}}</a>
      @endcan
      <!-- Delete Modal -->
      @can('coupon.delete')
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
              <h4 class="modal-heading">{{__('Are You Sure')}} ?</h4>
              <p>{{__('Delete Warrning')}}</p>
            </div>
            <div class="modal-footer">
              {!! Form::open(['method' => 'POST', 'action' => 'CouponController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-block box-body table-responsive content-block-two">
      <table id="full_detail_table" class="table table-hover">
        <thead>
          <tr class="table-heading-row">
            <th>
              <div class="inline">
                <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                <label for="checkboxAll" class="material-checkbox"></label>
              </div>
              #
            </th>
            <th>{{__('Coupon Code')}}</th>
            <th>{{__('Percent Off')}}</th>
            <th>{{__('Amount Off')}}</th>
            <th>{{__('Duration')}}</th>
            <th>{{__('Duration In Months')}}</th>
            <th>{{__('Max Redm')}}..</th>
            <th>{{__('Redeem By')}}</th>
            <th>{{__('Actions')}}</th>
          </tr>
        </thead>
        @if ($coupons)
          <tbody>
            @foreach ($coupons as $key => $coupon)
              <tr>
                <td>
                  <div class="inline">
                    <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="{{$coupon->id}}" id="checkbox{{$coupon->id}}">
                    <label for="checkbox{{$coupon->id}}" class="material-checkbox"></label>
                  </div>
                  {{$key+1}}
                </td>
                <td>{{$coupon->coupon_code}}</td>
                <td>{{$coupon->percent_off ? $coupon->percent_off.'%' : '-'}}</td>
                <td>
                  @if($coupon->amount_off)
                    <i class="{{$currency_symbol}} main-curr"></i>{{$coupon->amount_off}}
                  @endif
                </td>
                <td>{{$coupon->duration}}</td>
                <td>{{$coupon->duration_in_months}}</td>
                <td>{{$coupon->max_redemptions}}</td>
                <td>{{date('F d, Y',strtotime($coupon->redeem_by))}}</td>
                @can('coupon.delete')
                <td>
                  @if($coupon->in_stripe != 1)
                  <div class="admin-table-action-block">
                    <a href="{{route('coupons.edit', $coupon->id)}}" data-toggle="tooltip" data-original-title="{{__('Edit')}}" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                  </div>
                  @endif
                  <div class="admin-table-action-block">
                    <button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#{{$coupon->id}}deleteModal"><i class="material-icons">delete</i> </button>
                  </div>
                </td>
                @endcan
              </tr>
              <!-- Delete Modal -->
              <div id="{{$coupon->id}}deleteModal" class="delete-modal modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <div class="delete-icon"></div>
                    </div>
                    <div class="modal-body text-center">
                      <h4 class="modal-heading">{{__('Are You Sure')}} ?</h4>
                      <p>{{__('Delete Warrning')}}</p>
                    </div>
                    <div class="modal-footer">
                      {!! Form::open(['method' => 'DELETE', 'action' => ['CouponController@destroy', $coupon->id]]) !!}
                          <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('No')}}</button>
                          <button type="submit" class="btn btn-danger">{{__('Yes')}}</button>
                      {!! Form::close() !!}
                    </div>
                  </div>
                </div>
              </div>
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